<?php
require 'db_conn.php';

if(!defined('SOMETHING')) { die(); }

// session_start();
// if (!isset($_SESSION['username'])) {
//     header('Location: login.php');
// }

try {
    $statement2 = $conn->prepare("select * from " . $db_name . ".cart");
    $statement2->execute();
} catch (PDOException $e) {
    echo $e;
}
$data2 = $statement2->fetchAll();

$number_of_results2 = sizeof($data2);

// num of categs
try {
    $statement3 = $conn->prepare("select * from " . $db_name . ".cat");
    $statement3->execute();
} catch (PDOException $e) {
    echo $e;
}
$data3 = $statement3->fetchAll();

$number_of_cats = sizeof($data3);

?>
<div class="w-60 flex-shrink-0 p-3 relative h-full">
    <div class="fixed w-60 p-3 top-0">
        <div class="flex items-center space-x-4 p-2 mb-5">
            <img class="h-12 rounded-full" src="images/admin.png" alt="James Bhatta">
            <div>
                <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide"><?php echo $_SESSION['username']; ?></h4>
                <span class="text-sm tracking-wide flex items-center space-x-1">
                    <span class="text-gray-600">Admin</span>
                </span>
            </div>
        </div>
        <ul class="space-y-2 text-sm">
            <li>
                <a href="index.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'index.php') ? 'bg-gray-200' : ''; ?> focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <div class="flex w-full">
                        <div class="w-full"><span>All Products</span></div>
                        <div class="flex justify-center w-full"><span class=""><?php
                         echo $number_of_results; 
                         ?></span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="addproduct.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'addproduct.php') ? 'bg-gray-200' : ''; ?> focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="categories.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'categories.php') ? 'bg-gray-200' : ''; ?> focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <div class="flex w-full">
                        <div class="w-full"><span>Categories</span></div>
                        <div class="flex justify-center w-full"><span class=""><?php echo $number_of_cats; ?></span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php if($number_of_results2 == 0) { echo '#'; } else {echo 'checkout.php';} ?>" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'checkout.php') ? 'bg-gray-200' : ''; ?> focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </span>
                    <!-- <span>checkout</span> -->
                    <div class="flex w-full">
                        <div class="w-full"><span>Checkout</span></div>
                        <div class="w-full flex justify-center"><span class=""><?php echo $number_of_results2; ?></span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span>My profile</span>
                </a>
            </li>
            <li>
                <a href="changepassword.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'changepassword.php') ? 'bg-gray-200' : ''; ?> focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <span>Change password</span>
                </a>
            </li>
            <li>
                <a href="settings.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'settings.php') ? 'bg-gray-200' : ''; ?> focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </span>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>