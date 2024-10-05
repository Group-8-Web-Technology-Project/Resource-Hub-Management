<?php
    require_once "../../utils/header.php";
    require_once "../../utils/admin.php";
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />

<!-- <link rel="stylesheet" href="../../styles/index.css"> -->

<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>


<?php
    require_once "../../database/connection.php";

    $id = $_GET["id"];

    $sql = "SELECT * FROM resource WHERE id = $id";

    $result = $conn->query($sql);

    $resource = $result->fetch_assoc();

?>


<script language="javascript" type="text/javascript" src="/path/to/file/src/profile-image.js"></script>

<script>
let chosen_date = new Date();
const resourceID = <?php echo $_GET["id"] ?>
</script>

<body class="dark:bg-slate-900">

    <?php require_once "../../utils/sidebar.php"  ?>

    <div class="p-4 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">
            <a href="#"
                class=" flex flex-col md:flex-row mt-14  gap-5 p-6 w-full bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class=" max-w-sm ">
                    <img src=<?php echo "'".$resource["IMAGE"]."'" ?> class=" rounded-lg h-80" alt="">
                </div>
                <div>
                    <div class="">
                        <h1
                            class="mb-3 text-5xl text-center md:text-left  font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl mt-1 dark:text-white">
                            <?php echo $resource["RESOURCE_NAME"]  ?></h1>

                        <p class="font-normal mb-2 italic text-2xl text-gray-700 dark:text-gray-400">
                            <?php echo $resource["BUILDING_NAME"]  ?></p>
                        <div class="mt-4">
                            <span
                                class="bg-blue-100 text-blue-800 mt-3 text-xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                <?php echo $resource["RESOURCE_TYPE"]  ?>
                            </span>
                            <span
                                class="bg-blue-100 text-blue-800 mt-3 text-xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                <i class="fas fa-chair mr-2"></i> <?php echo $resource["SEATING"]  ?>
                            </span>
                        </div>
                    </div>



                </div>
                <div class="2xl:ml-auto mt-auto flex flex-col ">
                    <button type="button" onclick="deleteModal.show()"
                        class=" mt-auto text-white w-full bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">
                        <i class="fa-solid fa-trash"></i> <span class="ml-2">Delete</span>
                        <span class="sr-only">Icon description</span>
                    </button>
                    <button type="button" onclick="editModal.show()"
                        class="mt-2  text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">
                        <i class="fa-solid fa-pen"></i> <span class="ml-2">Edit</span>
                        <span class="sr-only">Icon description</span>
                    </button>
                </div>
            </a>



        </div>

        <div class="flex  flex-col justify-center">


        </div>


        <div class="w-full m-auto flex justify-center">




            <div class="flex justify-center my-6 ">
                <div class="date mt-3 flex flex-col items-center md:flex-row">
                    <a id="previous-date">
                        <i class="text-2xl fa-solid fa-arrow-left mx-4 dark:text-white"></i>
                    </a>

                    <input style="background:transparent;"
                        class="text-3xl text-gray-900 font-light dark:text-white text-center" value="Monday"
                        id="date-text" />

                    <a id="next-date">
                        <i class="text-2xl fa-solid fa-arrow-right dark:text-white mx-4"></i>
                    </a>
                </div>
            </div>


            <!-- <div class="" style="display:grid;grid-template-columns:repeat(5,1fr);gap:1rem;margin-top:2rem;"
                id="allocate_list">





            </div> -->

        </div>

        <div class="flex flex-col justify-center items-center  md:inline-grid  md:grid-cols-3 2xl:grid-cols-4	 gap-8  w-full md:w-11/12 md:mx-[5%] 2xl:mx-[10%] 2xl:w-4/5 "
            id="resource-list">







        </div>

    </div>


    </div>




    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" onclick="modal.hide()"
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
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Allocate
                        <?php echo $resource["RESOURCE_NAME"] ?></h3>
                    <form class="space-y-6" action="#" id="allocateResourceForm">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="text" name="date" id="date" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="2023-09-05" required>
                        </div>
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Name</label>
                            <input type="text" name="date" id="search_event"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Search Event" required>
                        </div>

                        <input type="hidden" id="event_id" name="event_id">

                        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 " id="event-list">



                        </ul>


                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                            <input datepicker-format="mm/dd/yyyy" type="time" name="start_time" id="start_time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="name@company.com" required>
                        </div>


                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                Time</label>
                            <input type="time" name="end_time" id="end_time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="name@company.com" required>
                        </div>





                        <div class="flex justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="recurring_event"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                        required>
                                </div>
                                <label for="remember"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recurring Event
                                    <span class="font-normal"><br>The Resource will be Allocated on Every <span
                                            class="font-semibold text-gray-900 dark:text-white" id="day"></span></span>
                                </label>
                            </div>

                        </div>

                        <div class="flex items-center">
                            <div id="overlap_msg" class="mr-auto">

                            </div>
                            <button type="button" onclick="checkAvailability()"
                                class="ml-auto text-white m bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Check
                                Availability</button>
                        </div>



                        <ul id="overlap_list" class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 ">

                        </ul>



                        <button id="submit_btn_allocate"
                            class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Allocate
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <input type="hidden" id="timeSlotID">
    <input type="hidden" id="eventID">




    <div id="deallocate-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button onclick="deallocateModal.hide()" type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
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
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        deallocate the resource from the event ?</h3>
                    <button onclick="deallocate()" data-modal-hide="popup-modal" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button onclick="deallocateModal.hide()" data-modal-hide="popup-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>



    <div id="delete-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button onclick="deleteModal.hide()" type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
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
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete the resource?</h3>
                    <button onclick="deleteResource()" data-modal-hide="popup-modal" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button onclick="deallocateModal.hide()" data-modal-hide="popup-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>



    <div id="edit-resource-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" onclick="editModal.hide()"
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
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Resource Details</h3>
                    <form id="editResourceForm" class="space-y-6" action="#">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resource
                                Name</label>
                            <input type="text" name="resource_name" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="CSL - 1" required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Building
                                Name</label>
                            <input type="text" name="building_name" id="password" placeholder="Department Building"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>


                        <div>
                            <label for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resource
                                Type</label>
                            <select id="countries" name="resource_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="LAB">LAB</option>
                                <option value="AUDITORIUM">AUDITORIUM</option>
                                <option value="LECTURE ROOM">LECTURE ROOM</option>
                                <option value="OTHER">OTHER</option>

                            </select>
                        </div>


                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seating</label>
                            <input type="number" name="seating" min="0" id="password" value="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>


                        <div>

                            <label for="message"
                                class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Optional
                                Message</label>
                            <textarea name="optional_details" rows="4"
                                class="block p-2.5 mb-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>

                        </div>



                        <button id="resource_form_submit"
                            class="text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                            <i class="fa-solid fa-floppy-disk mr-2"></i>
                            Save Changes
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>





