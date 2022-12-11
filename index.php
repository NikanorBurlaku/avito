<?php

session_start();

$url = $_SERVER['REQUEST_URI'];
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/avito', '', $url);

$route = '/login.php';
if (preg_match("#$route#", $url, $params)) {
    require 'profile/login.php';
}
$route = '/register.php';
if (preg_match("#$route#", $url, $params)) 
    require 'profile/register.php';


    echo "$url";
    $route = '/';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/all.php';
    }
    $route = '/index.php';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'page/all.php';
    }
    $route = '/page/(?<countSlug>[a-zA-Z0-9_-]+)';
    if(preg_match("#$route#", $url, $params)){
        $page = include 'page/category.php';
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
