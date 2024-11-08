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
        confirmEmail($email,$username);
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

    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT USER_ID FROM reset_token WHERE TOKEN = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $uid = $row["USER_ID"];

        $passStmt = $conn->prepare("SELECT USER_PASSWORD FROM user WHERE USER_ID = ?");
        $passStmt->bind_param("i", $uid);
        $passStmt->execute();
        $passResult = $passStmt->get_result();
        if($passResult->num_rows > 0){
            $passRow = $passResult->fetch_assoc();
            $oldPassword = $passRow["USER_PASSWORD"];

            if(password_verify($password,$oldPassword)){
                echo "same-password";
            } else {
                $updateStmt = $conn->prepare("UPDATE user SET USER_PASSWORD = ? WHERE USER_ID = ?");
                $updateStmt->bind_param("si", $password_hash, $uid);
                if ($updateStmt->execute()) {
                    $deleteStmt = $conn->prepare("DELETE FROM reset_token WHERE USER_ID = ?");
                    $deleteStmt->bind_param("i", $uid);
                    $deleteStmt->execute();
                    echo "success";
                } else {
                    echo "false";
                }
            }
        }
    } else {
        echo "wrong-token";
    }
}

?>