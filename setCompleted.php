<?php
    include "dbConnect.php";
    
    $id = $_GET['id'];
    
    $query = "UPDATE Ticket SET Status = 'Completed' WHERE Id = '$id';";
    
    if ($result = mysqli_query($conn, $query) === TRUE) {
        mysqli_close($conn);
        header("Location: tickets.php");
        exit();
    } else {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
?>