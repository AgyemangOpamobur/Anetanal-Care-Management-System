<?php
session_start();
require 'class.php';
$database = new connect();
$db = $database->Connectdb();
$conn = $db;

//search for patient id
    $searchIDFlag = false;
    $searchNameFlag = false;
    $fname = "";
    $sname = "";

$database = new Methods();

if (isset($_GET['update'])) {
  $userID = $_GET['update'];
   $database->Update_Attendance($userID);
}

//getting patient record through search
if (isset($_POST['search']))
{
    try {
      $searchid = @trim(strtoupper($_POST['searchid']));
      if (empty($searchid)) {
        echo "<script> alert('Please enter patient ID'); window.location.href='View-Appointment.php';</script>";
      }else {
        if ($searchid)
        {
        $getID = explode("C", $searchid);
        @$actualId = $getID[1];
        $searchIDFlag = true;
        }

      }


    } catch (Exception $e) {
      echo "<script> alert('Incorrect ID / ID is not registered'); window.location.href='View-Appointment.php';</script>";
    }

}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Appointments</title>
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
</head>
<style media="screen">

  #bordershadow{
    border-radius : 2px ;
      box-shadow : 0 0 1px 2px #123456 ;
    }

  table{
      width: 180%;
    }
    table, th, td{
      border-collapse: collapse;
      opacity: 2;
    }
    th,td{
      padding: 10px;
      text-align: center;
    }
    tr:nth-child(even){
      background-color: #ffc0cb;
      font-size: 17px;
    }
    tr:nth-child(odd){
      background-color: white;
      font-size: 17px;
    }

</style>

<body>
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
                <th >
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
      <br><br><br>
      <?php
      if(isset($_GET['del']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>This patient has already reported</strong>
        </div>
        <?php
      }
      ?>

      <?php
      if(isset($_GET['updatesucess']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Record updated</strong>
        </div>
        <?php
      }
      ?>

    </div>
  </center>
  <br>
</center>
<br>

<form class="form-inline header-search-form my-2 my-lg-0"     action="View-Appointment.php" method="POST" >
  <div id="page-wrap">
    <br>
    <center><input class="" type="text"  id="" placeholder="Search by patient id" aria-label="Search" style="width:30%; height: 70%; font-size: 18px;" name="searchid">
      &nbsp;&nbsp;&nbsp;&nbsp;

    <button  name="search" class="btn btn-primary my-2 my-sm-0" type="submit">Search </button>
  </center>
  <br>
  </div>
</form>

    <br><br>
    <form class="" action="View-Appointment.php" method="POST">
    <div id="page-wrap">
      <table width="200%" height="200" cellspacing="20" cellpadding="20">
          <thead>
            <tr style="background-color: skyblue;">
              <th style=""><h3 style="color: red;">ANTENATAL SCHEDULE LIST</h3></th>
            </tr>
          </thead>
        </table>
          <table border="1" width="200%"height="100" cellspacing="50" cellpadding="50">
            <thead>
              <tr style="background-color: #f08080; color: navy; font-size: 1.2em;">
              <th>ENTRY DATE</th>
              <th>PATIENT ID</th>
              <th>FULL NAME</th>
              <th>SCHEDULE DATE</th>
              <th>APPOINTMENT SERVICE</th>
              <th>TELEPHONE</th>
              <th>STATUS</th>
              <th>UPDATE</th>
            </tr>
            </thead>
            <tbody>
              <?php
              if ($searchIDFlag == false ) {
                foreach ($conn->query("SELECT * from appointments where status ='Reported' order by status ASC") as $row) {
              ?>
                <tr>
                <td><center><?php echo $row['Today']; ?></center></td>
                <td><center><?php echo $row['Mother_Id']; ?></center></td>
                <td><center><?php echo $row['Name'] ?></center></td>
                <td><center><?php echo $row['Scheduled_Date']; ?></center></td>
                <td><center><?php echo $row['AppointmentService']; ?></center></td>
                <td><center><?php echo $row['Telephone']; ?></center></td>
                <td><center><?php echo $row['Status']; ?></center></td>
                <td><center>
                  <?php
                      if ($row['Status'] === 'Reported') {
                  ?>
                          <a class="btn btn-sm btn-primary" href="View-Appointment?del=Updated">Update</a></center></td>
                  <?php
                }else {
                   ?>
                  <a class="btn btn-sm btn-primary" href="View-Appointment?update=<?php echo $row{'AID'}?>" >Update</a></center></td>
                </tr>
                <?php
                      }
                 }
               }elseif($searchIDFlag == true)
               {
                 $query = "SELECT * from appointments where status ='Reported' and  MRID='$actualId' order by status ASC ";
                   $query_res = $pdo->query($query);
                   $count = count($query_res->fetchAll());
                   if ($count > 0)
                   {
                     foreach ($conn->query("SELECT * from appointments where status ='Reported' and  MRID='$actualId' order by status ASC ") as $row) {
                   ?>
                     <tr>
                     <td><center><?php echo $row['Today']; ?></center></td>
                     <td><center><?php echo $row['Mother_Id']; ?></center></td>
                     <td><center><?php echo $row['Name'] ?></center></td>
                     <td><center><?php echo $row['Scheduled_Date']; ?></center></td>
                     <td><center><?php echo $row['AppointmentService']; ?></center></td>
                     <td><center><?php echo $row['Telephone']; ?></center></td>
                     <td><center><?php echo $row['Status']; ?></center></td>
                     <td><center>
                       <?php
                           if ($row['Status'] === 'Reported') {
                       ?>
                               <a class="btn btn-sm btn-primary" href="View-Appointment?del=Updated">Update</a></center></td>
                       <?php
                     }else {
                        ?>
                       <a class="btn btn-sm btn-primary" href="View-Appointment?update=<?php echo $row{'AID'}?>" >Update</a></center></td>
                     </tr>
                     <?php
                           }
                      }

                   }else {
                     echo "<script> alert('Incorrect ID / ID is not registered'); window.location.href='View-Appointment.php';</script>";
                   }


               }

           ?>

          </tbody >
          </table>

          <table width="200%"height="100" cellspacing="50" cellpadding="50">
            <thead>
                  <tr>
                    <th></th>
                  </tr>
            </thead>
            <tbody>
              <tr>
                <td><center>
                  <img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a>
                </center></td>
              </tr>
            </tbody>
          </table>

  </div>
</form>

</div>
<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
