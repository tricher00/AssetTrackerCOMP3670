<?php
    session_start();
    require_once "dbConnect.php";    
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
        
    $sql = "SELECT Salt, Password, HasLoggedIn FROM User WHERE Email = '$email';";
        
    $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $salt = $row['Salt'];
        $hashPass = $row['Password'];
        $hasLoggedIn = $row['HasLoggedIn'];
        $hashed = hash("sha256", $salt.$password);
        if ($hashed == $hashPass){
            echo "Auth Successful!";
            if ($hasLoggedIn == 0){
                mysqli_close($conn);
                header("Location: changePassword.html");
                exit();
            }
        }
        else{
            echo "Email or Password is incorrect";
            session_destroy();
        }
    }
    else{
        echo "Error!!!";
        session_destroy();
    }
    
    mysqli_close($conn);
?>