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
 $pdf->Cell(190,5,"SUMMARY OF ANTENATAL REPORT",0,1,'C');
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

   //counting the total number of antenatal visits
   $query = "SELECT * from appointments where MRID='$repID' and  AppointmentService='Antenatal Service' and Status ='Reported'";
     $query_res = $pdo->query($query);
     $count = count($query_res->fetchAll());
     if ($count > 0) {
       foreach ($pdo->query("SELECT * from appointments where MRID='$repID' and  AppointmentService='Antenatal Service' and Status ='Reported'") as $row)
       {
         if ($row) {
           $int = array($row);
           @$totalVisits += count($int);

         }
       }
     }else {
       $totalVisits = 0;
     }
   $pdf->SetFont('Helvetica','',12);
   $pdf->Cell(33,9,"Antenatal Visits: ",0,0);
   $pdf->SetFont('Helvetica','B',12);
   $pdf->Cell(150,9,$totalVisits,0,0);
   $pdf->ln();
   $text ="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -";
   $pdf->SetFont('Helvetica','',8);
   $pdf->Cell(190,9,$text,0,0,'C');
   $pdf->ln();
   $pdf->SetFont('Helvetica','B',13);
   $pdf->Cell(190,15,"PHYSICAL EXAMINATION",1,1,'C');
  //  $pdf->ln();
   //fetching data from the mother record table
   foreach ($pdo->query("SELECT * from  physicalexaminationatfirstvisit where MRID='$repID'") as $row)
    {
        if ($row) {
          //adding content to first row in the report
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(17,10,"Weight:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(15,10,$row['Weight'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(15,10,"Height:",1);
          $pdf->SetFont('Helvetica','B',12);
          $pdf->Cell(20,10,$row['Height'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(10,10,"BP:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['BP'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(17,10,"Pulse:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(20,10,$row['Pulse'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(30,10,"Temperature:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(16,10,$row['Temperature'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,10,"General:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['General_Observation'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(23,10,"Face/Eye:",1);
          $pdf->SetFont('Helvetica','B',12);
          $pdf->Cell(30,10,$row['Face_Or_Eye'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(15,10,"Neck:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Neck'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(20,10,"Breast:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(22,10,$row['Breast'],1);
          $pdf->ln();

        }
    }
    // $pdf->ln();
    $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(190,15,"PELVIC EXAMINATION",1,1,'C');
    foreach ($pdo->query("SELECT * from  pelvicexamination where MRID='$repID'") as $row)
     {
         if ($row) {
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(20,10,"Vulva-",1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(20,10,"Ulcer:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['Ulcer'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(20,10,"Rashes:",1);
    $pdf->SetFont('Helvetica','B',12);
    $pdf->Cell(20,10,$row['Rashes'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(15,10,"Warts:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['Warts'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(25,10,"Perineum:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(30,10,$row['Perineum'],1);
    $pdf->ln();
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(20,10,"Vagina:",1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(20,10,"Dicharge:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['Discharge'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(55,10,"Position and Size of Uterus:",1);
    $pdf->SetFont('Helvetica','B',12);
    $pdf->Cell(20,10,$row['Position_Of_Uterus'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(15,10,"Cervix:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(40,10,$row['Cervix'],1);
    $pdf->ln();
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(22,10,"Adnexae:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['Adnexae'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(13,10,"GAIT:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['Gait'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(15,10,"C.N.S:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['CNS'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(15,10,"Heart:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(20,10,$row['Heart'],1);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(15,10,"Lungs:",1);
    $pdf->SetFont('Helvetica','B',11);
    $pdf->Cell(30,10,$row['Lungs'],1);
  }
}
// $pdf->ln();
$pdf->ln();
$pdf->SetFont('Helvetica','B',13);
$pdf->Cell(190,15,"MENSTRUAL HISTORY",1,1,'C');
// $pdf->ln();
foreach ($pdo->query("SELECT * from  menstrualhistory where MRID='$repID'") as $row)
 {
     if ($row) {
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(40,10,"Duration of Menses:",1);
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(30,10,$row['Duration_Of_Menses'],1);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(70,10,"Number of Days Between Menses:",1);
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(50,10,$row['Number_Of_Days_Between_Menses'],1);
$pdf->ln();
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(45,10,"Last Menstral Period:",1);
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(60,10,$row['Last_Mestrual_Period'],1);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(55,10,"Expected Date of Delivery:",1);
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(30,10,$row['Expected_Date_Of_Delivery'],1);

  }

}
$pdf->ln();
// $pdf->ln();
$pdf->SetFont('Helvetica','B',13);
$pdf->Cell(190,15,"OBSTETRIC HISTORY",1,1,'C');
// $pdf->ln();
foreach ($pdo->query("SELECT * from  majorriskfactors where MRID='$repID'") as $row)
 {
     if ($row) {
       $sicklecell = $row['SickleCellDisease'];
     }

  }
  $pdf->SetFont('Helvetica','',12);
  $pdf->Cell(42,10,"Sickle Cell Diseases:",1);
  $pdf->SetFont('Helvetica','B',11);
  $pdf->Cell(10,10,@$sicklecell,1);
  foreach ($pdo->query("SELECT * from  obstetrichistory where MRID='$repID'") as $row)
   {
       if ($row) {
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(20,10,"Gravida:",1);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(10,10,$row['Gravida'],1);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(15,10,"Para:",1);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(10,10,$row['Para'],1);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(20,10,"Abortion:",1);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(10,10,$row['Abortion'],1);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(13,10,"Spont:",1);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(10,10,$row['Spont'],1);
         $pdf->SetFont('Helvetica','',12);
         $pdf->Cell(18,10,"Induced:",1);
         $pdf->SetFont('Helvetica','B',11);
         $pdf->Cell(12,10,$row['Induced'],1);

       }

    }
    $pdf->ln();
    $pdf->ln();
    $pdf->ln();
    $pdf->ln();
    $pdf->ln();

    $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(190,15,"PAST PREGNANCIES",1,1,'C');
    // $pdf->ln();
    foreach ($pdo->query("SELECT * from   pastpregnancy where MRID='$repID'") as $row)
     {
         if ($row) {
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(68,10,"Place of Delivery/Pregnancy Loss:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(50,10,$row['Place_Of_Delivery_Or_Loss'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(35,10,"Date of Delivery:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(37,10,$row['Date_Of_Delivery'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->ln();
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(35,10,"Mode of Delivery:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(30,10,$row['Mode_Of_Delivery'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(35,10,"Outcome of Birth:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(30,10,$row['Outcome_Of_Birth'],1);
           $pdf->SetFont('Helvetica','',12);
           $pdf->Cell(10,10,"Sex:",1);
           $pdf->SetFont('Helvetica','B',11);
           $pdf->Cell(50,10,$row['Sex'],1);
          $pdf->ln();
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(37,10,"Condition of Child:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(30,10,$row['Condition_Of_Child'],1);
          $pdf->SetFont('Helvetica','',12);
          $pdf->Cell(28,10,"Birth Weight:",1);
          $pdf->SetFont('Helvetica','B',11);
          $pdf->Cell(95,10,$row['Birth_Weight'],1);

         }

      }
      $pdf->ln();
      // $pdf->ln();
      $pdf->SetFont('Helvetica','B',13);
      $pdf->Cell(190,15,"BREASTFEEDING HISTORY",1,1,'C');
      // $pdf->ln();
      foreach ($pdo->query("SELECT * from breastfeedinghistory where MRID='$repID'") as $row)
       {
           if ($row)
           {
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(58,10,"Breastfeeding for Last Child:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(25,10,$row['Breastfeeding_for_the_Last_Child'],1);
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(53,10,"Duration of Breastfeeding:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(54,10,$row['Duration_Of_Breastfeeding'],1);
             $pdf->ln();
             $pdf->SetFont('Helvetica','',12);
             $pdf->Cell(78,10,"	Duration Of Exclusive Breastfeeding:",1);
             $pdf->SetFont('Helvetica','B',11);
             $pdf->Cell(112,10,$row['Duration_Of_Exclusive_Breastfeeding'],1);
           }
        }
        $pdf->ln();
        // $pdf->ln();
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(190,15,"MEDICAL HISTORY",1,1,'C');
        // $pdf->ln();
        foreach ($pdo->query("SELECT * from medicalandsurgicalhistory where MRID='$repID'") as $row)
         {
             if ($row)
             {
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(25,10,"Hypetension:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(10,10,$row['Hypertension'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(30,10,"Heart Disease:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(15,10,$row['HeartDisease'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(40,10,"Sickel Cell Disease:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(10,10,$row['SickleCell'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(20,10,"Diabetes:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(10,10,$row['Diabetes'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(20,10,"Jaundice:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(10,10,$row['Jaundice'],1);
               $pdf->ln();
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(40,10,"Respiratory Disease:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(20,10,$row['RespiratoryDisease'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(57,10,"TB, Chronic Cough, Asthma:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(15,10,$row['TB_Asthma_Chronic'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(28,10,"HIV Disease:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(30,10,$row['HIVDisease'],1);
               $pdf->ln();
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(20,10,"Epilepsy:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(20,10,$row['Epilepsy'],1);
               $pdf->SetFont('Helvetica','',12);
               $pdf->Cell(30,10,"Mental Illness:",1);
               $pdf->SetFont('Helvetica','B',11);
               $pdf->Cell(120,10,$row['Mental_Illness'],1);
             }
         }

         $pdf->ln();
        //  $pdf->ln();
         $pdf->SetFont('Helvetica','B',13);
         $pdf->Cell(190,15,"HISTORY OF SEXUALLY TRANSMITTED INFECTIONS",1,1,'C');
        //  $pdf->ln();
         foreach ($pdo->query("SELECT * from sexuallytransmittedinfectionhistory where MRID='$repID'") as $row)
          {
              if ($row)
              {
                $pdf->SetFont('Helvetica','',12);
                $pdf->Cell(62,10,"Chronic Lower Abdominal Pain:",1);
                $pdf->SetFont('Helvetica','B',11);
                $pdf->Cell(30,10,$row['Chronic_Lower_Abdomen_Pain'],1);
                $pdf->SetFont('Helvetica','',12);
                $pdf->Cell(60,10,"Genital Lumps/Growth(Wart):",1);
                $pdf->SetFont('Helvetica','B',11);
                $pdf->Cell(38,10,$row['Genital_Lumps_Or_Growth'],1);
                $pdf->ln();
                $pdf->SetFont('Helvetica','',12);
                $pdf->Cell(105,10,"Itching / Burning Sensation /  Swelling of the Genitals:",1);
                $pdf->SetFont('Helvetica','B',11);
                $pdf->Cell(20,10,$row['Itching_Burning_Sensation_Or_Swelling'],1);
                $pdf->SetFont('Helvetica','',12);
                $pdf->Cell(30,10,"Genital Sores:",1);
                $pdf->SetFont('Helvetica','B',11);
                $pdf->Cell(35,10,$row['Genital_Sores'],1);
                $pdf->ln();
                $pdf->SetFont('Helvetica','',12);
                $pdf->Cell(75,10,"Abnormal Vagina / Urethral Discharge:",1);
                $pdf->SetFont('Helvetica','B',11);
                $pdf->Cell(20,10,$row['Abnormal_Vaginal_Or_Urethral_Discharge'],1);
                $pdf->SetFont('Helvetica','',12);
                $pdf->Cell(38,10,"Painful Urination:",1);
                $pdf->SetFont('Helvetica','B',11);
                $pdf->Cell(57,10,$row['Painful_Urination'],1);

              }
          }

          $pdf->ln();
          // $pdf->ln();
          $pdf->SetFont('Helvetica','B',13);
          $pdf->Cell(190,15,"ANTENATAL PROGRESS RECORD",1,1,'C');
          // $pdf->ln();
          foreach ($pdo->query("SELECT * from antenatalprogressrecord where MRID='$repID'") as $row)
           {
               if ($row)
               {
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(25,10,"Weight(Kg):",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(20,10,$row['Weight'],1);
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(25,10,"BP(mmHg):",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(30,10,$row['BP'],1);
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(45,10,"Urine / Protein / Sugar:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(45,10,$row['Urine_Protein_Sugar'],1);
                 $pdf->ln();
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(50,10,"Gestation Age in Weeks:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(15,10,$row['Gestation_Age'],1);
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(30,10,"Fundal Height:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(20,10,$row['Fundal_Height'],1);
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(28,10,"Presentation:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(15,10,$row['Presentation'],1);
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(20,10,"Descent:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(12,10,$row['Descent'],1);
                 $pdf->ln();
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(10,10,"FH:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(20,10,$row['FH'],1);
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(80,10,"Supply of Iron / Folic Acid Tabs(Weeks):",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(80,10,$row['Supply_Of_Iron_Or_Folic'],1);
                 $pdf->ln();
                 $pdf->SetFont('Helvetica','',12);
                 $pdf->Cell(54,10,"Complaint and Treatment:",1);
                 $pdf->SetFont('Helvetica','B',11);
                 $pdf->Cell(136,10,$row['Complaint_Treatment'],1);

               }
           }

 $pdf->Output('Summary_of_Labour_report');

 ?>
