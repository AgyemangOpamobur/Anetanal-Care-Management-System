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
$repID = @$_SESSION['reportID'];
 //remove default header and footer
 $pdf->setPrintHeader(false);
 $pdf->setPrintFooter(false);
 //add page
 $pdf->AddPage('P','A4');//changing the form to landscape

//Adding fonts
//$pdf->AddFont()

 //add title
 $pdf->SetFont('Helvetica','',16);
 //adding image to the report file
 $pdf->Image("images/logoAntenatal.png",15,5,28,0);
 $pdf->Cell(190,10,"ANTENATAL CARE MANAGEMENT SYSTEM",0,1,'C');
 //add contact
 $pdf->SetFont('Helvetica','',12);
 $pdf->Cell(50,6,"",0);
 $pdf->SetFont('Helvetica','',11);
 $pdf->Cell(20,6,"Contact:",0);
 $pdf->SetFont('HelveticaI','',11);
 $pdf->Cell(100,6,"+2330302459879",0);
 $pdf->ln();
 //adding email address
 $pdf->SetFont('Helvetica','',12);
 $pdf->Cell(50,7,"",0);
 $pdf->SetFont('Helvetica','',11);
 $pdf->Cell(20,7,"Email:",0);
 $pdf->SetFont('HelveticaI','',11);
 $pdf->Cell(100,7,"antenatalcare@gmail.com",0);
 $pdf->ln();
 //adding horizontal line
 $pdf->WriteHTML("<hr>", true,false);
 //adding report title
 $pdf->SetFont('Helvetica','B',14);
 $pdf->Cell(190,5,"SIGNUP DETAILS",0,1,'C');
 $pdf->ln();

$date = date('d-M-Y');
$time = date(' H:i ', strtotime('+17 hours'));
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(50,12,"",0);
$pdf->SetFont('Helvetica','',13);
$pdf->Cell(30,12,"Date/Time:",0);
$pdf->SetFont('Helvetica','B',13);
$pdf->Cell(100,12,$date." ".$time,0);
$pdf->ln();


    foreach ($pdo->query("SELECT * from registration where   staff_id={$_SESSION['staffid']}") as $row)
    {
      if ($row) {
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(40,12,"First Name:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['firstName'],0);
        $pdf->ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(40,12,"Last Name:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['secondName'],0);
        $pdf->ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(40,12,"Staff Id:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['staff_id'],0);
        $pdf->ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(40,12,"Telephone:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['contact'],0);
        $pdf->ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(50,12,"User Type:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['status'],0);
        $pdf->ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(50,12,"Registration Code:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['regCode'],0);
        $pdf->ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(50,12,"",0);
        $pdf->SetFont('Helvetica','',13);
        $pdf->Cell(50,12,"Email:",0);
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(50,12,$row['email'],0);
      }
    }


 $pdf->Output('Signup_Details');

 ?>
