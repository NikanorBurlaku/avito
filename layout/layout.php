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
    <?php
    include "layout/header.php";
    ?>
    <main class="main">
        <div class="container">
            <acide class="acide">
                <a href="index.php" class="logo"><img src="images/logo.svg" class="logo__img"><span class="logo__text">bulletin board</span>
                </a>
                <ul class="categories__acide">
                    <li><a href="index.php" class="link__acide main__link" style="text-transform: uppercase; font-weight:600">all categories</a></li>
                    {{ categories }}
                </ul>
            </acide>
            <article class="article">
                <form action="" class="article__form" method="get">
                    <input type="search" class="article__input__search" placeholder="search">

                    <input type="submit" value="find" class="article__submit">
                </form>

                {{ content }}

            </article>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>

</html>