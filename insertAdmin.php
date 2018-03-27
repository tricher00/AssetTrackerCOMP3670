<?php
    include "dbConnect.php";
    
    $password = "P@ssw0rd";
    $salt = random_bytes(20);
    $hashed = hash("sha256", $salt.$password);
    
    $query = "INSERT INTO assettracker.User (FirstName, LastName, Email, Password, Salt, Phone, PermissionLevel, ReportsTo) VALUES ('admin', 'admin', 'sample@test.com', '".$hashed."', '".$salt."', '555-555-5555', 'admin', 'None')";
    /*
    if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    */
$conn->close();
?>