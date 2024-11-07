<?php

require_once "../../database/connection.php";
require_once "../util/checkAvailability.php";
require_once "../../email/index.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET["search"])){
    $search = $_GET["search"];
    $page = $_GET["page"];
    $limit = 10;

    $user_type = $_SESSION["user_type"];
    $uid = $_SESSION["user_id"];
    $subSQL="";

    if($user_type !== "ADMIN" && $user_type !== "SUPER_ADMIN"){
        $subSQL = "AND request.USER_ID = '$uid'";
    }
    elseif($user_type == "ADMIN" || $user_type ==  "SUPER_ADMIN"){
        $subSQL = "AND request.REQUEST_APPROVED != '1' AND request.REQUEST_APPROVED != '-1'";
    }

    $offset = ($page-1)*$limit;

    $count = 
    "
    SELECT COUNT(*) FROM request 
    INNER JOIN user ON request.USER_ID = user.USER_ID
    INNER JOIN resource ON request.RESOURCE_ID = resource.ID
    INNER JOIN time_slot ON request.TIME_SLOT_ID = time_slot.ID
    INNER JOIN events ON request.EVENT_ID = events.ID
    WHERE
    (user.USER_NAME LIKE '%$search%' OR resource.RESOURCE_NAME LIKE '%$search%'
    OR events.EVENT_NAME LIKE '%$search%') $subSQL 
    ";

    $query = 
    "
    SELECT * FROM request 
        INNER JOIN user ON request.USER_ID = user.USER_ID
        INNER JOIN resource ON request.RESOURCE_ID = resource.ID
        INNER JOIN time_slot ON request.TIME_SLOT_ID = time_slot.ID
        INNER JOIN events ON request.EVENT_ID = events.ID
        WHERE
        (user.USER_NAME LIKE '%$search%' OR resource.RESOURCE_NAME LIKE '%$search%'
        OR events.EVENT_NAME LIKE '%$search%') $subSQL
        ORDER BY request.REQUEST_ID DESC
        LIMIT $limit OFFSET $offset 
    ";




    $result = $conn->query($query);

    $events = array();
    $response = array();

    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            array_push($events,$row);
        }
    }
    $response["data"] = $events;
    $response["total"] = $conn->query($count)->fetch_assoc()["COUNT(*)"];
    $response["page"] = $page;
    $response["offset"] = $offset;
    echo json_encode($response);
    return;

}


if(isset($_GET["id"])){
    $id = $_GET["id"];
    $query = "
    SELECT * FROM request 
        INNER JOIN user ON request.USER_ID = user.USER_ID
        INNER JOIN resource ON request.RESOURCE_ID = resource.ID
        INNER JOIN time_slot ON request.TIME_SLOT_ID = time_slot.ID
        INNER JOIN events ON request.EVENT_ID = events.ID
    WHERE request.REQUEST_ID = '$id'

    ";


    
    $result = $conn->query($query);
    $response = array();
    if($result->num_rows>0){
        $response["data"] = $result->fetch_assoc();
        echo json_encode($response);
    }else{
        echo "false";
    }
    return;
}

