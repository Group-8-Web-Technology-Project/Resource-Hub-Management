<?php
require_once "../../database/connection.php";

if(isset($_GET["check"])){
    $start = $_GET["start_time"];
    $end = $_GET["end_time"];
    $date = $_GET["date"];
    $resource_id = $_GET["resource_id"];

    $overlap = isAvailable($conn,$start,$end,$date,$resource_id);

    echo json_encode($overlap);
    
}

function isAvailable($conn,$start,$end,$date,$resource_id){
    $day = date('l',strtotime($date));
    $queryGetTimeSlot = 
    "
    SELECT * 
    FROM time_slot 
    WHERE 
        DAY = '$day'
        AND (
            (START_TIME < '$end' AND END_TIME >= '$end') 
            OR (START_TIME >= '$start' AND START_TIME < '$end' AND END_TIME > '$end') 
            OR (START_TIME <= '$start' AND END_TIME > '$start' AND END_TIME <= '$end') 
            OR (START_TIME >= '$start' AND END_TIME <= '$end' AND NOT (END_TIME = '$start' AND START_TIME = '$end'))
        );
    
    
    ";

    $resultGetTimeSlot = $conn->query($queryGetTimeSlot);
    
    
    $overlap = array();
    
    if($resultGetTimeSlot->num_rows>0){
        
        $available = true;
        while($row = $resultGetTimeSlot->fetch_assoc()){
            $time_slot_id = $row["ID"];
           
            $queryGetAvailability = "SELECT * FROM occupied WHERE RESOURCE_ID = '$resource_id' AND TIME_SLOT_ID = '$time_slot_id' AND ( OCCUPIED_DATE IS NULL OR  OCCUPIED_DATE >= '$date') AND ACTIVE=1; ";
            
            $resultGetAvailability = $conn->query($queryGetAvailability);
    
    
            if($resultGetAvailability->num_rows>0){
                $available = false;
                while($rowTwo = $resultGetAvailability->fetch_assoc()){
                    $eventID = $rowTwo["EVENT_ID"];
                    $queryGetEvent = "SELECT * FROM events WHERE ID = '$eventID'";
                    $resultGetEvent = $conn->query($queryGetEvent);
                    $event = $resultGetEvent->fetch_assoc();
                    $detailArray = array(
                        "event_name" => $event["EVENT_NAME"],
                        "event_start_time" => $row["START_TIME"],
                        "event_end_time" => $row["END_TIME"],
                        "event_id" => $event["ID"],
                        "event_conduct_by" => $event["CONDUCT_BY"],
                        "recurring" => $rowTwo["OCCUPIED_DATE"]?"No":"Yes",
                    );
                    array_push($overlap,$detailArray);
                }
            }
        }
        
    }
    
    return ($overlap);
}




?>