<?php
error_reporting(0);
session_start();
include "db.php";
$email = $_POST['email'];
$password = mysqli_real_escape_string($conn, $_POST['pass']);
$email_verification_status = '0';
$otp = $_SESSION['otp'];

// checking fields are not empty
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM admininfo WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row1 = mysqli_fetch_assoc($sql);
        $verify = password_verify($password, $row1['password']);
        if ($verify == 1) {
            $_SESSION['IS_LOGIN'] = true;
            $last_id = mysqli_insert_id($conn);
            $code = rand(11, 99);
            $random_id = "Subadmin" . $code . "_" . $last_id;
            $query = "UPDATE adminlogin SET id = '" . $random_id . "' WHERE  id = '" . $random_id . "'";
            $res = mysqli_query($conn, $query);
            $otp = mt_rand(111111, 999999);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql2 = mysqli_query($conn, "INSERT INTO adminlogin(id,email,password,otp,email_verification_status)
                    VALUES ('{$last_id}','{$email}','{$password}','{$otp}','{$email_verification_status}')");



            if ($sql2) {
                $last_id = mysqli_insert_id($conn);
                $code = rand(11, 99);
                $random_id = "Subadmin" . "_" . $code;
                $query = "UPDATE adminlogin SET id = '" . $random_id . "' WHERE  id = '" . $last_id . "'";
                $res = mysqli_query($conn, $query);
                if ($res) {
                    $sql4 = mysqli_query($conn, "SELECT * FROM adminlogin WHERE email = '{$email}'");
                    if (mysqli_num_rows($sql4) > 0) {
                        $row = mysqli_fetch_assoc($sql4);
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['otp'] = $row['otp'];
                        //mail function
                        if ($otp) {
                            $receiver = $email;
                            $subject = "From:  <$email>";
                            $body = "Name " . "\n Email" . " $email \n Otp" . " $otp";
                            $sender = "From: shonpollock0@gmail.com";

                            if (mail($receiver, $subject, $body, $sender)) {
                                echo "success";
                            } else {
                                echo "Email Problem!" . mysqli_error($conn);
                            }
                        }

                        // mail function end
                    }
                }
            } else if ($sql3 = mysqli_query($conn, "UPDATE adminlogin SET  `email_verification_status`='0',`otp`= '{$otp}' WHERE email ='{$email}'")) {
                if ($sql3) {
                    $sql4 = mysqli_query($conn, "SELECT * FROM adminlogin WHERE email = '{$email}'");
                    if (mysqli_num_rows($sql4) > 0) {
                        $row = mysqli_fetch_assoc($sql4);
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['otp'] = $row['otp'];
                        $_SESSION['email_verification_status'] = $row['email_verification_status'];
                        //mail function
                        if ($otp) {
                            $receiver = $email;
                            $subject = "From:  <$email>";
                            $body = "Name " . "\n Email" . " $email \n Otp" . " $otp";
                            $sender = "From: shonpollock0@gmail.com";

                            if (mail($receiver, $subject, $body, $sender)) {
                                echo "success";
                            } else {
                                echo "Email Problem!" . mysqli_error($conn);
                            }
                        }

                        // mail function end
                    }
                }
            } else {
                echo "Something Went wrong! " . mysqli_error($conn);
            }
        } else {
            echo "Please Enter Correct Password";
        }
    } else {
        echo "This Account Doesn't Exist";
    }

} else {
    if (empty($email)) {
        printf("Please enter your email address");
    } else if (empty($password)) {
        printf("Please enter Password");
    }
}
?>