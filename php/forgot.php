<?php
error_reporting(0);
session_start();
include_once "db.php";
$email = $_POST['email'];
$password = $_POST['pass'];
$cpassword = $_POST['cpass'];
$otp = $_POST['otp'];
$email_verification_status = '0';

// checking fields are not empty
if (!empty($email) && !empty($password) && !empty($cpassword)) {
    //if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM admininfo WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            if ($password !== $cpassword) {
                echo "Confirm Password Doesn't' Match!";
            }
            else {
                //let's check user upload file or not
                $random_id = rand(time(), 10000000);
                $otp = mt_rand(111111, 999999);
                $password = password_hash($password, PASSWORD_BCRYPT);
                // let's start insert data into table

                $sql2 = mysqli_query($conn, "UPDATE admininfo SET otp = '$otp', `email_verification_status` = '0', password = '$password' WHERE email = '$email'");

                if ($sql2) {
                    $sql3 = mysqli_query($conn, "SELECT * FROM admininfo WHERE email = '{$email}'");
                    if (mysqli_num_rows($sql3) > 0) {
                        $row = mysqli_fetch_assoc($sql3);
                        $_SESSION['adminid'] = $row['adminid'];
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

            } 
        }else {
            echo "This email doesn't not exist!";
        }

    } else {
        echo "This is not valid Email!";
    }
} else {
    if (empty($email)) {
        printf("Email Address is Required*");
    } 
    else if (empty($password)) {
        printf("Please Enter Password*");
    }
    
    else if(strlen($password) < 6) {
        printf("Password minimum six letters or digits*");
    }
    
    else if (empty($cpassword)) {
        printf("Please Enter Confirm Password*");
    }

    //  else if(strlen($cpassword) < 6) {
    //     printf("Password minimum six letters or digits*");
    // }
}

?>