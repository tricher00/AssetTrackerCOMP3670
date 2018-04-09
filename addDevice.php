<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
?>
<html>
<head>
    <link rel="stylesheet" href="CSSmain.css">
    <script type="text/javascript" src="validator.js"></script>
</head>
<body>
    <?php include_once "adminNav.php"; ?>
    <form method='post' action='insertDevice.php'>
    <table>
        <tr>
            <td>Id:</td> <td><input type='text' name='id' class="required"></td>
            <td>Type:</td> <td><input type='text' name='type' class="required"></td>
        </tr>
        <tr>
            <td>Description:</td> <td><input type='text' name='description' class="required"></td>
            <td>Assigned To:</td>
            <td>
                <select name ="assignedTo" class="required"><br/>
                    <option value='NULL'>Inventory</option>
                    <?php
                        include "dbConnect.php";
                        $query = "SELECT Email, FirstName, LastName FROM User WHERE Email != 'sample@test.com';";
                        if(!$result = mysqli_query($conn, $query)){
                            mysqli_error($conn);
                            exit();
                        }
                        while($row = $result->fetch_assoc()){
                            $email = $row['Email'];
                            $fullName = $row['FirstName']." ".$row["LastName"];
                            echo "<option value = '$email'>$fullName</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan = 4 style="text-align:right"><input type ='submit'></td>
        </tr>
    </table>
    </form>
</body>
</html>