<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{ url }}css/reset.css">
    <link rel="stylesheet" href="{{ url }}css/style.css">
</head>

<body>
<header class="header">
        <div class="container">
            <ul class="header__nav">
                <li><a href="{{ url }}index.php" class="header__link">main</a></li>
                <li><a href="{{ url }}favorite/favorite.php" class="header__link favorite"><img src="{{ url }}images/favorite.svg" class="header__img">favorites <span class="count__add">{{ favorite }}</span></a></li>
                <li><a href="{{ url }}page/add.php" class="header__link add"><img src="{{ url }}images/add.svg" class="header__img">place an ad</a></li>
                {{ admin }}
                {{ auth }}
            </ul>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <acide class="acide">
                <a href="{{ url }}index.php" class="logo"><img src="{{ url }}images/logo.svg" class="logo__img"><span class="logo__text">bulletin board</span>
                </a>
                <ul class="categories__acide">
                    <li><a href="{{ url }}index.php" class="link__acide main__link" style="text-transform: uppercase; font-weight:600">all categories</a></li>
                    {{ categories }}
                </ul>
            </acide>
            <article class="article">
                <form action="{{ url }}page/search.php" class="article__form" method="get">
                    <input type="search" class="article__input__search" value="{{ search_input }}" name="search" placeholder="search" required>
                    <input type="submit" value="find" class="article__submit">
                </form>

                {{ content }}

            </article>
        </div>
    </main>

    <script src="{{ url }}js/script.js"></script>
</body>

</html>