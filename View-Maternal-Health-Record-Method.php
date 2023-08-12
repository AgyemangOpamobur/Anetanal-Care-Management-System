<?php

try{
  $search = @trim(strtoupper($_POST['maternalHealth_search']));
  $getID = explode("C", $search);
  $actualId = $getID[1];
  foreach ($conn->query("SELECT * from mothersrecord where MRID='$actualId'") as $row)
  {
    if ($row) {
      $_SESSION['patID'] = $row['Patient_Number'];
      $_SESSION['fullname'] = $row['Full_Name'];
      foreach ($conn->query("SELECT * from progressnotescontinuationsheet where MRID='$actualId'") as $row)
      {
        if($row){
        $_SESSION['dateRecorded'] = $row['Date_Recorded'];
        if (empty($row['ProgressNotes'])) {
          $_SESSION['progress'] = "No Records";
        }else {
        $_SESSION['progress'] =$row['ProgressNotes'];
        }

          $bol= true;
      }else {
        $bol = false;
      }

      }

    }else{
      $bol = false;
    }
  }
  if ($bol) {

    header("location: View-Maternal-Health-Records.php");
  }else {
    header("location: View-Maternal-Health-Records-Search.php?iderror");
  }


}catch(Exception $e){

  header("location: View-Maternal-Health-Records-Search.php?Incorrect");
}



?>
