<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['start'])) {
        $_SESSION['weekStartDate'] = $_POST['start'];
    }
}

$weekStartDate = isset($_SESSION['weekStartDate']) ? $_SESSION['weekStartDate'] : '';
$events = isset($_SESSION['events']) ? $_SESSION['events'] : [];
$currentPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : './../home/view.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js"></script>
    <title>Calendar</title>
</head>

<body class="bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Dark mode toggle and close button -->
    <div class="flex p-2 justify-end mr-5">
    <button type="button" id="toggle-button" class="text-gray-300 w-9 h-9 bg-white border border-gray-500 rounded-lg mr-3 dark:bg-gray-800 dark:text-gray-400">
        <i id="toggle-icon" class="fas fa-moon"></i>
    </button>
    <button onclick="closePopup()" type="button" class="text-gray-400 bg-white border border-gray-500 rounded-lg hover:bg-gray-200 w-9 h-9 inline-flex items-center dark:bg-gray-800 dark:hover:bg-gray-600 dark:text-gray-400">
        <svg class="w-6 h-6 ml-1" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

    <div id="calendar" class="bg-white p-4 z-50 dark:bg-gray-900 dark:text-white max-w-full sm:max-w-lg md:max-w-4xl lg:max-w-screen-2xl mx-auto"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const calendarEl = document.getElementById("calendar");

            const isDarkMode = localStorage.getItem('color-theme') === 'dark' || 
                               (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDarkMode) {
                document.documentElement.classList.add('dark');
            }

            // Set toggle button icon based on the current theme
            const toggleButton = document.getElementById("toggle-button");
            toggleButton.querySelector('i').classList.toggle("fa-sun", isDarkMode);
            toggleButton.querySelector('i').classList.toggle("fa-moon", !isDarkMode);

            // Define calendar events
            const events = <?php echo json_encode($events); ?>;
            const weekStartDate = "<?php echo $weekStartDate; ?>";

            // Adjust slot times based on event times
            let slotMinTime = "08:00:00";
            let slotMaxTime = "18:00:00";
            events.forEach(event => {
                const start = event.start ? event.start.split('T')[1] : null;
                const end = event.end ? event.end.split('T')[1] : null;
                if (start && start < slotMinTime) slotMinTime = start;
                if (end && end > slotMaxTime) slotMaxTime = end;
            });

            // Initialize FullCalendar
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "timeGridWeek",
                initialDate: weekStartDate,
                events: events,
                slotMinTime: slotMinTime,
                slotMaxTime: slotMaxTime,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                aspectRatio: 1.35,
                contentHeight: 'auto',
                //dayMaxEventRows: 0,
            });
            calendar.render();

            // Theme toggle button event
            toggleButton.addEventListener("click", () => {
                document.documentElement.classList.toggle('dark');
                const darkModeEnabled = document.documentElement.classList.contains('dark');
                localStorage.setItem('color-theme', darkModeEnabled ? 'dark' : 'light');
                toggleButton.querySelector('i').classList.toggle("fa-sun", darkModeEnabled);
                toggleButton.querySelector('i').classList.toggle("fa-moon", !darkModeEnabled);
            });

            // Close popup function
            document.cookie = "referringPage=<?php echo $currentPage; ?>; path=/";
        });

        function closePopup() {
            const referringPage = getCookie('referringPage');
            if (referringPage) {
                window.location.href = referringPage;
            }
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            return parts.length === 2 ? parts.pop().split(';').shift() : null;
        }
    </script>

    <style>
        /* Custom dark mode styles for FullCalendar */
        .dark .fc-theme-standard {
            background-color: #1a202c;
            color: #e2e8f0;
        }

        .dark .fc-header-toolbar {
            background-color: #2d3748;
            color: #e2e8f0;
        }

        .dark .fc-daygrid-day,
        .dark .fc-timegrid-slot {
            background-color: #2d3748;
        }

        .dark .fc-event {
            background-color: #333333;
            color: #e2e8f0;
        }

        .dark .fc-scrollgrid-section {
            border-color: #4a5568;
        }

        /* Optional: Smooth transition for background color */
        .bg-white {
            transition: background-color 0.3s;
        }

        .dark .bg-white {
            background-color: #2d3748; /* Adjust this if needed */
        }

    </style>
</body>

</html>
