<?php
    include_once "sessionAuth.php";    
    $email = $_SESSION['email'];
?>
<html>
<head>

</head>
<body>
    <?php include_once "navigation.php";?>
    <form method='post' action='insertTicket.php'>
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
                echo "<input type='radio' name='device' value='$id'>$type: $description<br/>";
            }
            echo "<input type='radio' name='device' value=''>Other<br/>";
            mysqli_close($conn);
        ?>
        Comments:<br/>
        <textarea name='comments'></textarea><br/>
        <input type ='submit'>
    </form>
</body>