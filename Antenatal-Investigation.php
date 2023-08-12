<?php
session_start();
require_once('class.php');
$investigation = new Methods();
if (isset($_POST['btn-Save'])) {
    $investigation-> Investigations();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Antenatal Investigations</title>
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
  <form class="" action="Antenatal-Investigation.php" method="post">

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
          <strong><?php echo $_SESSION['database_error']; ?></strong>
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
          <strong>Records Saved</strong>
        </div>
        <?php
      }
      ?>
    </div>
  </center>
  <br>
  <div id="page-wrap">
     <center>
      <p class="col-md-12">
        <table style="width: 180% ">
          <tr>
            <a class="brand" href="#">
              <th  >
                <td><?php echo "<h4>Full Name: </h4>"."<h4 style=\"color: crimson;\">".@$_SESSION['fullname']."</h4>"; ?> </td>
              </th>
              <th>
                <td><?php echo "<h4>Patient ID: </h4>"."<h4 style=\"color: crimson;\">".@$_SESSION['patID']."</h4>";  ?> </td>
              </th>
              <th>
                <td><?php  echo "<h4>DATE:</h4><h4 style=\"color: crimson;\"> ".date("d-M-Y")."</h4>"; ?> </td>
              </th>
              <!-- <th  >
              <td><?php //echo "Patient_ID: ".$patID; ?> </td>
            </th> -->
          </a>
        </tr>
      </table>
    </center>
  </div>
    </p>

    <div id="page-wrap">
      <table  width="150%" height="250%" cellspacing="20" cellpadding="20" >
          <thead>
            <tr>
              <th style="background-color: lightskyblue;"><center><h3 style="color: red;">INVESTIGATIONS</h3></center></th>
            </tr>
          </thead>
          <table  width="100%"height="100%" cellspacing="20" cellpadding="20" border="1">
            <thead>
              <tr style="background-color: #7fffd4;">
              <th style="color: red;font-size: 20px;padding:20px"><center>TYPE</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>RESULT</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>DATE</center></th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px;">Haemoglobin</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="haemoglobin" value="" style="width:40%; height: 45%; font-size: 16px;" required></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="haemoglobindate" value="" style="width:50%; height: 45%; font-size: 16px;" required>/<center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%">Repeat Hb</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="repeathb" value="" style="width:40%; height: 45%; font-size: 16px;" ></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="repeathbdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%;">Rhesus Factor</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="rhesusfactor" value="" style="width:40%; height: 45%; font-size: 16px;" ></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="rhesusfactordate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%;">Blood Group</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="bloodgroup" value="" style="width:40%; height: 45%; font-size: 16px;" required></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="bloodgroupdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%;">Sickling Test</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="sicklingtest" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="sicklingtestdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:70%;">Blood Flow</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="bf" value="" style="width:40%; height: 45%; font-size: 16px;" ></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="bfdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>
              <tr>
                <!-- writing the heading for antibodies -->
                <td colspan="3" height="100%" style="font-size: 26px; color: red; padding:20px; background-color: lightskyblue;" ><center><h4>ANTIBODY SCREENING</h4></center></td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px;width:100%">Urine Pregnacy Test</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="upttest" value="" style="width:40%; height: 45%; font-size: 16px;" ></center>
                </td>
                <td>
                <center><input id="bordershadow"type="date" name="upttestdate" value="" style="width:50%; height: 45%; font-size: 16px;"></center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px;width:100%">VDRL / PRP</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="vdrl" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
                </td>
                <td>
                <center><input id="bordershadow"type="date" name="vdrldate" value="" style="width:50%; height: 45%; font-size: 16px;" ></center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px;width:100%">HBsAg</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="hbsag" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
                </td>
                <td>
                <center><input id="bordershadow"type="date" name="hbsagdate" value="" style="width:50%; height: 45%; font-size: 16px;" ></center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px;width:100%">HIV Test</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="hiv" value="" style="width:40%; height: 45%; font-size: 16px;" required></center>
                </td>
                <td>
                <center><input id="bordershadow"type="date" name="hivdate" value="" style="width:50%; height: 45%; font-size: 16px;"></center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px;width:100%">Repeat HIV Test</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="repeathiv" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
                </td>
                <td>
                <center><input id="bordershadow"type="date" name="repeathivdate" value="" style="width:50%; height: 45%; font-size: 16px;"></center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%;">Stool RE</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="stoolre" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="stoolredate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>
              <tr>
                <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%;">Urine RE</label>
                </td>
                <td>
                  <center><input id="bordershadow"type="text" name="urinere" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
                </td>
                <td>
                  <center><input id="bordershadow"type="date" name="urineredate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
                </td>
              </tr>

            </tbody>
          </table>

      </table>
  </div>
