<?php 
    $login = $_SESSION['login'];
    $productId = $_REQUEST['id'];
    $link = require "database/connect.php";


    $selectFavorite = $link->query("SELECT * FROM favorite WHERE login='$login' AND id_product='$productId'");
    $favorite = $selectFavorite->fetch_assoc();

    if(!empty($favorite)){

        $link->query("DELETE FROM favorite WHERE login='$login' AND id_product='$productId'");
        echo "delete";
    } else{
       
        $link->query("INSERT INTO favorite SET login='$login', id_product='$productId'");
        echo "add";
    }
?>