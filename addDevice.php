<?php
    include_once "sessionAuth.php";
?>
<html>
<head>

</head>
<body>
    <form method='post' action='insertDevice.php'>
        Id: <input type='text' name='id'><br/>
        Type: <input type='text' name='type'><br/>
        Description: <input type='text' name='description'><br/>
        Assigned To: <input type="text" name="assignedTo"><br/>
        <input type ='submit'>
    </form>
</body>
</html>