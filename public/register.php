<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-200 h-screen w-full flex justify-center items-center">
    <div class="bg-white w-96 rounded-lg shadow-md p-6">
        <h2 class="font-semibold text-4xl text-center">Register</h2>
        <form action="rg.php" method="POST">
            <div class="my-2">
                <label for="">username</label>
                <input class="bg-white w-full p-1 px-4 rounded-md focus:border-gray-400 placeholder-gray-500 border-gray-200 focus:ring-1 focus:ring-gray-500 outline-none focus:bg-white border text-sm placeholder-opacity-100 text-black py-2 font-normal subpixel-antialiased" name="username" type="text" placeholder="Username" required>
            </div>
            <div class="my-2">
                <label for="">Password</label>
                <input class="bg-white w-full p-1 px-4 rounded-md focus:border-gray-400 placeholder-gray-500 border-gray-200 focus:ring-1 focus:ring-gray-500 outline-none focus:bg-white border text-sm placeholder-opacity-100 text-black py-2 font-normal subpixel-antialiased" name="password" type="password" placeholder="Password" required>
            </div>
            <button class="mt-4 m-auto h-10 w-52 flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100" type="submit">Sign up</button>
        </form>
    </div>
</body>
</html>