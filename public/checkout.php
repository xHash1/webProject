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
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-gray-100">
    <!-- container -->
    <div class="flex justify-center w-8/12 m-auto h-full">
        <!-- navbar -->
        <?php include 'navbar.php'; ?>
        <!-- main content -->
        <div class="flex-grow flex-shrink-0 h-screen">
            <div class="p-6 min-h-full">
                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-w-2xl">
                    <table class="border-collapse table-auto whitespace-no-wrap bg-white table-striped relative w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                    <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                        <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" onClick="toggle(this)">
                                    </label>
                                </th>
                                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Title</th>
                                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Amount</th>
                                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $total = 0;
                            try {
                                $query = "select * from " . $db_name . ".product natural join " . $db_name . ".cart;";
                                $data = $conn->query($query);

                                $totalq = $conn->query("select SUM(amount * price) AS total
                                    FROM " . $db_name . ".cart NATURAL join " . $db_name . ".product;");
                                $total = $totalq->fetchColumn();
                            } catch (PDOException $e) {
                                echo $e;
                            }

                            foreach ($data as $row) {
                                // $total = $total + $row['amount']*$row['price'];
                                echo '<tr>
                                            <td class="border-dashed border-t border-gray-200 px-3">
                                                <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                                    <input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" name="foo" value="' . $row['id'] . '">
                                                </label>
                                            </td>
                                            <td class="border-dashed border-t border-gray-200 userId">
                                                <span class="text-gray-700 px-6 py-3 flex items-center">' . $row['title'] . '</span>
                                            </td>
                                            <td class="border-dashed border-t border-gray-200">
                                                <span class="text-gray-700 px-6 py-3 flex items-center">' . $row['amount'] . '</span>
                                            </td>
                                            <td class="border-dashed border-t border-gray-200">
                                                <span class="text-gray-700 px-6 py-3 flex items-center">' . $row['price'] . ' MAD</span>
                                            </td>
                                        </tr>';
                            } ?>
                            <tr>
                                <td class="border-dashed border-t border-gray-200 px-3">
                                </td>
                                <td class="border-dashed border-t border-gray-200 userId">
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="sticky top-0 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-sm">Total</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo $total; ?> MAD</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="max-w-2xl flex justify-end">
                    <a class="my-2 h-10 w-28 mr-2 bg-white flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100 cursor-pointer" href="check-out.php?btn=clear" type="submit" name="exp">Clear</a>
                    <a class="my-2 h-10 w-52 bg-white flex items-center justify-center rounded-md border border-gray-300 focus:outline-none hover:bg-gray-100 cursor-pointer" href="csv.php" type="submit" name="exp">CSV Export</a>
                </div>
            </div>
        </div>
    </div>
    <script language="JavaScript">
        function toggle(source) {
            checkboxes = document.getElementsByName('foo');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</body>

</html>