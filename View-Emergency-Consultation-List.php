<?php
session_start();
require 'class.php';
$database = new connect();
$db = $database->Connectdb();
$conn = $db;

//search for patient id

    $searchNameFlag = false;
    $fname = "";
    $sname = "";

$database = new Methods();

if (isset($_GET['update'])) {
  $userID = $_GET['update'];
   $database->Update_Emergency_Consultation($userID);
}

//getting patient record through search
if (isset($_POST['search'])) {
  try {
    $searchName = @trim($_POST['searchName']);
    //checking the strings are empty
    if (empty($searchName)) {
      echo "<script> alert('Please enter patient Name'); window.location.href='View-Emergency-Consultation-List.php';</script>";
    }else {
      //condition to search for patient name by id

    if ($searchName) {
      //ucwords() convert firt letter to upper case in words
    @$getName = explode(" ", ucwords($searchName));
    $fname = @$getName[0];
    $sname = @$getName[1];
    $searchNameFlag = true;
  }

   }

  } catch (Exception $e) {
    echo "<script> alert('Name can not be found in the list.'); window.location.href='View-Emergency-Consultation-List.php';</script>";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View List of Emergency Consultation</title>
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
      <br><br><br>
      <?php
      if(isset($_GET['del']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>This patient has been contacted through SMS or VOIP.</strong>
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

    </div>
  </center>
  <br>
  <form class="form-inline header-search-form my-2 my-lg-0" action="View-Emergency-Consultation-List.php" method="POST" >
    <div id="page-wrap">
      <br>
      <center>
        <input class="" type="text"  id="" placeholder="Search by Name (First Name Last Name)" aria-label="Search" style="width:40%; height: 70%; font-size: 18px;" name="searchName">
        &nbsp;&nbsp;&nbsp;&nbsp;
      <button  name="search" class="btn btn-primary my-2 my-sm-0" type="submit">Search </button>
    </center>
    <br>
    </div>
  </form>


    <br>
    <form class="" action="View-Emergency-Consultation-List.php" method="POST">
    <div id="page-wrap">
      <table width="200%" height="200" cellspacing="20" cellpadding="20">
          <thead>
            <tr style="background-color: skyblue;">
              <th style=""><h3 style="color: red;">EMERGENCY ANTENATAL CONSULTATION LIST</h3></th>
            </tr>
          </thead>
        </table>
          <table border="1" width="200%"height="100" cellspacing="50" cellpadding="50">
            <thead>
              <tr style="background-color: #00FFFF; color: red; font-size: 1.2em;">
              <th>ENTRY DATE</th>
              <th>TIME</th>
              <th>FULL NAME</th>
              <th>CONTACT</th>
              <th>SUBJECT</th>
              <th>MESSAGE</th>
              <th>STATUS</th>
              <th>DATE CONSULTED</th>
              <th>UPDATE</th>
              <th>SEND SMS</th>
            </tr>
            </thead>
            <tbody>
              <?php
                if ($searchNameFlag == false) {
                foreach ($conn->query("SELECT * from emergencyconsultation    order by DateReceived ASC") as $row) {
              ?>
                <tr>
                <td><center><?php echo $row['DateReceived']; ?></center></td>
                <td><center><?php echo $row['Time_Received']; ?></center></td>
                <td><center><?php echo $row['FirstName']." ".$row['LastName']; ?></center></td>
                <td><center><?php echo $row['Contact'] ?></center></td>
                <td><center><?php echo $row['Subject']; ?></center></td>
                <td><center><?php echo $row['Message']; ?></center></td>
                <td><center><?php echo $row['Status']; ?></center></td>
                <td><center><?php echo $row['Date_Consulted']; ?></center></td>
                <td><center>
                  <?php
                     if ($row['Status'] === 'Service Delivered') {
                  ?>
                          <a class="btn btn-sm btn-primary" href="View-Emergency-Consultation-List.php?del=Updated">Update</a></center></td>
                  <?php
               }else {
                   ?>
                  <a class="btn btn-sm btn-primary" href="View-Emergency-Consultation-List.php?update=<?php echo $row{'FID'}?>" >Update</a></center></td>
                  <?php
                }
                   ?>
                   <?php
                    if ($row['Status'] === 'Service Delivered')
                    {
                    ?>
                    <td>
                          <a class="btn btn-sm btn-primary" href="View-Emergency-Consultation-List.php?del=Updated">SMS</a></center>
                    </td>
                  <?php
                }else{

                   ?>
                  <td><center><a class="btn btn-sm btn-primary" href="Send-SMS.php?id=<?php echo $row{'FID'}?>">SMS</a></center>
                  </td>
                  <?php
                  }
                   ?>

                </tr>
                <?php
                }

              }
              //search by first name and last name
              elseif ($searchNameFlag == true)
               {
                 $query = "SELECT * from emergencyconsultation where FirstName = '$fname' and LastName = '$sname' order by DateReceived ASC";
                   $query_res = $pdo->query($query);
                   $count = count($query_res->fetchAll());

                   if ($count > 0)
                    {
                      foreach ($conn->query("SELECT * from emergencyconsultation where FirstName = '$fname' and LastName = '$sname' order by DateReceived ASC") as $row)
                      {
                  ?>
                        <tr>
                        <td><center><?php echo $row['DateReceived']; ?></center></td>
                        <td><center><?php echo $row['Time_Received']; ?></center></td>
                        <td><center><?php echo $row['FirstName']." ".$row['LastName']; ?></center></td>
                        <td><center><?php echo $row['Contact'] ?></center></td>
                        <td><center><?php echo $row['Subject']; ?></center></td>
                        <td><center><?php echo $row['Message']; ?></center></td>
                        <td><center><?php echo $row['Status']; ?></center></td>
                        <td><center><?php echo $row['Date_Consulted']; ?></center></td>
                        <td><center>
                          <?php
                             if ($row['Status'] === 'Service Delivered') {
                          ?>
                                  <a class="btn btn-sm btn-primary" href="View-Emergency-Consultation-List.php?del=Updated">Update</a></center></td>
                          <?php
                       }else {
                           ?>
                          <a class="btn btn-sm btn-primary" href="View-Emergency-Consultation-List.php?update=<?php echo $row{'FID'}?>" >Update</a></center></td>
                          <?php
                        }
                           ?>
                           <?php
                            if ($row['Status'] === 'Service Delivered')
                            {
                            ?>
                            <td>
                                  <a class="btn btn-sm btn-primary" href="View-Emergency-Consultation-List.php?del=Updated">SMS</a></center>
                            </td>
                          <?php
                        }else{

                           ?>
                          <td><center><a class="btn btn-sm btn-primary" href="Send-SMS.php?id=<?php echo $row{'FID'}?>">SMS</a></center>
                          </td>
                          <?php
                          }
                           ?>

                        </tr>
                        <?php
                        }
                      }else {
                        echo "<script> alert('Name can not be found in the list.'); window.location.href='View-Emergency-Consultation-List.php';</script>";
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
