<?php
// error_reporting(0);
// session_start();
// include 'php/db.php';
// $unique_id = $_SESSION['id'];
// $email = $_SESSION['email'];
// if (empty($unique_id)) {
//   header("Location:index.php");
// }
// $qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id = '{$unique_id}'");
// if (mysqli_num_rows($qry) > 0) {
//   $row = mysqli_fetch_assoc($qry);
//   if ($row) {
//     $_SESSION['email_verification_status'] = $row['email_verification_status'];
//     if ($row['email_verification_status'] == '1') {
//       header("Location:Dasboard/dashboard.php");
//     }
//   }
// } else {
//   header("Location:index.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OTP Verification Form</title>
  <link rel="stylesheet" href="css/verify.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="css/form.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/loader.css?v=<?php echo time(); ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
  <div id="loader">
    <div class="loader row-item">
      <span class="circle"></span>
      <span class="circle"></span>
      <span class="circle"></span>
      <span class="circle"></span>
      <span class="circle"></span>
    </div>
  </div>
  <!-- <img src="img/cont.jpg" class="pic"> -->
  <div class="form">
    <section class="header">
      <h1>Verification</h1>
      <img src="img/profile.jpg" class="profile">
      <h3> The OTP code has been </h3>
      <h4> send to ******@gmail.com </h4>
    </section>


    <form action="" autocomplete="off" class="input">
      <div class="result">Error</div>
      <div class="inputs">
        <input type="number" name="otp1" required onpaste="return false">
        <input type="number" name="otp2" disabled required onpaste="return false" />
        <input type="number" name="otp3" disabled required onpaste="return false" />
        <input type="number" name="otp4" disabled required onpaste="return false" />
        <input type="number" name="otp5" disabled required onpaste="return false" />
        <input type="number" name="otp6" disabled required onpaste="return false" />
      </div>
      <div class="btn">
        <button type="submit" name="button" class="button">Verify
      </div>
    </form>

  </div>
  <script src="js/loginverify.js?v=<?php echo time(); ?>"></script>
  <script>
    const inputs = document.querySelectorAll("input"),
      button = document.querySelector("button");


    inputs.forEach((input, index1) => {
      input.addEventListener("keyup", (e) => {

        const currentInput = input,
          nextInput = input.nextElementSibling,
          prevInput = input.previousElementSibling;
        if (currentInput.value.length > 1) {
          currentInput.value = "";
          return;
        }

        if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
          nextInput.removeAttribute("disabled");
          nextInput.focus();
        }


        if (e.key === "Backspace") {
          inputs.forEach((input, index2) => {
            if (index1 <= index2 && prevInput) {
              input.setAttribute("disabled", true);
              input.value = "";
              prevInput.focus();
            }
          });
        }
        if (!inputs[5].disabled && inputs[5].value !== "") {
          button.classList.add("active");
          return;
        }
        button.classList.remove("active");
      });
    });
    window.addEventListener("load", () => inputs[0].focus());


  </script>

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