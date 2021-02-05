<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

require 'db_conn.php';

if ($_GET['pagename'] == 'index.php') {
    $link = $_GET['pagename'].'?title='.$_GET['title'].'&page='.$_GET['page'];
} else {
    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $link = $_GET['pagename'].'?cat_id='.$_GET['cat_id'].'&page='.$page;
}

if (isset($_GET['id'])) {

    try {
        $statement = $conn->prepare("delete from " . $db_name . ".product where id = :id");
        $statement->bindParam(':id', $_GET['id']);
        $statement->execute();
    } catch (PDOException $e) {
        echo $e;
    }

    header('Location: ' . $link);   

} else {
    header('Location: ' . $link);
}
