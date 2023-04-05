<?php 

    if(!empty($_REQUEST['login'])){
        $login = $_REQUEST['login'];
        $link = require "database/connect.php";

        $selectUser = $link->query("SELECT * FROM user WHERE login='$login'");
        $user = $selectUser->fetch_assoc();

        if($user['status'] === 'user'){
            $changeStatus = "UPDATE user SET status='admin' WHERE login='$login'";
        } else {
            $changeStatus = "UPDATE user SET status='user' WHERE login='$login'";
        }
        $link->query($changeStatus);
        header("Location: ../../account/admin.php");
    }

?>