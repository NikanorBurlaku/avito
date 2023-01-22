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
    $route = '/';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/all.php';
    }
    $route = '/index.php';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/all.php';
    }
    $route = '/page/(?<catSlug>[a-zA-Z0-9_-]+)';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/category.php';
    }
    $route = '/page/(?<catSlug>[a-zA-Z0-9_-]+)/(?<prodSlug>[a-zA-Z0-9_-]+)';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/product.php';
    }
    if (!empty($_SESSION['auth'])) {
        $auth = '<a href="logout.php" id="logout" class="header__link">log out</a>';
    } else {
        $auth = '<li><a href="login.php" class="header__link">sign in</a> </li>
        <li><a href="register.php" class="header__link">sign up</a></li>';
    }
    $layout = file_get_contents('page/layout.php');
    $layout = str_replace('{{ title }}', $page['title'], $layout);
    $layout = str_replace('{{ content }}', $page['content'], $layout);
    $layout = str_replace('{{ categories }}', $page['categories'], $layout);
    $layout = str_replace('{{ url }}', $page['url'], $layout);
    $layout = str_replace('{{ auth }}', $auth, $layout);

    echo $layout;
}
