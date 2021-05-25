<?php
include "db_connection.php";
isset($_POST['del_id']) ? deleteReocrd($_POST['del_id'],$_POST['image']) : var_dump("unable to delete");

function deleteReocrd($id,$image)
{

    $conn = OpenConn();
    $sql = "delete from roll_in where employee_id =".$id." ";
    if($conn->query($sql))
    {
        $sql="delete from employees where  employee_id =".$id." ";
        $conn->query($sql);
        unlink( "uploads/".$image );
        CloseCon($conn);
    }
    else
    {
        $sql="delete from employees where  employee_id =".$id." ";
        $conn->query($sql);
        unlink( "uploads/".$image );
        CloseCon($conn);
    }
}
?>