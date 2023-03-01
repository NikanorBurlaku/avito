<?php include "page/header.php"; ?>

    <div class="main__table">
        <div class="login__block">
            <h2 class="login__title">Sign up</h2>
            <form action="" class="form" method="post" enctype="multipart/form-data">
                <input type="text" class="form__input" name="login" placeholder="login" require>
                <input type="password" class="form__input" name="password" placeholder="password" autocomplete="off" require>
                <input type="password" class="form__input" name="confirm" placeholder="confirm" autocomplete="off" require>
                <input type="text" class="form__input" name="name" placeholder="name" require>
                <input type="text" class="form__input" name="surname" placeholder="surname">
                <input type="email" class="form__input" name="email" placeholder="email" require>
                <div class="input__wrapper">
                    <input name="file" type="file" id="input__file" class="input input__file" multiple="">
                    <label for="input__file" class="input__file-button">
                        <span class="input__file-icon-wrapper"><img class="input__file-icon" src="../images/upload.svg" alt="select file" width="25"></span>
                        <span class="input__file-button-text">select file</span>
                    </label>
                </div>
                <input type="submit" class="form__submit" value="sign up">
            </form>
            <a href="login.php" class="form__href">sign in</a>
        </div>
    </div>


    <script>
    const title = "sign up";

    let inputs = document.querySelectorAll('.input__file');
    Array.prototype.forEach.call(inputs, function(input) {
        let label = input.nextElementSibling,
            labelVal = label.querySelector('.input__file-button-text').innerText;

        input.addEventListener('change', function(e) { //код для анимации при выборе картинки
            let countFiles = '';
            if (this.files && this.files.length >= 1)
                countFiles = this.files.length;

            if (countFiles)
                label.querySelector('.input__file-button-text').innerText = 'selected files: ' + countFiles;
            else
                label.querySelector('.input__file-button-text').innerText = labelVal;
        });
    });
</script>

<?php

if (!empty($_REQUEST['login']) and !empty($_REQUEST['password']) and !empty($_REQUEST['confirm'])) {

    $login = $_REQUEST['login'];
    $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT); //хэшируем пароль
    $name = $_REQUEST['name'];
    $surname = $_REQUEST['surname'];
    $phone = '';
    $email = $_REQUEST['email'];
    $verify = 'false';
    $status = 'user';
    $img = $_REQUEST['login'];
    $date_reg = date("Y-m-d");

    $link = require "database/connect.php";
    $query1 = "SELECT login FROM user WHERE login='$login'";
    $user = mysqli_fetch_assoc(mysqli_query($link, $query1));

    if (empty($user)){

        if($_REQUEST['password'] == $_REQUEST['confirm']){

            if(empty($_FILES)){  //выбор имени для картинки
                $img = 'default.png';   //если пользователь не загрузил картинку, то ставим по умолчанию
            } else{
                $img = $login . "." . substr(($_FILES["file"]["type"]), 6);
               //если загрузил, то привязывем к имени товара, но это нужно будет исправить и заменить на цикл
            }

            $query2 = "INSERT INTO user SET
            login='$login',
            password='$password',
            name='$name',
            surname='$surname',
            email='$email',
            phone='$phone',
            verify='$verify',
            status='$status',
            block='false',
            img='$img',
            date_reg='$date_reg'";
            mysqli_query($link, $query2) or die(mysqli_error($link));

            if ($_FILES && $_FILES['file']['error'] == UPLOAD_ERR_OK) { //загружаем файл на сервер
                $name = "upload/" . $img;
                move_uploaded_file($_FILES['file']['tmp_name'], $name);
            }

            $_SESSION['auth'] = 'true';
            $_SESSION['status'] = 'user';
            $_SESSION['login'] = $login;

            header('Location: ../index.php');
        } else {
            echo "<div class='error'><div class='error__block'><p class='error__text'>Passwords do not match, please try again</p><button class='error__button'>OK</button></div></div>";
        }

    } else {
        echo "<div class='error'><div class='error__block'><p class='error__text'>This login is busy</p><button class='error__button'>OK</button></div></div>";
    }
}

include "page/footer.php";
?>