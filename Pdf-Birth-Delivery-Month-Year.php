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
 $pdf->Cell(270,5,"REPORT ON BIRTH DELIVERY",0,1,'C');
 $pdf->ln();

$date = date('d-M-Y');
$time = date(' H:i ', strtotime('+17 hours'));
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(50,12,"Date/Time Requested:",0);
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(100,12,$date." ".$time,0);

$BirthfromYear = $_SESSION['BirthfromYear'];
$BirthfromMonth = $_SESSION['BirthfromMonth'];
$BirthtoYear = $_SESSION['BirthtoYear'];
$BirthtoMonth = $_SESSION['BirthtoMonth'] ;

//checking if the selected year has record in the database
$query = "SELECT * from summaryoflabourordeliveryoutcome where (Year= {$BirthfromYear} and Month >= {$BirthfromMonth}) or (Year= {$BirthtoYear} and Month <= {$BirthtoMonth})";
  $query_res = $pdo->query($query);
  $count = count($query_res->fetchAll());
  if ($count > 0) {
    foreach ($pdo->query("SELECT * from summaryoflabourordeliveryoutcome where (Year= {$BirthfromYear} and Month >= {$BirthfromMonth}) or (Year= {$BirthtoYear} and Month <= {$BirthtoMonth})") as $row)
    {
      if ($row) {
        $int = array($row);
        @$value += count($int);
      }
    }
  }else {
    header("location: Report-Birth-Delivery.php?montherror");
    exit();
  }
 // displays total record in the database
     $pdf->SetFont('Helvetica','',12);
     $pdf->Cell(40,12,"Total Birth Delivery:",0);
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
  $pdf->Cell(30,12,@$_SESSION['BirthyearOne'],0);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(15,12,"To:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(100,12,@$_SESSION['BirthyearTwo'],0);
  $pdf->ln();
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(15,12,"From:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(30,12,@$_SESSION['BirthfromMonth']."/".$_SESSION['BirthfromYear'],0);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(15,12,"To:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(100,12,@$_SESSION['BirthtoMonth']."/".@$_SESSION['BirthtoYear'],0);
  $pdf->ln();
  $text ="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
  $pdf->SetFont('Helvetica','',8);
  $pdf->Cell(270,8,$text,0,0,'C');
  $pdf->ln();
  $motherId = "";
//fetching all MRID from the column;
  $stmt = $pdo->query("SELECT MRID from summaryoflabourordeliveryoutcome")->fetchAll(PDO::FETCH_COLUMN);
  $motherId =   $stmt;

  //getting count of babies of the various categories
  foreach ($pdo->query("SELECT * from summaryoflabourordeliveryoutcome") as $row)
  {
    if ($row) {
      //assigning mother id to an array
      @$liveBirth=0;
       @$stillBirth=0;
       @$stillBirth=0;
       //counting to live,still and premature births
      $condition = $row['Condition_of_Child'];
      if ($condition == "Live Birth") {
          @$liveBirth += count($condition);
       }elseif($condition == "Still Birth") {
           @$stillBirth += count($condition);
       }elseif($condition == "Premature") {
             @$prematureBirth += count($condition);
        }
    }
  }
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(35,12,"Total Live Birth:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(40,12,$liveBirth,0);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(35,12,"Total Still Birth:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(50,12,$stillBirth,0);
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(50,12,"Total Premature Birth:",0);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(50,12,$prematureBirth,0);
  $pdf->ln();
  $text ="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
  $pdf->SetFont('Helvetica','',8);
  $pdf->Cell(270,8,$text,0,0,'C');
  $pdf->ln();
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(10,8,"No.:",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(25,8,"Pat. ID",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(55,8,"Full Name",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(20,8,"Age",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(30,8,"Delivery Date",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(30,8,"Delivery Time",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(40,8,"Place Of Delivery",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(40,8,"Condition of Child",1);
  $pdf->SetFont('Helvetica','B',12);
  $pdf->Cell(30,8,"Sex of Baby",1);
  $pdf->ln();

  //getting number of data assign to the array
  $length = sizeof($motherId);
  //using loop to read the content of the array
  //setting a counter
    $count = 0;

     // if ($count > 0) {
      foreach ($pdo->query("SELECT * from summaryoflabourordeliveryoutcome where (Year= {$BirthfromYear} and Month >= {$BirthfromMonth}) or (Year= {$BirthtoYear} and Month <= {$BirthtoMonth})") as $row)
      {
        if ($row) {
      $pdf->SetFont('Helvetica','',11);
      $pdf->Cell(10,10,$row['SLDOID'],1);
      $deliveryDate = $row['Delivery_Date'];
      $deliveryTime = $row['Delivery_Time'];
      $placeofdelivery = $row['Place_Of_Delivery'];
      $conditionofchild = $row['Condition_of_Child'];
      $sexofbaby = $row['Sex_Of_Baby'];

//using do while loop to fetch records from mother table
  do {
    foreach ($pdo->query("SELECT * from mothersrecord where MRID='$motherId[$count]'") as $row)
    {
      if ($row) {
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(25,10,$row['Patient_Number'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(55,10,$row['Full_Name'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(20,10,$row['Age'],1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(30,10,$deliveryDate,1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(30,10,$deliveryTime,1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(40,10,$placeofdelivery,1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(40,10,$conditionofchild,1);
        $pdf->SetFont('Helvetica','',11);
        $pdf->Cell(30,10,$sexofbaby,1);

        $pdf->ln();
      }
    }
    $count++;

  }while($count < 1);

  }else {
    header("location: Report-Birth-Delivery.php?montherror");
  }
}

 // }else {
 //   header("location: Report-Birth-Delivery.php?montherror");
 // }

 $pdf->Output('Birth_Delivery_report');
 ?>
