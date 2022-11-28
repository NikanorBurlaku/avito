<?php 
    session_start();
    $_SESSION['auth'] = null;
    $_SESSION['message'] = 'You are logged out';
    header("Location: index.php");
?>