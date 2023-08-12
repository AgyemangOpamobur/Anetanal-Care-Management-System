<?php
session_start();
require_once('class.php');
$bulkSms = new Methods();

    if (isset($_POST['SendMessage'])) {
      $bulkSms->Send_Bulk_Sms();

    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Send Bulk SMS</title>
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
  <form class="" action="Send-Bulk-SMS.php" method="post">

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
    <br>
    <table width="100%" height="10%" >
       <th></th>
       <th></th>
       <tr>
         <td></td>
         <td>
           <center>
      <div class="col-md-4">
        <?php
        if(isset($_GET['success']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Message sent</strong>
          </div>
          <?php
        }
        ?>
      <?php
      if(isset($_GET['contacterror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>The contacts are more than the names</strong>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_GET['error']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>No network connection / No SMS bundle</strong>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_GET['nameerror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>The names are more than the contacts</strong>
        </div>
        <?php
      }
      ?>
    </div>
  </center>
</td>
</tr>
</table>
<br><br>
<!-- Obstetric history -->
  <div id="page-wrap">
    <table  width="100%" height="10%" >
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">SEND BULK SMS </h3></center></th>
          </tr>
        </thead>
        <tbody>
          <!--second table hold the data  -->
          <table width="90%"height="10" >
            <thead>
              <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
              <br>
                <tr>
                  <td>
                    </td>
                  <td>
                    <center>    <label for="" class="control-label col-xs-6 " style="font-size: 18px;">First Names:</label> </center><textarea name="Names" rows="20" cols="30" id="bordershadow" class="col-xs-6" style="height:40%; width: 50%; font-size: 16px; float: right; position: relative; left: -15%;" placeholder="Example: Grace,Mercy,Patricia etc." required></textarea>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <center>    <label for="" class="control-label col-xs-6 " style="font-size: 18px;">Contact Numbers:</label> </center><textarea name="Contact" rows="20" cols="30" id="bordershadow" class="col-xs-6" style="height:40%; width: 50%; font-size: 16px; float: right; position: relative; left: -15%;" placeholder="Example: 0245673498,0246782339,02034878293 etc." required></textarea>
                    </td>
                    <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <center>    <label for="" class="control-label col-xs-6 " style="font-size: 18px;">Message</label> </center><textarea name="Message" rows="20" cols="30" id="bordershadow" class="col-xs-6" style="height:40%; width: 50%; font-size: 16px; float: right; position: relative; left: -15%;" placeholder="Write the text here" required></textarea>
                    </td>
                    <td></td>
                </tr>
            </tbody>

          </table>

  </div>
  <br>
  <!-- Breastfeeding history -->
    <br>
        <div id="page-wrap">
          <br>
            <center>
              <input class="btn btn-large btn-primary" type="submit" name="SendMessage" value="Send Message" style=""> &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;
              <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a>

            </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
