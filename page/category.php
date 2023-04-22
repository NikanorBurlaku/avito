<?php

$login = $_SESSION['login'];
$catSlug = $params['catSlug'];

$link = require './database/connect.php';

$selectProduct = $link->query("SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ
WHERE category.name='$catSlug'");

$content = '<section class="tov_section">';

for ($data = []; $product = $selectProduct->fetch_assoc(); $data[] = $product) {

    $selectUser = $link->query("SELECT * FROM user WHERE id='{$product['id_user']}'");
    $user = $selectUser->fetch_assoc();

    $catName = str_replace('_', ' ', $product['catName']);
    $prodName = strtolower(str_replace(' ', '_', $product['prodName']));

    $selectImg = $link->query("SELECT * FROM image WHERE product_id ='{$product['prodId']}'");
    $productImg = $selectImg->fetch_assoc()['name'];

    if (!empty($user)) {
        if ($user['verify'] === 'true') {
            $verify = '<img class="verify__img" src="{{ url }}images/verify.png">';
        } else {
            $verify = '';
        }
        if ($user['block'] === 'false') {

            $content .= "<a href='{{ url }}page/$catName/{$product['prodId']}' class='tov'>
            <img src='{{ url }}upload/$productImg' class='tov__img'>
            <span class='tov__head'>{$product['prodName']}</span>
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