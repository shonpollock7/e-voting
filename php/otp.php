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

$unique_id = $_SESSION['adminid'];
$session_otp = $_SESSION['otp'];
$email = $_SESSION['email'];

$otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

if (!empty($otp)) {
    if ($otp == $session_otp) {
        $sql = mysqli_query($conn, "SELECT * FROM admininfo WHERE adminid = '{$unique_id}' AND otp = '{$otp}'");
        if (mysqli_num_rows($sql) > 0) {
            // $unique_id = $_GET['admin_id'];
            // $sql2 = "SELECT admin_id FROM admininfo WHERE adminid='$unique_id'";
            // $result = mysqli_query($conn, $sql2);
            // if ($result == $unique_id)
                $null_otp = '0';
                $sql3 = "UPDATE admininfo SET `email_verification_status` = '1',`otp`='$null_otp' WHERE adminid = '{$unique_id}'";
                // echo $sql3;
                $result = mysqli_query($conn, $sql3);
                if ($result) {
                    $row = mysqli_fetch_assoc($sql);
                    if ($row) {
                        $_SESSION['adminid'] = $row['adminid'];
                        $_SESSION['email_verification_status'] = $row['email_verification_status'];
                        echo "success";
                    }
                }
            // }
        }
    } else {
        echo "Wrong Otp!";
    }
} else {
    echo "Please enter the otp code!";
}
?>