<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
?>
<html>
<head>
    <script type="text/javascript" src="validator.js"></script>
</head>
<body>
    <?php include_once "navigation.php"; ?>
    <form method='post' action='insertDevice.php'>
        ID: <input type='text' name='id' id = "required"><br/>
        Type: <input type='text' name='type' id = "required"><br/>
        Description: <input type='text' name='description' id = "required"><br/>
        Assigned To: <input type="text" name="assignedTo" id = "required"><br/>
        <input type ='submit'>
    </form>
</body>
</html>