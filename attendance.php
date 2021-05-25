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

    $employee_id=$_SESSION['employee_id'];
//    var_dump( $today_date,$time_out,$time_in,$status,(int) $employee_id);

        $sql="insert into roll_in(id,employee_id,today_attandence,time_in,time_out,status) values(".(int)$employee_id.",".(int)$employee_id.",'".$today_date."','".$time_in."','".$time_out."','".$status."')";
        if ($conn->query($sql) && !empty($_POST['timeInField']) )
        {echo "<script type='text/javascript'>alert('time in mark');</script>";
        }
        elseif  ($conn->query($sql) && !empty($_POST['timeoutField']) )
        {
            echo "<script type='text/javascript'>alert('time out mark');</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('unable to mark attendance');</script>";
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
    <?php
    //include "db_connection.php";
    session_start();
    $conn = OpenConn();// Using database connection file here
    $now = new DateTime();
    $time="";
    $today_date= $now->format('Y-m-d ');
    $records = "SELECT time_in From roll_in  where  employee_id='".$_SESSION['employee_id']."' and today_attandence ='".$today_date."' ";  // Use select query here
    $result = mysqli_query($conn, $records);

    if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $time=$data['time_in'];
    }?>
        <input type="text" id="TimeInField" value="<?php echo $time ?>" readonly name="TimeIn">
        <?php
    }
    else{
    ?>
    <input type="text" id="TimeInField" value="" readonly name="TimeIn">
    <?php
    }
    ?>
    <button  id="TimeIn">time in</button>
    <br><br>
    <label for="TimeOut">TimeOut</label>

    <?php
    //include "db_connection.php";
    session_start();
    $conn = OpenConn();// Using database connection file here
    $now = new DateTime();
    $time="";
    $today_date= $now->format('Y-m-d ');
    $records = "SELECT time_out From roll_in  where  employee_id='".$_SESSION['employee_id']."' and today_attandence ='".$today_date."' ";   // Use select query here
    $result = mysqli_query($conn, $records);

    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $time=$data['time_out'];
        }?>
        <input type="text" id="TimeOutField" value="<?php echo $time ?>" readonly name="TimeOut">
        <?php
    }
    else{
        ?>
        <input type="text"  id="TimeOutField" value="" readonly name="TimeOut">
        <?php
    }
    ?>
    <button id="TimeOut">time out</button>
    <br><br>
    <button id="time_submit" class="btn btn-primary">Submit</button>
    <a href="index.php"  id ="back_button"class="btn btn-info id="back_btn">Back </a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    <script type="text/javascript">
        var my_var = <?php session_start(); echo $_SESSION["designation_id"]; ?>;
       if(my_var!==3)
       {
           document.getElementById('back_button').style.display="none";
       }
       else
       {
           document.getElementById('back_button').style.display="";
       }
    </script>

</body>
</html>


