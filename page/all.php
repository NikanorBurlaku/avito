
<?php


$link = require './database/connect.php';
$selectProduct = "SELECT *, product.id as prodId, category.name as catName, product.name as prodName FROM product
LEFT JOIN 
category ON category.id=product.id_categ"; //выбираем продукт, а через inner join выбираем данные из других таблиц

$result = mysqli_query($link, $selectProduct) or die(mysqli_error($link));
$content = ' <section class="tov_section">'; //заполняем поля для товара


for ($data = []; $product = mysqli_fetch_assoc($result); $data[] = $product) {

    $selectUser = "SELECT * FROM user WHERE id='{$product['id_user']}'";
    $result2 = mysqli_query($link, $selectUser) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $catName = str_replace('_', ' ', $product['catName']);
    $prodName = str_replace(' ', '_', $product['prodName']);

    // var_dump($product['prodId']);
    // echo "<br><br><br>";


    if (!empty($user)) {
        if ($user['verify'] === 'true') {
            $verify = '<img class="verify__img" src="images/verify.png">';
        } else {
            $verify = '';
        }
        if ($user['block'] === 'false') {
            $content .= "<a href='page/$catName/{$product['prodId']}' class='tov'>
        <img src='upload/{$product['img']}' class='tov__img'>
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

$selectCategories = "SELECT * FROM category ORDER BY name";
$selectCategories = mysqli_query($link, $selectCategories) or die(mysqli_error($link));

$categories = '';

for ($data = []; $category = mysqli_fetch_assoc($selectCategories); $data[] = $category) { //выбираем категории
    $category['name'] = strtolower($category['name']);
    $categoryHref = str_replace('_', ' ', $category['name']);
    $categories .= "<li><a href='page/{$category['name']}' class='link__acide main__link'>$categoryHref</a></li>";
}
$page = [
    'title' => 'bulletin board',
    'content' => $content,
    'categories' => $categories,
    'url' => ''
];


return $page;

?>



