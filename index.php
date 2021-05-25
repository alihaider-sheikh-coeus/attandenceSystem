<?php
session_start();
//var_dump( $_SESSION["loggedin"]);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <script src="main.js"></script>
    </head>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
<p>
    <a href="attendance.php" class="btn btn-warning">Mark attendance </a>
    <a href="addEmployee.php" class="btn btn-primary">Add employee </a>
    <a href="showEmployee.php" class="btn btn-info">Show employees </a>
    <button id ="getReport" class="btn btn-info" >Report</button>
    <input type="month" id="bdaymonth" name="bdaymonth">
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</p>
<div class="report">

</div>
</body>
</html>
