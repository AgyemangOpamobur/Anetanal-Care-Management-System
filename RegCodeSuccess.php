<?php
session_start();
require_once 'class.php';

$log = new Methods();
if(isset($_POST['btn-done'])){
  header("Location: Done.php?");
}

if(isset($_POST['btn-print'])){
  header("Location: Pdf-Registration-Code.php?");
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration code successful</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="assets/styles.css" rel="stylesheet" >
  <!-- Favicon link -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">


  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body id="login">
  <div class="container">
    <form class="#" action="RegCodeSuccess.php" method="post">

      <div style="background-color: #FFFAFA;
      margin-right: 70px;
      margin-left: 50px;
      margin-bottom: 10px;
      padding: 20px;
      border-radius: 5px;
      font-size: 110%;
      <!-- background-image: url(images/firstImage.jpg); -->
      ">
      <style media="screen">
        .fontcolor{
          color:#DC143C;
          font-style: bold;
          font-size: 23px;
        }
      </style>

      <center>
      <h2 class="form-signin-heading" style="color:#006400;">Registration code successfully generated.</h2>
      <br><br>
      <h3 style="color:#0000FF;">The details are below: </h3><br><br>
      <table width="50%"height="20" cellspacing="20" cellpadding="20">
          <th></th>
          <th></th>
          <tbody>
              <tr>
                <td ><label for="" class="control-label col-xs-3 fontcolor" >First Name:</label></td>
                <td>
                  <td>
                    <h2>
                    <?php echo $_SESSION['firstName']; ?>
                    </h2>
                  </td>
              </tr>
              <tr>
                <td ><label for="" class="control-label col-xs-8 fontcolor" >Second Name:</label></td>
                <td>
                  <td>
                    <h2>
                    <?php echo $_SESSION['secondName']; ?>
                    </h2>
                  </td>
              </tr>
              <tr>
                <td ><label for="" class="control-label col-xs-6 fontcolor">Staff ID:</label></td>
                <td>
                  <td>
                    <h2>
                    <?php echo $_SESSION['staffid']; ?>
                    </h2>
                  </td>
              </tr>
              <tr>
                <td ><label for="" class="control-label col-xs-6 fontcolor" >Contact:</label></td>
                <td>
                  <td>
                    <h2>
                    <?php echo $_SESSION['contact']; ?>
                    </h2>
                  </td>
              </tr>
              <tr>
                <td ><label for="" class="control-label col-xs-6 fontcolor">Registration code:</label></td>
                <td>
                  <td>
                    <h2>
                    <?php echo $_SESSION['regCode']; ?>
                    </h2>
                  </td>
              </tr>
              <tr>
                <td ><label for="" class="control-label col-xs-6 fontcolor" >User-Type:</label></td>
                <td>
                  <td>
                    <h2>
                    <?php echo $_SESSION['usertype']; ?>
                    </h2>
                  </td>
              </tr>

          </tbody>
      </table>
      <br><br><br>
      <button class="btn btn-large btn-primary" type="submit" name="btn-done">DONE</button>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <button class="btn btn-large btn-primary" type="submit" name="btn-print">PRINT</button>

    </center>

    </div>

  </form>

</div> <!-- /container -->
<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
