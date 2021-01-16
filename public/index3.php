<?php 
    require 'db_conn.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                <!-- send search -->

                <?php 
                    $query = "SELECT * FROM Simo.product";
                    $data = $conn->query($query);

                    foreach ($data as $row) {
                        echo '
                        
                <div class="flex max-w-2xl h-60 m-3 bg-white rounded-lg overflow-hidden shadow">
                    <div class="flex-none w-48 relative">
                    <img src="images/'.$row["img_dir"].'" alt="" class="absolute inset-0 w-full h-full object-cover" />
                    </div>
                    <form class="flex-auto p-6">
                    <div class="flex flex-wrap">
                        <h1 class="flex-auto text-xl font-semibold">
                        '.$row["title"].'
                        </h1>
                        <div class="text-xl font-semibold text-gray-500">
                        '.$row["price"].' MAD
                        </div>
                        <div class="w-full flex-none text-sm font-medium text-gray-500 mt-2">
                        In stock
                        </div>
                    </div>
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex items-baseline mt-2 mb-4 overflow-hidden">
                            <p>'.$row["description"].'</p>
                        </div>
                        <div class="flex space-x-3 mb-10 text-sm font-medium justify-between">
                                <!-- gte btn -->
                            <div class="custom-number-input h-10 w-32">
                                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent">
                                <button data-action="decrement" type="button" class="bg-white border-gray-300 border text-gray-600 hover:text-gray-700 hover:bg-gray-100 h-full w-20 rounded-l-md cursor-pointer outline-none border-r-0">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                </button>
                                <input type="number" class="outline-none focus:outline-none text-center w-full bg-white border-gray-300 border font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="1"></input>
                                <button data-action="increment" type="button" class="bg-white border-gray-300 border text-gray-600 hover:text-gray-700 hover:bg-gray-100 h-full w-20 rounded-r-md cursor-pointer border-l-0">
                                <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                            </div>
                            <button class="h-10 w-52 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100" type="button">Add to bag</button>
                        </div>
                    </div>
                    <!-- <p class="text-sm text-gray-500">
                        Free shipping on all continental US orders.
                    </p> -->
                    </form>
                </div>'; 
                    }
                ?>
                <!-- end card -->
                

                <!-- page numbers -->
                <div class="flex justify-center max-w-2xl my-9">
                    <div class="flex h-8 font-medium ">
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-transparent">1</div>
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-orange-600  ">2</div>
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-transparent">3</div>
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-transparent">...</div>
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-transparent">13</div>
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-transparent">14</div>
                        <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  border-t-2 border-transparent">15</div>
                        <div class="w-8 h-8 md:hidden flex justify-center items-center cursor-pointer leading-5 transition duration-150 ease-in border-t-2 border-indigo-400">2</div>
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
          if (value >0) {
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