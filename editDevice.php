<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
    
    $id = $_GET['id'];
    include "dbConnect.php";
    
    $query = "SELECT * FROM Device WHERE id = '$id';";
    if(!$result = mysqli_query($conn, $query)){
        echo mysqli_error($conn);
        exit();
    }
    $row = $result->fetch_assoc();
    $user = $row['AssignedTo'];
    $type = $row['Type'];
    $description = $row['Description'];
    if ($user == ''){
        $name = 'Inventory';
    }
    else{
        $nameQuery = "SELECT FirstName, LastName FROM User WHERE Email = '$user'";
        if(!$nameResult = mysqli_query($conn, $nameQuery)){
            echo mysqli_error($conn);
            exit();
        }
        $nameRow = $nameResult->fetch_assoc();
        $first = $nameRow['FirstName'];
        $last = $nameRow['LastName'];
        $name = $first." ".$last;
    }
?>
<html>
<head>
    <link rel="stylesheet" href="CSSmain.css">
    <script type="text/javascript" src="validator.js"></script>
</head>
<body>
    <?php include_once "adminNav.php"; ?>
    <form method='post' action='updateDevice.php'>
        Id: <input type='text' name='id' value='<?php echo $id; ?>' readonly="readonly" class="required"><br/>
        Type: <input type='text' name='type' value='<?php echo $type; ?>' class="required"><br/>
        Description: <input type='text' name='description' value='<?php echo $description; ?>' class="required"><br/>
        Assigned To: 
        <select name ="assignedTo" class="required">
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
                    if ($fullName == $name){
                        echo "<option value = '$email' selected = 'selected'>$fullName</option>";
                    }
                    else{
                        echo "<option value = '$email'>$fullName</option>";
                    }
                }
            ?>
        </select>
        <br/>
        <input type ='submit'>
    </form>
</body>
</html>