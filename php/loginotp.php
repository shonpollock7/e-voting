<?php
error_reporting(0);
session_start();
include_once "db.php";
$otp1 = $_POST['otp1'];
$otp2 = $_POST['otp2'];
$otp3 = $_POST['otp3'];
$otp4 = $_POST['otp4'];
$otp5 = $_POST['otp5'];
$otp6 = $_POST['otp6'];

$unique_id = $_SESSION['id'];
$session_otp = $_SESSION['otp'];
$email = $_SESSION['email'];

$otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

if (!empty($otp)) {
    if ($otp == $session_otp) {
        $sql = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id='{$unique_id}' AND otp='{$otp}'");
        if (mysqli_num_rows($sql) > 0) {
            $null_otp = 0;
            $sql2 = mysqli_query($conn,"UPDATE adminlogin SET `email_verification_status`='1',`otp`= '$null_otp' WHERE id ='{$unique_id}'");
            if ($sql2) {
                $row = mysqli_fetch_assoc($sql);
                if ($row) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email_verification_status'] = $row['email_verification_status'];
                    echo "success";
                }
            }
        }
       
    
    } else {
        echo "Wrong Otp!";
    }
} else {
    echo "Enter Otp!";
}
?>
