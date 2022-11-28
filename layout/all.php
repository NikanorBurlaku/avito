
<?php


$link = require './database/connect.php';
$query1 = "SELECT * FROM product";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = ' <section class="tov_section">';

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row){

    $query2 = "SELECT * FROM users WHERE id='{$row['user_id']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $content .= "<a href='$href' class='tov'>
    <span class='tov__img'></span>
    <span class='tov__head'>{$row['title']}</span>
    <span class='tov__price'>Цена: {$row['price']} ₽</span>
    <span class='tov__date'>Дата: {$row['date']}</span>
    <span class='tov__user'>Продавец: {$user['name']} {$user['surname']}</span>   
    </a>";

    }
    $content .= '</section>';
   
        $page = [
          'title' => 'список всех категорий',
          'content' => $content
      ];
       
      return $page;

?>



