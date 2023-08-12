<?php
session_start();
require_once('class.php');
$report = new Methods();

//generating records for year only
    if (isset($_POST['generateYear'])) {
    $getYear1 = $_POST['from2'];
    $getYear2 = $_POST['to2'];
    if (empty($getYear1) && empty($getYear2)) {
      header("location: Report-Birth-Delivery.php?dataerror");
      //checking if input is a string not integer
    }elseif(!ctype_digit(strval($getYear1)) && !ctype_digit(strval($getYear2))) {
      header("location: Report-Birth-Delivery.php?dataerror");
    }else {
      $_SESSION['BirthyearOne'] = $getYear1;
      $_SESSION['BirthyearTwo'] = $getYear2;

      header("location: Pdf-Birth-Delivery-Year.php");
    }

  }

  //generating report for month and year
  if (isset($_POST['generateMonth'])) {
    $from = $_POST['from1'];
    $to = $_POST['to1'];
    //getting months and years from the input
    $fromArray = explode("-",$from);
    $fromYear = $fromArray[0];
    $fromMonth = $fromArray[1];
    $_SESSION['BirthfromYear'] = $fromYear;
    $_SESSION['BirthfromMonth'] = $fromMonth;

    $toArray = explode("-",$to);
    $toYear = $toArray[0];
    $toMonth = $toArray[1];
    $_SESSION['BirthtoYear'] = $toYear;
    $_SESSION['BirthtoMonth'] = $toMonth;

    header("location: Pdf-Birth-Delivery-Month-Year.php");

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reort on Birth Delivery</title>
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
  <form class="" action="Report-Birth-Delivery.php" method="post">

  <div class="container">
    <!-- <form class="form-horizontal" action="Register.php" method="post" > -->
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
    <br>
    <div class="col-md-4">

      <?php
      if(isset($_GET['dataerror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Field empty / invalid input</strong>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_GET['montherror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>No record for the selected year and month</strong>
        </div>
        <?php
      }
      ?>

      <?php
      if(isset($_GET['recorderror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>No record for the select year</strong>
        </div>
        <?php
      }
      ?>
    </div>
  </center>
<br><br>
<!-- Obstetric history -->
  <div id="page-wrap">
    <table  width="200%" height="400%" cellspacing="50" cellpadding="50">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">GENERATE BIRH DELIVERY REPORT</h3></center></th>
          </tr>
        </thead>
        <tbody>
          <!--second table hold the data  -->
          <table width="90%"height="300" cellspacing="40" cellpadding="40" >
            <thead>
              <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>

                </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td style="font-size: 20px;" >Generate record by month and year</td>
                <td></td>
                <td></td>
              </tr>
              <br>
                <tr>
                    <td><label for="" class="control-label col-xs-3 " style="font-size: 18px;">From: </label><input type="month" name="from1"id="bordershadow" class="col-xs-5" style="width:50%; height:40%; font-size: 16px;"></td>
                    <td><label for="" class="control-label col-xs-3 " style="font-size: 18px;">To:</label><input type="month" name="to1" value="" id="bordershadow" class="col-xs-6" style="height:40%; width: 50%; font-size: 16px;"></td>
                    <td>
                      <input class="btn btn-large btn-primary" type="submit" name="generateMonth" value="Generate" style="float: left; position: relative; left: -40%;">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                  <td></td>
                  <td style="font-size: 20px;" >Generate record by year only </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr style="padding: 10px;">
                    <td><label for="" class="control-label col-xs-3 " style="font-size: 18px;">From: </label><input type="year" name="from2"id="bordershadow" class="col-xs-5" style="width:40%; height:50%; font-size: 16px;" placeholder="Eg: 2018"></td>
                    <td><label for="" class="control-label col-xs-3 " style="font-size: 18px;">To:</label><input type="year" name="to2" value="" id="bordershadow" class="col-xs-6" style="height:50%; width: 50%; font-size: 16px;" placeholder="Eg: 2019"></td>
                    <td>
                      <input class="btn btn-large btn-primary" type="submit" name="generateYear" value="Generate" style="float: left; position: relative; left: -40%;">
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>

          </table>

  </div>
  <br>
  <!-- Breastfeeding history -->
    <br>
        <div id="page-wrap">
          <br>
            <center> &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;
              <img src="images/return.png" alt="" width = "40" height ="40"><a href="Report.php" style="float:middle;" class="">Return</a>
              <label for="" style="float: right; width:20%; height: 20%; font-size: 16px; color: forestgreen;"><strong>STEP 1/1</strong></label>
            </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
