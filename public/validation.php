<?php
require 'db_conn.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

try {
    $statement = $conn->prepare("select id, username, password from " . $db_name . ".users where username = ?");
    $statement->bindParam(1, $username);
    $statement->execute();


    $user = $statement->fetch();

    $id = $user['id'];
    $username = $user['username'];

    if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        header('Location: login.php');
    }
} catch (PDOException $e) {
    echo $e;
}