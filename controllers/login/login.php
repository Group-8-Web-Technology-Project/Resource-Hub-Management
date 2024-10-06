<?php

require_once "../../database/connection.php";
require_once "../util/util.php";
require_once "../../email/index.php";


if(isset($_GET["login"])){

    $data = json_decode(file_get_contents("php://input"),true);


    $email = $data["email"];
    $password = $data["password"];

    $query = "SELECT * FROM user WHERE USER_EMAIL='$email'";

    $result = $conn->query($query);

    if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(!password_verify($password,$row["USER_PASSWORD"])){
            echo "wrong";
             return;
         }

        $query = "SELECT * FROM user WHERE USER_EMAIL='$email' AND VERIFIED=0 ";

        $res = $conn->query($query);

        if($res && $res->num_rows > 0){
            echo "unverified";
            return;
        }

        $query ="SELECT * FROM user WHERE USER_EMAIL='$email' AND APPROVED=1 ";


        $res = $conn->query($query);

        if($res && $res->num_rows > 0){
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["user_id"] = $row["USER_ID"];
            $_SESSION["user_name"] = $row["USER_NAME"];
            $_SESSION["user_email"] = $row["USER_EMAIL"];
            $_SESSION["user_type"] = $row["USER_TYPE"];

            echo "success";

            return;
        }
        echo "notapproved";

       
        
    }else{

        echo "wrong";

    }

    return;
}


if(isset($_GET['register'])){


    $data=json_decode(file_get_contents("php://input"),true);

    $username = $data["username"];
    $email = $data["email"];
    $account_type = $data["account_type"];
    $password = $data["password"];
    $studentID = $data["student_id"];
    $password = password_hash($password,PASSWORD_DEFAULT);


    $invalid = false;
    

    if(isEmailExists($conn,$email)==true){
        $invalid = true;
    }
    if($account_type == "STUDENT"){
        $studentID = $data["student_id"];
        if(isStudentIDExists($conn,$studentID)){
            $invalid = true;
        }
    }else{
        $studentID = "";
    }
    
    if($invalid){
        echo "false";
        return;
    }
  
    $query = "INSERT INTO user (USER_NAME, USER_EMAIL, STUDENT_ID, USER_PASSWORD, USER_TYPE) VALUES ('$username', '$email', '$studentID', '$password', '$account_type')";
    $result = $conn->query($query);
    
    if($result){
        echo "success";
        confirmEmail($email,$username,"Abcdefghijklmnopqrstuvwxyz1234567890");
    }else{
        echo "false";
    }

    return;
}

if(isset($_GET["logout"])){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    $_SESSION = array();
    header("Location: ../../views/login/view.php");
    return;
}

function generateRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
if(isset($_GET["reset_request"])){
    $data=json_decode(file_get_contents("php://input"),true);
    $email = $data["email"];
    $query = "SELECT * FROM user WHERE USER_EMAIL='$email'";
    $result = $conn->query($query);
    if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        $uid = $row["USER_ID"];
        $username = $row["USER_NAME"];
        $email = $row["USER_EMAIL"];
        $token = generateRandomString(30);
        $query = "INSERT INTO reset_token (USER_ID, TOKEN) VALUES ('$uid', '$token')";
        $result = $conn->query($query);
        if($result){
            resetEmail($email,$username,$token);
            echo "success";
        }else{
            echo "false";
        }
    }else{
        echo "false";
    }
    return;
}


if(isset($_GET['reset'])){
    $data=json_decode(file_get_contents("php://input"),true);
    $password = $data["password"];
    $token = $data["token"];

    $password = password_hash($password,PASSWORD_DEFAULT);

    $query = "SELECT * FROM reset_token WHERE TOKEN='$token'";
    $result = $conn->query($query);
    if($result){
        while($row = $result->fetch_assoc()){
            $uid = $row["USER_ID"];
            $query = "UPDATE user SET USER_PASSWORD='$password' WHERE USER_ID='$uid'";
            $result = $conn->query($query);
            $query = "DELETE user FROM reset_token WHERE USER_ID='$uid'";
            $resultD = $conn->query($query);
            if($result){
                echo "success";
                return;
            }
        }

        
    }else{
        echo "false";
    }
}

?>