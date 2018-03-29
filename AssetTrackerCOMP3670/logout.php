<?php
    include_once "sessionAuth.php";
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
?>