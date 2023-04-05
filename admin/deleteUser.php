<?php 

    if(!empty($_REQUEST['login'])){
        $login = $_REQUEST['login'];
        $link = require "database/connect.php";

        $link->query("DELETE FROM user WHERE login='$login'");
        header("Location: ../../account/admin.php");
    }

?>