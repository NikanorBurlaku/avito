

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
    <div class="login__popup">
        <div class="login__block">
            <h2 class="login__title">Sign in</h2>
            <form action="" class="login__form" method="post">
                <input type="text" name="login" class="login__input" id="login__login" placeholder="Login">
                <input type="password" name="password" class="login__input" id="login__password" placeholder="Password">
                <input type="submit" class="login__submit" value="Enter">
            </form>
            <a href="register.php" class="login__href">sign in</a>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>
<?php

session_start(); 

if (!empty($_REQUEST['login']) and !empty($_REQUEST['password'])) {

    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];

    var_dump($_REQUEST);
    $link = require "database/connect.php";
    $query = "SELECT login, password FROM user WHERE login='$login'";
    $result = mysqli_query($link, $query) or die ($link);
    $user = mysqli_fetch_assoc($result);


    if (!empty($user)) {
        $_SESSION['login'] = $user['login'];
        $_SESSION['auth'] = 'true';
        header('Location: index.php');
    } else {
        echo "Неверный логин и/или пароль";
    }
} 
?>