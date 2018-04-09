<?php
    include "dbConnect.php";
    include "utils.php";
    
    $id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $assignedTo = $_POST['assignedTo'];
    $assignedTo = getEmail($assignedTo);
    
    if ($assignedTo == ''){
        $assignedTo = 'NULL';
    }
    else{
        $assignedTo = "'$assignedTo'";
    }
    
    $query = "UPDATE Device SET Type = '$type', Description = '$description', AssignedTo = $assignedTo WHERE Id = '$id';";
    
    if ($result = mysqli_query($conn, $query) === TRUE) {
        echo "<script type='text/javascript'>alert(\"Device Updated!\"); window.location.href = '';</script>";
        exit();
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>