<br><br>
<!-- other investigation records -->
  <div id="page-wrap">
    <table  width="150%" height="250%" cellspacing="20" cellpadding="20">
        <thead>
          <tr>
            <th style="background-color: lightskyblue;"><center><h3 style="color: red; padding:15px; ">OTHER INVESTIGATIONS</h3></center></th>
          </tr>
        </thead>
        <table  width="100%"height="100%" cellspacing="20" cellpadding="20" border="1">
          <thead>
            <tr style="background-color: #7fffd4;">
            <th style="color: red;font-size: 20px;padding:20px"><center>ULTRA SOUND SCAN</center></th>
            <th style="color: red;font-size: 20px;padding:20px"><center>RESULT</center></th>
            <th style="color: red;font-size: 20px;padding:20px"><center>DATE</center></th>
          </tr>
          </thead>
          <tbody >
            <tr>
              <td><label for="" class="control-label col-xs-3"style="font-size: 18px; padding:10px; width:70%; ">Gestational Age</label>
              </td>
              <td>
                <center><input id="bordershadow"type="text" name="gestation" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
              </td>
              <td>
                <center><input id="bordershadow"type="date" name="gestationdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
              </td>
            </tr>
            <tr>
              <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:100%">Placental Position</label>
              </td>
              <td>
                <center><input id="bordershadow"type="text" name="placenta" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
              </td>
              <td>
                <center><input id="bordershadow"type="date" name="placenatdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
              </td>
            </tr>
            <tr>
              <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width: 60%">Liquor Volume</label>
              </td>
              <td>
                <center><input id="bordershadow"type="text" name="liquor" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
              </td>
              <td>
                <center><input id="bordershadow"type="date" name="liquordate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
              </td>
            </tr>
            <tr>
              <td><label for="" class="control-label col-xs-3"style="font-size: 18px; width:70%">Expected Date</label>
              </td>
              <td>
                <center><input id="bordershadow"type="date" name="edd" value="" style="width:40%; height: 45%; font-size: 16px;"></center>
              </td>
              <td>
                <center><input id="bordershadow"type="date" name="edddate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
              </td>
            </tr>
            <tr>
              <td><label for="" class="control-label col-xs-3"style="font-size: 18px; padding:10px;">Others</label><textarea id="bordershadow" name="othersDesc" rows="4" cols="15" class="col-xs-1"style="width:60%; height: 30%; font-size: 16px;" placeholder="Description of other investigation here"></textarea>
              </td>
              <td>
                <center><textarea id="bordershadow" name="othersResult" rows="4" cols="15" class="col-xs-1"style="width:70%; height: 30%; font-size: 16px; float: right; position: relative; left: -20%;" placeholder="Results obtain from the investigation here"></textarea></center>
              </td>
              <td>
                <center><input id="bordershadow"type="date" name="othersdate" value="" style="width:50%; height: 45%; font-size: 16px;">/<center>
              </td>
            </tr>
            <tr>

          </tbody>
        </table>

    </table>
</div>
    <br>
    <br>
        <div id="page-wrap">
          <br>
            <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Save">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a>
              <label for="" style="float: right; width:20%; height: 20%; font-size: 16px; color: forestgreen;"><strong>STEP 1/1</strong></label>
            </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
