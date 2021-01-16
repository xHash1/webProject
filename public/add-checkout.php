<?php
require 'db_conn.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (!empty($_POST['id']) && !empty($_POST['amount'])) {

    // echo $_POST['id'];
    // echo $_POST['amount'];

    try {
        $statement = $conn->prepare("insert into Simo.cart (cart_id, id, amount)
                values (:cart_id, :id, :amount);
                ");
        $statement->execute(array(
            ':cart_id' => null,
            ':id' => $_POST['id'],
            ':amount' => $_POST['amount'],
        ));

    } catch (PDOException $e) {
        echo $e;
        // header('Location: addproduct.php?error=db error');
    }
    header('Location: index.php?title='.$_POST['title'].'&page='.$_POST['page']);

} else {
    header('Location: index.php?title='.$_POST['title'].'&page='.$_POST['page']);
}