<?php
session_start();
require_once('class.php');
$editPateintRecord = new Methods();

if (isset($_POST['btn-Update'])) {
    $editPateintRecord->Update_Patient_personal_infomation();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Patient Records</title>
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
  <form class="" action="Edit-Registered-Patient-Record.php"  method="post">

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
      if(isset($_GET['success']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Update Successful</strong>
        </div>
        <?php
      }
      ?>
      <!-- getting patients details from the database -->
      <?php
      if(isset($_GET['patID']))
      {
        $patID = $_GET['patID'];
        $editPateintRecord->FetchPatientData($patID);

      }
      ?>
    </div>
  </center>
  <br>

    </p>

    <div id="page-wrap">
      <table  width="220%" height="300" cellspacing="10" cellpadding="10">
          <thead>
            <tr>
              <th style="background-color: lightskyblue;   padding:20px;"><center><h3 style="color: red;">MOTHER'S INFORMATION</h3></center></th>
            </tr>
          </thead>

        <!-- menstration form -->
            <tbody>
              <tr>
                <td style="padding: 20px">
                    <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; height: 30%">Patient ID:</label></center>
                    <input type="text" id="bordershadow" name="apId" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:red; " value="<?php echo @$_SESSION['eId']; ?>" readonly>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                    <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; height: 30%">First Name:</label></center>
                    <input type="text" id="bordershadow" name="fn" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eFirstName'];?>" >
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Middle Name:</label></center>
                  <input type="text" id="bordershadow" name="mn" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eMiddlename'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Last Name:</label></center>
                  <input type="text" id="bordershadow" name="ln" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eLastName'];?>">
                </td>
              </tr>

              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Date Of Birth:</label></center>
                  <input type="date" id="bordershadow" name="dob" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%;color:#8b008b;" value="<?php echo @$_SESSION['eDateOfBirth'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Age:</label></center>
                  <input type="text" id="bordershadow" name="age" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%;color:#8b008b;" value="<?php echo @$_SESSION['eAge'];?>" readonly>
                </td>
              </tr>

              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Educational Status:</label></center>
                  <select id="bordershadow" class="form-control form-group-sm " name="edu_status" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:#8b008b;">
                    <option value="<?php echo @$_SESSION['eEducationalStatus'];?>"><?php echo @$_SESSION['eEducationalStatus'];?></option>
                    <option value="Junior High School">Junior High School</option>
                    <option value="Senior High School">Senior High School</option>
                    <option value="Tertiary">Tertiary</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Marital Status:</label></center>
                  <select id="bordershadow" class="form-control form-group-sm " name="marital_status" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:#8b008b;">
                    <option value="<?php echo @$_SESSION['eMarritalStatus'];?>"><?php echo @$_SESSION['eMarritalStatus'];?></option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>          </select>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Occupation:</label></center>
                  <input type="text" id="bordershadow" name="occupation" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eOccupation'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Telephone:</label></center>
                  <input type="number" id="bordershadow" name="contact" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eTelephone'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">House Number:</label></center>
                  <input type="text" id="bordershadow" name="houseNo" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eHouseNumber'];?>" >
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Street Name:</label></center>
                  <input type="text" id="bordershadow" name="street" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%;  color:#8b008b;" value="<?php echo @$_SESSION['eStreetName'];?>" >
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Location:</label></center>
                  <input type="text" id="bordershadow" name="location" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eLocation'];?>" >
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Date of First Visit:</label></center>
                  <input type="date" id="bordershadow" name="fvisit" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:#8b008b;" value="<?php echo @$_SESSION['eDateVisit'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Name Of Midwife:</label></center>
                  <input type="text" id="bordershadow" name="midwife" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['eMidwife'];?>">
                </td>
              </tr>

            </tbody>
      </table>
  </div>
<br><br>

  <br>
        <div id="page-wrap">
          <br>
          <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Update" onclick="location.reload(true);" >Update</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="Edit-Partner-Record.php?patID=<?php echo @$patID;?>" style="float:middle;" class="btn btn-large">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;
              <img src="images/return.png" alt="" width = "40" height ="40"><a href="View-Registered-Patient.php" style="float:middle;" class="">Return</a>
              <label for="" style="float: right; width:20%; height: 20%; font-size: 16px; color: forestgreen;"><strong>STEP 1/2</strong></label>
            </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
