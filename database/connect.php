<?php


$host = 'localhost'; // имя хоста
$user = 'root';      // имя пользователя
$pass = 'root';          // пароль
$name = 'mydb';      // имя базы данных

return mysqli_connect($host, $user, $pass, $name);

?>