<?php
    include_once "sessionAuth.php";    
    $email = $_SESSION['email'];
?>
<html>
<head>

</head>
<body>
    <?php include_once "navigation.php"; ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Assigned To</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
        <?php
            include "dbConnect.php";
            $firstLastQuery = "SELECT FirstName, LastName FROM User Where Email = '$email';";
            if(!$result = mysqli_query($conn, $firstLastQuery)){
                mysqli_error($conn);
                exit();
            }
            else{
                $row = $result->fetch_assoc();
                $first = $row['FirstName'];
                $last = $row['LastName'];
            }
            $query = "SELECT * FROM Device WHERE AssignedTo = '$email';";
            if(!$result = mysqli_query($conn, $query)){
                mysqli_error($conn);
                exit();
            }
            if ($result->num_rows != 0){
                while($row = $result->fetch_assoc()){
                    $id = $row['Id'];
                    $assignedTo = $row['AssignedTo'];
                    $type = $row['Type'];
                    $description = $row['Description'];
                    echo "
                        <tr>
                            <td>$id</td>
                            <td>$first $last</td>
                            <td>$type</td>
                            <td>$description</td>
                        </tr>
                    ";
                }
            }
            else{
                echo "<td colspan = 4>You have no assigned devices!</td>";
            }
            mysqli_close($conn);
        ?>
    </table>
</body>