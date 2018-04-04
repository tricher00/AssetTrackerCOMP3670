<?php
   $id = $_GET['id'];
    include "dbConnect.php";
    $query = "DELETE FROM Request WHERE Id = '$id';";
    echo $query;
    if(!$result = mysqli_query($conn, $query)){
        mysqli_error($conn);
        exit();
    }
    header("Location: requests.php");
    exit();
?>