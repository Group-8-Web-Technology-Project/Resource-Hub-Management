<?php

$host = "localhost";
$user = "id21197646_root";
$password = "Resourcehub@123";
$database = "id21197646_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>