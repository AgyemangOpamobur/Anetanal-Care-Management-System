<?php
session_start();
require 'class.php';
//require 'dbclass.php';
$database = new connect();
$db = $database->Connectdb();
$conn = $db;

$database = new Methods();

if (isset($_GET['del'])) {
  $userID = $_GET['del'];
   $database->Delete_Row($userID);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User Logs</title>
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

<style media="screen">
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
      background-color: #00bfff;
      font-size: 17px;
    }
    tr:nth-child(odd){
      background-color: white;
      font-size: 17px
    }

</style>
<body>
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
      <br><br><br>

      <?php
      if(isset($_GET['Deleted']))
      {
        ?>
        <div style="float: right;" class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong> User-Log Removed</strong>
        </div>
        <?php
      }
      ?>

    </div>
  </center>
  <br>
    <br><br>
    <form class="" action="#" method="post">
    <div id="page-wrap">
      <table width="100%" height="100%" cellspacing="20" cellpadding="20">
          <thead>
            <tr style="background-color: cyan;">
              <th style=""><h3 style="color: red;">USER-LOGS</h3></th>
            </tr>
          </thead>
        </table>
          <table id="table" border="1" width="200%"height="100" cellspacing="50" cellpadding="50">
            <thead>
              <tr style="background-color: #f08080; color: blue cornflowerblue; font-size: 1.2em;">
              <th>DATE LOGIN</th>
              <th>USER NAME</th>
              <th>STAFF ID</th>
              <th>TIME LOGIN</th>
              <th>USER STATUS</th>
              <th>TIME LOGOUT</th>
              <th>DELETE</th>
            </tr>
            </thead>
            <tbody>
              <?php
                foreach ($conn->query("SELECT * from userlogs") as $row) {
                echo "<tr>";
                echo"
                    <td><center>{$row['DateLogin']}</center></td>
                    <td><center>{$row['UserName']}</center></td>
                    <td><center>{$row['Staff_ID']}</center></td>
                    <td><center>{$row['TimeLogin']}</center></td>
                    <td><center>{$row['UserStatus']}</center></td>
                    <td><center>{$row['LogOutTime']}</center></td>
                    <td><center><a class='btn btn btn-sm btn-danger del' href='View-User-Logs.php?del={$row['ULID']}' >Remove</a></center></td>";
                echo "</tr>";
                }

                 ?>

          </tbody >
          </table>
          <table width="200%"height="100" cellspacing="50" cellpadding="50" >
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
