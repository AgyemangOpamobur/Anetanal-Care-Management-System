<?php
session_start();

require 'class.php';
$editPartnerRecord = new Methods();


if (isset($_POST['btn-Update']))
{
  $newID = $_SESSION['newID'];

  $editPartnerRecord->Update_Patner_infomation($newID);

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Partner's Record</title>
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
  <form class="" action="Edit-Partner-Record.php" method="post">

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
<!-- getting partners information from the database -->
      <?php
      if(isset($_GET['patID']))
      {

        $patID = $_GET['patID'];
        $_SESSION['newID'] = $patID;
        $editPartnerRecord->FetchPartnerData($patID);

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
              <th style="background-color: lightskyblue;   padding:20px;"><center><h3 style="color: red;">PARTNER'S INFORMATION</h3></center></th>
            </tr>
          </thead>

        <!-- menstration form -->
            <tbody>
              <tr>
                <td style="padding: 20px">
                    <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; height: 30%">First Name:</label></center>
                    <input type="text" id="bordershadow" name="fn2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pFirstName'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Middle Name:</label></center>
                  <input type="text" id="bordershadow" name="mn2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pMiddlename'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Last Name:</label></center>
                  <input type="text" id="bordershadow" name="ln2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pLastName'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Age:</label></center>
                  <input type="text" id="bordershadow" name="age2" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:#8b008b;" value="<?php echo @$_SESSION['pAge'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Educational Status:</label></center>
                  <select id="bordershadow" class="form-control form-group-sm " name="edu_status2" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:#8b008b;">
                    <option value="<?php echo @$_SESSION['pEducationalStatus'];?>"><?php echo @$_SESSION['pEducationalStatus'];?></option>
                    <option value="Junior High School">Junior High School</option>
                    <option value="Senior High School">Senior High School</option>
                    <option value="Tertiary">Tertiary</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Marital Status:</label></center>
                  <select id="bordershadow" class="form-control form-group-sm " name="marital_status2" style="width:20%; height: 80%; font-size: 18px; float: right; position: relative; left: -50%; color:#8b008b;">
                    <option value="<?php echo @$_SESSION['pMarritalStatus'];?>"><?php echo @$_SESSION['pMarritalStatus'];?></option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>          </select>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Occupation:</label></center>
                  <input type="text" id="bordershadow" name="occupation2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pOccupation'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Telephone:</label></center>
                  <input type="number" id="bordershadow" name="contact2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pTelephone'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">House Number:</label></center>
                  <input type="text" id="bordershadow" name="houseNo2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pHouseNumber'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Street Name:</label></center>
                  <input type="text" id="bordershadow" name="street2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pStreetName'];?>">
                </td>
              </tr>
              <tr>
                <td style="padding: 20px">
                  <center><label for="" class="control-label col-xs-5 " style="font-size: 20px; ">Location:</label></center>
                  <input type="text" id="bordershadow" name="location2" style="width:35%; height: 80%; font-size: 18px; float: right; position: relative; left: -35%; color:#8b008b;" value="<?php echo @$_SESSION['pLocation'];?>" >
                </td>
              </tr>

            </tbody>
      </table>
  </div>
<br><br>

  <br>
        <div id="page-wrap">
          <br>
          <center>
            <button class="btn btn-large btn-primary" type="submit" name="btn-Update">Update</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="Edit-Registered-Patient-Record.php?patID=<?php echo @$patID;?>" style="float:middle;" class="btn btn-large">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a>
            <label for="" style="float: right; width:20%; height: 20%; font-size: 16px; color: forestgreen;"><strong>STEP 2/2</strong></label>
          </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
