<?php
$servername = "localhost";
$username = "root";
$password = "wit123";
$db = "assettracker";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
} 
//echo "Connected successfully";
?>