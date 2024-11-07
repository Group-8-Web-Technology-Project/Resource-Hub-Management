<?php
$conn = mysqli_connect("localhost", "csc210user", "CSC210!", "group8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $noticeId = $_GET['id'];
    $query = "SELECT * FROM announcement WHERE id = $noticeId";
    $result = mysqli_query($conn, $query);
    $notice = mysqli_fetch_assoc($result);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $noticeTitle = $_POST['noticeTitle'];
        $noticeMessage = $_POST['noticeMessage'];
        $noticeDate = $_POST['noticeDate'];
        $isComplaint = isset($_POST['verifyNC']) ? 'complaint' : 'notice';

        $updateQuery = "UPDATE announcement SET 
                        topic = '$noticeTitle', 
                        message = '$noticeMessage', 
                        date = '$noticeDate', 
                        status = '$isComplaint' 
                        WHERE id = $noticeId";
        
        if (mysqli_query($conn, $updateQuery)) {
            echo "Notice updated successfully.";
            header("Location: view.php");
            exit;
        } else {
            echo "Error updating notice: " . mysqli_error($conn);
        }
    }
} else {
    echo "No notice found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <title>Edit Notice</title>
	<style>
		body {
			background-color: #121212;
			color: #ffffff;         
			font-family: 'Arial', sans-serif;
			display: flex;             
			justify-content: center;   
			align-items: center;     
			height: 100vh;          
			margin: 0;                
		}

		.form-container {
			background-color: #2c2c2c; 
			color: #ffffff;           
			border-radius: 8px;       
			padding: 30px;           
			box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
			width: 400px;             
			max-width: 90%;           
		}

		h2 {
			margin-bottom: 20px;      
			text-align: center;       
		}

		input[type="text"],
		input[type="date"],
		textarea {
			width: 100%;               
			padding: 10px;            
			border: 1px solid #444;   
			border-radius: 4px;       
			margin-bottom: 15px;      
			background-color: #ffffff; 
			color: #333;              
			font-size: 16px;      
		}

		textarea {
			resize: vertical;          
			min-height: 100px;       
		}

		button {
			background-color: #007bff; 
			color: white;              
			padding: 10px 15px;       
			border: none;              
			border-radius: 4px;       
			cursor: pointer;           
			transition: background-color 0.3s; 
			width: 100%;               
			font-size: 16px;          
		}

		button:hover {
			background-color: #0056b3;
		}

		label {
			margin-left: 5px;        
			font-size: 14px;          
			color: #ffffff; 
		}

	</style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Notice</h2>
        <form method="post">
            <input type="text" name="noticeTitle" value="<?php echo htmlspecialchars($notice['topic']); ?>" required placeholder="Notice Title">
            <textarea name="noticeMessage" required placeholder="Notice Message"><?php echo htmlspecialchars($notice['message']); ?></textarea>
            <input type="date" name="noticeDate" value="<?php echo htmlspecialchars($notice['date']); ?>" required>
            <div>
                <input type="checkbox" id="isComplaint" name="verifyNC" <?php echo $notice['status'] == 'complaint' ? 'checked' : ''; ?>>
                <label for="isComplaint">Mark as Complaint</label>
            </div>
            <button type="submit">Update Notice</button>
        </form>
    </div>
</body>
</html>

