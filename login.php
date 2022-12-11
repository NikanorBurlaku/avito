<?php include "page/header.php"; ?>

<div class="login__popup">
    <div class="login__block">
        <h2 class="login__title">Sign in</h2>
        <form action="" class="login__form" method="post">
            <input type="text" name="login" class="login__input" id="login__login" placeholder="Login">
            <input type="password" name="password" class="login__input" id="login__password" placeholder="Password">
            <input type="submit" class="login__submit" value="Enter">
        </form>
        <a href="register.php" class="login__href">sign up</a>
    </div>
</div>

<script>
    const title = "Sign in";
</script>

<?php
include "page/footer.php";


session_start();

if (!empty($_REQUEST['login']) and !empty($_REQUEST['password'])) {

    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];

    var_dump($_REQUEST);
    $link = require "database/connect.php";
    $query = "SELECT login, password FROM user WHERE login='$login'";
    $result = mysqli_query($link, $query) or die($link);
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