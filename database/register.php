<?php

if(!empty($_POST)){
 
    if($_POST['password'] == $_POST['password_confirm']){
        
        $link = require 'connect.php';
        $login = $_POST['login'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

        $query = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($result);

        if($login == $user['login']){

            $alert = '<script>alert("придумайте другой пароль")</script>';

        } else {
            $query = "INSERT INTO users SET login='$login', login='$login', password='$password', name='$name', surname='$surname', email = '$email'";

            session_start();
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $alert = "<script>alert('добро пожаловать $name $surname')</script>";
        } 
    } else {
        $alert = '<script>alert("пароли не совпадают")</script>';
    } 

    return $alert;
    header('Location: index.php');
}
?>