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
            echo "<a href = 'editDevices.php'><div id='editDevices'>Edit Devices</div></a><br/>";
        }
        else{
            include_once "navigation.php";
        }
    ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Assigned To</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
        <?php
            include "dbConnect.php";
            include "utils.php";
            
            if ($perm == 'admin'){
                $query = "SELECT * FROM Device;";
                if(!$result = mysqli_query($conn, $query)){
                    echo mysqli_error($conn);
                    exit();
                }
                while($row = $result->fetch_assoc()){
                    $id = $row['Id'];
                    $user = $row['AssignedTo'];
                    $type = $row['Type'];
                    $description = $row['Description'];
                    if ($user == ''){
                        $first = 'Inventory';
                        $last = '';
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
                    }
                    echo"
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
                $deviceArr = array();
                $arr = getDevices($email);
                foreach ($arr as $x){
                    array_push($deviceArr, $x);
                }
                $query = "SELECT Email FROM User WHERE ReportsTo = '$email'";
                if(!$result = mysqli_query($conn, $query)){
                    echo mysqli_error($conn);
                    exit();
                }
                while($row = $result->fetch_assoc()){
                    $userEmail = $row['Email'];
                    $arr = getDevices($userEmail);
                    foreach ($arr as $x){
                        array_push($deviceArr, $x);
                    }
                }
                if (count($deviceArr) != 0){
                    foreach ($deviceArr as $device){
                        echo"
                            <tr>
                                <td>$device->id</td>
                                <td>$device->assignedFirst $device->assignedLast</td>
                                <td>$device->type</td>
                                <td>$device->description</td>
                            </tr>
                        ";
                    }
                }
                else{
                    echo "<td colspan = 4>No devices to show!</td>";
                }
            }
            mysqli_close($conn);
        ?>
    </table>
</body>