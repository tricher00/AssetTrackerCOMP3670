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
        <?php
            include "dbConnect.php";
            include "utils.php";
            if($perm == 'admin'){
                echo "
                    <tr>
                    <th>Id</th>
                    <th>Date Submitted</th>
                    <th>Submitted By</th>
                    <th>Device Type</th>
                    <th>Device Description</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th/>
                </tr>
                ";
                $query = "SELECT * FROM Ticket;";
                if(!$result = mysqli_query($conn, $query)){
                    echo mysqli_error($conn);
                    exit();
                }
                while($row = $result->fetch_assoc()){
                    $id = $row['Id'];
                    $user = $row['Submitter'];
                    $submitDate = $row['DateSubmitted'];
                    $device = $row['Device'];
                    $comments = $row['Comments'];
                    $status = $row['Status'];
                    if ($device == ''){
                        $device = "Other";
                        $devType = "Other";
                        $devDescription = "Other";
                    }
                    else{
                        $devQuery = "SELECT Type, Description FROM Device WHERE Id = '$device'";
                        if(!$devResult = mysqli_query($conn, $devQuery)){
                            mysqli_error($conn);
                            exit();
                        }
                        $devRow = $devResult->fetch_assoc();
                        $devType = $devRow['Type'];
                        $devDescription = $devRow['Description'];
                    }
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
                                <td>$submitDate</td>
                                <td>$first $last</td>
                                <td>$devType</td>
                                <td>$devDescription</td>
                                <td>$comments</td>
                                <td>$status</td>
                        ";
                        if ($status == 'Pending'){
                            echo "<td><button onclick='location.href=\"setInProgress.php?id=$id\"' type='button'>Move To In Progress</button></td>";
                        }
                        elseif ($status == 'In Progress'){
                            echo "<td><button onclick='location.href=\"setCompleted.php?id=$id\"' type='button'>Mark as Completed</button></td>";
                        }
                        else{
                            echo "<td/>";
                        }
                        echo"
                            </tr>
                        ";
                }
            }
            else{    
                echo "
                    <tr>
                    <th>Id</th>
                    <th>Date Submitted</th>
                    <th>Device Type</th>
                    <th>Device Description</th>
                    <th>Comments</th>
                    <th>Status</th>
                </tr>
                ";
                $ticketArr = array();
                $arr = getTickets($email);
                foreach ($arr as $x){
                    array_push($ticketArr, $x);
                }
                
                if (count($ticketArr) != 0){
                    foreach ($ticketArr as $ticket){
                        echo"
                            <tr>
                                <td>$ticket->id</td>
                                <td>$ticket->submitDate</td>
                                <td>$ticket->devType</td>
                                <td>$ticket->devDescription</td>
                                <td>$ticket->comments</td>
                                <td>$ticket->status</td>
                            </tr>
                        ";
                    }
                }
                else{
                    echo "<td colspan = 4>No tickets to show!</td>";
                }
            }
            mysqli_close($conn);
        ?>
    </table>
</body>