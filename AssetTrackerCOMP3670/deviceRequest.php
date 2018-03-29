<?php
    include_once "sessionAuth.php";
?>
<html>
<head>

</head>
<body>
    <?php include_once "navigation.php"; ?>
    <form method='post' action='insertRequest.php'>
        Type: <input type='text' name='type'><br/>
        Description: <input type='text' name='description'><br/>
        Date Needed By: <input type="date" name="neededBy"><br/>
        Additional Comments: <textarea name='comments'></textarea><br/>
        <input type ='submit'>
    </form>
</body>
</html>