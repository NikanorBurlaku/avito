<?php 
    $login = $_SESSION['login'];
    $productId = $_REQUEST['id'];
    $link = require "database/connect.php";


    $selectFavorite = "SELECT * FROM favorite WHERE login='$login' AND id_product='$productId'";
    $result = mysqli_query($link, $selectFavorite);
    $selectFavorite = mysqli_fetch_assoc($result);

    if(!empty($selectFavorite)){

        $removeToFavorite = "DELETE FROM favorite WHERE login='$login' AND id_product='$productId'";
        mysqli_query($link, $removeToFavorite);
        echo "delete";
    } else{
        $addToFavorite = "INSERT INTO favorite SET login='$login', id_product='$productId'";
        mysqli_query($link, $addToFavorite);
        echo "add";
    }
?>