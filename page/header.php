<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <ul class="header__nav">
                <li><a href="index.php" class="header__link">main</a></li>
                <li><a href="index.php" class="header__link favorite"><img src="images/favorite.svg" class="header__img">favorites</a></li>
                <li><a href="add.php" class="header__link add"><img src="images/add.svg" class="header__img">place an ad</a></li>
                <?php
                if ($_SESSION['status'] === 'admin') :?>
                    <li><a href="{{ url }}admin.php" class="header__link">admin panel</a> </li>
                <?php
                endif;
                if ($_SESSION['auth'] === 'true') :
                ?>
                    <li><a href="logout.php" id="logout" class="header__link">log out</a></li>
                <?php else : ?>

                    <li><a href="login.php" class="header__link">sign in</a> </li>
                    <li><a href="register.php" class="header__link">sign up</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </header>