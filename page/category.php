<?php

$catSlug = $params['countSlug'];

$link = require './database/connect.php';
$query1 = "SELECT *, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ
WHERE ";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = ' <section class="tov_section">';

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) {

    $query2 = "SELECT * FROM user WHERE id='{$row['id_user']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $catName = str_replace('_', ' ', $row['catName']);
    $prodName = str_replace('_', ' ', $row['prodName']);

    $content .= "<a href='product/$catName/{$row['prodName']}' class='tov'>
        <span class='tov__img'></span>
        <span class='tov__head'>$prodName</span>
        <span class='tov__price'>Price: {$row['price']} $</span>
        <span class='tov__date'>Date create: {$row['date_create']}</span>
        <span class='tov__user'>Salesman: {$user['name']} {$user['surname']}</span>   
        </a>";
}

$content .= '</section>';

$query3 = "SELECT * FROM category ORDER BY name";
$result3 = mysqli_query($link, $query3) or die(mysqli_error($link));

$categories = '';

for ($data = []; $row = mysqli_fetch_assoc($result3); $data[] = $row) {
    $row['name'] = strtolower($row['name']);
    $categoryHref = str_replace('_', ' ', $row['name']);
    $categories .= "<li><a href='page/{$row['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}
$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'categories' => $categories
];

return $page;

?>

?>