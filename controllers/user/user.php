<?php
require_once "../../database/connection.php";
require_once "../../email/confirm.php";


if(isset($_GET["search"])){
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $currUID = $_SESSION["user_id"];
    $currUserType = $_SESSION["user_type"];

    $permissionSQL = "";

    if($currUserType == "ADMIN"){
        $permissionSQL = "AND USER_TYPE != 'ADMIN'";
    }
    
    $search = $_GET["search"];
    $page = $_GET["page"];
    $limit = 10;

    $offset = ($page-1)*$limit;

    $count = 
    "
    SELECT 
    COUNT(*)
    FROM user WHERE (USER_NAME LIKE '%$search%' OR USER_TYPE LIKE '%$search%' OR USER_EMAIL LIKE '%$search%' OR USER_ID LIKE '%$search%' OR STUDENT_ID LIKE '%$search%' OR APPROVED LIKE '%$search%')
    AND (USER_ID != $currUID AND USER_TYPE != 'SUPER_ADMIN' $permissionSQL);
    ";



    $query = 
    "
    SELECT 
    USER_NAME,
    USER_TYPE,
    USER_EMAIL,
    USER_ID,
    STUDENT_ID,
    APPROVED
    FROM user WHERE (USER_NAME LIKE '%$search%' OR USER_TYPE LIKE '%$search%' OR USER_EMAIL LIKE '%$search%' OR USER_ID LIKE '%$search%' OR STUDENT_ID LIKE '%$search%' OR APPROVED LIKE '%$search%')
    AND (USER_ID != $currUID AND USER_TYPE != 'SUPER_ADMIN' $permissionSQL)
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
    $query = 
    "
    SELECT 
    USER_NAME,
    USER_TYPE,
    USER_EMAIL,
    USER_ID,
    STUDENT_ID,
    APPROVED
    
    FROM user WHERE USER_ID=$id
    ";

    $result = $conn->query($query);

    $response = array();

    $response["data"]=$result->fetch_assoc();;

    echo json_encode($response);

    return;
}


if(isset($_GET["reset"])){
    $data = json_decode(file_get_contents("php://input"),true);
    $uid = $data["user_id"];
    $password = $data["password"];
    $password = password_hash($password,PASSWORD_DEFAULT);

    $query = "UPDATE user SET USER_PASSWORD=\"$password\" WHERE USER_ID=$uid";

    $result = $conn->query($query);

    if($result){
      echo "success";
    }else{
      echo "false";
    }
    return;
}

if(isset($_GET["approve"])){
    $uid = $_GET["user_id"];
    $query = "UPDATE user SET APPROVED=1 WHERE USER_ID=$uid";
    $result = $conn->query($query);

    //Get Email and User Name
    $queryEmail = "SELECT USER_EMAIL,USER_NAME FROM user WHERE USER_ID=$uid";
    $resultEmail = $conn->query($queryEmail);
    $row = $resultEmail->fetch_assoc();
    $email = $row["USER_EMAIL"];
    $name = $row["USER_NAME"];

    approveEmail($email,$name);

    if($result){
        echo "success";
      }else{
        echo "false";
      }
      return;
}

if(isset($_GET["delete"])){
    $uid = $_GET["user_id"];

    $queryRequest = "DELETE FROM request WHERE USER_ID=$uid";

    $resultRequest = $conn->query($queryRequest);

    $query = "DELETE FROM user WHERE USER_ID=$uid";

    $result = $conn->query($query);

    if($resultRequest && $result){
        echo "success";
      }else{
        echo "false";
      }
      return;
}

?>