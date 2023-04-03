
<?php

$search = $_REQUEST['search']; //условие поиска

$link = require './database/connect.php';

$selectProduct = $link->query("SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ
WHERE product.name LIKE '%$search%' OR product.descr LIKE '%$search%'");  //выбираем если продукт или описание содержат условия поиска

$content = ' <section class="tov_section">'; //заполняем поля для товара


for ($data = []; $row = mysqli_fetch_assoc($selectProduct); $data[] = $row) {

    $selectUser = $link->query("SELECT * FROM user WHERE id='{$row['id_user']}'"); //получаем данные продавца, который разместил объявление
    $user = $selectUser->fetch_assoc();
    
    $catName = str_replace('_', ' ', $row['catName']); 
    $prodName = str_replace(' ', '_', $row['prodName']);

    $selectImg = $link->query("SELECT * FROM image WHERE product_id ='{$row['prodId']}'");
    $productImg = $selectImg->fetch_assoc()['name'];
    // var_dump($row);
    // echo "<br><br><br>";
    
    $content .= "<a href='{{ url }}page/$catName/{$row['prodId']}' class='tov'>
    <img src='{{ url }}upload/$productImg' class='tov__img'>
    <span class='tov__head'>{$row['prodName']}</span>
    <span class='tov__price'>Price: {$row['price']} $</span>
    <span class='tov__date'>Date create: {$row['date_create']}</span>
    <span class='tov__user'>Salesman: {$user['name']} {$user['surname']}</span>   
    </a>";
}

$content .= '</section>';

$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'url' => '../'
];

return $page;

?>



