<?php

$catSlug = $params['userSlug'];


$link = require './database/connect.php';

    $query = "UPDATE product SET view = view + 1 WHERE id='$prodSlug'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link)); 

$query1 = "SELECT * FROM product
WHERE product.id='$prodSlug'";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$product = mysqli_fetch_assoc($result);

    $query2 = "SELECT * FROM user WHERE id='{$product['id_user']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $content = "<section class='product__section'>
    <div class='product__block'>
        <img src='{{ url }}upload/{$product['img']}' class='product__img'>
        <div class='product__title'>
            <h2 class='product__name'>{$product['name']}</h2>
            <span class='product__date'>{$product['date_create']}</span>
        </div>
        <div class='product__decription'>
            <span class='product__span'>decription</span>
            <span class='product__text'>{$product['descr']}</span>
        </div>
        <div class='product__location'>
            <span class='product__span'>location</span>
            <span class='product__text'>{$product['adress']}</span>
        </div>
    </div>
    <div class='contact__block'>
        <h2 class='product__price'>{$product['price']} $</h2>
        <button class='show__number'>show phone</button>
        <button class='send__message'>send meassage</button>
        <a href='index.php' class='salesmam__block'>
            <img src='images/salesman.png' class='salesman__img'>
            <h3 class='salesman__name'>{$user['name']} {$user['surname']}</h3>
            <span class='salesman__date'>here with {$user['date_reg']}</span>
            <span class='salesman__review'>reviews: 0</span>
        </a>
    </div>
</section>";



$query3 = "SELECT * FROM category ORDER BY name";
$result3 = mysqli_query($link, $query3) or die(mysqli_error($link));

$categories = '';

for ($data = []; $row = mysqli_fetch_assoc($result3); $data[] = $row) {
    $row['name'] = strtolower($row['name']);
    $categoryHref = str_replace('_', ' ', $row['name']);
    $categories .= "<li><a href='{{ url }}page/{$row['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}
$page = [
    'title' => $product['name'],
    'content' => $content,
    'categories' => $categories,
    'url' => '../../'
];

return $page;

?>  
                
           