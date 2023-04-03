<?php

$catSlug = $params['catSlug'];
$prodSlug = $params['prodSlug'];

$login = $_SESSION['login'];
$link = require './database/connect.php';

$updateView = $link->query("UPDATE product SET view = view + 1 WHERE id='$prodSlug'");

$selectProduct = $link->query("SELECT * FROM product WHERE product.id='$prodSlug'");
$product = $selectProduct->fetch_assoc();

$selectUser = $link->query("SELECT * FROM user WHERE id='{$product['id_user']}'");
$user = $selectUser->fetch_assoc();

$selectCoutImg = $link->query("SELECT count(*) FROM image WHERE product_id ='{$product['id']}'");
$coutImg = $selectCoutImg->fetch_assoc()['count(*)'];

$images = $link->query("SELECT * FROM image WHERE product_id ='{$product['id']}'");

if ($coutImg >= '2') {
    $productImg = 'default.png';
    $imgArray = array();

    for ($data = []; $image = mysqli_fetch_assoc($images); $data[] = $image) {
        array_push($imgArray, $image['name']);
    }
    $imgArray = json_encode($imgArray);
    $imgBlock = "
            <div class='slider'>
            <img class='arrow__left' src='{{ url }}images/arrow-left.svg'>
            <img src='' class='product__img'>
            <script>let images = ($imgArray);
            let url = '{{ url }}';
            </script>
        <img class='arrow__right' src='{{ url }}images/arrow-right.svg'>
            </div>";

    // $productImg = '<script>let array=""</script>'

} elseif ($coutImg == '1') {
    $productImg = (mysqli_fetch_assoc($images))['name'];
    $imgBlock = " <img src='{{ url }}upload/" . $productImg . "' class='product__img'>";
} else {
    $productImg = 'default.png';
    $imgBlock = "<img src='{{ url }}upload/" . $productImg . "' class='product__img'>";
}
$content = "<section class='product__section'>
    <div class='product__block'>

    <div class='product__title'>
    <h2 class='product__name'>{$product['name']}</h2>
</div>
    <div class='product__block--head__img'>$imgBlock</div>
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
        <a href='{{ url }}user/{$user['login']}' class='salesmam__block'>
            <img src='{{ url }}upload/{$user['img']}' class='salesman__img--ava'>
            <h3 class='salesman__name'>{$user['name']} {$user['surname']}</h3>
        </a>
        <a class='send__message'>send meassage</a>
        <a href='{{ url }}user/{$user['login']}' class='send__message'>view all ads</a>
            <p class='salesmam__block'>
            <img src='{{ url }}images/calendar.png' class='salesman__img'> here with {$user['date_reg']}
            </p>
            <a href='index.php' class='salesmam__block'>
            <img src='{{ url }}images/review.png' class='salesman__img'> reviews: 0
            </a>
            <p class='salesmam__block salesman__price'>
            {$product['price']} $
            </p>";

$resultFavorite = $link->query("SELECT * FROM favorite WHERE login='$login' AND id_product='{$product['id']}'");
$isInFavorite = $resultFavorite->fetch_assoc();

if (!empty($isInFavorite)) {
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


$page = [
    'title' => $product['name'],
    'content' => $content,
    'url' => '../../'
];

return $page;
