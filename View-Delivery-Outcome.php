<?php
session_start();
//including file which contains all the methods
require_once('class.php');
//creating instance of the class
$DeliveryOutcome = new Methods();
if (isset($_POST['btn-Update'])) {
  //calling update delivery outcome method from the class
    $DeliveryOutcome->Update_Delivery_Outcome();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Delivery Outcome</title>
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
  <form class="" action="View-Delivery-Outcome.php" method="post">

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
          <strong>Update Successful</strong>
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
              <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">DECISIONS MADE ON BIRTH PREPAREDNESS</h3></center></th>
            </tr>
            <tr>
              <th><label for="" class="control-label col-xs-2" style="font-size: 18px; padding:10px; ">Date Recorded:</label><label for="" class="control-label col-xs-2" style="font-size: 18px; color: red;  padding:10px;"><?php echo   $_SESSION['dateTaken']; ?></label></th>
            </tr>
          </thead>
          <table  width="180%"height="200" cellspacing="20" cellpadding="20">
            <thead>
              <tr>
              <th></th>

            </tr>
            </thead>
            <!-- menstration form -->
            <tbody>
                  <tr>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">Where has she planned to deliver her baby: </label><input id="bordershadow"type="text" class="col-xs-4" name="PlaceOfDelivery" value="<?php echo   $_SESSION['deliveryPlace']; ?>" style="width:45%; height: 40%; font-size: 16px; color:#8b008b;">
                    </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">If she needs an emergency operation, who should be contacted to support her:</label><input id="bordershadow" type="text" name="EmergencyOperation" style="width:35%; height: 40%; font-size: 16px; color:#8b008b;" value="<?php echo   $_SESSION['emergencyOperation']; ?>"></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">If she needs blood, who should be contacted:</label><input id="bordershadow" type="text" name="BloodContact" style="width:20%; height: 40%; font-size: 16px; color:#8b008b;" value="<?php echo   $_SESSION['emergencyBlood']; ?>"></td>
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
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">SUMMARY OF LABOUR / DELIVERY OUTCOME
            <br><br>MOTHER</h3></center></th>
          </tr>
        </thead>
        <table width="180%"height="200" cellspacing="40" cellpadding="40">
          <thead>
            <tr>
            <th></th>
            <th></th>
          </tr>
          </thead>
          <!-- form on grand multiparity -->
          <tbody>
                <tr>
                  <td><label for="" class="control-label col-xs-3" style="font-size: 19px;">Date of Delivery:</label><input id="bordershadow"type="date" name="deliveryDate" style="width:35%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo   $_SESSION['deliveryDate']; ?>">
                  </td>
                  <td><label for="" class="control-label col-xs-6" style="font-size: 19px;">Place of Delivery:</label><select class="" id="bordershadow" name="deliveryPlace" style="width:35%; height: 60%; font-size: 16px; color:#8b008b;">
                    <option value="<?php echo$_SESSION['PlaceOfDelivery']; ?>"><?php echo$_SESSION['PlaceOfDelivery']; ?></option>
                    <option value="Home">Home</option>
                    <option value="HealthFacility">Health Facility</option>
                  </select></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">If Home delivery who attended delivery: </label><select class="" id="bordershadow" name="ifHome" style="width:35%; height: 60%; font-size: 16px; color:#8b008b;">
                    <option value="<?php echo $_SESSION['ifHomeDelivery'];?>" ><?php echo $_SESSION['ifHomeDelivery'];?></option>
                    <option value="TBA/Relation">TBA / Relation</option>
                    <option value="Midwife">Midwife</option>
                  </select></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td><br></td>
                </tr>
                <tr>
                  <td style="color:red;"><label for="" class="control-label col-xs-5 " style="font-size: 20px;">If Health facility </label></td>
                  <td></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Name of Facility: </label>
                    <input type="text" name="FacilityName" value="<?php echo $_SESSION['ifFacilityDelivery'];?>" id="bordershadow" class="col-xs-3" style="width:45%; height:60%; font-size: 16px; color:#8b008b;" >
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td colspan="2">  <label for="" class="control-label col-xs-2" style="font-size: 18px;">Type of Labour</label>
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;">Spont:</label><input type="text" name="labourSpont"  id="bordershadow" class="col-xs-2" style="width:15%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['labourSpont'];?>">
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;">Induced:</label><input type="text" name="labourInduced" id="bordershadow" class="col-xs-2" style="width:15%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['labourInduced'];?>">
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;">Augmented:</label><input type="text" name="labourAugmented" id="bordershadow" class="col-xs-2" style="width:15%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['labourAugmented'];?>" >
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-4" style="font-size: 19px;">Date of Delivery:</label><input type="date" name="DeliveryDate2" id="bordershadow" class="col-xs-5" style="width:25%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['deliveryDate'];?>" ></td>
                  <td>
                    <label for="" class="control-label col-xs-2" style="font-size: 19px;">Time:</label><input type="Time" name="DeliveryTime" id="bordershadow" class="col-xs-2" style="width:35%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['deliveryTime'];?>">
                  </td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-4" style="font-size: 19px;">Duration of Labour:</label><input type="text" name="labourDuration" id="bordershadow" class="col-xs-5" style="width:25%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['durationLabour'];?>" ></td>
                  <td>
                    <label for="" class="control-label col-xs-6" style="font-size: 19px;">Mode of Delivery:</label>  <select class="col-xs-6" id="bordershadow" name="DeliveryMode" class="" style="width:30%; height: 65%; font-size: 16px; color:#8b008b;" >
                        <option value="<?php echo $_SESSION['modeDelivery'];?>"><?php echo $_SESSION['modeDelivery'];?></option>
                        <option value="SVD">SVD</option>
                        <option value="C/S">C/S</option>
                        <option value="AVD">AVD</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 19px;">If C/S delivery, indication:</label><input type="text" name="ifCS" id="bordershadow" class="col-xs-4" style="width:25%; height:60%; font-size: 16px; color:#8b008b; " value="<?php echo $_SESSION['deliveryComplication'];?>" ></td>
                  <td></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-7" style="font-size: 19px;">Labour and deliver complications(Specify):</label><textarea id="bordershadow" name="labourComplication" rows="9" cols="30" style="width:40%; height: 60%; font-size: 16px; color:#8b008b;"><?php echo $_SESSION['labourComplication'];?></textarea>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-3 " style="font-size: 18px;">Date of Discharge: </label><input type="date" name="dischargeDate"id="bordershadow" class="col-xs-3" style="width:25%; height:60%; font-size: 16px; color:#8b008b; " value="<?php echo $_SESSION['DateDischarge'];?>"></td>
                  <td></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td colspan="2"><label for="" class="control-label col-xs-3" style="font-size: 18px;">Condition at Discharge:</label>
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;">BP: </label><input type="text" name="conditionBP"id="bordershadow" class="col-xs-1" style="width:10%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['conditionBp'];?>">
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;">Pulse:</label><input type="number" name="conditionPulse"id="bordershadow" class="col-xs-3" style="width:10%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['conditionPulse'];?>">
                      <label for="" class="control-label col-xs-1" style="font-size: 18px;">Perineum:</label><input type="text" name="conditionPerineum"id="bordershadow" class="col-xs-3" style="width:10%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['conditionPremium'];?>" >
                  <label for="" class="control-label col-xs-1" style="font-size: 18px;">Locia:</label><input type="text" name="conditionlocia"id="bordershadow" class="col-xs-3" style="width:10%; height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['conditionLochia'];?>"  >
                </td>
                  <td></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                    <td>
                      <label for="" class="control-label col-xs-4" style="font-size: 19px;">Lactation Established:</label>  <select class="col-xs-6" id="bordershadow" name="lactation" class="" style="width:20%; height: 65%; font-size: 16px; color:#8b008b;" >
                          <option value="<?php echo $_SESSION['lactation'];?>"><?php echo $_SESSION['lactation'];?></option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <td></td>
                    </td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td>
                      <label for="" class="control-label col-xs-5" style="font-size: 18px;">Signature of Midwife/Doctor:</label>
                      <input type="text" name="labourSignature"id="bordershadow" class="col-xs-3" style="width:40%; height:60%; font-size: 16px; color:#8b008b;"  value="<?php echo $_SESSION['midWife'];?>" >
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td>
                      <label for="" class="control-label col-xs-3" style="font-size: 18px;">Date of next visit:</label>
                      <input type="date" name="nextVisitDate"id="bordershadow" class="col-xs-3" style="width:25%; height:60%; font-size: 16px; color:#8b008b;"  value="<?php echo $_SESSION['DateOfNextVisit'];?>" >
                  </td>
                  <td></td>
                </tr>
          </tbody>
        </table>

    </table>
</div>
<br><br>
<!--Labour / delivery outcome for the baby -->
  <div id="page-wrap">
    <table  width="180%" height="200" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">BABY</h3></center></th>
          </tr>
        </thead>
        <tbody>
          <!--second table hold the data  -->
          <table width="90%"height="100" cellspacing="40" cellpadding="40">
            <thead>
              <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">Sex</label><select class="col-xs-4" id="bordershadow" name="babySex" class="" style="width:65%; height: 70%; font-size: 16px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['babySex'];?>"><?php echo $_SESSION['babySex'];?></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select></td>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">Birth Weight</label><input type="text" name="babyWeight" id="bordershadow" class="col-xs-3" style="width:30%; height:50%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['birthWeight'];?>">&nbsp;<strong>Kg</strong>
                    </td>
                    <td>
                      <label for="" class="control-label col-xs-3" style="font-size: 18px;">Apgar Score:</label><label for="" class="control-label col-xs-2" style="font-size: 18px;">1min</label><input type="text" name="oneMin"  id="bordershadow" class="col-xs-3" style="width:20%; height:50%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['oneMinute'];?>" >
                      <label for="" class="control-label col-xs-2" style="font-size: 18px;">5min</label><input type="text" name="fiveMins" id="bordershadow" class="col-xs-3" style="width:20%; height:50%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['fiveMinute'];?>" >
                    </td>
                </tr>
                <tr>
                  <td colspan="3"><label for="" class="control-label col-xs-3" style="font-size: 19px;">Congenital Abnormalities:</label><textarea id="bordershadow" name="babyCongenital" rows="9" cols="30" style="width:50%; height: 60%; font-size: 16px; color:#8b008b;"><?php echo $_SESSION['congenitalAbnormalies'];?></textarea>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3"><label for="" class="control-label col-xs-3" style="font-size: 18px;">Condition of Child: </label><select class="col-xs-3" id="bordershadow" name="babyAliveOrDead" class="" style="width:20%; height: 70%; font-size: 18px; 18px; color:#8b008b;" >
                    <option value="<?php echo $_SESSION['babyDeadorAlive'];?>"><?php echo $_SESSION['babyDeadorAlive'];?></option>
                    <option value="Live Birth">LIVE BIRTH</option>
                    <option value="Still Birth">STILL BIRTH</option>
                    <option value="Premature">PREMATURE BIRTH</option>
                    <option value="Multiple Pregnancy Loss">MULTIPLE PREGNANCY LOSS</option>
                  </select></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3"><label for="" class="control-label col-xs-3" style="font-size: 18px;">Condition at Discharge: </label><select class="col-xs-3" id="bordershadow" name="babyCondition" class="" style="width:20%; height: 70%; font-size: 18px; color:#8b008b;" >
                    <option value="<?php echo $_SESSION['babyConditionDischarge'];?>"><?php echo $_SESSION['babyConditionDischarge'];?></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">Discharging Eyes: </label><select class="col-xs-3" id="bordershadow" name="babyDischarging" class="" style="width:20%; height: 70%; font-size: 18px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['babyConditionEyes'];?>"><?php echo $_SESSION['babyConditionEyes'];?></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">Jaundice: </label><select class="col-xs-3" id="bordershadow" name="babyJaundice" class="" style="width:20%; height: 70%; font-size: 18px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['babyJaundice'];?>"><?php echo $_SESSION['babyJaundice'];?></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">Meconium: </label><select class="col-xs-3" id="bordershadow" name="meconium" class="" style="width:20%; height: 70%; font-size: 18px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['babyMeconium'];?>"><?php echo $_SESSION['babyMeconium'];?></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">Suckling Established: </label><select class="col-xs-3" id="bordershadow" name="sucklingEstablished" class="" style="width:20%; height: 70%; font-size: 18px; color:#8b008b;" >
                      <option value="<?php echo $_SESSION['SucklingBaby'];?>"><?php echo $_SESSION['SucklingBaby'];?></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                  <td></td>
                  <td></td>
                </tr>
            </tbody>

          </table>

        </tbody>

        </table>
        </table>
  </div>
  <br><br>
  <!-- Breastfeeding history -->
  <br>
        <div id="page-wrap">
          <br>
            <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Update">Update Record</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
