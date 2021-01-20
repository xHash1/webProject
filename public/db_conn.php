<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

    $hname = 'localhost';
    $uName = 'root';
    $db_name = 'Simo';
    $pass = '';
try {
    $conn = new PDO("mysql:host=$hname;db_name=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'connected';
} catch(PDOException $e) {
    echo $e->getMessage();
    // echo 'connection failed';
}