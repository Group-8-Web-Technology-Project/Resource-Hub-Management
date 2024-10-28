let currentPage = 1;
				const rowsPerPage = 4;
				let allRequests = <?php echo json_encode($requests); ?>;
				let filteredRequests = [...allRequests];

				function renderTable(page) {
					const tableBody = document.getElementById('eventTable');
					tableBody.innerHTML = '';

					const startIndex = (page - 1) * rowsPerPage;
					const endIndex = Math.min(startIndex + rowsPerPage, filteredRequests.length);

					for (let i = startIndex; i < endIndex; i++) {
						const request = filteredRequests[i];
						tableBody.innerHTML += `<tr>
							<td>${request.USER_NAME}</td>
							<td>${request.EVENT_NAME}</td>
							<td>${request.RESOURCE_NAME}</td>
							<td>${request.REQUEST_DATE}</td>
							<td>${request.START_TIME}</td>
							<td>${request.END_TIME}</td>
							<td>${request.REQUEST_MESSAGE}</td>
						</tr>`;
					}

					if (filteredRequests.length === 0) {
						tableBody.innerHTML = `<tr><td colspan="7">No data available</td></tr>`;
					}

					updatePaginationControls();
				}

				function updatePaginationControls() {
					const prevButton = document.querySelector('.paginationLeft');
					const nextButton = document.querySelector('.paginationRight');

					prevButton.disabled = currentPage === 1;
					nextButton.disabled = currentPage * rowsPerPage >= filteredRequests.length;
				}

				function prevPage() {
					if (currentPage > 1) {
						currentPage--;
						renderTable(currentPage);
					}
				}

				function nextPage() {
					if ((currentPage * rowsPerPage) < filteredRequests.length) {
						currentPage++;
						renderTable(currentPage);
					}
				}

				function filterTable() {
					const userValue = document.getElementById("userFilter").value.toLowerCase();
					const resourceValue = document.getElementById("resourceFilter").value.toLowerCase();
					const dateValue = document.getElementById("dateFilter").value;

					filteredRequests = allRequests.filter(request => {
						const userName = request.USER_NAME.toLowerCase();
						const resourceName = request.RESOURCE_NAME.toLowerCase();
						const requestDate = request.REQUEST_DATE;

						return (
							(userName === userValue || !userValue) &&
							(resourceName === resourceValue || !resourceValue) &&
							(requestDate === dateValue || !dateValue)
						);
					});

					currentPage = 1;
					renderTable(currentPage);
					updatePaginationControls();
				}

				document.getElementById("userFilter").addEventListener("change", filterTable);
				document.getElementById("resourceFilter").addEventListener("change", filterTable);
				document.getElementById("dateFilter").addEventListener("change", filterTable);

				renderTable(currentPage);