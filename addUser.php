<?php
    include_once "sessionAuth.php";
?>
<html>
<head>

</head>
<body>
    <form method='post' action='insertUser.php'>
        First Name: <input type='text' name='first'> Last Name: <input type='text' name='last'><br/>
        Email: <input type='email' name='email'> Phone: <input type='tel' name='phone'><br/>
        Password: <input type='password' name='password'> Re-Enter Password: <input type='password' name='reEnter'><br/>
        Is this User an Administrator? <input type="checkbox" name="admin"><br/>
        Who does this User report to? <input type="text" name="reportsTo"><br/>
        <input type ='submit'>
    </form>
</body>
</html>