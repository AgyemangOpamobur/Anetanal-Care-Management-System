<?php
session_start();
require 'class.php';


$generate = new Methods();

if(isset($_POST['btn-genCode']))
{
  $generate->GenerateRegCode();
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Generate Registration Code</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="assets/styles.css" rel="stylesheet" >
  <!-- Favicon link -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>
<body id="login">
  <div class="container">

    <form class="form-signin" action="generateRegCode.php" method="post">
      <!-- checking error in registration code -->
      <?php
      if(isset($_GET['code']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Wrong code, try again</strong>
        </div>
        <?php
      }
      ?>
      <!-- checking error in password -->
      <?php
      if(isset($_GET['staff']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Registration has already been generated for this staff id</strong>
        </div>
        <?php
      }
      ?>
      <!-- checking if the registration code is not correct -->
      <?php
      if(isset($_GET['success']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Data inserted into database</strong>
        </div>
        <?php
        //  echo $_SESSION['errorMessage'];
      }
      ?>

      <!-- Database error connection -->
      <?php
      if(isset($_GET['dataerror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong><?php echo $_SESSION['database_error']; ?></strong>
        </div>
        <?php

      }
      ?>



      <h2 class="form-signin-heading">Generate Reg. Code</h2><br>
      <label for="" class="form-signin-heading"><h4><strong>First Name </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtFN" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>Last Name </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtLN" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>Staff ID </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtStaffid" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>Contact </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtContact" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>User-Type </strong></h4></label>

        <select class="input-block-level" name="txtStatus" style="font-size: 18px;">
          <option value="Nurse">Nurse</option>
          <option value="Midwife">MidWife</option>
          <option value="Administrator">Administrator</option>
        </select>

      <!-- including a captcha -->
      <?php
      //  session_start();
      $captcha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
      $captcha = substr(str_shuffle($captcha), 0, 6);
      $_SESSION['secure'] = $captcha;
      ?>

      <!-- calling the captcha image -->
      <br>

      <img src="generate.php" alt=""><br><br>

      <input type="text" class="input-block-level" placeholder="Type the code shown" name="txtCaptcha" required />
      <br>
      <img src="images/refresh.png" alt="" width = "50" height ="50">
      <a href="GenerateRegCode.php" id="reload">Try new code</a><br><br>
      <br>

      <button class="btn btn-large btn-primary" type="submit" name="btn-genCode">Generate Code</button>
      <a href="Return.php" style="float:right;" class="btn btn-large">Cancel</a><hr />
    </form>

  </div> <!-- /container -->
  <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  
</body>
</html>
