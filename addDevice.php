<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
?>
<html>
<head>
    <link rel="stylesheet" href="CSSmain.css">
</head>
<body>
    <?php include_once "adminNav.php"; ?>
    <form method='post' action='insertDevice.php'>
        Id: <input type='text' name='id'><br/>
        Type: <input type='text' name='type'><br/>
        Description: <input type='text' name='description'><br/>
        Assigned To: <input list="assignedTo" name = "assignedTo"><br/>
        <datalist id ="assignedTo">
            <option selected value='Inventory'>
            <?php
                include "dbConnect.php";
                $query = "SELECT FirstName, LastName FROM User WHERE email != 'sample@test.com';";
                if(!$result = mysqli_query($conn, $query)){
                    mysqli_error($conn);
                    exit();
                }
                while($row = $result->fetch_assoc()){
                    $fullName = $row['FirstName']." ".$row["LastName"];
                    echo "<option value = '$fullName'>";
                }
            ?>
        </datalist>
        <input type ='submit'>
    </form>
</body>
</html>