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
 $pdf->Cell(190,5,"SUMMARY OF POSTNATAL CARE REPORT",0,1,'C');
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
         $pdf->Cell(25,9,"Patient ID:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,9,$row['Patient_Number'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(30,9,"Patient Name:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(60,9,$row['Full_Name'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(10,9,"Sex:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(20,9,"Female",0);
         $pdf->ln();
         //adding content to second row in the report
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(12,9,"Age:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(40,9,$row['Age']." Years",0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(30,9,"Marital Status:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,9,$row['MarritalStatus'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(20,9,"Contact:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(50,9,$row['Telephone'],0);
         $pdf->ln();
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(20,9,"Location:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,9,$row['Location'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(25,9,"HouseNo.:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(30,9,$row['HouseNumber'],0);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(45,9,"Date/Time Requested:",0);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(50,9,$date." ".$time,0);
       }
   }
   $pdf->ln();

   //counting the total number of postanatal visits
   $query = "SELECT * from appointments where MRID='$repID' and  (AppointmentService='Postnatal First Visit' or AppointmentService='Postnatal Followup Visit' or AppointmentService='Postnatal 6week Visit') and Status ='Reported'";
     $query_res = $pdo->query($query);
     $count = count($query_res->fetchAll());
     if ($count > 0) {
       foreach ($pdo->query("SELECT * from appointments where MRID='$repID' and  (AppointmentService='Postnatal First Visit' or AppointmentService='Postnatal Followup Visit' or AppointmentService='Postnatal 6week Visit') and Status ='Reported'") as $row)
       {
         if ($row) {
           $int = array($row);
           @$totalVisits += count($int);
           $int = 0;
         }
       }
     }else {
       $totalVisits = 0;
     }
   $pdf->SetFont('Helvetica','',12);
   $pdf->Cell(33,9,"Postnatal Visits: ",0,0);
   $pdf->SetFont('Helvetica','B',12);
   $pdf->Cell(150,9,$totalVisits,0,0);
   $pdf->ln();
   $text ="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
   $pdf->SetFont('Helvetica','',8);
   $pdf->Cell(190,9,$text,0,0,'C');
   $pdf->ln();
    $pdf->ln();
   $pdf->SetFont('Helvetica','B',13);
   $pdf->Cell(190,15,"POSTNATAL FIRST VISIT",1,1,'C');
  //  $pdf->ln();
   $pdf->SetFont('Helvetica','B',13);
   $pdf->Cell(190,15,"Care of Mother",1,1,'C');
  //  $pdf->ln();
   //fetching data from the mother record table
   foreach ($pdo->query("SELECT * from postnatalfirstvisitcareofmother where MRID='$repID'") as $row)
    {
        if ($row) {
          //adding content to first row in the report
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(25,8,"Complaints:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(35,8,$row['Complaints'],1);
          $pdf->SetFont('Helvetica','',11);
          $pdf->Cell(25,8,"Temperature:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(25,8,$row['Temperature'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(10,8,"BP:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(25,8,$row['BP'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,8,"Jaundice:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(25,8,$row['Jaundice'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(15,10,"Pallor:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(15,10,$row['Pallor'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(15,10,"Pulse:",1);
          $pdf->SetFont('Helvetica','B',12);
          $pdf->Cell(15,10,$row['Pulse'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(38,10,"Breast And Nipple:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['BreastAndNipple'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(45,10,"Abdomen Tendernes:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(27,10,$row['AbdomenTendernes'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(45,10,"Perineum And Lochia:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['PerineumAndLochia'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(45,10,"Lower Limbs Calf Pain:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['LowerLimbsCalfPain'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(25,10,"UterusSize:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(35,10,$row['UterusSize'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,10,"Swelling:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['Swelling'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(23,10,"Treatment:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(25,10,$row['Treatment_VitA'],1);
          $pdf->Cell(25,10,$row['Treatment_Fefolate'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(10,10,"Hb:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['LabTest_Hb'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(10,10,"HIV:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(37,10,$row['LabTest_HIV'],1);
        }
    }
    $pdf->ln();
    // $pdf->ln();
    $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(190,15,"Care of Baby",1,1,'C');
    // $pdf->ln();
    //fetching data from the mother record table
    foreach ($pdo->query("SELECT * from  postnatalfirstvisitcareofbaby where MRID='$repID'") as $row)
     {
         if ($row) {
           //adding content to first row in the report
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(25,8,"Complaints:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(35,8,$row['Complaints'],1);
           $pdf->SetFont('Helvetica','',11);
           $pdf->Cell(28,8,"Breastfeeding:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(25,8,$row['Breastfeeding'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(28,8,"Temperature:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(18,8,$row['Temperature'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(21,8,"HeartRate:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(10,8,$row['HeartRate'],1);
           $pdf->ln();
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(15,10,"Pallor:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(15,10,$row['Pallor'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(20,10,"Jaundice:",1);
           $pdf->SetFont('Helvetica','B',12);
           $pdf->Cell(25,10,$row['Jaundice'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(17,10,"Activity:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['Activity'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(15,10,"Chest:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['Chest'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(21,10,"Abdomen:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(22,10,$row['Abdomen'],1);
           $pdf->ln();
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(15,10,"Limbs:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['Limbs'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(13,10,"Head:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['Head'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(23,10,"SpineBack:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['SpineBack'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(30,10,"UmblicalCord:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['UmblicalCord'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(12,10,"Skin:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(17,10,$row['Skin'],1);
           $pdf->ln();
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(30,10,"DischargeEyes:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['DischargeEyes'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(27,10,"PassingUrine:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['PassingUrine'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(28,10,"PassingStool:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(65,10,$row['PassingStool'],1);
           $pdf->ln();
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(43,10,"Vitamin K Treatment:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['VitKTreatment'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(35,10,"BCG Treatment:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(20,10,$row['BCGTreatment'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(38,10,"Polio O Treatment:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(34,10,$row['PolioOTreatment'],1);
           $pdf->ln();
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(35,10,"Other Treatment:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(50,10,$row['OtherTreatment'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(40,10,"Date of Next Visit:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(65,10,$row['DateNextVisit'],1);
         }
     }
      $pdf->ln();
      $pdf->ln();
      $pdf->ln();
      $pdf->ln();
     $pdf->SetFont('Helvetica','B',13);
     $pdf->Cell(190,15,"POSTNATAL FOLLOWUP VISIT",1,1,'C');
    //  $pdf->ln();
     $pdf->SetFont('Helvetica','B',13);
     $pdf->Cell(190,15,"Care of Mother",1,1,'C');
    //  $pdf->ln();
     //fetching data from the mother record table
     foreach ($pdo->query("SELECT * from postnatalsecondvisitcareofmother where MRID='$repID'") as $row)
      {
          if ($row) {
            //adding content to first row in the report
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(25,8,"Complaints:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(35,8,$row['Complaints'],1);
            $pdf->SetFont('Helvetica','',11);
            $pdf->Cell(25,8,"Temperature:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(25,8,$row['Temperature'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(10,8,"BP:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(25,8,$row['BP'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(20,8,"Jaundice:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(25,8,$row['Jaundice'],1);
            $pdf->ln();
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(15,10,"Pallor:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(15,10,$row['Pallor'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(15,10,"Pulse:",1);
            $pdf->SetFont('Helvetica','B',12);
            $pdf->Cell(15,10,$row['Pulse'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(38,10,"Breast And Nipple:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(20,10,$row['BreastAndNipple'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(45,10,"Abdomen Tendernes:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(27,10,$row['AbdomenTendernes'],1);
            $pdf->ln();
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(45,10,"Perineum And Lochia:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(20,10,$row['PerineumAndLochia'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(45,10,"Lower Limbs Calf Pain:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(20,10,$row['LowerLimbsCalfPain'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(25,10,"UterusSize:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(35,10,$row['UterusSize'],1);
            $pdf->ln();
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(20,10,"Swelling:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(20,10,$row['Swelling'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(23,10,"Treatment:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(25,10,$row['Treatment_VitA'],1);
            $pdf->Cell(25,10,$row['Treatment_Fefolate'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(10,10,"Hb:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(20,10,$row['LabTest_Hb'],1);
            $pdf->SetFont('Helvetica','',12);
            $pdf->Cell(12,10,"HIV:",1);
            $pdf->SetFont('Helvetica','B',11);
            $pdf->Cell(35,10,$row['LabTest_HIV'],1);
          }
      }
      $pdf->ln();
      // $pdf->ln();
      $pdf->SetFont('Helvetica','B',13);
      $pdf->Cell(190,15,"Care of Baby",1,1,'C');
      // $pdf->ln();
      //fetching data from the mother record table
      foreach ($pdo->query("SELECT * from  postnatalsecondvisitcareofbaby where MRID='$repID'") as $row)
       {
           if ($row) {
             //adding content to first row in the report
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(25,8,"Complaints:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(35,8,$row['Complaints'],1);
             $pdf->SetFont('Helvetica','',11);
             $pdf->Cell(28,8,"Breastfeeding:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(25,8,$row['Breastfeeding'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(28,8,"Temperature:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(15,8,$row['Temperature'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(23,8,"HeartRate:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(11,8,$row['HeartRate'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(15,10,"Pallor:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(15,10,$row['Pallor'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(20,10,"Jaundice:",1);
             $pdf->SetFont('Helvetica','B',12);
             $pdf->Cell(25,10,$row['Jaundice'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(17,10,"Activity:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['Activity'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(15,10,"Chest:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['Chest'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(22,10,"Abdomen:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(21,10,$row['Abdomen'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(15,10,"Limbs:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['Limbs'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(13,10,"Head:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['Head'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(23,10,"SpineBack:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['SpineBack'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(30,10,"UmblicalCord:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['UmblicalCord'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(12,10,"Skin:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(17,10,$row['Skin'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(30,10,"DischargeEyes:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['DischargeEyes'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(27,10,"PassingUrine:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['PassingUrine'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(28,10,"PassingStool:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(65,10,$row['PassingStool'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(43,10,"Vitamin K Treatment:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['VitKTreatment'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(35,10,"BCG Treatment:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['BCGTreatment'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(38,10,"Polio O Treatment:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(34,10,$row['PolioOTreatment'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(35,10,"Other Treatment:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(50,10,$row['OtherTreatment'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(40,10,"Date of Next Visit:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(65,10,$row['DateNextVisit'],1);
           }
       }

        $pdf->ln();
        $pdf->ln();
        $pdf->ln();
        $pdf->ln();

       $pdf->SetFont('Helvetica','B',13);
       $pdf->Cell(190,15,"POSTNATAL 6WEEKS VISIT",1,1,'C');
      //  $pdf->ln();
       $pdf->SetFont('Helvetica','B',13);
       $pdf->Cell(190,15,"Care of Mother",1,1,'C');
      //  $pdf->ln();
       //fetching data from the mother record table
       foreach ($pdo->query("SELECT * from postnatalsixweekscareofmother where MRID='$repID'") as $row)
       {
           if ($row) {
             //adding content to first row in the report
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(25,8,"Complaints:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(35,8,$row['Complaints'],1);
             $pdf->SetFont('Helvetica','',11);
             $pdf->Cell(25,8,"Temperature:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(25,8,$row['Temperature'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(10,8,"BP:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(25,8,$row['BP'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(20,8,"Jaundice:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(25,8,$row['Jaundice'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(15,10,"Pallor:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(15,10,$row['Pallor'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(15,10,"Pulse:",1);
             $pdf->SetFont('Helvetica','B',12);
             $pdf->Cell(15,10,$row['Pulse'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(38,10,"Breast And Nipple:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['BreastAndNipple'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(45,10,"Abdomen Tendernes:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(27,10,$row['AbdomenTendernes'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(45,10,"Perineum And Lochia:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['PerineumAndLochia'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(45,10,"Lower Limbs Calf Pain:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['LowerLimbsCalfPain'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(25,10,"UterusSize:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(35,10,$row['UterusSize'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(20,10,"Swelling:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['Swelling'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(23,10,"Treatment:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(25,10,$row['Treatment_VitA'],1);
             $pdf->Cell(25,10,$row['Treatment_Fefolate'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(10,10,"Hb:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(20,10,$row['LabTest_Hb'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(12,10,"HIV:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(35,10,$row['LabTest_HIV'],1);
           }
       }
       $pdf->ln();
      //  $pdf->ln();
       $pdf->SetFont('Helvetica','B',13);
       $pdf->Cell(190,15,"Care of Baby",1,1,'C');
      //  $pdf->ln();
       //fetching data from the mother record table
       foreach ($pdo->query("SELECT * from  postnatalsixweekscareofbaby where MRID='$repID'") as $row)
        {
            if ($row) {
              //adding content to first row in the report
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(25,8,"Complaints:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(35,8,$row['Complaints'],1);
              $pdf->SetFont('Helvetica','',11);
              $pdf->Cell(28,8,"Breastfeeding:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(25,8,$row['Breastfeeding'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(28,8,"Temperature:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(15,8,$row['Temperature'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(23,8,"HeartRate:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(11,8,$row['HeartRate'],1);
              $pdf->ln();
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(15,10,"Pallor:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(15,10,$row['Pallor'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(20,10,"Jaundice:",1);
              $pdf->SetFont('Helvetica','B',12);
              $pdf->Cell(25,10,$row['Jaundice'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(17,10,"Activity:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['Activity'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(15,10,"Chest:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['Chest'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(22,10,"Abdomen:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(22,10,$row['Abdomen'],1);
              $pdf->ln();
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(15,10,"Limbs:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['Limbs'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(13,10,"Head:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['Head'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(23,10,"SpineBack:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['SpineBack'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(30,10,"UmblicalCord:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['UmblicalCord'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(12,10,"Skin:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(18,10,$row['Skin'],1);
              $pdf->ln();
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(30,10,"DischargeEyes:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['DischargeEyes'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(27,10,"PassingUrine:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['PassingUrine'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(28,10,"PassingStool:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(66,10,$row['PassingStool'],1);
              $pdf->ln();
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(43,10,"Vitamin K Treatment:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['VitKTreatment'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(35,10,"BCG Treatment:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(20,10,$row['BCGTreatment'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(38,10,"Polio O Treatment:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(35,10,$row['PolioOTreatment'],1);
              $pdf->ln();
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(35,10,"Other Treatment:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(50,10,$row['OtherTreatment'],1);
              $pdf->SetFont('Helvetica','',12);
              $pdf->Cell(40,10,"Date of Next Visit:",1);
              $pdf->SetFont('Helvetica','B',11);
              $pdf->Cell(66,10,$row['DateNextVisit'],1);
            }
        }


 $pdf->Output('Summary_of_Labour_report');

 ?>
