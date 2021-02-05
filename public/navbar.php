<?php
require 'db_conn.php';

if(!defined('SOMETHING')) { die(); }

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
            <img class="h-12 rounded-full" src="images/admin.jpg" alt="James Bhatta">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M19,3H5C3.895,3,3,3.895,3,5v5c0,0.552,0.448,1,1,1h10V9.334c0-0.617,0.745-0.925,1.181-0.489l2.58,2.58 c0.318,0.318,0.318,0.833,0,1.15l-2.58,2.58C14.745,15.592,14,15.283,14,14.666V13H4c-0.552,0-1,0.448-1,1v5c0,1.105,0.895,2,2,2h14 c1.105,0,2-0.895,2-2V5C21,3.895,20.105,3,19,3z" />
                        </svg>
                    </span>
                    <div class="flex w-full">
                        <div class="w-full"><span>All Products</span></div>
                        <div class="flex justify-center w-full"><span class=""><?php
                         if (isset($number_of_results)) {
                         echo $number_of_results; 
                         }
                         ?></span></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="addproduct.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'addproduct.php') ? 'bg-gray-200' : ''; ?> focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="">
                            <path d="M 5 3 C 3.895 3 3 3.895 3 5 L 3 7 L 3 19 C 3 20.105 3.895 21 5 21 L 13 21 C 13.552 21 14 20.552 14 20 C 14 19.448 13.552 19 13 19 L 5 19 L 5 7 L 19 7 L 18.998047 13 C 18.998047 13.552 19.446047 14 19.998047 14 C 20.550047 14 20.998047 13.552 20.998047 13 L 20.998047 7 L 21 7 L 21 5 C 21 3.895 20.105 3 19 3 L 5 3 z M 7.5 10 C 7.224 10 7 10.224 7 10.5 L 7 11.5 C 7 11.776 7.224 12 7.5 12 L 8.5 12 C 8.776 12 9 11.776 9 11.5 L 9 10.5 C 9 10.224 8.776 10 8.5 10 L 7.5 10 z M 12 10 C 11.448 10 11 10.448 11 11 C 11 11.552 11.448 12 12 12 L 16 12 C 16.552 12 17 11.552 17 11 C 17 10.448 16.552 10 16 10 L 12 10 z M 7.5 14 C 7.224 14 7 14.224 7 14.5 L 7 15.5 C 7 15.776 7.224 16 7.5 16 L 8.5 16 C 8.776 16 9 15.776 9 15.5 L 9 14.5 C 9 14.224 8.776 14 8.5 14 L 7.5 14 z M 12 14 C 11.448 14 11 14.448 11 15 C 11 15.552 11.448 16 12 16 L 16 16 C 16.552 16 17 15.552 17 15 C 17 14.448 16.552 14 16 14 L 12 14 z M 19.984375 15.986328 A 1.0001 1.0001 0 0 0 19 17 L 19 19 L 17 19 A 1.0001 1.0001 0 1 0 17 21 L 19 21 L 19 23 A 1.0001 1.0001 0 1 0 21 23 L 21 21 L 23 21 A 1.0001 1.0001 0 1 0 23 19 L 21 19 L 21 17 A 1.0001 1.0001 0 0 0 19.984375 15.986328 z"></path>
                        </svg>
                    </span>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="categories.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'categories.php') ? 'bg-gray-200' : ''; ?> focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                        <path d="M 7 3 C 5.9069372 3 5 3.9069372 5 5 L 7 5 L 17 5 L 19 5 C 19 3.9069372 18.093063 3 17 3 L 7 3 z M 6 7 C 4.9069372 7 4 7.9069372 4 9 L 4 15 L 2 15 L 2 19 C 2 20.093063 2.9069372 21 4 21 L 20 21 C 21.093063 21 22 20.093063 22 19 L 22 15 L 20 15 L 20 9 C 20 7.9069372 19.093063 7 18 7 L 6 7 z M 6 9 L 18 9 L 18 15 L 13.585938 15 L 13 15.585938 C 12.734313 15.851623 12.375417 16 12 16 C 11.624583 16 11.265687 15.851623 11 15.585938 L 10.414062 15 L 6 15 L 6 9 z M 4 17 L 9.5859375 17 C 10.226251 17.640313 11.095417 18 12 18 C 12.904583 18 13.773749 17.640313 14.414062 17 L 20 17 L 20 19 L 4 19 L 4 17 z"></path></svg>
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
                    <div class="flex w-full">
                        <div class="w-full"><span>Checkout</span></div>
                        <div class="w-full flex justify-center"><span class=""><?php echo $number_of_results2; ?></span></div>
                    </div>
                </a>
            </li>
            <!-- <li>
                <a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span>My profile</span>
                </a>
            </li> -->
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
            <!-- <li>
                <a href="settings.php" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 <?php echo ($filename == 'settings.php') ? 'bg-gray-200' : ''; ?> focus:bg-gray-200 focus:shadow-outline">
                    <span class="text-gray-600">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </span>
                    <span>Settings</span>
                </a>
            </li> -->
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