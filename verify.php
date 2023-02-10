<?php
    include "page/header.php";
?>

<div class="main__table">
        <div class="login__block">
            <h2 class="login__title">please, enter your email:</h2>
            <form action="account/send_email.php" class="form" method="post">
                <input type="email" class="form__input" name="email" placeholder="email" require >
                <input type="submit" class="form__submit" value="send code">
            </form>
        </div>
    </div>
<script>
    const title = "verify";
</script>
<?php



include "page/footer.php";
?>