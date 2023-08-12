
<?php
require_once 'class.php';
session_start();
$login = new Methods();

if(isset($_POST['btn-login']))
{
  // include 'userportalCode.php';
  $login->sign_in();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>USER PORTAL</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="assets/styles.css" rel="stylesheet" >

  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

  <!-- Favicon link -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>
<body id="login">
  <div class="container">

    <form class="form-signin" method="post">
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
      <?php
      if(isset($_GET['accessblock']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry, your account is blocked. Contact system Administrator</strong>
        </div>
        <?php
      }
      ?>

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


      <?php
      if(isset($_GET['error']))
      {
        ?>
        <!-- alert alert-success -->
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Incorrect staff ID or password!</strong>
        </div>
        <?php
      }
      ?>
      <h2 class="form-signin-heading">Sign In.</h2><br>
      <label for="" class="form-signin-heading"><h4><strong>Staff ID</strong></h4></label>
      <input type="text" class="input-block-level" id="bordershadow" placeholder="Enter your Staff ID" name="txtStaffId" value="" required />
      <label for="" class="form-signin-heading"><h4><strong>Password</strong></h4></label>
      <input type="password" class="input-block-level" placeholder="Password" value="" name="txtpass" required />

      <!-- creating a captcha  -->
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
      <a href="userportal.php" id="reload">Try new code</a><br><br>
      <button class="btn btn-large btn-primary" type="submit" name="btn-login">Sign in</button>
      <a href="Signup.php" style="float:right;" class="btn btn-large">Sign Up</a><hr />
      <a href="Account-Reset.php">Lost your Password ? </a>
      <a href="index.php" style="float:right;" >HOME </a>
    </form>

  </div> <!-- /container -->
  <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
