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
                <li><a href="index.php" class="header__link">help</a></li>
                <li><a href="index.php" class="header__link favorite"><img src="images/favorite.svg" class="header__img">favorites</a></li>
                <li><a href="add.php" class="header__link add"><img src="images/add.svg" class="header__img">place an ad</a></li>
                {{ auth }}
                <li><a href="index.php" class="header__link">your sity: <span class="header__city">Chishinau</span></a></li>
            </ul>
        </div>
    </header>
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