<?php

$login = $_SESSION['login'];

$link = require './database/connect.php';
$query1 = "SELECT *, product.id as prodId, product.name as prodName FROM product
LEFT JOIN 
favorite ON favorite.id_product=product.id
WHERE favorite.login='$login'";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = ' <section class="tov_section">';

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) {

    $query2 = "SELECT * FROM user WHERE id='{$row['id_user']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $query4 = "SELECT category.name as catName FROM category
    WHERE category.id='{$row['id_categ']}'";
    $result4 = mysqli_query($link, $query4) or die(mysqli_error($link));
    $catName = mysqli_fetch_assoc($result4);

    $catName = str_replace('_', ' ', $catName['catName']);
    $prodName = strtolower(str_replace(' ', '_', $row['prodName']));

    if (!empty($user)) {
        if ($user['verify'] === 'true') {
            $verify = '<img class="verify__img" src="images/verify.png">';
        } else {
            $verify = '';
        }
        if ($user['block'] === 'false') {

            $content .= "<a href='{{ url }}page/$catName/{$row['prodId']}' class='tov'>
    <img src='{{ url }}upload/{$row['img']}' class='tov__img'>
    <span class='tov__head'>{$row['prodName']}</span>
    <span class='tov__price'>Price: {$row['price']} $</span>
    <span class='tov__date'>Date create: {$row['date_create']}</span>
    <span class='tov__user'>Salesman: {$user['name']} {$user['surname']}</span>   
    </a>";
        }
    }
}


$selectFavorite = "SELECT COUNT(*) FROM favorite WHERE login='$login'";
$result = mysqli_query($link, $selectFavorite) or die(mysqli_error($link)); 
$favorite = mysqli_fetch_assoc($result);

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
    'url' => ''
];

return $page;

?>

?>