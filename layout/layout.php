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
                    <li><a href="#" class="link__acide main__link">Все категории</a></li>
                    <li><a href="#" class="link__acide">Электроника</a></li>
                    <li><a href="#" class="link__acide">Недвижимость</a></li>
                    <li><a href="#" class="link__acide">Транспорт</a></li>
                    <li><a href="#" class="link__acide">Личные вещи</a></li>
                    <li><a href="#" class="link__acide">Дом и сад</a></li>
                    <li><a href="#" class="link__acide">Животные</a></li>
                    <li><a href="#" class="link__acide">Услуги</a></li>
                </ul>
            </acide>
            <article class="article">
                <form action="" class="article__form" method="get">
                    <input type="search" class="article__input__search" placeholder="поиск">
                    <select class="article__select">
                        <option value="Электроника">Все категории</option>
                        <option value="Электроника">Электроника</option>
                        <option value="Электроника">Недвижимость</option>
                        <option value="Электроника">Транспорт</option>
                        <option value="Электроника">Личные вещи</option>
                        <option value="Электроника">Дом и сад</option>
                        <option value="Электроника">Животные</option>
                        <option value="Электроника">Услуги</option>
                    </select>
                    <input type="submit" value="найти" class="article__submit">
                </form>

                <section class="tov_section">
                   
                    {{ content }}
                </section>
            
                </article>
        </div>
    </main>
    <!-- <div class="login__popup" style="display: none;">
        <div class="login__block">
            <h2 class="login__title">вход</h2>
            <form action="#" class="login__form" method="post">
                <input type="text" class="login__input" id="login__login" placeholder="телефон или электронная почта">
                <input type="password" class="login__input" id="login__password" placeholder="пароль"
                    autocomplete="off">
                <input type="submit" class="login__submit" value="войти">
            </form>
            <button class="login__href">зарегистрироваться</button>
            <span class="login__close"><img src="images/close.svg" alt=""></span>
        </div>
    </div> -->
    <!-- <div class="register__popup" style="display: none;">
        <div class="login__block">
            <h2 class="login__title">Чтобы зарегистрироваться заполните поля</h2>
            <form action="database/register.php" class="login__form" method="post">
                <input type="text" class="login__input" name="login"
                    placeholder="Логин" require>
                <input type="password" class="login__input" name="password" placeholder="пароль" autocomplete="off" require>
                <input type="password" class="login__input" name="password_confirm" placeholder="повторите пароль" autocomplete="off" require>
                <input type="text" class="login__input" name="name"
                    placeholder="имя" require>
                <input type="text" class="login__input" name="surname"
                    placeholder="фамилия" require>
                <input type="email" class="login__input" name="email"
                    placeholder="email" require>

                <input type="submit" class="login__submit" value="зарегистрироваться">
            </form>
            <span class="register__close"><img src="images/close.svg" alt=""></span>
        </div>
    </div> -->
    <script src="js/script.js"></script>
</body>

</html>