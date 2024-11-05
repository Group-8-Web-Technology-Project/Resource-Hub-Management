<?php
require_once 'vendor/autoload.php';
require_once '../../database/connection.php';

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

date_default_timezone_set("Asia/Colombo");
$datetime_now = date("Y-m-d H:i:s");
$query = "SELECT * FROM script_delay WHERE ID = 0";
$result = $conn->query($query);
if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $last_run = $row["LAST_RUN"];
    $datetime_next = date("Y-m-d H:i:s", strtotime("+30 minutes", strtotime($last_run)));
    $timeDiff = strtotime($datetime_now) - strtotime($datetime_next);

    if($timeDiff >= 0){
        traverse_Table($table_start_letter, $table_start_number, $table_end);

        $set_last_run = "UPDATE script_delay SET LAST_RUN = '$datetime_now' WHERE ID = 0";
        $conn->query($set_last_run);
    }
    else{
        $time_gap = round((strtotime($datetime_next) - strtotime($datetime_now))/60, 2);
        echo"<script>console.log('Synchronization is not allowed for $time_gap minutes!');</script>";
    }
}
else{
    traverse_Table($table_start_letter, $table_start_number, $table_end);

    $set_last_run = "INSERT INTO script_delay(LAST_RUN) VALUES('$datetime_now')";
    $conn->query($set_last_run);
}

