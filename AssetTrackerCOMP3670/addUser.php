<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
?>
<html>
<head>

</head>
<body>
    <?php include_once "navigation.php"; ?>
    <form method='post' action='insertUser.php'>
        <fieldset>
            <legend>Add User</legend>
        <p>
            <label>First Name</label>
            <input type="text" name="first">
        </p>
        <p>
            <label>Last Name</label>
            <input type="text" name="last">
        </p>
        <p>
            <label>Email</label>
            <input type="email" name="email">
            <br><br/>
        </p>
        <p>
            <label>Phone</label>
            <input type="tel" name="phone">
            <br><br/>
        </p>

        <p>
            <label>Password</label>
            <input type="password" name="password">
            <label>Re-Enter Password</label>
            <input type="password" name="reEnter">
            <br><br/>
        </p>

        <p>
            <label>Is this User an Admin?</label>
            <input type="checkbox" name="admin">
            <br><br/>
        </p>

        <p>
            <label>What Department is this User in?</label>
            
            <select name="where">
                <option>Choose Department</option>
                <option>Human Resources</option>
                <option>Marketing</option>
                <option>Research</option>  
            </select>
            <br><br/>
        </p>

        <input type ='submit'>
        </fieldset>
    </form>
</body>
</html>