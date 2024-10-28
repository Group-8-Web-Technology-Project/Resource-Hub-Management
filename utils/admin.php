<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["user_type"])){
    if($_SESSION["user_type"] != "ADMIN" && $_SESSION["user_type"] != "SUPER_ADMIN"){
        header("Location: ../dashboard/user.home.view.php");
        return;
    }
}



?>