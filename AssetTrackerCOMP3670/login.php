<?php
    session_start();
    if (isset($_SESSION['email'])){
        header("Location: devices.php");
    }
?>
<html>
<head>

</head>
<body>
    <form method="post" action="loginAuth.php">
        Email:<input type='text' name='email'><br/>
        Password:<input type='password' name='password'><br/>
        <input type ='submit'>
    </form>
</body>
</html>