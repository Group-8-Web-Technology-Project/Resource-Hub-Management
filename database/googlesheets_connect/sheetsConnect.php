<?php
require_once 'vendor/autoload.php';
require_once '../database/connection.php';

$client = new \Google_Client();
$client->setApplicationName('SheetsToResourceHub');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$service = new Google_Service_Sheets($client);                          echo'<script>console.log("Starting service...");</script>';
$spreadsheetId = "16VWcYsOrCBhZDV-1Hg79bhvDCH8cEDL0k_yJM40xR2I";        if($service){echo'<script>console.log("Connected!<br>");</script>';}

$table_start = "B4";                                                    echo'<script>console.log("Table start: $table_start<br>");</script>';
$table_end = "S28";                                                     echo'<script>console.log("Table end: $table_end<br>");</script>';
$table_range = "Timetable!$table_start:$table_end";                     echo'<script>console.log("Table range: $table_range<br>");</script>';

function getvalues($range){
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    return $values;
}

function pushdata(){

}
    
function traverse(){

}

foreach ($values as $row){
    if(empty($row[1])){
        $data[1] = "";
    }
    else{
        $data[1] = $row[1];
    }
    $data[0] = $row[0];
    echo "$data[0], $data[1]<br>";
}
?>