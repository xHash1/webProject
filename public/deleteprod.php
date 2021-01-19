<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

require 'db_conn.php';

// get page  : to gt back after u delete
// GET ID : for delete 

// echo $_GET['pagelink'];
// echo $_GET['page'];

// link if from index if showbycat
$link = isset($_GET['title']) ? $_GET['pagelink'].'&page='.$_GET['page'] : $_GET['page'];

if (isset($_GET['id'])) {

    try {
        $statement = $conn->prepare("delete from ".$db_name.".product where id = :id");
        $statement->bindParam(':id', $_GET['id']);
        $statement->execute();

    } catch (PDOException $e) {
        echo $e;
    }

    // if (!empty($_GET['title'])) {
    //     header('Location: ' . $_GET['pagelink'].'');
    // } else {
        header('Location: '. $link);
    // }

} else {
    // if (!empty($_GET['title'])) {
        
    // } else {
        header('Location: '. $link);
    //    echo $link;
    // }
}
