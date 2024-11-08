<?php

require_once "../../database/connection.php";
require_once "../../email/encryption.php";

$code = $_GET['code'];
$email = decrypt($code, 'jhfFUFuf872t389e');
$stmt = $conn->prepare("UPDATE user SET VERIFIED = 1 WHERE USER_EMAIL = ?");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    header("Location: ../../email/success.html");
    exit();
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();

?>