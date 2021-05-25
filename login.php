<?php
include 'db_connection.php';
if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']))
{
//    ini_set('display_errors', '1');
//    ini_set('display_startup_errors', '1');
//    error_reporting(E_ALL);
$username= $_POST['email'];
$password = $_POST['password'];
$db_email=null;$db_username=null;$db_password=null;
    session_start();
    $conn = OpenConn();
    $sql = "select * from employees where email='".$username."' and password ='".$password."'";
    $result = mysqli_query($conn, $sql);


    if ($conn->query($sql)) {
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $_SESSION["designation_id"]=$data['designation_id'];
                $db_email=$data['email'];
                $_SESSION['employee_id']=$data['employee_id'];
                $db_username = $data['name'];
                $db_password= $data['password'];
            }
        }
        if($username == $db_email && $db_password == $password)
        {
//            echo $_SESSION['designation_id'];
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] =$db_username;
            if($_SESSION["designation_id"] == 3)
            {
                header("Location: index.php");
            }
            elseif ($_SESSION["designation_id"] == 1 || $_SESSION["designation_id"] == 2 || $_SESSION["designation_id"] == 4)
            {
                header("Location: attendance.php");
            }
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        CloseCon($conn);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>book.com</title>
   <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<!--
<script src="main.js"></script>-->
</head>
<body>
<!--Result Skip Results Iframe-->
<!--EDIT ON-->
<div class="login">
    <h1>Login to Web App</h1>
    <form  method="post">
        <p><input type="text" name="email" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
            <label>
                <input type="checkbox" name="remember_me" id="remember_me">
                Remember me on this computer
            </label>
        </p>
        <p class="submit"><input type="submit" name="submit" value="Login"></p>
    </form>
</div>

<!--<div class="login-help">-->
<!--    <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>-->
<!--</div>-->
</body>
</html>