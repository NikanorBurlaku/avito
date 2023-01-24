<?php

session_start();

$url = $_SERVER['REQUEST_URI'];
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/avito', '', $url);


if ($url == "/login.php" or $url == "/register.php" or $url == "/logout.php" or $url == "/add.php") {

    $route = '/login.php';
    if (preg_match("#$route#", $url, $params)) {
        require_once 'login.php';
    }

    $route = '/register.php';
    if (preg_match("#$route#", $url, $params))
        require_once 'register.php';

    $route = '/logout.php';
    if (preg_match("#$route#", $url, $params))
        require_once 'logout.php';

    $route = '/add.php';
    if (preg_match("#$route#", $url, $params))
        require_once 'add.php';
} else {


    echo "$url";
    $route = '/'; //для всех товаров
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/all.php';
    }
    $route = '/index.php'; //для всех товаров
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/all.php';
    }
    $route = '/page/(?<catSlug>[a-zA-Z0-9_-]+)'; // для категории
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/category.php';
    }
    $route = '/page/search.php'; //для таблицы с поиском
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/search.php';
    }
    $route = '/page/(?<catSlug>[a-zA-Z0-9_-]+)/(?<prodSlug>[a-zA-Z0-9_-]+)'; //для отдельного товара
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/product.php';
    }

    $layout = file_get_contents('page/layout.php'); //получение шаблона

    if (!empty($_SESSION['auth'])) { //проверка на авторизацию
        $auth = '<a href="{{ url }}logout.php" id="logout" class="header__link">log out</a>'; 
        $auth = str_replace('{{ url }}', $page['url'],$auth); //настраиваем путь
    } else {
        $auth = '<li><a href="{{ url }}login.php" class="header__link">sign in</a> </li>
        <li><a href="{{ url }}register.php" class="header__link">sign up</a></li>';
        $auth = str_replace('{{ url }}', $page['url'],$auth); //настраиваем путь
    }
   
    $layout = str_replace('{{ title }}', $page['title'], $layout); //подставляем title
    $layout = str_replace('{{ content }}', $page['content'], $layout); //подставляем основную часть контента
    $layout = str_replace('{{ categories }}', $page['categories'], $layout); //подставляем все категории
    $layout = str_replace('{{ url }}', $page['url'], $layout); // настраиваем пути
    $layout = str_replace('{{ auth }}', $auth, $layout); //подставляем ссылки для авторизации/логаута

    echo $layout; //выводим все на экран
}
