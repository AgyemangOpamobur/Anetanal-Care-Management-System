<?php
session_start();
require_once('class.php');
$update = new Methods();
if (isset($_POST['btn-Update'])) {
    $update->Physical_Examination_Update();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Examination History</title>
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
  <form class="" action="View-Examination-history.php" method="post">

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
          <strong>Updated Successful</strong>
        </div>
        <?php
        //header("location:  View-Examination-history.php");
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
      <table  width="180%" height="200%" cellspacing="20" cellpadding="20">
          <thead>
            <tr>
              <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">PHYSICAL EXAMINATION AT FIRST VISIT</h3></center></th>
            </tr>
          </thead>
          <table  width="180%"height="300" cellspacing="20" cellpadding="20">
            <thead>
              <tr>
              <th><label for="" class="control-label col-xs-6" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-6" style="font-size: 18px; color: red;"><?php echo $_SESSION['PhysicalDate']; ?></label></th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <!-- menstration form -->
            <tbody>
                  <tr>
                    <td><label for="" class="control-label col-xs-3"style="font-size: 18px;">HEIGHT</label><input id="bordershadow"style="width:35%; height: 65%; font-size: 16px; color:#8b008b;" type="text" name="height" value="<?php echo $_SESSION['Height']; ?>" class=" "></td>
                    <td><label for="" class="control-label col-xs-3" style="font-size: 18px;">WEIGHT</label><input id="bordershadow"type="text" name="weight" value="<?php echo $_SESSION['Weight']; ?>" style="width:25%; height: 65%; font-size: 16px; color:#8b008b;" ></td>

                    <td><label for="" class="control-label col-xs-3" style="font-size: 18px;">BP</label><input id="bordershadow" type="text" name="bp" style="width:40%; height: 65%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['BP']; ?>"></td>
                  </tr>
                  <tr>

                    <td><label for="" class="control-label col-xs-3" style="font-size: 18px;">PULSE</label><input id="bordershadow" type="text" name="pulse" style="width:35%; height: 65%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Pulse']; ?>"></td>
                    <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">TEMPERATURE</label><input id="bordershadow" type="text" name="temperature" style="width:20%; height: 65%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Temperature'];?>"></td>
                    <td></td>
                  </tr>
                  <tr>
                      <td colspan="2"><label for="" class="control-label col-xs-2" style="font-size: 18px;">GENERAL</label><input id="bordershadow" type="text" name="general" style="width:70%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['GeneralObservation'];?>"></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                    <td colspan="2"><label for="" class="control-label col-xs-2" style="font-size: 18px;">FACE / EYES</label><input id="bordershadow" type="text" name="face" style="width:70%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['FaceOrEye'];?>"></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="2"><label for="" class="control-label col-xs-2" style="font-size: 18px;">NECK</label><input id="bordershadow" type="text" name="neck" style="width:70%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Neck'];?>"></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="2"><label for="" class="control-label col-xs-2" style="font-size: 18px;">BREASTS</label><input id="bordershadow" type="text" name="breast" style="width:70%; height: 60%; font-size: 16px; color:#8b008b;"  value="<?php echo $_SESSION['Breast'];?>"></td>
                    <td></td>
                    <td></td>
                  </tr>
            </tbody>
          </table>

      </table>
  </div>
<br><br>
  <div id="page-wrap">
    <table width="100%" height="300" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">ABDOMINAL / OBSTETRIC EXAMINATION</h3></center></th>
          </tr>
        </thead>
        <table width="150%"height="300%" cellspacing="40" cellpadding="40" >
          <thead>
            <tr>
            <th><label for="" class="control-label col-xs-2" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-2" style="font-size: 18px; color: red;"><?php echo $_SESSION['DateTaken']; ?></label></th>
          </tr>
          </thead>

          <tbody>
                <tr>
                  <td><label for="" class="control-label col-xs-2" style="font-size: 18px;">SPLEEN</label><input id="bordershadow" type="text" name="spleen" style="width:50%; height: 60%; font-size: 16px; color:#8b008b;"  value="<?php echo $_SESSION['Spleen'];?>"></td>
                </tr>
                <td colspan="2"><label for="" class="control-label col-xs-2" style="font-size: 18px;">LIVER</label><input id="bordershadow" type="text" name="liver" style="width:60%; height: 60%; font-size: 16px; color:#8b008b;"  value="<?php echo $_SESSION['Liver'];?>"></td>
              </tbody>
            </table>
            <table width="150%"height="90" >
                <tr>
                  <td><label for="" class="control-label col-xs-4" style="font-size: 18px;">OTHER MASSESS </label>
                    <select class="" id="bordershadow" name="other_masses" style="width:25%; height: 40%; font-size: 16px; color:#8b008b;">
                      <option value="<?php echo $_SESSION['OtherMasses'];?>"><?php echo $_SESSION['OtherMasses'];?></option>
                      <option value="Yes">YES</option>
                      <option value="No">NO</option>
                      </select>
                    <td><label for="" class="control-label col-xs-3" style="font-size: 18px;">SCARS </label>
                      <select class="" id="bordershadow" name="scars" style="width:25%; height: 40%; font-size: 16px; color:#8b008b;">
                        <option value="<?php echo $_SESSION['Scars'];?>"><?php echo $_SESSION['Scars'];?></option>
                        <option value="Yes">YES</option>
                        <option value="No">NO</option>
                      </select>
                </tr>

          </tbody>
        </table>

    </table>
</div>
<br><br>
<!-- Obstetric history -->
  <div id="page-wrap">
    <table  width="180%" height="300%" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">PELVIC EXAMINATION</h3></center></th>
          </tr>
        </thead>
        <tbody>
          <!--second table hold the data  -->
          <table width="90%"height="100" cellspacing="40" cellpadding="40" >
            <thead>
              <tr>
                  <th><label for="" class="control-label col-xs-5" style="font-size: 18px;">Date Recorded:</label><label for="" class="control-label col-xs-6" style="font-size: 18px; color: red;"><?php echo $_SESSION['DatePelvic']; ?></label></th>
                  <th></th>
                  <th></th>
                  <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="" class="control-label col-xs-3 " style="font-size: 18px;">VULVA: </label><label for="" class="control-label col-xs-4 " style="font-size: 18px;">ULCER </label><input type="text" name="ulcer"id="bordershadow" class="col-xs-5"  style="height:60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Ulcer']; ?>"></td>
                    <td><label for="" class="control-label col-xs-6 " style="font-size: 18px;">RASHES</label><input type="text" name="rashes" value="<?php echo $_SESSION['Rashes']; ?>" id="bordershadow" class="col-xs-6" style="height:60%; font-size: 16px; color:#8b008b;"></td>
                    <td><label for="" class="control-label col-xs-6 " style="font-size: 18px;">WARTS</label>
                      <input type="text" name="warts" value="<?php echo $_SESSION['Warts'];?>" id="bordershadow" class="col-xs-6" style="height:60%; font-size: 16px; color:#8b008b;">
                    </td>
                    <td><label for="" class="control-label col-xs-6 " style="font-size: 18px;">PERINEUM</label>
                      <input type="text" name="perineum" value="<?php echo $_SESSION['Discharge'];?>" id="bordershadow" class="col-xs-6" style="height:60%; font-size: 16px; color:#8b008b;">
                    <td>
                </tr>
            </tbody>

          </table>
          <table  width="180%" height="200" cellspacing="40" cellpadding="40">
              <thead>
                <tr>
                  <th></th>
                </tr>
              </thead>
              <!-- populating the content of pregnancy table  -->
              <tbody>
                <table width="100%" height="200%" cellspacing="20" cellpadding="20">
                  <thead>
                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                  </thead>
                    <tbody>
                          <tr>
                            <td><label for="" class="control-label col-xs-8 " style="font-size: 18px;">VAGINA (IF NECESSARY):</label></td>

                            <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">DISCHARGE</label><input type="text" id="bordershadow" name="discharge" value="<?php echo $_SESSION['Discharge'];?>" class="col-xs-3" style="width:35%; height: 60%; font-size: 16px; color:#8b008b;">
                            </td>
                            <td>
                              <label for="" class="control-label col-xs-6 " style="font-size: 18px;">POSITION AND SIZE OF UTERUS</label><input id="bordershadow" type="text" name="Position_Uterus" value="<?php echo $_SESSION['PositionOfUterus'];?>" class="col-xs-4" style="width:40%; height: 60%; font-size: 16px; color:#8b008b;">
                            </td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>
                              <label for="" class="control-label col-xs-4 " style="font-size: 18px;">CERVIX</label><input id="bordershadow" type="text" name="cervix" style="width:40%; height: 60%; font-size: 16px; color:#8b008b;" class="col-xs-4" value="<?php echo $_SESSION['Cervix'];?>">
                            </td>
                            <td>
                              <label for="" class="control-label col-xs-3 " style="font-size: 18px;">ADNEXAE</label>
                                <input id="bordershadow" type="text" name="Adnexae" style="width:40%; height: 60%; font-size: 16px; color:#8b008b;" class="col-xs-4" value="<?php echo $_SESSION['Adnexae'];?>">
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"><label for="" class="control-label col-xs-1" style="font-size: 18px;">GAIT</label><input id="bordershadow" type="text" name="gait" style="width:60%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Gait'];?>"></td>
                          </tr>
                          <tr>
                            <td colspan="3"><label for="" class="control-label col-xs-1" style="font-size: 18px;">C.N.S.</label><input id="bordershadow" value="<?php echo $_SESSION['Gait'];?>" type="text" name="CNS" style="width:60%; height: 60%; font-size: 16px; color:#8b008b;" ></td>
                          </tr>
                          <tr>
                            <td colspan="3"><label for="" class="control-label col-xs-1" style="font-size: 18px;">HEART</label><input id="bordershadow" type="text" name="heart" style="width:60%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Heart'];?>"></td>
                          </tr>
                          <tr>
                            <td colspan="3"><label for="" class="control-label col-xs-1" style="font-size: 18px;">LUNGS</label><input id="bordershadow" type="text" name="lungs" style="width:60%; height: 60%; font-size: 16px; color:#8b008b;" value="<?php echo $_SESSION['Lungs'];?>"></td>
                          </tr>
                    </tbody>
                  </table>
              </tbody>
            </table>
        </tbody>

        </table>
  </div>
  <br>
  <!-- Breastfeeding history -->
    <br>
        <div id="page-wrap">
          <br>
            <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Update">Update Record</button>&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;
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
