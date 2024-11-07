<?php
$conn = mysqli_connect("localhost", "root", "", "resource");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $noticeId = $_GET['id'];
    $deleteQuery = "DELETE FROM announcement WHERE id = $noticeId";
    
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Notice deleted successfully.";
        header("Location: view.php");
        exit;
    } else {
        echo "Error deleting notice: " . mysqli_error($conn);
    }
} else {
    echo "No notice ID provided.";
}
?>
