<?php

include 'db_connection.php';
session_start();
 $conn = OpenConn();
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: login.php");
//    exit;
//}
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $selected = (int) $_POST['designation'];
    $boss = $_POST['boss'];
    $profilePic = $_FILES['imageUpload']['name'] . date('d-m-Y_H-i-s') .".jpg";
    $tempProfile = $_FILES['imageUpload']['tmp_name'];
    move_uploaded_file($tempProfile, "uploads/" . $profilePic);
//    var_dump($boss);
$sql="insert into employees(email,password,name,dept,salary,designation_id,image,boss_name)values('".$email."','".$password."','".$name."','".$department."','".$salary."',".$selected.",'".$profilePic."','".$boss."')";
//echo $sql;
if ($conn->query($sql))
 {
     echo "<script type='text/javascript'>alert('employee created successfully');</script>";
}
    else
    {
        echo "<script type='text/javascript'>alert('error in employee creation!');</script>";
    }
}
 CloseCon($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!--    <style>-->
<!--        body{ font: 14px sans-serif; text-align: center; }-->
<!--    </style>-->
</head>
<body>
<div style="margin-left:auto; margin-right: auto;text-align:center;border-collapse: collapse;border: medium solid black; width:50%" id="form">
    <h2 style="margin-bottom: 5%">Employee detail</h2>
    <form style="display: inline-block;text-align: left" method="post" action="" enctype="multipart/form-data">
        <fieldset style="border-color: black;border-style: solid;">
<!--            <legend>Employee detail</legend>-->
            <p>
                <label for="inputName">Name:<sup>*</sup></label>
                <input style="float:right" type="text" name="name" id="inputName">
            </p>
            <p>
                <label for="inputName" style="margin-right: 1%">Email:<sup>*</sup></label>
                <input style="float:right" type="text" name="email" id="email">
            </p>
            <p>
                <label for="password" >Password:<sup>*</sup></label>
                <input style="float:right" type="text" name="password" id="password">
            </p>
            <p>
                <label for="department">Department:</label>
                <input style="float:right" type="text" name="department" id="department">
            </p>
            <p>
                <label for="salary">salary:</label>
                <input style="float:right" type="text" name="salary" id="salary">
            </p>
            <p>
                <label for="designation">Designation:</label>
                <select style="width: 60%;float:right"  name="designation" id="boss">
                    <option value="" disabled selected>Choose Designation</option>
                    <option value="1">Developer</option>
                    <option value="2">Manager</option>
                    <option value="3">HR Manager</option>
                    <option value="4">CEO</option>
                </select>

            </p>
            <p>
                <!--            <label for="imageUpload" class="custom-file-upload">image</label>-->
                Image<input style="width: 60%;float: right" id="imageUpload" name="imageUpload" type="file"/>
            </p>
            <p>
                <label for="boss">Boss:</label>

                <select name="boss" style="width: 60%;float:right" id="boss">
                    <option value="" >Choose Boss</option>
                    <?php
                    //include "db_connection.php";
                    $conn = OpenConn();// Using database connection file here
                    $records = "SELECT name From employees where designation_id ='2'";  // Use select query here
                    $result = mysqli_query($conn, $records);

                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";  // displaying data in option menu
                        }
                    }
                    CloseCon($conn);
                    ?>
                </select>

            </p>
        </fieldset>
            <div id="formButton" style="display: flex; margin-top: 3% ;margin-bottom: 5%;justify-content: space-between">
                <input style="display: inline; width: 30%" type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">
                <input style="display: inline; width: 30%" type="reset" class="btn btn-danger" value="Reset">
                <a href="index.php" style="display: inline; width: 30%" class="btn btn-secondary">Back </a>
            </div>


    </form>


</div>


</body>
</html>