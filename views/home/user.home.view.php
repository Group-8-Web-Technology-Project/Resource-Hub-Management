<?php
    require_once "../../utils/header.php";

?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />

<!-- <link rel="stylesheet" href="../../styles/index.css"> -->

<link rel="stylesheet" href="../output.css">


<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script language="javascript" type="text/javascript" src="/path/to/file/src/profile-image.js"></script>

<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>
<body class="dark:bg-slate-900">


    <?php require_once "../../utils/user.sidebar.php"  ?>

    <div class="p-4 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">

            <h1
                class="mb-8 text-4xl text-center md:text-left  font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-8 dark:text-white">
                My Resource Requests</h1>

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
            <div class="flex justify-end ">
                <button onclick="addModal.show()" type="button"
                    class="md:mr-2  w-full md:w-auto  mt-4 md:my-3 my-2   text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add New Request
                </button>
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
                                    APPROVED
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
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
                
    <div id="qr_code" style="width:128px;height:128px;" download>
</div>
            </div>

        </div>
    </div>





    <div id="add-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full md:w-11/12 m-auto 2xl:w-3/5">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" onclick="addModal.hide()"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Allocation Request</h3>
                    <form class="" action="#" id="allocateResourceForm">
                        <div class="grid lg:grid-cols-2 gap-3">
                            <div class="space-y-6">
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                    <input type="date" name="date" id="date_m"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="2023/08/05" required>
                                </div>

                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                        Name</label>
                                    <input type="text" name="search_event" id="search_event"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Search Event" required>
                                    <a id="new_event" class="">
                                        <p class="text-green-400 my-4"> <i class="fa-solid fa-plus mr-1"></i> Create New
                                            Event</p>
                                    </a>
                                </div>

                                <input type="hidden" id="event_id_m" name="event_id">

                                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 " id="event-list">
                                </ul>


                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resource
                                        Name</label>
                                    <input type="text" name="search_resource" id="search_resource"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Search Event" required>
                                </div>

                                <input type="hidden" id="resource_id_m" name="resource_id">

                                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 "
                                    id="resource-data-list">
                                </ul>




                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                                        Time</label>
                                    <input datepicker-format="mm/dd/yyyy" type="time" name="start_time"
                                        id="start_time_m"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="name@company.com" required>
                                </div>


                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                        Time</label>
                                    <input type="time" name="end_time" id="end_time_m"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="name@company.com" required>
                                </div>





                                <div class="flex justify-between ">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" id="is_recurring" name="is_recurring"
                                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                                >
                                        </div>
                                        <label for="remember"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recurring
                                            Event
                                            <span class="font-normal"><br>The Resource will be Allocated on Every <span
                                                    class="font-semibold text-gray-900" id="day"></span></span> </label>
                                    </div>

                                </div>

                                <div class="flex items-center">
                                    <div id="overlap_msg_m" class="mr-auto">

                                    </div>
                                    <button type="button" onclick='
                                                checkAvailability(document.getElementById("start_time_m"),document.getElementById("end_time_m"),document.getElementById("resource_id_m"),document.getElementById("date_m"),document.getElementById("overlap_msg_m"))
                            
                                                '
                                        class="ml-auto text-white m bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Check
                                        Availability</button>
                                </div>


                                <div id="overlap_msg_m" class="mr-auto">

                                </div>





                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                        Name</label>
                                    <input type="text" name="event_name" id="event_name" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Introduction to JS" required>
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conduct
                                        By</label>
                                    <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required>
                                </div>


                                <div>
                                    <label for="countries"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                        Type</label>
                                    <select id="event_type" name="event_type" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option value="Tech Talk">Tech Talk</option>
                                        <option value="Hands On Session">Hands On Session</option>
                                        <option value="General Meeting">General Meeting</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>






                                <div>

                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                        Message</label>
                                    <textarea name="request_message" rows="11"  required
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write the Purpose and Describe the Event to be Conduct"></textarea>

                                </div>

                                <button id="submit_btn_allocate" onclick="requestAllocation()"
                                    class="w-full text-white bg-gradient-to-r mt-8 from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Request Allocation
                                </button>





                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
















</body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>

<script>
const addModal = new Modal(document.getElementById('add-modal'), {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: function() {
        document.getElementById("overlap_msg_m").innerHTML = "";
    },
    onShow: function() {

    }
});
document.getElementById("start_time_m").addEventListener('input', (e) => {
    console.log("🚀 ~ file: user.home.view.php:470 ~ document.getElementById ~ e:", e)
    let hour = e.target.value.split(':')[0]
    e.target.value = `${hour}:00`
})
document.getElementById("end_time_m").addEventListener('input', (e) => {
    let hour = e.target.value.split(':')[0]
    e.target.value = `${hour}:00`
})

