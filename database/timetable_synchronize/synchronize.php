<?php
require_once 'vendor/autoload.php';
require_once '../../database/connection.php';

global $allowed;
if(!isset($_COOKIE['synchronization-not-allowed'])){
    setcookie("synchronization-not-allowed", time(), array(   // To make sure not exceeding GoogleAPI request limit
        'expires' => time() + 180,
        'path' => '/',
        'samesite' => 'Lax'
    ));
    $allowed = true;
}
else{$allowed = false;}

$client = new \Google_Client();
$client->setApplicationName('SheetsToResourceHub');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$service = new Google_Service_Sheets($client);                          echo"<script>console.log('Starting service...');</script>";
$spreadsheetId = "1jmOBYFbvlLutfWyr7eJduwIOERQS7H9kLtIhOal7aHw";        if($service){echo"<script>console.log('Connected!');</script>";}

$table_start_letter = "B";
$table_start_number = 4;                                                echo"<script>console.log('Table start: $table_start_letter$table_start_number');</script>";
$table_end = "S28";                                                     echo"<script>console.log('Table end: $table_end');</script>";

if($allowed){
    traverse_Table($table_start_letter, $table_start_number, $table_end);
}
else{$time = round((200-(time()-$_COOKIE['synchronization-not-allowed']))/60, 2); echo"<script>console.log('Request limit exceeding... Synchronization not allowed for $time minutes!');</script>";}

function traverse_Table($start_letter, $start_number, $end){

    $block_start_letter = $start_letter;
    $block_start_number = $start_number;
    $block_end_letter = chr(ord($start_letter) + 2);
    $block_end_number = $start_number + 2;  // Initializing block
    global $n;
    global $day;
    global $day_num;
    global $rowString;
    $rowString = array(" ", " ", " ");
    $rowString_matchArr = array(0,0,0);

    while(true){
        global $service;
        global $spreadsheetId;
        global $start_time;
        global $end_time;

        if($block_end_number == $start_number + 14){
            $block_start_number ++;
            $block_end_number ++;  // Skipping interval row
            $rowString[0] = " ";
            $rowString[1] = " ";
            $rowString[2] = " ";
            $rowString_matchArr[0] = 0;
            $rowString_matchArr[1] = 0;
            $rowString_matchArr[2] = 0;
        }
        $range = "Timetable!$block_start_letter$block_start_number:$block_end_letter$block_end_number";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        switch($block_start_number){
            case $start_number:
                $start_time = 8;
                $end_time = 9;
                break;
            case $start_number+3:
                $start_time = 9;
                $end_time = 10;
                break;
            case $start_number+6:
                $start_time = 10;
                $end_time = 11;
                break;
            case $start_number+9:
                $start_time = 11;
                $end_time = 12;
                break;
            case $start_number+13:
                $start_time = 13;
                $end_time = 14;
                break;
            case $start_number+16:
                $start_time = 14;
                $end_time = 15;
                break;
            case $start_number+19:
                $start_time = 15;
                $end_time = 16;
                break;
            case $start_number+22:
                $start_time = 16;
                $end_time = 17;
                break;
        }

        if($day_num == 0){$day = "Monday";}

        if(!empty($values)){  // Retrieving data from each block
            $iteration = 1;
            foreach ($values as $row){                                  echo"<script>console.log('Retrieving data from the block: $block_start_letter$block_start_number:$block_end_letter$block_end_number');</script>";
                if(!empty($row[0]) && !empty($row[1]) && !empty($row[2])){
                    $level = $row[0];
                    $by = preg_replace('/[^A-Za-z0-9]/', '', $row[1]);
                    $by = preg_replace('/[0-9]/', '', $by );
                    if(preg_match("#[" . "\xCC\xB6" . "]#", $by)){ continue; }
                    $resource = $row[2];
            
                    switch($iteration){
                        case 1:
                            if($rowString[0] == "$row[0]$row[1]$row[2]"){
                                $rowString_matchArr[0]++;
                            }
                            else{
                                $rowString_matchArr[0] = 0;
                            }
                            $rowString[0] = "$row[0]$row[1]$row[2]";
                            break;
                        case 2:
                            if($rowString[1] == "$row[0]$row[1]$row[2]"){
                                $rowString_matchArr[1]++;
                            }
                            else{
                                $rowString_matchArr[1] = 0;
                            }
                            $rowString[1] = "$row[0]$row[1]$row[2]";
                            break;
                        case 3:
                            if($rowString[2] == "$row[0]$row[1]$row[2]"){
                                $rowString_matchArr[2]++;
                            }
                            else{
                                $rowString_matchArr[2] = 0;
                            }
                            $rowString[2] = "$row[0]$row[1]$row[2]";
                            break;
                    }

                    $eventID = pushData_Events($level, $by);
                    $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);

                    date_default_timezone_set("Asia/Colombo");
                    $today_day = date("l");
                    if((double)date("G.i")>$start_time && (double)date("G.i")<$end_time && $day == $today_day){
                        $active = 1;
                    } else{ $active = 0; }

                    pushData_Occupied($resource, $eventID, $timeSlotID, $active);
                }
                $iteration++;
            }
        }

        if($rowString_matchArr[0]!=0 && $rowString[0] != " "){
            if($rowString_matchArr[0]==1){
                $start_time --;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time ++;
            }
            if($rowString_matchArr[0]==2){  // Need to add code for updating extended time slots
                $start_time -= 2;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time += 2;
            }
        }
        if($rowString_matchArr[1]!=0 && $rowString[1] != " "){
            if($rowString_matchArr[1]==1){
                $start_time --;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time ++;
            }
            if($rowString_matchArr[1]==2){
                $start_time -= 2;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time += 2;
            }
        }
        if($rowString_matchArr[2]!=0 && $rowString[2] != " "){
            if($rowString_matchArr[2]==1){
                $start_time --;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time ++;
            }
            if($rowString_matchArr[2]==2){
                $start_time -= 2;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time += 2;
            }
        }
        
        if($end == "$block_end_letter$block_end_number"){ // Exit when it reaches the last block
            break;
        }
        elseif($block_end_number == $start_number + 24){   // Jump to the 1st block of next column

            $block_start_letter = chr(ord($block_start_letter) + 3);
            $block_start_number = $start_number;
            $block_end_letter = chr(ord($block_end_letter) + 3);
            $block_end_number = $start_number + 2;
            $rowString[0] = " ";
            $rowString[1] = " ";
            $rowString[2] = " ";
            $rowString_matchArr[0] = 0;
            $rowString_matchArr[1] = 0;
            $rowString_matchArr[2] = 0;

            $day_num++;
            switch($day_num){
                case 1:
                    $day = "Tuesday";
                    break;
                case 2:
                    $day = "Wednesday";
                    break;
                case 3:
                    $day = "Thursday";
                    break;
                case 4:
                    $day = "Friday";
                    break;
                case 5:
                    $day = "Saturday";
                    break;
            }

            continue;
        }

        $block_start_number += 3;
        $block_end_number += 3;  // Moving to the block below

    }

}
// Need to add code for deleting old events that have been removed from the timetable

