<?php 
require_once "../../database/connection.php";

sync();
function sync(){
    global $events;
    global $conn;

    $query = "
        SELECT EVENT_NAME, EVENT_TYPE, CONDUCT_BY, events.OPTIONAL_DETAILS, 
        RECURRING, OCCUPIED_DATE, ACTIVE, RESOURCE_NAME, START_TIME, END_TIME, DAY FROM occupied 
        INNER JOIN events
            ON occupied.EVENT_ID = events.ID
        INNER JOIN resource 
            ON occupied.RESOURCE_ID = resource.ID
        INNER JOIN time_slot
            ON occupied.TIME_SLOT_ID = time_slot.ID";

    $result = $conn->query($query);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $active = $row["ACTIVE"] == 0 ? false : true;
            $resource = $row["RESOURCE_NAME"];
            $event_title = $row["EVENT_NAME"];
            $isRecurring = $row["RECURRING"];
            $fromTimetable = $row["OPTIONAL_DETAILS"] == "From timetable" ? 1 : 0;

            date_default_timezone_set("Asia/Colombo");
            $start_time = $row["START_TIME"];
            $start_time = date('H:i:s', strtotime("$start_time:00"));
            $end_time = $row["END_TIME"];
            $end_time = date('H:i:s', strtotime("$end_time:00"));
            
            $date = $row["OCCUPIED_DATE"];
            if($date == '' && $active){
                $day = $row["DAY"];
                $currentDate_year = date('Y');
                $currentDate_month = date('m');
                $datesArray = getDates($day, $currentDate_year, $currentDate_month);
                $x=0;
                while(isset($datesArray[$x])){
                    $date  = $datesArray[$x];
                    $start_date_time = $date . "T" . $start_time;
                    $end_date_time = $date . "T" . $end_time;

                    $newEvent = [
                        "title" => $event_title,
                        "start" => $start_date_time,
                        "end" => $end_date_time,
                        "extendedProps" => [
                                "resourceName" => $resource,
                                "isRecurring" => $isRecurring,
                                "fromTimetable" => $fromTimetable
                        ]
                    ];
                    
                    array_push($events, $newEvent);

                    $x++;
                }
            }
            else if($date != '' && $active){
                $start_date_time = $date . "T" . $start_time;
                $end_date_time = $date . "T" . $end_time;

                $newEvent = [
                    "title" => $event_title,
                    "start" => $start_date_time,
                    "end" => $end_date_time,
                    "extendedProps" => [
                            "resourceName" => $resource,
                            "isRecurring" => $isRecurring,
                            "fromTimetable" => $fromTimetable
                    ]
                ];
                
                array_push($events, $newEvent);
            }
        }
        
    }
    else{echo"<script>console.log('Error! No occupied events found in the database.');</script>";}

}

function getDates($weekday, $currentDate_year, $currentDate_month){
    $datesArray = [];

    for($month=$currentDate_month; $month<=12; $month++){
        for($i=1; $i<=31; $i++){
            $i<=9 ? $i_="0".$i : $i_=$i;
            $ddd = $currentDate_year . "-" . $month . "-" . $i_;
        
            if(checkdate($month, $i_, $currentDate_year)){
                $date = date('l', $time = strtotime($ddd));
                if($date == $weekday){
                    array_push($datesArray, $ddd);
                }
            }
        }
    }
    
    return $datesArray;
}

?>