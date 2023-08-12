<?php

session_start();

$status = $_SESSION['status'];
switch ($status) {
  case 'Super User':
  header("Location: superuser.php");
  break;
  case 'Nurse':
  header("Location: Nurse.php?");
  break;
  case 'Midwife':
  header("Location: Midwife.php?");
  break;
  case 'Administrator':
  header("Location: Administrator.php");
  break;
  default:
  header("Location: userportal.php");
  break;
}

?>
