<?php
require_once "../../utils/header.php";
require_once "../../utils/admin.php";
include("../../database/connection.php");

$approve_request = "SELECT COUNT(*) AS count FROM request WHERE REQUEST_APPROVED = 1";
$pending_request = "SELECT COUNT(*) AS count FROM request WHERE REQUEST_APPROVED = 0"; 
$declined_request = "SELECT COUNT(*) AS count FROM request WHERE REQUEST_APPROVED = -1"; 
$approved_users_query = "SELECT COUNT(*) AS count FROM user WHERE APPROVED = 1";
$registered_users_query = "SELECT COUNT(*) AS count FROM user";


$approve_count = 0;
$pending_count = 0;
$declined_count = 0;
$active_users = 0;
$registered_users = 0;

$approved_result = mysqli_query($conn, $approve_request);
if ($approved_result) {
    $approve_row = mysqli_fetch_assoc($approved_result);
    $approve_count = $approve_row['count']; 
}

$pending_result = mysqli_query($conn, $pending_request);
if ($pending_result) {
    $pending_row = mysqli_fetch_assoc($pending_result);
    $pending_count = $pending_row['count']; 
}

$declined_result = mysqli_query($conn, $declined_request);
if ($declined_result) {
    $declined_row = mysqli_fetch_assoc($declined_result);
    $declined_count = $declined_row['count']; 
}

$approved_users_query = mysqli_query($conn, $approved_users_query);
if ($approved_users_query) {
    $approve_count_row = mysqli_fetch_assoc($approved_users_query);
    $approve_count = $approve_count_row['count']; 
}

$registered_users_result = mysqli_query($conn, $registered_users_query);
if ($registered_users_result) {
    $registered_users_row = mysqli_fetch_assoc($registered_users_result);
    $registered_users = $registered_users_row['count']; 
}

$total_requests = $approve_count + $pending_count + $declined_count;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>
<script language="javascript" type="text/javascript" src="/path/to/file/src/profile-image.js"></script>
<link rel="stylesheet" href="dashboard_view.css">
<link rel="stylesheet"href='tableStyle.css'>
<script scr="tableFunction.js"></script>
<style>
    
