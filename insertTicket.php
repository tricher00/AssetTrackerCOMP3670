<?php
    session_start();
    include "dbConnect.php";
    
    $user = $_SESSION['email'];
    $device = $_POST['device'];
    $comments = $_POST['comments'];
    $date = date('Y-m-d');
    
    if ($device == ''){
        $device = 'NULL';
    }
    else{
        $device = "'$device'";
    }
    
    $cols = "Submitter, DateSubmitted, Device, Comments, Status";
    $vals = "'$user', '$date', $device, '$comments', 'Pending'";
    
    $query = "INSERT INTO Ticket ($cols) VALUES ($vals)";
    echo $query;
    
    if ($result = mysqli_query($conn, $query) === TRUE) {
        echo "<script type='text/javascript'>alert(\"Ticket submitted!\"); window.location.href = 'devices.php';</script>";
        exit();
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>