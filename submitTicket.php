<?php
    include_once "sessionAuth.php";    
    $email = $_SESSION['email'];
?>
<html>
<head>
    <link rel="stylesheet" href="CSSmain.css">
</head>
<body>
    <?php
        $perm = $_SESSION['permLevel'];
        if ($perm == 'admin'){
            include_once "adminNav.php";
        }
        else{
            include_once "navigation.php";
        }
    ?>
    <form method='post' action='insertTicket.php'>
        <table>
            <tr>
                <td>Select Device:</td>
                <td>
                    <select name = 'device'>
                    <?php
                        include "dbConnect.php";
                        $query = "SELECT Id, Type, Description FROM Device WHERE AssignedTo = '$email';";
                        if(!$result = mysqli_query($conn, $query)){
                            mysqli_error($conn);
                            exit();
                        }
                        while($row = $result->fetch_assoc()){
                            $id = $row['Id'];
                            $type = $row['Type'];
                            $description = $row['Description'];
                            echo "<option value='$id'>$type: $description</option>";
                        }
                        echo "<option value=''>Other</option>";
                        mysqli_close($conn);
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Comments:</td>
                <td><textarea name='comments' class="required"></textarea></td>
            </tr>
            <tr>
                <td colspan = 2 style="text-align:right">
                    <input type ='submit'>
                </td>
            </tr>
        </table>
    </form>
</body>