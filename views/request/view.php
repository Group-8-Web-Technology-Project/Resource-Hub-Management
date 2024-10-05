<?php
    require_once "../../utils/header.php";
    require_once "../../utils/admin.php";
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />

<!-- <link rel="stylesheet" href="../../styles/index.css"> -->

<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>


<script language="javascript" type="text/javascript" src="/path/to/file/src/profile-image.js"></script>



<body class="dark:bg-slate-900">

    <?php require_once "../../utils/sidebar.php"  ?>

    <input type="hidden" id="loading" name="loading">

    <div class="p-4 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">

            <h1
                class="mb-8 text-4xl text-center md:text-left  font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-8 dark:text-white">
                Resource Allocation Requests</h1>

            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search For Requests" onkeyup="search()">

            </div>

            <div class="w-full m-auto" id="resource-list" style="margin:3rem auto;">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    REQUEST ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    USER NAME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    RESOURCE NAME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    EVENT NAME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TIME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    REQUEST DATE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    PRIORITY
                                </th>
                                <th scope="col" class="px-6 py-3 h-12 flex justify-center items-end  " >
                                    <button href="" class="text-center justify-center items-center" onclick="search()">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="requests">

                           
                        </tbody>
                    </table>

                </div>
                <div class="flex flex-col items-center mt-7" id="pagination">
                    <!-- Help text -->


                </div>
            </div>

        </div>




        <div id="view-modal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-8xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" onclick="viewModal.hide()"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-resource-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <form id="approveForm" class="space-y-6" action="#">
                            <div class="grid xl:grid-cols-3 divide-x">
                                <div>
                                    <div class="m-4 text-gray-500 dark:text-white text-xl">Request Details</div>

                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                            ID</label>
                                        <input type="text" name="resource_name" id="request_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required disabled>
                                    </div>

                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                                            Time</label>
                                        <input type="text" name="resource_name" id="start_time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="start_time" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                            Time</label>
                                        <input type="text" name="resource_name" id="end_time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="end_time" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                            Date</label>
                                        <input type="text" name="resource_name" id="request_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="request_date" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approved</label>
                                        <input type="text" name="resource_name" id="approved"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="approved" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                                        <input type="text" name="resource_name" id="priority"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="priority" required disabled>
                                    </div>
                                    <div class="flex items-center" id="msg_wrapper">
                                        <div id="overlap_msg" class="mr-auto">

                                        </div>

                                    </div>





                                    <!-- <button id="resource_form_submit"
                                        class="text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                                        Save Changes
                                    </button> -->
                                </div>
                                <div>
                                    <div class="m-4 text-gray-500 text-xl dark:text-white">Event Details</div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                            Name</label>
                                        <input type="text" name="event_name" id="event_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="event_name" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                            Type</label>
                                        <input type="text" name="event_type" id="event_type"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="event_type" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conduct
                                            By</label>
                                        <input type="text" name="resource_name" id="conduct_by"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="conduct_by" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recurring</label>
                                        <input type="text" name="resource_name" id="recurring"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="recurring" required disabled>
                                    </div>
                                    <div class="m-4 text-gray-500 text-xl">User Details</div>

                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                            Name</label>
                                        <input type="text" name="resource_name" id="user_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="user_name" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                            Type</label>
                                        <input type="text" name="resource_name" id="user_type"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="user_type" required disabled>
                                    </div>
                                    <input type="hidden" id="resource_id">
                                    <input type="hidden" id="event_id">
                                    <input type="hidden" id="time_slot_id">

                                </div>
                                <div>
                                    <div class="m-4 text-gray-500 text-xl dark:text-white">Resource Details</div>

                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resource
                                            Name</label>
                                        <input type="text" name="event_name" id="resource_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="resource_name" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resource
                                            Type</label>
                                        <input type="text" name="event_type" id="resource_type"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="resource_type" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Building
                                            Name</label>
                                        <input type="text" name="resource_name" id="building_name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="building_name" required disabled>
                                    </div>
                                    <div class="m-4">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seating</label>
                                        <input type="text" name="resource_name" id="seating"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="seating" required disabled>
                                    </div>
                                    <div class="m-4">

                                        <label for="message"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                            Message</label>
                                        <textarea name="request_message" rows="11" required id="request_message"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Write the Purpose and Describe the Event to be Conduct"></textarea>

                                    </div>

                                    <div id="request_btn">
                                        <div style="width:95%;margin:auto 2.5%;"
                                            class="flex flex-col xl:inline-grid grid-cols-2 mx-auto mt-5">
                                            <button onclick="approve()" id="approve_request"
                                                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                                                <i class="fa-solid fa-check mr-2 "></i>
                                                Approve Request
                                            </button>
                                            <button onclick="decline_modal();" id="resource_form_submit"
                                                class="text-white  bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                                                <i class="fa-solid fa-xmark mr-2"></i>
                                                Decline Request
                                            </button>
                                        </div>
                                    </div>

                                </div>


                            </div>
                    </div>
                    <div class="grid grid-cols-3">
                        <div></div>
                        <div></div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    
    <div id="decline-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" onclick="declineModal.hide()"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="add-resource-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Decline the Resource Request</h3>
                       
                        <div>

                            <label for="message"
                                class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Please provide an explanation for the rejection</label>
                            <textarea name="decline_message" rows="4"
                                class="block p-2.5 mb-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>

                        </div>



                        <button onclick="decline()" id="decline_request"
                                                class="text-white w-full bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                                                <i class="fa-solid fa-xmark mr-2"></i>
                                                Decline Request
                        </button>

                </div>
            </div>
        </div>
    </div>
















