<?php
session_start();
require_once('class.php');
$antenatalProgress = new Methods();
if (isset($_POST['btn-Save'])) {
    $antenatalProgress-> AntenatalProgress();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Antenatal Progress</title>
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
  <form class="" action="Antenatal-Progress.php" method="post">

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
      <table  width="150%" height="250%"  >
          <thead>
            <tr>
              <th style="background-color: lightskyblue;"><center><h3 style="color: red;">ANTENATAL PROGRESS</h3></center></th>
            </tr>
          </thead>
          <table  width="100%"height="100%"  border="1">
            <thead>
              &nbsp;
              <tr style="background-color: #7fffd4;">
              <th style="color: red;font-size: 20px;padding:20px"><center>Date</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>WT(kg)</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>BP(mmHg)</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Urine/Protein/Sugar</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Gest. Age in Weeks</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Fundal Height(cm)</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Pres</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Descent</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>FH</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Supply of Iron / Folic Acid Tabs(Weeks)</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Complaints and Treatment</center></th>
              <th style="color: red;font-size: 20px;padding:20px"><center>Name / Signature</center></th>
            </tr>
            </thead>
            <tbody>
              <!--antenatal progress date  -->
                <tr>
                  <td>
                  &nbsp;&nbsp;<input id="bordershadow"type="date" name="pdate" value="" style="width:90%; height: 45%; font-size: 16px; padding: 10px;" required>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pweight" value="" style="width:60%; height: 45%; font-size: 16px; padding: 10px;" required></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pbp" value="" style="width:80%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="purine" value="" style="width:90%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pgestweek" value="" style="width:60%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pfundal" value="" style="width:90%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="ppres" value="" style="width:60%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pdescent" value="" style="width:70%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pfh" value="" style="width:60%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="piron" value="" style="width:90%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pcomplain" value="" style="width:90%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                  <td>
                      <center><input id="bordershadow"type="text" name="pname" value="" style="width:90%; height: 45%; font-size: 16px; padding: 10px;"></center>
                  </td>
                </tr>
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
