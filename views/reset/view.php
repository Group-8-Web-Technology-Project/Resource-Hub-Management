<?php require_once("../../database/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../../assets/icons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../../assets/icons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../assets/icons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../../assets/icons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../assets/icons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../../assets/icons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../../assets/icons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../../assets/icons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../assets/icons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../../assets/icons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../assets/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../../assets/icons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../assets/icons/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../styles/index.css">
    <title>ResourceHub</title>
</head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../output.css">
<link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
<script src="../../assets/lib/simple-notify.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["user_id"])){
    header("Location: ../home/view.php");
}

?>


<body>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-16 h-16 mr-2" src="../../assets/icons/logo-no-background.png" alt="logo">
                ResourceHub
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6  sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Reset Your Password
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="post" id="loginForm">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required>
                        </div>
                     



                        <button type="submit" id="resetBtn" onclick="login()"
                            class="text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">
                            Reset Password
                        </button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="../register/view.php"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>


<script>
document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
})


function login() {
    let email = document.getElementById("email").value;
   
    let data = {
        email: email
    }

    if (email == "")  {
        new Notify({
            title: 'Invalid',
            text: `Please fill all the fields`,
            effect: 'slide',
            status: 'error',
            speed: 300,
            autoclose: true,
            autotimeout: 3000
        })
        return;
    }

    document.getElementById("resetBtn").disabled = true;
    document.getElementById("resetBtn").innerHTML="<i class='fas fa-circle-notch fa-spin mr-2'></i> Resetting Password...";


    axios.post("../../controllers/login/login.php?reset_request", data).then(res => {
        console.log(res.data);
        if (res.data == "success") {
            new Notify({
                title: 'Success',
                text: `Password reset link sent to your email`,
                effect: 'slide',
                status: 'success',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
            setTimeout(() => {
                window.location.href = "../login/view.php";
            }, 3000);
        } else {
            new Notify({
                title: 'Invalid',
                text: `Email not registered`,
                effect: 'slide',
                status: 'error',
                speed: 300,
                autoclose: true,
                autotimeout: 3000
            })
        }
    }).catch(err => {
        console.log(err);

    }).finally(() => {
        document.getElementById("resetBtn").disabled = false;
        document.getElementById("resetBtn").innerHTML="Reset Password";

    })
}
</script>