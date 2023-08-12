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
 $pdf->AddPage();

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
 $pdf->Cell(190,5,"SUMMARY OF LABOUR REPORT",0,1,'C');
 $pdf->ln();
//Adding content to form
//adding email address


$date = date('d-M-Y');
$time = date(' H:i ', strtotime('+17 hours'));

  //fetching records from labour table
  foreach ($pdo->query("SELECT * from  mothersrecord where MRID='$repID'") as $row)
   {
       if ($row) {
         //adding content to first row in the report
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(25,8,"Patient ID:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,8,$row['Patient_Number'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(30,8,"Patient Name:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(60,8,$row['Full_Name'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(10,8,"Sex:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(20,8,"Female",0);
         $pdf->ln();
         //adding content to second row in the report
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(12,8,"Age:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(40,8,$row['Age']." Years",0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(30,8,"Marital Status:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,8,$row['MarritalStatus'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(20,8,"Contact:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(50,8,$row['Telephone'],0);
         $pdf->ln();
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(20,8,"Location:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,8,$row['Location'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(25,8,"HouseNo.:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,8,$row['HouseNumber'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(45,8,"Date/Time Requested:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(50,8,$date." ".$time,0);

       }
   }
   $pdf->ln();
   $text ="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
   $pdf->SetFont('Helvetica','',8);
   $pdf->Cell(190,8,$text,0,0,'C');
   $pdf->ln();
   $pdf->SetFont('Helvetica','B',13);
   $pdf->Cell(190,15,"MOTHER",1,1,'C');
  //  $pdf->ln();
   //fetching data from the mother record table
   foreach ($pdo->query("SELECT * from summaryoflabourordeliveryoutcome where MRID='$repID'") as $row)
    {
        if ($row) {
          //adding content to first row in the report
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(30,10,"Delivery Date:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(40,10,$row['Date_Of_Delivery'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(30,10,"Delivery Time:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['Delivery_Time'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Place Of Delivery:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Place_Of_Delivery'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(100,10,"If Home delivery who attended delivery:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(90,10,$row['If_Home_Delivery_Who_Attended_Delivery'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(80,10,"If Health Facility(Name of Facility):",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(110,10,$row['If_Health_Facility_Name_Of_The_Facility'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Types of Labour:",1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,10,"Spont:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Type_OF_Labour_Spont'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,10,"Induced:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Type_Of_Labour_Induced'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(25,10,"Augmented:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(25,10,$row['Type_Of_Labour_Augmented'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Duration of Labour:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(70,10,$row['Duration_Of_Labour'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Mode of Delivery:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(40,10,$row['Mode_Of_Delivery'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(50,10,"Labour Complication:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(140,10,$row['Labour_complication'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(50,10,"Condition at discharge:",1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(10,10,"BP:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['Condition_At_Discharge_In_BP'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(15,10,"Pulse:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(15,10,$row['Condition_At_Discharge_In_Pulse'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(25,10,"Perineum:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['Condition_At_Discharge_In_Perineum'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(15,10,"Lochia:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['Condition_At_Discharge_In_Lochia'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Date Discharge",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(60,10,$row['Date_OF_Discharge'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(50,10,"Lactation Established:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(40,10,$row['Lactation_Established'],1);
          $pdf->ln();
          //getting data for baby
          $pdf->ln();
          $pdf->SetFont('Helvetica','B',13);
          $pdf->Cell(190,15,"BABY",1,1,'C');
          // $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(10,10,"Sex",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Sex_Of_Baby'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(30,10,"Birth Weight",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Birth_Weight'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(35,10,"Apgar Score:",1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(13,10,"1min:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(15,10,$row['Apgar_Score_1min'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(13,10,"5min:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(14,10,$row['Apgar_Score_5min'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(50,10,"Condition at Discharge:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(50,10,$row['Baby_Condition_At_Discharge'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Discharge Eyes:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(50,10,$row['Baby_Discharging_Eyes'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,10,"Jaundice:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Baby_Has_Jaundice'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(28,10,"Meconium:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(40,10,$row['Baby_Has_Meconium'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(48,10,"Suckling Established:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(24,10,$row['Suckling_Established_In_Baby'],1);
          // $pdf->ln();
          $pdf->ln();
          $pdf->ln();
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(40,10,"Date of Next Visit:",0);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(50,10,$row['Date_Of_Next_Visit'],0);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(30,10,"Midwife Name:",0);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(40,10,$row['Midwife_Name'],0);
        }
    }




 $pdf->Output('Summary_of_Labour_report');

 ?>
