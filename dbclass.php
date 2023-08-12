<?php

class connect
{
 public function Connectdb()
   {
     try{
       global $pdo;
       $host = "localhost";
       $user = "root";
       $password = "";
       $database_name = "antenataldb";

       //connecting to the database
       $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
         //echo "database connected";
         return $pdo;

       }catch(Exception $ex){
        $_SESSION['database_error'] = $ex->getMessage();
         //return false;
       }
     }
}



 ?>
