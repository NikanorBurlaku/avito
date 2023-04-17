<?php 
    if(!empty($_REQUEST)){

        date_default_timezone_set('Europe/Chisinau');

        $sender = $_REQUEST['sender'];
        $recipient = $_REQUEST['recipient'];
        $text = $_REQUEST['message'];
        $date = date('d.m.Y');
        $time = date('H:i');
        $link->query("INSERT INTO message
        SET sender = '$sender', recipient='$recipient', value='$text', is_read=false, date='$date', time='$time'");
    }
?>