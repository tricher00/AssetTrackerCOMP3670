<?php
    include_once "sessionAuth.php";
?>
<html>
<head>
    <link rel="stylesheet" href="CSSmain.css">
    <script type="text/javascript" src="validator.js"></script>
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
        <table>
            <tr>
                <td>Type:</td> <td><input type='text' name='type' class="required"></td>
            </tr>
            <tr>
                <td>Description:</td> <td><input type='text' name='description' class="required"></td>
            </tr>
            <tr>
                <td>Date Needed By:</td> <td><input type="date" name="neededBy" class="required"></td>
            </tr>
            <tr>
                <td>Additional Comments:</td> <td><textarea name='comments' class="required"></textarea></td>
            </tr>
            <tr>
                <td colspan = 2 style="text-align:right"><input type ='submit'></td>
            </tr>
        </table>
    </form>
</body>
</html>