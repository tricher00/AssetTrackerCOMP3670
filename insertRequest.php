<?php
    session_start();
    include "dbConnect.php";
    
    $user = $_SESSION['email'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $neededBy = $_POST['neededBy'];
    $comments = $_POST['comments'];
    
    $cols = "UserId, DeviceType, Description, Comments, NeededBy";
    $vals = "'$user', '$type', '$description', '$comments', '$neededBy'";
    
    $query = "INSERT INTO Request ($cols) VALUES ($vals)";
    
    if (mysqli_query($conn, $query) === TRUE) {
        $reportQuery = "SELECT ReportsTo FROM User WHERE Email = '$user'";
        if ($result = mysqli_query($conn, $reportQuery)) {
            $row = $result->fetch_assoc();
            $reportsTo = $row['ReportsTo'];
            echo $reportsTo;
            if ($reportsTo = 'NULL'){
                $idQuery = "SELECT MAX(Id) FROM Request WHERE UserId = '$user'";
                if ($result = mysqli_query($conn, $idQuery)) {
                    $row = $result->fetch_assoc();
                    $reqId = $row['MAX(Id)'];
                    $approveUrl = "approveReq.php?id=".$reqId;
                    mysqli_close($conn);
                    echo "<script type='text/javascript'>alert(\"Request submitted!\"); window.location.href = '$approveUrl';</script>";
                    header("Location: ");
                }
                else{
                    mysqli_close($conn);
                    echo mysqli_error($conn);  
                }
            }
        }
        else{
            mysqli_close($conn);
            echo mysqli_error($conn);
        }
        mysqli_close($conn);
        echo "<script type='text/javascript'>alert(\"Request submitted!\"); window.location.href = 'requests.php';</script>";
        exit();
    } else {
        mysqli_close($conn);
        echo mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>