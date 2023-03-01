<?php 
    session_start();
    $_SESSION['status'] = null;
    $_SESSION['auth'] = null;
    header("Location: ../index.php");
?>