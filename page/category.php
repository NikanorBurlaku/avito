<?php

$login = $_SESSION['login'];
$catSlug = $params['catSlug'];

$link = require './database/connect.php';
$query1 = "SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ
WHERE category.name='$catSlug'";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = ' <section class="tov_section">';

for ($data = []; $product = mysqli_fetch_assoc($result); $data[] = $product) {

    $query2 = "SELECT * FROM user WHERE id='{$product['id_user']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $catName = str_replace('_', ' ', $product['catName']);
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

$content .= '</section>';

$query3 = "SELECT * FROM category ORDER BY name";
$result3 = mysqli_query($link, $query3) or die(mysqli_error($link));

$categories = '';

for ($data = []; $row = mysqli_fetch_assoc($result3); $data[] = $row) {
    $row['name'] = strtolower($row['name']);
    $categoryHref = str_replace('_', ' ', $row['name']);
    $categories .= "<li><a href='{{ url }}page/{$row['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}

$selectFavorite = "SELECT COUNT(*) FROM favorite WHERE login='$login'";
$result = mysqli_query($link, $selectFavorite) or die(mysqli_error($link));
$favorite = mysqli_fetch_assoc($result);
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