<?php 

    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $name = 'avito';
    $link = mysqli_connect($host, $user, $pass, $name);
    mysqli_query($link, "SET NAMES 'utf8'");

    return $link
?>