</style>
<body class="dark:bg-slate-900">

    <?php require_once "../../utils/sidebar.php"  ?>

    <div class="p-4 pt-16 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">
            <h1 class="mb-8 text-4xl text-center md:text-left font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-8 dark:text-white">
                Dashboard
            </h1>
            <link rel="stylesheet" href="timelineStyle.css">

                <div class="container">
                    <div class="cards-wrapper">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "resourcehub");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $query = "SELECT * FROM events";
                        $result = mysqli_query($conn, $query);
                        $totalEvents = mysqli_num_rows($result);

                        if ($totalEvents > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="card-item">';
                                echo '<div class="card">';
                                echo '<img src="../../assets/images/flyer.jpg">';
                                echo '<div class="card-content">';
                                echo '<h2>' . $row['EVENT_NAME'] . '</h2>';
                                echo '<p><strong>Type:</strong> ' . $row['EVENT_TYPE'] . '</p>';
                                echo '<p><strong>Conducted By:</strong> ' . $row['CONDUCT_BY'] . '</p>';
                                echo '<p><strong>Details:</strong> ' . (!empty($row['OPTIONAL_DETAILS']) ? $row['OPTIONAL_DETAILS'] : 'N/A') . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="card-item">';
                            echo '<div class="card">';
                            echo '<img src="../../assets/images/flyer.jpg">';
                            echo '<div class="card-content">';
                            echo '<h2>No Events Available</h2>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="dots">
                        <?php
                        for ($i = 0; $i < $totalEvents; $i++) {
                            echo '<span class="dot' . ($i === 0 ? ' active' : '') . '"></span>';
                        }
                        ?>
                    </div>
            </div>
            <script>
                let currentIndex = 0;
                const totalCards = document.querySelectorAll('.card-item').length;
                const dots = document.querySelectorAll('.dot');

                function showCard(index) {
                    const wrapper = document.querySelector('.cards-wrapper');
                    if (index < 0) {
                        index = totalCards - 1;
                    } else if (index >= totalCards) {
                        index = 0;
                    }
                    wrapper.style.transform = `translateX(-${index * 100}%)`;
                    dots.forEach((dot, idx) => {
                        dot.classList.toggle('active', idx === index);
                    });
                    currentIndex = index;
                }

                function nextCard() {
                    showCard(currentIndex + 1);
                }

                setInterval(nextCard, 3000);
            </script>

            <div class="stat-boxes">
                <div class="stat-box">Approved Requests
                    <?php echo $approve_count; ?>
                </div>
                <div class="stat-box">Pending Requests
                    <?php echo $pending_count; ?>
                </div>
                <div class="stat-box">Total Requests
                    <?php echo $total_requests; ?>
                </div>
                <div class="stat-box">Approved Users
                    <?php echo $approve_count; ?>
                </div>
                <div class="stat-box">Registered Users
                    <?php echo $registered_users; ?>
                </div>
            </div>
            
            <script src="view.js"></script>
            <div class="notice-carousel">
                <center><h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Notices</h2></center>
                <div id="noticesContainer">
                    <?php
                        $sql = "SELECT * FROM announcement ORDER BY date DESC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="notice">';
                                    echo '<b><h4>' . htmlspecialchars($row['topic']) . '</h4></b>'; 
                                    echo '<p>' . htmlspecialchars($row['message']) . '</p>';
                                    echo '<p><small>' . htmlspecialchars($row['date']) . '</small></p>';
                                    if($row['status'] == 'notice'){
                                        echo '<p class="text-green-500"><small>' . htmlspecialchars($row['status']) . '</small></p>';
                                    }
                                    if($row['status'] == 'complaint'){
                                        echo '<p class="text-red-500"><small>' . htmlspecialchars($row['status']) . '</small></p>';
                                    }
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No notices available.</p>';
                        }
                    ?>
                </div>
                <button class="add-notice-btn" onclick="openModal()">Add Notice</button>
            </div>
        
            <div class="modal" id="noticeModal">
                <div class="modal-content">
                    <span class="close-modal" onclick="closeModal()">&times;</span>
                    <form action="view.php" method="post" onsubmit="return false;"">
                        <h3 id="modalTitle">Add Notice</h3>
                        <input type="text" id="noticeTitle" name='noticeTitle' placeholder="Topic" required>
                        <textarea id="noticeDescription" rows="3" name='noticeMessage' placeholder="Description" required></textarea>
                        <input type="date" id="noticeDate" name="noticeDate" required>
                        <div>
                            <input type="checkbox" id="isComplaint" name="verifyNC">
                            <label for="isComplaint">Mark as Complaint</label>
                        </div>
                        <button type='button' name='insertNotice' onclick="saveNotice(); closeModal()">Save</button>
                        <?php
                            if(isset($_POST['insertNotice'])){
                                $noticeTitle = $_POST['noticeTitle'];
                                $noticeMessage = $_POST['noticeMessage'];
                                $noticeDate = $_POST['noticeDate'];
                                if(!empty($noticeTitle) && !empty($noticeMessage) && !empty($noticeDate)){
                                    echo "<center><p>Details added successfully<p></center>";
                                    header("Location: view.php");
                                }
                                else{
                                    echo "Please fill all the fields";
                                    header("Location: view.php");
                                }
                            }
                        ?>
                    </form>   
                </div>
            </div>

            <?php
                $resourceTypesQuery = "SELECT DISTINCT RESOURCE_TYPE FROM resource";
                $resourceTypesResult = mysqli_query($conn, $resourceTypesQuery);
            ?>
            <div class="table-container">
                <center><h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Event Overview</h2></center>
                <div class="search-filter">
                    <input type="search" id="eventSearch" placeholder="Search by event name" oninput="filterTable()">
                    <select id="hallFilter" onchange="filterTable()">
                        <option value="">All Resources</option>
                        <?php
                            if (mysqli_num_rows($resourceTypesResult) > 0) {
                                while ($row = mysqli_fetch_assoc($resourceTypesResult)) {
                                    echo "<option value=\"" . $row['RESOURCE_TYPE'] . "\">" . $row['RESOURCE_TYPE'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <input type="date" id="dateFilter" onchange="filterTable()">
                </div>

                <?php
                    $events_query = "SELECT ID, EVENT_NAME, EVENT_TYPE, CONDUCT_BY FROM events";
                    $events_result = mysqli_query($conn, $events_query);
                    $events = [];
                    if (mysqli_num_rows($events_result) > 0) {
                        while ($row = mysqli_fetch_assoc($events_result)) {
                            $events[] = $row;
                        }
                    }
                ?>
                <div class="content-wrapper">
                    <div class="filter-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>TYPE</th>
                                    <th>ORGANIZER</th>
                                </tr>
                            </thead>
                            <tbody id="eventTable">
                                <?php
                                    $row_count = 4;
                                    if (count($events) > 0) {
                                        for ($i = 0; $i < $row_count; $i++) {
                                            if (isset($events[$i])) {
                                                echo "<tr>
                                                        <td>" . $events[$i]['EVENT_NAME'] . "</td>
                                                        <td>" . $events[$i]['EVENT_TYPE'] . "</td>
                                                        <td>" . $events[$i]['CONDUCT_BY'] . "</td>
                                                    </tr>";
                                            } else {
                                                echo "<tr><td colspan='3'>No data available</td></tr>";
                                            }
                                        }
                                    } else {
                                        for ($i = 0; $i < $row_count; $i++) {
                                            echo "<tr><td colspan='3'>No data available</td></tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php if (count($events) > $row_count): ?>
                            <div class="paginationLeft">

                            </div>
                            <div class="paginationRight">
                                <button onclick="prevPage()"><i class="fa fa-chevron-left"></i></button>
                                <button onclick="nextPage()"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="content-wrapper">
                <center><h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Hall Overview</h2></center>
                <?php
                    $resourceQuery = "SELECT DISTINCT RESOURCE_NAME, SEATING FROM resource";
                    $resourceResult = mysqli_query($conn, $resourceQuery);

                    $resourceData = [];
                    $uniqueHalls = [];
                    
                    if (mysqli_num_rows($resourceResult) > 0) {
                        while ($row = mysqli_fetch_assoc($resourceResult)) {
                            $resourceData[] = $row;
                            if (!in_array($row['RESOURCE_NAME'], $uniqueHalls)) {
                                $uniqueHalls[] = $row['RESOURCE_NAME'];
                            }
                        }
                    }

                    $resourceDataJson = json_encode($resourceData);
                    $uniqueHallsJson = json_encode($uniqueHalls);
                ?>

                <div class="mb-4 text-center">
                    <select id="hallFilter" class="p-2 rounded dark:bg-gray-700 dark:text-white bg-gray-200 text-gray-800">
                        <option value="">All Halls</option>
                        <?php foreach ($uniqueHalls as $hall): ?>
                            <option value="<?php echo $hall; ?>"><?php echo $hall; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <canvas id="resourceChart" width="400" height="200"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const resourceData = <?php echo $resourceDataJson; ?>;
                        const uniqueHalls = <?php echo $uniqueHallsJson; ?>;
                        
                        const labels = resourceData.map(resource => resource.RESOURCE_NAME);
                        const seatingData = resourceData.map(resource => resource.SEATING);

                        const colors = [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ];

                        const ctx = document.getElementById('resourceChart').getContext('2d');
                        let resourceChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Seating Capacity',
                                    data: seatingData,
                                    backgroundColor: colors,
                                    borderColor: colors.map(color => color.replace('0.6', '1')),
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: 'black'
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: 'white'
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            color: 'white'
                                        }
                                    }
                                }
                            }
                        });

                        
                        document.getElementById('hallFilter').addEventListener('change', function () {
                            const selectedHall = this.value;

                            
                            let filteredLabels = [];
                            let filteredData = [];

                            
                            if (selectedHall) {
                                resourceData.forEach((resource) => {
                                    if (resource.RESOURCE_NAME === selectedHall) {
                                        filteredLabels.push(resource.RESOURCE_NAME);
                                        filteredData.push(resource.SEATING);
                                    }
                                });
                            } else {
                                
                                filteredLabels = labels;
                                filteredData = seatingData;
                            }

                            
                            resourceChart.data.labels = filteredLabels;
                            resourceChart.data.datasets[0].data = filteredData;
                            resourceChart.update();
                        });
                    });
                </script>
        </div>        
    </div> 
</body>


<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        if (isset($_POST['noticeTitle']) && isset($_POST['noticeMessage']) && isset($_POST['noticeDate'])) {
            $noticeTitle = $_POST['noticeTitle'];
            $noticeMessage = $_POST['noticeMessage'];
            $noticeDate = $_POST['noticeDate'];
            $noticeType = !empty($_POST['verifyNC']) ? 'complaint' : 'notice';

            $noticeTitle = mysqli_real_escape_string($conn, $noticeTitle);
            $noticeMessage = mysqli_real_escape_string($conn, $noticeMessage);
            $noticeType = mysqli_real_escape_string($conn, $noticeType);
            $noticeDate = mysqli_real_escape_string($conn, $noticeDate);
    
            $sql = "INSERT INTO announcement (topic, message, status, date) VALUES ('$noticeTitle', '$noticeMessage', '$noticeType', '$noticeDate')";
            
            if (mysqli_query($conn, $sql)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        }
        exit;
    }
    
?>

