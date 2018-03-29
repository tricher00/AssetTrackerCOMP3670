<?php
    session_start();
    include "dbConnect.php";
    
    $user = $_SESSION['email'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $neededBy = $_POST['neededBy'];
    $comments = $_POST['comments'];
    
    $cols = "UserId, DeviceType, Description, Comments, NeededBy";
    $vals = "'$user', '$type', '$description', '$comments', '$neededBy'";
    
    $query = "INSERT INTO Request ($cols) VALUES ($vals)";
    
    if ($result = mysqli_query($conn, $query) === TRUE) {
        echo "<script type='text/javascript'>alert(\"Request submitted!\"); window.location.href = 'devices.php';</script>";
        exit();
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>