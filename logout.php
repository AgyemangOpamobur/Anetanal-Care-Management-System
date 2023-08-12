<?php
session_start();
require 'dbclass.php';
$database = new connect();
$db = $database->Connectdb();
$conn = $db;

$Session_time = $_SESSION['time'];
$time = date(' H:i ', strtotime('+17 hours'));
global $userID;

try{
  $sql = "UPDATE userlogs SET LogOutTime='$time' WHERE TimeLogin='$Session_time' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  session_destroy();
  header("location: index.php");
}catch(Exception $e){
  echo $e->getMessage();
}

?>
