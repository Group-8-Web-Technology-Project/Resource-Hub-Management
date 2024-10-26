function openModal() {
    const modal = document.getElementById("noticeModal");
    modal.style.display = "block"; 
}


function closeModal() {
    const modal = document.getElementById("noticeModal");
    modal.style.display = "none";
    resetModalFields();
}


function resetModalFields() {
    document.getElementById("noticeTitle").value = ""; 
    document.getElementById("noticeDescription").value = ""; 
    document.getElementById("noticeDate").value = ""; 
    document.getElementById("isComplaint").checked = false; 
}


function saveNotice() {
    const title = document.getElementById("noticeTitle").value;
    const description = document.getElementById("noticeDescription").value;
    const date = document.getElementById("noticeDate").value;
    const isComplaint = document.getElementById("isComplaint").checked;

    
    if (!title || !description || !date) {
        alert("Please fill in all fields!");
        return;
    }

    
    const formData = new FormData();
    formData.append('noticeTitle', title);
    formData.append('noticeMessage', description);
    formData.append('noticeDate', date);
    formData.append('verifyNC', isComplaint ? 'on' : 'off'); 

    
    fetch('view.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            closeModal(); 
            addNoticeToUI(title, description, date, isComplaint); 
            alert('Notice added successfully.');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}



function addNoticeToUI(title, description, date, isComplaint) {
    const noticesContainer = document.getElementById("noticesContainer");
    const noticeDiv = document.createElement("div");
    noticeDiv.className = "notice";
    noticeDiv.innerHTML = `
        <strong>${title}</strong><br>
        ${description}<br>
        <small>${date}</small>
        <span style="color: ${isComplaint ? 'red' : 'black'};">${isComplaint ? 'Complaint' : ''}</span>
    `;
    noticesContainer.appendChild(noticeDiv);
}

window.onclick = function(event) {
    const modal = document.getElementById("noticeModal");
    if (event.target === modal) {
        closeModal();
    }
};

window.onkeydown = function(event) {
    if (event.key === "Escape") {
        closeModal();
    }
};
