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

    <div class="p-4 pt-16 sm:ml-64">

        <div class="w-full md:w-11/12 m-auto 2xl:w-4/5">

            <h1
                class="mb-8 text-4xl text-center md:text-left  font-bold leading-none text-gray-700 md:text-5xl lg:text-5xl 2xl:mt-10 mt-8 dark:text-white">
                User Account Management</h1>

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
                    placeholder="Search For Users" onkeyup="search()">

            </div>

            <div class="w-full m-auto" id="resource-list" style="margin:3rem auto;">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    USER ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    USER NAME
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    USER EMAIL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    STUDENT ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    USER TYPE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    APPROVED
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
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
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
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">User Details</h3>
                        <form id="addResourceForm" class="space-y-6" action="#">
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                                <input type="text" name="user_id" id="user_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="CSL - 1" required disabled>
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                    Name</label>
                                <input type="text" name="username" id="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="CSL - 1" required disabled>
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                    Email</label>
                                <input type="text" name="user_email" id="user_email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="CSL - 1" required disabled>
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student
                                    ID</label>
                                <input type="text" name="student_id" id="student_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="20**/***/***" required disabled>
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                    Type</label>
                                <select name="user_type" id="user_type" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required disabled>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="STUDENT">STUDENT</option>
                                    <option value="LECTURER">LECTURER</option>
                                </select>
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approved</label>
                                <select name="approved" id="approved"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required disabled>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>





                        </form>
                        <button id="approve_btn"
                            onclick="approve()"
                            class="text-white mt-4 w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">

                            <i class="fa-solid fa-check mr-2"></i>
                            Approve
                        </button>

                    </div>
                </div>
            </div>

        </div>



        <div id="reset-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button onclick="resetModal.hide()" type="button"
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
                        <h2 class="text-xl dark:text-white">Reset Password</h2>
                        <div class="px-6 py-6 lg:px-8">

                            <form action="" class="space-y-6">

                                <div>

                                    <input type="password" name="student_id" id="password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Password" required>
                                </div>
                                <input type="hidden" name="" id="user_id">
                                <div>

                                    <input type="password" name="student_id" id="confirm_password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Confirm Password" required>
                                    <p class="text-red-400 text-left mt-3" id="error_msg">Unmatched Password</p>
                                </div>



                            </form>
                        </div>
                        <button onclick="resetSubmit()" data-modal-hide="popup-modal" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Reset Password
                        </button>
                        <button onclick="resetModal.hide()" data-modal-hide="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>
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
                    <input type="hidden" name="" id="user_id">

                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        Delete the User Account?</h3>
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







</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
<script>
document.getElementById("approveForm").addEventListener("click", function(e) {
    e.preventDefault();

})
</script>

