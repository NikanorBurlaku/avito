<?php 

    if(!empty($_REQUEST['login'])){
        $login = $_REQUEST['login'];
        $link = require "database/connect.php";

        $selectUser = "SELECT * FROM user WHERE login='$login'";
        $result = mysqli_query($link, $selectUser);
        $user = mysqli_fetch_assoc($result);

        if($user['status'] === 'user'){
            $changeStatus = "UPDATE user SET status='admin' WHERE login='$login'";
        } else {
            $changeStatus = "UPDATE user SET status='user' WHERE login='$login'";
        }
        mysqli_query($link, $changeStatus);
        header("Location: ../admin.php");
    }

?>