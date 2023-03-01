<?php

session_start();

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/avito', '', $url);

echo ($url);

switch ($url) {
    case '/account/login.php':
        require_once 'account/login.php';
        break;
    case '/account/login.php':
        require_once 'account/login.php';
        break;
    case '/account/register.php':
        require_once 'account/register.php';
        break;
    case '/account/admin.php':
        require_once 'account/admin.php';
        break;
    case '/account/account.php':
        require_once 'account/account.php';
        break;
    case '/account/logout.php':
        require_once 'account/logout.php';
        break;
    case '/page/add.php':
        require_once 'page/add.php';
        break;
    case '/account/admin.php':
        require_once 'account/admin.php';
        break;
    case '/account/verify.php':
        require_once 'account/verify.php';
        break;
    case '/account/send_email.php':
        require_once 'account/send_email.php';
        break;
    case str_contains($url, 'admin/changeStatus'):
        require_once 'admin/changeStatus.php';
        break;
    case str_contains($url, 'favorite/changeFavorite'):
        require_once 'favorite/changeFavorite.php';
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
        $route = '/account/favorite.php'; //для всех товаров
        if (preg_match("#$route#", $url, $params)) {
            $page = include 'account/favorite.php';
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
        $route = '/user/(?<userSlug>[a-zA-Z0-9_-]+)'; // для пользователя
        if (preg_match("#$route#", $url, $params)) {
            $page = include 'user/user.php';
        }

        $layout = file_get_contents('page/layout.php'); //получение шаблона


        if ($_SESSION['status'] === 'admin') {
            $admin = '<li><a href="{{ url }}account/admin.php" class="header__link">admin panel</a> </li>';
            $admin = str_replace('{{ url }}', $page['url'], $admin); //настраиваем путь
        } else {
            $admin = '';
        }

        if (!empty($_SESSION['auth'])) { //проверка на авторизацию
            $auth = '<li><a href="{{ url }}account/account.php" id="account" class="header__link">account</a></li>
            <li><a href="{{ url }}account/logout.php" id="logout" class="header__link">log out</a></li>';
            $auth = str_replace('{{ url }}', $page['url'], $auth); //настраиваем путь
        } else {
            $auth = '<li><a href="{{ url }}account/login.php" class="header__link">sign in</a> </li>
        <li><a href="{{ url }}account/register.php" class="header__link">sign up</a></li>';
            $auth = str_replace('{{ url }}', $page['url'], $auth); //настраиваем путь
        }


        $layout = str_replace('{{ title }}', $page['title'], $layout); //подставляем title
        $layout = str_replace('{{ content }}', $page['content'], $layout); //подставляем основную часть контента
        $layout = str_replace('{{ categories }}', $page['categories'], $layout); //подставляем все категории
        if(!empty($_GET['search'])){
            $layout = str_replace('{{ search_input }}', $_GET['search'], $layout); //если в параметре "search" что-то есть
        } else {
            $layout = str_replace('{{ search_input }}', '', $layout); //если в параметре "search" пусто
        }
        $layout = str_replace('{{ favorite }}', $page['favorite'], $layout); // отображение количества избранных сообщений
        $layout = str_replace('{{ url }}', $page['url'], $layout); // настраиваем пути
        $layout = str_replace('{{ auth }}', $auth, $layout); //подставляем ссылки для авторизации/логаута
        $layout = str_replace('{{ admin }}', $admin, $layout); //подставляем ссылки для авторизации/логаута

        echo $layout; //выводим все на экран
        break;
        
}
?>