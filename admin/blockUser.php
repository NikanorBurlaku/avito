<?php 

    if(!empty($_REQUEST['login'])){
        $login = $_REQUEST['login'];
        $link = require "database/connect.php";

        $selectUser = $link->query("SELECT * FROM user WHERE login='$login'");
        $user = $selectUser->fetch_assoc();

        if($user['block'] === 'false'){
            $blockUser = "UPDATE user SET block='true' WHERE login='$login'";
        } else {
            $blockUser = "UPDATE user SET block='false' WHERE login='$login'";
        }
        $link->query($blockUser);
        header("Location: ../../account/admin.php");
    }

?>