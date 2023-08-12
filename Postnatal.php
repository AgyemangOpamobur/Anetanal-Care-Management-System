<?php
session_start();
require_once('class.php');

$count = new Methods();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Postnatal Visits</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="styles/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/css/adminlte.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="styles/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="css/icomoon.css">

  <!-- Favicon link -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom btn btn-navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars">
        </i> -->
        <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px;" for="">User Status: &nbsp;<label style="color: deeppink;"><?php echo @$_SESSION['status'];?></label></label>
      </li>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <li class="nav-item">
        <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px;"for="">Staff Id: &nbsp;<label style="color: deeppink;"><?php echo @$_SESSION['staffid'];?></label></label>
      </li>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <li class="nav-item">
        <label class="navbar-nav nav-item" style="color: darkcyan; font-size: 20px" for="">User Name: &nbsp;<label style="color: deeppink;"><?php echo @$_SESSION['userName'];?></label></label>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <a class="nav-link" data-toggle="dropdown" href="logout.php">
          <i class="icon-log-out" style="color: darkcyan;font-size: 20px;"> Logout</i>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>

  </nav>

  <style media="screen">
  	.dropbtn{
  		background-color: #ffff;
  		color: white;
  		padding: 16px;
  		font-size: 16px;
  		border: none;
  	}

  	.dropdown{
  		position: relative;
  		display: inline-block;
  	}

  	.dropdown-content{
  		display: none;
  		position: absolute;
  		background-color: #f1f1f1;
  		min-width: 160px;
  		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  		z-index: 1;
  	}

  	.dropdown-content a:hover{
  		background-color: #ddd;
  	}

  	.dropdown:hover  .dropdown-content{
  		display: block;
  	}
   .dropdown:hover .dropbtn{
  	 background-color: #e0ffff;
   }

  </style>

<!-- Emergency Antenatal  care notification  -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom btn btn-navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <div class="dropdown">
        <a href="View-Emergency-Consultation.php" class="navbar-nav nav-item dropbtn icon-inbox" style="color: darkcyan; font-size: 22px;" for="">&nbsp;Emergency Care: &nbsp;<span class="badge badge-light" style="color: red; font-size: 22px;"><?php  echo $count->CountEmergencyCounsultation();?></span></a>
      </div>

      </li>
          <!-- schedule antenatal visits -->
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <li class="nav-item">
        <div class="dropdown">
        <a href="View-Appointment-notification.php" class="navbar-nav nav-item dropbtn icon-message" style="color: darkcyan; font-size: 22px;" for="">&nbsp;Antenatal Visit: &nbsp;<span class="badge badge-light" style="color: red; font-size: 22px;"><?php  echo $count->CountAntenatalCounsultation();?></span></a>
      </div>
      </li>


    </ul>

  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-1">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">

            <h1 class="m-0 text-RED"> Postnatal Records</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <center>
      <br>
      <div class="col-md-4">
        <?php
        if(isset($_GET['norecord']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>No Postnatal Followup records for this patient</strong>
          </div>
          <?php
        }
        ?>
        <?php
        if(isset($_GET['norecord2']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>No Postnatal First Visit records for this patient</strong>
          </div>
          <?php
        }
        ?>
        <?php
        if(isset($_GET['norecord3']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>No Postnatal 6week records for this patient</strong>
          </div>
          <?php
        }
        ?>
        <?php
        if(isset($_GET['dataexist']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>There is existing records for this patient. Go to View First Visit(24-48hours) page and update her records</strong>
          </div>
          <?php
        }
        ?>
        <?php
        if(isset($_GET['dataexist1']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>There is existing records for this patient. Go to View Followup Visit page and update her records</strong>
          </div>
          <?php
        }
        ?>
        <?php
        if(isset($_GET['dataexist2']))
        {
          ?>
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>There is existing records for this patient. Go to View Postnatal(6 weeks) page and update her records</strong>
          </div>
          <?php
        }
        ?>
      </div>
    </center>
    <!-- /.content-header -->
    <style>
    .box{
      background-color:#2F4F4F;
    width: 80%;
    height: 60%;
    box-shadow: 2px 2px 2px 2px;
    }
    h4{
    font-size: 18px;
    font-family: 'comic sans ms';
    color: navy;
    text-align: center;}
    .content-panel{
    background-color:#39CCCC ;
    color:white;

    }
    </style>
    <style>
    .info-box-text{
      font-size: 11.5px;
      font-family: 'comic sans ms';
    }
    h1{
      color: white;
      text-align: center;
      background-color: #001f3f ;
    }
    </style>


    <!-- Main content -->
  <div class="container box">
    <br><br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- postnatal visit first 24 hours -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Postnatal-First-Visit.php" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">First Visit(24-48 hours)</span>
              </a>
              </div>
            </div>
          </div>
          <!-- View postnatal visit first 24 hours -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Postnatal-First-Visit.php" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View First Visit(24-48 hours)</span>
              </a>
              </div>
            </div>
          </div>
          <!-- follow up visits 6 - 7 days -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Postnatal-Followup-Visit" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Follow Up Visit(6-7Days)</span>
              </a>
              </div>
            </div>
          </div>
          <!-- Examination records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Postnatal-Followup-Visit.php" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Follow Up Visits</span>
              </a>
              </div>
            </div>
          </div>
          <!-- Postnatal 6 weeks -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Postnatal-Sixweeks-Visit" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Postnatal
                  (6Weeks)</span>
              </a>
              </div>
            </div>
          </div>
          <!-- Postnatal 6 weeks -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Postnatal-Sixweeks-Visit.php" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Postnatal
                  (6Weeks)</span>
              </a>
              </div>
            </div>
          </div>


          </div>

          </div>
          </div>
          <br><br>
          <center><img src="images/return.png" alt="" width = "40" height ="40"><a href="Return.php" style="float:middle;" class="">Return</a></center>
          <br><br>
          </div>
          </div>
