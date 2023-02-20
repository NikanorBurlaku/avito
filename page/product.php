<?php

$catSlug = $params['catSlug'];
$prodSlug = $params['prodSlug'];

$login = $_SESSION['login'];
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

    <div class='product__title'>
    <h2 class='product__name'>{$product['name']}</h2>
</div>
    <div class='product__block--head__img'>
        <img src='{{ url }}upload/{$product['img']}' class='product__img'>
        </div>
        <div class='product__decription'>
            <span class='product__span'>decription</span>
            <span class='product__text'>{$product['descr']}</span>
        </div>
        <div class='product__location'>
            <span class='product__span'>location</span>
            <span class='product__text'>{$product['adress']}</span>
        </div>

        <div class='product__date'>
        <span class='product__span'>update date</span>
        <span class='product__text'>{$product['date_create']}</span>
       </div>
    </div>
    <div class='contact__block'>
        <button class='send__message'>send meassage</button>
        <a href='index.php' class='salesmam__block'>
            <img src='{{ url }}upload/{$user['img']}' class='salesman__img--ava'>
            <h3 class='salesman__name'>{$user['name']} {$user['surname']}</h3>
        </a>
            <p class='salesmam__block'>
            <img src='{{ url }}images/calendar.png' class='salesman__img'> here with {$user['date_reg']}
            </p>
            <a href='index.php' class='salesmam__block'>
            <img src='{{ url }}images/review.png' class='salesman__img'> reviews: 0
            </a>
            <p class='salesmam__block salesman__price'>
            {$product['price']} $
            </p>";

            $isInFavorite = "SELECT * FROM favorite WHERE login='$login' AND id_product='{$product['id']}'";
            $resultFavorite = mysqli_query($link, $isInFavorite);
            $isInFavorite = mysqli_fetch_assoc($resultFavorite);
           
            if(!empty($isInFavorite)){
                $content .= "<form action='{{ url }}favorite/changeFavorite.php' method='POST' id='favorite_click' class='salesmam__block'>
                <input type='hidden' name='id' value={$product['id']}>
                <button type='submit' class='favorite__button'>
                <img src='{{ url }}images/favorite_close.png' id='favorite_img' class='salesman__img'> 
                <span id='favorite_text'>remove from favorites</span>
                </button>
                </form>";
            } else {
                $content .= "<form action='{{ url }}favorite/changeFavorite.php' method='POST' id='favorite_click' class='salesmam__block'>
                <input type='hidden' name='id' value={$product['id']}>
                <button type='submit' class='favorite__button'>
                <img src='{{ url }}images/favorite_open.png' id='favorite_img' class='salesman__img'> 
                <span id='favorite_text'>add to favorites</span>
                </button>
                </form>";
            }

            
    $content .= "</div>
</section>";



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
    'title' => $product['name'],
    'content' => $content,
    'categories' => $categories,
    'favorite' => $favorite,
    'url' => '../../'
];

return $page;
