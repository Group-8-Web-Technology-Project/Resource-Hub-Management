<?php
    require_once "../../utils/header.php";
    require_once "../../utils/admin.php";
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />

<!-- <link rel="stylesheet" href="../../styles/index.css"> -->

<link rel="stylesheet" href="../output.css">

<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>
<script src="../../js/index.js"></script>
<?php

require_once "../../database/connection.php";


$eventID = $_GET["id"];
$query = "SELECT * FROM events WHERE ID = '$eventID'";

$result = $conn->query($query);
$event = $result->fetch_assoc();

?>

<script language="javascript" type="text/javascript" src="/path/to/file/src/profile-image.js"></script>


<body class="dark:bg-slate-900">

    <?php require_once "../../utils/sidebar.php"  ?>

    <div class="p-4 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">

            <a href="#"
                class="mt-14 w-full  flex flex-col md:flex-row   p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="">
                    <h1
                        class="mb-3 text-4xl  font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl mt-1 dark:text-white">
                        <?php echo $event["EVENT_NAME"]  ?></h1>
                        
                    <p class="font-normal mb-2  text-xl text-gray-700 dark:text-gray-400">
                        <?php echo $event["CONDUCT_BY"]  ?></p>

                    <span
                        class="bg-blue-100 text-blue-800 mt-3 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"><?php echo $event["EVENT_TYPE"]  ?></span>
                </div>
                <div class="ml-auto mt-auto flex flex-row">
                    <button type="button" onclick="deleteModal.show()"
                        class=" mt-auto text-white w-full bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">
                        <i class="fa-solid fa-trash"></i>
                        <span class="sr-only">Icon description</span>
                    </button>
                    <button type="button" onclick="editModal.show()"
                        class="mt-2  text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">
                        <i class="fa-solid fa-pen"></i>
                        <span class="sr-only">Icon description</span>
                    </button>
                </div>
            </a>

            <div class="mt-14">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">


                </div>
            </div>


            <div class="" id="allocations">

            </div>
        </div>

    </div>

    <div class="flex flex-col items-center" id="pagination">
        <!-- Help text -->


    </div>

    </div>

    <div id="view-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="viewModal.hide()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <input type="hidden" name="timeSlotID">
                    <input type="hidden" name="resourceID">
                    <input type="hidden" name="eventID">
                    <input type="hidden" name="activateType">
                    <input type="hidden" name="date">
                    <input type="hidden" name="id">

                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        Deactivate or Deallocate the Time?</h3>
                    <button type="button" onclick="deallocate()"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Deallocate Event
                    </button>
                    <button type="button" onclick="activation()"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        id="btn-activate">Deactivate</button>
                </div>
            </div>
        </div>
    </div>



    <div id="delete-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="deleteModal.hide()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <input type="hidden" name="timeSlotID">
                    <input type="hidden" name="resourceID">
                    <input type="hidden" name="eventID">
                    <input type="hidden" name="activateType">
                    <input type="hidden" name="id">


                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        Delete the Event ?</h3>
                    <button type="button" onclick="deleteEvent()"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes,I'm sure
                    </button>
                    <button type="button" onclick="deleteModal.hide()"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        id="btn-activate">No</button>
                </div>
            </div>
        </div>
    </div>




    <div id="edit-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button onclick="editModal.hide()" type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Event Details</h3>
                    <form id="editEventForm" class="space-y-6" action="#">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                Name</label>
                            <input type="text" name="event_name" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Introduction to JS" value=<?php echo "'".$event["EVENT_NAME"]."'"  ?>
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conduct By</label>
                            <input type="text" name="conduct_by" id="password" placeholder="IEEE"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$event["CONDUCT_BY"]."'"  ?> required>
                        </div>


                        <div>
                            <label for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                Type</label>
                            <select id="countries" name="event_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="Tech Talk"
                                    <?php echo $event["EVENT_TYPE"]=="Tech Talk" ? "selected" : ""  ?>>Tech Talk
                                </option>
                                <option value="Hands On Session"
                                    <?php echo $event["EVENT_TYPE"]=="Hands On Session" ? "selected" : ""  ?>>Hands On
                                    Session</option>
                                <option value="General Meeting"
                                    <?php echo $event["EVENT_TYPE"]=="General Meeting" ? "selected" : ""  ?>>General
                                    Meeting</option>
                                <option value="Lecture"
                                    <?php echo $event["EVENT_TYPE"]=="Lecture" ? "selected" : ""  ?>>Lecture</option>
                                <option value="Other" <?php echo $event["EVENT_TYPE"]=="Other" ? "selected" : ""  ?>>
                                    Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="flyer"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Flyer</label>
                            <input type="file" name="event_flyer" id="event_flyer" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                >
                        </div>
                        <div>
                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Optional
                                Details</label>
                            <textarea name="optional_details" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."><?php echo $event["OPTIONAL_DETAILS"]  ?> </textarea>

                        </div>

                    </form>
                    <button onclick="editEvent()" id="resource_form_submit"
                        class="text-white mt-5 w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

    </div>


