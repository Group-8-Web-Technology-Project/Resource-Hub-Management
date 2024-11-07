<?php

$host = "localhost";
$user = "csc210user";
$password = "CSC210!";
$database = "group8";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>