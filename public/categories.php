<?php

require 'db_conn.php';

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
    <title>Categories</title>
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
                <div class="bg-white rounded-md w-full min-h-80 shadow px-8 pb-5">
                    <h1 class="flex-auto text-xl font-semibold m-2 pt-4">Categories</h1>
                    <form class="px-4 flex justify-around items-center " action="cat.php" method="POST">
                        <input class="bg-white w-full p-1 rounded-lg focus:border-gray-400 placeholder-gray-500 border-gray-200  outline-none focus:bg-white border text-base  placeholder-opacity-100 text-black py-2 pl-10 font-light subpixel-antialiased" name="title" type="text" placeholder="add new categorie" autocomplete="off">
                        <button style="margin-left: 16px;" class="ml-2 h-10 w-36 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100 text-sm" type="submit">Add</button>
                    </form>

                    <div>
                    <table class="border-collapse table-auto whitespace-no-wrap bg-white table-striped relative w-full">

                        <tbody>
                            <?php
                            // $total = 0;
                            try {
                                $statement = $conn->prepare("select * from " . $db_name . ".cat");
                                 // $statement->bindParam(':title', $title);
                                $statement->execute();
                                $data = $statement->fetchAll();
                            } catch (PDOException $e) {
                                echo $e;
                            }


                            if (!empty($data)) {
                            foreach ($data as $row) {
                                $statement2 = $conn->prepare("select * from " . $db_name . ".product where cat_id = :cat_id");
                                 $statement2->bindParam(':cat_id', $row['cat_id']);
                                $statement2->execute();
                                $data2 = $statement2->fetchAll();
                                $nbr_prod_in_cat = sizeof($data2);
                                // $total = $total + $row['amount']*$row['price'];
                                echo '<tr>
                                            <td class="border-dashed border-t border-gray-200 px-3">
                                                <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                                    <input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" name="foo" value="' . $row['cat_id'] . '" disabled>
                                                </label>
                                            </td>
                                            <td class="border-dashed border-t border-gray-200 userId">
                                                <a href="showbycat.php?cat_id=' . $row['cat_id'] . '" ><span class="text-gray-700 px-6 py-3 flex items-center">' . $row['title'] . '</span></a>
                                            </td>
                                            <td class="border-dashed border-t border-gray-200">
                                                <span class="text-gray-700 px-6 py-3 flex items-center">' . $nbr_prod_in_cat . '</span>
                                            </td>
                                            <td class="flex justify-end items-center h-full border-dashed border-t border-gray-200">
                                                <a class="text-gray-700 px-6 py-3 flex items-center hover:text-gray-500" href="showbycat.php?delete=' . $row['cat_id'] . '">Delete</a>
                                            </td>
                                        </tr>';
                            } }?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>  

        </div>
    </div>

</div>
</body>
</html>