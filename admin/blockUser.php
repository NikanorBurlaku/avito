<?php 

    if(!empty($_REQUEST['login'])){
        $login = $_REQUEST['login'];
        $link = require "database/connect.php";

        $selectUser = "SELECT * FROM user WHERE login='$login'";
        $result = mysqli_query($link, $selectUser);
        $user = mysqli_fetch_assoc($result);

        if($user['block'] === 'false'){
            $blockUser = "UPDATE user SET block='true' WHERE login='$login'";
        } else {
            $blockUser = "UPDATE user SET block='false' WHERE login='$login'";
        }
        mysqli_query($link, $blockUser);
        header("Location: ../admin.php");
    }

?>