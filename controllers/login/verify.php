<?php

require_once "../../database/connection.php";
require_once "../../email/encryption.php";

$code = $_GET["code"];
$email = $code;

$query = "UPDATE user SET  VERIFIED=1 WHERE USER_EMAIL='$email'";
$result = $conn->query($query);

if($result){
    echo "success";
    header("Location: ../../email/success.html");
}else{
    echo "error";
}




?>