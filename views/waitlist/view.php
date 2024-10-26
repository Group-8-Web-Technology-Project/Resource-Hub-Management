<?php
require_once "../../utils/header.php";
require_once "../../utils/admin.php";
include("../../database/connection.php");
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>

<body class="dark:bg-slate-900">
    <?php require_once "../../utils/sidebar.php" ?>

    <div class="p-4 pt-16 sm:ml-64">
        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">
            <h1 class="mb-8 text-4xl text-center md:text-left font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-8 dark:text-white">
                Resource Waitlist
            </h1>

            <?php
            // Add to Waitlist
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_waitlist'])) {
                $user_name = $_POST['user_name'];
                $user_email = $_POST['user_email'];
                $resource_id = $_POST['resource_id'];
                
                $query = "INSERT INTO waitlist (user_name, user_email, resource_id) VALUES ('$user_name', '$user_email', '$resource_id')";
                if (mysqli_query($conn, $query)) {
                    echo "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800'>
                            Successfully added to waitlist!
                        </div>";
                } else {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800'>
                            Error: " . mysqli_error($conn) . "
                        </div>";
                }
            }

            // Display Booked Resources
            $current_date = date("Y-m-d");
            $resource_query = "SELECT r.ID as resource_id, r.RESOURCE_NAME as resource_name, o.OCCUPIED_DATE, 
                            ts.START_TIME, ts.END_TIME
                            FROM resource r
                            JOIN occupied o ON r.ID = o.RESOURCE_ID
                            JOIN time_slot ts ON o.TIME_SLOT_ID = ts.ID
                            WHERE o.ACTIVE = 1 AND o.OCCUPIED_DATE = '$current_date'
                            ORDER BY ts.START_TIME";
            $resource_result = mysqli_query($conn, $resource_query);

            if (mysqli_num_rows($resource_result) > 0) {
                echo "<h2 class='text-2xl font-semibold mb-4 dark:text-white'>Currently Booked Resources</h2>";
                echo "<table class='min-w-full border dark:border-gray-700'>
                        <thead class='bg-gray-50 dark:bg-gray-700'>
                            <tr>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Resource Name</th>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Date</th>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Time Slot</th>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Action</th>
                            </tr>
                        </thead>
                        <tbody class='bg-white dark:bg-gray-800'>";
                while ($resource = mysqli_fetch_assoc($resource_result)) {
                    echo "<tr class='border-b dark:border-gray-700'>
                            <td class='py-3 px-4 dark:text-gray-300'>{$resource['resource_name']}</td>
                            <td class='py-3 px-4 dark:text-gray-300'>{$resource['OCCUPIED_DATE']}</td>
                            <td class='py-3 px-4 dark:text-gray-300'>{$resource['START_TIME']} - {$resource['END_TIME']}</td>
                            <td class='py-3 px-4'>
                                <form method='post' class='inline'>
                                    <input type='hidden' name='resource_id' value='{$resource['resource_id']}'>
                                    <input type='text' name='user_name' placeholder='Your Name' required class='mb-2 p-1 border dark:border-gray-600 rounded-md'>
                                    <input type='email' name='user_email' placeholder='Your Email' required class='mb-2 p-1 border dark:border-gray-600 rounded-md'>
                                    <button type='submit' name='add_to_waitlist' class='p-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600'>Join Waitlist</button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-gray-500 dark:text-gray-400 mt-4'>No resources are currently booked.</p>";
            }

            // Fetch waitlist for display
            $waitlist_query = "SELECT w.user_name, w.user_email, w.timestamp, r.RESOURCE_NAME 
                            FROM waitlist w 
                            JOIN resource r ON w.resource_id = r.ID 
                            ORDER BY w.timestamp";
            $waitlist_result = mysqli_query($conn, $waitlist_query);

            echo "<h2 class='text-2xl font-semibold mb-4 mt-8 dark:text-white'>Waitlist</h2>";
            if (mysqli_num_rows($waitlist_result) > 0) {
                echo "<table class='min-w-full border dark:border-gray-700'>
                        <thead class='bg-gray-50 dark:bg-gray-700'>
                            <tr>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Resource</th>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>User Name</th>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Email</th>
                                <th class='py-2 px-4 border-b text-left dark:text-white'>Joined At</th>
                            </tr>
                        </thead>
                        <tbody class='bg-white dark:bg-gray-800'>";
                while ($row = mysqli_fetch_assoc($waitlist_result)) {
                    echo "<tr class='border-b dark:border-gray-700'>
                            <td class='py-3 px-4 dark:text-gray-300'>{$row['RESOURCE_NAME']}</td>
                            <td class='py-3 px-4 dark:text-gray-300'>{$row['user_name']}</td>
                            <td class='py-3 px-4 dark:text-gray-300'>{$row['user_email']}</td>
                            <td class='py-3 px-4 dark:text-gray-300'>{$row['timestamp']}</td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-gray-500 dark:text-gray-400 mt-4'>No users have joined the waitlist yet.</p>";
            }
            ?>
            <form method="post" action="view.php" class="inline">
                <input type="hidden" name="resource_id" value="RESOURCE_ID_HERE">
                <input type="text" name="user_name" placeholder="Your Name" required class="mb-2 p-1 border dark:border-gray-600 rounded-md">
                <input type="email" name="user_email" placeholder="Your Email" required class="mb-2 p-1 border dark:border-gray-600 rounded-md">
                <button type="submit" name="add_to_waitlist" class="p-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">Join Waitlist</button>
            </form>
        </div>

    </div>
</body>
