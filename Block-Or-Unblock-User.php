<?php
session_start();
require 'class.php';
$database = new connect();
$db = $database->Connectdb();
$conn = $db;

$blockuser = new Methods();
//block user
if (isset($_GET['block'])) {
  $userID = $_GET['block'];
   $blockuser->BlockUser($userID);
}
// unblock user
if (isset($_GET['unblock'])) {
  $userID = $_GET['unblock'];
   $blockuser->UnBlockUser($userID);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Block / Unblock User</title>
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
<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

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
      if(isset($_GET['userblocked']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Account block successful.</strong>
        </div>
        <?php
      }
      ?>

      <?php
      if(isset($_GET['useractive']))
      {
        ?>
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>This account is active now.</strong>
        </div>
        <?php
      }
      ?>

    </div>
  </center>
  <br>
    <br><br>
    <form class="" action="Block-Or-Unblock-User.php" method="POST">
    <div id="page-wrap">
      <table width="200%" height="200" cellspacing="20" cellpadding="20">
          <thead>
            <tr style="background-color: skyblue;">
              <th style=""><h3 style="color: red;">Block / Unblock User</h3></th>
            </tr>
          </thead>
        </table>
          <table border="1" width="200%"height="100" cellspacing="50" cellpadding="50">
            <thead>
              <tr style="background-color: #f08080; color: navy; font-size: 1.2em;">
              <th>No.:</th>
              <th>FULL NAME</th>
              <th>STAFF ID</th>
              <th>CONTACT</th>
              <th>EMAIL</th>
              <th>REG. CODE</th>
              <th>ACCESS</th>
              <th>ACTION</th>
              <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
              <?php
                foreach ($conn->query("SELECT * from registration ") as $row) {
              ?>
                <tr>
                <td><center><?php echo $row['user_id']; ?></center></td>
                <td><center><?php echo $row['firstName']." ".$row['secondName']; ?></center></td>
                <td><center><?php echo $row['staff_id'] ?></center></td>
                <td><center><?php echo $row['contact']; ?></center></td>
                <td><center><?php echo $row['email']; ?></center></td>
                <td><center><?php echo $row['regCode']; ?></center></td>
                <td><center><?php echo $row['Access']; ?></center></td>
                <td><center>
                          <a class="btn btn-sm btn-primary" href="Block-Or-Unblock-User?block=<?php echo $row{'user_id'}; ?>">Block</a></center></td>
                   <td><center>
                  <a class="btn btn-sm btn-primary" href="Block-Or-Unblock-User?unblock=<?php echo $row{'user_id'}?>" >Unblock</a></center></td>

                </tr>
                <?php
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
                <td><center>  &nbsp;&nbsp;&nbsp;
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
