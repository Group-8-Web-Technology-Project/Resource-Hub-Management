<?php

require_once "../../database/connection.php";
require_once "../util/util.php";

if(isset($_GET["email"])){
    isEmailExists($conn,$_GET["email"]);
    
}else if (isset($_GET["studentID"])){
    isStudentIDExists($conn,$_GET["studentID"]);
}






?>