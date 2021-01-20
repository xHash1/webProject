<?php
require 'db_conn.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
try {
    $statement = $conn->prepare("truncate " . $db_name . ".cart;");
    $statement->execute();
} catch (PDOException $e) {
    echo $e;
}
header('Location: checkout.php');