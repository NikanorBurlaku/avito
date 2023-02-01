<?php include "page/header.php"; ?>

<div class="main__table">
    <div class="login__block">
        <h2 class="login__title">Sign in</h2>
        <form action="login.php" class="form" method="post">
            <input type="text" name="login" class="form__input" id="login__login" placeholder="Login">
            <input type="password" name="password" class="form__input" id="login__password" placeholder="Password">
            <input type="submit" class="form__submit" value="Enter">
        </form>
        <a href="register.php" class="form__href">sign up</a>
    </div>
</div>

<script>
    const title = "Sign in";
</script>

<?php

if (!empty($_REQUEST['login']) and !empty($_REQUEST['password'])) { // проверяем наличие пароля и логина

    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];

    $link = require "database/connect.php";
    $query = "SELECT login, password, status, block FROM user WHERE login='$login'";
    $result = mysqli_query($link, $query) or die($link);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {

        $hash = $user['password'];

        if (password_verify($_REQUEST['password'], $hash)){;

            if($user['block'] === 'true'){
                echo "<div class='error'><div class='error__block'><p class='error__text'>Sorry, your account is blocking</p><button class='error__button'>OK</button></div></div>";
            } else {
                $_SESSION['login'] = $user['login'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['auth'] = 'true';
                 header('Location: index.php');
            }
           
          } else {
            echo "<div class='error'><div class='error__block'><p class='error__text'>Invalid username and/or password</p><button class='error__button'>OK</button></div></div>";
          }
        
       
    } else {
        echo "<div class='error'><div class='error__block'><p class='error__text'>Invalid username and/or password</p><button class='error__button'>OK</button></div></div>";
    }
}

include "page/footer.php";


?>