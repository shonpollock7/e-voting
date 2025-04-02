<?php
error_reporting(0);
session_start();
include 'db.php';
$email_verification_status = '0';
$unique_id = $_SESSION['id'];
$email = $_SESSION['email'];


$sql = mysqli_query($conn, "SELECT * FROM adminlogin WHERE email = '{$email}'");
if (mysqli_num_rows($sql) > 0) {
    
$params = session_get_cookie_params();  

$sql2 = "UPDATE adminlogin SET `email_verification_status` = '0' WHERE email = '$email'";
mysqli_query($conn, $sql2);

mysqli_close($conn);

setcookie(session_name(), null, time()-48000,
          $params['path'], $params['domain'], $params['httponly']);

session_destroy();

header("location:../index.php");
exit();
}


?>
