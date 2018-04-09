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
    <table class = "tables">
        <tr>
            <th>Request Id</th>
            <th>Submitter</th>
            <th>Type</th>
            <th>Description</th>
            <th>Comments</th>
            <th>Needed By</th>
            <th colspan = 2>Status</th>
        </tr>
        <?php
            include "dbConnect.php";
            include "utils.php";
            
            $reqArr = array();
            $arr = getRequests($email);
            foreach ($arr as $x){
                array_push($reqArr, $x);
            }
            if (count($reqArr) != 0){
                foreach ($reqArr as $request){
                    if ($request->approved == 0){
                        $status = "Pending Approval";
                    }
                    else{
                        $status = "Approved";
                    }
                    echo"
                        <tr>
                            <td>$request->id</td>
                            <td>$request->submitFirst $request->submitLast</td>
                            <td>$request->type</td>
                            <td>$request->description</td>
                            <td>$request->comments</td>
                            <td>$request->neededBy</td>
                            <td colspan= 2>$status</td>
                        </tr>
                    ";
                }
            }
            $reqArr = array();
            $query = "SELECT Email FROM User WHERE ReportsTo = '$email'";
            if(!$result = mysqli_query($conn, $query)){
                mysqli_error($conn);
                exit();
            }
            while($row = $result->fetch_assoc()){
                $userEmail = $row['Email'];
                $arr = getRequests($userEmail);
                foreach ($arr as $x){
                    array_push($reqArr, $x);
                }
            }
            if (count($reqArr) != 0){
                foreach ($reqArr as $request){
                    if ($request->approved == 0){
                        $approveUrl = "approveReq.php?id=".$request->id;
                        $denyUrl = "denyReq.php?id=".$request->id;
                        echo"
                            <tr>
                                <td>$request->id</td>
                                <td>$request->submitFirst $request->submitLast</td>
                                <td>$request->type</td>
                                <td>$request->description</td>
                                <td>$request->comments</td>
                                <td>$request->neededBy</td>
                                <td><button onclick='location.href=\"$approveUrl\"' type='button'>Aprrove</button></td>
                                <td><button onclick='location.href=\"$denyUrl\"' type='button'>Deny</button></td>
                            </tr>
                        ";
                    }
                }
            }
            if ($_SESSION['permLevel'] == 'admin'){
                $adminQuery = "SELECT * FROM Request WHERE Approved != 0 AND UserId != '$email'";
                if(!$adminResult = mysqli_query($conn, $adminQuery)){
                    mysqli_error($conn);
                    exit();
                }
                while($adminRow = $adminResult->fetch_assoc()){
                    $id = $adminRow['Id'];
                    $user = $adminRow['UserId'];
                    $type = $adminRow['DeviceType'];
                    $description = $adminRow['Description'];
                    $comments = $adminRow['Comments'];
                    $neededBy = $adminRow['NeededBy'];
                    $nameQuery = "SELECT FirstName, LastName FROM User WHERE Email = '$user'";
                    if(!$nameResult = mysqli_query($conn, $nameQuery)){
                        echo mysqli_error($conn);
                        exit();
                    }
                    $nameRow = $nameResult->fetch_assoc();
                    $first = $nameRow['FirstName'];
                    $last = $nameRow['LastName'];
                    echo"
                            <tr>
                                <td>$id</td>
                                <td>$first $last</td>
                                <td>$type</td>
                                <td>$description</td>
                                <td>$comments</td>
                                <td>$neededBy</td>
                                <td><button onclick='location.href=\"closeRequest.php?id=$id\"' type='button'>Close Request</button></td>
                                <td/>
                            </tr>
                        ";
                }
            }
            mysqli_close($conn);
        ?>
    </table>
</body>