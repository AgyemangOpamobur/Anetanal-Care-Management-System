<?php
session_start();
require 'dbclass.php';
$database = new connect();
$db = $database->Connectdb();
$conn = $db;

global $bol;

if (isset($_POST['btn-Search']))
{

try{
  $search = @trim(strtoupper($_POST['delivery_search']));
  $getID = explode("C", $search);
  $actualId = $getID[1];

//checking if there is existing records for the patients
  $query = "SELECT * from decisionmadeonbirthpreparedness where MRID='$actualId'";
  $query_res = $conn->query($query);
  $count = count($query_res->fetchAll());
  if ($count > 0)
    {
      header("location: Delivery-Outcome-Search.php?recorderror");
    }else {
      foreach ($conn->query("SELECT * from mothersrecord where MRID='$actualId'") as $row)
      {
        if ($row) {
          $_SESSION['patID'] = $row['Patient_Number'];
          $_SESSION['fullname'] = $row['Full_Name'];
          $bol= true;
        }else{
          $bol = false;
        }
      }
      if ($bol) {
         header("location: Delivery-Outcome.php");
     }else {
          header("location: Delivery-Outcome-Search.php?iderror");
      }
    }
    }catch(Exception $e){
      header("location: Delivery-Outcome-Search.php?iderror");
     }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Delivery Outcome Search</title>
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
<br><br>
    <div class="col-xs-offset-3">

      <?php
      if(isset($_GET['iderror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong><h4>Incorrect ID / ID is not registered</h4></strong>
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
          <strong><h4>There is existing records for this patient. Goto View Labour/Delivery Outcome page and update her records.</h4></strong>
        </div>
        <?php
      }
      ?>


    </div>
  </center>

    </p>
    <br>
    <form class="" action="Delivery-Outcome-Search.php" method="post">
    <div id="page-wrap">
      <table  width="180%" height="200" cellspacing="20" cellpadding="20">
          <thead>
            <tr>
              <th><center><h3 style="color: red;"> Labour / Delivery Outcome Search</h3></center></th>
            </tr>
          </thead>
          <table width="200%"height="200" cellspacing="50" cellpadding="50">
            <thead>
              <tr>
              <th></th>
            </tr>
            </thead>
            <tbody>
              <label for="" class="control-label col-xs-8 " style="font-size: 18px;">Enter patient_ID here:</label><br>

                  <tr>
                    <td>
                      <center>
                    <input id="bordershadow"type="text" name="delivery_search" value="" class="search col-xs-offset-3" style=" width:60%; height: 100%; font-size: 16px;" placeholder="Example: ANC1" required>
                  </center>
                    </td>
                  </tr>
                  <tr>
                    <td><center> <button class="btn btn-large btn-primary" type="submit" name="btn-Search">Search</button>

                      <img src="images/return.png" alt="" width = "50" height ="50"><a href="Return.php" style="float:middle; font-size: 16px" class="">Return</a>
                    </center>
                  </td>
              </tr>
          </tbody>
          </table>

      </table>

  </div>
</form>

</div>
<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
