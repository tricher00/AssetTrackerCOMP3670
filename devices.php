<?php
    //include "dbConnect.php";
    include_once "sessionAuth.php";    
    $email = $_SESSION['email'];
?>
<html>
<head>

</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Assigned To</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
        <?php
            include "dbConnect.php";
            $query = "SELECT * FROM Device WHERE assignedTo = '$email';";
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
                            <td>$assignedTo</td>
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