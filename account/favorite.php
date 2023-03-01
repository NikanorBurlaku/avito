<?php

$login = $_SESSION['login'];

$link = require './database/connect.php';
$selectProduct = "SELECT *, product.id as prodId, product.name as prodName FROM product
LEFT JOIN 
favorite ON favorite.id_product=product.id
WHERE favorite.login='$login'";

$productArray = mysqli_query($link, $selectProduct) or die(mysqli_error($link));
$content = ' <section class="tov_section">';

for ($data = []; $product = mysqli_fetch_assoc($productArray); $data[] = $product) {

    $selectUser = "SELECT * FROM user WHERE id='{$product['id_user']}'";
    $user = mysqli_query($link, $selectUser) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($user);

    $selectCategory = "SELECT category.name as catName FROM category
    WHERE category.id='{$product['id_categ']}'";
    $category = mysqli_query($link, $selectCategory) or die(mysqli_error($link));
    $catName = mysqli_fetch_assoc($category);

    $catName = str_replace('_', ' ', $catName['catName']);
    $prodName = strtolower(str_replace(' ', '_', $product['prodName']));

    if (!empty($user)) {
        if ($user['verify'] === 'true') {
            $verify = '<img class="verify__img" src="{{ url }}images/verify.png">';
        } else {
            $verify = '';
        }
        if ($user['block'] === 'false') {


    $content .= "<a href='{{ url }}page/$catName/{$product['prodId']}' class='tov'>
        <img src='{{ url }}upload/{$product['img']}' class='tov__img'>
        <span class='tov__head'>{$product['prodName']}</span>
        <span class='tov__price'> {$product['price']} $ / <span class='tov__date'>{$product['date_create']}</span></span>
        <span class='tov__user'> {$user['name']} {$user['surname']} $verify</span> 
        <span class='tov__view'><img src='{{ url }}images/view.png' class='views__img'> {$product['view']} 
        <img src='{{ url }}images/star.png' class='views__img'> 0</span>   
        </a>";
        }
    }
}


$selectFavorite = "SELECT COUNT(*) FROM favorite WHERE login='$login'";
$result = mysqli_query($link, $selectFavorite) or die(mysqli_error($link)); 
$favorite = mysqli_fetch_assoc($result);

$content .= '</section>';

$selectCategories = "SELECT * FROM category ORDER BY name";
$resultCategory = mysqli_query($link, $selectCategories) or die(mysqli_error($link));

$categories = '';

for ($data = []; $categoryRow = mysqli_fetch_assoc($resultCategory); $data[] = $product) {
    $categoryRow['name'] = strtolower($categoryRow['name']);
    $categoryHref = str_replace('_', ' ', $categoryRow['name']);
    $categories .= "<li><a href='{{ url }}page/{$categoryRow['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}

$selectFavorite = "SELECT COUNT(*) FROM favorite WHERE login='$login'";
$result = mysqli_query($link, $selectFavorite) or die(mysqli_error($link)); 
$favorite = mysqli_fetch_assoc($result);
if($favorite["COUNT(*)"] === '0'){
    $favorite = '';
} else {
    $favorite = $favorite["COUNT(*)"];
}

$page = [
    'title' => 'favorite add',
    'content' => $content,
    'categories' => $categories,
    'favorite' => $favorite,
    'url' => '../'
];

return $page;

?>

?>