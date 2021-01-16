<?php
require 'db_conn.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

try {
    $query = "select * from Simo.product natural join Simo.cart;";
    $data = $conn->query($query);

    $totalq = $conn->query("select SUM(amount * price) AS total
        FROM Simo.cart NATURAL join Simo.product;");
    $total = $totalq->fetchColumn();
} catch (PDOException $e) {
    echo $e;
}

$delimiter = ";";
$filename = "Data-" . date('y-m-d-h-m-s') . ".csv";

// creating file pointer
$f = fopen('php://memory', 'w');

$fields = array('Title', 'amount', 'Price');
fputcsv($f, $fields, $delimiter);

foreach ($data as $row) {
    $lineData = array($row['title'], $row['amount'], $row['price']);
    fputcsv($f, $lineData, $delimiter);
}

$fields = array('', 'Total :', $total);
fputcsv($f, $fields, $delimiter);


fseek($f, 0);

header("Content-type: text/csv");

header("Content-Disposition: attachement; filename=$filename");

fpassthru($f);
