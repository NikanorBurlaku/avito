<?php

function gen_password($length = 6)
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	return substr(str_shuffle($chars), 0, $length);
}
$code = gen_password(6);
$code = '111'; //после завершения всех работ обязательно убрать это!!!

$to = $_REQUEST['email'];
$subject = 'nicanorburlacu@gmail.com';
$message = 'your code: ' . $code;
$headers = "from: bulletin board";
mail($to, $subject, $message, $headers);
echo(var_dump($to, $subject, $message, $headers));

    include "page/header.php";
?>

<div class="main__table">
        <div class="login__block">
            <h2 class="login__title">we have sent the code to your email, please enter it:</h2>
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