<script>
function search(page = 1) {
    let searchQuery = document.getElementById("search").value;
    axios.get(`../../controllers/user/user.php?search=${searchQuery}&page=${page}`)
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
                switch (request.USER_TYPE) {
                    case "ADMIN":
                        className =
                            "bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                        break;
                    case "STUDENT":
                        className =
                            "bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                        break;
                    case "LECTURER":

                        className =
                            "bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                        break;
                }

                html +=
                    `
            	<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                	<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    	${request.USER_ID}
                	</th>
                	<td class="px-6 py-4">
                    	${request.USER_NAME}
                	</td>
                	<td class="px-6 py-4">
                    	${request.USER_EMAIL}
                	</td>
                	<td class="px-6 py-4">
                    	${request.STUDENT_ID}
                	</td>
                	<td class="px-6 py-4">
                    	<span class="${className}" >${request.USER_TYPE}</span>
                	</td>
                	<td class="px-6 py-4">
                    	
                        <span class="${request.APPROVED==1 ?"bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300":"bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"}">${request.APPROVED==1 ? "Yes" :"No" }</span>
                	</td>
                	
                	<td class="px-2 py-4 flex flex-col">
                    	<a href="#" onclick="loadRequestInfo(${request.USER_ID})" class="font-medium text-center text-green-400 dark:text-green-500 hover:underline mx-4">
                           View
                        </a>
                    	<a href="#" onclick="openDelete(${request.USER_ID})" class="font-medium text-center text-red-400 dark:text-red-500 hover:underline mx-4">
                            Delete
                        </a>
                    	<a href="#" onclick="resetPassword(${request.USER_ID})" class="font-medium text-center text-yellow-300 dark:text-yellow-300 hover:underline mx-4">
                          Reset
                        </a>
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
const $targetEl = document.getElementById('view-modal');
const viewModal = new Modal($targetEl, {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: function() {
        document.getElementById("error_msg").style.display = "none";
        document.getElementById("password").value = "";
        document.getElementById("confirm_password").value = "";
    },
});
const $targetER = document.getElementById('reset-modal');

const resetModal = new Modal($targetER, {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: function() {
        document.getElementById("error_msg").style.display = "none";
        document.getElementById("password").value = "";
        document.getElementById("confirm_password").value = "";
    },
});

const deleteModal = new Modal(document.getElementById("delete-modal"), {
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: function() {
       
    },
});


function loadRequestInfo(id) {
    axios.get(`../../controllers/user/user.php?id=${id}`)
        .then(res => {
            const data = res.data.data;
            console.log(data)

            document.getElementById("user_id").value = data.USER_ID;
            document.getElementById("username").value = data.USER_NAME;
            document.getElementById("user_email").value = data.USER_EMAIL;
            document.getElementById("student_id").value = data.STUDENT_ID;
            document.getElementById("user_type").value = data.USER_TYPE;
            document.getElementById("approved").value = data.APPROVED;
            if (data.APPROVED == 1) {
                document.getElementById("approve_btn").style.display = "none";


            } else {
                document.getElementById("approve_btn").style.display = "block";

            }




            viewModal.show();





        })
}
</script>

<script>
function resetPassword(uid) {
    document.getElementById("error_msg").style.display = "none";
    document.getElementById("user_id").value = uid;
    resetModal.show();
}

function openDelete(uid){
    document.getElementById("user_id").value = uid;
    deleteModal.show();

}


function resetSubmit() {
    let password = document.getElementById("password").value;
    let confirm_password = document.getElementById("confirm_password").value;
    let user_id = document.getElementById("user_id").value;

    if ((password != confirm_password) || (password == "" || confirm_password == "")) {
        document.getElementById("error_msg").style.display = "block";
        return;
    }

    axios.post(`../../controllers/user/user.php?reset`, {
            password,
            user_id,
        })
        .then(res => {
            if (res.data == "success") {
                new Notify({
                    title: 'Success',
                    text: `Password Has been Reset`,
                    effect: 'slide',
                    status: 'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
                resetModal.hide();
            } else {
                new Notify({
                    title: 'Error',
                    text: `Password Reset Has been Failed`,
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }
        })
}


function approve(){
    let user_id = document.getElementById("user_id").value;
    const approve_btn = document.getElementById("approve_btn");

    approve_btn.disabled = true;
    approve_btn.innerHTML = `<i class='fas fa-circle-notch fa-spin mr-2'></i> Approving...`;

    axios.post(`../../controllers/user/user.php?approve&user_id=${user_id}`, {
            user_id,
        })
        .then(res => {
            if (res.data == "success") {
                new Notify({
                    title: 'Success',
                    text: `User Has been Approved`,
                    effect: 'slide',
                    status: 'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
                viewModal.hide();
                search()
            } else {
                new Notify({
                    title: 'Error',
                    text: `User Approval Failed`,
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }
            approve_btn.disabled = false;
            approve_btn.innerHTML = `<i class="fa-solid fa-check mr-2"></i> Approve`;
        })
}

function deleteEvent(){
    let user_id = document.getElementById("user_id").value;
    axios.post(`../../controllers/user/user.php?delete&user_id=${user_id}`, {
            user_id,
        })
        .then(res => {
            if (res.data == "success") {
                new Notify({
                    title: 'Success',
                    text: `User Has been Deleted`,
                    effect: 'slide',
                    status: 'success',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
                deleteModal.hide();
                search()
            } else {
                new Notify({
                    title: 'Error',
                    text: `User Deletion Failed`,
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