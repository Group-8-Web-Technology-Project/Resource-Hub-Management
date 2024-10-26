let currentPage = 1;
const rowsPerPage = 4;
let allEvents = "<?php echo json_encode($events); ?>;"
let filteredEvents = [...allEvents];

function renderTable(page) {
    const tableBody = document.getElementById('eventTable');
    tableBody.innerHTML = '';

    const startIndex = (page - 1) * rowsPerPage;
    const endIndex = Math.min(startIndex + rowsPerPage, filteredEvents.length);

    for (let i = startIndex; i < endIndex; i++) {
        const event = filteredEvents[i];
        if (event) {
            tableBody.innerHTML += `<tr>
                <td>${event['EVENT_NAME']}</td>
                <td>${event['EVENT_TYPE']}</td>
                <td>${event['CONDUCTED_BY']}</td>
            </tr>`;
        }
    }

    if (filteredEvents.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="3">No data available</td></tr>`;
    }
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        renderTable(currentPage);
    }
}

function nextPage() {
    if ((currentPage * rowsPerPage) < filteredEvents.length) {
        currentPage++;
        renderTable(currentPage);
    }
}

function filterTable() {
    const searchValue = document.getElementById("eventSearch").value.toLowerCase();
    const hallValue = document.getElementById("hallFilter").value;
    const dateValue = document.getElementById("dateFilter").value;

    filteredEvents = allEvents.filter(event => {
        const eventDate = event['EVENT_DATE'];
        const eventHall = event['HALL'];
        const eventName = event['EVENT_NAME'].toLowerCase();

        const isMatch = 
            (eventName.includes(searchValue) || !searchValue) &&
            (eventHall === hallValue || !hallValue) &&
            (eventDate === dateValue || !dateValue);

        return isMatch;
    });

    
    currentPage = 1;
    renderTable(currentPage);
}

document.getElementById("eventSearch").addEventListener("input", filterTable);
document.getElementById("hallFilter").addEventListener("change", filterTable);
document.getElementById("dateFilter").addEventListener("change", filterTable);
function filterTable() {
    const searchValue = document.getElementById("eventSearch").value.toLowerCase();
    const resourceTypeValue = document.getElementById("resourceTypeFilter").value;
    const dateValue = document.getElementById("dateFilter").value;

    const tableRows = document.querySelectorAll("#eventTable tr");
    tableRows.forEach(row => {
        const eventName = row.children[0].textContent.toLowerCase();
        const resourceType = row.children[1].textContent;
        const date = row.children[2].textContent;

        const isMatch =
            (eventName.includes(searchValue) || !searchValue) &&
            (resourceType === resourceTypeValue || !resourceTypeValue) &&
            (date === dateValue || !dateValue);
        
        row.style.display = isMatch ? "" : "none";
    });
}

document.getElementById("eventSearch").addEventListener("input", filterTable);
document.getElementById("resourceTypeFilter").addEventListener("change", filterTable);
document.getElementById("dateFilter").addEventListener("change", filterTable);

renderTable(currentPage);
