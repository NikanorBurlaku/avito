<?php include "page/header.php";

if ($_SESSION['auth'] === 'true' and !empty($_SESSION['login'])) :


    $login = $_SESSION['login'];

    if (!empty($_REQUEST)) {
        $name = $_REQUEST['name'];
        $surname = $_REQUEST['surname'];
        $phone = $_REQUEST['phone'];
        $email = $_REQUEST['email'];

        if (empty($_FILES['file']['tmp_name'])) {
            $nameImg = $_REQUEST['nameImg'];
        } else {
            if (!empty($_FILES) && $_REQUEST['nameImg'] != 'default.png') {
                echo $_FILES["file"]["type"] . "<br>";
                $nameImg = str_replace(' ', '_', ($_REQUEST['name'] . "." . substr(($_FILES["file"]["type"]), 6))); //если загрузил, то привязывем к имени товара, но это нужно будет исправить и заменить на цикл
                if ($_FILES && $_FILES['file']['error'] == UPLOAD_ERR_OK) { //загружаем файл на сервер
                    $pathImg = "upload/" . $nameImg;
                    move_uploaded_file($_FILES['file']['tmp_name'], $pathImg);
                }
            } else {
                $nameImg = 'default.png';
            }
        }
        var_dump($_FILES);
        $updateUser = "UPDATE user SET name='$name', surname='$surname', phone='$phone', email='$email', img='$nameImg' WHERE login='$login'";
        mysqli_query($link, $updateUser);
    }

    $selectUser = "SELECT * FROM user WHERE login='$login'";
    $result = mysqli_query($link, $selectUser);
    $user = mysqli_fetch_assoc($result);
?>
    <div class="main__table">
        <div class="login__block">
            <h2 class="login__title">Your account:</h2>
            <form action="" class="form" method="post" enctype="multipart/form-data">
                <input type="text" class="form__input" name="name" placeholder="name" require value="<?= $user['name'] ?>">
                <input type="text" class="form__input" name="surname" placeholder="surname" value="<?= $user['surname'] ?>">
                <input type="phone" class="form__input" name="phone" placeholder="phone" require value="<?= $user['phone'] ?>">
                <input type="email" class="form__input" name="email" placeholder="email" require value="<?= $user['email'] ?>">
                <span style="font-weight: 800;">Your main photo:</span>
                <img class="form__img" src="../upload/<?= $user['img'] ?>" alt="">
                <input type="hidden" name="nameImg" value="<?= $user['img'] ?>">
                <div class="input__wrapper">
                    <input name="file" type="file" id="input__file" class="input input__file" multiple="">
                    <label for="input__file" class="input__file-button">
                        <span class="input__file-icon-wrapper"><img class="input__file-icon" src="../images/upload.svg" alt="select file" width="25"></span>
                        <span class="input__file-button-text">select file</span>
                    </label>
                </div>
                <input type="submit" class="form__submit" value="edit">
            </form>
            <a href="verify.php" class="form__href">verify</a>
        </div>
    </div>
<?php
endif;

?>
<script>
    const title = "account";

    let inputs = document.querySelectorAll('.input__file');
    Array.prototype.forEach.call(inputs, function(input) {
        let label = input.nextElementSibling,
            labelVal = label.querySelector('.input__file-button-text').innerText;

        input.addEventListener('change', function(e) { //код для анимации при выборе картинки
            let countFiles = '';
            if (this.files && this.files.length >= 1)
                countFiles = this.files.length;
                document.querySelector('.input__file-button').style.opacity = "0.7";
            if (countFiles)
                label.querySelector('.input__file-button-text').innerText = 'file selected';
            else
                label.querySelector('.input__file-button-text').innerText = labelVal;
        });
    });
</script>
<?php
include "page/footer.php";
?>