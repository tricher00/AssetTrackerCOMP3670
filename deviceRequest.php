<?php
    include_once "sessionAuth.php";
?>
<html>
<head>
	<script type="text/javascript" src="validator.js"></script>
</head>
<body>
    <?php include_once "navigation.php"; ?>
    <form method='post' action='insertRequest.php'>
        Type: <input type='text' name='type' id = "required"><br/>
        Description: <input type='text' name='description' id = "required"><br/>
        Date Needed By: <input type="date" name="neededBy" id = "required"><br/>
        Additional Comments: <textarea name='comments' id = "required"></textarea><br/>
        <input type ='submit'>
    </form>
</body>
</html>