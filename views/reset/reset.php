<?php 
    require_once("../../database/connection.php");
?>

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
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <div class="grid grid-cols-1" id="hint">
                                        <div class="flex items-center mt-2">
                                            <i class="fas fa-circle-xmark mr-2  text-sm text-red-500" id="upper-icon"></i>
                                            <p class="text-sm text-gray-400"> Uppercase Letter</p>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <i class="fas fa-circle-xmark mr-2  text-sm text-red-500" id="special-icon"></i>
                                            <p class="text-sm text-gray-400"> Minimum 8 Characters</p>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <i class="fas fa-circle-xmark mr-2  text-sm text-red-500" id="lower-icon"></i>
                                            <p class="text-sm text-gray-400"> Lowercase Letter</p>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <i class="fas fa-circle-xmark mr-2  text-sm text-red-500" id="numeral-icon"></i>
                                            <p class="text-sm text-gray-400"> Numerals</p>
                                        </div>
                                    </div>
                    
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                Password</label>
                            <input type="password" name="password" id="confirm-password" placeholder="••••••••"
                                class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>



                        <button type="submit" id="resetBtn" onclick="login()"
                            class="text-white w-full bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 my-2">
                            Reset Password
                        </button>

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
    
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm-password").value;
    let token = "<?php echo $_GET["token"] ?>";
    let data = {
        password: password,
        confirmPassword: confirmPassword,
        token: token
    }

    if (confirmPassword == "" || password == "") {
        new Notify({
            title: 'Invalid',
            text: `Please fill out all the fields`,
            effect: 'slide',
            status: 'error',
            speed: 300,
            autoclose: true,
            autotimeout: 3000
        })
        return;
    }

    if (password != confirmPassword) {
        new Notify({
            title: 'Invalid',
            text: `Passwords don't match`,
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

    axios.post("../../controllers/login/login.php?reset", data).then(res => {
        if (res.data == "success") {
            new Notify({
                title: 'Success',
                text: `Password reset successful`,
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
            if(res.data == "wrong-token"){
                new Notify({
                    title: 'Error',
                    text: `Invalid token`,
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }

            if(res.data == "same-password"){
                new Notify({
                    title: 'Error',
                    text: `New password connot be your old password`,
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }

            if(res.data == "false"){
                new Notify({
                    title: 'Error',
                    text: `Password reset failed`,
                    effect: 'slide',
                    status: 'error',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000
                })
            }
            
        }
    }).finally(() => {
        document.getElementById("resetBtn").disabled = false;
        document.getElementById("resetBtn").innerHTML="Reset Password";

    })
}

document.getElementById("hint").style.display = "none";

document.getElementById("password").addEventListener("keyup", function() {
    const value = this.value;

    if (value == "") {
        document.getElementById("hint").style.display = "none";
    }

    let error = false;

    const upperRegex = /[A-Z]/;
    const lowerRegex = /[a-z]/;
    const numeralRegex = /[0-9]/;
    const specialRegex = /[!@#$%^&*(),.?":{}|<>]/;
    if (value.search(upperRegex) >= 0) {
        document.getElementById("upper-icon").classList.remove(
            "fa-circle-xmark");
        document.getElementById("upper-icon").classList.add(
            "fa-circle-check");
        document.getElementById("upper-icon").classList.remove(
            "text-red-500");
        document.getElementById("upper-icon").classList.add(
            "text-green-500");
    } else {
        document.getElementById("upper-icon").classList.add(
            "fa-circle-xmark");
        document.getElementById("upper-icon").classList.remove(
            "fa-circle-check");
        document.getElementById("upper-icon").classList.add(
            "text-red-500");
        document.getElementById("upper-icon").classList.remove(
            "text-green-500");
        error = true;

    }
    if (value.length >= 8) {
        document.getElementById("special-icon").classList.remove(
            "fa-circle-xmark");
        document.getElementById("special-icon").classList.add(
            "fa-circle-check");
        document.getElementById("special-icon").classList.remove(
            "text-red-500");
        document.getElementById("special-icon").classList.add(
            "text-green-500");
    } else {
        document.getElementById("special-icon").classList.add(
            "fa-circle-xmark");
        document.getElementById("special-icon").classList.remove(
            "fa-circle-check");
        document.getElementById("special-icon").classList.add(
            "text-red-500");
        document.getElementById("special-icon").classList.remove(
            "text-green-500");
        error = true;

    }
    if (value.search(lowerRegex) >= 0) {
        document.getElementById("lower-icon").classList.remove(
            "fa-circle-xmark");
        document.getElementById("lower-icon").classList.add(
            "fa-circle-check");
        document.getElementById("lower-icon").classList.remove(
            "text-red-500");
        document.getElementById("lower-icon").classList.add(
            "text-green-500");
    } else {
        document.getElementById("lower-icon").classList.add(
            "fa-circle-xmark");
        document.getElementById("lower-icon").classList.remove(
            "fa-circle-check");
        document.getElementById("lower-icon").classList.add(
            "text-red-500");
        document.getElementById("lower-icon").classList.remove(
            "text-green-500");
        error = true;
    }
    if (value.search(numeralRegex) >= 0) {
        document.getElementById("numeral-icon").classList.remove(
            "fa-circle-xmark");
        document.getElementById("numeral-icon").classList.add(
            "fa-circle-check");
        document.getElementById("numeral-icon").classList.remove(
            "text-red-500");
        document.getElementById("numeral-icon").classList.add(
            "text-green-500");
    } else {
        document.getElementById("numeral-icon").classList.add(
            "fa-circle-xmark");
        document.getElementById("numeral-icon").classList.remove(
            "fa-circle-check");
        document.getElementById("numeral-icon").classList.add(
            "text-red-500");
        document.getElementById("numeral-icon").classList.remove(
            "text-green-500");
        error = true;
    }

    if (error) {
        document.getElementById("hint").style.display = "block";
    } else {
        document.getElementById("hint").style.display = "none";
    }


})
</script>