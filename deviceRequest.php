<?php
    include_once "sessionAuth.php";
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
    <form method='post' action='insertRequest.php'>
        Type: <input type='text' name='type' id="required"><br/>
        Description: <input type='text' name='description' id="required"><br/>
        Date Needed By: <input type="date" name="neededBy" id="required"><br/>
        Additional Comments: <textarea name='comments' id="required"></textarea><br/>
        <input type ='submit'>
    </form>
</body>
</html>