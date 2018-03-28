<?php
    session_start();
    require_once "dbConnect.php";
    
    $email = $_SESSION['email'];
    $old = $_POST['old'];
    $new = $_POST['new'];
    $reEnter = $_POST['reEnter'];
    
    $sql = "SELECT Salt, Password FROM User WHERE Email = '$email';";
        
    $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows != 0){
        $row = $result->fetch_assoc();
        $salt = $row['Salt'];
        $hashPass = $row['Password'];
        $hashed = hash("sha256", $salt.$old);
        if ($hashed == $hashPass){
            if ($new == $reEnter){
                $newPass = hash("sha256", $salt.$new);
                $update = "UPDATE User SET Password = '$newPass', HasLoggedIn = 1 WHERE Email = '$email';";
                $test = mysqli_query($conn, $update);
                if (!$test){
                    die('Could not update data: ' . mysqli_error($conn));
                }
                else{
                    echo "Password updated";
                    $_SESSION['password'] = $newPass;
                }
            }
            else{
                echo "Passwords don't match";
            }
        }
        else{
            echo "Incorrect password";
        }
    }
    else{
        echo "Error!!!";
    }
    
    mysqli_close($conn);
?>