<?php
    include "dbConnect.php";
    include "utils.php";
    
    $id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $assignedTo = $_POST['assignedTo'];
    
    $assignedTo = getEmail($assignedTo);
    if ($assignedTo != 'NULL'){
        $assignedTo = "'$assignedTo'";
    }
    
    $cols = "Id, Type, Description, AssignedTo";
    $vals = "'$id', '$type', '$description', $assignedTo";
    
    $query = "INSERT INTO Device ($cols) VALUES ($vals)";
        
    if ($result = mysqli_query($conn, $query) === TRUE) {
        echo "<script type='text/javascript'>alert(\"New device added!\"); window.location.href = 'devices.php';</script>";
        exit();
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>