</body>






<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>


<script>
const viewModal = new Modal(document.getElementById('view-modal'), {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
})
const editModal = new Modal(document.getElementById('edit-modal'), {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
})
const deleteModal = new Modal(document.getElementById('delete-modal'), {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
})

document.getElementById("editEventForm").addEventListener("submit", (e) => {
    e.preventDefault()
})
</script>

<script>
function openModal(id,eventID, resourceID, timeSlotID, activateType,date) {

    console.log(date)
    document.getElementsByName("timeSlotID")[0].value = timeSlotID;
    document.getElementsByName("resourceID")[0].value = resourceID;
    document.getElementsByName("eventID")[0].value = eventID;
    document.getElementsByName("activateType")[0].value = activateType;
    document.getElementById("btn-activate").innerHTML = activateType == 1 ? "Deactivate" : "Activate";
    document.getElementsByName("date")[0].value = date;
    document.getElementsByName("id")[0].value = id;


    viewModal.show()

}
</script>

<script>
function fetchAllocations() {
    const eventID = <?php echo $eventID ?>;
    const allocations = document.getElementById("allocations");

    axios.get(`../../controllers/event/event.php?allocation&eventID=${eventID}`)
        .then(res => {
            const data = res.data;
            let html = "";
            console.log(data)
            data?.forEach(resource => {

                let inner = "";

                resource?.allocations?.forEach(allocation => {
                    console.log(allocation)
                    inner += `
                            <a href="#" onclick="openModal(${allocation.OCCUPY_ID},${eventID},${resource.resource_id},${allocation.TIME_SLOT_ID},${allocation.ACTIVE},'${allocation.OCCUPIED_DATE}')"
                        class=" w-64 h-64 p-6 flex flex-col items-center  bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <div class="flex justify-start w-full">
                            <span
                                class="inline-flex items-center justify-center w-2 h-2 mr-2 text-sm font-semibold text-green-800 ${allocation?.ACTIVE==1?"bg-green-500":"bg-red-500"} rounded-full">
                            </span>
                        </div>
                        <h5 class="mb-2 text-2xl font-normal tracking-tight text-gray-700 dark:text-white ">${allocation.START_TIME}:00 -
                            ${allocation.END_TIME}:00 </h5>
                        <p class="font-semibold text-xl text-center mt-8  text-gray-700 dark:text-gray-400">
                             ${
                                allocation?.OCCUPIED_DATE? moment(allocation?.OCCUPIED_DATE).format("dddd, DD MMMM YYYY") : allocation?.DAY
                             }
                        </p>
                    </a>
                            `
                })




                html +=
                    `
                <div>
                <h1
                    class="mb-3 text-3xl text-center 2xl:text-left font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl mt-1 dark:text-white">
                    ${resource.resource_name}</h1>
                <div class="flex justify-center flex-col items-center gap-5 md:inline-grid md:gap-2 md:grid-cols-3  2xl:grid-cols-4   md:gap-6 w-full m-auto" id="resource-list"
                    style="margin:3rem auto;">
                    ${inner}
                </div>
            </div>
                `
            })
            allocations.innerHTML = html;
        })

}


