<?php

require 'db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
try {
    $statement = $conn->prepare("insert into " . $db_name . ".users (username, password)
    values(:username, :password)");
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashed_password);
    $statement->execute();
} catch (PDOException $e) {
    echo $e;
}