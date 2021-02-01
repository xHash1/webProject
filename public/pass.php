<?php
require 'db_conn.php';


if(!defined('SOMETHING')) { die(); }

if(!empty($_POST['oldpassword']) && !empty($_POST['newpassword'])) {

    $password = $_POST['oldpassword'];

    try {
        $statement = $conn->prepare("select password from " . $db_name . ".users where username = ?");
        $statement->bindParam(1, $_SESSION['username']);
        $statement->execute();
        
        $user = $statement->fetch();
    
        if (password_verify($password, $user['password'])) {
            // then replace old password
            $newpass = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

            // hash first
            $statement = $conn->prepare("update " . $db_name . ".users set password = ? where username = ?");
            $statement->bindParam(1, $newpass);
            $statement->bindParam(2, $_SESSION['username']);
            $statement->execute();

            header('Location: logout.php');
        } else {
            echo 'wrong password';
        }
    } catch (PDOException $e) {
        echo $e;
    }
}