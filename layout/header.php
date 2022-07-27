<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доска объявлений</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <ul class="header__nav">
                <li><a href="#" class="header__link">помощь</a></li>
                <li><a href="#" class="header__link">промокод</a></li>
                <li><a href="#" class="header__link favorite"><img src="images/favorite.svg"
                            class="header__img">избранное</a></li>
                <li><a href="#" class="header__link add"><img src="images/add.svg" class="header__img"> подать
                        объявление</a></li>
                <li><a href="#" id="login" class="header__link">войти</a> / <a href="#" class="header__link" id="register">зарегистрироваться</a></li>
                <li><a href="#" class="header__link">ваш город: <span class="header__city">Краснодар</span></a></li>
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