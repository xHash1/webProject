<?php

if(!defined('SOMETHING')) { die(); }

?>
<header class="h-12 flex items-center max-w-2xl">
        <form action="index.php" method="POST" class="relative w-full mt-4">
            <svg width="20" height="20" fill="currentColor" class="absolute left-6 top-1/2 transform -translate-y-1/2 text-gray-400">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
            </svg>
            <input class="bg-white w-full p-1 rounded-lg focus:border-gray-400 placeholder-gray-500 border-gray-200  outline-none focus:bg-white border text-base ml-3 placeholder-opacity-100 text-black py-2 pl-10 font-light subpixel-antialiased" type="text" name="title" placeholder="Find products" autocomplete="off" onfocus="this.value=''" value="<?php
            if(isset($_POST['title'])){
                echo $_POST['title'];
            }
            ?>">
        </form>
</header>