<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-800">
    <div class="bg-gray-200 dark:bg-gray-900 shadow-lg rounded-lg p-3 w-full">
        <div class="flex justify-between items-center mb-4">
            <button id="prev" class="text-black dark:text-white px-4 py-2 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 id="monthYear" class="text-lg font-bold dark:text-white"></h2>
            <button id="next" class="text-black dark:text-white px-4 py-2 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
        <div class="grid grid-cols-7 text-center font-bold mb-2">
            <div class="dark:text-white">Su</div>
            <div class="dark:text-white">Mo</div>
            <div class="dark:text-white">Tu</div>
            <div class="dark:text-white">We</div>
            <div class="dark:text-white">Th</div>
            <div class="dark:text-white">Fr</div>
            <div class="dark:text-white">Sa</div>
        </div>
        <div id="calendar" class="grid grid-cols-7 gap-1.5"></div>
    </div>

    <?php

$events = [
    [
        'title' => 'Meeting with Team',
        'start' => '2024-11-02T10:00:00',
        'end' => '2024-11-02T13:00:00',
        'extendedProps' => [
            'resourceName' => 'CSL - 1 & 2',
            'isRecurring' => 1,
            'fromTimetable' => 1
        ],
    ],
    [
        'title' => 'Breakfast with Team',
        'start' => '2024-11-02T10:00:00',
        'end' => '2024-11-02T13:00:00',
        'extendedProps' => [
            'resourceName' => 'CSL - 1 & 2',
            'isRecurring' => 0,
            'fromTimetable' => 1
        ],
    ],
    [
        'title' => 'Dancing with Team',
        'start' => '2024-11-02T10:00:00',
        'end' => '2024-11-02T13:00:00',
        'extendedProps' => [
            'resourceName' => 'CSA',
            'isRecurring' => 0,
            'fromTimetable' => 0
        ],
    ],
    [
        'title' => 'Lunch with Client',
        'start' => '2024-10-31T13:00:00',
        'end' => '2024-10-31T15:30:00',
        'extendedProps' => [
            'resourceName' => 'CUL - 1',
            'isRecurring' => 0,
            'fromTimetable' => 1
        ],
    ],
    [
        'title' => 'Project Deadline',
        'start' => '2024-10-30T09:00:00',
        'end' => '2024-10-30T11:00:00',
        'extendedProps' => [
            'resourceName' => 'CSL - 1 & 2',
            'isRecurring' => 0,
            'fromTimetable' => 1
        ],
    ],
    [
        'title' => 'Project Dora',
        'start' => '2024-10-29T10:00:00',
        'end' => '2024-10-29T13:00:00',
        'extendedProps' => [
            'resourceName' => 'CSL - 3 & 4',
            'isRecurring' => 0,
            'fromTimetable' => 0
        ],
    ],
    [
        'title' => 'Project Deadline',
        'start' => '2024-10-31T09:00:00',
        'end' => '2024-10-31T11:00:00',
        'extendedProps' => [
            'resourceName' => 'CSL - 1 & 2',
            'isRecurring' => 1,
            'fromTimetable' => 0
        ],
    ],
];


// Store the events array in the session
$_SESSION['events'] = $events;
?>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const monthYear = document.getElementById("monthYear");
    const calendar = document.getElementById("calendar");
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    const events = <?php echo json_encode($events); ?>;

    let currentDate = new Date();

    // Function to format date as YYYY-MM-DD
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Function to check if the day has events
    function isEventDay(year, month, day) {
        const formattedDate = formatDate(new Date(year, month, day));
        return events.some(event => formatDate(new Date(event.start)) === formattedDate);
    }

    // Function to get the start of the week (Sunday)
    function getStartOfWeek(date) {
        const startOfWeek = new Date(date);
        startOfWeek.setDate(date.getDate() - date.getDay()); // Set to previous Sunday
        return startOfWeek;
    }

    // Function to render the calendar
    function renderCalendar() {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        monthYear.textContent = currentDate.toLocaleDateString("en-US", {
            month: "short",
            year: "numeric",
        });

        calendar.innerHTML = ""; // Clear previous days

        // Add blank days for the first row if the month doesn't start on Sunday
        for (let i = 0; i < firstDayOfMonth; i++) {
            const blankCell = document.createElement("div");
            blankCell.classList.add("h-7"); 
            calendar.appendChild(blankCell);
        }

        // Populate the calendar with days
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement("div");
            dayCell.textContent = day;
            dayCell.classList.add(
                "flex", "items-center", "justify-center", "h-7", "border", "border-gray-200", 
                "dark:border-gray-600", "rounded-md", 
                "hover:bg-blue-300",
                "dark:text-white", "dark:hover:bg-blue-500", 
                "cursor-pointer", "transition-all"
            );

            // Check if this day has an event
            if (isEventDay(year, month, day)) {
                dayCell.classList.add("bg-gray-200", "dark:bg-gray-600", "font-bold");
            }

            dayCell.addEventListener("click", function () {
                const selectedDate = new Date(year, month, day);
                const startOfWeek = getStartOfWeek(selectedDate);

                // Send a POST request to calenderPackage.php to set session variables for the week range
                fetch('./../calenderModal/view.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `start=${encodeURIComponent(formatDate(startOfWeek))}`
                })
                .then(() => {
                    // After setting session, reload the page or open the modal directly
                    window.location.href = './../calenderModal/view.php';
                });
            });

            // Highlight today's date
            if (
                day === new Date().getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear()
            ) {
                dayCell.classList.add("bg-blue-400", "dark:bg-blue-400", "text-white", "font-bold");
            }

            calendar.appendChild(dayCell);
        }
    }

    prevButton.addEventListener("click", function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextButton.addEventListener("click", function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    // Initial render
    renderCalendar();
});
</script>
</body>
</html>
