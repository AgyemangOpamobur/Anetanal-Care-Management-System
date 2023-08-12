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

  <title>Dash Board</title>
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
          <i class="icon-log-out" style="color: darkcyan; font-size: 20px;"> Logout</i>
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

            <h1 class="m-0 text-RED"> Antenatal Care Mangement System</h1>
          </div>

        </div>
      </div>
    </div>

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
          <!-- Register new patient -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Register.php" >
              <span class="info-box-icon "><img class="" src="images/register" style="width=30%;"></i></span>
              <div class="info-box-content">
                <span class="">Register New Patient</span></a>
              </div>
            </div>
          </div>
          <!-- View list of patient records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Registered-Patient.php" >
              <span class="info-box-icon "><img src="images/woman.png" style="width=10%; height=10%"></i></span>
              <div class="info-box-content">
                <span class="">View List of Patient</span></a>
              </div>
            </div>
          </div>

          <!-- Schedule antenatal appointment -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Attendance.php" >
              <span class="info-box-icon"><img class="" src="images/schedule" style="width=30%; height=10%"></i></span>
              <div class="info-box-content">
                <span class="">Schedule Attentdance</span>
              </a>
              </div>
            </div>
          </div>
          <!-- View Antenatal schedule -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Appointment.php" >
              <span class="info-box-icon"><img class="" src="images/schedule" style="width=30%; height=10%"></i></span>
              <div class="info-box-content">
                <span class="">View Antenatal Schedule</span>
              </a>
              </div>
            </div>
          </div>

          <!-- View emergency consultation list -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Emergency-Consultation-List.php" >
              <span class="info-box-icon"><img src="images/emergency" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Emergency Consultation </span>
              </a>
              </div>
            </div>
          </div>

          <!-- Antenatal history -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="History-search.php" >
              <span class="info-box-icon"><img src="images/history" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Antenatal History</span>
              </a>
              </div>
            </div>
          </div>
          <!-- View Antenatal history -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Antenatal-History-search.php" >
              <span class="info-box-icon"><img src="images/history" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Antenatal History</span>
              </a>
              </div>
            </div>
          </div>

          <!-- Examination records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Examination-History-search.php" >
              <span class="info-box-icon"><img src="images/exams" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Examination Records</span>
              </a>
              </div>
            </div>
          </div>
          <!-- View examination records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Examination-History-search.php" >
              <span class="info-box-icon"><img src="images/exams" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Examination Records</span>
              </a>
              </div>
            </div>
          </div>
          <!-- Antenatal investigations -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Antenatal-Investigation-Search.php" >
              <span class="info-box-icon"><img src="images/investigation" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Investigation</span>
              </a>
              </div>
            </div>
          </div>
          <!-- View Antenatal investigations -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Antenatal-Investigation-Search.php" >
              <span class="info-box-icon"><img src="images/investigation" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Investigation</span>
              </a>
              </div>
            </div>
          </div>
          <!-- Anteanatal progress records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Antenatal-Progress-Search.php" >
              <span class="info-box-icon"><img src="images/progress.png" style="width=20%"></i></span>
              <div class="info-box-content">
                <span class="">Antenatal Progress Record</span>
              </a>
              </div>
            </div>
          </div>
          <!-- View Anteanatal progress records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Antenatal-Progress-Search.php" >
              <span class="info-box-icon"><img src="images/progress.png" style="width=20%"></i></span>
              <div class="info-box-content">
                <span class="">View Antenatal Progress</span>
              </a>
              </div>
            </div>
          </div>
          <!-- maternal health records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Maternal-Health-Records-Search.php" >
              <span class="info-box-icon"><img src="images/health" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Maternal Health Records</span>
              </a>
              </div>
            </div>
          </div>
          <!-- view maternal health records -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Maternal-Health-Records-Search.php" >
              <span class="info-box-icon"><img src="images/health" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Maternal Health Records</span>
              </a>
              </div>
            </div>
          </div>
          <!-- labour / delivery outcome  -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Delivery-Outcome-Search.php" >
              <span class="info-box-icon"><img src="images/labour" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Labour/Delivery Outcome</span>
              </a>
              </div>
            </div>
          </div>
          <!-- view labour / delivery outcome  -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="View-Delivery-Outcome-Search.php" >
              <span class="info-box-icon"><img src="images/labour" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">View Labour/Delivery Outcome</span>
              </a>
              </div>
            </div>
          </div>
          <!-- postnatal visit  -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Postnatal-First-Visit-Search.php" >
              <span class="info-box-icon"><img src="images/postnatalcare" style="width=30%;"></i></span>
              <div class="info-box-content">
                <span class="">Postnatal Care</span>
              </a>
              </div>
            </div>
          </div>
          <!-- Block user   -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Report.php" >
              <span class="info-box-icon"><img class="" src="images/report" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Generate Report</span>
              </a>
              </div>
            </div>
          </div>
          <!-- send sms   -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="SMS-Search.php" >
              <span class="info-box-icon"><img class=""src="images/sms" style="width=30%"></i></span>
              <div class="info-box-content">
                <span class="">Send SMS</span>
              </a>
              </div>
            </div>
          </div>
          <!-- send bulk sms   -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <a href="Send-Bulk-SMS.php" >
              <span class="info-box-icon"><img class=""src="images/sms" style="width=30%"></span>
              <div class="info-box-content">
                <span class="">Send Bulk SMS</span>
              </a>
              </div>
            </div>
          </div>


          </div>

          </div>
          </div>
          <br><br><br>
          </div>
          </div>
