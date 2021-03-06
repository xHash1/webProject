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
    <title>Settings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100">

    <!-- <<<<< container >>>>> -->
    <div class="flex justify-center w-8/12 m-auto h-full">

        <!--  <<<<< navbar >>>>  removed p-3 shadow bgwhite rounded-->
        <?php include 'navbar.php' ?>
        
        <!-- <<<<< main content >>>>>-->
        <div class="flex-grow flex-shrink-0 h-screen">

            <div class="p-6 max-w-2xl">
                <div class="bg-white rounded-md w-full h-80 shadow">
                    <!-- <form class="p-4" action="">
                        <h1 class="flex-auto text-xl font-semibold m-2 pt-4">Settings</h1>
                        <label for="">products in each page :</label>
                        <input type="text" value="">
                        <button class="mb-2 h-10 w-36 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100 text-sm" type="submit">Save</button>
                    </form> -->
                </div>
            </div>  

        </div>
    </div>

</div>
</body>
</html>