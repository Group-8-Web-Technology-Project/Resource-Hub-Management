<?php

require_once "../../database/connection.php";
require_once "../util/checkAvailability.php";

if(isset($_GET["search"])){
    $search = $_GET["search"];
    $limit = 2;
    if(isset($_GET["limit"])){
        $limit = $_GET["limit"];
    }
    $subSql='LIMIT 3';
    if(isset($_GET["page"])){
        $page = $_GET["page"];
        $offset = ($page-1)*$limit;
        $subSql = "LIMIT $limit OFFSET $offset;";
    }

    $query = "SELECT * FROM events WHERE (EVENT_NAME LIKE '%$search%' OR EVENT_TYPE LIKE '%$search%' OR CONDUCT_BY LIKE '%$search%') AND (TEMP=0) $subSql";
    $result = $conn->query($query);



    $count = "SELECT count(*) FROM events WHERE (EVENT_NAME LIKE '%$search%' OR EVENT_TYPE LIKE '%$search%' OR CONDUCT_BY LIKE '%$search%') AND (TEMP=0) ";
    $events = array();
    $response = array();
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            array_push($events,$row);
        }
    }
    $response["data"] = $events;
    if(isset($page)){
        $response["total"] = $conn->query($count)->fetch_assoc()["count(*)"];
        $response["page"]=$page;
        $response["offset"] = ($page-1)*$limit;
    }
    echo json_encode($response);
    return;
}
if(isset($_GET["id"]) && isset($_GET["all"])){
    $id = $_GET["id"];
    $query = "SELECT * FROM events 
       INNER JOIN occupied ON events.ID = occupied.EVENT_ID
       INNER JOIN resource ON occupied.RESOURCE_ID = resource.ID
       INNER JOIN time_slot ON occupied.TIME_SLOT_ID = time_slot.ID
       WHERE events.ID = '$id'
    ";
    
    $result = $conn->query($query);
    $response = array();
    $allocations = array();
    while($event = $result->fetch_assoc()){
        $allocations[] = $event;
    };


    $response["data"] = $allocations;
    echo json_encode($response);
    return;

}

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $query = "SELECT * FROM events WHERE ID = '$id'";
    $result = $conn->query($query);
    
    $event = $result->fetch_assoc();
    $response = array();
    $response["data"] = $event;
    echo json_encode($response);
    return;
}

if(isset($_GET["new"])){

    $data = json_decode(file_get_contents("php://input"),true);

    $eventName = addslashes($data["event_name"]);
    $eventType = $data["event_type"];
    $conductBy = addslashes($data["conduct_by"]);
    $optionalDetails = addslashes($data["optional_details"]);


    
    $query = "INSERT INTO events(EVENT_NAME,EVENT_TYPE,CONDUCT_BY,EVENT_FLYER,OPTIONAL_DETAILS) VALUES('$eventName','$eventType','$conductBy','$event_flyer','$optionalDetails')";
    //upload the flyer
    $target_dir = "../../assets/images/";
    $uid = uniqid();
    $target_file = $target_dir .  basename($uid."-".$_FILES["event_flyer"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));




    if($conn->query($query)){
        echo "success";
    }else{
        echo "failed";
    }
    return;
}


if(isset($_GET["allocation"])){

    $eventID = $_GET["eventID"];

    $query = "SELECT * FROM occupied WHERE  EVENT_ID = '$eventID' GROUP BY RESOURCE_ID;";
    
    $result = $conn->query($query);

    $response = array();
    $resources = array();

    while($row = $result->fetch_assoc()){
        $resourceID = $row["RESOURCE_ID"];

        $queryResource = "SELECT * FROM occupied 
        INNER JOIN time_slot ON occupied.TIME_SLOT_ID = time_slot.ID
        WHERE RESOURCE_ID = '$resourceID' AND EVENT_ID = '$eventID'";

        $resultResource = $conn->query($queryResource);

        $resource = array();
        $resource["resource_id"] = $resourceID;
        $resource["resource_name"] = $conn->query("SELECT * FROM resource WHERE ID = '$resourceID'")->fetch_assoc()["RESOURCE_NAME"];
        $resource["allocations"] = array();
        while($rowResource = $resultResource->fetch_assoc()){
            $resource["allocations"][] = $rowResource;
        }
        $resources[] = $resource;
    }

    echo json_encode($resources);
 
    return;
}

if(isset($_GET["deallocate"])){
    $data = json_decode(file_get_contents("php://input"),true);
    $eventID = $data["eventID"];
    $resourceID = $data["resourceID"];
    $timeSlotID = $data["timeSlotID"];
    $id = $data["id"];

    $query = "DELETE FROM occupied WHERE OCCUPY_ID='$id'";

    $result = $conn->query($query);

    if($result){
        echo "success";
    }else{
        echo "false";
    }

    return;
}

if(isset($_GET["deactivate"])){
    $data = json_decode(file_get_contents("php://input"),true);
    $eventID = $data["eventID"];
    $resourceID = $data["resourceID"];
    $timeSlotID = $data["timeSlotID"];
    $activateType = $data["activateType"];
    $id = $data["id"];
    


    $res = $conn->query("SELECT * FROM time_slot WHERE ID = '$timeSlotID'")->fetch_assoc();
    $start = $res["START_TIME"];
    $end = $res["END_TIME"];
    $date = $res["DAY"];



    if($activateType == "0"){
        $activateType = 1;
        $overlap = isAvailable($conn,$start,$end,$date,$resourceID);
        if(!empty($overlap)){
            echo "Time Slot Overlap Detected";
            return;
        }

    }else{
        $activateType = 0;
    }


    $date = $data["date"];
    $query = "UPDATE occupied SET ACTIVE = $activateType WHERE OCCUPY_ID = '$id'";

    $result = $conn->query($query);


    if($result){
        echo "success";
    }else{
        echo "false";
    }

    return;
}



if(isset($_GET['delete'])){
    $eventID = $_GET["eventID"];
    $queryOccupied = "DELETE FROM occupied WHERE EVENT_ID = '$eventID'";
    $resultOccupied = $conn->query($queryOccupied);
    $queryRequest = "DELETE FROM request WHERE EVENT_ID = '$eventID'";
    $resultRequest = $conn->query($queryRequest);

    $query = "DELETE FROM events WHERE ID = '$eventID'";
    $result = $conn->query($query);

    if($result && $resultOccupied && $resultRequest){
        echo "success";
    }else{
        echo "false";
    }
    return;
}


if(isset($_GET["edit"])){
    $data = json_decode(file_get_contents("php://input"),true);
    $eventID = addslashes($data["eventID"]);
    $eventName = addslashes($data["event_name"]);
    $eventType = addslashes($data["event_type"]);
    $conductBy = addslashes($data["conduct_by"]);
    $eventFlyer = addslashes($data["event_flyer"]);
    $optionalDetails = addslashes($data["optional_details"]);

    $query = "UPDATE events SET EVENT_NAME = '$eventName', EVENT_TYPE = '$eventType', CONDUCT_BY = '$conductBy', EVENT_FLYER = '$event_flyer',OPTIONAL_DETAILS = '$optionalDetails' WHERE ID = '$eventID'";

    $result = $conn->query($query);

    if($result){
        echo "success";
    }else{
        echo "false";
    }

    return;
}




?>