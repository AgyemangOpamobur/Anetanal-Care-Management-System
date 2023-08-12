<?php
session_start();
//connecting to database
$pdo = new PDO("mysql:host=localhost;dbname=antenataldb",'root','', array(
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//include the tcpdf library
include 'class.php';
//$database = new Methods();
include ('library/tcpdf.php');
 //make object of the class
 $pdf = new TCPDF('P','mm','A4');

//getting patient id
//$repID = @$_SESSION['reportID'];
 //remove default header and footer
 $pdf->setPrintHeader(false);
 $pdf->setPrintFooter(false);
 //add page
 $pdf->AddPage('L','A4');//changing the form to landscape

//Adding fonts
//$pdf->AddFont()

 //add title
 $pdf->SetFont('Helvetica','',16);
 //adding image to the report file
 $pdf->Image("images/logoAntenatal.png",15,5,28,0);
 $pdf->Cell(270,10,"ANTENATAL CARE MANAGEMENT SYSTEM",0,1,'C');
 //add contact
 $pdf->SetFont('Helvetica','',12);
 $pdf->Cell(100,6,"",0);
 $pdf->SetFont('Helvetica','',11);
 $pdf->Cell(20,6,"Contact:",0);
 $pdf->SetFont('HelveticaI','',11);
 $pdf->Cell(100,6,"+2330302459879",0);
 $pdf->ln();
 //adding email address
 $pdf->SetFont('Helvetica','',12);
 $pdf->Cell(100,7,"",0);
 $pdf->SetFont('Helvetica','',11);
 $pdf->Cell(20,7,"Email:",0);
 $pdf->SetFont('HelveticaI','',11);
 $pdf->Cell(100,7,"antenatalcare@gmail.com",0);
 $pdf->ln();
 //adding horizontal line
 $pdf->WriteHTML("<hr>", true,false);
 //adding report title
 $pdf->SetFont('Helvetica','B',14);
 $pdf->Cell(270,5,"REPORT ON REGISTERED PATIENT",0,1,'C');
 $pdf->ln();


$date = date('d-M-Y');
$time = date(' H:i ', strtotime('+17 hours'));
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(50,12,"Date/Time Requested:",0);
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(100,12,$date." ".$time,0);

 $fromYear = $_SESSION['fromYear'];
 $fromMonth = $_SESSION['fromMonth'];
 $toYear = $_SESSION['toYear'];
 $toMonth = $_SESSION['toMonth'] ;
//mothersrecord
//checking if the selected year has record in the database
$query = "SELECT * from mothersrecord where (Year= {$fromYear} and Month >= {$fromMonth}) or (Year= {$toYear} and Month <= {$toMonth})";
  $query_res = $pdo->query($query);
  $count = count($query_res->fetchAll());
  if ($count > 0) {
    foreach ($pdo->query("SELECT * from mothersrecord where (Year= {$fromYear} and Month >= {$fromMonth}) or (Year= {$toYear} and Month <= {$toMonth})") as $row)
    {
      if ($row) {
        $int = array($row);
        @$value += count($int);
      }
    }
  }else {
    header("location: Report-Registered-Patients.php?montherror");
    exit();
  }
 // displays total record in the database
     $pdf->SetFont('Helvetica','',12);
     $pdf->Cell(40,12,"Total Patients:",0);
     $pdf->SetFont('Helvetica','B',11);
     $pdf->Cell(50,12,@$value,0);
     $pdf->ln();

  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(40,12,"Requested By:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(110,12,$_SESSION['userName'],0);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(20,12,"Staff Id:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(100,12,$_SESSION['staffid'],0);
  $pdf->ln();
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(15,12,"From:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(30,12,$_SESSION['fromMonth']."/ ".$_SESSION['fromYear'],0);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(15,12,"To:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(100,12,$_SESSION['toMonth']."/ ".$_SESSION['toYear'],0);
  $pdf->ln();
  $text ="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
  $pdf->SetFont('Helvetica','',8);
  $pdf->Cell(190,8,$text,0,0,'C');
  $pdf->ln();

  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(10,8,"No.:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(35,8,"Date Registered:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(25,8,"Patient Id:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(55,8,"Full Name:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(12,8,"Age:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(30,8,"Date of Birth:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(25,8,"Contact:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(33,8,"Marital Status:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(23,8,"HouseNo:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(30,8,"Location:",1);

  $pdf->ln();
  //reading patients details from the databse
  if ($count > 0) {
    foreach ($pdo->query("SELECT * from mothersrecord where (Year={$fromYear} and Month >={$fromMonth}) or (Year={$toYear} and Month <={$toMonth})") as $row)
    {
      if ($row) {
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(10,10,$row['MRID'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(35,10,$row['Date_Of_Registration'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(25,10,$row['Patient_Number'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(55,10,$row['Full_Name'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(12,10,$row['Age'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(30,10,$row['DateOfBirth'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(25,10,$row['Telephone'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(33,10,$row['MarritalStatus'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(23,10,$row['HouseNumber'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(30,10,$row['Location'],1);
        $pdf->ln();
      }
    }
  }else {
    header("location: Report-Registered-Patients.php?montherror");
  }




 $pdf->Output('Summary_of_Labour_report');

 ?>
