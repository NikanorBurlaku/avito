
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
<?
echo "hello, world!";
?>
    <header class="header">
        <div class="container">
            <ul class="header__nav">
                <li><a href="#" class="header__link">help</a></li>
                <li><a href="#" class="header__link favorite"><img src="images/favorite.svg" class="header__img">favorites</a></li>
                <li><a href="#" class="header__link add"><img src="images/add.svg" class="header__img">place an ad</a></li>
                {{ auth }}
                <li><a href="#" class="header__link">your sity: <span class="header__city">Chishinau</span></a></li>
            </ul>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <acide class="acide">
                <a href="index.php" class="logo"><img src="images/logo.svg" class="logo__img"><span class="logo__text">Доска</span>
                </a>
                <ul class="categories__acide">
                    <li><a href="#" class="link__acide main__link">All categories</a></li>

                </ul>
            </acide>
            <article class="article">
                <form action="" class="article__form" method="get">
                    <input type="search" class="article__input__search" placeholder="поиск">
                    <select class="article__select">
                        <option value="all">All categories</option>
                        <?php
                        $link = require "../database/connect.php";
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($link, $query) or die($link);

                        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

                        for ($i = 0; $i < count($data); $i++) {
                            $name = $data[$i]['name'];
                            echo "<option value='$name'>$name</option>";
                        };
                        ?>
                    </select>
                    <input type="submit" value="найти" class="article__submit">
                </form>

                <section class="tov_section">
                    {{ content }}
                </section>

            </article>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>

</html>