</body>










<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.css">
<script type="module">
new AirDatepicker('#date-text', {

    onSelect({
        date,
        formattedDate,
        datepicker
    }) {
        document.getElementById("date-text").value = moment(date).format("dddd, DD MMMM YYYY");
        const dateInput = document.getElementById("date");
        dateInput.value = moment(date).format("YYYY-MM-DD");
        chosen_date = date;
        getData(moment(chosen_date).format("YYYY-MM-DD"));

    }
})
document.getElementById("start_time").addEventListener('input', (e) => {
    let hour = e.target.value.split(':')[0]
    e.target.value = `${hour}:00`
})
document.getElementById("end_time").addEventListener('input', (e) => {
    let hour = e.target.value.split(':')[0]
    e.target.value = `${hour}:00`
})
</script>



<script>
const editResourceForm = document.getElementById("editResourceForm");

editResourceForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(editResourceForm);
    formData.append("id", resourceID);
    
    document.getElementById("resource_form_submit").innerHTML="<i class='fas fa-circle-notch fa-spin mr-2'></i> Saving...";
    
    
    axios.post(`../../controllers/resource/resource.php?edit`, formData)
        .then(res => {
            if (res.data != "success") {
                new Notify({
                    title: 'Error',
                    text: "Resource Couldn't be Updated",
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
                return;
            }
            new Notify({
                title: 'Success',
                text: "Resource Updated Successfully",
                effect: 'slide',
                status: 'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
            setTimeout(() => {
                window.location.reload();
            }, 800);
            editModal.hide()
        }).finally(()=>{
                         document.getElementById("resource_form_submit").innerHTML="<i class='fa-solid fa-floppy-disk mr-2'></i>Add Event";

        })
})
</script>







<script>
const dateInput = document.getElementById("date");

const $targetEl = document.getElementById('deallocate-modal');
const deallocateModal = new Modal($targetEl, {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
});

const $targetElM = document.getElementById('authentication-modal');
const modal = new Modal($targetElM, {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,

});

const $targetElD = document.getElementById('delete-modal');
const deleteModal = new Modal($targetElD, {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
});

const $targetElE = document.getElementById('edit-resource-modal');
const editModal = new Modal($targetElE, {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onShow: () => {
        document.getElementsByName("resource_name")[0].value =
            <?php echo "'".$resource["RESOURCE_NAME"]."'" ?>;
        document.getElementsByName("building_name")[0].value =
            <?php echo "'".$resource["BUILDING_NAME"]."'" ?>;
        document.getElementsByName("resource_type")[0].value =
            <?php echo "'".$resource["RESOURCE_TYPE"]."'" ?>;
        document.getElementsByName("seating")[0].value = <?php echo "'".$resource["SEATING"]."'" ?>;
        document.getElementsByName("optional_details")[0].value =
            <?php echo "'".$resource["OPTIONAL_DETAILS"]."'" ?>;
    },
});







document.getElementById("next-date").addEventListener('click', () => {
    chosen_date = moment(chosen_date).add(1, 'days').format("YYYY-MM-DD");
    getData(moment(chosen_date).format("YYYY-MM-DD"));
    setDateText();
})
document.getElementById("previous-date").addEventListener('click', () => {
    chosen_date = moment(chosen_date).subtract(1, 'days').format("YYYY-MM-DD");
    getData(moment(chosen_date).format("YYYY-MM-DD"));
    setDateText();
})

document.addEventListener('DOMContentLoaded', () => {

    getData(moment(chosen_date).format("YYYY-MM-DD"));
    setDateText();

})

function setDateText() {
    dateInput.value = moment(chosen_date).format("YYYY-MM-DD");
    document.getElementById("day").innerHTML = moment(chosen_date).format("dddd");
    document.getElementById("date-text").value = moment(chosen_date).format("dddd, DD MMMM YYYY")
}

function openDeallocateModal(eventID, timeSlotID) {
    document.getElementById("eventID").value = eventID;
    document.getElementById("timeSlotID").value = timeSlotID;
    deallocateModal.show();
}

function openEditModal() {

}



function getData(date) {
    axios.get(`../../controllers/allocate/allocate.php?date=${date}&resourceID=${resourceID}`)
        .then(res => {
            const allocate_list = document.getElementById("resource-list");
            let html = "";
            res.data.data.forEach(allocate => {

                html += (
                    `
                    <a href="#" onclick="openDeallocateModal(${allocate["EVENT_ID"]},${allocate["TIME_SLOT_ID"]})"
                class=" w-64 h-64 p-6 flex flex-col items-center  bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-700 dark:text-white ">${allocate["START_TIME"]}:00 - ${allocate["END_TIME"]}:00 </h5>
                <p class="font-normal text-xl text-center mt-6  text-gray-700 dark:text-gray-400">
                ${allocate["EVENT_NAME"]}
                </p>
            </a>
                    `
                )
            })
            html +=
                `
                <a href="#" "
                onclick="modal.show();"
                class=" w-64 h-64 p-6 flex border-dashed	border-2  items-center justify-center   border-green-300 rounded-lg  hover:bg-green-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <i class="fa-solid fa-plus text-green-400 text-4xl"></i>
            </a>
                `;
            allocate_list.innerHTML = html;
        })
}
</script>




<script>
function check(id, name, e) {
    document.getElementsByName('event_id')[0].value = id;
    document.getElementById("search_event").value = name
    document.getElementById("event-list").innerHTML = "";
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
                                        onclick="check(${event['ID']},'${event['EVENT_NAME']}');"
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
</script>





<script>
function checkAvailability() {
    const start_time = document.getElementById("start_time");
    const end_time = document.getElementById("end_time");
    const date = document.getElementById("date");
    // const recurring_event = document.getElementById("recurring_event");
    const overlap_msg = document.getElementById("overlap_msg");
    const overlap_list = document.getElementById("overlap_list");

    if (parseInt(start_time.value) > parseInt(end_time.value)) {
        overlap_msg.innerHTML = "Invalid Time Detected";
        overlap_msg.classList.add("has-text-danger");
        overlap_msg.classList.remove("has-text-success");
        return;
    }

    axios.get("../../controllers/util/checkAvailability.php?check", {
        params: {
            start_time: start_time.value.split(':')[0],
            end_time: end_time.value.split(':')[0],
            date: date.value,
            resource_id: <?php echo $resource["ID"] ?>
        }
    }).then(res => {
        console.log(res.data)
        if (res.data.length > 0) {
            overlap_msg.innerHTML = "<p class='text-red-600'>Possible Overlap Detected</p>";
            overlap_msg.classList.add("has-text-danger");
            overlap_msg.classList.remove("has-text-success");

            let node_list = "";

            res.data.forEach(event => {

                node_list += (
                    `
                    <li class="pb-3 sm:pb-4 hover:divide-gray-400">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            ${event["event_name"]}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            ${event["event_conduct_by"]}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base cursor-pointer hove:text-blue-400  text-blue-600 dark:text-blue">
                                        ${event["event_start_time"]}:00 - ${event["event_end_time"]}:00
                                    </div>
                                </div>
                            </li>
                        
                        `
                )
            });

            overlap_list.innerHTML = node_list;


        } else {
            overlap_list.innerHTML = "";
            overlap_msg.innerHTML = "<p class='text-green-400 mb-2'>No Overlap Detected</p>";
            overlap_msg.classList.add("has-text-success");
            overlap_msg.classList.remove("has-text-danger");
        }
    });

}
</script>

<script>
const deallocate_resource = document.getElementById("deallocate_resource");

function deallocate() {
    let eventID = document.getElementById("eventID").value;
    let timeSlotID = document.getElementById("timeSlotID").value;
    let date = document.getElementById("date").value;

    axios.get(
            `../../controllers/resource/resource.php?deallocate&eventID=${eventID}&resourceID=<?php echo $resource["ID"]?>&timeSlotID=${timeSlotID}&date=${date}`
        )
        .then(res => {
            if (res.data == "success") {
                getData(moment(chosen_date).format("YYYY-MM-DD"));
                new Notify({
                    title: 'Success',
                    text: "Resource Deallocated Successfully",
                    effect: 'slide',
                    status: 'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
                deallocateModal.hide();
            }
        })
}
</script>



<script>
const submitBtn = document.getElementById("submit_btn_allocate");
const form = document.getElementById("allocateResourceForm");

form.addEventListener('submit', (e) => {
    e.preventDefault();
})

submitBtn.addEventListener('click', (e) => {
    e.preventDefault();
    let event_id = document.getElementById("event_id").value;
    let start_time = document.getElementById("start_time").value;
    let end_time = document.getElementById("end_time").value;
    let date = document.getElementById("date").value;
    let recurring_event = document.getElementById("recurring_event").checked;

    if (event_id == "" || start_time == "" || end_time == "" || date == "") {
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

    console.log(event_id, start_time, end_time, date, recurring_event, resourceID);
    submitBtn.innerHTML = "<i class='fas fa-circle-notch fa-spin mr-2'></i> Allocating...";
    axios({
        url: "../../controllers/allocate/allocate.php?new",
        data: {
            eventID: event_id,
            startTime: start_time,
            endTime: end_time,
            date,
            isRecurring: recurring_event,
            resourceID
        },
        headers: {
            "Content-Type": "application/json"
        },
        method: "post"
    }).then(res => {

        if (res.data == "success") {
            new Notify({
                title: 'Success',
                text: "Resource Allocated Successfully",
                effect: 'slide',
                status: 'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })

            //rest fields
            document.getElementById("event_id").value = "";
            document.getElementById("start_time").value = "";
            document.getElementById("end_time").value = "";
            document.getElementById("recurring_event").checked = false;
            document.getElementById("search_event").value = "";
            document.getElementById("event-list").innerHTML = "";
            modal.hide();
            setDateText();
            

        } else {
            new Notify({
                title: 'Error',
                text: res.data,
                effect: 'slide',
                status: 'error',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        }
        modal.hide();
        getData(moment(chosen_date).format("YYYY-MM-DD"))
    }).finally(()=>{
        submitBtn.innerHTML = "Approve";
    })
})

function deleteResource() {
    axios.get(`../../controllers/resource/resource.php?delete&id=<?php echo $resource["ID"] ?>`)
        .then(res => {
            if (res.data == "success") {
                window.location.href = "../home/view.php";
                new Notify({
                    title: 'Success',
                    text: "Resource Deleted Successfully",
                    effect: 'slide',
                    status: 'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            } else {
                new Notify({
                    title: 'Error',
                    text: "Resource Couldn't be Deleted",
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