if(isset($_GET["decline"])){
    $data = json_decode(file_get_contents("php://input"),true);
    $requestID = $data["request_id"];
    $decline_message = addslashes($data["decline_message"]);

    $queryUpdateRequest = "UPDATE request SET REQUEST_APPROVED=-1,DECLINE_MESSAGE='$decline_message' WHERE REQUEST_ID='$requestID'";
    $resultUpdateRequest = $conn->query($queryUpdateRequest);


    //Get Date
    $queryGetDate = "SELECT * FROM request WHERE REQUEST_ID = '$requestID'";
    $resultGetDate = $conn->query($queryGetDate);
    $result = $resultGetDate->fetch_assoc();


    //Get User Details
    $queryGetUserEmail = "SELECT * FROM user WHERE USER_ID = (SELECT USER_ID FROM request WHERE REQUEST_ID = '$requestID')";
    $resultGetUserEmail = $conn->query($queryGetUserEmail);
    $resultUser = $resultGetUserEmail->fetch_assoc();

    //Resource Details
    $queryGetResource = "SELECT * FROM resource WHERE ID = (SELECT RESOURCE_ID FROM request WHERE REQUEST_ID = '$requestID')";
    $resultGetResource = $conn->query($queryGetResource);
    $resultResource = $resultGetResource->fetch_assoc();

    //Event Details
    $queryGetEvent = "SELECT * FROM events WHERE ID = (SELECT EVENT_ID FROM request WHERE REQUEST_ID = '$requestID')";
    $resultGetEvent = $conn->query($queryGetEvent);
    $resultEvent = $resultGetEvent->fetch_assoc();

    //Time Slot Details
    $queryGetTimeSlot = "SELECT * FROM time_slot WHERE ID = (SELECT TIME_SLOT_ID FROM request WHERE REQUEST_ID = '$requestID')";
    $resultGetTimeSlot = $conn->query($queryGetTimeSlot);
    $resultTimeSlot = $resultGetTimeSlot->fetch_assoc();


    $email = $resultUser["USER_EMAIL"];
    $username = $resultUser["USER_NAME"];
    $event = $resultEvent["EVENT_NAME"];
    $start = $resultTimeSlot["START_TIME"];
    $end = $resultTimeSlot["END_TIME"];
    $date = $result["REQUEST_DATE"];
    $resource = $resultResource["RESOURCE_NAME"];



    declineEmail($email,$username,$event,$start,$end,$date,$resource,$decline_message);

    if($resultUpdateRequest){
        echo "success";
    }else{
        echo "false";
    }
    return;
}


if(isset($_GET["approve"])){
    $data = json_decode(file_get_contents("php://input"),true);
    $resourceID = $data["resource_id"];
    $requestID = $data["request_id"];
    $eventID = $data["event_id"];
    $timeSlotID = $data["time_slot_id"];
    $recurring = $data["recurring"];
    $date = $data["date"];

    $query ="";

    //Get start and end time from time_slot
    $queryGetTimeSlot = "SELECT * FROM time_slot WHERE ID = '$timeSlotID'";
    $resultGetTimeSlot = $conn->query($queryGetTimeSlot);
    $result = $resultGetTimeSlot->fetch_assoc();
    $start = $result["START_TIME"];
    $end = $result["END_TIME"];


    if(isAvailable($conn,$start,$end,$date,$resourceID)){
        echo "overlap";
        return;
    }

    if($recurring!="No"){
        $query = "INSERT INTO occupied (EVENT_ID,RESOURCE_ID,TIME_SLOT_ID,ACTIVE) VALUES ('$eventID','$resourceID','$timeSlotID',1)";
    }else{
        $query = "INSERT INTO occupied (EVENT_ID,RESOURCE_ID,TIME_SLOT_ID,OCCUPIED_DATE,ACTIVE) VALUES ('$eventID','$resourceID','$timeSlotID','$date',1)";
    }

    $result = $conn->query($query);

    $queryUpdate = "UPDATE events SET TEMP='0' WHERE ID='$eventID'";
    $resultUpdate = $conn->query($queryUpdate);

    $queryUpdateRequest = "UPDATE request SET REQUEST_APPROVED=1 WHERE REQUEST_ID='$requestID'";
    $resultUpdateRequest = $conn->query($queryUpdateRequest);





    if($result && $resultUpdate && $resultUpdateRequest ){
        //Get User Email
        $queryGetUserEmail = "SELECT * FROM user WHERE USER_ID = (SELECT USER_ID FROM request WHERE REQUEST_ID = '$requestID')";
        $resultGetUserEmail = $conn->query($queryGetUserEmail);
        $resultUser = $resultGetUserEmail->fetch_assoc();

        $email = $resultUser["USER_EMAIL"];
        $username = $resultUser["USER_NAME"];
        
        $queryGetEvent = "SELECT * FROM events WHERE ID = '$eventID'";
        $resultGetEvent = $conn->query($queryGetEvent);
        $resultEvent = $resultGetEvent->fetch_assoc();
        
        $event = $resultEvent["EVENT_NAME"];

        
        $queryGetResource = "SELECT * FROM resource WHERE ID = '$resourceID'";
        $resultGetResource = $conn->query($queryGetResource);
        $resultResource = $resultGetResource->fetch_assoc();
        
        $resource = $resultResource["RESOURCE_NAME"];
        
        
        $date = $data["date"];
        acceptEmail($email,$username,$event,$start,$end,$date,$resource);
        echo "success";
    }else{
        echo "false";
    }
    return;
}






