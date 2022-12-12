<?php include "page/header.php"; ?>

    <div class="register__popup">
        <div class="login__block">
            <h2 class="login__title">Sign up</h2>
            <form action="" class="form" method="post">
                <input type="text" class="form__input" name="login" placeholder="login" require>
                <input type="password" class="form__input" name="password" placeholder="password" autocomplete="off" require>
                <input type="password" class="form__input" name="confirm" placeholder="confirm" autocomplete="off" require>
                <input type="text" class="form__input" name="name" placeholder="name" require>
                <input type="text" class="form__input" name="surname" placeholder="surname">
                <input type="email" class="form__input" name="email" placeholder="email" require>

                <input type="submit" class="form__submit" value="sign in">
            </form>
            <a href="login.php" class="form__href">sign in</a>
        </div>
    </div>


    <script>
    const title = "Sign up";
</script>

<?php
include "page/footer.php";



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