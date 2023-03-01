<?php 

    if(!empty($_REQUEST['login'])){
        $login = $_REQUEST['login'];
        $link = require "database/connect.php";

        $deletetUser = "DELETE FROM user WHERE login='$login'";
        $result = mysqli_query($link, $deletetUser);
        header("Location: ../account/admin.php");
    }

?>