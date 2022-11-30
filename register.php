<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <ul class="header__nav">
                <li><a href="#" class="header__link">help</a></li>
                <li><a href="#" class="header__link favorite"><img src="images/favorite.svg" class="header__img">favorites</a></li>
                <li><a href="#" class="header__link add"><img src="images/add.svg" class="header__img">place an ad</a></li>
                <li><a href="login.php" class="header__link">sign in</a> </li>
                <li><a href="register.php" class="header__link">register</a></li>
                <li><a href="#" class="header__link">your sity: <span class="header__city">Chishinau</span></a></li>
            </ul>
        </div>
    </header>
    <div class="register__popup">
        <div class="login__block">
            <h2 class="login__title">Sign in</h2>
            <form action="" class="login__form" method="post">
                <input type="text" class="login__input" name="login" placeholder="login" require>
                <input type="password" class="login__input" name="password" placeholder="password" autocomplete="off" require>
                <input type="password" class="login__input" name="confirm" placeholder="confirm" autocomplete="off" require>
                <input type="text" class="login__input" name="name" placeholder="name" require>
                <input type="text" class="login__input" name="surname" placeholder="surname">
                <input type="email" class="login__input" name="email" placeholder="email" require>

                <input type="submit" class="login__submit" value="sign in">
            </form>
            <a href="register.php" class="login__href">sign up</a>
            <span class="register__close"><img src="images/close.svg" alt=""></span>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>
<?php

session_start();


if (!empty($_REQUEST['login']) and !empty($_REQUEST['password']) and !empty($_REQUEST['confirm'])) {

    $login = $_REQUEST['login'];
    $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $phone = '';
    $email = $_REQUEST['email'];
    $verify = 'false';
    $status = 'user';
    $img = '';
    $date_reg = date("Y-m-d");

    $link = require "database/connect.php";
    $query1 = "SELECT login FROM user WHERE login='$login'";
    $user = mysqli_fetch_assoc(mysqli_query($link, $query1));

    if (empty($user)){

        if($_REQUEST['password'] == $_REQUEST['confirm']){

            $query2 = "INSERT INTO user SET
            login='$login',
            password='$password',
            name='$name',
            surname='$surname',
            email='$email',
            phone='$phone',
            verify='$verify',
            status='$status',
            img='$img',
            date_reg='$date_reg'";
            mysqli_query($link, $query2) or die(mysqli_error($link));

            $_SESSION['auth'] = 'true';
            $_SESSION['login'] = $login;
            header('Location: index.php');
        } else {
            echo "Пароли не совпадают, попробуйте снова";
        }

    } else {
        echo "Этот логин занят";
    }
}

?>