<?php
   $id = $_GET['id'];
    include "dbConnect.php";
    $query = "UPDATE Request SET Approved = 1 WHERE Id = '$id';";
    
    if(!$result = mysqli_query($conn, $query)){
        mysqli_error($conn);
        exit();
    }
    header("Location: requests.php");
    exit();
?>