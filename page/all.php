
<?php

$login = $_SESSION['login'];
$link = require './database/connect.php';
$selectProduct = "SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ"; //выбираем продукт, а через inner join выбираем данные из других таблиц

$result = $link->query($selectProduct);
$content = ' <section class="tov_section">'; //заполняем поля для товара

while($product = $result->fetch_assoc()){

    $selectUser = "SELECT * FROM user WHERE id='{$product['id_user']}'";
    $result2 = $link->query($selectUser);
    $user = $result2->fetch_assoc();

    $catName = str_replace('_', ' ', $product['catName']);
    $prodName = str_replace(' ', '_', $product['prodName']);

    $selectImg = "SELECT * FROM image WHERE product_id ='{$product['prodId']}'";
    $result3 = $link->query($selectImg);
    $productImg = $result3->fetch_assoc()['name'];
    // var_dump($product['id']);
    // echo "<br><br><br>";


    if (!empty($user)) {
        if ($user['verify'] === 'true') {
            $verify = '<img class="verify__img" src="images/verify.png">';
        } else {
            $verify = '';
        }
        if ($user['block'] === 'false') {
            $content .= "<a href='page/$catName/{$product['prodId']}' class='tov'>
        <img src='upload/$productImg' class='tov__img'>
        <span class='tov__head'>{$product['prodName']}</span>
        <span class='tov__price'> {$product['price']} $ / <span class='tov__date'>{$product['date_create']}</span></span>
        <span class='tov__user'> {$user['name']} {$user['surname']} $verify</span> 
        <span class='tov__view'><img src='images/view.png' class='views__img'> {$product['view']} 
        <img src='images/star.png' class='views__img'> 0</span>   
        </a>";
        }
    }
}

$content .= '</section>';

$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'url' => ''
];


return $page;

?>



