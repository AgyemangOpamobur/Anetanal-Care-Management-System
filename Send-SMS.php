<?php
session_start();
require 'class.php';
$getSmsMethod = new Methods();

if (isset($_POST['btn-Send'])) {
  $name  =  $_SESSION['fn'];
  $contact = trim($_POST['smscontact']);
  $message = trim($_POST['MessageDetails']);
  $getSmsMethod->SendSMS($name,$contact,$message);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Send SMS</title>
</head>
<link rel="stylesheet" href="css/style2.css" media="screen">
<link rel="stylesheet" href="css/bootstrap2.css" media="screen">
<link rel="stylesheet" href="css/bootstrap.css" media="screen">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="assets/styles.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="assets/styles.css" rel="stylesheet" >
<!-- Favicon link -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">


<body>
  <style media="screen">
    #bordershadow{
      border-radius : 2px ;
        box-shadow : 0 0 1px 2px #123456 ;
    }
  </style>

  <div class="container">

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <br>
          <!--navbar design and content  -->
          <center>
          <table style="width: 70%">
            <tr>
              <a class="brand" href="#">
                <th  >
                  <td class="nav-item">
                      <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px" for="">User Status: &nbsp;<label style="color: deeppink; font-size: 18px"><?php echo @$_SESSION['status'];?></label></label>
                   </td>
                </th>

                <th  >
                  <td class="nav-item">
                      <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px" for="">User Staff_ID: &nbsp;<label style="color: deeppink; font-size: 18px"><?php echo @$_SESSION['staffid'];?></label></label>
                  </td>
                </th>
                <th  >
                  <td>
                      <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px" for="">User Name: &nbsp;<label style="color: deeppink; font-size: 18px"><?php echo @$_SESSION['userName'];?></label></label>
                   </td>
                </th>
                <th  >
                  <td>
                      <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px" for="">Date: &nbsp;&nbsp;<label style="color: deeppink; font-size: 18px"><?php echo date("d-M-Y");?></label></label>
                  </td>
                </th>
            </a>
          </tr>
        </table>
      </center>
      </div>
    </div>
  </div>
  <center>
    <div class="col-md-4">
<br>
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

      if(isset($_GET['fail']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Message was not sent due to internet connection or No SMS bundle.</strong>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_GET['Sucess']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Message sent</strong>
        </div>
        <?php
      }
      ?>
      <!-- getting user details from databse with id -->
      <?php
      if(isset($_GET['Mother_Id']))
      {
        $patID = $_GET['Mother_Id'];
        $getID = explode("C", $patID);
        $actualId = $getID[1];
        $getSmsMethod->FetchData($actualId);

      }
      ?>
      <!-- getting patients details if its emergency care -->
      <?php
      if(isset($_GET['id']))
      {
        $patID = $_GET['id'];
        $getSmsMethod->FetchEmergencyData($patID);

      }
      ?>
    </div>
  </center>
  <br>
    </p>
    <br><br>

<br><br>
<form class="" action="Send-SMS.php" method="post">

  <div id="page-wrap">
    <table  width="220%" height="300" cellspacing="10" cellpadding="10">
        <thead>
          <tr>
            <th style="background-color: lightskyblue;   padding:20px;"><center><h3 style="color: red;">Send SMS</h3></center></th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; height: 30%">Patient ID:</label></center>
                  <input type="text" id="bordershadow" name="apId" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;" value="<?php echo @$_SESSION['smsId']; ?>" readonly>
              </td>
            </tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Full Name</label></center>
                <input type="text" id="bordershadow" name="afullname" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;" value="<?php echo @$_SESSION['smsFullname']; ?>"  readonly>
              </td>
            </tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Telephone</label></center>
                <input type="text" id="bordershadow" name="smscontact" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;" value="<?php echo @$_SESSION['smsContact'] ;//'0245953446'; ?>" readonly>
              </td>
            </tr>

            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Message:</label><textarea id="bordershadow"  name="MessageDetails" rows="9" cols="30" style="width:40%; height: 50%; font-size: 16px;position: relative; left: -23%; " placeholder="Write message details here"></textarea>
              </td>
            </tr>

          </tbody>
    </table>
  </div>
<br><br>
<div id="page-wrap">
  <br>
  <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Send">Send</button>&nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a><hr/>
        </center>
</div>
</form>

</div>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
