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
        <button type="button" id="toggle-button" class="text-gray-600 w-9 h-9 bg-white border border-gray-500 hover:bg-gray-200 rounded-lg mr-3 dark:bg-gray-800 dark:text-gray-400">
            
        </button>
        <button onclick="closePopup()" type="button" class="text-gray-600 bg-white border border-gray-500 rounded-lg hover:bg-gray-200 w-9 h-9 inline-flex items-center dark:bg-gray-800 dark:hover:bg-gray-600 dark:text-gray-200">
            <svg class="w-6 h-6 ml-1" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="flex justify-start ml-5 gap-5">
        <div class=" flex items-center">
            <span class="box-purple w-4 h-4 inline-block mr-2 rounded"></span>
            <span class="text-color text-gray-900 text-xs dark:text-gray-200">Recurring (Timetable events)</span>
        </div>
        <div class="flex items-center">
            <span class="box-green w-4 h-4 inline-block mr-2 rounded"></span>
            <span class="text-color text-gray-900 text-xs dark:text-white">Occasional (Timetable events)</span>
        </div>
        <div class="flex items-center">
            <span class="box-red w-4 h-4 inline-block mr-2 rounded "></span>
            <span class="text-color text-gray-900 text-xs dark:text-white">Recurring (Special events)</span>
        </div>
        <div class="flex items-center">
            <span class="box-yellow w-4 h-4 inline-block mr-2 rounded"></span>
            <span class="text-color text-gray-900 text-xs dark:text-white">Occasional (Special events)</span>
        </div>
    </div>

    <!-- Calendar display -->
    <div id="calendar" class="bg-white my-4 p-2 z-50 dark:bg-gray-900 dark:text-white max-w-full sm:max-w-lg md:max-w-4xl md:mx-8 lg:max-w-screen-2xl lg:mx-16 mx-auto "></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const calendarEl = document.getElementById("calendar");
            const toggleButton = document.getElementById("toggle-button");
            let isDarkMode = document.documentElement.classList.contains('dark');

            const tooltip = document.createElement('div');
            tooltip.className = 'event-tooltip bg-gray-800 text-white p-2 rounded shadow-lg hidden';
            document.body.appendChild(tooltip);
            
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                toggleButton.innerHTML = `<i class="fa-solid fa-sun fa-xl"><i/>`
            } else {
                document.documentElement.classList.remove('dark');
                toggleButton.innerHTML = `<i class="fa-solid fa-moon fa-xl"><i/>`

            }

            const events = <?php echo json_encode($events); ?>;
            const weekStartDate = "<?php echo $weekStartDate; ?>";

            let slotMinTime = "08:00:00";
            let slotMaxTime = "18:00:00";
            events.forEach(event => {
                const start = event.start ? event.start.split('T')[1] : null;
                const end = event.end ? event.end.split('T')[1] : null;
                if (start && start < slotMinTime) slotMinTime = start;
                if (end && end > slotMaxTime) slotMaxTime = end;
            });

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "timeGridWeek",
                initialDate: weekStartDate,
                events: events,
                slotMinTime: slotMinTime,
                slotMaxTime: slotMaxTime,
                allDaySlot: false,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },
                aspectRatio: 1.35,
                contentHeight: 'auto',
                dateClick: function(info) {
                    const clickedDate = info.dateStr;
                    const eventsOnDate = events.filter(event => event.start.includes(clickedDate));
                    alert(eventsOnDate.length ? `Events on ${clickedDate}: ${eventsOnDate.map(event => event.title).join(", ")}` : "No events on this date.");
                },
                eventMouseEnter: function(info) {
                    const { event } = info;
                    tooltip.innerHTML = `
                        <strong>${event.title}</strong><br>
                        <span>${event.extendedProps.resourceName}</span><br>
                        ${event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - 
                        ${event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                    `;

                    // Adjust tooltip class based on the current theme
                    tooltip.classList.toggle('dark', document.documentElement.classList.contains('dark'));
                    tooltip.classList.toggle('light', !document.documentElement.classList.contains('dark'));

                    tooltip.style.left = `${info.el.getBoundingClientRect().left + window.scrollX + (info.el.offsetWidth / 2) - (tooltip.offsetWidth / 2)}px`;
                    tooltip.style.top = `${info.el.getBoundingClientRect().top + window.scrollY - tooltip.offsetHeight - 10}px`;
                    tooltip.classList.remove('hidden');
                    tooltip.classList.add('visible');
                },
                eventMouseLeave: function() {
                    tooltip.classList.add('hidden');
                },
                eventDidMount: function(info) {

                    info.el.innerHTML = ''; 
                    const eventDetails = document.createElement('div');

                    if (info.event.extendedProps.resourceName) {
                        eventDetails.innerHTML += `<strong>${info.event.extendedProps.resourceName}</strong>`;
                    }
                    //eventDetails.innerHTML += `<br>${info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${info.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

                    // Append the details to the event element
                    info.el.appendChild(eventDetails);
                    applyEventColors(info, isDarkMode);
                },

            });
            calendar.render();

            function applyEventColors(info, darkMode) {
                //darkMode = document.documentElement.classList.contains('dark');
                darkMode =true;
                console.log(darkMode);
                if (info.event.extendedProps.isRecurring == 1 && info.event.extendedProps.fromTimetable == 1) {
                    info.el.style.backgroundColor = darkMode ? "#6c63ff" : "#b3a6ff"; 
                } else if (info.event.extendedProps.isRecurring == 1 && info.event.extendedProps.fromTimetable == 0) {
                    info.el.style.backgroundColor = darkMode ? "#ff6b6b" : "#ff9e9e"; 
                } else if (info.event.extendedProps.isRecurring == 0 && info.event.extendedProps.fromTimetable == 1) {
                    info.el.style.backgroundColor = darkMode ? "#009900" : "#a2e8e4"; 
                } else if (info.event.extendedProps.isRecurring == 0 && info.event.extendedProps.fromTimetable == 0) {
                    info.el.style.backgroundColor = darkMode ? "#e49c01" : "#ffdd96"; 
                }
            }

            toggleButton.addEventListener("click", () => {
                let htmlClasses = document.querySelector('html').classList;
                if (htmlClasses.contains('dark')) {
                    htmlClasses.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    toggleButton.innerHTML = `<i class="fa-solid fa-moon fa-xl"></i>`;
                } else {
                    htmlClasses.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    toggleButton.innerHTML = `<i class="fa-solid fa-sun fa-xl"></i>`;
                }
            });

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
        .event-tooltip {
            position: absolute;
            z-index: 1000;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s;
            transform: translateY(-100%);
        }

        .event-tooltip.visible {
            opacity: 1;
        }
        .event-tooltip.light {
            background-color: #2d3748; 
            color: white; 
            border: 1px solid #4a5568;
        }
        .event-tooltip.dark {
            background-color: white;
            color: black; 
            border: 1px solid #ccc; 
        }
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
        .fc-event {
            font-size: 1rem;
            color: white;
            padding: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dark .fc-event {
            background-color: #333333;
            color: #e2e8f0;
        }
        .dark .fc-scrollgrid-section {
            border-color: #4a5568;
        }

        .bg-white {
            transition: background-color 0.3s;
        }

        .dark .bg-white {
            background-color: #2d3748;
        } 
        .dark .text-color{
            color: white;
        }
        .box-purple { background-color: #6c63ff; }
        .box-red { background-color: #ff6b6b; }
        .box-green { background-color: #009900; }
        .box-yellow { background-color: #e49c01; }
    </style>
</body>
</html>
