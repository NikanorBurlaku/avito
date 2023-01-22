
<?php


$link = require './database/connect.php';
$query1 = "SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ"; //выбираем продукт, а через inner join выбираем данные из других таблиц

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = ' <section class="tov_section">'; //заполняем поля для товара


for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) {

    $query2 = "SELECT * FROM user WHERE id='{$row['id_user']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);
    
    $catName = str_replace('_', ' ', $row['catName']); 
    $prodName = str_replace(' ', '_', $row['prodName']);

    // var_dump($row['prodId']);
    // echo "<br><br><br>";

    $content .= "<a href='page/$catName/{$row['prodId']}' class='tov'>
    <img src='upload/{$row['img']}' class='tov__img'>
    <span class='tov__head'>{$row['prodName']}</span>
    <span class='tov__price'>Price: {$row['price']} $</span>
    <span class='tov__date'>Date create: {$row['date_create']}</span>
    <span class='tov__user'>Salesman: {$user['name']} {$user['surname']}</span>   
    </a>";
}

$content .= '</section>';

$query3 = "SELECT * FROM category ORDER BY name";
$result3 = mysqli_query($link, $query3) or die(mysqli_error($link));

$categories = '';

for ($data = []; $row = mysqli_fetch_assoc($result3); $data[] = $row) { //выбираем категории
    $row['name'] = strtolower($row['name']);
    $categoryHref = str_replace('_', ' ', $row['name']); 
    $categories .= "<li><a href='page/{$row['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}
$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'categories' => $categories,
    'url' => ''
];


return $page;

?>



