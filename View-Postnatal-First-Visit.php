<?php
session_start();
require_once('class.php');
$ViewFirstVisit = new Methods();

$ViewFirstVisit->GetPostnatalRecord();

if (isset($_POST['btn-Update'])) {
    $ViewFirstVisit->Update_Postnatal_First_Visit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Postnatatl First Visit</title>
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
  <form class="" action="View-Postnatal-First-Visit.php" method="post">

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
          <strong>Updated Successful</strong>
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
                <td><?php echo "<h4>Full Name: </h4>"."<h4 style=\"color: crimson;\">".@$_SESSION['patientName']."</h4>"; ?> </td>
              </th>
              <th>
                <td><?php echo "<h4>Patient ID: </h4>"."<h4 style=\"color: crimson;\">".@$_SESSION['patientID']."</h4>";  ?> </td>
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
      <table  width="180%" height="200" cellspacing="20" cellpadding="20">
          <thead>
            <tr>
              <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">POSTNATAL(FIRST VISIT 24-48 HOURS)<br>CARE OF MOTHER</h3></center></th>
            </tr>
          </thead>
          <table  width="150%"height="200" cellspacing="10" cellpadding="10">
            <thead>
              <tr>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <!-- menstration form -->
            <tbody>
                  <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Any Complaint:</label><textarea id="bordershadow" colspan="2" name="motherComplaint" rows="9" cols="30" style="width:60%; height: 50%; font-size: 16px; color:#8b008b;"><?php echo @$_SESSION['complaint1']; ?></textarea></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px; color: red;">EXAMINATION</label></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">General Condition:</label><label for="" class="control-label col-xs-2" style="font-size: 18px;">Temp:</label><input id="bordershadow" type="text" name="motherTemperature" style="width:30%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Temperature1']; ?>">
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-3" style="font-size: 18px;">BP:</label><input id="bordershadow" type="text" name="motherBP" style="width:40%; height: 70%; font-size: 16px;color:#8b008b;" value="<?php echo $_SESSION['BP1']; ?>">
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-3" style="font-size: 18px;">Pulse:</label><input id="bordershadow" type="text" name="motherPulse" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Pulse1']; ?>">
                    </td>
                  </tr>
                  <tr>
                    <td><br></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <label for="" class="control-label col-xs-3" style="font-size: 18px;">Pallor:</label>
                      <select class="col-xs-3" id="bordershadow" name="motherPallor" class="" style="width:50%; height: 70%; font-size: 16px;color:#8b008b;" >
                        <option value="<?php echo $_SESSION['Pallor1'] ?>"><?php echo $_SESSION['Pallor1']; ?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        </select>
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-4" style="font-size: 18px;">Jaundice:</label>
                      <select class="col-xs-3" id="bordershadow" name="motherJaundice" class="" style="width:50%; height: 70%; font-size: 16px; color:#8b008b;" >
                        <option value="<?php echo $_SESSION['Jaundice1'] ?>"><?php echo $_SESSION['Jaundice1']; ?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td><br></td>
                  </tr>
                  <tr>
                    <td>
                        <label for="" class="control-label col-xs-6" style="font-size: 18px;">Breast & Nipple</label>
                    </td>
                    <td>
                      <?php
                        if (empty($_SESSION['BreastAndNipple1'])) {

                        }
                        elseif ($_SESSION['BreastAndNipple1'] == "Normal") {
                        ?>
                        <label for="" class="control-label col-xs-4" style="font-size: 18px;">Normal:</label>
                        <input  type="checkbox" name="motherBreastNormal" style=" font-size: 16px; transform: scale(2); -ms-transform: scale(2); -webkit-transform: scale(2); padding:10px;" checked>
                      <?php
                      }else {
                       ?>

                    </td>
                    <td>
                        <label for="" class="control-label col-xs-6" style="font-size: 18px;">Abnormal(State):</label>
                        <input id="bordershadow" type="text" name="motherBreastAbnormalState" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['BreastAndNipple1']; ?>">
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td><br></td>
                  </tr>
                  <tr>
                    <td>
                        <label for="" class="control-label col-xs-5" style="font-size: 18px;">Abdomen:</label>
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-6" style="font-size: 18px;">Tenderness:</label>
                      <select class="col-xs-3" id="bordershadow" name="motherTenderness" class="" style="width:50%; height: 70%; font-size: 16px; color:#8b008b;" >
                        <option value="<?php echo $_SESSION['AbdomenTendernes1']; ?>"><?php echo $_SESSION['AbdomenTendernes1']; ?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        </select>
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-5" style="font-size: 18px;">Uterus Size:</label>
                      <input id="bordershadow" type="text" name="motherUterusSize" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['UterusSize1']; ?>" >
                    </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Prenium and Lochia:</label><textarea id="bordershadow" colspan="2" name="motherPrenium" rows="9" cols="30" style="width:60%; height: 50%; font-size: 16px; color:#8b008b;"><?php echo $_SESSION['PerineumAndLochia1']; ?></textarea></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                      <td>
                        <label for="" class="control-label col-xs-6" style="font-size: 18px;">Lower Limbs & Calf Pain:</label>
                        <select class="col-xs-3" id="bordershadow" name="motherlimbsCalf" class="" style="width:30%; height: 70%; font-size: 16px; color:#8b008b;" >
                          <option value="<?php echo $_SESSION['LowerLimbsCalfPain1']; ?>"><?php echo $_SESSION['LowerLimbsCalfPain1']; ?></option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                          </select>
                      </td>
                      <td>
                        <label for="" class="control-label col-xs-6" style="font-size: 18px;">Swelling:</label>
                        <select class="col-xs-3" id="bordershadow" name="motherSwelling" class="" style="width:50%; height: 70%; font-size: 16px; color:#8b008b;" >
                          <option value="<?php echo $_SESSION['Swelling1']; ?>"><?php echo $_SESSION['Swelling1']; ?></option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                          </select>
                      </td>
                      <td></td>
                  </tr>
                  <tr>
                    <td><br></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-9" colspan="2" style="font-size: 20px; color: red;">TREATMENT(Tick if given)</label></td>
                  </tr>
                  <tr>
                    <td>
                        <?php
                          if (empty($_SESSION['TreatmentVitaA1'] )) {

                          }elseif ($_SESSION['TreatmentVitaA1'] == "Vitamin A") {
                        ?>
                        <label for="" class="control-label col-xs-3" style="font-size: 18px;">Vit A:</label>
                        <input  type="checkbox" name="motherVit_A" style=" font-size: 16px; transform: scale(2); -ms-transform: scale(2); -webkit-transform: scale(2); padding:10px;" checked>
                        <?php
                        }
                       ?>
                    </td>
                    <td>
                      <?php
                        if (empty($_SESSION['TreatmentFeloate1'] )) {

                        ?>
                        <label for="" class="control-label col-xs-5" style="font-size: 18px;">Fe/Folate:</label>
                        <input  type="checkbox" name="motherFolate" style=" font-size: 16px; transform: scale(2); -ms-transform: scale(2); -webkit-transform: scale(2); padding:10px;">
                        <?php

                        }elseif ($_SESSION['TreatmentFeloate1'] == "Fe/Folate") {
                      ?>
                        <label for="" class="control-label col-xs-5" style="font-size: 18px;">Fe/Folate:</label>
                        <input  type="checkbox" name="motherFolate" style=" font-size: 16px; transform: scale(2); -ms-transform: scale(2); -webkit-transform: scale(2); padding:10px;" checked >
                        <?php
                        }
                       ?>
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-5" style="font-size: 18px;">Other(State)</label><textarea id="bordershadow" colspan="2" name="motherOther" rows="9" cols="30" style="width:40%; height: 30%; font-size: 16px; color:#8b008b;"><?php echo  $_SESSION['TreatmentOthers1']; ?></textarea>
                     </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-9" colspan="2" style="font-size: 20px; color: red;">LAB.</label></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">Hb:</label>
                    <input id="bordershadow" type="text" name="motherHb" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo @$_SESSION['LabTestHb1']; ?>" ></td>
                    <td><label for="" class="control-label col-xs-7" style="font-size: 18px;">HIV(offer if not done):</label>
                    <input id="bordershadow" type="text" name="motherHiv" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['LabTestHIV1']; ?>"
                    ></td>
                    <td></td>
                  </tr>

            </tbody>
          </table>

      </table>
  </div>
<br><br>
  <div id="page-wrap">
    <table width="100%" height="200" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">CARE OF BABY</h3></center></th>
          </tr>
        </thead>
        <table width="180%"height="200" cellspacing="40" cellpadding="40">
          <thead>
            <tr>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          <!-- form on grand multiparity -->
          <tbody>
                <tr>
                  <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Any Complaint:</label><textarea id="bordershadow" colspan="2" name="babyCareComplaint" rows="9" cols="30" style="width:60%; height: 50%; font-size: 16px; color:#8b008b;"><?php echo $_SESSION['ComplaintBaby1']; ?></textarea></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-9" colspan="2" style="font-size: 20px; color: red;">EXAMINATION(Tick if Appropriate)</label></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td>
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">Temp:</label><input id="bordershadow" type="text" name="babyTemp" style="width:30%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['TemperatureBaby1']; ?>">
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-4" style="font-size: 18px;">Heart Rate:</label><input id="bordershadow" type="text" name="babyHeartRate" style="width:30%; height: 70%; font-size: 16px;color:#8b008b;" value="<?php echo $_SESSION['HeartRateBaby1']; ?>">
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-4" style="font-size: 18px;">Pallor:</label>
                    <select class="col-xs-3" id="bordershadow" name="babyPallor" class="" style="width:55%; height: 70%; font-size: 16px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['PallorBaby1']; ?>"><?php echo $_SESSION['PallorBaby1']; ?></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td>
                  <label for="" class="control-label col-xs-3" style="font-size: 18px;">Jaundice:</label>
                  <select class="col-xs-3" id="bordershadow" name="babyJaundice" class="" style="width:30%; height: 70%; font-size: 16px;color:#8b008b;" >
                    <option value="<?php echo $_SESSION['JaundiceBaby1']; ?>"><?php echo $_SESSION['JaundiceBaby1']; ?></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    </select>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-5" style="font-size: 18px;">Breastfeeding:</label>
                    <select class="col-xs-3" id="bordershadow" name="babyBreastfeeding" class="" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['BreastfeedingBaby1']; ?>"><?php echo $_SESSION['BreastfeedingBaby1']; ?></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                      </select>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                <td>
                <label for="" class="control-label col-xs-3" style="font-size: 18px;">Activity:</label>
                <select class="col-xs-3" id="bordershadow" name="babyActivity" class="" style="width:30%; height: 70%; font-size: 16px;color:#8b008b;" >
                  <option value="<?php echo $_SESSION['ActivityBaby1']; ?>"><?php echo $_SESSION['ActivityBaby1']; ?></option>
                  <option value="Normal">Normal</option>
                  <option value="Abnormal">Abnormal</option>
                  </select>
                </td>
                <td>
                  <label for="" class="control-label col-xs-3" style="font-size: 18px;">Chest:</label>
                  <select class="col-xs-3" id="bordershadow" name="babyChest" class="" style="width:40%; height: 70%; font-size: 16px;color:#8b008b;" >
                    <option value="<?php echo $_SESSION['ChestBaby1']; ?>"><?php echo $_SESSION['ChestBaby1']; ?></option>
                    <option value="Normal">Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    </select>
                </td>
                <td>
                  <label for="" class="control-label col-xs-5" style="font-size: 18px;">Abdomen:</label>
                  <select class="col-xs-3" id="bordershadow" name="babyAbdomen" class="" style="width:45%; height: 70%; font-size: 16px; color:#8b008b;" >
                    <option value="<?php echo $_SESSION['AbdomenBaby1']; ?>"><?php echo $_SESSION['AbdomenBaby1']; ?></option>
                    <option value="Normal">Normal</option>
                    <option value="Abnormal">Abnormal</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td><br></td>
              </tr>
              <tr>
              <td>
              <label for="" class="control-label col-xs-3" style="font-size: 18px;">Limbs:</label>
              <select class="col-xs-3" id="bordershadow" name="babyLimbs" class="" style="width:30%; height: 70%; font-size: 16px;color:#8b008b;" >
                <option value="<?php echo $_SESSION['LimbsBaby1']; ?>"><?php echo $_SESSION['LimbsBaby1']; ?></option>
                <option value="Normal">Normal</option>
                <option value="Abnormal">Abnormal</option>
                </select>
              </td>
              <td>
                <label for="" class="control-label col-xs-3" style="font-size: 18px;">Head:</label>
                <select class="col-xs-3" id="bordershadow" name="babyHead" class="" style="width:40%; height: 70%; font-size: 16px;color:#8b008b;" >
                  <option value="<?php echo $_SESSION['HeadBaby1']; ?>"><?php echo $_SESSION['HeadBaby1']; ?></option>
                  <option value="Normal">Normal</option>
                  <option value="Abnormal">Abnormal</option>
                  </select>
              </td>
              <td>
                <label for="" class="control-label col-xs-5" style="font-size: 18px;">Spine/Back:</label>
                <select class="col-xs-3" id="bordershadow" name="babySpine" class="" style="width:45%; height: 70%; font-size: 16px; color:#8b008b;" >
                  <option value="<?php echo $_SESSION['SpineBackBaby1']; ?>"><?php echo $_SESSION['SpineBackBaby1']; ?></option>
                  <option value="Normal">Normal</option>
                  <option value="Abnormal">Abnormal</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td><br></td>
            </tr>
            <tr>
            <td>
            <label for="" class="control-label col-xs-3" style="font-size: 18px;">Umbilical Cord:</label>
            <select class="col-xs-3" id="bordershadow" name="babyUmbilicalCord" class="" style="width:30%; height: 70%; font-size: 16px; color:#8b008b;" >
              <option value="<?php echo $_SESSION['UmblicalCordBaby1']; ?>"><?php echo $_SESSION['UmblicalCordBaby1']; ?></option>
              <option value="Normal">Normal</option>
              <option value="Abnormal">Abnormal</option>
              </select>
            </td>
            <td>
              <label for="" class="control-label col-xs-3" style="font-size: 18px;">Skin:</label>
              <select class="col-xs-3" id="bordershadow" name="babySkin" class="" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" >
                <option value="<?php echo $_SESSION['SkinBaby1']; ?>"><?php echo $_SESSION['SkinBaby1']; ?></option>
                <option value="Normal">Normal</option>
                <option value="Abnormal">Abnormal</option>
                </select>
            </td>
            <td>
              <label for="" class="control-label col-xs-5" style="font-size: 18px;">Dischargin Eyes:</label>
              <select class="col-xs-3" id="bordershadow" name="babyDicharginEyes" class="" style="width:45%; height: 70%; font-size: 16px; color:#8b008b;" >
                <option value="<?php echo $_SESSION['DischargeEyesBaby1']; ?>"><?php echo $_SESSION['DischargeEyesBaby1']; ?></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                </select>
            </td>
          </tr>
          <tr>
            <td><br></td>
          </tr>
          <tr>
          <td>
          <label for="" class="control-label col-xs-4" style="font-size: 18px;">Passing Urine:</label>
          <select class="col-xs-3" id="bordershadow" name="babyPassingUrine" class="" style="width:30%; height: 70%; font-size: 16px;color:#8b008b;" >
            <option value="<?php echo $_SESSION['PassingUrineBaby1']; ?>"><?php echo $_SESSION['PassingUrineBaby1']; ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select>
          </td>
          <td>
            <label for="" class="control-label col-xs-6" style="font-size: 18px;">Passing Stools:</label>
            <select class="col-xs-3" id="bordershadow" name="babyPassingStool" class="" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" >
              <option value="<?php echo $_SESSION['PassingStoolBaby1']; ?>"><?php echo $_SESSION['PassingStoolBaby1']; ?></option>
              <option value="Normal">Normal</option>
              <option value="Abnormal">Abnormal</option>
              </select>
          </td>
          <td>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
        <tr>
          <td><label for="" class="control-label col-xs-9" colspan="2" style="font-size: 20px; color: red;">TREATMENT</label></td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
          <tr>
            <td>
              <label for="" class="control-label col-xs-3" style="font-size: 18px;">Vit K:</label>
              <input id="bordershadow" type="text" name="babyVitaminK" style="width:30%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['VitKTreatmentBaby1']; ?>">
            </td>
            <td>
              <label for="" class="control-label col-xs-3" style="font-size: 18px;">BCG:</label>
              <input id="bordershadow" type="text" name="babybcg" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['BCGTreatmentBaby1']; ?>" >
            </td>
            <td>
              <label for="" class="control-label col-xs-5" style="font-size: 18px;">Polio O:</label>
              <input id="bordershadow" type="text" name="babyPolio" style="width:40%; height: 70%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['PolioOTreatmentBaby1']; ?>">
            </td>
          </tr>
          <tr>
            <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Others:</label><textarea id="bordershadow" colspan="2" name="babyOthers" rows="9" cols="30" style="width:60%; height: 50%; font-size: 16px; color:#8b008b;"><?php echo $_SESSION['OtherTreatmentBaby1']; ?> </textarea></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><br><br></td>
          </tr>
          <tr>
            <td>
              <tr>
                <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Date of Next Visit:</label><input id="bordershadow" type="date" name="babyNextDate" rows="9" cols="30" style="width:60%; height: 50%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['DateNextVisitBaby1']; ?>"></input></td>
                <td>
                    <label for="" class="control-label col-xs-4" style="font-size: 18px;">Signature of Attending Midwife:</label><input id="bordershadow" type="text" name="babyMidwifeSig" rows="9" cols="30" style="width:60%; height: 50%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Midwife1']; ?>" ></input>
                </td>
                <td></td>
              </tr>
            </td>
          </tr>
          </tbody>
        </table>

    </table>
</div>

  <br>
        <div id="page-wrap">
          <br>
            <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Update">Update</button>&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;
              <img src="images/return.png" alt="" width = "40" height ="40"><a href="Postnatal.php" style="float:middle;" class="">Return</a>
              <label for="" style="float: right; width:20%; height: 20%; font-size: 16px; color: forestgreen;"><strong>STEP 1/1</strong></label>
            </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
