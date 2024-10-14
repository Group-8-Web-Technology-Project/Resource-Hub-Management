<?php
require_once 'vendor/autoload.php';
require_once '../database/connection.php';

$client = new \Google_Client();
$client->setApplicationName('SheetsToResourceHub');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/');

$service = new Google_Service_Sheets($client);
$spreadsheetId = "16VWcYsOrCBhZDV-1Hg79bhvDCH8cEDL0k_yJM40xR2I";

$range = "Timetable!B4:D6";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

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