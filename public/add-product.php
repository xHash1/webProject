<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}


require 'db_conn.php';

if (isset($_FILES['image']['name']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price'])) {

    $target = "/opt/lampp/temp/".basename($_FILES['image']['name']);

    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    // check if title already exists
    $statement = $conn->prepare("select * from " . $db_name . ".product where title = :title");
    $statement->bindParam(':title', $title);
    $statement->execute();
    $data = $statement->fetchAll();

    if(empty($data)) {
        try {
            $statement = $conn->prepare("insert into " . $db_name . ".product (id, title, description, price, img_dir, cat_id)
                    values (:id, :title, :description, :price, :img_dir, :cat_id);
                    ");
            $statement->execute(array(
                ':id' => null,
                ':title' => $title,
                ':description' => $description,
                ':price' => $price,
                ':img_dir' => $image,
                ':cat_id' => !empty($_POST['category']) ? $category : null,
                // ':cat_id' => $category,
            ));

        } catch (PDOException $e) {
            // echo $e;
            header('Location: addproduct.php?error=db error');
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // echo 'uploaded';
            header('Location: addproduct.php?error=0');
            exit;
        } else {
            header('Location: addproduct.php?error=failed to upload');
        }
    } else {
        header('Location: addproduct.php?error=already exists');
    }
}