<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../../assets/icons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../../assets/icons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../assets/icons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../../assets/icons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../assets/icons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../../assets/icons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../../assets/icons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../../assets/icons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../assets/icons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../../assets/icons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../assets/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../../assets/icons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../assets/icons/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../styles/index.css">
    <title>ResourceHub</title>
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["user_id"])){
    header("Location: ../login/view.php");
    return;
}







?>
    
</body>
</html>

