<?php
session_start();
require_once('class.php');
$Update = new Methods();

//getting patient id
$search = $_SESSION['patID'];
$getID = explode("C", $search);
$actualId = $getID[1];
$Update->GetAntenatalHistoryRecords2($actualId);
//include 'View-Antenatal-Method2.php';

//this method update antenatal history records in the database
if (isset($_POST['btn-Update'])) {
    $Update->Antenatal_History_Update2();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Antenatal History</title>
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
  <form class="" action="View-History2.php" method="post">

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
          <strong>Update Sucessful</strong>
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
              <th  >
                <td><?php  echo "<h4>DATE:</h4><h4 style=\"color: crimson;\"> ".date("d-M-Y")."</h4>"; ?> </td>
              </th>

          </a>
        </tr>
      </table>
    </center>
  </div>
    </p>

    <div id="page-wrap">
      <table  width="180%" height="100%" cellspacing="20" cellpadding="20">
          <thead>
            <tr>
              <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">MEDICAL AND SURGICAL HISTORY</h3></center></th>
            </tr>
          </thead>
          <table width="150%"height="450" cellspacing="20" cellpadding="20">
            <thead>
              <tr>
              <th><label for="" class="control-label col-xs-6" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-6" style="font-size: 18px; color: red;"><?php echo $_SESSION['MedicalDate']; ?></label></th>
              <th></th>
            </tr>
            </thead>
            <!-- menstration form -->
            <tbody>
                  <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">HYPERTENSION </label>
                      <select class="" id="bordershadow" name="hypertension" style="width:20%; height: 45%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['Hypertension'];?>"><?php echo $_SESSION['Hypertension'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">HEART DISEASE </label>
                      <select class="" id="bordershadow" name="heart_disease" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['HeartDisease'];?>"><?php echo $_SESSION['HeartDisease'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">SICKLE CELL DISEASE </label>
                      <select class="" id="bordershadow" name="Medical_sickle_disease" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;" required>
                        <option value="<?php echo $_SESSION['MedicalSickleCell'];?>"><?php echo $_SESSION['MedicalSickleCell'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">DIABETES </label>
                      <select class="" id="bordershadow" name="diabetes" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['Diabetes'];?>"><?php echo $_SESSION['Diabetes'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">JAUNDICE </label>
                      <select class="" id="bordershadow" name="jaundice" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['Jaundice'];?>"><?php echo $_SESSION['Jaundice'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">RESPIRATORY DISEASE </label>
                      <select class="" id="bordershadow" name="Respiratory_disease" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;" >
                        <option value="<?php echo $_SESSION['RespiratoryDisease'];?>"><?php echo $_SESSION['RespiratoryDisease'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">TB, CHRONIC COUGH, ASTHMA </label>
                      <select class="" id="bordershadow" name="TB_Chronic" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['TBAsthmaChronic'];?>"><?php echo $_SESSION['TBAsthmaChronic'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">HIV DISEASE </label>
                      <select class="" id="bordershadow" name="Hiv_disease" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['HIVDisease'];?>"><?php echo $_SESSION['HIVDisease'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">EPILEPSY </label>
                      <select class="" id="bordershadow" name="Epilepsy" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;" >
                        <option value="<?php echo $_SESSION['Epilepsy'];?>"><?php echo $_SESSION['Epilepsy'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">MENTAL ILLNESS </label>
                      <select class="" id="bordershadow" name="Mental_illness" style="width:20%; height: 50%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['MentalIllness'];?>"><?php echo $_SESSION['MentalIllness'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label for="" class="control-label col-xs-5" style="font-size: 18px;">OTHER(SPECIFY)</label><textarea name="Other2" rows="5" cols="30" id="bordershadow" style="width:35%; height: 60%; font-size: 16px; color: #8b008b;"><?php echo @$_SESSION['Other'];?></textarea>
                    </td>

                    <td>
                        <label for="" class="control-label col-xs-5" style="font-size: 18px;">PREVIOUS OPERATION(SPECIFY)</label><textarea name="Previous_Operation" rows="5" cols="30" id="bordershadow" style="width:35%; height: 60%; font-size: 16px; color: #8b008b;"><?php echo $_SESSION['PreviousOperation'];?></textarea>
                    </td>

                  </tr>
            </tbody>
          </table>
      </table>
  </div>
<br><br>
  <div id="page-wrap">
    <table width="100%" height="100%" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">FAMILY HISTORY</h3></center></th>
          </tr>
        </thead>
        <table width="180%"height="320" cellspacing="30" cellpadding="30">
          <thead>
            <tr>
            <th><label for="" class="control-label col-xs-6" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-6" style="font-size: 18px; color: red;"><?php echo $_SESSION['FamilyDate']; ?></label></th>
            <th></th>
          </tr>
          </thead>
          <!-- form on family history -->
          <tbody>
                <tr>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">HYPERTENSION </label>
                    <select class="" id="bordershadow" name="Family_hypertension" style="width:25%; height: 35%; font-size: 16px; color: #8b008b;" >
                      <option value="<?php echo $_SESSION['FamilyHypertension'];?>"><?php echo $_SESSION['FamilyHypertension'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">DIABETES </label>
                    <select class="" id="bordershadow" name="Family_diabetes" style="width:20%; height: 35%; font-size: 16px; color: #8b008b;" >
                      <option value="<?php echo $_SESSION['FamilyDiabetes'];?>"><?php echo $_SESSION['FamilyDiabetes'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                   </td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">SICKLE CELL DISEASE </label>
                    <select class="" id="bordershadow" name="Sickle_disease" style="width:25%; height: 35%; font-size: 16px; color: #8b008b;" >
                      <option value="Yes">YES</option>
                      <option value="<?php echo $_SESSION['FamilySickleCell'];?>"><?php echo $_SESSION['FamilySickleCell'];?></option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-5" style="font-size: 18px;">MULTIPLE PREGNANCIES </label>
                    <select class="" id="bordershadow" name="Multiple_pregnancies" style="width:20%; height: 35%; font-size: 16px; color: #8b008b;">
                      <option value="<?php echo $_SESSION['MultiplePregnancy'];?>"><?php echo $_SESSION['MultiplePregnancy'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">MENTAL HEALTH </label>
                    <select class="" id="bordershadow" name="Family_Mental_health" style="width:25%; height: 35%; font-size: 16px; color: #8b008b;">
                      <option value="<?php echo $_SESSION['MentalHealth'];?>"><?php echo $_SESSION['MentalHealth'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-5" style="font-size: 18px;">BIRTH DEFECTS(SPECIFY)</label>
                      <select class="" id="bordershadow" name="Birth_defects" style="width:20%; height: 35%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['BirthDeffect'];?>"><?php echo $_SESSION['BirthDeffect'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">HEART DISEASE </label>
                    <select class="" id="bordershadow" name="Heart_disease" style="width:25%; height: 35%; font-size: 16px;  color: #8b008b;">
                      <option value="<?php echo $_SESSION['FamilyHeartDisease'];?>"><?php echo $_SESSION['FamilyHeartDisease'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select></td>
                  <td></td>
                </tr>
          </tbody>
        </table>

    </table>
</div>
<br><br>
<!-- Drug history -->
  <div id="page-wrap">
    <table width="100%" height="100%" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">DRUG HISTORY</h3></center></th>
          </tr>
        </thead>
        <table width="100%"height="200" cellspacing="10" cellpadding="10">
          <thead>
            <tr>
            <th><label for="" class="control-label col-xs-3" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-3" style="font-size: 18px; color: red;"><?php echo $_SESSION['DrugDate'];?></label></th>
          </tr>
          </thead>
          <!-- form on drug history -->
          <tbody>
                <tr>
                  <td>
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">IF YES(SPECIFY)</label>
                    <textarea name="Drug_history_text" rows="5" cols="30" id="bordershadow" style="width:40%; height: 60%; font-size: 16px; color: #8b008b;"><?php echo $_SESSION['DetailsOfDrug'];?></textarea>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;"></label>
                    <select class="" id="bordershadow" name="Drug_history_selection" style="width:40%; height: 25%; font-size: 16px; color: #8b008b;">
                    <option value="<?php echo $_SESSION['DrugUsage'];?>"><?php echo $_SESSION['DrugUsage'];?></option>
                    <option value="Yes">YES</option>
                    <option value="No">NO</option>
                  </select>
                  </td>
                </tr>
          </tbody>
        </table>
    </table>
  </div>
  <br><br>
  <!-- Allergies history -->
  <div id="page-wrap">
    <table width="100%" height="100%" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">ALLERGIES(DRUG / FOOD)</h3></center></th>
          </tr>
        </thead>
        <table width="100%"height="200" cellspacing="10" cellpadding="10">
          <thead>
            <tr>
            <th><label for="" class="control-label col-xs-3" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-3" style="font-size: 18px; color: red;"><?php echo $_SESSION['DrugDate'];?></label></th>
          </tr>
          </thead>
          <!-- form on Allergy history -->
          <tbody>
                <tr>
                  <td>
                    <label for="" class="control-label col-xs-3" style="font-size: 18px;">IF YES(SPECIFY)</label>
                    <textarea name="Allergies_text" rows="5" cols="30" id="bordershadow" style="width:40%; height: 60%; font-size: 16px; color: #8b008b;"><?php echo $_SESSION['DetailsOfAllergy'];?></textarea>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-1" style="font-size: 18px;"></label>
                    <select class="" id="bordershadow" name="Allergies_history" style="width:40%; height: 25%; font-size: 16px; color: #8b008b;" >
                    <option value="<?php echo $_SESSION['PresenceOfAllergy'];?>"><?php echo $_SESSION['PresenceOfAllergy'];?></option>
                    <option value="Yes">YES</option>
                    <option value="No">NO</option>
                  </select>
                  </td>
                </tr>
          </tbody>
        </table>
    </table>
  </div>
  <br><br>
  <!-- contraceptive  history -->
  <div id="page-wrap">
    <table  width="180%" height="100%" cellspacing="60" cellpadding="60">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">CONTRACEPTIVE HISTORY</h3></center></th>
          </tr>
        </thead>
        <tbody>
              <table width="120%" height="200" cellspacing="40" cellpadding="40">
                <thead>
                  <tr>
                    <th><label for="" class="control-label col-xs-3" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-3" style="font-size: 18px; color: red;"><?php echo $_SESSION['ContraceptiveDate'];?></label></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                        <tr>
                          <td>
                            <label for="" class="control-label col-xs-8 " style="font-size: 18px;">CONTRACEPTIVE(S) USED PRIOR TO PREGNANCY</label>
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>
                            <label for="" class="control-label col-xs-3" style="font-size: 18px;">IF YES, SPECIFY TYPE(S)</label>
                            <textarea name="Contraceptive_text" rows="5" cols="30" id="bordershadow" style="width:40%; height: 60%; font-size: 16px; color: #8b008b;"><?php echo $_SESSION['NameOfContraceptive'];?></textarea>
                          </td>
                          <td>
                            <label for="" class="control-label col-xs-1" style="font-size: 18px;"></label>
                            <select class="" id="bordershadow" name="Contraceptive_selection" style="width:40%; height: 25%; font-size: 16px; color: #8b008b;" >
                            <option value="<?php echo $_SESSION['AnyContraceptivePregnancy'];?>"><?php echo $_SESSION['AnyContraceptivePregnancy'];?></option>
                            <option value="Yes">YES</option>
                            <option value="No">NO</option>
                          </select>
                        </tr>
                        <tr>
                            <td>
                              <label for="" class="control-label col-xs-4" style="font-size: 18px;">DATE DISCONTINUED</label><input id="bordershadow"type="date" name="Contraceptive_Discontinue_date" value="<?php echo $_SESSION['DateDiscontinued'];?>" style="width:20%; height: 70%; font-size: 16px; color: #8b008b;">
                            </td>
                            <td></td>
                        </tr>
                </tbody>
              </table>
        </tbody>
  </div>
  <br><br>
  <!-- history of sexually transmitted infections -->
  <div id="page-wrap">
    <table width="100%" height="100%" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">HISTORY OF SEXUALLY TRANSMITTED INFECTIONS</h3></center></th>
          </tr>
        </thead>
        <table width="180%"height="280" cellspacing="60" cellpadding="60">
          <thead>
            <tr>
            <th><label for="" class="control-label col-xs-3" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-4" style="font-size: 18px; color: red;"><?php echo $_SESSION['StiDate'];?></label></th>
            <th></th>
          </tr>
          </thead>
          <!-- form on family history -->
          <tbody>
                <tr>
                  <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">CHRONIC LOWER ABDOMINAL PAIN </label>
                    <select class="" id="bordershadow" name="Chronic_pain" style="width:25%; height: 35%; font-size: 16px; color: #8b008b;">
                      <option value="<?php echo $_SESSION['LowerAbdomenPain'];?>"><?php echo $_SESSION['LowerAbdomenPain'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                  <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">ITCHING / BURNING SENSATION / SWELLING OF THE GENITALS</label>
                    <select class="" id="bordershadow" name="Itching_pain" style="width:20%; height: 35%; font-size: 16px; color: #8b008b;" >
                      <option value="<?php echo $_SESSION['BurningSensation'];?>"><?php echo $_SESSION['BurningSensation'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">ABNORMAL VAGINAL / URETHRAL DISCHARGE</label>
                    <select class="" id="bordershadow" name="Abnormal_pain" style="width:25%; height: 35%; font-size: 16px; color: #8b008b;" >
                      <option value="<?php echo $_SESSION['UrethralDischarge'];?>"><?php echo $_SESSION['UrethralDischarge'];?></option>                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-6" style="font-size: 18px;">GENITAL SORES </label>
                    <select class="" id="bordershadow" name="Genital_sores" style="width:20%; height: 35%; font-size: 16px; color: #8b008b;">
                      <option value="<?php echo $_SESSION['GenitalSores'];?>"><?php echo $_SESSION['GenitalSores'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">PAINFUL URINATION </label>
                    <select class="" id="bordershadow" name="Urinal_pain" style="width:25%; height: 35%; font-size: 16px; color: #8b008b;">
                      <option value="<?php echo $_SESSION['PainfulUrination'];?>"><?php echo $_SESSION['PainfulUrination'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                    </select>
                  </td>
                  <td>
                    <label for="" class="control-label col-xs-6" style="font-size: 18px;">GENITAL LUMPS / GROWTH(wart)</label>
                      <select class="" id="bordershadow" name="Genital_pain" style="width:20%; height: 35%; font-size: 16px; color: #8b008b;">
                        <option value="<?php echo $_SESSION['LumpsGrowth'];?>"><?php echo $_SESSION['LumpsGrowth'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                  </td>
                </tr>
          </tbody>
        </table>

    </table>
</div>
  <br>
        <div id="page-wrap">
          <br>
            <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Update">Update Record</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="View-History1.php" style="float:middle;" class="btn btn-large">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
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
