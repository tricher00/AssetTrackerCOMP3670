<?php
    include_once "sessionAuth.php";
    include_once "adminCheck.php";
?>
<html>
<head>
    <link rel="stylesheet" href="CSSmain.css">
    <script type="text/javascript" src="validator.js"></script>
</head>
<body>
    <?php include_once "adminNav.php"; ?>
    <form method='post' action='insertUser.php'>
        <table>
            <tr>
                <td>First Name:</td> <td> <input type='text' name='first' class="required"></td>
                <td>Last Name:</td> <td> <input type='text' name='last' class="required"></td>
            </tr>
            <tr>
                <td>Email:</td> <td><input type='email' name='email' class="required"></td>
                <td>Phone:</td> <td> <input type='tel' name='phone'></td>
            </tr>
            <tr>
                <td>Password:</td> <td> <input type='password' name='password' class="required"></td>
                <td>Re-Enter Password:</td> <td> <input type='password' name='reEnter' class="required"></td>
            </tr>
            <tr>
                <td colspan = 4>Is this User an Administrator? <input type="checkbox" name="admin"></td>
            </tr>
            <tr>
                <td colspan = 4>
                    Who does this User report to?
                    <select name = "reportsTo">
                        <option value='NULL'>None</option>
                        <?php
                            include "dbConnect.php";
                            $query = "SELECT Email, FirstName, LastName FROM User WHERE email != 'sample@test.com';";
                            if(!$result = mysqli_query($conn, $query)){
                                mysqli_error($conn);
                                exit();
                            }
                            while($row = $result->fetch_assoc()){
                                $email = $row['Email'];
                                $fullName = $row['FirstName']." ".$row["LastName"];
                                echo "<option value = '$email'>$fullName</option>";
                            }
                        ?>
                    </select>
                </td>
            <tr>
                <td colspan = 4 style = 'text-align:right'><input type ='submit'></td>
            </tr>
        </table>
    </form>
</body>
</html>