function checkEventID(id, name, e) {
    document.getElementsByName('event_id')[0].value = id;
    document.getElementById("search_event").value = name
    document.getElementById("event-list").innerHTML = "";
}

function checkResourceID(id, name, e) {
    document.getElementsByName('resource_id')[0].value = id;
    document.getElementById("search_resource").value = name
    document.getElementById("resource-data-list").innerHTML = "";
}
</script>

<script>



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

                let color ="yellow";
                switch(request.REQUEST_APPROVED){
                    case "1":
                        color = "green";
                        break;
                    case "-1":
                        color = "red";
                        break;
                    default:
                        color = "yellow";
                        break;
                }

                html +=
                    `
            	<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                	<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    	${request.REQUEST_ID}
                	</th>
                	
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
                        <span class="bg-${color}-100 text-${color}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-${color}-900 dark:text-${color}-300">
                    	    ${request.REQUEST_APPROVED==1?"Yes": request.REQUEST_APPROVED==-1?"Declined":"No"}
                        </span>
                	</td>
                	
                	<td class="px-6 py-4 text-right">
                    	${request.REQUEST_APPROVED==1 ? `<a href="#" onclick="loadRequestInfo(<?php echo "'".$_SERVER['SERVER_NAME']."'" ?>,${request.REQUEST_ID})" class="font-medium text-green-400 dark:text-green-500 hover:underline">Download</a>`:""}
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

    
    function loadRequestInfo(hostName,id) {
            document.getElementById("qr_code").style.display = "flex";
            hostName = "https://"+hostName+"/views/approval/view.php?request_id="+id;
            filename = "Approval_QR_"+id+".jpg";

            var qrcode = new QRCode("qr_code", {
                text: `${hostName}`,
                width: 128,
                height: 128,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            var container = document.getElementById("qr_code");; /* full page */
            html2canvas(container, { allowTaint: true }).then(function (canvas) {
                var link = document.createElement("a");
                document.body.appendChild(link);
                link.download = filename;
                link.href = canvas.toDataURL();
                link.target = '_blank';
                link.click();
                document.getElementById("qr_code").style.display = "none";

            });

    
}
</script>

<script>
function checkAvailability(start_time, end_time, resource_id, date, overlap_msg) {



    if (parseInt(start_time.value) >= parseInt(end_time.value) || start_time.value == "" || end_time.value == "") {
        overlap_msg.innerHTML = "<p class='text-red-600 ml-4'>Invalid Time Detected</p>";
        return;
    }

    if (date.value == "") {
        overlap_msg.innerHTML = "<p class='text-red-600 ml-4'>Invalid Date Detected</p>";
        return;
    }

    if (resource_id.value == "") {
        overlap_msg.innerHTML = "<p class='text-red-600 ml-4'>Invalid Resource Detected</p>";
        return;
    }

    axios.get("../../controllers/util/checkAvailability.php?check", {
        params: {
            start_time: start_time.value.split(':')[0],
            end_time: end_time.value.split(':')[0],
            date: date.value,
            resource_id: resource_id.value,
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
document.getElementById("search_event").addEventListener('input', (e) => {
    let search = e.target.value
    let event_list = document.getElementById("event-list")
    if (search == "") {
        event_list.innerHTML = ""
        return;
    }
    axios.get(
        "../../controllers/event/event.php", {
            params: {
                search
            }
        }).then(res => {
        const events = res.data.data;

        let node_list = "";

        let event_id = 1;

        events.forEach(event => {



            node_list += (
                `
                <li class="pb-3 sm:pb-4 hover:divide-gray-400">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            ${event["EVENT_NAME"]}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            ${event["CONDUCT_BY"]}
                                        </p>
                                    </div>
                                    <a
                                        onclick="checkEventID(${event['ID']},'${event['EVENT_NAME']}');"
                                        class="inline-flex items-center text-base cursor-pointer hove:text-blue-400  text-blue-600 dark:text-blue">
                                        ${document.getElementsByName('event_id')[0].value == event["ID"]?"Selected":"Select"}
                                    </a>
                                </div>
                            </li>
                `
            )
        })




        event_list.innerHTML = node_list;
    })
})


document.getElementById("search_resource").addEventListener('input', (e) => {
    let search = e.target.value
    let resource_list = document.getElementById("resource-data-list")
    if (search == "") {
        resource_list.innerHTML = ""
        return;
    }
    axios.get(
        "../../controllers/resource/resource.php", {
            params: {
                search
            }
        }).then(res => {
        const resources = res.data.data;

        let node_list = "";

        let event_id = 1;

        resources.forEach(resource => {



            node_list += (
                `
        <li class="pb-3 sm:pb-4 hover:divide-gray-400">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    ${resource["RESOURCE_NAME"]}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    ${resource["RESOURCE_TYPE"]}
                                </p>
                            </div>
                            <a
                                onclick="checkResourceID(${resource['ID']},'${resource['RESOURCE_NAME']}');"
                                class="inline-flex items-center text-base cursor-pointer hove:text-blue-400  text-blue-600 dark:text-blue">
                                ${document.getElementsByName('resource_id')[0].value == resource["ID"]?"Selected":"Select"}
                            </a>
                        </div>
                    </li>
        `
            )
        })




        resource_list.innerHTML = node_list;
    })
})
</script>


<script>
document.getElementById("new_event").addEventListener("click", function(e) {
    e.preventDefault();
    let event_name = document.getElementById("event_name");
    let event_type = document.getElementById("event_type");
    let conduct_by = document.getElementById("conduct_by");
    let optional_details = document.getElementById("optional_details");

    if (event_name.disabled) {
        event_name.disabled = false;
        event_type.disabled = false;
        conduct_by.disabled = false;
        // optional_details.disabled = false;
        document.getElementById("new_event").innerHTML =
            `<p class="text-red-400 hover:cursor-pointer my-4"> <i class="fa-solid fa-x mr-1"></i> Cancel New Event</p>`;
        document.getElementById("search_event").disabled = true;
         document.getElementById("search_event").value = "";
    } else {
        event_name.disabled = true;
        event_type.disabled = true;
        conduct_by.disabled = true;
        document.getElementById("new_event").innerHTML =
            `<p class="text-green-400 hover:cursor-pointer my-4"> <i class="fa-solid fa-plus mr-1"></i> Create New Event</p>`;
        // optional_details.disabled = true;
        document.getElementById("search_event").disabled = false;

    }

})
</script>


<script>
document.getElementById("allocateResourceForm").addEventListener("submit", function(e) {
    e.preventDefault();

})

function requestAllocation() {
    const form = document.getElementById("allocateResourceForm");
    const formData = new FormData(form);
    const isNewEvent =  document.getElementById("event_name").disabled == false;
    formData.append("isNewEvent",isNewEvent);

    //check for empty fields required
    let empty = false;
    for (var pair of formData.entries()) {
        if (pair[1] == "") {
            console.log(pair);
            if(pair[0]=="event_id" && isNewEvent){
                
            }else{
                 empty = true;
                break;
            }
        }
    }
    
    if (empty) {
        new Notify({
            title: 'Error',
            text: "Please Fill All the Fields",
            effect: 'slide',
            status: 'error',
            speed: 300,
            autoclose: true,
            autotimeout: 3000
        })
        return;
    }
    
    

    if(formData.get("is_recurring")){
        formData.set("is_recurring",1)
    }else{
        formData.set("is_recurring",0)
    }

    axios.post("../../controllers/request/request.php?request_add",formData)
    .then(res=>{
        if(res.data=="success"){
            new Notify({
                title: 'Success',
                text: "Request Placed",
                effect: 'slide',
                status: 'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })

            //reset input
            document.getElementById("allocateResourceForm").reset();
            document.getElementById("event_name").disabled = true;
            document.getElementById("event_type").disabled = true;
            document.getElementById("conduct_by").disabled = true;
            document.getElementById("new_event").innerHTML =
                `<p class="text-green-400 hover:cursor-pointer my-4"> <i class="fa-solid fa-plus mr-1"></i> Create New Event</p>`;
            document.getElementById("search_event").disabled = false;
            document.getElementById("resource_id_m").value = "";
            document.getElementById("event_id_m").value = "";
            document.getElementById("search_event").value = "";
            document.getElementById("search_resource").value = "";
            document.getElementById("overlap_msg_m").innerHTML = "";
            document.getElementById("search").value = "";

            

            addModal.hide();
            search();
        }else{
            new Notify({
                title: 'Error',
                text: "Request Can't be Placed",
                effect: 'slide',
                status: 'error',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        }
    })


}
</script>