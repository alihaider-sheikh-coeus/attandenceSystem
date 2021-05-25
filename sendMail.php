<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include 'db_connection.php';

 function sentMail($late_guys,$subject,$body)
{ try{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ali.haider6713@gmail.com';                     //SMTP username
    $mail->Password   = '03214398861';                               //SMTP password
    $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;
    $mail->setFrom('ali.haider6713@gmail.com', 'Mailer');
//    $mail->addAddress('alihaider.sheikh@coeus-solutions.de', 'ali haider');     //Add a recipient
    foreach($late_guys as $value) {
//        echo $value;
        $mail->addAddress($value);
    }
////Content
     $mail->isHTML(true);                                  //Set email format to HTML
     $mail->Subject = $subject;
     $mail->Body    = $body;


     $mail->send();
     echo 'Message has been sent';
 } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
session_start();
$now = new DateTime();
$absent_guys=array();
$late_guys=array();

$time="";
$today_date= $now->format('Y-m-d ');
$conn = OpenConn();
$sql="select email,boss_name from employees e left join roll_in r  ON e.employee_id=r.employee_id where r.status = 'L'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {

        array_push($late_guys,$data['email']) ;// displaying data in option menu
    }
}

//var_dump($late_guys);
sentMail($late_guys,"Reminder for attendance","Kindly mark you attendance before 11 otherwise you will be mark as absent!");

$sql="select email,boss_name from employees e left join roll_in r  ON e.employee_id=r.employee_id where r.status = 'A'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {

        array_push($absent_guys,$data['email']) ; // displaying data in option menu
    }
}
$sql1 ="SELECT employee_id,email
FROM employees
WHERE employee_id NOT IN
    (SELECT employee_id
     FROM roll_in where today_attandence ='".$today_date."')";

$result = mysqli_query($conn, $sql1);

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        array_push($absent_guys,$data['email']) ; // displaying data in option menu
    }
}
//var_dump($absent_guys);
sentMail($absent_guys,"Email attendance","you have been mark as absent!");
CloseCon($conn);



?>