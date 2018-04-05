<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
?>
<html>
<head>
    <script type="text/javascript" src="validator.js"></script>

    <link rel="stylesheet" type="text/css" href="CSSmain.css">
</head>
<body>
    <?php include_once "navigation.php"; ?>
    <form method='post' action='insertUser.php'>
        First Name: <input type='text' name='first' id = "required"> 
        Last Name: <input type='text' name='last' id = "required"><br/>
        Email: <input type='email' name='email' id = "required"> 
        Phone: <input type='tel' name='phone'><br/>
        Password: <input type='password' name='password' id = "required"> 
        Re-Enter Password: <input type='password' name='reEnter' id = "required"><br/>
        Is this User an Administrator? <input type="checkbox" name="admin"><br/>
        Who does this User report to? <input type="text" name="reportsTo" id = "required"><br/>
        <input type ='submit'>
    </form>



</body>
</html>