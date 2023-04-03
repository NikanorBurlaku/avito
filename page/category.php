<?php

$login = $_SESSION['login'];
$catSlug = $params['catSlug'];

$link = require './database/connect.php';

$selectProduct = $link->query("SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ
WHERE category.name='$catSlug'");

$content = '<section class="tov_section">';

for ($data = []; $product = mysqli_fetch_assoc($selectProduct); $data[] = $product) {

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

$selectCategory = $link->query("SELECT * FROM category ORDER BY name");

$categories = '';

for ($data = []; $row = mysqli_fetch_assoc($selectCategory); $data[] = $row) {
    $row['name'] = strtolower($row['name']);
    $categoryHref = str_replace('_', ' ', $row['name']);
    $categories .= "<li><a href='{{ url }}page/{$row['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}

$selectFavorite = $link->query("SELECT COUNT(*) FROM favorite WHERE login='$login'");
    $favorite = $selectFavorite->fetch_assoc();

if ($favorite["COUNT(*)"] === '0') {
    $favorite = '';
} else {
    $favorite = $favorite["COUNT(*)"];
}

$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'favorite' => $favorite,
    'categories' => $categories,
    'url' => '../'
];

return $page;

?>

?>