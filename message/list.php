<?php
include "page/header.php";
?>


<style>
    body {
        background: rgba(0, 0, 0, 0.1);
    }
</style>
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
    if ($user['to_user'] !== $login) {
        $users[] = $user['to_user'];
    }
}
$users = array_unique($users);

if (!empty($users)) {


echo "<div class='list'>";

    foreach ($users as $user) {
        $selectMessage = $link->query("SELECT DISTINCT * FROM message WHERE 
     (to_user='$login' AND from_user='$user') OR (to_user='$user' AND from_user='$login')
     ORDER BY id DESC 
     LIMIT 1 ");
        $message = $selectMessage->fetch_assoc();

        $selectImg = $link->query("SELECT img FROM user WHERE login='$user'");
        $img = $selectImg->fetch_assoc()['img'];


        if ($message['from_user'] == $login) {

            $icon = '<svg viewBox="0 0 16 15" width="16" height="15"><path fill="currentColor" d="m15.01 3.316-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg>';

            if ($message['read_status'] == false) {
                $readStatus = '';
            } else {
                $readStatus = 'active';
            }

            echo "<a href='message.php?$user' class='list__group'><div class='group__head'><img src='../upload/$img' class='group__ava'><div class='group__text'><span>{$user}</span><p>you: {$message['value']}</p>
        <div class='list__date'><span>{$message['date']}</span><span>{$message['time']}</span><span class='message__icon $readStatus'>$icon</span></div></div></div></a>";
        } else {


            $selectReadStatus = $link->query("SELECT COUNT(*) FROM message WHERE
     (to_user='$login' AND from_user='$user') AND read_status=0");
            $readStatus = $selectReadStatus->fetch_assoc()["COUNT(*)"];

            if ($readStatus !== '0') {
                $readStatus = "<span>$readStatus</span>";
            } else {
                $readStatus = '';
            }

            echo "<a href='message.php?$user' class='list__group'><div class='group__head'><img src='../upload/$img' class='group__ava'><div class='group__text'><span>{$user}</span><p> {$message['value']} $readStatus</p>
     <div class='list__date'><span>{$message['date']}</span><span>{$message['time']}</span></div></div></div></a>";
        }
    }
} else {


echo "<div class='list list__empty'><div class='empty'><img classs=empty__img' src='../images/empty.png'><span>no messages</span></div>";
}
echo "</div>";


include "page/footer.php";
?>