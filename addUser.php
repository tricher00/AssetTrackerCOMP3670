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
    <form method='post' action='insertUser.php'>
        First Name: <input type='text' name='first' id="required"> 
        Last Name: <input type='text' name='last' id="required"><br/>
        Email: <input type='email' name='email' id="required"> 
        Phone: <input type='tel' name='phone' id="required"><br/>
        Password: <input type='password' name='password' id="required"> 
        Re-Enter Password: <input type='password' name='reEnter' id="required"><br/>
        Is this User an Administrator? <input type="checkbox" name="admin"><br/>
        Who does this User report to? <input list="reportsTo" name = "reportsTo" id="required"><br/>
        <datalist id ="reportsTo">
            <option selected value='None'>
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