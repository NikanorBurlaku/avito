<?php include "page/header.php"; 
if (!empty($_SESSION['auth'])) :
?>
    <div class="main__table">
        <div class="login__block">
            <h2 class="login__title">add a new ad</h2>
            <form action="" class="form" method="post" enctype="multipart/form-data">
                <input type="text" class="form__input" name="name" placeholder="name" require>
                <select name="catName" class="form__select">
                    <option value="select category">select category</option>
                    <?php
                    $link = require './database/connect.php';
                    $query = "SELECT * FROM category ORDER BY name";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));

                    $categories = '';

                    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) {
                        $row['name'] = strtolower($row['name']);
                        $catName = str_replace('_', ' ', $row['name']);
                        echo "<option value='$catName'>$catName</option>";
                    }
                    ?>
                </select>
                <textarea type="text" class="form__textarea" name="descr" placeholder="description" require></textarea>
                <input type="text" class="form__input" name="price" placeholder="price ($)" require>
                <input type="text" class="form__input" name="adress" placeholder="adress" require>
                <div class="input__wrapper">
                    <input name="file" type="file" id="input__file" class="input input__file" multiple="">
                    <label for="input__file" class="input__file-button">
                        <span class="input__file-icon-wrapper"><img class="input__file-icon" src="images/upload.svg" alt="select file" width="25"></span>
                        <span class="input__file-button-text">select file</span>
                    </label>
                </div>
                <input type="submit" class="form__submit" value="add">
            </form>
        </div>
    </div>
<?php else : ?>
    <p class="error_text">please <a href="/login.php">sign in</a> or <a href="/register.php">sign up</a></p>
<?php endif; ?>
<script>
    const title = "add a new ad";

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
include "page/footer.php";



if (!empty($_REQUEST)) {
    $login = $_SESSION['login'];
    $category = $_REQUEST['catName'];
    if ($category == 'select category'){ //если пользователь не выбрал категорию, значит ставим остальное
        $category = 'other';
    };
    

    $name = $_REQUEST['name'];
    $descr = $_REQUEST['descr'];
    $price = $_REQUEST['price'];
    $adress = $_REQUEST['adress'];
    $dateCreate = date("Y-m-d H:i");
    if(empty($_FILES)){  //выбор имени для картинки
        $nameImg = 'default.png';   //если пользователь не загрузил картинку, то ставим по умолчанию
    } else{
        $nameImg = str_replace(' ', '_', ($_REQUEST['name'] . "." . substr(($_FILES["file"]["type"]), 6))); //если загрузил, то привязывем к имени товара, но это нужно будет исправить и заменить на цикл
    }

    $query2 = "SELECT id FROM user WHERE login='$login'"; //выбираем id юзера по логину, который в сессии и ниже добавляем его в качестве владельца
    $result2 = mysqli_query($link, $query2);
    $userId = mysqli_fetch_assoc($result2);
    $userId = $userId['id'];

    $query3 = "SELECT id FROM category WHERE name='$category'"; //выбираем id категории
    $result3 = mysqli_query($link, $query3);
    $catId = mysqli_fetch_assoc($result3);
    $catId = $catId['id'];

    $query4 = "INSERT INTO product SET
    id_categ='$catId',
    id_user='$userId',
    name='$name',
    descr='$descr',
    price='$price',
    view='0',
    img='$nameImg',
    adress='$adress',
    date_create='$dateCreate'
    ";
    $result4 = mysqli_query($link, $query4) or die(mysqli_error($link));


if ($_FILES && $_FILES['file']['error'] == UPLOAD_ERR_OK) { //загружаем файл на сервер
    $name = "upload/" . $nameImg;
    move_uploaded_file($_FILES['file']['tmp_name'], $name);
}

    header("Location: index.php");
}


