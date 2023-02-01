<?php

session_start();

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/avito', '', $url);

echo ($url);

switch ($url) {
    case '/login.php':
        require_once 'login.php';
        break;
    case '/login.php':
        require_once 'login.php';
        break;
    case '/register.php':
        require_once 'register.php';
        break;
    case '/admin.php':
        require_once 'admin.php';
        break;
    case '/logout.php':
        require_once 'logout.php';
        break;
    case '/add.php':
        require_once 'add.php';
        break;
    case '/add.php':
        require_once 'add.php';
        break;
    case str_contains($url, 'admin/changeStatus'):
        require_once 'admin/changeStatus.php';
        break;
    case str_contains($url, 'admin/blockUser'):
        require_once 'admin/blockUser.php';
        break;
    case str_contains($url, 'admin/deleteUser'):
        require_once 'admin/deleteUser.php';
        break;

    default:
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


        if ($_SESSION['status'] === 'admin') {
            $admin = '<li><a href="{{ url }}admin.php" class="header__link">admin panel</a> </li>';
            $admin = str_replace('{{ url }}', $page['url'], $admin); //настраиваем путь
        } else {
            $admin = '';
        }

        if (!empty($_SESSION['auth'])) { //проверка на авторизацию
            $auth = '<li><a href="{{ url }}logout.php" id="logout" class="header__link">log out</a></li>';
            $auth = str_replace('{{ url }}', $page['url'], $auth); //настраиваем путь
        } else {
            $auth = '<li><a href="{{ url }}login.php" class="header__link">sign in</a> </li>
        <li><a href="{{ url }}register.php" class="header__link">sign up</a></li>';
            $auth = str_replace('{{ url }}', $page['url'], $auth); //настраиваем путь
        }


        $layout = str_replace('{{ title }}', $page['title'], $layout); //подставляем title
        $layout = str_replace('{{ content }}', $page['content'], $layout); //подставляем основную часть контента
        $layout = str_replace('{{ categories }}', $page['categories'], $layout); //подставляем все категории
        $layout = str_replace('{{ url }}', $page['url'], $layout); // настраиваем пути
        $layout = str_replace('{{ auth }}', $auth, $layout); //подставляем ссылки для авторизации/логаута
        $layout = str_replace('{{ admin }}', $admin, $layout); //подставляем ссылки для авторизации/логаута

        echo $layout; //выводим все на экран
        break;
}
