<?php
    include "dbConnect.php";
    
    $id = $_GET['id'];
    
    $query = "DELETE FROM Device WHERE Id = '$id';";
    
    if ($result = mysqli_query($conn, $query) === TRUE) {
        mysqli_close($conn);
        header("Location: devices.php");
        exit();
    } else {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
?>