<?php
include "page/header.php";
?>



<script>
    const title = "message";
</script>
<?php

$login = $_SESSION['login'];
$link = require './database/connect.php';
$users = [];

$selectUsers = $link->query("SELECT DISTINCT to_user from message WHERE from_user='$login' 
UNION ALL
SELECT DISTINCT from_user from message WHERE to_user='$login'");

for ($data = []; $user = $selectUsers->fetch_assoc(); $data[] = $user) {
    $users[] = $user['to_user'];
}
$users = array_unique($users);

foreach($users as $user){
    $selectMessage=$link->query("SELECT DISTINCT * FROM message WHERE 
     (to_user='$login' AND from_user='$user') OR (to_user='$user' AND from_user='$login')
     ORDER BY id DESC 
     LIMIT 1 ");
     $message = $selectMessage->fetch_assoc();

     echo "<div class='message'>{$message['value']}</div><br><br>";
}



include "page/footer.php";
?>