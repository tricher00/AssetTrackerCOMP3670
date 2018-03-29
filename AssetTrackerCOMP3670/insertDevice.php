<?php
    include "dbConnect.php";
    
    $id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $assignedTo = $_POST['assignedTo'];
    
    if ($assignedTo == ""){
        $assignedTo = 'NULL';
    }
    else{
        $arr = preg_split('/\\s/', $assignedTo, -1);
        $assignFirst = $arr[0]; $assignLast = $arr[1];
        $assignQuery = "SELECT Email FROM User WHERE FirstName = '$assignFirst' AND LastName = '$assignLast'";
        $result = mysqli_query($conn, $assignQuery);
        if ($result->num_rows != 0){
            $row = $result->fetch_assoc();
            $assignEmail = $row['Email'];
            $assignedTo = "'$assignEmail'";
        }
        else{
            echo mysqli_error($conn);
            exit();
        }
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