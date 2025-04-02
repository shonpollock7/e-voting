<?php
 error_reporting(0);
 session_start();
 include 'php/db.php';
 $unique_id = $_SESSION['id'];
 $random = $_SESSION['adminid'];

 $qry = mysqli_query($conn, "SELECT * FROM admininfo WHERE adminid = '{$random}'");
 if (mysqli_num_rows($qry) > 0) {
     $row = mysqli_fetch_assoc($qry);
     if ($row) {
         $_SESSION['email_verification_status'] = $row['email_verification_status'];
         if ($row['email_verification_status'] != '1') {
             header("Location:verify.php");
         }
     }
 }

 $qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id = '{$unique_id}'");
 if (mysqli_num_rows($qry) > 0) {
     $row = mysqli_fetch_assoc($qry);
     if ($row) {
         $_SESSION['email_verification_status'] = $row['email_verification_status'];
         if ($row['email_verification_status'] != '1') {
             header("Location:loginverify.php");
         }
     }
 }

 $qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id = '{$unique_id}'");
 if (mysqli_num_rows($qry) > 0) {
     $row = mysqli_fetch_assoc($qry);
     if ($row) {
         $_SESSION['email_verification_status'] = $row['email_verification_status'];
         if ($row['email_verification_status'] == '1') {
             header("Location:Dashboard/dashboard.php");
         }
     }
 }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in & Sign Up Form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/loader.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- <img src="img/cont.jpg" class="pic"> -->
    <div id="loader">
        <div class="loader row-item">
            <span class="circle"></span>
            <span class="circle"></span>
            <span class="circle"></span>
            <span class="circle"></span>
            <span class="circle"></span>
        </div>
    </div>
    <div class="form-box">
        <div class="form">
            <form action="" enctype="multipart/form-data">
                <h3>ADMIN LOGIN</h3>
                <div class="error">Error</div>
                <div class="input-box">
                    <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                    <input type="email" name="email" placeholder="Enter Email Address">
                </div>
                <div class="input-box">
                    <i class='bx bxs-lock-alt' style='color:#0b3d0b'></i>
                    <input type="password" name="pass" placeholder="Enter Password">
                </div>
                <div class="submit">
                    <input type="submit" name="button" class="button" value="Login Now">
                </div>
                <div class="group">
                    <span><a href="forgot.php">Forgot-Password</a></span>
                    <span><a href="register.php">Signup</a></span>
                </div>
            </form>
        </div>

    </div>
</body>

</html>
<script src="js/login.js?v=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function () {
        //Preloader
        preloaderFadeOutTime = 1200;
        function hidePreloader() {
            var preloader = $('#loader');
            preloader.fadeOut(preloaderFadeOutTime);
        }
        hidePreloader();
    });
</script>

</body>

</html>