<?php include "page/header.php";


if (!empty($_SESSION['auth'])) :
?>
    <div class="register__popup">
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
                <input type="submit" class="form__submit" value="sign in">
            </form>
        </div>
    </div>
<?php else : ?>
    <p class="error_text">please <a href="/login.php">sign in</a> or <a href="/register.php">sign up</a></p>
<?php endif; ?>
<script>
    const title = "add a new ad";

    let inputs = document.querySelectorAll('.input__file');
    Array.prototype.forEach.call(inputs, function (input) {
      let label = input.nextElementSibling,
        labelVal = label.querySelector('.input__file-button-text').innerText;

      input.addEventListener('change', function (e) {
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

if (!empty($_FILES)) {
    $name = "upload/" . $_FILES['filename']['name'];
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
}
