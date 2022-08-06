
<?php


$link = require './database/connect.php';
$query1 = "SELECT * FROM product";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = ' <section class="tov_section">';

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row){

    $query2 = "SELECT * FROM users WHERE id='{$row['user_id']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $href = strtolower(transliterate($row['title']));

    $content .= "<a href='$href' class='tov'>
    <span class='tov__img'></span>
    <span class='tov__head'>{$row['title']}</span>
    <span class='tov__price'>Цена: {$row['price']} ₽</span>
    <span class='tov__date'>Дата: {$row['date']}</span>
    <span class='tov__user'>Продавец: {$user['name']} {$user['surname']}</span>   
    </a>";

    }
    $content .= '</section>';
    function transliterate($input){
        $gost = array(
        "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
        "е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i",
        "й"=>"i","к"=>"k","л"=>"l", "м"=>"m","н"=>"n",
        "о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
        "у"=>"u","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch",
        "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u",
        "я"=>"ya",
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
        "Е"=>"E","Ё"=>"Yo","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"Y","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"Ch",
        "Ш"=>"Sh","Щ"=>"Sh","Ы"=>"I","Э"=>"E","Ю"=>"U",
        "Я"=>"Ya",
        "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"",
        "ї"=>"j","і"=>"i","ґ"=>"g","є"=>"ye"," "=>"_",
        "Ї"=>"J","І"=>"I","Ґ"=>"G","Є"=>"YE"
        );
        return strtr($input, $gost);
        }
  
        $page = [
          'title' => 'список всех категорий',
          'content' => $content
      ];
       
      return $page;

?>



