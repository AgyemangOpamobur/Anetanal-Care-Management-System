
<?php
session_start();
require 'class.php';

$reset = new Methods();

if(isset($_POST['btn-login']))
{
  $reset->Reset_Password();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset User Password</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="assets/styles.css" rel="stylesheet" >

  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <!-- Favicon link -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Favicon link -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
  
</head>
<body id="login">
  <div class="container">

    <form class="form-signin" action="Account-Reset.php" method="post">
      <!-- checking for staff id error -->
      <?php
      if(isset($_GET['staffiderror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>This staffid is not registered</strong>
        </div>
        <?php
      }
      ?>

      <!-- checking error in registration code -->
      <?php
      if(isset($_GET['regcodeerror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Registration code is not valid.</strong>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_GET['accessblock']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry, your account is not active. Contact system administrator.</strong>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_GET['success']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Password reset successful, Login with your new password</strong>
        </div>
        <?php
      }
      ?>
      <!-- checking error in password -->
      <?php
      if(isset($_GET['passerror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Password does not match</strong>
        </div>
        <?php
      }
      ?>
      <!-- checking if the registration code is not correct -->
      <?php
      if(isset($_GET['nameerror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>First Name / Last Name is not registered. </strong>
        </div>
        <?php
      }
      ?>
      <h2 class="form-signin-heading">Reset Password</h2><br>
      <label for="" class="form-signin-heading"><h4><strong>First Name </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtFN" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>Last Name </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtLN" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>Staff ID </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtStaffid" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>New Password</strong></h4></label>
      <input type="password" class="input-block-level" placeholder="" name="txtpass1" required />
      <label for="" class="form-signin-heading"><h4><strong>Re-type Password</strong></h4></label>
      <input type="password" class="input-block-level" placeholder="" name="txtpass2" required />
      <label for="" class="form-signin-heading"><h4><strong>Registration Code </strong></h4></label>
      <input type="text" class="input-block-level" placeholder="" name="txtRegCode" value="" required />
      <button class="btn btn-large btn-primary" type="submit" name="btn-login">Reset</button>
      <a href="userportal.php" style="float:right;" class="btn btn-large">Cancel</a><hr />
    </form>

  </div> <!-- /container -->
  <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
