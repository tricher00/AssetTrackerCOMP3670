<?php
    if ($_SESSION['permLevel'] != 'admin'){
        header("Location: devices.php");
    }
?>