function pushData_Events($level, $by){
    $type = str_contains($level, "(P)")? 'Practical session' : 'Lecture';
    $level = trim(str_replace("(P)","",$level));

    $conductBy = $by;

    global $conn;
    $query_select_by = "SELECT * FROM user WHERE ACRONYM = '$by'";
    $result = $conn->query($query_select_by);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $conductBy = $row["USER_NAME"];
    }

    $eventName = "Level " . $level . " $type " . " by " . $conductBy;
    $eventType = $type;
    
    $query_select = "SELECT * FROM events WHERE EVENT_NAME = '$eventName' AND EVENT_TYPE = '$eventType' AND CONDUCT_BY = '$conductBy'";
    $result = $conn->query($query_select);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $eventID = $row["ID"];
    }
    else{
        $query_insert = "INSERT INTO events(EVENT_NAME,EVENT_TYPE,CONDUCT_BY,OPTIONAL_DETAILS,RECURRING) VALUES('$eventName', '$eventType', '$conductBy', 'Added from timetable', '1')";
        $conn->query($query_insert);
        $result = $conn->query($query_select);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $eventID = $row["ID"];
        }                                                               echo"<script>console.log('Event created: $eventName conducted by $conductBy');</script>";
    }
    return $eventID;
}
 
function pushData_TimeSlot($startTime, $endTime, $day){
    global $conn;
    $query_select = "SELECT * FROM time_slot WHERE START_TIME = '$startTime' AND END_TIME = '$endTime' AND DAY = '$day'";
    $result = $conn->query($query_select);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $timeSlotID = $row["ID"];
    }
    else{
        $query_insert = "INSERT INTO time_slot (START_TIME,END_TIME,DAY) VALUES ('$startTime','$endTime','$day')";
        $conn->query($query_insert);

        $result = $conn->query($query_select);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $timeSlotID = $row["ID"];                                   echo"<script>console.log('Time Slot created: $startTime:$endTime - $day');</script>";
        }
    }
    return $timeSlotID;
}

function pushData_Occupied($resource, $eventID, $timeSlotID, $active){
    global $conn;
    $str = "";
    $resource = str_replace(' ', '', $resource);
    $chAr = str_split($resource);
    for($i=0; $i<7; $i++){
        if(isset($chAr[$i])){
            $str .= "$chAr[$i]%";
        }
    }

    $query_resource = "SELECT * FROM resource WHERE RESOURCE_NAME LIKE '$str'";
    $result = $conn->query($query_resource);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $resource_id = $row["ID"];
    }
    else{
        echo"<script>console.log('Resource not found in the database!: $resource for event id-$eventID');</script>";    
        return;
    }

    $query_check = "SELECT * FROM occupied WHERE EVENT_ID = '$eventID' AND RESOURCE_ID = '$resource_id' AND TIME_SLOT_ID = '$timeSlotID'";
    $result = $conn->query($query_check);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $id = $row["OCCUPY_ID"];

        $query_update = "UPDATE occupied SET ACTIVE = '$active' WHERE OCCUPY_ID = '$id'";
        $conn->query($query_update);
    }
    else{
        $query = "INSERT INTO occupied (EVENT_ID,RESOURCE_ID,TIME_SLOT_ID,ACTIVE) VALUES ('$eventID','$resource_id','$timeSlotID',$active)";
        $conn->query($query);                                           echo"<script>console.log('Resource occupied: $resource for event id-$eventID');</script>";
    }
}
    
?>