function traverse_Table($start_letter, $start_number, $end){

    delete_old_Records();

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
    $occupiedIDArr1 = array(0,0,0);
    $occupiedIDArr2 = array(0,0,0);

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
        $response = $service->spreadsheets->get($spreadsheetId, [
            'ranges' => $range,
            'fields' => 'sheets.data.rowData.values(userEnteredValue,userEnteredFormat(textFormat))'
        ]);

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

        if (!empty($response->getSheets())) {                                echo"<script>console.log('Retrieving data from the block: $block_start_letter$block_start_number:$block_end_letter$block_end_number');</script>";
            $iteration = 1;
            foreach ($response->getSheets() as $sheet) {
                foreach ($sheet->getData() as $rows) {
                    foreach ($rows->getRowData() as $rowData) {
                        $cellValues = $rowData->getValues();
                        $row = [];
                        $row[0] = isset($cellValues[0]) && $cellValues[0]->getUserEnteredValue() ? $cellValues[0]->getUserEnteredValue()->getStringValue() : '';
                        $row[1] = isset($cellValues[1]) && $cellValues[1]->getUserEnteredValue() ? $cellValues[1]->getUserEnteredValue()->getStringValue() : '';
                        $row[2] = isset($cellValues[2]) && $cellValues[2]->getUserEnteredValue() ? $cellValues[2]->getUserEnteredValue()->getStringValue() : '';

                        if ($row[0]!='' && $row[1]!='' && $row[2]!=''){

                            $level = $row[0];
                            $by = preg_replace('/[^A-Za-z0-9]/', '', $row[1]);
                            $by = preg_replace('/[0-9]/', '', $by);
                            $resource = $row[2];

                            $byFormat = $cellValues[1]->getUserEnteredFormat();
                            $strikethrough = isset($byFormat) && $byFormat->getTextFormat() ? $byFormat->getTextFormat()->getStrikethrough() : false;
                            $active = $strikethrough ? 0 : 1;

                            switch($iteration){
                                case 1:
                                    $rowString[0] == "$row[0]$row[1]$row[2]" ? $rowString_matchArr[0]++ : $rowString_matchArr[0] = 0;
                                    $rowString[0] = "$row[0]$row[1]$row[2]";
                                    break;
                                case 2:
                                    $rowString[1] == "$row[0]$row[1]$row[2]" ? $rowString_matchArr[1]++ : $rowString_matchArr[1] = 0;
                                    $rowString[1] = "$row[0]$row[1]$row[2]";
                                    break;
                                case 3:
                                    $rowString[2] == "$row[0]$row[1]$row[2]" ? $rowString_matchArr[2]++ : $rowString_matchArr[2] = 0;
                                    $rowString[2] = "$row[0]$row[1]$row[2]";
                                    break;
                            }
        
                            $eventID = pushData_Events($level, $by);
                            $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
        
                            $occupiedID = pushData_Occupied($resource, $eventID, $timeSlotID, $active);
                            switch($iteration){
                                case 1:
                                    $occupiedIDArr1[0] = $occupiedIDArr2[0];
                                    $occupiedIDArr2[0] = $occupiedID;
                                    break;
                                case 2:
                                    $occupiedIDArr1[1] = $occupiedIDArr2[1];
                                    $occupiedIDArr2[1] = $occupiedID;
                                    break;
                                case 3:
                                    $occupiedIDArr1[2] = $occupiedIDArr2[2];
                                    $occupiedIDArr2[2] = $occupiedID;
                                    break;
                            }
                        }
                        $iteration++;
                    }
                }
            }
        }

        if($rowString_matchArr[0]!=0 && $rowString[0] != " "){
            if($rowString_matchArr[0]==1){
                $start_time --;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time ++;
                update_Occupied($occupiedIDArr2[0], $timeSlotID);
                delete_Occupied($occupiedIDArr1[0]);
            }
            if($rowString_matchArr[0]==2){
                $start_time -= 2;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time += 2;
                update_Occupied($occupiedIDArr2[0], $timeSlotID);
                delete_Occupied($occupiedIDArr1[0]);
            }
        }
        if($rowString_matchArr[1]!=0 && $rowString[1] != " "){
            if($rowString_matchArr[1]==1){
                $start_time --;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time ++;
                update_Occupied($occupiedIDArr2[1], $timeSlotID);
                delete_Occupied($occupiedIDArr1[1]);
            }
            if($rowString_matchArr[1]==2){
                $start_time -= 2;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time += 2;
                update_Occupied($occupiedIDArr2[1], $timeSlotID);
                delete_Occupied($occupiedIDArr1[1]);
            }
        }
        if($rowString_matchArr[2]!=0 && $rowString[2] != " "){
            if($rowString_matchArr[2]==1){
                $start_time --;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time ++;
                update_Occupied($occupiedIDArr2[2], $timeSlotID);
                delete_Occupied($occupiedIDArr1[2]);
            }
            if($rowString_matchArr[2]==2){
                $start_time -= 2;
                $timeSlotID = pushData_TimeSlot($start_time, $end_time, $day);
                $start_time += 2;
                update_Occupied($occupiedIDArr2[2], $timeSlotID);
                delete_Occupied($occupiedIDArr1[2]);
            }
        }             // Resolve 'Conducted by ('ICAMS') and (1G & 1s + date) amd (CSL 3 & 4 + SLL) , see saturday yellow slot
        
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
        $query_insert = "INSERT INTO events(EVENT_NAME,EVENT_TYPE,CONDUCT_BY,OPTIONAL_DETAILS,RECURRING) VALUES('$eventName', '$eventType', '$conductBy', 'From timetable', '1')";
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
        $query_insert = "INSERT INTO time_slot (START_TIME, END_TIME, DAY, OPTIONAL_DETAILS) VALUES ('$startTime','$endTime','$day', 'From timetable')";
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

        $query_update = "UPDATE occupied SET ACTIVE = $active WHERE OCCUPY_ID = '$id'";
        $conn->query($query_update);
    }
    else{
        $query = "INSERT INTO occupied (EVENT_ID, RESOURCE_ID, TIME_SLOT_ID, ACTIVE, OPTIONAL_DETAILS) VALUES ('$eventID', '$resource_id', '$timeSlotID', $active, 'From timetable')";
        $conn->query($query);                                           echo"<script>console.log('Resource occupied: $resource for event id-$eventID');</script>";

        $query_check = "SELECT * FROM occupied WHERE EVENT_ID = '$eventID' AND RESOURCE_ID = '$resource_id' AND TIME_SLOT_ID = '$timeSlotID'";
        $result = $conn->query($query_check);
        $row = $result->fetch_assoc();
        $id = $row["OCCUPY_ID"];
    }
    return $id;
}

function update_Occupied($occupiedID, $timeSlotID){
    global $conn;
    $query = "UPDATE occupied SET TIME_SLOT_ID = '$timeSlotID' WHERE OCCUPY_ID = '$occupiedID'";
    $conn->query($query);
}

function delete_Occupied($occupiedID){
    global $conn;
    $query = "DELETE FROM occupied WHERE OCCUPY_ID = '$occupiedID'";
    $conn->query($query);
}

function delete_old_Records(){
    global $conn;
    $query = "DELETE FROM occupied WHERE OPTIONAL_DETAILS = 'From timetable'";
    $conn->query($query);

    $query = "DELETE FROM events WHERE OPTIONAL_DETAILS = 'From timetable'";
    $conn->query($query);

}
    
?>