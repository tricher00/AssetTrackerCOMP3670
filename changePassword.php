<?php
    include_once "sessionAuth.php";
?>
<html>
<head>
<script src = "sessionAuth.php"></script>
</head>
<body>
    <form method='post' action='updatePassword.php'>
        Old Password: <input type='password' name='old'><br/>
        New Password: <input type='password' name='new'><br/>
        Re-Enter New Password: <input type='password' name='reEnter'><br/>
        <input type ='submit'>
    </form>
</body>
</html>