<?php
require 'db_conn.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_POST['title'])) {

    $title = $_POST['title'];

    // [[[[[[check if title already exists

    $statement = $conn->prepare("select * from Simo.cat where title = :title");
    $statement->bindParam(':title', $title);
    $statement->execute();
    $data = $statement->fetchAll();

    if (empty($data)) {
        try {
            $statement = $conn->prepare("insert into Simo.cat
                values (:cat_id, :title);
                ");
            $statement->execute(array(
                ':cat_id' => null,
                ':title' => $title,
            ));
        } catch (PDOException $e) {
            echo $e;
            // header('Location: categories.php');
        }
        header('Location: categories.php');
    } else {
        header('Location: categories.php');
    }

} else {
    header('Location: categories.php');
}
