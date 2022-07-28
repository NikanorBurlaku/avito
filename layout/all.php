
<?php

session_start();

$link = require '../database/connect.php';
$query1 = "SELECT * FROM product";

$result = mysqli_query($link, $query1) or die(mysqli_error($link));
$content = '';

for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row){

    $query2 = "SELECT * FROM users WHERE id='{$row['user_id']}'";
    $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result2);

    $href = strtolower(transliterate($row['title']));

    $content .= "<a href='$href' class='product'>
    <img src='product_img/{$row['link']}' alt='Product picture' class='product_img'>
    <h2 class='title'>{$row['title']}</h2>
    <p class='subtitle'>{$row['subtitle']}</p>
    <p class='price'>Цена: {$row['price']} ₽</p>
    <p class='date'>Дата: {$row['date']}</p>
    <p class='user'>Продавец: {$user['name']} {$user['surname']}</p>   
    </a>";

    }
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
}

?>



<?php include 'layout/header.php'; ?>

                <section class="tov_section">
                    <a class="tov" href="product.php">
                        <span class="tov__img"></span>
                        <span class="tov__head">Стол компьютерный</span>
                        <span class="tov__price">1000 ₽</span>
                        <span class="tov__sity">Краснодар, р-н Карасунский</span>
                        <span class="tov__sity">3 мая 16:20</span>
                    </a>
                    <a class="tov" href="product.php">
                        <span class="tov__img"></span>
                        <span class="tov__head">Стол компьютерный</span>
                        <span class="tov__price">1000 ₽</span>
                        <span class="tov__sity">Краснодар, р-н Карасунский</span>
                        <span class="tov__sity">3 мая 16:20</span>
                    </a>
                    <a class="tov" href="product.php">
                        <span class="tov__img"></span>
                        <span class="tov__head">Стол компьютерный</span>
                        <span class="tov__price">1000 ₽</span>
                        <span class="tov__sity">Краснодар, р-н Карасунский</span>
                        <span class="tov__sity">3 мая 16:20</span>
                    </a>
                    <a class="tov" href="product.php">
                        <span class="tov__img"></span>
                        <span class="tov__head">Стол компьютерный</span>
                        <span class="tov__price">1000 ₽</span>
                        <span class="tov__sity">Краснодар, р-н Карасунский</span>
                        <span class="tov__sity">3 мая 16:20</span>
                    </a>
                    <a class="tov" href="product.php">
                        <span class="tov__img"></span>
                        <span class="tov__head">Стол компьютерный</span>
                        <span class="tov__price">1000 ₽</span>
                        <span class="tov__sity">Краснодар, р-н Карасунский</span>
                        <span class="tov__sity">3 мая 16:20</span>
                    </a>
                    <a class="tov" href="product.php">
                        <span class="tov__img"></span>
                        <span class="tov__head">Стол компьютерный</span>
                        <span class="tov__price">1000 ₽</span>
                        <span class="tov__sity">Краснодар, р-н Карасунский</span>
                        <span class="tov__sity">3 мая 16:20</span>
                    </a>
                </section>
            </article>
        </div>
    
<?php include 'layout/footer.php'; ?>