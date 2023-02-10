<?php include "page/header.php"; 

if($_SESSION['auth'] === 'true' and !empty($_SESSION['login'])):
    $login = $_SESSION['login'];
    $link = require_once('database/connect.php');

    $selectUser = "SELECT * FROM user WHERE login='$login'";
    $result = mysqli_query($link, $selectUser);
    $user = mysqli_fetch_assoc($result);
?>
 <div class="main__table">
        <div class="login__block">
            <h2 class="login__title">Your account:</h2>
            <form action="" class="form" method="post" enctype="multipart/form-data">
                <input type="text" class="form__input" name="login" placeholder="login" require value="<?= $user['login']?>">
                <input type="text" class="form__input" name="name" placeholder="name" require value="<?= $user['name']?>">
                <input type="text" class="form__input" name="surname" placeholder="surname" value="<?= $user['name']?>">
                <input type="email" class="form__input" name="email" placeholder="email" require value="<?= $user['name']?>">
                <div class="input__wrapper">
                    <input name="file" type="file" id="input__file" class="input input__file" multiple="">
                    <label for="input__file" class="input__file-button">
                        <span class="input__file-icon-wrapper"><img class="input__file-icon" src="images/upload.svg" alt="select file" width="25"></span>
                        <span class="input__file-button-text">select file</span>
                    </label>
                </div>
                <input type="submit" class="form__submit" value="edit">
            </form>
            <a href="account/verify.php" class="form__href">verify</a>
        </div>
    </div>
<?php
endif; ?>
<script>
    const title = "account";
</script>
<?php
include "page/footer.php";
?>