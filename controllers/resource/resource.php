<?php
require_once "../../database/connection.php";

if(isset($_GET["edit"])){
  $data = json_decode(file_get_contents("php://input"),true);
  $resource_name = addslashes($_POST["resource_name"]);
  $resource_type = $_POST["resource_type"];
  $optional_details = addslashes($_POST["optional_details"]);
  $building_name = addslashes($_POST["building_name"]);
  $seating = $_POST["seating"];
  $id = $_POST["id"];

  $query = "UPDATE resource SET RESOURCE_NAME = '$resource_name', RESOURCE_TYPE = '$resource_type', OPTIONAL_DETAILS = '$optional_details', BUILDING_NAME = '$building_name', SEATING = '$seating' WHERE ID = '$id'";

  $result = $conn->query($query);

  if($result){
    echo "success";
  }else{
    echo "false";
  }



  return;
}

if(isset($_GET["search"])){
    $search = $_GET["search"];
    $limit = 3;
    if(isset($_GET["limit"])){
      $limit = $_GET["limit"];
    }
    $subSql='LIMIT 3';
    if(isset($_GET["page"])){
        $page = $_GET["page"];
        $offset = ($page-1)*$limit;
        $subSql = "LIMIT $limit OFFSET $offset;";
    }

    $count = "SELECT COUNT(*) AS total FROM resource WHERE RESOURCE_NAME LIKE '%$search%' OR RESOURCE_TYPE LIKE '%$search%' OR OPTIONAL_DETAILS LIKE '%$search%' OR BUILDING_NAME LIKE '%$search%' OR SEATING LIKE '%$search%'";

    $query = "SELECT * FROM resource WHERE RESOURCE_NAME LIKE '%$search%' OR RESOURCE_TYPE LIKE '%$search%' OR OPTIONAL_DETAILS LIKE '%$search%' OR BUILDING_NAME LIKE '%$search%' OR SEATING LIKE '%$search%' $subSql";



    $result = $conn->query($query);

    $resources = array();
    $response = array();

    while($row = $result->fetch_assoc()){
        array_push($resources,$row);
    }

    $response["data"] = $resources;

    if(isset($page)){
      $response["total"] = $conn->query($count)->fetch_assoc()["total"];
      $response["page"] = $page;
      $response["offset"] = $offset;
    }




    echo json_encode($response);


    return;
}


if(isset($_GET["delete"])){
    $id = $_GET["id"];
    $queryDelete = "DELETE FROM `occupied` WHERE RESOURCE_ID = '$id'";
    $resultDelete = $conn->query($queryDelete);
    $conn->query("DELETE FROM request WHERE RESOURCE_ID='$id'");
    $query = "DELETE FROM resource WHERE ID = '$id'";
    $result = $conn->query($query);
    if($result){
        echo "success";
    }else{
        echo "false";
    }
    return;
}


if(isset($_GET["deallocate"])){
    $eventID = $_GET["eventID"];
    $resourceID = $_GET["resourceID"];
    $timeSlotID = $_GET["timeSlotID"];

    $query = "DELETE FROM occupied WHERE EVENT_ID = '$eventID' AND RESOURCE_ID = '$resourceID' AND TIME_SLOT_ID = '$timeSlotID'";

    $result = $conn->query($query);

    if($result){
        echo "success";
    }else{
        echo "false";
    }

    return;
}



// get data from input stream 
$data = json_decode(file_get_contents("php://input"),true);

$resource_name = addslashes($_POST["resource_name"]);
$resource_type = $_POST["resource_type"];
$optional_details = addslashes($_POST["optional_details"]);
$building_name = addslashes($_POST["building_name"]);
$seating = $_POST["seating"];


//upload the image 
$target_dir = "../../assets/images/";
$uid = uniqid();
$target_file = $target_dir .  basename($uid."-".$_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  // echo "Sorry, file already exists.";
  $uploadOk = 0;
}



// Allow certain file formats
if($imageFileType != "jpg") {
  // echo "Sorry, only JPG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  return;
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

} else {
    return;
  }
}


// insert data to database

$query = "INSERT INTO resource(RESOURCE_NAME,RESOURCE_TYPE,OPTIONAL_DETAILS,BUILDING_NAME,SEATING,IMAGE) VALUES('$resource_name','$resource_type','$optional_details','$building_name','$seating','$target_file')";

$result = $conn->query($query);

if($result){
    echo "true";
}else{
    echo "false";
}









?>