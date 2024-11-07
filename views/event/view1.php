<?php
    require_once "../../utils/header.php";
    require_once "../../utils/admin.php";
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />

<!-- <link rel="stylesheet" href="../../styles/index.css"> -->

<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>

<style>
.side-panel {
    width: 90%;
    height: 90vh;
    margin: auto;
    position: relative;
    background-color: #11143d;
}

.align-center {
    display: flex;
    justify-content: center;

}

.selected-item {
    background-color: #1dd1b2;
    color: #fff;
    border-radius: 10px;
}

.selected-item span {
    color: #fff;
}

a.has-text-grey-dark.selected-item:hover {
    background-color: #1bd1b39d;
}



/* img {
    border-radius: 50%;
    background-color: #f5f5f5;
    height: 100px;
    width: 100px;

} */
.pagination-link.is-current {
    background-color: #1dd1b2 !important;
    border-color: #1dd1b2 !important;
}

p {
    margin-bottom: .2em !important;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 1rem;
}


.modal-card {
    width: 35% !important;
    border-radius: .5rem;
}


.resource-card {
    transition: all .5s ease-in-out;

}

.resource-card:hover {
    cursor: pointer;
    transform: scale(1.1);
}
</style>

<script language="javascript" type="text/javascript" src="/path/to/file/src/profile-image.js"></script>


<body class="dark:bg-slate-900">

    <?php require_once "../../utils/sidebar.php"  ?>

    <div class="p-4 pt-16 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">
            <div class="mt-0">
            <h1
            class="mb-8 text-4xl text-center md:text-left  font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-4 dark:text-white"    
            >
                Event Management</h1>
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
                        placeholder="Search For Events" onkeyup="search();">

                </div>
            </div>
            <div class="flex justify-end ">
                <button onclick="modal.show()"  type="button"
                    class="md:mr-2  w-full md:w-auto  mt-4 md:my-3 my-2   text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add New Event
                </button>
            </div>
            
            <div class="flex justify-center flex-col items-center gap-5 md:inline-grid md:gap-6 md:grid-cols-3 mt-4  2xl:grid-cols-4 w-full m-auto" id="resource-list" >
    
    
            </div>
        </div>

        <div class="flex flex-col items-center mt-5" id="pagination">
            <!-- Help text -->
    
    
        </div>

    </div>


    </div>


    <div id="add-resource-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button onclick="modal.hide()" type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add New Event</h3>
                   <!--Form for add event-->
                    <form id="addResourceForm" class="space-y-6" action="#">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                Name</label>
                            <input type="text" name="event_name" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Introduction to JS" required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conduct By</label>
                            <input type="text" name="conduct_by" id="password" placeholder="IEEE"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>


                        <div>
                            <label for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event
                                Type</label>
                            <select id="countries" name="event_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="Tech Talk">Tech Talk</option>
                                <option value="Hands On Session">Hands On Session</option>
                                <option value="General Meeting">General Meeting</option>
                                <option value="Lecture">Lecture</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="flyer"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Flyer</label>
                            <input type="file" name="event_flyer" id="event_flyer" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Optional
                                Details</label>
                            <textarea name="optional_details" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                        </div>

                    </form>
                    <button onclick="addEvent()" id="resource_form_submit"
                        class="text-white mt-5 w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                        <i class="fa-solid fa-plus mr-2"></i>
                        Add Event
                    </button>
                </div>
            </div>
        </div>

    </div>



</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>

<script>
document.getElementById("addResourceForm").addEventListener('submit', (e) => e.preventDefault());
const $targetEl = document.getElementById('add-resource-modal');
const modal = new Modal($targetEl, {

    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,

});
</script>


<script>
function loadResources(searchQuery = "", page) {
    axios.get(
        "../../controllers/event/event.php?search&limit=6", {
            params: {
                search: searchQuery,
                page: page
            }
        }
    ).then(
        res => {
            let data = res.data?.data

            let pagination = Math.ceil(res.data?.total / 3);




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
                    onclick="loadResources('${searchQuery}',${parseInt(res.data.page)-1})"
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
                    onclick="loadResources('${searchQuery}',${parseInt(res.data.page)+1})"
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


            data = data.map(element => {

                let colorCode = "is-primary";
                switch (element.RESOURCE_TYPE) {
                    case "Auditorium":
                        colorCode = "yellow";
                        break;
                    case "Lab":
                        colorCode = "green";
                        break;
                    case "Classroom":
                        colorCode = "red";
                        break;
                }
                return (
                    `
                    <a href="./index.php?id=${element.ID}" 
                class=" w-64 h-64 p-6 flex flex-col items-center justify-center  bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                
                <p class="font-normal text-xl text-center   text-gray-700 dark:text-gray-400">
                ${element.EVENT_NAME}
                </p>  

                <div class=" max-w-sm ">
                    <img src=<?php echo "'".$resource["event_flyer"]."'" ?> class=" rounded-lg h-80" alt="">
                </div>

            </a>
                `)

            });
            let template = "";
            for (element of data) {
                template += element;
            }
            console.log(template)
            document.getElementById("resource-list").innerHTML = template;
        }
    ).catch(
        err => {
            console.log(err);
        }
    )

}

function search() {
    loadResources(document.getElementById("search").value, 1)
}

loadResources("", 1);
</script>


<script>
function addEvent() {
    const event_name = document.getElementsByName("event_name")[0];
    const conduct_by = document.getElementsByName("conduct_by")[0];
    const event_type = document.getElementsByName("event_type")[0];
    const event_flyer = document.getElementsByName("event_flyer")[0];
    const optional_details = document.getElementsByName("optional_details")[0];

    if(event_name.value=="" || conduct_by.value=="" || event_type.value=="" || event_flyer.value==""){
        alert("Please fill all the fields");
        return;
    }
document.getElementById("resource_form_submit").innerHTML="<i class='fas fa-circle-notch fa-spin mr-2'></i> Adding Event...";
    axios.post(
        "../../controllers/event/event.php?new", {
            event_name: event_name.value,
            conduct_by: conduct_by.value,
            event_type: event_type.value,
            event_flyer: event_flyer.value,
            optional_details: optional_details.value,
        }
    ).then(
        res => {
            search()
            
            if (res.data == "success") {
                new Notify({
                    title: 'Success',
                    text: "Event Added",
                    effect: 'slide',
                    status: 'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }else{
                new Notify({
                    title: 'Error',
                    text: "Event Can't be Added",
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }

            //reset input 
            event_name.value = "";
            conduct_by.value = "";
            event_type.value = "";
            event_flyer.value = "";
            optional_details.value = "";
            


            modal.hide()

        }
    ).catch(
        err => {
            console.log(err);
        }
    ).finally(()=>{
         document.getElementById("resource_form_submit").innerHTML="<i class='fa-solid fa-plus mr-2'></i>Add Event";
    })


}
</script>