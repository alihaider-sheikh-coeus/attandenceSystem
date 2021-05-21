<?php
include 'db_connection.php';
if(isset($_POST['submit']))
{
//    ini_set('display_errors', '1');
//    ini_set('display_startup_errors', '1');
//    error_reporting(E_ALL);
$username= $_POST['email'];
$password = $_POST['password'];
//$username = stripcslashes($username);$password = stripcslashes($password);
if(isset($username) && isset($password))
{
    session_start();
    $conn = OpenConn();
    $sql = "select * from employees where EMAIL='".$username."' and password ='".$password."'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $_SESSION["designation_id"]=$data['designation_id'];  // displaying data in option menu
        }
    }
    if ($conn->query($sql)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] =$username;
        if($_SESSION["designation_id"] === 3)
        {header("Location: index.php");
        }
        else
        {
         header("Location: attendance.php");
        }

    } else {
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