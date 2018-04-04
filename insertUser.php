<?php
    include "utils.php";
    
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
    
    $reportsTo = getEmail($reportsTo);
    if ($reportsTo != 'NULL'){
        $reportsTo = "'$reportsTo'";
    }
    
    if (isset($_POST['admin'])){
        $perm = "admin";
    }
    else{
        $perm = "standard";
    }
    
    include "dbConnect.php";
    $cols = "FirstName, LastName, Email, Password, Salt, Phone, PermissionLevel, ReportsTo";
    $vals = "'$first', '$last', '$email', '$hashed', '$salt', '$phone', '$perm', $reportsTo";
    
    $query = "INSERT INTO User ($cols) VALUES ($vals)";
        
    if ($result = mysqli_query($conn, $query) === TRUE) {
        echo "<script type='text/javascript'>alert(\"New user added!\"); window.location.href = 'devices.php';</script>";
        exit();
    } else {
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>