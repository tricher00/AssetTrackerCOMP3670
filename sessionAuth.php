<?php
    session_start();
    if (isset($_SESSION['email'])){
        echo "Sup?";
        include_once "dbConnect.php";
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        
        $sql = "SELECT Password FROM User WHERE Email = '$email';";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();
            mysqli_close($conn);
            if ($password == $row['Password']){
                exit();
            }
        }
    }
    //header("Location: login.php");
?>