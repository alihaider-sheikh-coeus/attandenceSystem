<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
function openConn()
{$hostname = "localhost";
$username = "root";
$password = "pak@8096";
$database = "attandence";
$db_connect =  new mysqli($hostname, $username, $password, $database);
if($db_connect->connect_error) {
    die("Connection Failed: ".$db_connect->connect_error);
}
return $db_connect;
}
function CloseCon($conn)
{
    $conn -> close();
}

?>