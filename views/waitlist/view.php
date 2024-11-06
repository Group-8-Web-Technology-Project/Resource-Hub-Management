<?php
require_once "../../utils/header.php";
require_once "../../utils/admin.php";
include("../../database/connection.php");
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>
<style>
    body.dark {
        background-color: #1e293b;
        color: #f8fafc;
    }

    h1 {
        color: #1e293b;
        font-size: 2.5rem;
        margin-bottom: 16px;
        text-align: center;
        font-weight: 700;
    }

    .dark h1 {
        color: #f8fafc;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #f9fafb;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table.dark {
        background-color: #374151;
    }
	
	
	table td form {
		display: flex;
		align-items: center;
		gap: 8px; /* Add spacing between the input and button */
	}

	table td form input[type="date"] {
		flex: 1; 
		padding: 8px;
		font-size: 0.875rem;
		border: 1px solid #e5e7eb;
		border-radius: 6px;
	}

	table td form button {
		padding: 8px 12px;
		font-size: 0.875rem;
	}

    table th,
    table td {
        padding: 16px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        font-size: 0.9rem;
    }

    table th {
        background-color: #f3f4f6;
        color: #1e293b;
        font-weight: 600;
    }

    table.dark th {
        background-color: #4b5563;
        color: #f9fafb;
    }

    table tr:nth-child(even) {
        background-color: #f3f4f6;
    }

    table.dark tr:nth-child(even) {
        background-color: #4b5563;
    }

    button {
        cursor: pointer;
        font-size: 0.875rem;
		display: flex;
		align-items: space-between;
        font-weight: 600;
        border-radius: 6px;
        padding: 8px 16px;
        transition: background-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    button.bg-blue-500 {
        background-color: #3b82f6;
        color: #ffffff;
    }

    button.bg-blue-500:hover {
        background-color: #2563eb;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    button.bg-gray-500 {
        background-color: #6b7280;
        color: #ffffff;
    }

    button.bg-gray-500:hover {
        background-color: #4b5563;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    #waitlistModal {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(31, 41, 55, 0.8);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    #waitlistModal.show {
        opacity: 1;
        visibility: visible;
    }

    #waitlistModal .modal-content {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 24px;
        max-width: 500px;
        width: 90%;
        position: relative;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    #waitlistModal h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 16px;
    }

    #waitlistModal label {
        display: block;
        font-weight: 500;
        color: #4b5563;
        margin-bottom: 8px;
    }

    #waitlistModal input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.2s ease;
    }

    #waitlistModal input[type="date"]:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
    }

    .dark #waitlistModal .modal-content {
        background-color: #1e293b;
        color: #d1d5db;
    }

    .dark #waitlistModal h2 {
        color: #f8fafc;
    }

    .dark #waitlistModal label {
        color: #9ca3af;
    }

    .dark #waitlistModal input[type="date"] {
        background-color: #374151;
        color: #d1d5db;
        border-color: #4b5563;
    }
    .hidden {
        display: none;
    }

