<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=antenataldb;charset=utf8','root','');
//require 'dbclass.php';
require 'class.php';
$attendance = new Methods();
$pID = '';
$Fullname = '';
$Age = '';
$contact = '';
$error = '';
global $flag;

if (isset($_POST['btn-Search']))
{
try{
  $search = @trim(strtoupper($_POST['patID']));
  $getID = explode("C", $search);
  $actualId = $getID[1];
//query to check if the record exist in the database
  $query = "SELECT * from mothersrecord where MRID='$actualId'";
  $query_res = $db->query($query);
  $count = count($query_res->fetchAll());
  if ($count > 0) {
    foreach ($db->query("SELECT * from mothersrecord where MRID='$actualId'") as $row)
    {
      if ($row) {
        $pID = $row['Patient_Number'];
        $Fullname = $row['Full_Name'];
        $Age = $row['Age'];
        $contact = $row['Telephone'];
      }
    }
  }else {
    header("location: Attendance.php?iderror");
  }

}catch(Exception $e){

  header("location: Attendance.php?iderror");
}

}

if (isset($_POST['btn-Save'])) {
  $attendance->appointment();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Antenatal Appointment</title>
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
      if(isset($_GET['iderror']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Incorrect ID / ID is not registered</strong>
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
    </p>
    <br><br>
<!--first div to search for patient ID  -->
<form class="" action="Attendance.php" method="post">

<div id="page-wrap">

  <table  width="170%" height="160" cellspacing="10" cellpadding="10">
      <thead>
        <tr>
          <th></th>
        </tr>
      </thead>
        <tbody>
          <tr>
            <td >
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; height: 30%">Enter Patient ID:</label></center>
                <input type="text" id="" name="patID" style="width:50%; height: 40%; font-size: 18px; float: right; position: relative; left: -20%;" placeholder="example: ANC1" required>

            </td>
          </tr>
          <tr>
            <td>
              <button class="btn btn-large btn-primary" type="submit" name="btn-Search" style="float: right; position: relative; left: -50%;">Search</button>
            </td>
          </tr>

        </tbody>
  </table>
</div>
</form>
<br><br>
<form class="" action="Attendance.php" method="post">

  <div id="page-wrap">
    <table  width="220%" height="300" cellspacing="10" cellpadding="10">
        <thead>
          <tr>
            <th style="background-color: lightskyblue;   padding:20px;"><center><h3 style="color: red;">SCHEDULE APPOINTMENT</h3></center></th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; height: 30%">Patient ID:</label></center>
                  <input type="text" id="bordershadow" name="apId" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;" value="<?php echo $pID; ?>" readonly>
              </td>
            </tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Full Name</label></center>
                <input type="text" id="bordershadow" name="afullname" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;" value="<?php echo $Fullname; ?>"  readonly>
              </td>
            </tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Age:</label></center>
                <input type="text" id="bordershadow" name="aage" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%;" value="<?php echo $Age; ?>" placeholder="" readonly>
              </td>
            </tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Schedule Date</label></center>
                <input type="date" id="bordershadow" name="adob" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%;" required>
              </td>
            </tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Appointment Service</label></center>
                <select id="bordershadow" class="form-control form-group-sm " name="appointment" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%;" required>
                  <option value="">None</option>
                <option value="Antenatal Service">Antenatal Service</option>
                <option value="Postnatal First Visit">Postnatal First Visit</option>
                  <option value="Postnatal Second Visit">Postnatal Second Visit</option>
                  <option value="Postnatal 6weeks Visit">Postnatal 6Weeks Visit</option>
                </select>
              </td>
            </tr>
            <tr>
            <tr>
              <td style="padding: 20px">
                <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Telephone</label></center>
                <input type="text" id="bordershadow" name="acontact" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;" value="<?php echo $contact; ?>" readonly>
              </td>
            </tr>
          </tbody>
    </table>
  </div>
<br><br>
<div id="page-wrap">
  <br>
  <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Save">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a><hr/>
        </center>
</div>
</form>

</div>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
