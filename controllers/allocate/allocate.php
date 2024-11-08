<?php

require_once "../../database/connection.php";
require_once "../util/checkAvailability.php";


if(isset($_GET["new"])){
    $requestData = json_decode(file_get_contents("php://input"), true);

    $eventID = $requestData["eventID"];
    $resource_id = $requestData["resourceID"];
    $startTime = date("H",strtotime($requestData["startTime"]));
    $endTime = date("H",strtotime($requestData["endTime"]));
    $date = $requestData["date"];
    $day = date('l',strtotime($date));
    $isRecurring = $requestData["isRecurring"];

    if(!empty(isAvailable($conn,$startTime,$endTime,$date,$resource_id))){
        echo "Unavailable Time Slot";
        return;
    }

    
    //Check for existing timeslot

    $query = "SELECT * FROM time_slot WHERE START_TIME = '$startTime' AND END_TIME = '$endTime' AND DAY = '$day'";
    
    $result = $conn->query($query);

    $timeSlotID = null;
    $error = "";
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $timeSlotID = $row["ID"];
        $queryGetAvailability = "SELECT * FROM occupied WHERE RESOURCE_ID = '$resource_id' AND TIME_SLOT_ID = '$timeSlotID' AND ( OCCUPIED_DATE IS NULL OR  OCCUPIED_DATE >= '$date') AND ACTIVE=1; ";
        $resultGetAvailability = $conn->query($queryGetAvailability);
        if($resultGetAvailability->num_rows>0){
            echo "Invalid Request";
            return;
        }
    }else{
        $query = "INSERT INTO time_slot (START_TIME,END_TIME,DAY) VALUES ('$startTime','$endTime','$day')";
        $conn->query($query);
        $timeSlotID = $conn->insert_id;

    }

    //Occupy the timeslot
 
    if($isRecurring){
        $query = "INSERT INTO occupied (EVENT_ID,RESOURCE_ID,TIME_SLOT_ID,ACTIVE) VALUES ('$eventID','$resource_id','$timeSlotID',1)";
    }else{
        $query = "INSERT INTO occupied (EVENT_ID,RESOURCE_ID,TIME_SLOT_ID,OCCUPIED_DATE,ACTIVE) VALUES ('$eventID','$resource_id','$timeSlotID','$date',1)";
    }
    $conn->query($query);
    $occupiedID = $conn->insert_id;
    echo "success";


    return;


}


if(isset($_GET["date"])){
    $date = $_GET["date"];
    $resourceID = $_GET["resourceID"];
    $day = date('l',strtotime($date));
    $query = 
    "
    SELECT * FROM `occupied` as o
	INNER JOIN events as e ON o.EVENT_ID=e.ID
    INNER JOIN time_slot as ts ON ts.ID = o.TIME_SLOT_ID
    WHERE ts.DAY='$day' AND ((OCCUPIED_DATE IS NULL OR RECURRING=1) OR OCCUPIED_DATE = '$date') AND ACTIVE=1
    AND o.RESOURCE_ID = '$resourceID'
   	ORDER BY ts.START_TIME;
    ";
    


    $result = $conn->query($query);
    $occupiedArray = array();
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $occupiedArray[] = $row;
        }
    }

    $result = array();
    $result["data"] = $occupiedArray;
    echo json_encode($result);
    return;
}

if(isset($_GET["deallocate"])){
    $eventID = $_GET["event_id"];
    $resourceID = $_GET["resource_id"];
    $timeSlotID = $_GET["time_slot_id"];
    $date = $_GET["date"];

    $query = "DELETE FROM occupied WHERE EVENT_ID = '$eventID' AND RESOURCE_ID = '$resourceID' AND TIME_SLOT_ID = '$timeSlotID' AND (OCCUPIED_DATE IS NULL OR OCCUPIED_DATE = '$date')";

    $result = $conn->query($query);

    if($result){
        echo json_encode("success");
    }else{
        echo json_encode("false");
    }

}

?>