</style>
<body class="dark:bg-slate-900">
    <?php require_once "../../utils/sidebar.php"; ?>

    <div class="p-4 pt-16 sm:ml-64">
       <div class="content-wrapper">
            <h1 class="mb-8 text-4xl text-center md:text-left font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-8 dark:text-white">
                Resource Waitlist
            </h1>
        </div>
		<h2 class="text-2xl font-semibold mt-8 mb-4 dark:text-white">Occupied Halls</h2>
		<div class="content-wrapper">
        <?php
			$host = "localhost";
			$user = "csc210user";
			$password = "CSC210!";
			$database = "group8";

			$conn = new mysqli($host, $user, $password, $database);

			if ($conn->connect_error) {
				die("Connection Failed: " . $conn->connect_error);
			}
			
			$user_id = $_SESSION['user_id'];
			$occupiedQuery = "SELECT 
								r.RESOURCE_NAME AS HALL,
								r.RESOURCE_TYPE AS CATEGORY,
								e.EVENT_NAME AS ONGOING,
								ts.START_TIME AS `FROM`,
								ts.END_TIME AS `TO`,
								o.OCCUPIED_DATE
							FROM 
								occupied o
							JOIN 
								resource r ON o.RESOURCE_ID = r.ID
							JOIN 
								events e ON o.EVENT_ID = e.ID
							JOIN 
								time_slot ts ON o.TIME_SLOT_ID = ts.ID";

			$occupiedResult = mysqli_query($conn, $occupiedQuery);

			if (mysqli_num_rows($occupiedResult) > 0) {
				echo '<table class="min-w-full bg-white dark:bg-slate-800">';
				echo '<thead><tr><th>Hall</th><th>Category</th><th>Ongoing Event</th><th>From</th><th>To</th><th>Occupied Date</th><th>Actions</th></tr></thead>';
				echo '<tbody>';

				while ($row = mysqli_fetch_assoc($occupiedResult)) {
					echo '<tr>';
					echo '<td>' . htmlspecialchars($row['HALL']) . '</td>';
					echo '<td>' . htmlspecialchars($row['CATEGORY']) . '</td>';
					echo '<td>' . htmlspecialchars($row['ONGOING']) . '</td>';
					echo '<td>' . htmlspecialchars($row['FROM']) . '</td>';
					echo '<td>' . htmlspecialchars($row['TO']) . '</td>';
					echo '<td>' . htmlspecialchars($row['OCCUPIED_DATE']) . '</td>';

					echo '<td>';
					echo '<form method="POST" action="" onsubmit="return addToWaitlist(this);">';
					echo '<input type="hidden" name="resource_name" value="' . htmlspecialchars($row['HALL']) . '">';
					echo '<label for="waitlist_date">Date:</label>';
					echo '<input type="date" name="waitlist_date" required>';
					echo '<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Add to Waitlist</button>';
					echo '</form>';
					echo '</td>';
					echo '</tr>';
				}

				echo '</tbody>';
				echo '</table>';
			} else {
				echo "<p class='text-center text-gray-500'>No results found.</p>";
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$user_id = $_SESSION['user_id'];
				$resource_name = $_POST['resource_name'];
				$waitlist_date = $_POST['waitlist_date'];
				$join_time = date("H:i:s");

				$query = "INSERT INTO waitlist (USER_ID, RESOURCE_NAME, JOIN_DATE, JOIN_TIME) VALUES (?, ?, ?, ?)";
				$stmt = mysqli_prepare($conn, $query);
				mysqli_stmt_bind_param($stmt, 'isss', $user_id, $resource_name, $waitlist_date, $join_time);

				if (mysqli_stmt_execute($stmt)) {
					echo "<script>notify('success', 'Successfully added to waitlist.');</script>";
				} else {
					echo "<script>notify('error', 'Failed to add to waitlist: " . mysqli_error($conn) . "');</script>";
				}

				mysqli_stmt_close($stmt);
			}
        ?>
		
		<h2 class="text-2xl font-semibold mt-8 mb-4 dark:text-white">Waitlist</h2>
        <?php
			$waitlistQuery = "SELECT 
								w.JOIN_DATE AS DATE, 
								w.JOIN_TIME AS TIME, 
								r.RESOURCE_NAME AS RESOURCE,
								u.USER_NAME AS USER
							  FROM waitlist w
							  JOIN resource r ON w.RESOURCE_NAME = r.RESOURCE_NAME
							  JOIN user u ON w.USER_ID = u.USER_ID";

			$waitlistResult = mysqli_query($conn, $waitlistQuery);

			if (mysqli_num_rows($waitlistResult) > 0) {
				echo '<table class="min-w-full bg-white dark:bg-slate-800">';
				echo '<thead><tr><th>Date</th><th>Time</th><th>Resource</th><th>User</th></tr></thead>';
				echo '<tbody>';

				while ($row = mysqli_fetch_assoc($waitlistResult)) {
					echo '<tr>';
					echo '<td>' . htmlspecialchars($row['DATE']) . '</td>';
					echo '<td>' . htmlspecialchars($row['TIME']) . '</td>';
					echo '<td>' . htmlspecialchars($row['RESOURCE']) . '</td>';
					echo '<td>' . htmlspecialchars($row['USER']) . '</td>';
					echo '</tr>';
				}

				echo '</tbody>';
				echo '</table>';
			} else {
				echo "<p class='text-center text-gray-500'>No waitlisted resources found.</p>";
			}
        ?>
    </div>

    <script>
        function addToWaitlist(form) {
            const formData = new FormData(form);
            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("Successfully added")) {
                    new Notify({
                        status: 'success',
                        title: 'Success',
                        text: 'Successfully added to waitlist.',
                        effect: 'fade',
                        speed: 300,
                        autoclose: true,
                        autotimeout: 2000,
                        position: 'right top'
                    });
                } else {
                    new Notify({
                        status: 'error',
                        title: 'Error',
                        text: 'Failed to add to waitlist.',
                        effect: 'fade',
                        speed: 300,
                        autoclose: true,
                        autotimeout: 2000,
                        position: 'right top'
                    });
                }
            })
            .catch(error => console.error('Error:', error));
            return false;
        }
    </script>
</body>
