<?php 

session_start();

$url = $_SERVER['REQUEST_URI'];
$link = require 'database/connect.php';

$route = '/index.php';
if(preg_match("#$route#", $url, $params)){
$page = include 'layout/all.php';
}

if($_SESSION['auth' == true]){

$auth = '<a href="#" id="login" class="header__link">войти</a> / <a href="#" class="header__link" id="register">зарегистрироваться</a>';

} else {
    $auth = '<a href="#" id="logout" class="header__link">выйти</a>';
}

$layout = file_get_contents('layout/layout.php');
$layout = str_replace('{{ title }}', $page['title'],$layout);
$layout = str_replace('{{ content }}', $page['content'], $layout);
$layout = str_replace('{{ auth }}', $auth, $layout);

echo $layout;

?>