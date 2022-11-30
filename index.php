<?php

session_start();

$url = $_SERVER['REQUEST_URI'];

$route = '/login.php';
if (preg_match("#$route#", $url, $params)) {
    require 'profile/login.php';
} 
$route = '/register.php';
if (preg_match("#$route#", $url, $params)) {
    require 'profile/register.php';
}  else {

    $route = '/index.php';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'layout/all.php';
    }
    if (!empty($_SESSION['auth'])) {
        $auth = '<a href="logout.php" id="logout" class="header__link">log out</a>';
    } else {
        $auth = '<li><a href="login.php" class="header__link">sign in</a> </li>
        <li><a href="register.php" class="header__link">sign up</a></li>';
    }
    $layout = file_get_contents('layout/layout.php');
    $layout = str_replace('{{ title }}', $page['title'], $layout);
    $layout = str_replace('{{ content }}', $page['content'], $layout);
    $layout = str_replace('{{ auth }}', $auth, $layout);

    echo $layout;
}
