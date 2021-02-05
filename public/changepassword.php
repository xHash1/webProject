<?php

define('SOMETHING', true);

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$filename = basename(__FILE__);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-gray-100">

    <!-- <<<<< container >>>>> -->
    <div class="flex justify-center w-8/12 m-auto h-full">

        <!--  <<<<< navbar >>>>  removed p-3 shadow bgwhite rounded-->
        <?php include 'navbar.php' ?>

        <!-- <<<<< main content >>>>>-->
        <div class="p-6 flex-grow flex-shrink-0 h-screen">

            <div class="m-6 max-w-2xl">
                <div class="bg-white rounded-md w-full shadow">
                    <form class="p-4" action="pass.php" method="POST">
                        <h1 class="flex-auto text-xl font-semibold m-2 pt-4">Change password</h1>
                        <div class="my-4">
                            <label for="">Old password</label>
                            <input class="mt-1 bg-white w-full p-1 px-4 rounded-md focus:border-gray-400 placeholder-gray-500 border-gray-200  outline-none focus:bg-white border text-sm placeholder-opacity-100 text-black py-2 font-normal subpixel-antialiased" type="password" name="oldpassword" id="" required>
                        </div>
                        <div class="my-4">
                            <label for="">New password</label>
                            <input class="mt-1 bg-white w-full p-1 px-4 rounded-md focus:border-gray-400 placeholder-gray-500 border-gray-200  outline-none focus:bg-white border text-sm placeholder-opacity-100 text-black py-2 font-normal subpixel-antialiased" type="password" name="newpassword" id="" required>
                        </div>

                        <button class="mb-2 h-10 w-36 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100 text-sm" type="submit">Change</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    </div>
</body>

</html>