<?php

$userSlug = $params['userSlug'];
$link = require './database/connect.php';

$selectUser = $link->query("SELECT * FROM user WHERE id='{$product['id_user']}'");
$user = $selectUser->fetch_assoc();

$content = ' <section class="tov_section">';
$selectProduct = $link->query("SELECT * FROM product WHERE product.id_user='{$user['id']}'");

for ($data = []; $product = $selectProduct->fetch_assoc(); $data[] = $product) {

    $selectCategory = $link->query("SELECT category.name as catName FROM product
LEFT JOIN 
category ON category.id=product.id_categ
WHERE category.id='{$product['id_categ']}'");
    $catName = $selectCategory->fetch_assoc();

    $catName = str_replace('_', ' ', $catName['catName']);
    $prodName = strtolower(str_replace(' ', '_', $product['name']));

    if (!empty($user)) {
        if ($user['verify'] === 'true') {
            $verify = '<img class="verify__img" src="{{ url }}images/verify.png">';
        } else {
            $verify = '';
        }
        if ($user['block'] === 'false') {

            $content .= "<a href='{{ url }}page/$catName/{$product['id']}' class='tov'>
            <img src='{{ url }}upload/{$product['img']}' class='tov__img'>
            <span class='tov__head'>{$product['name']}</span>
            <span class='tov__price'> {$product['price']} $ / <span class='tov__date'>{$product['date_create']}</span></span>
            <span class='tov__user'> {$user['name']} {$user['surname']} $verify</span> 
            <span class='tov__view'><img src='{{ url }}images/view.png' class='views__img'> {$product['view']} 
            <img src='{{ url }}images/star.png' class='views__img'> 0</span>   
            </a>";
        }
    }
}

$content .= '</section>';



$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'url' => '../'
];

return $page;

?>

?>