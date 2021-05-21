<?php
 session_start();
include 'db_connection.php';
 $conn = OpenConn();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
$sql="insert into employees(EMAIL,password,name,dept,salary,designation_id,image,boss_id)values('".$email."','".$password."','".$name."','".$department."','".$salary."',".$selected.",'".$profilePic."','".$boss."')";
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
<!--    <style>-->
<!--        body{ font: 14px sans-serif; text-align: center; }-->
<!--    </style>-->
</head>
<body>
<div id="form">
    <h2>Book details</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <p>
            <label for="inputName">Name:<sup>*</sup></label>
            <input type="text" name="name" id="inputName">
        </p>
        <p>
            <label for="inputName">Email:<sup>*</sup></label>
            <input type="text" name="email" id="email">
        </p>
        <p>
            <label for="password">Password:<sup>*</sup></label>
            <input type="text" name="password" id="password">
        </p>
        <p>
            <label for="department">Department:</label>
            <input type="text" name="department" id="department">
        </p>
        <p>
            <label for="salary">salary:</label>
            <input type="text" name="salary" id="salary">
        </p>
        <p>
            <label for="designation">Designation:</label>
            <select name="designation" id="boss">
                <option value="" disabled selected>Choose option</option>
                <option value="1">Developer</option>
                <option value="2">Manager</option>
                <option value="3">HR Manager</option>
                <option value="4">CEO</option>
            </select>

        </p>
        <p>
            <label for="imageUpload" class="custom-file-upload">
                image
            </label>
            <input id="imageUpload" name="imageUpload" type="file"/>

        </p>
        <p>
            <label for="boss">Choose your boss:</label>

            <select name="boss" id="boss">
                <option disabled selected>-- Select City --</option>
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

        <div id="formButton">
            <input type="submit" name="submit" id="submit" value="Submit">
            <input type="reset" value="Reset">
            <a href="index.php" class="btn btn-info">Back </a>
        </div>

    </form>


</div>


</body>
</html>