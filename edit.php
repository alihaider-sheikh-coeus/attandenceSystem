<?php
include "db_connection.php";
$Email_id = $_POST['email'];
$name = $_POST['name'];
$designation = $_POST['designation'];
$salary = $_POST['salary'];
$boss = $_POST['boss'];
$profilePic = $_FILES['imageUpload']['name'] . date('d-m-Y_H-i-s') .".jpg";

$publisher = $_POST['publisher'];
if(isset($_POST['modal_submit']))
{
    editRecord( $Email_id,$name,$designation,$salary,$boss,$profilePic);
//    header("Location: showEmployee.php");
}
function editRecord( $Email_id,$name,$designation,$salary,$boss,$profilePic)
{
//    echo "in edit record";

    $conn = OpenConn();
//    var_dump(!empty($_FILES['file-upload']['name']));
    if(!empty($_FILES['file-upload']['name'])) {
        echo "in if";

        $bookImage = $_FILES['file-upload']['name'] . date('d-m-Y_H-i-s') . ".jpg";
        $bookTemp = $_FILES['file-upload']['tmp_name'];
        move_uploaded_file($bookTemp, "uploads/" . $bookImage);
        $update = "UPDATE employees SET name = '" . $name . "', email= '" . $Email_id . "',salary= '" . $salary . "', boss_name='" . $boss . "', designation_id=" . $designation . ", image='" . $bookImage . "' WHERE email = '" . $Email_id . "'  ";
//            echo $update;

            if ($conn->query($update)) {
                echo "<script type='text/javascript'>alert('employee edited successfully');</script>";
            } else {
                echo "<script type='text/javascript'>alert(Error);</script>";

            }
    }
    else
    {
        echo "is else";
        $update = "UPDATE employees SET name = '" . $name . "', email= '" . $Email_id . "',salary= '" . $salary . "', boss_name='" . $boss . "', designation_id=" . $designation . " WHERE email = '" . $Email_id . "'  ";
//        echo $update;
        if ($conn->query($update)) {
            echo "<script type='text/javascript'>alert('employee edited successfully');</script>";
        } else {
            echo "<script type='text/javascript'>alert(Error);</script>";

        }
  }
    CloseCon($conn);
    }