fetchAllocations()
</script>


<script>
function activation() {
    const resourceID = document.getElementsByName("resourceID")[0].value;
    const timeSlotID = document.getElementsByName("timeSlotID")[0].value;
    const eventID = document.getElementsByName("eventID")[0].value;
    let activateType = document.getElementsByName("activateType")[0].value;
    const date = document.getElementsByName("date")[0].value;
    const id = document.getElementsByName("id")[0].value;

    console.log(resourceID, timeSlotID, eventID, activateType,date)


    //check for empty fields and show error
    if(resourceID =="" || timeSlotID =="" || eventID =="" || activateType ==""){
        new Notify({
                    title: 'Error',
                    text: `Something went wrong`,
                    effect: 'slide',
                    status:'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
        return;
    }


    axios.post(
        `../../controllers/event/event.php?deactivate`, {
            resourceID,
            timeSlotID,
            eventID,
            activateType,
            date,
            id
        }
    ).then(res => {
        if(activateType==1){
            activateType="Deactivated"
        }else{
            activateType="Activated"
        }
        console.log(res.data)
        if(res.data=="success"){
            fetchAllocations()
            new Notify({
                    title: 'Success',
                    text: `Time Slot Has been ${activateType}`,
                    effect: 'slide',
                    status:'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
        }else{
            new Notify({
                    title: 'Error',
                    text: `${res.data}`,
                    effect: 'slide',
                    status:'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
        }
        viewModal.hide()
    })

}

function deallocate() {
    const resourceID = document.getElementsByName("resourceID")[0].value;
    const timeSlotID = document.getElementsByName("timeSlotID")[0].value;
    const eventID = document.getElementsByName("eventID")[0].value;
    const id = document.getElementsByName("id")[0].value;


    axios.post(
        `../../controllers/event/event.php?deallocate`, {
            resourceID,
            timeSlotID,
            eventID,
            id
        }
    ).then(res => {
        console.log(res.data)
        fetchAllocations()
        new Notify({
                title: 'Success',
                text: 'The Time Slot Has been Deallocated',
                effect: 'slide',
                status:'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        viewModal.hide()
    })
}
</script>


<script>
function deleteEvent() {
    const eventID = <?php echo $eventID ?>;
    axios.get(
        `../../controllers/event/event.php?delete&eventID=${eventID}`
    ).then(res => {
        console.log(res.data)
        window.location.replace("/Resource-hub-Management/views/event/view.php");
    })
}


function editEvent() {
    const eventID = <?php echo $eventID ?>;
    const event_name = document.getElementsByName("event_name")[0].value;
    const conduct_by = document.getElementsByName("conduct_by")[0].value;
    const event_type = document.getElementsByName("event_type")[0].value;
    const event_flyer = document.getElementsByName("event_flyer")[0].value;
    const optional_details = document.getElementsByName("optional_details")[0].value;
    
    document.getElementById("resource_form_submit").innerHTML="<i class='fas fa-circle-notch fa-spin mr-2'></i> Saving...";

    if(event_name=="" || conduct_by=="" || event_type=="" || event_flyer==""){
        new Notify({
                    title: 'Error',
                    text: `Please fill all the fields`,
                    effect: 'slide',
                    status:'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
        return;
    }

    axios.post(
        `../../controllers/event/event.php?edit`, {
            eventID,
            event_name,
            conduct_by,
            event_type,
            event_flyer,
            optional_details
        }
    ).then(res => {
        if (res.data == "success") {
            window.location.reload()
            
        }
    }).finally(()=>{
        document.getElementById("resource_form_submit").innerHTML="<i class='fa-solid fa-floppy-disk mr-2'></i>Save Changes";
    })
}
</script>


