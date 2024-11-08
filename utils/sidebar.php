<!-- <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button> -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="flex ml-2 md:mr-24">
                    <img src="../../assets/icons/logo-no-background.png" class="h-8 mr-3" alt="FlowBite Logo" />
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">ResourceHub</span>
                </a>
                

            </div>
            <div class="ml-auto">
                    <div class="ml-auto ">
                        <button type="button" id="toggle-button"
                            class="flex text-gray-300 ml-auto items-center w-9 h-9 justify-center text-xs font-medium  bg-white border border-gray-200 rounded-lg toggle-dark-state-example hover:bg-gray-100 hover:text-green-300 focus:z-10 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-500 dark:bg-gray-800 focus:outline-none dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">


                            <span class="sr-only">Toggle dark/light mode</span>
                        </button>
                    </div>
                </div>
        </div>
    </div>
</nav>
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <div class="flex h-full flex-col">
            <ul class="space-y-2 font-medium flex flex-col">
                <li>
                    <a href="../dashboard/view.php"
						class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
						<svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
							xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path d="M3 3h4v4H3V3zm7 0h11v7h-2V5h-9V3zm0 9h4v9h-4v-9zm-7 7h4v-4H3v4zm7-7h-4v4h4v-4zm9 4h-2v2h-2v-4h4v2z" />
						</svg>
						<span class="ml-3">Dashboard</span>
					</a>

                </li>
                <li>
                    <a href="../home/view.php"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ml-3">Resource Management</span>
                    </a>
                </li>
                <li>
                    <a href="../event/view.php"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Event Management</span>

                    </a>
                </li>
                <li>
                    <a href="../request/view.php"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Request Management</span>

                    </a>
                </li>
                <li>
                    <a href="../user/view.php"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">User Management</span>
                    </a>
                </li>
                <li>
                    <a href="../waitlist/view.php"
						class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
						<svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
							xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path d="M12 2a9 9 0 1 1-9 9 9.01 9.01 0 0 1 9-9zm1 5h-2v6h4v-2h-2zm-9.5 9a2.5 2.5 0 1 1 2.5 2.5 2.5 2.5 0 0 1-2.5-2.5zm11.5 2.5a2.5 2.5 0 1 1 2.5-2.5 2.5 2.5 0 0 1-2.5 2.5zm-6.5 0h5a2 2 0 0 1 2 2v1H4v-1a2 2 0 0 1 2-2z" />
						</svg>
						<span class="flex-1 ml-3 whitespace-nowrap">Waitlist</span>
					</a>
                </li>
            </ul>
            <div class="my-6">
                <?php 
                include(__DIR__ . "/sideBarCalender.php");
                ?>
            </div>
            <div class="mt-auto mb-3">
            <a href="../../controllers/login/login.php?logout" class="lg:mt-auto mt-8  w-full">
                <button type="submit"
                    class="text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 ">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sign Out
                </button>
            </a>
            </div>
        </div>
    </div>
</aside>


<!-- <div class="fixed bottom-2 right-2">
    <div class="flex ">
        <button type="button" id="toggle-button"
            class="flex ml-auto items-center w-9 h-9 justify-center text-xs font-medium text-gray-700 bg-white border border-gray-200 rounded-lg toggle-dark-state-example hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-500 dark:bg-gray-800 focus:outline-none dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">


            <span class="sr-only">Toggle dark/light mode</span>
        </button>
    </div>
</div> -->

<script>
document.getElementById("toggle-button").addEventListener("click", function() {
    let htmlClasses = document.querySelector('html').classList;
    if (localStorage.getItem('color-theme') === 'dark') {
        htmlClasses.remove('dark');
        localStorage.setItem('color-theme', 'light')
        document.getElementById("toggle-button").innerHTML = `<i class="fa-solid fa-moon fa-xl"><i/>`
    } else {
        htmlClasses.add('dark');
        localStorage.setItem('color-theme', 'dark');
        document.getElementById("toggle-button").innerHTML = `<i class="fa-solid fa-sun fa-xl"><i/>`
    }
});


if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
        '(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
    document.getElementById("toggle-button").innerHTML = `<i class="fa-solid fa-sun fa-xl"><i/>`
} else {
    document.documentElement.classList.remove('dark');
    document.getElementById("toggle-button").innerHTML = `<i class="fa-solid fa-moon fa-xl"><i/>`

}

document.querySelector('[data-drawer-toggle="logo-sidebar"]').addEventListener('click', function() {
    const sidebar = document.getElementById('logo-sidebar');
    if (sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.remove('-translate-x-full');
    } else {
        sidebar.classList.add('-translate-x-full');
    }
});

</script>