</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
<script>
document.getElementById("approveForm").addEventListener("click", function(e) {
    e.preventDefault();

})


const $targetEl = document.getElementById('view-modal');
const viewModal = new Modal($targetEl, {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: function() {
        document.getElementById("overlap_msg").innerHTML = "";
    },
    onShow: function() {
        checkAvailability()
    }
});


const declineModal = new Modal(document.getElementById('decline-modal'), {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: function() {
        document.getElementById("overlap_msg").innerHTML = "";
    },
    onShow: function() {
        checkAvailability()
    }
});

</script>

<script>
function search(page = 1) {
    let searchQuery = document.getElementById("search").value;
    axios.get(`../../controllers/request/request.php?search=${searchQuery}&page=${page}`)
        .then(res => {
            let html = ""
            let pagination = Math.ceil(res.data?.total / 10);

            let paginationHtml =
                `
                    <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">${res.data.offset+1}</span> to <span
                    class="font-semibold text-gray-900 dark:text-white">${res.data.offset+res.data.data.length}</span> of <span
                    class="font-semibold text-gray-900 dark:text-white">${res.data.total}</span> Entries
            </span>
            <div class="inline-flex mt-2 xs:mt-0">
                <!-- Buttons -->
                <button
                    class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    onclick="search(${parseInt(res.data.page)-1})"
                    ${res.data.offset==0?"disabled":""}
                    >
                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    Prev
                </button>
                <button
                    class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    onclick="search(${parseInt(res.data.page)+1})"
                    ${parseInt(res.data.total)==res.data.offset+res.data.data.length?"disabled":""}
                    >
                    Next
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>
                    
            `

            document.getElementById("pagination").innerHTML = paginationHtml;

            res.data.data.forEach(request => {

                let className =
                    "bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                switch (request.PRIORITY) {
                    case "2":
                        request.PRIORITY = "High";
                        className =
                            "bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                        break;
                    case "1":
                        request.PRIORITY = "Medium";
                        className =
                            "bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                        break;
                    case "0":
                        request.PRIORITY = "Low";
                        className =
                            "bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                        break;
                }

                html +=
                    `
            	<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                	<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    	${request.REQUEST_ID}
                	</th>
                	<td class="px-6 py-4">
                    	${request.USER_NAME}
                	</td>
                	<td class="px-6 py-4">
                    	${request.RESOURCE_NAME}
                	</td>
                	<td class="px-6 py-4">
                    	${request.EVENT_NAME}
                	</td>
                	<td class="px-6 py-4">
                    	${request.START_TIME}:00 - ${request.END_TIME}:00
                	</td>
                	<td class="px-6 py-4">
                    	${request.REQUEST_DATE?request.REQUEST_DATE:"-"}
                	</td>
                	<td class="px-6 py-4">
                        <span class="${className}">${request.PRIORITY}</span>
                	</td>
                	<td class="px-6 py-4 text-right">
                    	<a href="#" onclick="loadRequestInfo(${request.REQUEST_ID})" class="font-medium text-green-400 dark:text-green-500 hover:underline">View</a>
                	</td>
            	</tr>
            	`
            })
            document.getElementById("requests").innerHTML = html;
        })


}


window.addEventListener("DOMContentLoaded", () => {
    search()
})
</script>



