<?php 
    if(!empty($_REQUEST)){

        date_default_timezone_set('Europe/Chisinau');

        $fromUser = $_REQUEST['from_user'];
        $toUser = $_REQUEST['to_user'];
        $text = $_REQUEST['message'];
        $date = date('d.m.Y');
        $time = date('H:i');
        $link->query("INSERT INTO message
        SET from_user = '$fromUser', to_user='$toUser', value='$text', read_status=false, date='$date', time='$time'");
    }
?>