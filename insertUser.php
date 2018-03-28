<?php
    include "dbConnect.php";
    
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $reEnter = $_POST['reEnter'];
    $reportsTo = $_POST['reportsTo'];
    
    if ($password != $reEnter){
        echo "Passwords don't match";
        exit();
    }
    else{
        $salt = random_bytes(20);
        $hashed = hash("sha256", $salt.$password);
    }
    
    if ($reportsTo == ""){
        $reportsTo = "None";
    }
    else{
        $arr = preg_split('/\\s/', $reportsTo, -1);
        $reportFirst = $arr[0]; $reportLast = $arr[1];
        $reportQuery = "SELECT Email FROM User WHERE FirstName = '$reportFirst' AND LastName = '$reportLast'";
        $result = mysqli_query($conn, $reportQuery);
        if ($result->num_rows != 0){
            $row = $result->fetch_assoc();
            $reportsTo = $row['Email'];
        }
        else{
            echo "Error!!!";
            exit();
        }
    }
    
    if (isset($_POST['admin'])){
        $perm = "admin";
    }
    else{
        $perm = "standard";
    }
    
    $cols = "FirstName, LastName, Email, Password, Salt, Phone, PermissionLevel, ReportsTo";
    $vals = "'$first', '$last', '$email', '$hashed', '$salt', '$phone', '$perm', '$reportsTo'";
    
    $query = "INSERT INTO User ($cols) VALUES ($vals)";
    
    if ($result = mysqli_query($conn, $query) === TRUE) {
    echo "New record created successfully";
    } else {
        //Error message
    }
    
    mysqli_close($conn);
?>