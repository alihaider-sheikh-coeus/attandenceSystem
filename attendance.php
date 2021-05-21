<?php
include 'db_connection.php';
if (isset($_POST['timeInField']) || isset($_POST['timeoutField']))
{
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    session_start();
    $conn = OpenConn();
     $now = new DateTime();
    $today_date= $now->format('Y-m-d H:i:s');
    $time_in =$_POST['timeInField'];
    $hour =$_POST['hour'];
    $time_out = $_POST['timeOutField'];
   if($hour>=11 &&  $hour<12 )
   {
       $status='L';

   }
   elseif ($hour>=12)
   {
       $status='A';
   }
   else
   {
       $status ='P';
   }
    echo(strtotime("11:00:00"));

    $employee_email=$_SESSION["username"];
    var_dump( $today_date,$time_out,$time_in,$status,$employee_email);

    $sql="insert into roll_in(employee_email,today_date,time_in,time_out,status) values('".$employee_email."','".$today_date."','".$time_in."','".$time_out."','".$status."')";
if ($conn->query($sql))
{
    echo "succesfully exectuted";
}
else
{
    echo "unable to mark attendence";
}
    CloseCon($conn);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <script src="main.js"></script>
</head>
<body>

    <label for="TimeIn">TimeIn</label>
    <input type="text" id="TimeInField" readonly name="TimeIn">
    <button  id="TimeIn">time in</button>
    <br><br>
    <label for="TimeOut">TimeOut</label>
    <input type="text" id="TimeOutField" readonly name="TimeOut">
    <button id="TimeOut">time out</button>
    <br><br>
    <button id="time_submit" class="btn btn-primary">Submit</button>
    <a href="index.php" class="btn btn-info">Back </a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>

</body>
</html>


