<?php
require 'db_conn.php';

define('SOMETHING', true);

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_GET['delete'])) {
    $cat_id = $_GET['delete'];

    try {
        $st = $conn->prepare("delete from " . $db_name . ".cat where cat_id = :cat_id");
        // $statement->execute(array(
        //     ':cat_id' => $cat_id
        // ));
        $st->bindParam(':cat_id', $cat_id);
        $st->execute();
    } catch (PDOException $e) {
        echo $e;
    }
    header('Location: categories.php');
}

$cat_id = $_GET['cat_id'];

// limit 0,5

try {
    $statement = $conn->prepare("select * from " . $db_name . ".product where cat_id = :cat_id");
    // $statement->execute(array(
    //     ':cat_id' => $cat_id
    // ));
    $statement->bindParam(':cat_id', $cat_id);
    $statement->execute();
} catch (PDOException $e) {
    echo $e;
}
$data = $statement->fetchAll();

$results_per_page = 5;
$number_of_results = sizeof($data);
$number_of_pages = ceil($number_of_results / $results_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$this_page_first_result = ($page - 1) * $results_per_page;

try {
    $statement = $conn->prepare("select * from " . $db_name . ".product where cat_id = :cat_id LIMIT :min,:max");
    $statement->bindParam(':cat_id', $cat_id);
    $statement->bindParam(':min', $this_page_first_result, PDO::PARAM_INT);
    $statement->bindParam(':max', $results_per_page, PDO::PARAM_INT);
    $statement->execute();
} catch (PDOException $e) {
    echo $e;
}
$data = $statement->fetchAll();


// cat info title and id ..
try {
    $statement4 = $conn->prepare("select * from " . $db_name . ".cat where cat_id = :cat_id");
    $statement4->bindParam(':cat_id', $cat_id);
    // $statement->bindParam(':min', $this_page_first_result, PDO::PARAM_INT);
    // $statement->bindParam(':max', $results_per_page, PDO::PARAM_INT);
    $statement4->execute();
} catch (PDOException $e) {
    echo $e;
}

$cat_info = $statement4->fetch();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cat_info['title']; ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-number-input input:focus {
            outline: none !important;
        }

        .custom-number-input button:focus {
            outline: none !important;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- <<<<< container >>>>> -->
    <div class="flex justify-center w-8/12 m-auto h-full">

        <!--  <<<<< navbar >>>>  removed p-3 shadow bgwhite rounded-->
        <?php include 'navbar.php' ?>

        <!-- <<<<< main content >>>>>-->
        <div class="flex-grow flex-shrink-0 h-screen">

            <!-- content products collections -->
            <div class="p-3 min-h-full">
                <!-- search -->
                <?php include 'search-bar.php' ?>
                <!-- end search -->

                <?php

                // print title of cat
                echo '<h1 class="flex-auto text-xl font-semibold m-2 pl-4 pt-4">' . $cat_info['title'] . '</h1>';
                // echo $cat_info['title'];

                if (!empty($data)) {
                    //echo '<input type="hidden" name="titlesearch" value="'.$title.'">';
                    foreach ($data as $row) {
                        echo '
                    <div class="flex max-w-2xl h-60 m-3 bg-white rounded-lg overflow-hidden shadow">
                    <div class="im flex-none w-48 relative">
                        <img src="images/' . $row["img_dir"] . '">
                        </div>
                        <form action="add-checkout.php" method="POST" class="flex-auto p-6 h-full">
                        <div class="flex flex-wrap">
                            <input type="hidden" name="id" value="' . $row["id"] . '">
                            <input type="hidden" name="title" value="' . $title . '">
                            <input type="hidden" name="page" value="' . $page . '">
                            <h1 class="flex-auto text-xl font-semibold">
                            ' . $row["title"] . '
                            </h1>
                            <div class="text-xl font-semibold text-gray-500">
                            ' . $row["price"] . ' MAD
                            </div>
                            <div class="w-full flex-none text-sm font-medium text-gray-500 mt-2">
                            In stock
                            </div>
                        </div>
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex items-baseline mt-2 mb-4 overflow-hidden">
                                <p>' . $row["description"] . '</p>
                            </div>
                            <div class="flex space-x-3 mb-10 text-sm font-medium justify-between">

                                <!-- delete btn -->
                                <a href="deleteprod.php?id='.$row["id"].'&pagename=showbycat.php&cat_id='.$cat_id.'&page='.$page.'" style="width : 72px;" class="font-normal h-10 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100" >Delete</a>

                                <!-- gte btn -->
                                <div class="custom-number-input h-10 w-32 mb-4">
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent">
                                    <button data-action="decrement" type="button" class="bg-white border-gray-300 border text-gray-600 hover:text-gray-700 hover:bg-gray-100 h-full w-20 rounded-l-md cursor-pointer outline-none border-r-0">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input name="amount" type="number" class="outline-none focus:outline-none text-center w-full bg-white border-gray-300 border font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700" name="custom-input-number" value="1"></input>
                                    <button data-action="increment" type="button" class="bg-white border-gray-300 border text-gray-600 hover:text-gray-700 hover:bg-gray-100 h-full w-20 rounded-r-md cursor-pointer border-l-0">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                                </div>
                                <button class="h-10 w-52 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100" type="submit">Add to bag</button>
                            </div>
                        </div>
                        </form>
                    </div>';
                    }
                } else {
                    $notfound = 1;
                    echo '<div class="max-w-2xl h-32 flex justify-center items-center">
                    <p class="text-lg text-gray-500">Empty</p>
                    </div>';
                }
                ?>


                <!-- page numbers -->
                <div class="flex justify-center max-w-2xl my-9">
                    <div class="flex h-8 font-medium ">
                        <?php
                        if ($notfound != 1) {
                            for ($pagenum = 1; $pagenum <= $number_of_pages; $pagenum++) {
                                echo '<a href="showbycat.php?cat_id=' . $cat_id . '&page=' . $pagenum . '" class="w-8 md:flex justify-center items-center hidden cursor-pointer leading-5';
                                $y = ($pagenum == $page) ? ' border-gray-500' : '';
                                echo $y;
                                echo ' border-t-2 border-transparent">' . $pagenum . '</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function decrement(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            if (value > 0) {
                value--;
                target.value = value;
            }
        }

        function increment(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value++;
            target.value = value;
        }

        const decrementButtons = document.querySelectorAll(
            `button[data-action="decrement"]`
        );

        const incrementButtons = document.querySelectorAll(
            `button[data-action="increment"]`
        );

        decrementButtons.forEach(btn => {
            btn.addEventListener("click", decrement);
        });

        incrementButtons.forEach(btn => {
            btn.addEventListener("click", increment);
        });
    </script>
</body>

</html>