if(isset($_GET["request_add"])){
    $isRecurring = $_POST["is_recurring"];

    $target_file = "";
    if (isset($_FILES['flyer']) && $_FILES['flyer']['error'] === UPLOAD_ERR_OK){
        // Flyer upload
        $uid = uniqid();
        $imageFileType = strtolower(pathinfo($_FILES["flyer"]["name"], PATHINFO_EXTENSION));
        $filename = basename($_POST["event_name"] . " by " . $_POST["conduct_by"] . "." . $imageFileType);
        $target_dir = "../../assets/images/flyers/";
        $target_file = $target_dir . $filename;
        $allowedFormats = ['jpg', 'jpeg', 'png'];
        $check = getimagesize($_FILES["flyer"]["tmp_name"]);       // Check if the uploaded file is actually an image

        if ($check == false) {
            echo "false-not_an_image";
            exit;
        }else if (!in_array($imageFileType, $allowedFormats)) {       // Allow only specific file formats
            echo "false-file_format";
            exit;
        }else{
            // Move the uploaded file to the target directory, replacing any existing file with the same name
            move_uploaded_file($_FILES["flyer"]["tmp_name"], $target_file);
        }
    }
    
    $eventID = $_POST["event_id"];
    if($_POST["isNewEvent"]=="true"){
        $newEventQuery = "INSERT INTO events (EVENT_NAME,EVENT_TYPE,CONDUCT_BY,TEMP,RECURRING,EVENT_FLYER) VALUES ('".$_POST["event_name"]."','".$_POST["event_type"]."','".$_POST["conduct_by"]."','1','$isRecurring','$target_file')";
     
        $newEventResult = $conn->query($newEventQuery);
        
        $eventID = ($conn->query("SELECT MAX(id) AS ID FROM events"))->fetch_assoc()["ID"];
        
    }
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $resourceID = $_POST["resource_id"];
    $startTime = date("H",strtotime($_POST["start_time"]));
    $endTime = date("H",strtotime($_POST["end_time"]));
    $date = $_POST["date"];
    $day = date('l',strtotime($date));
    $uid = $_SESSION["user_id"];
    $request_message = $_POST["request_message"];


    //Check whether timeslot already exists 
    $query = "SELECT * FROM time_slot WHERE START_TIME = '$startTime' AND END_TIME = '$endTime' AND DAY = '$day'";
    $result = $conn->query($query);

    $timeSlotID;

    if($result->num_rows<=0){
        $query = "INSERT INTO time_slot (START_TIME,END_TIME,DAY) VALUES ('$startTime','$endTime','$day')";
        $conn->query($query);

        $query = "SELECT * FROM time_slot WHERE START_TIME = '$startTime' AND END_TIME = '$endTime' AND DAY = '$day'";
        $result = $conn->query($query);

        $timeSlotID = $result->fetch_assoc()["ID"];
    }
    else{
        $timeSlotID = $result->fetch_assoc()["ID"];
    }

    //Create new Request 
    $priority="0";
    switch($_SESSION["user_type"]){
        case "ADMIN":
            $priority = "2";
            break;
        case "LECTURER":
            $priority = "1";
            break;
        case "STUDENT":
            $priority = "0";
            break;

    }


    $request_message = addslashes($request_message);
    $query = "INSERT INTO request (EVENT_ID,RESOURCE_ID,TIME_SLOT_ID,REQUEST_DATE,REQUEST_APPROVED,USER_ID,PRIORITY,REQUEST_MESSAGE) VALUES ('$eventID','$resourceID','$timeSlotID','$date','0',$uid,'$priority','$request_message')";
    
    $result = $conn->query($query);

    if($result){
        echo "success";
    }else{
        echo "false";
    }


}



?>