<?php
session_start();
require_once('class.php');
$history = new Methods();
if (isset($_POST['btn-Save'])) {
    $history->Antenatal_History();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Antenatal History</title>
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
  <form class="" action="History.php" method="post">

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
              <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">MENSTRUAL HISTORY</h3></center></th>
            </tr>
          </thead>
          <table  width="180%"height="200" cellspacing="20" cellpadding="20">
            <thead>
              <tr>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <!-- menstration form -->
            <tbody>
                  <tr>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">DURATION OF MENSES</label><input id="bordershadow"type="text" name="Duration_menses" value="" style="width:25%; height: 40%; font-size: 16px;" required>&nbsp;&nbsp;<strong>DAYS</strong></td>
                    <td><label for="" class="control-label col-xs-6"style="font-size: 18px;">NUMBER OF DAYS BETWEEN MENSES</label><input id="bordershadow"style="width:35%; height: 40%; font-size: 16px;" type="text" name="Days_Between_Mens" value="" class=" " required>&nbsp;&nbsp;<strong>DAYS</strong></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">LAST MENSTRAL PERIOD</label><input id="bordershadow" type="date" name="Last_Mens_Period" style="width:35%; height: 40%; font-size: 16px;" required></td>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">EXPECTED DATE OF DELIVERY</label><input id="bordershadow" type="date" name="Expected_Date" style="width:35%; height: 40%; font-size: 16px;"></td>
                  </tr>
                  <tr>
                    <td><label for="" class="control-label col-xs-6" style="font-size: 18px;">NUMBER OF WEEKS OF PREGNANCY AT BOOKING</label><input id="bordershadow" type="text" name="Weeks_Of_Pregnancy" style="width:20%; height: 40%; font-size: 16px;" required></td>
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
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">MAJOR RISK FACTORS</h3></center></th>
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
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">GRAND MULTIPARITY</label><input id="bordershadow"type="number" name="Grand_Parity" style="width:35%; height: 60%; font-size: 16px;"></td>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">PREVIOUS C/S</label><input type="number" id="bordershadow" name="Previous_CS" style="width:35%; height: 60%; font-size: 16px;"></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">PREVIOUS PPH</label><input type="number" name="Previous_PPH" id="bordershadow" style="width:35%; height: 60%; font-size: 16px;"></td>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">MYOMECTOMY</label><input type="text" name="Myomectomy" id="bordershadow"style="width:35%; height: 60%; font-size: 16px;"></td>
                </tr>
                <tr>
                  <td><label for="" class="control-label col-xs-5" style="font-size: 18px;">SICKLE CELL DIEASES </label>
                    <select class="" id="bordershadow" name="sickle_cell" style="width:35%; height: 40%; font-size: 16px;">
                      <option value="">Choose...</option>
                      <option value="AS">AS</option>
                      <option value="SC">SC</option>
                      <option value="S-Btal">S-Btal</option>
                    </select>
                  </td>
                  <td>
                      <label for="" class="control-label col-xs-5" style="font-size: 18px;">OTHER(SPECIFY)</label><textarea name="Other" rows="5" cols="30" id="bordershadow" style="width:35%; height: 60%; font-size: 16px;"></textarea>
                  </td>
                </tr>
          </tbody>
        </table>

    </table>
</div>
<br><br>
<!-- Obstetric history -->
  <div id="page-wrap">
    <table  width="180%" height="200" cellspacing="40" cellpadding="40">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">OBSTETRIC HISTORY</h3></center></th>
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
                  <th></th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">GRAVIDA</label><input type="number" name="Gravida"id="bordershadow" class="col-xs-3" style="height:30%; font-size: 16px;"  ></td>
                    <td><label for="" class="control-label col-xs-4 " style="font-size: 18px;">PARA</label><input type="text" name="Para" value="" id="bordershadow" class="col-xs-3" style="height:30%; font-size: 16px;" required></td>
                    <td><label for="" class="control-label col-xs-6 " style="font-size: 18px;">ABORTION</label>
                      <select class="col-xs-6" id="bordershadow" name="abortion" class="" style="width:80%; height: 30%; font-size: 16px;" >
                        <option value="">Choose...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="Nill">Nill</option>
                      </select>
                    </td>
                    <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">SPONT</label>
                      <select class="" id="bordershadow" name="spont" style="width:80%; height: 30%; font-size: 16px;">
                        <option value="">Choose...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="Nill">Nill</option>
                      </select>
                    <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">INDUCED</label>
                      <select class="" id="bordershadow" name="induced" style="width:80%; height: 30%; font-size: 16px;">
                        <option value="">Choose...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="Nill">Nill</option>
                      </select>

                </tr>
            </tbody>

          </table>
          <table  width="180%" height="150" cellspacing="40" cellpadding="40">
              <thead>
                <tr>
                  <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">PAST PREGNANCIES</h3></center></th>
                </tr>
              </thead>
              <!-- populating the content of pregnancy table  -->
              <tbody>
                <table width="100%" height="100" cellspacing="20" cellpadding="20">
                  <thead>
                          <tr>
                            <th></th>
                            <th></th>
                          </tr>
                  </thead>
                    <tbody>
                          <tr>
                            <td><label for="" class="control-label col-xs-6 " style="font-size: 18px;">PLACE OF DELIVERY / PREGNANCY LOSS </label><input type="text" id="bordershadow" name="Place_OF_Delivery" value="" class="col-xs-3" style="width:35%; height: 60%; font-size: 16px;">
                            </td>
                            <td>
                              <label for="" class="control-label col-xs-6 " style="font-size: 18px;">DATE OF DELIVERY</label><input id="bordershadow" type="date" name="Delivery_Date" value="" class="col-xs-4" style="width:40%; height: 60%; font-size: 16px;">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="" class="control-label col-xs-6 " style="font-size: 18px;">PROBLEMS DURING PREGNANCY</label><textarea id="bordershadow" name="Pregnancy_Problem" rows="9" cols="30" style="width:40%; height: 50%; font-size: 16px;"></textarea>
                            </td>
                            <td>
                              <label for="" class="control-label col-xs-6 " style="font-size: 18px;">MODE OF DELIVERY</label>
                                <select class="" id="bordershadow" name="Delivery_Mode" style="width:40%; height: 20%; font-size: 16px;">
                                  <option value="">Choose...</option>
                                  <option value="SVD">SVD</option>
                                  <option value="EPIS">EPIS</option>
                                  <option value="CS">CS</option>

                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="" class="control-label col-xs-5 " style="font-size: 18px;">OUT COME OF BIRTH</label>
                                <select class="" id="bordershadow" name="birth_outcome" style="width:40%; height: 70%; font-size: 16px;">
                                  <option value="">Choose...</option>
                                  <option value="live Birth">LIVE BIRTH</option>
                                  <option value="Still Birth">STILL BIRTH</option>
                                  <option value="Premature">PREMATURE BIRTH</option>
                                  <option value="Multiple Pregnancy Loss">MULTIPLE PREGNANCY LOSS</option>
                                </select>
                            </td>
                            <td>
                              <label for="" class="control-label col-xs-3 " style="font-size: 18px;">SEX</label>
                                <select class="" id="bordershadow" name="sex" style="width:30%; height: 70%; font-size: 16px;">
                                  <option value="">Choose...</option>
                                  <option value="Male">MALE</option>
                                  <option value="Female">FEMALE</option>
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="" class="control-label col-xs-5 " style="font-size: 18px;">CONDITION OF CHILD</label>
                                <select class="" id="bordershadow" name="birth_Condition" style="width:20%; height: 70%; font-size: 16px;">
                                  <option value="">Choose...</option>
                                  <option value="live Birth">LIVE BIRTH</option>
                                  <option value="Still Birth">STILL BIRTH</option>
                                  <option value="Premature">PREMATURE BIRTH</option>
                                  <option value="Multiple Pregnancy Loss">MULTIPLE PREGNANCY LOSS</option>
                                         </select>
                            </td>
                              <td>
                                  <label for="" class="control-label col-xs-6 " style="font-size: 18px;">BIRTH WEIGHT(kg)</label><input id="bordershadow" type="text" name="Birth_Weight" value="" class="col-xs-4" style="width:20%; height: 60%; font-size: 16px;">
                              </td>
                          </tr>

                    </tbody>
                  </table>
              </tbody>
            </table>
        </tbody>
        <table width="100%" height="10">
          <thead>
            <tr>
                <th></th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td><label for="" class="control-label col-xs-5 " style="font-size: 18px;">LABOUR / POSTPARTUM COMPLICATION</label><textarea id="bordershadow" name="Labour_Complication" rows="9" cols="30" class="col-xs-1"style="width:40%; height: 50%; font-size: 16px;"></textarea></td>
              </tr>
          </tbody>
        </table>
        </table>
  </div>
  <br><br>
  <!-- Breastfeeding history -->
  <div id="page-wrap">
    <table  width="180%" height="300" cellspacing="80" cellpadding="60">
        <thead>
          <tr>
            <th><center><h3 style="color: red; background-color: lightskyblue;   padding:20px;">BREASTFEEDING HISTORY(LAST CHILD)</h3></center></th>
          </tr>
        </thead>
        <tbody>
              <table width="120%" height="60" cellspacing="40" cellpadding="40">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                        <tr>
                          <td>
                            <label for="" class="control-label col-xs-8 " style="font-size: 18px;">BREASTFEEDING FOR THE LAST CHILD</label>
                            <select class="col-xs-1" name="Last_Breastfeeding" id="bordershadow" style="width:30%; height: 50%; font-size: 16px;">
                              <option value="">Choose....</option>
                              <option value="Yes">YES</option>
                              <option value="No">NO</option>
                              </select>
                          </td>
                          <td>
                            <label for="" class="control-label col-xs-8 " style="font-size: 18px;">DURATION OF EXCLUSIVE BREASTFEEDING</label><input id="bordershadow" type="text" name="Exclusive_Feeding" value="" class="col-xs-4" style="width:20%; height: 50%; font-size: 16px;">&nbsp;<strong>Months</strong>
                          </td>
                        </tr>
                        <tr>
                          <table>
                                  <td>
                                    <label for="" class="control-label col-xs-7 " style="font-size: 18px;">DURATION OF  BREASTFEEDING</label><input type="text" id="bordershadow" name="Duration_Breastfeeding" value="" class="col-xs-2" style="width:20%; height: 20%; font-size: 16px;"> &nbsp;<strong>YEARS</strong>
                                  </td>
                          </table>
                        </tr>
                </tbody>
              </table>
        </tbody>

  </div>
  <br>
        <div id="page-wrap">
          <br>
            <center> <button class="btn btn-large btn-primary" type="submit" name="btn-Save">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="History-Form2.php" style="float:middle;" class="btn btn-large">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;
              <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a>
              <label for="" style="float: right; width:20%; height: 20%; font-size: 16px; color: forestgreen;"><strong>STEP 1/2</strong></label>
            </center>
      </div>
</div>
</form>

<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
