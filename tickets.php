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
    <table>
        <tr>
            <th>Id</th>
            <th>Date Submitted</th>
            <th>Device Type</th>
            <th>Device Description</th>
            <th>Comments</th>
            <th>Status</th>
        </tr>
        <?php
            include "dbConnect.php";
            include "utils.php";
            
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
            mysqli_close($conn);
        ?>
    </table>
</body>