<script>
function loadRequestInfo(id) {
    axios.get(`../../controllers/request/request.php?id=${id}`)
        .then(res => {
            const data = res.data.data;
            console.log(data)

            document.getElementById("request_id").value = data.REQUEST_ID;
            document.getElementById("resource_id").value = data.RESOURCE_ID;
            document.getElementById("event_id").value = data.EVENT_ID;
            document.getElementById("time_slot_id").value = data.TIME_SLOT_ID;
            document.getElementById("user_name").value = data.USER_NAME;
            document.getElementById("resource_name").value = data.RESOURCE_NAME;
            document.getElementById("event_name").value = data.EVENT_NAME;
            document.getElementById("start_time").value = data.START_TIME + ":00";
            document.getElementById("end_time").value = data.END_TIME + ":00";
            document.getElementById("request_date").value = data.REQUEST_DATE;

            let priority = "LOW"
            switch (data.PRIORITY) {
                case "2":
                    priority = "HIGH";
                    break;
                case "1":
                    priority = "MEDIUM";
                    break;
                case "0":
                    priority = "LOW";
                    break;
            }

            document.getElementById("priority").value = priority;
            document.getElementById("event_type").value = data.EVENT_TYPE;
            document.getElementById("conduct_by").value = data.CONDUCT_BY;
            document.getElementById("recurring").value = data.IS_RECURRING == 0 ? "No" : "Yes";
            document.getElementById("user_type").value = data.USER_TYPE;
            document.getElementById("resource_type").value = data.RESOURCE_TYPE;
            document.getElementById("building_name").value = data.BUILDING_NAME;
            document.getElementById("seating").value = data.SEATING;
            document.getElementById("approved").value = data.REQUEST_APPROVED == 0 ? "No" : data.REQUEST_APPROVED == 1? "Yes":"Declined";
            document.getElementById("request_message").value = data.REQUEST_MESSAGE;

            if (data.REQUEST_APPROVED == 1 || data.REQUEST_APPROVED == -1) {
                document.getElementById("request_btn").style.display = "none";
                document.getElementById("msg_wrapper").style.display = "none";
            } else {
                document.getElementById("request_btn").style.display = "flex";
                document.getElementById("msg_wrapper").style.display = "flex";
            }

            viewModal.show();





        })
}
</script>

<script>
function checkAvailability() {
    const start_time = document.getElementById("start_time");
    const end_time = document.getElementById("end_time");
    const resource_id = document.getElementById("resource_id");
    const date = document.getElementById("request_date");
    const request_id = document.getElementById("request_id");

    const overlap_msg = document.getElementById("overlap_msg");

    if (parseInt(start_time.value) > parseInt(end_time.value)) {
        overlap_msg.innerHTML = "Invalid Time Detected";

        return;
    }

    axios.get("../../controllers/util/checkAvailability.php?check", {
        params: {
            start_time: start_time.value.split(':')[0],
            end_time: end_time.value.split(':')[0],
            date: date.value,
            resource_id: resource_id.value,
            request_id: request_id.value
        }
    }).then(res => {
        console.log(res.data)
        if (res.data.length > 0) {
            overlap_msg.innerHTML = "<p class='text-red-600 ml-4'>Possible Overlap Detected</p>";



        } else {

            overlap_msg.innerHTML = "<p class='text-green-400 mb-2 ml-4'>No Overlap Detected</p>";
        }
    });

}
</script>



<script>
function approve() {
    const time_slot_id = document.getElementById("time_slot_id");
    const resource_id = document.getElementById("resource_id");
    const event_id = document.getElementById("event_id");
    const request_id = document.getElementById("request_id");
    const date = document.getElementById("request_date");
    const recurring = document.getElementById("recurring");
    const approve_request = document.getElementById("approve_request");

    approve_request.innerHTML = "<i class='fas fa-circle-notch fa-spin mr-2'></i> Approving...";
    axios.post("../../controllers/request/request.php?approve", {
        time_slot_id: time_slot_id.value,
        resource_id: resource_id.value,
        event_id: event_id.value,
        request_id: request_id.value,
        date: date.value,
        recurring: recurring.value
    }).then(res => {
        console.log(res.data == "overlap")
        if (res.data == "overlap") {
            new Notify({
                title: 'Error',
                text: "Event Overlap Detected",
                effect: 'slide',
                status: 'error',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        }

        if (res.data == "success") {
            new Notify({
                title: 'Success',
                text: "Request Approved",
                effect: 'slide',
                status: 'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        }
        approve_request.innerHTML = "<i class='fa-solid fa-check mr-2 '></i>Approve Request";
        viewModal.hide();
        search()
    })
}

function decline_modal() {
    viewModal.hide();
    declineModal.show();
}

function decline() {
    const request_id = document.getElementById("request_id");
    const decline_message = document.getElementsByName("decline_message")[0];
    const decline_request = document.getElementById("decline_request");

    decline_request.innerHTML = "<i class='fas fa-circle-notch fa-spin mr-2'></i> Declining...";

    axios.post("../../controllers/request/request.php?decline", {
        request_id: request_id.value,
        decline_message: decline_message.value
    }).then(res => {
        if (res.data == "success") {
            new Notify({
                title: 'Success',
                text: "Request Declined",
                effect: 'slide',
                status: 'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        }
        decline_request.innerHTML = "<i class='fa-solid fa-xmark mr-2'></i>Decline Request";
        viewModal.hide();
        declineModal.hide();
        decline_message.value = "";
        search()
    })
}
</script>