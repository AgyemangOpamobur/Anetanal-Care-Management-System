<?php
session_start();

$status = $_SESSION['status'];
switch ($status) {
  case 'Super User':
  header("location: superuser.php");
  break;
  case 'Nurse':
  header("location: Nurse.php");
  break;
  case 'Administrator':
  header("location: Administrator.php");
  break;
  case 'Midwife':
  header("location: Midwife.php");
  break;
  default:
  # code...
  break;
}

?>
