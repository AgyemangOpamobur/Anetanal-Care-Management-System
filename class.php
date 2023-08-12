<?php
include 'dbclass.php';

class Methods {
  private $conn;

  public function __construct()
  {
    $database = new connect();
    $db = $database->Connectdb();
    $this->conn = $db;
  }

  public function sign_in()
  {
    try{
      $staffid = trim($_POST['txtStaffId']);
      $pass = md5(trim($_POST['txtpass']));
      $captxt = trim($_POST['txtCaptcha']);
      $date = date("d-M-Y");
      $month = date("m");
      $year = date("Y");
      $time = date(' H:i ', strtotime('+17 hours'));

      $sp_pass = md5('opambour');
      $sp_id = 'superuser';

      $user = $staffid;
      switch ($user) {
        case 'superuser':
        //this code validate superuser
        if(($pass == $sp_pass) && ($staffid == $sp_id)) {
          if($_SESSION['secure'] == $captxt){
            $_SESSION['userName'] = "Agyemang Alex";
          //  $_SESSION['pas'] = $pas;
            $_SESSION['staffid'] = 'Super User';
            $_SESSION['status'] = 'Super User';
            $_SESSION['time'] = $time;
            try {
              //connecting to database
              $data = $this->conn->prepare("INSERT into userlogs (DateLogin,Month,Year,UserName,Staff_ID,TimeLogin,UserStatus,LogOutTime)
              values (:DateLogin,:Month,:Year,:UserName,:Staff_ID,:TimeLogin,:UserStatus,:LogOutTime)");
              $data->bindValue(':DateLogin',$date);
              $data->bindValue(':Month',$month);
              $data->bindValue(':Year',$year);
              $data->bindValue(':UserName','Agyemang Alex');
              $data->bindValue(':Staff_ID','Super User');
              $data->bindValue(':TimeLogin',$time);
              $data->bindValue(':UserStatus','Super User');
              $data->bindValue(':LogOutTime','');
              $data->execute();

              //destroying session password
              //unset($_SESSION['pas']);
              header("Location: superuser.php?");
            }catch (Exception $ex) {
              // $_SESSION['database_error'] = $ex->getMessage();
              header("Location: userportal.php?error");
            }

          }else {
            header("Location: userportal.php?code");
            exit;
          }
        }else {
          header("Location: userportal.php?error");
          exit;
        }
        break;
        default:
        $query = "SELECT * from registration WHERE staff_id='$staffid'";
        $query_res = $this->conn->query($query);
        $count = count($query_res->fetchAll());
        if ($count > 0) {
        // if the user is not superuser this code will validate him
        if ($this->conn) {
          foreach ($this->conn->query("SELECT * from registration WHERE staff_id='$staffid'") as $row)
          {
            $st = $row['staff_id'];
            $pas = $row['password'];
            $fname = $row['firstName'];
            $lname = $row['secondName'];
            $access = $row['Access'];
            $stf = $row['staff_id'];
            $status = $row['status'];
            if( ($pas == $pass) && ($st == $staffid)) {
              if($_SESSION['secure'] == $captxt){
                //checking for users access level
                if ($access == "Active") {

                $_SESSION['userName'] = $fname." ".$lname;
                $_SESSION['staffid'] = $stf;
              //  $_SESSION['pas'] = $pas;
                $_SESSION['status'] = $status;
                $fulName = $fname." ".$lname;
                try {
                  //connecting to database
                  $data = $this->conn->prepare("INSERT into userlogs (DateLogin,Month,Year,UserName,Staff_ID,TimeLogin,UserStatus,LogOutTime)
                  values (:DateLogin,:Month,:Year,:UserName,:Staff_ID,:TimeLogin,:UserStatus,:LogOutTime)");
                  $data->bindValue(':DateLogin',$date);
                  $data->bindValue(':Month',$month);
                  $data->bindValue(':Year',$year);
                  $data->bindValue(':UserName',$fulName);
                  $data->bindValue(':Staff_ID',$stf);
                  $data->bindValue(':TimeLogin',$time);
                  $data->bindValue(':UserStatus',$status);
                  $data->bindValue(':LogOutTime','');
                  $data->execute();
                  if ($status == 'Nurse')
                  {
                    //destroying sesssion for password
                  //  unset($_SESSION['pas']);
                    header("Location: Nurse.php?");
                  }elseif ($status == 'Administrator') {
                    header("Location: Administrator.php?");
                  }elseif ($status == 'Midwife') {
                    header("Location: Midwife.php?");
                  }
                }catch (Exception $ex) {
                  $_SESSION['database_error'] = $ex->getMessage();
                  header("Location: userportal.php?dataerror");
                }
              }else {
                header("Location: userportal.php?accessblock");
              }

              }else {
                header("Location: userportal.php?code");
                exit;
              }
            }else {
              header("Location: userportal.php?error");
            }
          }
        }
      }else {
        header("Location: userportal.php?error");
      }
        break;
      }
    }catch (Exception $ex) {

      header("Location: userportal.php?error");
    }
  }

  public function sign_up()
  {
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    $fname = ucwords(strtolower(trim($_POST['txtFN'])));
    $lname = ucwords(strtolower(trim($_POST['txtLN'])));
    $staffID = trim($_POST['txtStaffid']);
    $pass1 = trim($_POST['txtpass1']);
    $pass2 = trim($_POST['txtpass2']);
    $contact = trim($_POST['txtContact']);
    $regCode = trim($_POST['txtRegCode']);
    $email = trim($_POST['txtEmail']);

    global $check;
    global $status;

//getting the registration code of the user
     $query = "SELECT * from registration WHERE regCode='$regCode'";
      $query_res = $this->conn->query($query);
      $count = count($query_res->fetchAll());
      if ($count > 0)
      {
        foreach ($this->conn->query("SELECT * from registration WHERE regCode='$regCode'") as $row)
        {
          $registCode= $row['regCode'];
          $regCodeLog = $row['regCodeLog'];
          $staffid = $row['staff_id'];
          $status = $row['status'];
            if($pass1 === $pass2)
            {
              if ($regCodeLog > 0) {
                header("Location: Signup.php?regexpired");
              }else {
                if ($staffid == $staffID) {

                  //getting user name that exist on the registration code table
                  $query = "SELECT * from registrationcode WHERE FirstName='$fname' and LastName='$lname'";
                   $query_res = $this->conn->query($query);
                   $count = count($query_res->fetchAll());
                   if ($count > 0)
                   {
                     //checking if the contact is the same
                     $query ="SELECT * from registrationcode WHERE contact='$contact'";
                      $query_res = $this->conn->query($query);
                      $count = count($query_res->fetchAll());
                      if ($count > 0)
                      {
                        $check = true;

                      }else {
                        header("Location: Signup.php?contacterror");

                      }

                   }else {
                     header("Location: Signup.php?nameerror");
                   }


                }else {
                  header("Location: Signup.php?stafferror");
                }
              }
            }else {
              header("Location: Signup.php?pass");
            //  exit();
            }
        }


      }else {
        header("Location: Signup.php?regcode");
      }

    if ($check) {
      $pass = md5($pass1);
      $regCodeLog = $regCodeLog + 1;
      $sql = "UPDATE registration SET SignUpDate='$date',	Month='$month',Year='$year', firstName='$fname', secondName='$lname',staff_id='$staffID',password='$pass',contact='$contact',email='$email',regCodeLog='$regCodeLog',Access='Active' WHERE regCode='$regCode' ";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $_SESSION['firstName'] = $fname;
      $_SESSION['secondName'] = $lname;
      $_SESSION['staffid'] = $staffID;
      $_SESSION['contact'] = $contact;
      $_SESSION['usertype'] = $status;
      $_SESSION['registrationCode'] = $registCode;
      $_SESSION['email'] = $email;

      header("location: SignUpSuccess.php");
    }
  }
//method to reset user password
public function Reset_Password()
{
  $fname = strtolower(trim($_POST['txtFN']));
  $lname = strtolower(trim($_POST['txtLN']));
  $staffID = trim($_POST['txtStaffid']);
  $pass1 = md5(trim($_POST['txtpass1']));
  $pass2 = md5(trim($_POST['txtpass2']));
  $regCode = trim($_POST['txtRegCode']);


  $query = "SELECT * from registration WHERE staff_id='$staffID'";
    $query_res = $this->conn->query($query);
    $count = count($query_res->fetchAll());
    if ($count > 0) {
      foreach ($this->conn->query("SELECT * from registration WHERE staff_id='$staffID'") as $row)
      {
        $registCode= $row['regCode'];
        $firstName = strtolower($row['firstName']);
        $secondName = strtolower($row['secondName']);
        $Access = $row['Access'];
        if ($regCode === $registCode) {
          if (($firstName == $fname) && ($secondName == $lname)) {
            if($pass1 === $pass2){
              if ($Access == "Active") {
                $sql = "UPDATE registration SET password='$pass1' WHERE staff_id='$staffID' ";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                header("Location: Account-Reset.php?success");

              }else {
                header("Location: Account-Reset.php?accessblock");
              }
            }else {
              header("Location: Account-Reset.php?passerror");
            }
          }else {
            header("Location: Account-Reset.php?nameerror");
          }

        }else {
          header("Location: Account-Reset.php?regcodeerror");
        }
      }
    }else {
      header("Location: Account-Reset.php?staffiderror");
    }
}


//method to generate registration code for any user
  public function GenerateRegCode()
  {
    $fname = ucwords(strtolower(trim($_POST['txtFN'])));
    $lname = ucwords(strtolower(trim($_POST['txtLN'])));
    $date = date("d-M-Y");
    $staffID = trim($_POST['txtStaffid']);
    $contact = trim($_POST['txtContact']);
    $captxt = trim($_POST['txtCaptcha']);
    $status = trim($_POST['txtStatus']);
    //validating captcha
    if($_SESSION['secure'] == $captxt){
      try {
        //connecting to database
        $data = $this->conn->prepare("INSERT into registrationcode (RegDate,staff_id,FirstName,LastName,contact,regCode,status)
        values (:RegDate,:staff_id,:FirstName,:LastName,:contact,:regCode,:status)");
        $regCode = rand(10000000, 99999999);
        $data->bindValue(':RegDate',$date);
        $data->bindValue(':staff_id',$staffID);
        $data->bindValue(':FirstName',$fname);
        $data->bindValue(':LastName',$lname);
        $data->bindValue(':contact', $contact);
        $data->bindValue(':regCode', $regCode);
        $data->bindValue(':status', $status);
        $data->execute();
        // writing data into SESSION
        $_SESSION['firstName'] = $fname;
        $_SESSION['secondName'] = $lname;
        $_SESSION['staffid'] = $staffID;
        $_SESSION['regCode'] = $regCode;
        $_SESSION['contact'] = $contact;
        $_SESSION['usertype'] = $status;
        //inserting into table registration
        $data2 = $this->conn->prepare("INSERT into registration(SignUpDate,Month,Year,firstName,secondName,staff_id,password,contact,email,regCode,status,regCodeLog,Access)
        values (:SignUpDate,:Month,:Year,:firstName,:secondName,:staff_id,:password,:contact,:email,:regCode,:status,:regCodeLog,:Access)");
        $data2->bindValue(':SignUpDate','');
        $data2->bindValue(':Month',0);
        $data2->bindValue(':Year',0);
        $data2->bindValue(':firstName','');
        $data2->bindValue(':secondName','');
        $data2->bindValue(':staff_id',$staffID);
        $data2->bindValue(':password','');
        $data2->bindValue(':contact','');
        $data2->bindValue(':email','');
        $data2->bindValue(':regCode',$regCode);
        $data2->bindValue(':status',$status);
        $data2->bindValue(':regCodeLog',0);
        $data2->bindValue(':Access','');
        $data2->execute();
        header("Location: RegCodeSuccess.php?");

      }catch (Exception $ex) {
        $_SESSION['database_error'] = $ex->getMessage();
        header("Location: generateRegCode.php?dataerror");
      }
    }else {
      header("Location: generateRegCode.php?code");
      exit;
    }

  }

//method to generate patient id automatically
  public function patient_id()
  {
    global $motherId;
    foreach ($this->conn->query("SELECT * from mothersrecord ") as $row)
    {
      //if the column is empty then assign 1 as the first id
      if(empty($row['MRID']))
      {
        $motherId = 1;

      }else{
        $motherId= $row['MRID'];
        $motherId += 1;
      }

    }
    return $motherId;
  }

//method to handle taking of records of patient's personal details
  public function Patient_personal_infomation()
  {
    $fname = ucwords(strtolower(trim($_POST['fn'])));
    @$midname = ucwords(strtolower(trim($_POST['mn'])));
    $lname = ucwords(strtolower(trim($_POST['ln'])));
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    $patientID = $_SESSION['patientID'];

    $date_of_birth = trim($_POST['dob']);
    //calculating patient's age
    $getYear = explode("-", $date_of_birth);
    $year = (int)$getYear[0];
    $currentYear = (int) date("Y");
    $age = $currentYear - $year;

    @$edu_status = trim($_POST['edu_status']);
    @$marital_status = trim($_POST['marital_status']);
    $occupation = trim($_POST['occupation']);
    $contact = trim($_POST['contact']);
    $houseNumber = trim($_POST['houseNo']);
    $street = trim($_POST['street']);
    $location = trim($_POST['location']);
    $dateVisit = trim($_POST['fvisit']);
    $midwife = trim($_POST['midwife']);

    try {
      //connecting to database
      $data = $this->conn->prepare("INSERT into mothersrecord (Date_Of_Registration,Month,Year,Patient_Number,FirstName,MiddleName,LastName,Full_Name,Age,DateOfBirth,EducationalStatus,MarritalStatus,Occupation,Telephone,HouseNumber,StreetName,Location,Date_Of_First_Visit,Name_Of_Midwife_Or_Doctor)
      values (:Date_Of_Registration,:Month,:Year,:Patient_Number,:FirstName,:MiddleName,:LastName,:Full_Name,:Age,:DateOfBirth,:EducationalStatus,:MarritalStatus,:Occupation,:Telephone,:HouseNumber,:StreetName,:Location,:Date_Of_First_Visit,:Name_Of_Midwife_Or_Doctor)");

      $fullName = $fname." ".$midname." ".$lname;
      $data->bindValue(':Date_Of_Registration',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':Patient_Number',$patientID);
      $data->bindValue(':FirstName',$fname);
      $data->bindValue(':MiddleName',$midname);
      $data->bindValue(':LastName',$lname);
      $data->bindValue(':Full_Name',$fullName);
      $data->bindValue(':Age',$age);
      $data->bindValue(':DateOfBirth', $date_of_birth);
      $data->bindValue(':EducationalStatus', $edu_status);
      $data->bindValue(':MarritalStatus', $marital_status);
      $data->bindValue(':Occupation', $occupation);
      $data->bindValue(':Telephone', $contact);
      $data->bindValue(':HouseNumber', $houseNumber);
      $data->bindValue(':StreetName', $street);
      $data->bindValue(':Location', $location);
      $data->bindValue(':Date_Of_First_Visit', $dateVisit);
      $data->bindValue(':Name_Of_Midwife_Or_Doctor', $midwife);

      $data->execute();
      header("Location: Register.php?success");

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();

      header("Location: Register.php?dataerror");
    }


  }

//method to handle paterns record
  public function Partner_Information()
  {
//declaring variables
    $fname = ucwords(strtolower(trim($_POST['fn2'])));
    $midname = ucwords(strtolower(trim($_POST['mn2'])));
    $lname = ucwords(strtolower(trim($_POST['ln2'])));
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    $pId = $_SESSION['partnerID'];
    $getID = explode("C", $pId);
    $actualId = $getID[1];
    $MRID = $actualId;
    $age = trim($_POST['age2']);
    @$edu_status = trim($_POST['edu_status2']);
    @$marital_status = trim($_POST['marital_status2']);
    $occupation = trim($_POST['occupation2']);
    $contact = trim($_POST['contact2']);
    $houseNumber = trim($_POST['houseNo2']);
    $street = trim($_POST['street2']);
    $location = trim($_POST['location2']);

    try {
      //connecting to database
      $data = $this->conn->prepare("INSERT into partnersrecord (Date_Of_Registration,Month,Year,MRID,FirstName	,MiddleName,LastName,Full_Name,Age,EducationalStatus,MarritalStatus,Occupation,Telephone,HouseNumber,StreetName,Location)
      values (:Date_Of_Registration,:Month,:Year,:MRID,:FirstName,:MiddleName,:LastName,:Full_Name,:Age,:EducationalStatus,:MarritalStatus,:Occupation,:Telephone,:HouseNumber,:StreetName,:Location)");

      $fullName = $fname." ".$midname." ".$lname;
//binding the parameters to the fields in the database
      $data->bindValue(':Date_Of_Registration',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$MRID);
      $data->bindValue(':FirstName',$fname);
      $data->bindValue(':MiddleName',$midname);
      $data->bindValue(':LastName',$lname);
      $data->bindValue(':Full_Name',$fullName);
      $data->bindValue(':Age',$age);
      $data->bindValue(':EducationalStatus', $edu_status);
      $data->bindValue(':MarritalStatus', $marital_status);
      $data->bindValue(':Occupation', $occupation);
      $data->bindValue(':Telephone', $contact);
      $data->bindValue(':HouseNumber', $houseNumber);
      $data->bindValue(':StreetName', $street);
      $data->bindValue(':Location', $location);
      $data->execute();
      header("Location: Register2.php?success");

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
      //echo "Error! failed to insert into the database table :".$e->getMessage();
      header("Location: Register2.php?dataerror");
    }

  }

//getting the number of emergency consultation
public function CountEmergencyCounsultation()
{
  $query = "SELECT * from emergencyconsultation where status ='Not Yet'";
//  order by date_taken DESC
                foreach ($this->conn->query($query) as $row)
                {

                if($row)
                {
                    $int = array($row);
                    @$value += count($int);
                }else {
                  $value = 0;
                  exit();
                }
              }
              return $value;
}
//getting the number of antenatal consultation
public function CountAntenatalCounsultation()
{
  $query = "SELECT * from appointments where status ='Not Yet'";
//  order by date_taken DESC
                foreach ($this->conn->query($query) as $row)
                {

                if($row)
                {
                    $int = array($row);
                    @$value += count($int);
                }else {
                  $value = 0;
                  exit();
                }
              }
              return $value;
}
//method to handle scheduling appointment for a client or patient
  public function appointment()
  {

    $pId = trim($_POST['apId']);
    $fullname = trim($_POST['afullname']);
    $age = trim($_POST['aage']);
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    $dob = trim($_POST['adob']);
    @$appointment = trim($_POST['appointment']);
    $contact = trim($_POST['acontact']);

    $getID = explode("C", $pId);
    $actualId = $getID[1];

    try {
      //connecting to database
      $data = $this->conn->prepare("INSERT into appointments (Today,Month,Year,Mother_Id,MRID,Name,Scheduled_Date,AppointmentService,Telephone,Date_Reported,Status)
      values (:Today,:Month,:Year,:Mother_Id,:MRID,:Name,:Scheduled_Date,:AppointmentService,:Telephone,:Date_Reported,:Status)");

      $data->bindValue(':Today', $date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':Mother_Id', $pId);
      $data->bindValue(':MRID', $actualId);
      $data->bindValue(':Name', $fullname);
      $data->bindValue(':Scheduled_Date', $dob);
      $data->bindValue(':AppointmentService', $appointment);
      $data->bindValue(':Telephone', $contact);
      $data->bindValue(':Date_Reported','');
      $data->bindValue(':Status', 'Not Yet');

      $data->execute();
      header("Location: Attendance.php?success");

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
      header("Location: Attendance.php?dataerror");
    }


  }
//this method handle patients who request for free antenatal care services
  public function Emergency_counsultation()
  {
    $fname = ucwords(strtolower(trim($_POST['fname'])));
    $lname = ucwords(strtolower(trim($_POST['lname'])));
    $contact = trim($_POST['contact']);
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $time = date(' H:i ', strtotime('+17 hours'));

    try {
      //connecting to database
      $data = $this->conn->prepare("INSERT into emergencyconsultation(DateReceived,Time_Received,Month,Year,FirstName,LastName,Contact,Subject,Message,Status,Date_Consulted)
      values (:DateReceived,:Time_Received,:Month,:Year,:FirstName,:LastName,:Contact,:Subject,:Message,:Status,:Date_Consulted)");

      $data->bindValue(':DateReceived', $date);
      $data->bindValue(':Time_Received', $time);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':FirstName', $fname);
      $data->bindValue(':LastName', $lname);
      $data->bindValue(':Contact', $contact);
      $data->bindValue(':Subject', $subject);
      $data->bindValue(':Message', $message);
      $data->bindValue(':Status','Not Yet');
      $data->bindValue(':Date_Consulted','');
      $data->execute();

      //calling emergency sms reply method
     $text="your message is delivered. A Nurse or Midwife will contact you shortly or call 0302459879. Thank you.";
      $this->EmergencySMSReply($fname,$contact,$text);

      echo "<script> alert('Your complain is delivered. A Nurse or Midwife will contact you shortly via SMS or VOIP. Thanks you for contacting us.'); window.location.href='index.php';</script>";
    ;

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
      header("Location: index.php?dataerror");
    }

  }

//method that handle patien's antenatal history
  public function Antenatal_History()
  {
     @$Mens_days= trim($_POST['Duration_menses']);
     $Duration_menses = $Mens_days." Days";
     @$Days_between= trim($_POST['Days_Between_Mens']);
     $Days_Between_Mens = $Days_between." Days";
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    @$Last_Mens_Period = trim($_POST['Last_Mens_Period']);
    @$Expected_Date = trim($_POST['Expected_Date']);
    @$Weeks_Of_Pregnancy = trim($_POST['Weeks_Of_Pregnancy']);
    @$Grand_Parity = trim($_POST['Grand_Parity']);
    @$Previous_CS = trim($_POST['Previous_CS']);
    @$Previous_PPH = trim($_POST['Previous_PPH']);
    @$Myomectomy = trim($_POST['Myomectomy']);
    @$sickle_cell = trim($_POST['sickle_cell']);
    @$Other = trim($_POST[' Other']);
    @$Gravida = trim($_POST['Gravida']);
    @$Para = trim($_POST['Para']);
    @$abortion = trim($_POST['abortion']);
    @$spont = trim($_POST['spont']);
    @$induced = trim($_POST['induced']);
    @$Place_OF_Delivery = trim($_POST['Place_OF_Delivery']);
    $Delivery_Date = trim($_POST['Delivery_Date']);
    @$Pregnancy_Problem = trim($_POST['Pregnancy_Problem']);
    @$Delivery_Mode = trim($_POST['Delivery_Mode']);
    @$birth_outcome = trim($_POST['birth_outcome']);
    @$sex = trim($_POST['sex']);
    @$birth_Condition = trim($_POST['birth_Condition']);
    @$B_weight = trim($_POST['Birth_Weight']);
    @$Birth_Weight = $B_weight." Kg";
    @$Labour_Complication = trim($_POST['Labour_Complication']);
    @$Last_Breastfeeding = trim($_POST['Last_Breastfeeding']);
    @$Exclusive = trim($_POST['Exclusive_Feeding']);
    $Exclusive_Feeding = $Exclusive." Months";
    @$Duration = trim($_POST['Duration_Breastfeeding']);
    $Duration_Breastfeeding = $Duration." Years";
    //getting patient ID
    $pID = $_SESSION['patID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

    try {
      //connecting to database
      //inserting into first table
      $data = $this->conn->prepare("INSERT into menstrualhistory(Date_Taken_MenstrualHistory,Month,Year,MRID,Duration_Of_Menses,Number_Of_Days_Between_Menses,Last_Mestrual_Period,Expected_Date_Of_Delivery,Number_Of_Pregnancy_At_Booking)
      values (:Date_Taken_MenstrualHistory,:Month,:Year,:MRID,:Duration_Of_Menses,:Number_Of_Days_Between_Menses,:Last_Mestrual_Period,:Expected_Date_Of_Delivery,:Number_Of_Pregnancy_At_Booking)");

      $data->bindValue(':Date_Taken_MenstrualHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Duration_Of_Menses',$Duration_menses);
      $data->bindValue(':Number_Of_Days_Between_Menses',$Days_Between_Mens);
      $data->bindValue(':Last_Mestrual_Period',$Last_Mens_Period);
      $data->bindValue(':Expected_Date_Of_Delivery',$Expected_Date);
      $data->bindValue(':Number_Of_Pregnancy_At_Booking',$Weeks_Of_Pregnancy);
      $data->execute();

      //inserting into second table
      $data = $this->conn->prepare("INSERT into majorriskfactors(Date_Taken_MajorRiskFactor,Month,Year,MRID,GrandMultiparity,PreviousCS,PreviousPPH,Myomectomy,SickleCellDisease,Others)
      values (:Date_Taken_MajorRiskFactor,:Month,:Year,:MRID,:GrandMultiparity,:PreviousCS,:PreviousPPH,:Myomectomy,:SickleCellDisease,:Others)");

      $data->bindValue(':Date_Taken_MajorRiskFactor',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':GrandMultiparity',$Grand_Parity);
      $data->bindValue(':PreviousCS',$Previous_CS);
      $data->bindValue(':PreviousPPH',$Previous_PPH);
      $data->bindValue(':Myomectomy',$Myomectomy);
      $data->bindValue(':SickleCellDisease',$sickle_cell);
      $data->bindValue(':Others',$Other);
      $data->execute();

      //inserting data into third table
      $data = $this->conn->prepare("INSERT into obstetrichistory(Date_Taken_ObstetricHistory,Month,Year,MRID,Gravida,Para,Abortion,Spont,Induced)
      values (:Date_Taken_ObstetricHistory,:Month,:Year,:MRID,:Gravida,:Para,:Abortion,:Spont,:Induced)");

      $data->bindValue(':Date_Taken_ObstetricHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Gravida',$Gravida);
      $data->bindValue(':Para',$Para);
      $data->bindValue(':Abortion',$abortion);
      $data->bindValue(':Spont',$spont);
      $data->bindValue(':Induced',$induced);
      $data->execute();

      //inserting data into fourth table
      $data = $this->conn->prepare("INSERT into pastpregnancy(Date_Of_Entry,Month,Year,MRID,Place_Of_Delivery_Or_Loss,Date_Of_Delivery,Problem_During_Pregnancy,Mode_Of_Delivery,Outcome_Of_Birth,Sex,Labour_Complications,Condition_Of_Child,Birth_Weight)
      values (:Date_Of_Entry,:Month,:Year,:MRID,:Place_Of_Delivery_Or_Loss,:Date_Of_Delivery,:Problem_During_Pregnancy,:Mode_Of_Delivery,:Outcome_Of_Birth,:Sex,:Labour_Complications,:Condition_Of_Child,:Birth_Weight)");

      $data->bindValue(':Date_Of_Entry',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Place_Of_Delivery_Or_Loss',$Place_OF_Delivery);
      $data->bindValue(':Date_Of_Delivery',$Delivery_Date);
      $data->bindValue(':Problem_During_Pregnancy',$Pregnancy_Problem);
      $data->bindValue(':Mode_Of_Delivery',$Delivery_Mode);
      $data->bindValue(':Outcome_Of_Birth',$birth_outcome);
      $data->bindValue(':Sex',$sex);
      $data->bindValue(':Labour_Complications',$Labour_Complication);
      $data->bindValue(':Condition_Of_Child',$birth_Condition);
      $data->bindValue(':Birth_Weight',$Birth_Weight);
      $data->execute();

      //inserting data into five table
      $data = $this->conn->prepare("INSERT into breastfeedinghistory(Date_Taken_BreastfeedingHistory,Month,Year,MRID,Breastfeeding_for_the_Last_Child,Duration_Of_Exclusive_Breastfeeding,Duration_Of_Breastfeeding)
      values (:Date_Taken_BreastfeedingHistory,:Month,:Year,:MRID,:Breastfeeding_for_the_Last_Child,:Duration_Of_Exclusive_Breastfeeding,:Duration_Of_Breastfeeding)");

      $data->bindValue(':Date_Taken_BreastfeedingHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Breastfeeding_for_the_Last_Child',$Last_Breastfeeding);
      $data->bindValue(':Duration_Of_Exclusive_Breastfeeding',$Exclusive_Feeding);
      $data->bindValue(':Duration_Of_Breastfeeding',$Duration_Breastfeeding);
      $data->execute();

      header("Location: History.php?success");

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
      header("Location: History.php?dataerror");
    }

  }
//method to handle second antenatl history records
  public function Antenatal_History2()
  {
    //declaring varibales
    @$hypertension = trim($_POST['hypertension']);
    @$heart_disease = trim($_POST['heart_disease']);
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    @$Medical_sickle_disease= trim($_POST['Medical_sickle_disease']);
    @$jaundice = trim($_POST['jaundice']);
    @$diabetes = trim($_POST['diabetes']);
    @$Respiratory_disease = trim($_POST['Respiratory_disease']);
    @$TB_Chronic = trim($_POST['TB_Chronic']);
    @$Hiv_disease = trim($_POST['Hiv_disease']);
    @$Epilepsy = trim($_POST['Epilepsy']);
    @$Mental_illness = trim($_POST['Mental_illness']);
    @$Other2 = trim($_POST['Other2']);
    @$Previous_Operation = trim($_POST['Previous_Operation']);
    @$Family_hypertension = trim($_POST['Family_hypertension']);
    @$Family_diabetes = trim($_POST['Family_diabetes']);
    @$Heart_disease = trim($_POST['Heart_disease']);
    @$Sickle_disease = trim($_POST['Sickle_disease']);
    @$Multiple_pregnancies = trim($_POST['Multiple_pregnancies']);
    @$Family_Mental_health = trim($_POST['Family_Mental_health']);
    @$Birth_defects = trim($_POST['Birth_defects']);
    @$Drug_history_text = trim($_POST['Drug_history_text']);
    @$Drug_history_selection = trim($_POST['Drug_history_selection']);
    @$Allergies_text = trim($_POST['Allergies_text']);
    @$Allergies_history = trim($_POST['Allergies_history']);
    @$Contraceptive_text = trim($_POST['Contraceptive_text']);
    @$Contraceptive_selection = trim($_POST['Contraceptive_selection']);
    @$Contraceptive_Discontinue_date = trim($_POST['Contraceptive_Discontinue_date']);
    @$Chronic_pain = trim($_POST['Chronic_pain']);
    @$Itching_pain = trim($_POST['Itching_pain']);
    @$Abnormal_pain = trim($_POST['Abnormal_pain']);
    @$Genital_sores = trim($_POST['Genital_sores']);
    @$Urinal_pain = trim($_POST['Urinal_pain']);
    @$Genital_pain = trim($_POST['Genital_pain']);
    //getting patient ID
    $pID = $_SESSION['patID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

    try {
      //connecting to database
      //inserting into first table
      $data = $this->conn->prepare("INSERT into medicalandsurgicalhistory(Date_Taken_MedicalandSurgicalHistory,Month,Year,MRID,Hypertension,HeartDisease,SickleCell,Diabetes,RespiratoryDisease,TB_Asthma_Chronic,HIVDisease,Epilepsy,Mental_Illness,Jaundice,Others,Previous_Operation)
      values (:Date_Taken_MedicalandSurgicalHistory,:Month,:Year,:MRID,:Hypertension,:HeartDisease,:SickleCell,:Diabetes,:RespiratoryDisease,:TB_Asthma_Chronic,:HIVDisease,:Epilepsy,:Mental_Illness,:Jaundice,:Others,:Previous_Operation)");

      $data->bindValue(':Date_Taken_MedicalandSurgicalHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Hypertension',$hypertension);
      $data->bindValue(':HeartDisease',$heart_disease);
      $data->bindValue(':SickleCell',$Medical_sickle_disease);
      $data->bindValue(':Diabetes',$diabetes);
      $data->bindValue(':RespiratoryDisease',$Respiratory_disease);
      $data->bindValue(':TB_Asthma_Chronic',$TB_Chronic);
      $data->bindValue(':HIVDisease',$Hiv_disease);
      $data->bindValue(':Epilepsy',$Epilepsy);
      $data->bindValue(':Mental_Illness',$Mental_illness);
      $data->bindValue(':Jaundice',$jaundice );
      $data->bindValue(':Others',$Other2);
      $data->bindValue('Previous_Operation',$Previous_Operation);
      $data->execute();

      //inserting into second table
      $data = $this->conn->prepare("INSERT into familyhistory(Date_Taken_FamilyHistory,Month,Year,MRID,Hypertension,Diabetes,Heart_Disease,Sickle_Cell,Multiple_Pregnancy,Mental_Health,Birth_Deffect)
      values (:Date_Taken_FamilyHistory,:Month,:Year,:MRID,:Hypertension,:Diabetes,:Heart_Disease,:Sickle_Cell,:Multiple_Pregnancy,:Mental_Health,:Birth_Deffect)");

      $data->bindValue(':Date_Taken_FamilyHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Hypertension',$Family_hypertension);
      $data->bindValue(':Diabetes',$Family_diabetes);
      $data->bindValue(':Heart_Disease',$Heart_disease);
      $data->bindValue(':Sickle_Cell',  $Sickle_disease);
      $data->bindValue(':Multiple_Pregnancy',$Multiple_pregnancies);
      $data->bindValue(':Mental_Health',$Family_Mental_health);
      $data->bindValue(':Birth_Deffect',$Birth_defects);
      $data->execute();

      //inserting data into third table
      $data = $this->conn->prepare("INSERT into drughistory(Date_Take_DrugHistory,Month,Year,MRID,Drug_Usage,Details_Of_Drug,Presence_Of_Allergy,Details_Of_Allergy)
      values (:Date_Take_DrugHistory,:Month,:Year,:MRID,:Drug_Usage,:Details_Of_Drug,:Presence_Of_Allergy,:Details_Of_Allergy)");

      $data->bindValue(':Date_Take_DrugHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Drug_Usage',$Drug_history_selection);
      $data->bindValue(':Details_Of_Drug',$Drug_history_text);
      $data->bindValue(':Presence_Of_Allergy',$Allergies_history);
      $data->bindValue(':Details_Of_Allergy',$Allergies_text);
      $data->execute();

      //inserting data into fourth table
      $data = $this->conn->prepare("INSERT into contraceptivehistory(Date_Taken_ContraceptiveHistory,Month,Year,MRID,Any_Contraceptive_Used_Prior_To_Pregnancy,If_Yes_Name_Of_Contraceptive,Date_Discontinued)
      values (:Date_Taken_ContraceptiveHistory,:Month,:Year,:MRID,:Any_Contraceptive_Used_Prior_To_Pregnancy,:If_Yes_Name_Of_Contraceptive,:Date_Discontinued)");

      $data->bindValue(':Date_Taken_ContraceptiveHistory',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Any_Contraceptive_Used_Prior_To_Pregnancy',$Contraceptive_selection);
      $data->bindValue(':If_Yes_Name_Of_Contraceptive',$Contraceptive_text);
      $data->bindValue(':Date_Discontinued',$Contraceptive_Discontinue_date);
      $data->execute();

      //inserting data into five table
      $data = $this->conn->prepare("INSERT into sexuallytransmittedinfectionhistory(Date_Taken_STI_History,Month,Year,MRID,Chronic_Lower_Abdomen_Pain,Itching_Burning_Sensation_Or_Swelling,Abnormal_Vaginal_Or_Urethral_Discharge,Genital_Sores,Painful_Urination,Genital_Lumps_Or_Growth)
      values (:Date_Taken_STI_History,:Month,:Year,:MRID,:Chronic_Lower_Abdomen_Pain,:Itching_Burning_Sensation_Or_Swelling,:Abnormal_Vaginal_Or_Urethral_Discharge,:Genital_Sores,:Painful_Urination,:Genital_Lumps_Or_Growth)");

      $data->bindValue(':Date_Taken_STI_History',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Chronic_Lower_Abdomen_Pain',$Chronic_pain);
      $data->bindValue(':Itching_Burning_Sensation_Or_Swelling',$Itching_pain);
      $data->bindValue(':Abnormal_Vaginal_Or_Urethral_Discharge',$Abnormal_pain);
      $data->bindValue(':Genital_Sores',$Genital_sores);
      $data->bindValue(':Painful_Urination',$Urinal_pain);
      $data->bindValue(':Genital_Lumps_Or_Growth',$Genital_pain);
      $data->execute();

      header("Location: History-Form2.php?success");

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
      header("Location: History-Form2.php?dataerror");
    }

  }

//method to delete a row from user log table
    public function Delete_Row($id)
    {
      $sql= "DELETE FROM userlogs WHERE userlogs.ULID = '$id'";
      $data = $this->conn->prepare($sql);
      if($data->execute())
       {
           header("location: View-User-Logs?Deleted");
        }

    }
//method to update patient's attendance records
    public function Update_Attendance($id)
    {

      try{
        $date = date("d-M-Y");
        $sql = $this->conn->prepare("UPDATE appointments SET Date_Reported='$date',Status='Reported' WHERE AID='$id'");
        $sql->execute();
        header("Location: View-Appointment.php?updatesucess");
        }catch (Exception $ex) {
          $_SESSION['database_error'] = $ex->getMessage();
         header("Location: View-Appointment.php?dataerror");
        }

    }
    //method to block users account
        public function BlockUser($id)
        {

          try{
            $sql = $this->conn->prepare("UPDATE registration SET Access='Block' WHERE user_id='$id'");
            $sql->execute();
            header("Location: Block-Or-Unblock-User.php?userblocked");
            }catch (Exception $ex) {
              $_SESSION['database_error'] = $ex->getMessage();
             header("Location: Block-Or-Unblock-User.php?dataerror");
            }
        }
        //method to unblock users account
            public function UnBlockUser($id)
            {

              try{
                $sql = $this->conn->prepare("UPDATE registration SET Access='Active' WHERE user_id='$id'");
                $sql->execute();
                header("Location: Block-Or-Unblock-User.php?useractive");
                }catch (Exception $ex) {
                  $_SESSION['database_error'] = $ex->getMessage();
                 header("Location: Block-Or-Unblock-User.php?dataerror");
                }

            }


    //method to update patient's attendance records
        public function Update_Attendance_Notification($id)
        {

          try{
            $date = date("d-M-Y");
            $sql = $this->conn->prepare("UPDATE appointments SET Date_Reported='$date',Status='Reported' WHERE AID='$id'");
            $sql->execute();
            header("Location: View-Appointment-notification.php?updatesucess");
            }catch (Exception $ex) {
              $_SESSION['database_error'] = $ex->getMessage();
             header("Location: View-Appointment-notification.php?dataerror");
            }
        }

//method to update emergency consultation table
    public function Update_Emergency_Consultation($id)
    {

      try{
        $date = date("d-M-Y");
        $sql = $this->conn->prepare("UPDATE emergencyconsultation SET Date_Consulted='$date',Status='Service Delivered' WHERE FID='$id' ");
        $sql->execute();
        header("Location: View-Emergency-Consultation.php?updatesucess");
        }catch (Exception $ex) {
          $_SESSION['database_error'] = $ex->getMessage();
         header("Location: View-Emergency-Consultation.php?dataerror");
        }

    }

//method to update antenatl history records
    public function Antenatal_History_Update1()
    {
      $Mens_days= $this->validateRecord(trim($_POST['Duration_menses']));
      $Duration_menses = $Mens_days;
      $Days_between= $this->validateRecord(trim($_POST['Days_Between_Mens']));
      $Days_Between_Mens = $Days_between;
     $Last_Mens_Period = $this->validateRecord(trim($_POST['Last_Mens_Period']));
     $Expected_Date = $this->validateRecord(trim($_POST['Expected_Date']));
     $Weeks_Of_Pregnancy = $this->validateRecord(trim($_POST['Weeks_Of_Pregnancy']));
     $Grand_Parity =$this->validateRecord( trim($_POST['Grand_Parity']));
     $Previous_CS = $this->validateRecord(trim($_POST['Previous_CS']));
     $Previous_PPH = $this->validateRecord(trim($_POST['Previous_PPH']));
     $Myomectomy = $this->validateRecord(trim($_POST['Myomectomy']));
     $sickle_cell = $this->validateRecord(trim($_POST['sickle_cell']));
     $Other = $this->validateRecord(trim($_POST['Other']));
     $Gravida = $this->validateRecord(trim($_POST['Gravida']));
     $Para = $this->validateRecord(trim($_POST['Para']));
     $abortion = $this->validateRecord(trim($_POST['abortion']));
     $spont = $this->validateRecord(trim($_POST['spont']));
     $induced = $this->validateRecord(trim($_POST['induced']));
     $Place_OF_Delivery = $this->validateRecord(trim($_POST['Place_OF_Delivery']));
     $Delivery_Date = trim($_POST['Delivery_Date']);
     $Pregnancy_Problem = $this->validateRecord(trim($_POST['Pregnancy_Problem']));
     $Delivery_Mode = $this->validateRecord(trim($_POST['Delivery_Mode']));
     $birth_outcome = $this->validateRecord(trim($_POST['birth_outcome']));
     $sex = $this->validateRecord(trim($_POST['sex']));
     $birth_Condition = $this->validateRecord(trim($_POST['birth_Condition']));
     $B_weight = $this->validateRecord(trim($_POST['Birth_Weight']));
     $Birth_Weight = $B_weight;
     $Labour_Complication = $this->validateRecord(trim($_POST['Labour_Complication']));
     $Last_Breastfeeding = $this->validateRecord(trim($_POST['Last_Breastfeeding']));
     $Exclusive = $this->validateRecord(trim($_POST['Exclusive_Feeding']));
     $Exclusive_Feeding = $Exclusive;
     $Duration = $this->validateRecord(trim($_POST['Duration_Breastfeeding']));
     $Duration_Breastfeeding = $Duration;
     //getting patient ID
     $pID = $_SESSION['patID'];
     $getID = explode("C", $pID);
     $actualId = $getID[1];
      try{
     $sql = $this->conn->prepare("UPDATE menstrualhistory SET Duration_Of_Menses='$Duration_menses',Number_Of_Days_Between_Menses='$Days_Between_Mens',Last_Mestrual_Period='$Last_Mens_Period',Expected_Date_Of_Delivery='$Expected_Date',Number_Of_Pregnancy_At_Booking='$Weeks_Of_Pregnancy'  WHERE MRID='$actualId' ");
     $sql->execute();

     $sql = $this->conn->prepare("UPDATE majorriskfactors SET GrandMultiparity='$Grand_Parity',PreviousCS='$Previous_CS',PreviousPPH='$Previous_PPH',Myomectomy='$Myomectomy',SickleCellDisease='$sickle_cell',Others='$Other' WHERE MRID='$actualId'");
     $sql->execute();

     $sql = $this->conn->prepare("UPDATE obstetrichistory SET Gravida='$Gravida',Para='$Para',Abortion='$abortion',Spont='$spont',Induced='$induced' WHERE MRID='$actualId'");
     $sql->execute();

     $sql = $this->conn->prepare("UPDATE pastpregnancy SET Place_Of_Delivery_Or_Loss='$Place_OF_Delivery',Date_Of_Delivery='$Delivery_Date',Problem_During_Pregnancy='$Pregnancy_Problem',Mode_Of_Delivery='$Delivery_Mode',Outcome_Of_Birth ='$birth_outcome',Sex='$sex',Labour_Complications='$Labour_Complication',Condition_Of_Child ='$birth_Condition',Birth_Weight='$Birth_Weight' WHERE MRID='$actualId'");
     $sql->execute();

     $sql = $this->conn->prepare("UPDATE breastfeedinghistory SET Breastfeeding_for_the_Last_Child='$Last_Breastfeeding',Duration_Of_Exclusive_Breastfeeding='$Exclusive_Feeding',Duration_Of_Breastfeeding='$Duration_Breastfeeding' WHERE MRID='$actualId'");
     $sql->execute();

     header("Location: View-History1.php?success");
    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
     header("Location: View-History1.php?dataerror");
    }
}

//method to update antenatal record history second part
public function Antenatal_History_Update2()
{
  $hypertension = $this->validateRecord(trim($_POST['hypertension']));
  $heart_disease = $this->validateRecord(trim($_POST['heart_disease']));
//  $date = date("d-M-Y");
  $Medical_sickle_disease= $this->validateRecord(trim($_POST['Medical_sickle_disease']));
  $diabetes = $this->validateRecord(trim($_POST['diabetes']));
  $jaundice = $this->validateRecord(trim($_POST['jaundice']));
  $Respiratory_disease = $this->validateRecord(trim($_POST['Respiratory_disease']));
  $TB_Chronic = $this->validateRecord(trim($_POST['TB_Chronic']));
  $Hiv_disease = $this->validateRecord(trim($_POST['Hiv_disease']));
  $Epilepsy = $this->validateRecord(trim($_POST['Epilepsy']));
  $Mental_illness = $this->validateRecord(trim($_POST['Mental_illness']));
  $Other2 = $this->validateRecord(trim($_POST['Other2']));
  $Previous_Operation = $this->validateRecord(trim($_POST['Previous_Operation']));

  $Family_hypertension = $this->validateRecord(trim($_POST['Family_hypertension']));
  $Family_diabetes = $this->validateRecord(trim($_POST['Family_diabetes']));
  $Heart_disease = $this->validateRecord(trim($_POST['Heart_disease']));
  $Sickle_disease = $this->validateRecord(trim($_POST['Sickle_disease']));
  $Multiple_pregnancies = $this->validateRecord(trim($_POST['Multiple_pregnancies']));
  $Family_Mental_health = $this->validateRecord(trim($_POST['Family_Mental_health']));
  $Birth_defects = $this->validateRecord(trim($_POST['Birth_defects']));
  $Drug_history_text = $this->validateRecord(trim($_POST['Drug_history_text']));
  $Drug_history_selection = $this->validateRecord(trim($_POST['Drug_history_selection']));
  $Allergies_text = $this->validateRecord(trim($_POST['Allergies_text']));
  $Allergies_history = $this->validateRecord(trim($_POST['Allergies_history']));
  $Contraceptive_text = $this->validateRecord(trim($_POST['Contraceptive_text']));
  $Contraceptive_selection = $this->validateRecord(trim($_POST['Contraceptive_selection']));
  $Contraceptive_Discontinue_date = trim($_POST['Contraceptive_Discontinue_date']);
  $Chronic_pain = $this->validateRecord(trim($_POST['Chronic_pain']));
  $Itching_pain = $this->validateRecord(trim($_POST['Itching_pain']));
  $Abnormal_pain = $this->validateRecord(trim($_POST['Abnormal_pain']));
  $Genital_sores = $this->validateRecord(trim($_POST['Genital_sores']));
  $Urinal_pain = $this->validateRecord(trim($_POST['Urinal_pain']));
  $Genital_pain = $this->validateRecord(trim($_POST['Genital_pain']));

  $pID = $_SESSION['patID'];
  $getID = explode("C", $pID);
  $actualId = $getID[1];

  try{

    $sql = $this->conn->prepare("UPDATE medicalandsurgicalhistory SET Hypertension='$hypertension',HeartDisease='$heart_disease',SickleCell='$Medical_sickle_disease',Diabetes='$diabetes',RespiratoryDisease='$Respiratory_disease',TB_Asthma_Chronic='$TB_Chronic',HIVDisease='$Hiv_disease',Epilepsy='$Epilepsy',Mental_Illness='$Mental_illness',Jaundice='$jaundice',Others='$Other2',Previous_Operation='$Previous_Operation' WHERE MRID='$actualId'");
    $sql->execute();

    $sql = $this->conn->prepare("UPDATE familyhistory SET Hypertension='$Family_hypertension',Diabetes='$Family_diabetes',Heart_Disease='$Heart_disease',Sickle_Cell='$Sickle_disease',Multiple_Pregnancy = '$Multiple_pregnancies',Mental_Health='$Family_Mental_health',Birth_Deffect='$Birth_defects' WHERE MRID='$actualId'");
    $sql->execute();

    $sql = $this->conn->prepare("UPDATE drughistory SET Drug_Usage='$Drug_history_selection',Details_Of_Drug='$Drug_history_text',Presence_Of_Allergy='$Allergies_history',Details_Of_Allergy='$Allergies_text' WHERE MRID='$actualId'");
    $sql->execute();

    $sql = $this->conn->prepare("UPDATE contraceptivehistory SET Any_Contraceptive_Used_Prior_To_Pregnancy='$Contraceptive_selection',If_Yes_Name_Of_Contraceptive='$Contraceptive_text',Date_Discontinued='$Contraceptive_Discontinue_date' WHERE MRID='$actualId'");
    $sql->execute();

    $sql = $this->conn->prepare("UPDATE sexuallytransmittedinfectionhistory SET Chronic_Lower_Abdomen_Pain='$Chronic_pain',Itching_Burning_Sensation_Or_Swelling='$Itching_pain',Abnormal_Vaginal_Or_Urethral_Discharge='$Abnormal_pain',Genital_Sores='$Genital_sores',Painful_Urination = '$Urinal_pain',Genital_Lumps_Or_Growth='$Genital_pain' WHERE MRID='$actualId'");
    $sql->execute();

    header("Location: View-History2.php?success");
  }catch (Exception $ex) {
    $_SESSION['database_error'] = $ex->getMessage();
   header("Location: View-History2.php?dataerror");
  }

}
//method to handle physical examination
public function Physical_Examination()
{
  @$height= trim($_POST['height']);
  $height2 = $height." m";
  @$weight= trim($_POST['weight']);
  $weight2 = $weight." kg";
  @$bp = trim($_POST['bp']);
  $bp2 = $bp." mmHg";
 @$pulse = trim($_POST['pulse']);
 $pulse2 = $pulse." bpm";
 @$temperature = trim($_POST['temperature']);
 $temperature2 = $temperature." oC";
 @$general = trim($_POST['general']);
 @$face = trim($_POST['face']);
 @$neck = trim($_POST['neck']);
 @$breast = trim($_POST['breast']);
 @$spleen = trim($_POST['spleen']);
 @$liver = trim($_POST['liver']);
 @$other_masses = trim($_POST['other_masses']);
 @$scars = trim($_POST['scars']);
 @$ulcer = trim($_POST['ulcer']);
 @$rashes = trim($_POST['rashes']);
 @$warts = trim($_POST['warts']);
 @$rashes = trim($_POST['rashes']);
 @$perineum = trim($_POST['perineum']);
 @$discharge = trim($_POST['discharge']);
 @$Position_Uterus = trim($_POST['Position_Uterus']);
 @$cervix = trim($_POST['cervix']);
 @$Adnexae = trim($_POST['Adnexae']);
 @$gait = trim($_POST['gait']);
 @$CNS = trim($_POST['CNS']);
 @$heart = trim($_POST['heart']);
 @$lungs = trim($_POST['lungs']);
 $date = date("d-M-Y");
 $month = date("m");
 $year = date("Y");
 $pID = $_SESSION['patID'];
 $getID = explode("C", $pID);
 $actualId = $getID[1];

try {
      //inserting data into the first table
  $data = $this->conn->prepare("INSERT into physicalexaminationatfirstvisit(Date_Taken_PhysicalExam,Month,Year,MRID,Weight,Height,BP,Pulse,Temperature,General_Observation,Face_Or_Eye,Neck,Breast)values (:Date_Taken_PhysicalExam,:Month,:Year,:MRID,:Weight,:Height,:BP,:Pulse,:Temperature,:General_Observation,:Face_Or_Eye,:Neck,:Breast)");

  $data->bindValue(':Date_Taken_PhysicalExam',$date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':MRID',$actualId);
  $data->bindValue(':Weight',$weight2);
  $data->bindValue(':Height',$height2);
  $data->bindValue(':BP',$bp2);
  $data->bindValue(':Pulse',$pulse2);
  $data->bindValue(':Temperature',$temperature2);
  $data->bindValue(':General_Observation',$general);
  $data->bindValue(':Face_Or_Eye',$face);
  $data->bindValue(':Neck',$neck);
  $data->bindValue(':Breast',$breast);
  $data->execute();

//inserting data into the second table

//$data->bindValue(':Date_Taken_AbdominalExamination',$date);
$data = $this->conn->prepare("INSERT into abdominalobstetricexamination(Date_Taken_AbdominalExamination,Month,Year,MRID,Spleen,Liver,Other_Masses,Scars)values (:Date_Taken_AbdominalExamination,:Month,:Year,:MRID,:Spleen,:Liver,:Other_Masses,:Scars)");

$data->bindValue(':Date_Taken_AbdominalExamination',$date);
$data->bindValue(':Month',$month);
$data->bindValue(':Year',$year);
$data->bindValue(':MRID',$actualId);
$data->bindValue(':Spleen',$spleen);
$data->bindValue(':Liver',$liver);
$data->bindValue(':Other_Masses',$other_masses);
$data->bindValue(':Scars',$scars);
$data->execute();

//inserting into the third table in physical history
$data = $this->conn->prepare("INSERT into pelvicexamination(Date_Taken_PelvicExamination,Month,Year,MRID,Ulcer,Rashes,Warts,Perineum,Discharge,Position_Of_Uterus,Cervix,Adnexae,Gait,CNS,Heart,Lungs)values(:Date_Taken_PelvicExamination,:Month,:Year,:MRID,:Ulcer,:Rashes,:Warts,:Perineum,:Discharge,:Position_Of_Uterus,:Cervix,:Adnexae,:Gait,:CNS,:Heart,:Lungs)");

$data->bindValue(':Date_Taken_PelvicExamination',$date);
$data->bindValue(':Month',$month);
$data->bindValue(':Year',$year);
$data->bindValue(':MRID',$actualId);
$data->bindValue(':Ulcer',$ulcer);
$data->bindValue(':Rashes',$rashes);
$data->bindValue(':Warts',$warts);
$data->bindValue(':Perineum',$perineum);
$data->bindValue(':Discharge',$discharge);
$data->bindValue(':Position_Of_Uterus',$Position_Uterus);
$data->bindValue(':Cervix',$cervix);
$data->bindValue(':Position_Of_Uterus',$scars);
$data->bindValue(':Adnexae',$Adnexae);
$data->bindValue(':Gait',$gait);
$data->bindValue(':CNS',$CNS);
$data->bindValue(':Heart',$heart);
$data->bindValue(':Lungs',$lungs);

$data->execute();

header("Location: Examination-history.php?success");

}catch (Exception $ex) {
  $_SESSION['database_error'] = $ex->getMessage();
  header("Location: Examination-history.php?dataerror");
}

}

//method to update physical examination of patient second part
public function Physical_Examination_Update()
{
  $height= $this->validateRecord(trim($_POST['height']));
  $weight= $this->validateRecord(trim($_POST['weight']));
  $bp = $this->validateRecord(trim($_POST['bp']));
 $pulse = $this->validateRecord(trim($_POST['pulse']));
 $temperature = $this->validateRecord(trim($_POST['temperature']));
 $general = $this->validateRecord(trim($_POST['general']));
 $face = $this->validateRecord(trim($_POST['face']));
 $neck = $this->validateRecord(trim($_POST['neck']));
 $breast = $this->validateRecord(trim($_POST['breast']));
 $spleen = $this->validateRecord(trim($_POST['spleen']));
 $liver = $this->validateRecord(trim($_POST['liver']));
 $other_masses = $this->validateRecord(trim($_POST['other_masses']));
 $scars = $this->validateRecord(trim($_POST['scars']));
 $ulcer = $this->validateRecord(trim($_POST['ulcer']));
 $rashes = $this->validateRecord(trim($_POST['rashes']));
 $warts = $this->validateRecord(trim($_POST['warts']));
 $rashes = $this->validateRecord(trim($_POST['rashes']));
 $perineum = $this->validateRecord(trim($_POST['perineum']));
 $discharge = $this->validateRecord(trim($_POST['discharge']));
 $Position_Uterus = $this->validateRecord(trim($_POST['Position_Uterus']));
 $cervix = $this->validateRecord(trim($_POST['cervix']));
 $Adnexae = $this->validateRecord(trim($_POST['Adnexae']));
 $gait = $this->validateRecord(trim($_POST['gait']));
 $CNS = $this->validateRecord(trim($_POST['CNS']));
 $heart = $this->validateRecord(trim($_POST['heart']));
 $lungs = $this->validateRecord(trim($_POST['lungs']));

 $pID = $_SESSION['patID'];
 $getID = explode("C", $pID);
 $actualId = $getID[1];


 try{

   //updating records in physical examination table
   $sql = $this->conn->prepare("UPDATE physicalexaminationatfirstvisit SET Weight='$weight',Height='$height',BP='$bp',Pulse='$pulse',Temperature='$temperature',General_Observation='$general',Face_Or_Eye='$face',Neck='$neck',Breast='$breast' WHERE MRID='$actualId'");
   $sql->execute();

   //updating records in the abdominalobstetricexamination table
   $sql = $this->conn->prepare("UPDATE abdominalobstetricexamination SET Spleen='$spleen',Liver='$liver',Other_Masses='$other_masses',Scars=' $scars' WHERE MRID='$actualId'");
   $sql->execute();

   //updating records in pelvic table`
   $sql = $this->conn->prepare("UPDATE pelvicexamination SET Ulcer='$ulcer',Rashes='$rashes',Warts='$warts',Perineum='$perineum',Discharge='$discharge',Position_Of_Uterus='$Position_Uterus',Cervix='$cervix',Adnexae='$Adnexae',Gait='$gait',CNS='$CNS',Heart='$heart',Lungs='$lungs' WHERE MRID='$actualId'");
   $sql->execute();


   header("Location: View-Examination-history.php?success");
 }catch (Exception $ex) {
   $_SESSION['database_error'] = $ex->getMessage();
  header("Location: View-Examination-history.php?dataerror");
 }


}
//method to handle antenatal investigation records
public function Investigations()
{
  @$haemoglobinResult= trim($_POST['haemoglobin']);
  $haemoglobinDate= trim($_POST['haemoglobindate']);
  $haemoglobinRepeatDate= trim($_POST['repeathbdate']);
  @$haemoglobinRepeat= trim($_POST['repeathb']);
  @$rhesusfactorResult= trim($_POST['rhesusfactor']);
  $rhesusfactorDate= trim($_POST['rhesusfactordate']);
  @$bloodgroupResult= trim($_POST['bloodgroup']);
  $bloodgroupDate= trim($_POST['bloodgroupdate']);
  @$sicklingtestResult= trim($_POST['sicklingtest']);
  $sicklingtestResultDate= trim($_POST['sicklingtestdate']);
  $bf= trim($_POST['bf']);
  $bfDate= trim($_POST['bfdate']);
 @$upttestResult = trim($_POST['upttest']);
 $upttestDate = trim($_POST['upttestdate']);
 @$vdrlResult = trim($_POST['vdrl']);
 $vdrlDate = trim($_POST['vdrldate']);
 @$hbsagResult = trim($_POST['hbsag']);
 $hbsagDate = trim($_POST['hbsagdate']);
 @$hivResult = trim($_POST['hiv']);
 $hivResultDate = trim($_POST['hivdate']);
 @$hivResultRepeat = trim($_POST['repeathiv']);
 $hivResultRepeatDate = trim($_POST['repeathivdate']);
 @$stoolreResult = trim($_POST['stoolre']);
 $stoolreDate = trim($_POST['stoolredate']);
 @$urinereResult = trim($_POST['urinere']);
 $urinereDate = trim($_POST['urineredate']);
 // declaring variables for other Investigations
  @$gestationResult = trim($_POST['gestation']);
  $gestationDate = trim($_POST['gestationdate']);
  @$placentaResult = trim($_POST['placenta']);
  $placentaDate = trim($_POST['placenatdate']);
  @$liquorResult = trim($_POST['liquor']);
  $liquorDate = trim($_POST['liquordate']);
  @$expectedDateResult = trim($_POST['edd']);
  $expectedDate = trim($_POST['edddate']);
  @$otherDesc = trim($_POST['othersDesc']);
  @$otherResult = trim($_POST['othersResult']);
  $otherDate = trim($_POST['othersdate']);

 $date = date("d-M-Y");
 $month = date("m");
 $year = date("Y");
 $pID = $_SESSION['patID'];
 $getID = explode("C", $pID);
 $actualId = $getID[1];

try {
      //inserting data into the first table
  $data = $this->conn->prepare("INSERT into  investigation(Date_Taken_Investigation,Month,Year,MRID,Haemoglobin,Date_Of_HaemoglobinTest,Sickling_Test,	Date_Of_SicklingTest,Hb_Repeat,Date_Of_HbRepeat,Blood_Group,Date_Of_BloodGroupTest,Rhesus_Factor,Date_Of_RhesusFatorTest,BloodFlow,Date_Of_BloodFlow,VDRL_Or_PRP,Date_Of_VDRLTest,HBsAg,Date_Of_HBsAgTest,HIV_Test,	Date_Of_HIVstatusTest,Repeat_HIV,Date_Of_RepeatHivTest,Stool_RE,	Date_Of_StoolReTest,Urine_RE,Date_Of_UrineReTest,UrinePregnancyTest, 	Date_UrinePregnancyTest)values( :Date_Taken_Investigation,:Month,:Year,:MRID,:Haemoglobin,
    :Date_Of_HaemoglobinTest,:Sickling_Test,:Date_Of_SicklingTest,:Hb_Repeat,:Date_Of_HbRepeat,:Blood_Group,:Date_Of_BloodGroupTest,:Rhesus_Factor,
    :Date_Of_RhesusFatorTest,:BloodFlow,:Date_Of_BloodFlow,:VDRL_Or_PRP,:Date_Of_VDRLTest,:HBsAg,:Date_Of_HBsAgTest,:HIV_Test,:Date_Of_HIVstatusTest,:Repeat_HIV,:Date_Of_RepeatHivTest,:Stool_RE,	:Date_Of_StoolReTest,:Urine_RE,:Date_Of_UrineReTest,:UrinePregnancyTest, 	:Date_UrinePregnancyTest)");

  $data->bindValue(':Date_Taken_Investigation',$date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':MRID',$actualId);
  $data->bindValue(':Haemoglobin',$haemoglobinResult);
  $data->bindValue(':Date_Of_HaemoglobinTest',$haemoglobinDate);
  $data->bindValue(':Sickling_Test',$sicklingtestResult);
  $data->bindValue(':Date_Of_SicklingTest',$sicklingtestResultDate);
  $data->bindValue(':Hb_Repeat',$haemoglobinRepeat);
  $data->bindValue(':Date_Of_HbRepeat',$haemoglobinRepeatDate);
  $data->bindValue(':Blood_Group',$bloodgroupResult);
  $data->bindValue(':Date_Of_BloodGroupTest',$bloodgroupDate);
  $data->bindValue(':Rhesus_Factor',$rhesusfactorResult);
  $data->bindValue(':Date_Of_RhesusFatorTest',$rhesusfactorDate);
  $data->bindValue(':BloodFlow',$bf);
  $data->bindValue(':Date_Of_BloodFlow',$bfDate);
  $data->bindValue(':VDRL_Or_PRP',$vdrlResult);
  $data->bindValue(':Date_Of_VDRLTest',$vdrlDate);
  $data->bindValue(':HBsAg',$hbsagResult);
  $data->bindValue(':Date_Of_HBsAgTest',$hbsagDate);
  $data->bindValue(':HIV_Test',$hivResult);
  $data->bindValue(':Date_Of_HIVstatusTest',$hivResultDate);
  $data->bindValue(':Repeat_HIV',$hivResultRepeat);
  $data->bindValue(':Date_Of_RepeatHivTest',$hivResultRepeatDate);
  $data->bindValue(':Stool_RE',$stoolreResult);
  $data->bindValue(':Date_Of_StoolReTest',$stoolreDate);
  $data->bindValue(':Urine_RE',$urinereResult);
  $data->bindValue(':Date_Of_UrineReTest',$urinereDate);
  $data->bindValue(':UrinePregnancyTest',$upttestResult);
  $data->bindValue(':Date_UrinePregnancyTest',$upttestDate);
  $data->execute();

  $data = $this->conn->prepare("INSERT into otherinvestigation(	Date_Other_Investigation_Taken,Month,Year,MRID,Gestational_Age,Date_Of_GestationalAgeTest,Placental_Position,Date_Of_PlacentalPositionTest,Alcohol_Volume,Date_Of_AlcoholVolumeTest,Expected_Date,	Date_Of_EDDtest,Others_Description,Others_Result,	Date_Of_OtherTest)values (	:Date_Other_Investigation_Taken,:Month,:Year,:MRID,:Gestational_Age,:Date_Of_GestationalAgeTest,:Placental_Position,:Date_Of_PlacentalPositionTest,:Alcohol_Volume,:Date_Of_AlcoholVolumeTest,:Expected_Date,	:Date_Of_EDDtest,:Others_Description,:Others_Result,	:Date_Of_OtherTest)");

  $data->bindValue(':Date_Other_Investigation_Taken',$date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':MRID',$actualId);
  $data->bindValue(':Gestational_Age',$gestationResult);
  $data->bindValue(':Date_Of_GestationalAgeTest',$gestationDate);
  $data->bindValue(':Placental_Position',$placentaResult);
  $data->bindValue(':Date_Of_PlacentalPositionTest',$placentaDate);
  $data->bindValue(':Alcohol_Volume',$liquorResult);
  $data->bindValue(':Date_Of_AlcoholVolumeTest',$liquorDate);
  $data->bindValue(':Expected_Date',$expectedDateResult);
  $data->bindValue(':Date_Of_EDDtest',$expectedDate);
  $data->bindValue(':Others_Description',$otherDesc);
  $data->bindValue(':Others_Result',$otherResult);
  $data->bindValue(':Date_Of_OtherTest',$otherDate);
  $data->execute();

header("Location: Antenatal-Investigation.php?success");

}catch (Exception $ex) {
  $_SESSION['database_error'] = $ex->getMessage();
  header("Location: Antenatal-Investigation.php?dataerror");
}

}

//method to handle antenatal investigation records
public function Update_Investigations()
{
  $haemoglobinResult= $this->validateRecord(trim($_POST['haemoglobin']));
  $haemoglobinDate= trim($_POST['haemoglobindate']);
  $haemoglobinRepeatDate= trim($_POST['repeathbdate']);
  $haemoglobinRepeat=  $this->validateRecord(trim($_POST['repeathb']));
  $rhesusfactorResult=  $this->validateRecord(trim($_POST['rhesusfactor']));
  $rhesusfactorDate= trim($_POST['rhesusfactordate']);
  $bloodgroupResult=  $this->validateRecord(trim($_POST['bloodgroup']));
  $bloodgroupDate= trim($_POST['bloodgroupdate']);
  $sicklingtestResult=  $this->validateRecord(trim($_POST['sicklingtest']));
  $sicklingtestResultDate= trim($_POST['sicklingtestdate']);
  $bf=  $this->validateRecord(trim($_POST['bf']));
  $bfDate= trim($_POST['bfdate']);
 $upttestResult =  $this->validateRecord(trim($_POST['upttest']));
 $upttestDate = trim($_POST['upttestdate']);
 $vdrlResult =  $this->validateRecord(trim($_POST['vdrl']));
 $vdrlDate = trim($_POST['vdrldate']);
 $hbsagResult =  $this->validateRecord(trim($_POST['hbsag']));
 $hbsagDate = trim($_POST['hbsagdate']);
 $hivResult =  $this->validateRecord(trim($_POST['hiv']));
 $hivResultDate = trim($_POST['hivdate']);
 $hivResultRepeat =  $this->validateRecord(trim($_POST['repeathiv']));
 $hivResultRepeatDate = trim($_POST['repeathivdate']);
 $stoolreResult =  $this->validateRecord(trim($_POST['stoolre']));
 $stoolreDate = trim($_POST['stoolredate']);
 $urinereResult =  $this->validateRecord(trim($_POST['urinere']));
 $urinereDate = trim($_POST['urineredate']);
 // declaring variables for other Investigations
  $gestationResult =  $this->validateRecord(trim($_POST['gestation']));
  $gestationDate = trim($_POST['gestationdate']);
  $placentaResult =  $this->validateRecord(trim($_POST['placenta']));
  $placentaDate = trim($_POST['placenatdate']);
  $liquorResult =  $this->validateRecord(trim($_POST['liquor']));
  $liquorDate = trim($_POST['liquordate']);
  $expectedDateResult =  $this->validateRecord(trim($_POST['edd']));
  $expectedDate = trim($_POST['edddate']);
  $otherDesc =  $this->validateRecord(trim($_POST['othersDesc']));
  $otherResult =  $this->validateRecord(trim($_POST['othersResult']));
  $otherDate = trim($_POST['othersdate']);

 $date = date("d-M-Y");
 $month = date("m");
 $year = date("Y");
 $pID = $_SESSION['patID'];
 $getID = explode("C", $pID);
 $actualId = $getID[1];

 try{
   //updating records in other investigation records
   $sql = $this->conn->prepare("UPDATE investigation SET Haemoglobin='$haemoglobinResult',Date_Of_HaemoglobinTest='$haemoglobinDate',Sickling_Test='$sicklingtestResult',Date_Of_SicklingTest='$sicklingtestResultDate',Hb_Repeat='$haemoglobinRepeat',Date_Of_HbRepeat='$haemoglobinRepeatDate',Blood_Group ='$bloodgroupResult',Date_Of_BloodGroupTest='$bloodgroupDate',Rhesus_Factor='$rhesusfactorResult',Date_Of_RhesusFatorTest='$rhesusfactorDate',BloodFlow='$bf',Date_Of_BloodFlow='$bfDate',VDRL_Or_PRP='$vdrlResult',
     Date_Of_VDRLTest='$vdrlDate',HBsAg='$hbsagResult',Date_Of_HBsAgTest='$hbsagDate',HIV_Test='$hivResult',Date_Of_HIVstatusTest='$hivResultDate',Repeat_HIV='$hivResultRepeat',
     Date_Of_RepeatHivTest='$hivResultRepeatDate',Stool_RE='$stoolreResult',Date_Of_StoolReTest='$stoolreDate', Urine_RE='$urinereResult',Date_Of_UrineReTest='$urinereDate',UrinePregnancyTest='$upttestResult',Date_UrinePregnancyTest='$upttestDate'
      WHERE MRID='$actualId'");
   $sql->execute();

   //updating records in other investigation records
   $sql = $this->conn->prepare("UPDATE otherinvestigation SET Gestational_Age='$gestationResult',Date_Of_GestationalAgeTest='$gestationDate',Placental_Position='$placentaResult',Date_Of_PlacentalPositionTest='$placentaDate',Alcohol_Volume='$liquorResult',Date_Of_AlcoholVolumeTest='$liquorDate', Expected_Date ='$expectedDateResult',Date_Of_EDDtest='$expectedDate',Others_Description='$otherDesc',Others_Result='$otherResult',Date_Of_OtherTest='$otherDate' WHERE MRID='$actualId'");
   $sql->execute();


     header("Location: View-Antenatal-Investigation.php?success");
 }catch (Exception $ex) {
   $_SESSION['database_error'] = $ex->getMessage();
  header("Location: View-Antenatal-Investigation.php?dataerror");
 }
}

////method to handle antenatal progress records
public function AntenatalProgress()
{
  $dateVisited= trim($_POST['pdate']);
  @$weight= trim($_POST['pweight']);
  $bp= trim($_POST['pbp']);
  @$urineProtein= trim($_POST['purine']);
  @$gestationWeek= trim($_POST['pgestweek']);
  @$fundal= trim($_POST['pfundal']);
  @$pres= trim($_POST['ppres']);
  @$descent= trim($_POST['pdescent']);
  @$fh= trim($_POST['pfh']);
  @$ironFolicAcid= trim($_POST['piron']);
  @$complain= trim($_POST['pcomplain']);
  @$name= trim($_POST['pname']);

 $date = date("d-M-Y");
 $month = date("m");
 $year = date("Y");
 $pID = $_SESSION['patID'];
 $getID = explode("C", $pID);
 $actualId = $getID[1];

try {
      //inserting data into the first table
  $data = $this->conn->prepare("INSERT into  antenatalprogressrecord(Date_Recorded,Month,Year,	Date_Visited,MRID,Weight,BP,Urine_Protein_Sugar,	Gestation_Age,Fundal_Height,FH,Descent,	Presentation,Supply_Of_Iron_Or_Folic	,Complaint_Treatment,Name_Or_Signature)values(:Date_Recorded,:Month,:Year,	:Date_Visited,:MRID,:Weight,:BP,:Urine_Protein_Sugar,:Gestation_Age,	:Fundal_Height,:FH,:Descent,:Presentation,:Supply_Of_Iron_Or_Folic,:Complaint_Treatment,:Name_Or_Signature)");

  $data->bindValue(':Date_Recorded',$date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':Date_Visited',$dateVisited);
  $data->bindValue(':MRID',$actualId);
  $data->bindValue(':Weight',$weight);
  $data->bindValue(':BP',$bp);
  $data->bindValue(':Urine_Protein_Sugar',$urineProtein);
  $data->bindValue(':Gestation_Age',$gestationWeek);
  $data->bindValue(':Fundal_Height',$fundal);
  $data->bindValue(':FH',$fh);
  $data->bindValue(':Descent',$descent);
  $data->bindValue(':Presentation',$pres);
  $data->bindValue(':Supply_Of_Iron_Or_Folic',$ironFolicAcid);
  $data->bindValue(':Complaint_Treatment',$complain);
  $data->bindValue(':Name_Or_Signature',$name);
  $data->execute();

header("Location: Antenatal-Progress.php?success");

}catch (Exception $ex) {
  $_SESSION['database_error'] = $ex->getMessage();
  header("Location: Antenatal-Progress.php?dataerror");
}

}
//method to update antenatal progress records table
public function Update_AntenatalProgress()
{
  $dateVisited= $this->validateRecord(trim($_POST['pdate']));
  $weight= $this->validateRecord(trim($_POST['pweight']));
  $bp= $this->validateRecord(trim($_POST['pbp']));
  $urineProtein= $this->validateRecord(trim($_POST['purine']));
  $gestationWeek= $this->validateRecord(trim($_POST['pgestweek']));
  $fundal= $this->validateRecord(trim($_POST['pfundal']));
  $pres= $this->validateRecord(trim($_POST['ppres']));
  $descent= $this->validateRecord(trim($_POST['pdescent']));
  $fh= $this->validateRecord(trim($_POST['pfh']));
  $ironFolicAcid= $this->validateRecord(trim($_POST['piron']));
  $complain= $this->validateRecord(trim($_POST['pcomplain']));
  $name= $this->validateRecord(trim($_POST['pname']));

 $date = date("d-M-Y");
 $month = date("m");
 $year = date("Y");
 $pID = $_SESSION['patID'];
 $getID = explode("C", $pID);
 $actualId = $getID[1];

try {

  $sql = $this->conn->prepare("UPDATE antenatalprogressrecord SET Date_Visited='$dateVisited',Weight='$weight',BP='$bp',Urine_Protein_Sugar='$urineProtein',Gestation_Age='$gestationWeek',Fundal_Height='$fundal',FH='$fh',Descent='$descent',Presentation='$pres',Supply_Of_Iron_Or_Folic='$ironFolicAcid',Complaint_Treatment='$complain',Name_Or_Signature='$name' WHERE MRID='$actualId'");
  $sql->execute();

header("Location: View-Antenatal-Progress.php?success");

}catch (Exception $ex) {
  $_SESSION['database_error'] = $ex->getMessage();
  header("Location: View-Antenatal-Progress.php?dataerror");
}

}

//method to insert records into maternal health records tables
public function Maternal_Health_Records()
{
    $maternalHealth = trim($_POST['maternalHealth']);
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    $pID = $_SESSION['patID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

  try{

    $data = $this->conn->prepare("INSERT into   progressnotescontinuationsheet(Date_Recorded,Month,Year,MRID,ProgressNotes)values(:Date_Recorded,:Month,:Year,:MRID,:ProgressNotes)");
    $data->bindValue(':Date_Recorded',$date);
    $data->bindValue(':Month',$month);
    $data->bindValue(':Year',$year);
    $data->bindValue(':MRID',$actualId);
    $data->bindValue(':ProgressNotes',$maternalHealth);

    $data->execute();
    header("Location: Maternal-Health-Records.php?success");
  }catch (Exception $ex) {
    $_SESSION['database_error'] = $ex->getMessage();
    header("Location: Maternal-Health-Records.php?dataerror");
  }
}

//method to update records into maternal health records tables
public function Update_Maternal_Health_Records()
{
    $maternal = trim($_POST['maternalHealth']);
    $date = date("d-M-Y");
    $pID = $_SESSION['patID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

  try{
    $sql = $this->conn->prepare("UPDATE progressnotescontinuationsheet SET Date_Recorded='$date',ProgressNotes='$maternal'  WHERE MRID='$actualId'");
    $sql->execute();

    header("Location: View-Maternal-Health-Records.php?success");
  }catch (Exception $ex) {
    $_SESSION['database_error'] = $ex->getMessage();
    header("Location: View-Maternal-Health-Records.php?dataerror");
  }
}
//method to handle labour summary records
  public function Delivery_Outcome()
  {
    //declaring varibales
    @$placeOfDelivery = trim($_POST['PlaceOfDelivery']);
    @$emergencyOperation = trim($_POST['EmergencyOperation']);
    $date = date("d-M-Y");
    $month = date("m");
    $year = date("Y");
    @$emergencyBlood= trim($_POST['BloodContact']);
    @$babyDeadOrAlive= trim($_POST['babyAliveOrDead']);
    @$deliveryDate = trim($_POST['deliveryDate']);
    @$deliveryPlace = trim($_POST['deliveryPlace']);
    @$ifHomeDelivery = trim($_POST['ifHome']);
    @$facilityName = trim($_POST['FacilityName']);
    @$labourSpont = trim($_POST['labourSpont']);
    @$labourInduced = trim($_POST['labourInduced']);
    @$labourAugmented = trim($_POST['labourAugmented']);
    @$deliveryDate2 = trim($_POST['DeliveryDate2']);
    @$deliveryTime = trim($_POST['DeliveryTime']);
    @$labourDuration = trim($_POST['labourDuration']);
    @$deliveryMode = trim($_POST['DeliveryMode']);
    @$ifCS= trim($_POST['ifCS']);
    @$labourComplication = trim($_POST['labourComplication']);
    $dischargeDate = trim($_POST['dischargeDate']);
    @$conditionBP = trim($_POST['conditionBP']);
    @$conditionPulse = trim($_POST['conditionPulse']);
    @$conditionPerineum = trim($_POST['conditionPerineum']);
    @$conditionLocia = trim($_POST['conditionlocia']);
    @$lactation = trim($_POST['lactation']);
    @$labourSignature = trim($_POST['labourSignature']);
    $nextVisitDate = trim($_POST['nextVisitDate']);
    @$babySex =trim($_POST['babySex']);
    @$babyWeight= trim($_POST['babyWeight']);
    @$oneMin = trim($_POST['oneMin']);
    @$fiveMins = trim($_POST['fiveMins']);
    @$babyCongenital = trim($_POST['babyCongenital']);
    @$babyCondition = trim($_POST['babyCondition']);
    @$babyDischarging = trim($_POST['babyDischarging']);
    @$babyJaundice = trim($_POST['babyJaundice']);
    @$babyMeconium = trim($_POST['meconium']);
    @$sucklingEstablished = trim($_POST['sucklingEstablished']);

    //getting patient ID
    $pID = $_SESSION['patID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

    try {
      //connecting to database
      //inserting into first table
      $data = $this->conn->prepare("INSERT into decisionmadeonbirthpreparedness(Date_Taken,Month,Year,MRID,	Place_Of_Delivery,Emergency_Operation_Contact,Emergency_Blood_Contact)
      values (:Date_Taken,:Month,:Year,:MRID,	:Place_Of_Delivery,:Emergency_Operation_Contact,:Emergency_Blood_Contact)");

      $data->bindValue(':Date_Taken',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Place_Of_Delivery',$placeOfDelivery);
      $data->bindValue(':Emergency_Operation_Contact',$emergencyOperation);
      $data->bindValue(':Emergency_Blood_Contact',$emergencyBlood);

      $data->execute();

      //inserting summary of labour table
      $data = $this->conn->prepare("INSERT into  summaryoflabourordeliveryoutcome(	Date_Recorded,Month,Year,MRID,Date_Of_Delivery,	Place_Of_Delivery,If_Home_Delivery_Who_Attended_Delivery,	If_Health_Facility_Name_Of_The_Facility,Type_OF_Labour_Spont,Type_Of_Labour_Induced,	Type_Of_Labour_Augmented,Delivery_Date,Delivery_Time,Duration_Of_Labour,Mode_Of_Delivery,Condition_of_Child,If_CS_Delivery_Complication,Labour_complication,Date_OF_Discharge,Condition_At_Discharge_In_BP,Condition_At_Discharge_In_Pulse,Condition_At_Discharge_In_Perineum,Condition_At_Discharge_In_Lochia,Lactation_Established,Midwife_Name,Date_Of_Next_Visit,Sex_Of_Baby,Birth_Weight,Apgar_Score_1min,Apgar_Score_5min,Congenital_Abnormalities,Baby_Condition_At_Discharge,Baby_Discharging_Eyes,Baby_Has_Jaundice,Baby_Has_Meconium,Suckling_Established_In_Baby)
      values (:Date_Recorded,:Month,:Year,:MRID,:Date_Of_Delivery,	:Place_Of_Delivery,:If_Home_Delivery_Who_Attended_Delivery,	:If_Health_Facility_Name_Of_The_Facility,:Type_OF_Labour_Spont,:Type_Of_Labour_Induced,	:Type_Of_Labour_Augmented,:Delivery_Date,:Delivery_Time,:Duration_Of_Labour,:Mode_Of_Delivery,:Condition_of_Child,:If_CS_Delivery_Complication,:Labour_complication,:Date_OF_Discharge,:Condition_At_Discharge_In_BP,:Condition_At_Discharge_In_Pulse,:Condition_At_Discharge_In_Perineum,:Condition_At_Discharge_In_Lochia,:Lactation_Established,:Midwife_Name,:Date_Of_Next_Visit,:Sex_Of_Baby,:Birth_Weight,:Apgar_Score_1min,:Apgar_Score_5min,:Congenital_Abnormalities,:Baby_Condition_At_Discharge,:Baby_Discharging_Eyes,:Baby_Has_Jaundice,:Baby_Has_Meconium,:Suckling_Established_In_Baby)");
      $data->bindValue(':Date_Recorded',$date);
      $data->bindValue(':Month',$month);
      $data->bindValue(':Year',$year);
      $data->bindValue(':MRID',$actualId);
      $data->bindValue(':Date_Of_Delivery',$deliveryDate);
      $data->bindValue(':Place_Of_Delivery',$deliveryPlace);
      $data->bindValue(':If_Home_Delivery_Who_Attended_Delivery',$ifHomeDelivery);
      $data->bindValue(':If_Health_Facility_Name_Of_The_Facility',$facilityName);
      $data->bindValue(':Type_OF_Labour_Spont',$labourSpont);
      $data->bindValue(':Type_Of_Labour_Induced',$labourInduced);
      $data->bindValue(':Type_Of_Labour_Augmented',$labourAugmented);
      $data->bindValue(':Delivery_Date',$deliveryDate2);
      $data->bindValue(':Delivery_Time',$deliveryTime);
      $data->bindValue(':Duration_Of_Labour',$labourDuration);
      $data->bindValue(':Mode_Of_Delivery',$deliveryMode);
      $data->bindValue(':Condition_of_Child',$babyDeadOrAlive);
      $data->bindValue(':If_CS_Delivery_Complication',$ifCS);
      $data->bindValue(':Labour_complication',    $labourComplication);
      $data->bindValue(':Date_OF_Discharge',$dischargeDate);
      $data->bindValue(':Condition_At_Discharge_In_BP',$conditionBP);
      $data->bindValue(':Condition_At_Discharge_In_Pulse',$conditionPulse);
      $data->bindValue(':Condition_At_Discharge_In_Perineum',  $conditionPerineum);
      $data->bindValue(':Condition_At_Discharge_In_Lochia',$conditionLocia);
      $data->bindValue(':Lactation_Established',$lactation);
      $data->bindValue(':Midwife_Name',$labourSignature);
      $data->bindValue(':Date_Of_Next_Visit',$nextVisitDate);
      $data->bindValue(':Sex_Of_Baby',$babySex);
      $data->bindValue(':Birth_Weight',$babyWeight);
      $data->bindValue(':Apgar_Score_1min',$oneMin);
      $data->bindValue(':Apgar_Score_5min',$fiveMins);
      $data->bindValue(':Congenital_Abnormalities',$babyCongenital);
      $data->bindValue(':Baby_Condition_At_Discharge',$babyCondition);
      $data->bindValue(':Baby_Discharging_Eyes',$babyDischarging);
      $data->bindValue(':Baby_Has_Jaundice',$babyJaundice);
      $data->bindValue(':Baby_Has_Meconium',$babyMeconium);
      $data->bindValue(':Suckling_Established_In_Baby',$sucklingEstablished);

      $data->execute();

      header("Location: Delivery-Outcome.php?success");
    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();
      header("Location: Delivery-Outcome.php?dataerror");
    }

  }

  public function check_if_id_exist($id)
  {
    //first query to check if mothers id exist
    $query =  "SELECT MRID from mothersrecord where MRID='$id'";
      $query_res = $this->conn->query($query);
      $count = count($query_res->fetchAll());
    if ($count > 0) {
      //checking if the patient has Delivered
      $delivery =  "SELECT Date_Of_Delivery from summaryoflabourordeliveryoutcome where MRID='$id'";
      $delivery_res = $this->conn->query($delivery);
      $count2 = count($delivery_res->fetchAll());
      if ($count2 > 0) {

        //getting patient name and id from the database
        foreach ($this->conn->query("SELECT * from mothersrecord WHERE MRID='$id'") as $row)
        {
          if ($row) {
            $_SESSION['patientName'] = $row['Full_Name'];
            $_SESSION['patientID'] = $row['Patient_Number'];

            header("location: Postnatal.php");

          }
        }
      }else {
         header("location: Postnatal-First-Visit-Search?data");
          }
      }
    else {
    header("location: Postnatal-First-Visit-Search?iderror");
  }

  }
//checking if patient id before generating report
  public function check_if_delivered($id)
  {
    //first query to check if mothers id exist
    $query =  "SELECT MRID from mothersrecord where MRID='$id'";
      $query_res = $this->conn->query($query);
      $count = count($query_res->fetchAll());
    if ($count > 0) {
      //checking if the patient has Delivered
      $delivery =  "SELECT Date_Of_Delivery from summaryoflabourordeliveryoutcome where MRID='$id'";
      $delivery_res = $this->conn->query($delivery);
      $count2 = count($delivery_res->fetchAll());
      if ($count2 > 0) {

        //getting patient name and id from the database
        foreach ($this->conn->query("SELECT * from mothersrecord WHERE MRID='$id'") as $row)
        {
          if ($row) {

              $_SESSION['reportID'] = $row['MRID'];
            header("location: Pdf-Summary-Of-Labour.php");

          }
        }
      }else {
         header("location: Report-Labour-Summary-Search.php?data");
          }
      }
    else {
    header("location: Report-Labour-Summary-Search.php?iderror");
  }

  }

  //checking if patient id before generating report
    public function Verify_ID($id)
    {
      //first query to check if mothers id exist
      $query =  "SELECT MRID from mothersrecord where MRID='$id'";
        $query_res = $this->conn->query($query);
        $count = count($query_res->fetchAll());
      if ($count > 0) {
          //getting patient name and id from the database
          foreach ($this->conn->query("SELECT * from mothersrecord WHERE MRID='$id'") as $row)
          {
            if ($row) {
                $_SESSION['reportID'] = $row['MRID'];
              header("location: Pdf-Summary-Of-Antenatal.php");

            }
          }

        }
      else {
      header("location: Report-Antenatal-Summary-Search.php?iderror");
    }

    }

    //verify if the mother has given birth before generating report
    public function VerifyIfDelivered($id)
    {
      //first query to check if mothers id exist
      $query =  "SELECT MRID from mothersrecord where MRID='$id'";
        $query_res = $this->conn->query($query);
        $count = count($query_res->fetchAll());
      if ($count > 0) {
        //checking if the patient has delivered
          $query2 =  "SELECT MRID from summaryoflabourordeliveryoutcome where MRID='$id'";
          $query_res = $this->conn->query($query2);
          $count2 = count($query_res->fetchAll());
          if ($count2 > 0) {

          //getting patient name and id from the database
          foreach ($this->conn->query("SELECT * from summaryoflabourordeliveryoutcome WHERE MRID='$id'") as $row)
          {
            if ($row) {
                $_SESSION['reportID'] = $row['MRID'];
              header("location: Pdf-Summary-Of-Postnatal.php");
            }
          }

        }else {
        header("location: Report-Postnatal-Summary-Search.php?dataerror");
       }
      }
      else {
      header("location: Report-Postnatal-Summary-Search.php?iderror");
    }

    }

    //checking if there is existing postnatal Records
    public function DataExist_First_Visit()
    {
      $pID = $_SESSION['patientID'];
      $getID = explode("C", $pID);
      $actualId = $getID[1];

      $query = "SELECT * from postnatalfirstvisitcareofmother where MRID='$actualId'";
     $query_res = $this->conn->query($query);
     $count = count($query_res->fetchAll());
      if ($count > 0) {
      header("location: Postnatal.php?dataexist");
      }
    }

  ///method that handle patient's postnatal first visit
    public function Postnatal_First_Visit()
    {
       @$motherComplaint= trim($_POST['motherComplaint']);
       @$motherTemperature= trim($_POST['motherTemperature']);
      $date = date("d-M-Y");
      $month = date("m");
      $year = date("Y");
      @$motherBp = trim($_POST['motherBP']);
      @$motherPulse = trim($_POST['motherPulse']);
      @$motherPallor = trim($_POST['motherPallor']);
      @$motherJaundice = trim($_POST['motherJaundice']);
      $motherBreastNipple = "";
      if(isset($_POST['motherBreastNormal'])) {
        $motherBreastNipple = "Normal";
      }else{
        $motherBreastNipple = trim($_POST['motherBreastAbnormalState']);
      }
      @$motherTenderness = trim($_POST['motherTenderness']);
      @$motherUterusSize = trim($_POST['motherUterusSize']);
      @$motherPrenium = trim($_POST['motherPrenium']);
      @$motherlimbsCalf = trim($_POST['motherlimbsCalf']);
      @$motherSwelling = trim($_POST['motherSwelling']);
      $treatmentVitA = "";
      $treatmentFeloate ="";
      if(isset($_POST['motherVit_A'])) {
        $treatmentVitA = "Vitamin A";
      }
      if(isset($_POST['motherFolate'])){
          $treatmentFeloate  = "Fe/Folate";
      }
      @$treatmentOthers  =  trim($_POST['motherOther']);
      @$motherHb = trim($_POST['motherHb']);
      @$motherHiv = trim($_POST['motherHiv']);
      @$babyCareComplaint = trim($_POST['babyCareComplaint']);
      @$babyTemp = trim($_POST['babyTemp']);
      @$babyHeartRate = trim($_POST['babyHeartRate']);
      @$babyPallor = trim($_POST['babyPallor']);
      @$babyJaundice = trim($_POST['babyJaundice']);
      @$babyBreastfeeding = trim($_POST['babyBreastfeeding']);
      @$babyActivity = trim($_POST['babyActivity']);
      @$babyChest = trim($_POST['babyChest']);
      @$babyAbdomen = trim($_POST['babyAbdomen']);
      @$babyLimbs = trim($_POST['babyLimbs']);
      @$babyHead = trim($_POST['babyHead']);
      @$babySpine = trim($_POST['babySpine']);
      @$babyUmbilicalCord = trim($_POST['babyUmbilicalCord']);
      @$babySkin = trim($_POST['babySkin']);
      @$babyDicharginEyes = trim($_POST['babyDicharginEyes']);
      @$babyPassingUrine = trim($_POST['babyPassingUrine']);
      @$babyPassingStool = trim($_POST['babyPassingStool']);
      @$babyVitaminK = trim($_POST['babyVitaminK']);
      @$babybcg = trim($_POST['babybcg']);
      @$babyPolio = trim($_POST['babyPolio']);
      @$babyOthers = trim($_POST['babyOthers']);
      @$babyNextDate = trim($_POST['babyNextDate']);
      @$babyMidwifeSig = trim($_POST['babyMidwifeSig']);
      $fullname = $_SESSION['patientName'];
      $pID = $_SESSION['patientID'];
      $getID = explode("C", $pID);
      $actualId = $getID[1];

      try {
        //connecting to database
        //inserting into first table
        $data = $this->conn->prepare("INSERT into postnatalfirstvisitcareofmother(Date_Taken,Month,Year,MRID,Complaints,Temperature,BP,	Jaundice,Pallor,Pulse,BreastAndNipple,	AbdomenTendernes,PerineumAndLochia,LowerLimbsCalfPain,UterusSize,Swelling,Treatment_VitA,Treatment_Fefolate,Treatment_others,LabTest_Hb,LabTest_HIV,DateNextVisit,Midwife)
        values (:Date_Taken,:Month,:Year,:MRID,:Complaints,:Temperature,:BP,:Jaundice,:Pallor,:Pulse,:BreastAndNipple,	:AbdomenTendernes,:PerineumAndLochia,:LowerLimbsCalfPain,:UterusSize,:Swelling,:Treatment_VitA,:Treatment_Fefolate,:Treatment_others,:LabTest_Hb,:LabTest_HIV,:DateNextVisit,:Midwife)");

        $data->bindValue(':Date_Taken',$date);
        $data->bindValue(':Month',$month);
        $data->bindValue(':Year',$year);
        $data->bindValue(':MRID',$actualId);
        $data->bindValue(':Complaints',$motherComplaint);
        $data->bindValue(':Temperature',$motherTemperature);
        $data->bindValue(':BP',$motherBp);
        $data->bindValue(':Jaundice',$motherJaundice);
        $data->bindValue(':Pallor',$motherPallor);
        $data->bindValue(':Pulse',$motherPulse);
        $data->bindValue(':BreastAndNipple',$motherBreastNipple);
        $data->bindValue(':AbdomenTendernes',$motherTenderness);
        $data->bindValue(':PerineumAndLochia',$motherPrenium);
        $data->bindValue(':LowerLimbsCalfPain',$motherlimbsCalf);
        $data->bindValue(':UterusSize',$motherUterusSize);
        $data->bindValue(':Swelling',$motherSwelling);
        $data->bindValue(':Treatment_VitA',$treatmentVitA);
        $data->bindValue(':Treatment_Fefolate',$treatmentFeloate);
        $data->bindValue(':Treatment_others',$treatmentOthers);
        $data->bindValue(':LabTest_Hb',$motherHb);
        $data->bindValue(':LabTest_HIV',$motherHiv);
        $data->bindValue(':DateNextVisit',$babyNextDate);
        $data->bindValue(':Midwife',$babyMidwifeSig);

        $data->execute();


        //inserting data into baby's table
        $data = $this->conn->prepare("INSERT into postnatalfirstvisitcareofbaby(Date_Recorded,MRID,Month,Year,Complaints,Breastfeeding,Temperature,HeartRate,Pallor,Jaundice,Activity,Chest,Abdomen,Limbs,Head,SpineBack,UmblicalCord,Skin,DischargeEyes,PassingUrine,PassingStool,VitKTreatment,BCGTreatment,PolioOTreatment,OtherTreatment,DateNextVisit)
        values (:Date_Recorded,:MRID,:Month,:Year,:Complaints,:Breastfeeding,:Temperature,:HeartRate,:Pallor,:Jaundice,:Activity,:Chest,:Abdomen,:Limbs,:Head,:SpineBack,:UmblicalCord,:Skin,:DischargeEyes,:PassingUrine,:PassingStool,:VitKTreatment,:BCGTreatment,:PolioOTreatment,:OtherTreatment,:DateNextVisit)");

        $data->bindValue(':Date_Recorded',$date);
        $data->bindValue(':MRID',$actualId);
        $data->bindValue(':Month',$month);
        $data->bindValue(':Year',$year);
         $data->bindValue(':Complaints',$babyCareComplaint);
         $data->bindValue(':Breastfeeding',$babyBreastfeeding);
         $data->bindValue(':Temperature',$babyTemp);
         $data->bindValue(':HeartRate',$babyHeartRate);
         $data->bindValue(':Pallor',$babyPallor);
         $data->bindValue(':Jaundice',$babyJaundice);
         $data->bindValue(':Activity',$babyActivity);
         $data->bindValue(':Chest',$babyChest);
         $data->bindValue(':Abdomen',$babyAbdomen);
         $data->bindValue(':Limbs',$babyLimbs);
         $data->bindValue(':Head',$babyHead);
         $data->bindValue(':SpineBack',$babySpine);
         $data->bindValue(':UmblicalCord',$babyUmbilicalCord);
         $data->bindValue(':Skin',$babySkin);
         $data->bindValue(':DischargeEyes',$babyDicharginEyes);
         $data->bindValue(':PassingUrine',$babyPassingUrine);
         $data->bindValue(':PassingStool',$babyPassingStool);
         $data->bindValue(':VitKTreatment',$babyVitaminK);
         $data->bindValue(':BCGTreatment',$babybcg);
         $data->bindValue(':PolioOTreatment',$babyPolio);
         $data->bindValue(':OtherTreatment',$babyOthers);
         $data->bindValue(':DateNextVisit',$babyNextDate);
        $data->execute();
  //inserting schedule date records into antenatal schedule table

  //getting patient's telephone number
  $contact = 0;
  foreach ($this->conn->query("SELECT * from appointments where MRID='$actualId'") as $row)
  {
    if ($row) {
          $contact  = $row['Telephone'];
   }
  }

  $data = $this->conn->prepare("INSERT into appointments (Today,Month,Year,Mother_Id,MRID,Name,Scheduled_Date,AppointmentService,Telephone,Date_Reported,Status)
  values (:Today,:Month,:Year,:Mother_Id,:MRID,:Name,:Scheduled_Date,:AppointmentService,:Telephone,:Date_Reported,:Status)");
  $data->bindValue(':Today', $date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':Mother_Id', $_SESSION['patientID']);
  $data->bindValue(':MRID', $actualId);
  $data->bindValue(':Name', $fullname);
  $data->bindValue(':Scheduled_Date', $babyNextDate);
  $data->bindValue(':AppointmentService', 'Postnatal First Visit');
  $data->bindValue(':Telephone', $contact);
  $data->bindValue(':Date_Reported','');
  $data->bindValue(':Status', 'Not Yet');
  $data->execute();

      header("Location: Postnatal-First-Visit.php?success");

      }catch (Exception $ex) {
        $_SESSION['database_error'] = $ex->getMessage();
        header("Location: Postnatal-First-Visit.php?dataerror");
      }
  }

  //checking if there is existing postnatal Records
  public function DataExist_Followup_Visit()
  {
    $pID = $_SESSION['patientID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

    $query = "SELECT * from postnatalsecondvisitcareofmother where MRID='$actualId'";
   $query_res = $this->conn->query($query);
   $count = count($query_res->fetchAll());
    if ($count > 0) {
    header("location: Postnatal.php?dataexist1");
    }
  }
  ///method that handle patient's postnatal follow up visit
    public function Postnatal_Followup_Visit()
    {
      @$motherComplaint= trim($_POST['motherComplaint']);
      @$motherTemperature= trim($_POST['motherTemperature']);
      $date = date("d-M-Y");
      $month = date("m");
      $year = date("Y");
      @$motherBp = trim($_POST['motherBP']);
      @$motherPulse = trim($_POST['motherPulse']);
      @$motherPallor = trim($_POST['motherPallor']);
      @$motherJaundice = trim($_POST['motherJaundice']);
      $motherBreastNipple = "";
      if(isset($_POST['motherBreastNormal'])) {
       $motherBreastNipple = "Normal";
      }else{
       $motherBreastNipple = trim($_POST['motherBreastAbnormalState']);
      }
      @$motherTenderness = trim($_POST['motherTenderness']);
      @$motherUterusSize = trim($_POST['motherUterusSize']);
      @$motherPrenium = trim($_POST['motherPrenium']);
      @$motherlimbsCalf = trim($_POST['motherlimbsCalf']);
      @$motherSwelling = trim($_POST['motherSwelling']);
      $treatmentVitA = "";
      $treatmentFeloate ="";
      if(isset($_POST['motherVit_A'])) {
       $treatmentVitA = "Vitamin A";
      }
      if(isset($_POST['motherFolate'])){
         $treatmentFeloate  = "Fe/Folate";
      }
      @$treatmentOthers  =  trim($_POST['motherOther']);
      @$motherHb = trim($_POST['motherHb']);
      @$motherHiv = trim($_POST['motherHiv']);
      @$babyCareComplaint = trim($_POST['babyCareComplaint']);
      @$babyTemp = trim($_POST['babyTemp']);
      @$babyHeartRate = trim($_POST['babyHeartRate']);
      @$babyPallor = trim($_POST['babyPallor']);
      @$babyJaundice = trim($_POST['babyJaundice']);
      @$babyBreastfeeding = trim($_POST['babyBreastfeeding']);
      @$babyActivity = trim($_POST['babyActivity']);
      @$babyChest = trim($_POST['babyChest']);
      @$babyAbdomen = trim($_POST['babyAbdomen']);
      @$babyLimbs = trim($_POST['babyLimbs']);
      @$babyHead = trim($_POST['babyHead']);
      @$babySpine = trim($_POST['babySpine']);
      @$babyUmbilicalCord = trim($_POST['babyUmbilicalCord']);
      @$babySkin = trim($_POST['babySkin']);
      @$babyDicharginEyes = trim($_POST['babyDicharginEyes']);
      @$babyPassingUrine = trim($_POST['babyPassingUrine']);
      @$babyPassingStool = trim($_POST['babyPassingStool']);
      @$babyVitaminK = trim($_POST['babyVitaminK']);
      @$babybcg = trim($_POST['babybcg']);
      @$babyPolio = trim($_POST['babyPolio']);
      @$babyOthers = trim($_POST['babyOthers']);
      @$babyNextDate = trim($_POST['babyNextDate']);
      @$babyMidwifeSig = trim($_POST['babyMidwifeSig']);
      $fullname = $_SESSION['patientName'];
      $pID = $_SESSION['patientID'];
      $getID = explode("C", $pID);
      $actualId = $getID[1];

      try {


        //connecting to database
        //inserting into first table
        $data = $this->conn->prepare("INSERT into postnatalsecondvisitcareofmother(Date_Taken,Month,Year,MRID,Complaints,Temperature,BP,Jaundice,Pallor,Pulse,BreastAndNipple,	AbdomenTendernes,PerineumAndLochia,LowerLimbsCalfPain,UterusSize,Swelling,Treatment_VitA,Treatment_Fefolate,Treatment_others,LabTest_Hb,LabTest_HIV,DateNextVisit,Midwife)
        values (:Date_Taken,:Month,:Year,:MRID,:Complaints,:Temperature,:BP,:Jaundice,:Pallor,:Pulse,:BreastAndNipple,	:AbdomenTendernes,:PerineumAndLochia,:LowerLimbsCalfPain,:UterusSize,:Swelling,:Treatment_VitA,:Treatment_Fefolate,:Treatment_others,:LabTest_Hb,:LabTest_HIV,:DateNextVisit,:Midwife)");

        $data->bindValue(':Date_Taken',$date);
        $data->bindValue(':Month',$month);
        $data->bindValue(':Year',$year);
        $data->bindValue(':MRID',$actualId);
        $data->bindValue(':Complaints',$motherComplaint);
        $data->bindValue(':Temperature',$motherTemperature);
        $data->bindValue(':BP',$motherBp);
        $data->bindValue(':Jaundice',$motherJaundice);
        $data->bindValue(':Pallor',$motherPallor);
        $data->bindValue(':Pulse',$motherPulse);
        $data->bindValue(':BreastAndNipple',$motherBreastNipple);
        $data->bindValue(':AbdomenTendernes',$motherTenderness);
        $data->bindValue(':PerineumAndLochia',$motherPrenium);
        $data->bindValue(':LowerLimbsCalfPain',$motherlimbsCalf);
        $data->bindValue(':UterusSize',$motherUterusSize);
        $data->bindValue(':Swelling',$motherSwelling);
        $data->bindValue(':Treatment_VitA',$treatmentVitA);
        $data->bindValue(':Treatment_Fefolate',$treatmentFeloate);
        $data->bindValue(':Treatment_others',$treatmentOthers);
        $data->bindValue(':LabTest_Hb',$motherHb);
        $data->bindValue(':LabTest_HIV',$motherHiv);
        $data->bindValue(':DateNextVisit',$babyNextDate);
        $data->bindValue(':Midwife',$babyMidwifeSig);

        $data->execute();


        //inserting data into baby's table
        $data = $this->conn->prepare("INSERT into postnatalsecondvisitcareofbaby(Date_Recorded,MRID,Month,Year,Complaints,Breastfeeding,Temperature,HeartRate,Pallor,Jaundice,Activity,Chest,Abdomen,Limbs,Head,SpineBack,UmblicalCord,Skin,DischargeEyes,PassingUrine,PassingStool,VitKTreatment,BCGTreatment,PolioOTreatment,OtherTreatment,DateNextVisit)
        values (:Date_Recorded,:MRID,:Month,:Year,:Complaints,:Breastfeeding,:Temperature,:HeartRate,:Pallor,:Jaundice,:Activity,:Chest,:Abdomen,:Limbs,:Head,:SpineBack,:UmblicalCord,:Skin,:DischargeEyes,:PassingUrine,:PassingStool,:VitKTreatment,:BCGTreatment,:PolioOTreatment,:OtherTreatment,:DateNextVisit)");

        $data->bindValue(':Date_Recorded',$date);
        $data->bindValue(':MRID',$actualId);
        $data->bindValue(':Month',$month);
        $data->bindValue(':Year',$year);
         $data->bindValue(':Complaints',$babyCareComplaint);
         $data->bindValue(':Breastfeeding',$babyBreastfeeding);
         $data->bindValue(':Temperature',$babyTemp);
         $data->bindValue(':HeartRate',$babyHeartRate);
         $data->bindValue(':Pallor',$babyPallor);
         $data->bindValue(':Jaundice',$babyJaundice);
         $data->bindValue(':Activity',$babyActivity);
         $data->bindValue(':Chest',$babyChest);
         $data->bindValue(':Abdomen',$babyAbdomen);
         $data->bindValue(':Limbs',$babyLimbs);
         $data->bindValue(':Head',$babyHead);
         $data->bindValue(':SpineBack',$babySpine);
         $data->bindValue(':UmblicalCord',$babyUmbilicalCord);
         $data->bindValue(':Skin',$babySkin);
         $data->bindValue(':DischargeEyes',$babyDicharginEyes);
         $data->bindValue(':PassingUrine',$babyPassingUrine);
         $data->bindValue(':PassingStool',$babyPassingStool);
         $data->bindValue(':VitKTreatment',$babyVitaminK);
         $data->bindValue(':BCGTreatment',$babybcg);
         $data->bindValue(':PolioOTreatment',$babyPolio);
         $data->bindValue(':OtherTreatment',$babyOthers);
         $data->bindValue(':DateNextVisit',$babyNextDate);
        $data->execute();
  //inserting schedule date records into antenatal schedule table

  //getting patient's telephone number
  $contact = 0;
  foreach ($this->conn->query("SELECT * from appointments where MRID='$actualId'") as $row)
  {
    if ($row) {
          $contact  = $row['Telephone'];
   }
  }

  $data = $this->conn->prepare("INSERT into appointments (Today,Month,Year,Mother_Id,MRID,Name,Scheduled_Date,AppointmentService,Telephone,Date_Reported,Status)
  values (:Today,:Month,:Year,:Mother_Id,:MRID,:Name,:Scheduled_Date,:AppointmentService,:Telephone,:Date_Reported,:Status)");
  $data->bindValue(':Today', $date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':Mother_Id', $_SESSION['patientID']);
  $data->bindValue(':MRID', $actualId);
  $data->bindValue(':Name', $fullname);
  $data->bindValue(':Scheduled_Date', $babyNextDate);
  $data->bindValue(':AppointmentService', 'Postnatal Followup Visit');
  $data->bindValue(':Telephone', $contact);
  $data->bindValue(':Date_Reported','');
  $data->bindValue(':Status', 'Not Yet');
  $data->execute();

      header("Location: Postnatal-Followup-Visit.php?success");

      }catch (Exception $ex) {
        $_SESSION['database_error'] = $ex->getMessage();
        header("Location: Postnatal-Followup-Visit.php?dataerror");
      }
  }
  //checking if there is existing postnatal Records
  public function DataExist_Six_Weeks()
  {
    $pID = $_SESSION['patientID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

    $query = "SELECT * from postnatalsixweekscareofmother where MRID='$actualId'";
   $query_res = $this->conn->query($query);
   $count = count($query_res->fetchAll());
    if ($count > 0) {
    header("location: Postnatal.php?dataexist2");
    }
  }
  ///method that handle patient's postnatal six weeks
    public function Postnatal_Sixweeks_Visit()
    {
      @$motherComplaint= trim($_POST['motherComplaint']);
      @$motherTemperature= trim($_POST['motherTemperature']);
     $date = date("d-M-Y");
     $month = date("m");
     $year = date("Y");
     @$motherBp = trim($_POST['motherBP']);
     @$motherPulse = trim($_POST['motherPulse']);
     @$motherPallor = trim($_POST['motherPallor']);
     @$motherJaundice = trim($_POST['motherJaundice']);
     $motherBreastNipple = "";
     if(isset($_POST['motherBreastNormal'])) {
       $motherBreastNipple = "Normal";
     }else{
       $motherBreastNipple = trim($_POST['motherBreastAbnormalState']);
     }
     @$motherTenderness = trim($_POST['motherTenderness']);
     @$motherUterusSize = trim($_POST['motherUterusSize']);
     @$motherPrenium = trim($_POST['motherPrenium']);
     @$motherlimbsCalf = trim($_POST['motherlimbsCalf']);
     @$motherSwelling = trim($_POST['motherSwelling']);
     $treatmentVitA = "";
     $treatmentFeloate ="";
     if(isset($_POST['motherVit_A'])) {
       $treatmentVitA = "Vitamin A";
     }
     if(isset($_POST['motherFolate'])){
         $treatmentFeloate  = "Fe/Folate";
     }
     @$treatmentOthers  =  trim($_POST['motherOther']);
     @$motherHb = trim($_POST['motherHb']);
     @$motherHiv = trim($_POST['motherHiv']);
     @$babyCareComplaint = trim($_POST['babyCareComplaint']);
     @$babyTemp = trim($_POST['babyTemp']);
     @$babyHeartRate = trim($_POST['babyHeartRate']);
     @$babyPallor = trim($_POST['babyPallor']);
     @$babyJaundice = trim($_POST['babyJaundice']);
     @$babyBreastfeeding = trim($_POST['babyBreastfeeding']);
     @$babyActivity = trim($_POST['babyActivity']);
     @$babyChest = trim($_POST['babyChest']);
     @$babyAbdomen = trim($_POST['babyAbdomen']);
     @$babyLimbs = trim($_POST['babyLimbs']);
     @$babyHead = trim($_POST['babyHead']);
     @$babySpine = trim($_POST['babySpine']);
     @$babyUmbilicalCord = trim($_POST['babyUmbilicalCord']);
     @$babySkin = trim($_POST['babySkin']);
     @$babyDicharginEyes = trim($_POST['babyDicharginEyes']);
     @$babyPassingUrine = trim($_POST['babyPassingUrine']);
     @$babyPassingStool = trim($_POST['babyPassingStool']);
     @$babyVitaminK = trim($_POST['babyVitaminK']);
     @$babybcg = trim($_POST['babybcg']);
     @$babyPolio = trim($_POST['babyPolio']);
     @$babyOthers = trim($_POST['babyOthers']);
     @$babyNextDate = trim($_POST['babyNextDate']);
     @$babyMidwifeSig = trim($_POST['babyMidwifeSig']);
     $fullname = $_SESSION['patientName'];
     $pID = $_SESSION['patientID'];
     $getID = explode("C", $pID);
     $actualId = $getID[1];
      try {
        //connecting to database
        //inserting into first table
        $data = $this->conn->prepare("INSERT into postnatalsixweekscareofmother(Date_Taken,Month,Year,MRID,Complaints,Temperature,BP,Jaundice,Pallor,Pulse,BreastAndNipple,	AbdomenTendernes,PerineumAndLochia,LowerLimbsCalfPain,UterusSize,Swelling,Treatment_VitA,Treatment_Fefolate,Treatment_others,LabTest_Hb,LabTest_HIV,DateNextVisit,Midwife)
        values (:Date_Taken,:Month,:Year,:MRID,:Complaints,:Temperature,:BP,:Jaundice,:Pallor,:Pulse,:BreastAndNipple,	:AbdomenTendernes,:PerineumAndLochia,:LowerLimbsCalfPain,:UterusSize,:Swelling,:Treatment_VitA,:Treatment_Fefolate,:Treatment_others,:LabTest_Hb,:LabTest_HIV,:DateNextVisit,:Midwife)");

        $data->bindValue(':Date_Taken',$date);
        $data->bindValue(':Month',$month);
        $data->bindValue(':Year',$year);
        $data->bindValue(':MRID',$actualId);
        $data->bindValue(':Complaints',$motherComplaint);
        $data->bindValue(':Temperature',$motherTemperature);
        $data->bindValue(':BP',$motherBp);
        $data->bindValue(':Jaundice',$motherJaundice);
        $data->bindValue(':Pallor',$motherPallor);
        $data->bindValue(':Pulse',$motherPulse);
        $data->bindValue(':BreastAndNipple',$motherBreastNipple);
        $data->bindValue(':AbdomenTendernes',$motherTenderness);
        $data->bindValue(':PerineumAndLochia',$motherPrenium);
        $data->bindValue(':LowerLimbsCalfPain',$motherlimbsCalf);
        $data->bindValue(':UterusSize',$motherUterusSize);
        $data->bindValue(':Swelling',$motherSwelling);
        $data->bindValue(':Treatment_VitA',$treatmentVitA);
        $data->bindValue(':Treatment_Fefolate',$treatmentFeloate);
        $data->bindValue(':Treatment_others',$treatmentOthers);
        $data->bindValue(':LabTest_Hb',$motherHb);
        $data->bindValue(':LabTest_HIV',$motherHiv);
        $data->bindValue(':DateNextVisit',$babyNextDate);
        $data->bindValue(':Midwife',$babyMidwifeSig);

        $data->execute();

        //inserting data into baby's table
        $data = $this->conn->prepare("INSERT into postnatalsixweekscareofbaby(Date_Recorded,MRID,Month,Year,Complaints,Breastfeeding,Temperature,HeartRate,Pallor,Jaundice,Activity,Chest,Abdomen,Limbs,Head,SpineBack,UmblicalCord,Skin,DischargeEyes,PassingUrine,PassingStool,VitKTreatment,BCGTreatment,PolioOTreatment,OtherTreatment,DateNextVisit)
        values (:Date_Recorded,:MRID,:Month,:Year,:Complaints,:Breastfeeding,:Temperature,:HeartRate,:Pallor,:Jaundice,:Activity,:Chest,:Abdomen,:Limbs,:Head,:SpineBack,:UmblicalCord,:Skin,:DischargeEyes,:PassingUrine,:PassingStool,:VitKTreatment,:BCGTreatment,:PolioOTreatment,:OtherTreatment,:DateNextVisit)");

        $data->bindValue(':Date_Recorded',$date);
        $data->bindValue(':MRID',$actualId);
        $data->bindValue(':Month',$month);
        $data->bindValue(':Year',$year);
         $data->bindValue(':Complaints',$babyCareComplaint);
         $data->bindValue(':Breastfeeding',$babyBreastfeeding);
         $data->bindValue(':Temperature',$babyTemp);
         $data->bindValue(':HeartRate',$babyHeartRate);
         $data->bindValue(':Pallor',$babyPallor);
         $data->bindValue(':Jaundice',$babyJaundice);
         $data->bindValue(':Activity',$babyActivity);
         $data->bindValue(':Chest',$babyChest);
         $data->bindValue(':Abdomen',$babyAbdomen);
         $data->bindValue(':Limbs',$babyLimbs);
         $data->bindValue(':Head',$babyHead);
         $data->bindValue(':SpineBack',$babySpine);
         $data->bindValue(':UmblicalCord',$babyUmbilicalCord);
         $data->bindValue(':Skin',$babySkin);
         $data->bindValue(':DischargeEyes',$babyDicharginEyes);
         $data->bindValue(':PassingUrine',$babyPassingUrine);
         $data->bindValue(':PassingStool',$babyPassingStool);
         $data->bindValue(':VitKTreatment',$babyVitaminK);
         $data->bindValue(':BCGTreatment',$babybcg);
         $data->bindValue(':PolioOTreatment',$babyPolio);
         $data->bindValue(':OtherTreatment',$babyOthers);
         $data->bindValue(':DateNextVisit',$babyNextDate);
        $data->execute();
  //inserting schedule date records into antenatal schedule table

  //getting patient's telephone number
  $contact = 0;
  foreach ($this->conn->query("SELECT * from appointments where MRID='$actualId'") as $row)
  {
    if ($row) {
          $contact  = $row['Telephone'];
   }
  }

  $data = $this->conn->prepare("INSERT into appointments (Today,Month,Year,Mother_Id,MRID,Name,Scheduled_Date,AppointmentService,Telephone,Date_Reported,Status)
  values (:Today,:Month,:Year,:Mother_Id,:MRID,:Name,:Scheduled_Date,:AppointmentService,:Telephone,:Date_Reported,:Status)");
  $data->bindValue(':Today', $date);
  $data->bindValue(':Month',$month);
  $data->bindValue(':Year',$year);
  $data->bindValue(':Mother_Id', $_SESSION['patientID']);
  $data->bindValue(':MRID', $actualId);
  $data->bindValue(':Name', $fullname);
  $data->bindValue(':Scheduled_Date', $babyNextDate);
  $data->bindValue(':AppointmentService', 'Postnatal 6week Visit');
  $data->bindValue(':Telephone', $contact);
  $data->bindValue(':Date_Reported','');
  $data->bindValue(':Status', 'Not Yet');
  $data->execute();

      header("Location: Postnatal-Sixweeks-Visit.php?success");

      }catch (Exception $ex) {
        $_SESSION['database_error'] = $ex->getMessage();
        header("Location: Postnatal-Sixweeks-Visit.php?dataerror");
      }
  }

//method to read antenatal examination records from the database

public function GetAntenatalExaminationRecords($id)
{
  //checking if the mother's exist in the system
      $query = "SELECT * from mothersrecord where MRID='$id'";
     $query_res = $this->conn->query($query);
     $count = count($query_res->fetchAll());
      if ($count > 0)
      {

        foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
        {
          if ($row)
          {
            $_SESSION['patID'] = $row['Patient_Number'];
            $_SESSION['fullname'] = $row['Full_Name'];
            //checking if the id entered has records in the tables
            $query = "SELECT * from physicalexaminationatfirstvisit where MRID='$id'";
           $query_res = $this->conn->query($query);
           $count = count($query_res->fetchAll());
            if ($count > 0)
            {
            foreach ($this->conn->query("SELECT * from physicalexaminationatfirstvisit where MRID='$id'") as $row)
            {
              if($row)
              {
                $_SESSION['PhysicalDate'] = $row['Date_Taken_PhysicalExam'];
                $_SESSION['Weight'] = $this->Check_data($row['Weight']);
                $_SESSION['Height'] = $this->Check_data($row['Height']);
                $_SESSION['BP'] = $this->Check_data($row['BP']);
                $_SESSION['Pulse'] = $this->Check_data($row['Pulse']);
                $_SESSION['Temperature'] = $this->Check_data($row['Temperature']);
                $_SESSION['GeneralObservation'] = $this->Check_data($row['General_Observation']);
                $_SESSION['FaceOrEye'] = $this->Check_data($row['Face_Or_Eye']);
                $_SESSION['Neck'] = $this->Check_data($row['Neck']);
                $_SESSION['Breast'] = $this->Check_data($row['Breast']);

                //reading records from the second table
                foreach ($this->conn->query("SELECT * from abdominalobstetricexamination where MRID='$id'") as $row)
              {
                $_SESSION['DateTaken'] = $row['Date_Taken_AbdominalExamination'];
                $_SESSION['Spleen'] = $this->Check_data($row['Spleen']);
                $_SESSION['Liver'] = $this->Check_data($row['Liver']);
                $_SESSION['OtherMasses'] = $this->Check_data($row['Other_Masses']);
                $_SESSION['Scars'] = $this->Check_data($row['Scars']);
              }

              //Reading data from the third table
              foreach ($this->conn->query("SELECT * from pelvicexamination where MRID='$id'") as $row)
              {

                $_SESSION['DatePelvic'] = $row['Date_Taken_PelvicExamination'];
                $_SESSION['Ulcer'] = $this->Check_data($row['Ulcer']);
                $_SESSION['Rashes'] = $this->Check_data($row['Rashes']);
                $_SESSION['Warts'] = $this->Check_data($row['Warts']);
                $_SESSION['Perineum'] = $this->Check_data($row['Perineum']);
                $_SESSION['Discharge'] = $this->Check_data($row['Discharge']);
                $_SESSION['PositionOfUterus'] = $this->Check_data($row['Position_Of_Uterus']);       $_SESSION['Cervix'] = $this->Check_data($row['Cervix']);
                $_SESSION['PositionOfUterus'] = $this->Check_data($row['Position_Of_Uterus']);       $_SESSION['Adnexae'] = $this->Check_data($row['Adnexae']);
                $_SESSION['Gait'] = $this->Check_data($row['Gait']);
                $_SESSION['CNS'] = $this->Check_data($row['CNS']);
                $_SESSION['Heart'] = $this->Check_data($row['Heart']);
                $_SESSION['Lungs'] = $this->Check_data($row['Lungs']);
               }
               header("location:  View-Examination-history.php");
             }
              }
            }else {
               header("location: View-Examination-History-search.php?iderror");
             }
          }
        }
      }else {
        header("location: View-Examination-History-search.php?Incorrect");
      }
}

//method to read maternal health records
public function GetMaternalHealthRecords($id)
{
  //checking if the mother's exist in the system
     $query = "SELECT * from mothersrecord where MRID='$id'";
    $query_res = $this->conn->query($query);
    $count = count($query_res->fetchAll());
     if ($count > 0)
      {
        foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
        {
          if ($row)
          {
            $_SESSION['patID'] = $row['Patient_Number'];
            $_SESSION['fullname'] = $row['Full_Name'];

            $query = "SELECT * from progressnotescontinuationsheet where MRID='$id'";
           $query_res = $this->conn->query($query);
           $count = count($query_res->fetchAll());
            if ($count > 0)
            {
              foreach ($this->conn->query("SELECT * from progressnotescontinuationsheet where MRID='$id'") as $row)
              {
                if($row)
                {
                  $_SESSION['dateRecorded'] = $row['Date_Recorded'];
                  $_SESSION['progress'] = $this->Check_data($row['ProgressNotes']);
                }
                header("location: View-Maternal-Health-Records.php");
              }

            }else {
              header("location: View-Maternal-Health-Records-Search.php?iderror");
            }

          }
        }


      }else {
          header("location: View-Maternal-Health-Records-Search.php?Incorrect");
      }
}

//method to read delivery or labour records
public function GetDeliveryOutcomeRecords($id)
{
  //checking if the mother's exist in the system
     $query = "SELECT * from mothersrecord where MRID='$id'";
    $query_res = $this->conn->query($query);
    $count = count($query_res->fetchAll());
     if ($count > 0)
      {
        foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
        {
          if ($row)
          {
            $_SESSION['patID'] = $row['Patient_Number'];
            $_SESSION['fullname'] = $row['Full_Name'];

            $query = "SELECT * from decisionmadeonbirthpreparedness where MRID='$id'";
           $query_res = $this->conn->query($query);
           $count = count($query_res->fetchAll());
            if ($count > 0)
            {
              foreach ($this->conn->query("SELECT * from decisionmadeonbirthpreparedness where MRID='$id'") as $row)
              {
                if($row){
                $_SESSION['dateTaken'] = $row['Date_Taken'];

                $_SESSION['deliveryPlace'] = $this->Check_data($row['Place_Of_Delivery']);
                $_SESSION['emergencyOperation'] = $this->Check_data($row['Emergency_Operation_Contact']);
                $_SESSION['emergencyBlood'] = $this->Check_data($row['Emergency_Blood_Contact']);

                //getting records from delivery outcome table
                foreach ($this->conn->query("SELECT * from summaryoflabourordeliveryoutcome where MRID='$id'") as $row)
              {
                $_SESSION['DateRecorded'] = $row['Date_Recorded'];
                $_SESSION['deliveryDate'] = $row['Date_Of_Delivery'];
                $_SESSION['PlaceOfDelivery'] = $this->Check_data($row['Place_Of_Delivery']);
                $_SESSION['ifHomeDelivery'] = $this->Check_data($row['If_Home_Delivery_Who_Attended_Delivery']);
                $_SESSION['ifFacilityDelivery'] = $this->Check_data($row['If_Health_Facility_Name_Of_The_Facility']);
                $_SESSION['labourSpont'] = $this->Check_data($row['Type_OF_Labour_Spont']);
                $_SESSION['labourInduced'] = $this->Check_data($row['Type_Of_Labour_Induced']);
                $_SESSION['labourAugmented'] = $this->Check_data($row['Type_Of_Labour_Augmented']);
                $_SESSION['deliveryDate'] =$row['Delivery_Date'];
                $_SESSION['deliveryTime'] =$row['Delivery_Time'];
                $_SESSION['durationLabour'] = $this->Check_data($row['Duration_Of_Labour']);
                $_SESSION['modeDelivery'] = $this->Check_data($row['Mode_Of_Delivery']);
                $_SESSION['deliveryComplication'] = $this->Check_data($row['If_CS_Delivery_Complication']);
                $_SESSION['labourComplication'] = $this->Check_data($row['Labour_complication']);
                $_SESSION['labourComplication'] = $this->Check_data($row['Labour_complication']); $_SESSION['DateDischarge'] =$row['Date_OF_Discharge'];
                $_SESSION['labourComplication'] = $this->Check_data($row['Labour_complication']); $_SESSION['DateDischarge'] =$row['Date_OF_Discharge'];
                $_SESSION['labourComplication'] = $this->Check_data($row['Labour_complication']);
                $_SESSION['conditionBp'] = $this->Check_data($row['Condition_At_Discharge_In_BP']);
                $_SESSION['conditionPulse'] = $this->Check_data($row['Condition_At_Discharge_In_Pulse']);
                $_SESSION['conditionPremium'] = $this->Check_data($row['Condition_At_Discharge_In_Perineum']);
                $_SESSION['conditionLochia'] = $this->Check_data($row['Condition_At_Discharge_In_Lochia']);
                $_SESSION['lactation'] = $this->Check_data($row['Lactation_Established']);
                $_SESSION['midWife'] = $this->Check_data($row['Midwife_Name']);
                $_SESSION['DateOfNextVisit'] =$row['Date_Of_Next_Visit'];
                $_SESSION['babySex'] = $this->Check_data($row['Sex_Of_Baby']);
                $_SESSION['birthWeight'] = $this->Check_data($row['Birth_Weight']);
                $_SESSION['oneMinute'] = $this->Check_data($row['Apgar_Score_1min']);
                $_SESSION['fiveMinute'] = $this->Check_data($row['Apgar_Score_5min']);
                $_SESSION['congenitalAbnormalies'] = $this->Check_data($row['Congenital_Abnormalities']);
                $_SESSION['babyConditionDischarge'] = $this->Check_data($row['Baby_Condition_At_Discharge']);
                $_SESSION['babyConditionEyes'] = $this->Check_data($row['Baby_Discharging_Eyes']);
                $_SESSION['babyDeadorAlive'] = $this->Check_data($row['Condition_of_Child']);
                $_SESSION['babyJaundice'] = $this->Check_data($row['Baby_Has_Jaundice']);
                $_SESSION['babyJaundice'] = $this->Check_data($row['Baby_Has_Jaundice']);
                $_SESSION['babyMeconium'] = $this->Check_data($row['Baby_Has_Meconium']);
                $_SESSION['SucklingBaby'] = $this->Check_data($row['Suckling_Established_In_Baby']);
              }
              header("location: View-Delivery-Outcome.php");

              }

             }
          }else {
            header("location: View-Delivery-Outcome-Search.php?iderror");
          }
        }

      }
    }else {
      header("location: View-Delivery-Outcome-Search.php?Incorrect");
    }
}

//method to read antenatal investigation records
public function GetAntenatalProgressRecords($id)
{
   //checking if the mother's exist in the system
      $query = "SELECT * from mothersrecord where MRID='$id'";
     $query_res = $this->conn->query($query);
     $count = count($query_res->fetchAll());
      if ($count > 0)
       {
         foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
         {
           if ($row)
           {
             $_SESSION['patID'] = $row['Patient_Number'];
             $_SESSION['fullname'] = $row['Full_Name'];
              //verifying records of the id entered
              $query = "SELECT * from  antenatalprogressrecord where MRID='$id'";
             $query_res = $this->conn->query($query);
             $count = count($query_res->fetchAll());
              if ($count > 0) {
                foreach ($this->conn->query("SELECT * from  antenatalprogressrecord where MRID='$id'") as $row)
                {
                  if($row){
                  $_SESSION['DateRecorded'] = $row['Date_Recorded'];

                  $_SESSION['DateVisited'] =$row['Date_Visited'];
                  $_SESSION['wgt1'] = $this->Check_data($row['Weight']);
                  $_SESSION['bp'] = $this->Check_data($row['BP']);
                  $_SESSION['urineProtein'] = $this->Check_data($row['Urine_Protein_Sugar']);
                  $_SESSION['gestAge'] = $this->Check_data($row['Gestation_Age']);
                  $_SESSION['fundHeight'] = $this->Check_data($row['Fundal_Height']);
                  $_SESSION['fh'] = $this->Check_data($row['FH']);
                  $_SESSION['des'] = $this->Check_data($row['Descent']);
                  $_SESSION['presentation'] = $this->Check_data($row['Presentation']);
                  $_SESSION['iron'] = $this->Check_data($row['Supply_Of_Iron_Or_Folic']);
                  $_SESSION['complain'] = $this->Check_data($row['Complaint_Treatment']);
                  $_SESSION['signature'] = $this->Check_data($row['Name_Or_Signature']);

                }
                header("location: View-Antenatal-Progress.php");
            }

             }else {
               header("location: View-Antenatal-Investigation-search.php?iderror");
             }
           }
         }
       }else {
         header("location: View-Antenatal-Progress-search.php?Incorrect");
       }
}

//method to read antenatal investifation records
 public function GetAntenatalInvestigationRecords($id)
 {
   //checking if the mother's exist in the system
       $query = "SELECT * from mothersrecord where MRID='$id'";
      $query_res = $this->conn->query($query);
      $count = count($query_res->fetchAll());
       if ($count > 0)
        {
          foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
          {
            if ($row)
            {
              $_SESSION['patID'] = $row['Patient_Number'];
              $_SESSION['fullname'] = $row['Full_Name'];
               //verifying records of the id entered

               $query = "SELECT * from investigation where MRID='$id'";
              $query_res = $this->conn->query($query);
              $count = count($query_res->fetchAll());
               if ($count > 0) {
                   foreach ($this->conn->query("SELECT * from investigation where MRID='$id'") as $row)
                   {
                      $_SESSION['DateInvestigated'] = $row['Date_Taken_Investigation'];
                      $_SESSION['Haemoglobin'] = $this->Check_data($row['Haemoglobin']);
                      $_SESSION['DateHaemoglobinDate'] =$row['Date_Of_HaemoglobinTest'];
                      $_SESSION['sicklingtest'] = $this->Check_data($row['Sickling_Test']);
                      $_SESSION['sicklingDate'] =$row['Date_Of_SicklingTest'];
                      $_SESSION['hbrepeat'] = $this->Check_data($row['Hb_Repeat']);
                      $_SESSION['hbrepeatDate'] =$row['Date_Of_HbRepeat'];
                      $_SESSION['bloodGroup'] = $this->Check_data($row['Blood_Group']);
                      $_SESSION['bloodGroup'] = $this->Check_data($row['Blood_Group']);
                      $_SESSION['bloodGroupDate']=$row['Date_Of_BloodGroupTest'];
                      $_SESSION['rhesusFactor'] = $this->Check_data($row['Rhesus_Factor']);
                      $_SESSION['rhesusFactorDate']=$row['Date_Of_RhesusFatorTest'];
                      $_SESSION['bloodFlow'] = $this->Check_data($row['BloodFlow']);
                      $_SESSION['bloodFlowDate']=$row['Date_Of_BloodFlow'];
                      $_SESSION['vdrl'] = $this->Check_data($row['VDRL_Or_PRP']);
                      $_SESSION['vdrlDate']=$row['Date_Of_VDRLTest'];
                      $_SESSION['hbsag'] = $this->Check_data($row['HBsAg']);
                      $_SESSION['hbsagDate']=$row['Date_Of_HBsAgTest'];
                      $_SESSION['hivtest'] = $this->Check_data($row['HIV_Test']);
                      $_SESSION['hivtestDate']=$row['Date_Of_HIVstatusTest'];
                      $_SESSION['hivRepeat'] = $this->Check_data($row['Repeat_HIV']);
                      $_SESSION['hivRepeatDate']=$row['Date_Of_RepeatHivTest'];
                      $_SESSION['stoolre'] = $this->Check_data($row['Stool_RE']);
                      $_SESSION['stoolreDate']=$row['Date_Of_StoolReTest'];
                      $_SESSION['urinere'] = $this->Check_data($row['Urine_RE']);
                      $_SESSION['urinereDate']=$row['Date_Of_UrineReTest'];
                      $_SESSION['urineTest'] = $this->Check_data($row['UrinePregnancyTest']);
                      $_SESSION['urinereDate']=$row['Date_UrinePregnancyTest'];

                      foreach ($this->conn->query("SELECT * from otherinvestigation where MRID='$id'") as $row)
                    {
                      $_SESSION['otherDate'] = $row['Date_Other_Investigation_Taken'];
                      $_SESSION['gesAge'] = $this->Check_data($row['Gestational_Age']);
                      $_SESSION['gesAgeDate']=$row['Date_Of_GestationalAgeTest'];
                      $_SESSION['placenta'] = $this->Check_data($row['Placental_Position']);
                      $_SESSION['placentaDate']=$row['Date_Of_PlacentalPositionTest'];
                      $_SESSION['liq'] = $this->Check_data($row['Alcohol_Volume']);
                      $_SESSION['liqDate']= $row['Date_Of_AlcoholVolumeTest'];
                      $_SESSION['expDate'] = $this->Check_data($row['Expected_Date']);
                      $_SESSION['expDate2']=$row['Date_Of_EDDtest'];
                      $_SESSION['otherDesc'] = $this->Check_data($row['Others_Description']);
                      $_SESSION['otherResult'] = $this->Check_data($row['Others_Result']);
                      $_SESSION['otherDate']=$row['Date_Of_OtherTest'];
                      }
                      header("location: View-Antenatal-Investigation.php");
                   }
                }else {
                  header("location: View-Antenatal-Investigation-search.php?iderror");
                }
            }

          }

        }else {
          header("location: View-Antenatal-Investigation-search.php?Incorrect");
        }
 }


  //method to read antenatal history records
  public function GetAntenatalHistoryRecords($id)
  {
    //checking if the mother's exist in the system
        $query = "SELECT * from mothersrecord where MRID='$id'";
       $query_res = $this->conn->query($query);
       $count = count($query_res->fetchAll());
        if ($count > 0) {
          foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
          {
            if ($row)
            {
              $_SESSION['patID'] = $row['Patient_Number'];
              $_SESSION['fullname'] = $row['Full_Name'];
      //verifying records of the id entered
              $query = "SELECT * from menstrualhistory where MRID='$id'";
             $query_res = $this->conn->query($query);
             $count = count($query_res->fetchAll());
              if ($count > 0) {
                  foreach ($this->conn->query("SELECT * from menstrualhistory where MRID='$id'") as $row)
                  {
                    if($row){
                $_SESSION['MensDate'] = $row['Date_Taken_MenstrualHistory'];
                $_SESSION['MensDays'] = $this->Check_data($row['Duration_Of_Menses']);
                $_SESSION['DaysBetweenMens'] = $this->Check_data($row['Number_Of_Days_Between_Menses']);
                $_SESSION['LastMenstral'] =$row['Last_Mestrual_Period'];
                $_SESSION['ExpectDate'] =$row['Expected_Date_Of_Delivery'];
                $_SESSION['NoPregnancy'] = $this->Check_data($row['Number_Of_Pregnancy_At_Booking']);

            foreach ($this->conn->query("SELECT * from majorriskfactors where MRID='$id'") as $row)
                  {

                    $_SESSION['FactorDate'] = $row['Date_Taken_MajorRiskFactor'];
                    $_SESSION['FactorParity'] = $this->Check_data($row['GrandMultiparity']);
                    $_SESSION['PreviousCS'] = $this->Check_data($row['PreviousCS']);
                    $_SESSION['PreviousPPH'] = $this->Check_data($row['PreviousPPH']);
                    $_SESSION['Myomectomy'] = $this->Check_data($row['Myomectomy']);
                    $_SESSION['FactorSickle'] = $this->Check_data($row['SickleCellDisease']);
                    $_SESSION['Others'] = $this->Check_data($row['Others']);
                  }

                  foreach ($this->conn->query("SELECT * from obstetrichistory where MRID='$id'") as $row)
                  {
                    $_SESSION['ObDate'] = $row['Date_Taken_ObstetricHistory'];
                    $_SESSION['Gravida'] = $this->Check_data($row['Gravida']);
                    $_SESSION['Para'] = $this->Check_data($row['Para']);
                    $_SESSION['Abortion'] = $this->Check_data($row['Abortion']);
                    $_SESSION['Spont'] = $this->Check_data($row['Spont']);
                    $_SESSION['Induced'] = $this->Check_data($row['Induced']);
                  }

                  foreach ($this->conn->query("SELECT * from pastpregnancy where MRID='$id'") as $row)
                  {
                    $_SESSION['PastDate'] = $row['Date_Of_Entry'];
                    $_SESSION['PlaceOfDelivery'] = $this->Check_data($row['Place_Of_Delivery_Or_Loss']);
                    $_SESSION['DateDelivered'] =$row['Date_Of_Delivery'];
                    $_SESSION['Problem'] = $this->Check_data($row['Problem_During_Pregnancy']);
                    $_SESSION['ModeDelivered'] = $this->Check_data($row['Mode_Of_Delivery']);                            $_SESSION['OutcomeBirth'] = $this->Check_data($row['Outcome_Of_Birth']);
                    $_SESSION['ModeDelivered'] = $this->Check_data($row['Mode_Of_Delivery']);
                    $_SESSION['Sex'] = $this->Check_data($row['Sex']);                  $_SESSION['LabourComplications'] = $this->Check_data($row['Labour_Complications']);
                    $_SESSION['ConditionChild'] = $this->Check_data($row['Condition_Of_Child']);
                    $_SESSION['BirthWeight'] = $this->Check_data($row['Birth_Weight']);

                  }

                  foreach ($this->conn->query("SELECT * from breastfeedinghistory where MRID='$id'") as $row)
                  {
                    $_SESSION['BreastDate'] = $row['Date_Taken_BreastfeedingHistory'];
                    $_SESSION['BreastfeedingLastChild'] = $this->Check_data($row['Breastfeeding_for_the_Last_Child']);
                    $_SESSION['BreastfeedingLastChild'] = $this->Check_data($row['Breastfeeding_for_the_Last_Child']);
                    $_SESSION['DurationBreastfeeding'] = $this->Check_data($row['Duration_Of_Exclusive_Breastfeeding']);
                   $_SESSION['DurationOfBreastfeeding'] = $this->Check_data($row['Duration_Of_Breastfeeding']);

                  }

                  //looping through the second form for data
                  foreach ($this->conn->query("SELECT * from medicalandsurgicalhistory where MRID='$id'") as $row)
                  {
                    $_SESSION['MedicalDate'] = $row['Date_Taken_MedicalandSurgicalHistory'];
                     $_SESSION['Hypertension'] = $this->Check_data($row['Hypertension']);
                     $_SESSION['HeartDisease'] = $this->Check_data($row['HeartDisease']);
                     $_SESSION['MedicalSickleCell'] = $this->Check_data($row['SickleCell']);
                     $_SESSION['Diabetes'] = $this->Check_data($row['Diabetes']);
                    $_SESSION['RespiratoryDisease'] = $this->Check_data($row['RespiratoryDisease']);
                    $_SESSION['TBAsthmaChronic'] = $this->Check_data($row['TB_Asthma_Chronic']);
                    $_SESSION['HIVDisease'] = $this->Check_data($row['HIVDisease']);
                    $_SESSION['Epilepsy'] = $this->Check_data($row['Epilepsy']);
                    $_SESSION['MentalIllness'] = $this->Check_data($row['Mental_Illness']);
                    $_SESSION['Jaundice'] = $this->Check_data($row['Jaundice']);
                    $_SESSION['Others'] = $this->Check_data($row['Others']);
                    $_SESSION['PreviousOperation'] = $this->Check_data($row['Previous_Operation']);

                  }

                  header("location: View-History1.php");

                }

              }
            }else {
              header("location: View-Antenatal-History-search.php?iderror");
            }

            }
          }

        }else {
          header("location: View-Antenatal-History-search.php?Incorrect");
        }

  }
//getting antenatal history records for the second page
  public function GetAntenatalHistoryRecords2($id)
  {
    $query = "SELECT * from medicalandsurgicalhistory where MRID='$id'";
   $query_res = $this->conn->query($query);
   $count = count($query_res->fetchAll());
    if ($count > 0) {
      foreach ($this->conn->query("SELECT * from medicalandsurgicalhistory where MRID='$id'") as $row)
      {
        if ($row)
        {
          $_SESSION['MedicalDate'] = $row['Date_Taken_MedicalandSurgicalHistory'];
          $_SESSION['Hypertension'] = $this->Check_data($row['Hypertension']);
          $_SESSION['HeartDisease'] = $this->Check_data($row['HeartDisease']);
          $_SESSION['MedicalSickleCell'] = $this->Check_data($row['SickleCell']);
          $_SESSION['Diabetes'] = $this->Check_data($row['Diabetes']);
          $_SESSION['RespiratoryDisease'] = $this->Check_data($row['RespiratoryDisease']);
          $_SESSION['TBAsthmaChronic'] = $this->Check_data($row['TB_Asthma_Chronic']);
          $_SESSION['HIVDisease'] = $this->Check_data($row['HIVDisease']);
          $_SESSION['Epilepsy'] = $this->Check_data($row['Epilepsy']);
          $_SESSION['MentalIllness'] = $this->Check_data($row['Mental_Illness']);
          $_SESSION['Jaundice'] = $this->Check_data($row['Jaundice']);
          $_SESSION['Others'] = $this->Check_data($row['Others']);
          $_SESSION['PreviousOperation'] = $this->Check_data($row['Previous_Operation']);

            foreach ($this->conn->query("SELECT * from familyhistory where MRID='$id'") as $row)
            {
              $_SESSION['FamilyDate'] = $row['Date_Taken_FamilyHistory'];
              $_SESSION['FamilyHypertension'] = $this->Check_data($row['Hypertension']);
              $_SESSION['FamilyDiabetes'] = $this->Check_data($row['Diabetes']);
              $_SESSION['FamilyHeartDisease'] = $this->Check_data($row['Heart_Disease']);
              $_SESSION['FamilySickleCell'] = $this->Check_data($row['Sickle_Cell']);
              $_SESSION['MultiplePregnancy'] = $this->Check_data($row['Multiple_Pregnancy']);
              $_SESSION['MentalHealth'] = $this->Check_data($row['Mental_Health']);
              $_SESSION['BirthDeffect'] = $this->Check_data($row['Birth_Deffect']);
            }

            foreach ($this->conn->query("SELECT * from drughistory where MRID='$id'") as $row)
            {
              $_SESSION['DrugDate'] = $row['Date_Take_DrugHistory'];
              $_SESSION['DrugUsage'] = $this->Check_data($row['Drug_Usage']);
              $_SESSION['DetailsOfDrug'] = $this->Check_data($row['Details_Of_Drug']);
              $_SESSION['PresenceOfAllergy'] = $this->Check_data($row['Presence_Of_Allergy']);
              $_SESSION['DetailsOfAllergy'] = $this->Check_data($row['Details_Of_Allergy']);

            }

            foreach ($this->conn->query("SELECT * from contraceptivehistory where MRID='$id'") as $row)
            {
              $_SESSION['ContraceptiveDate'] = $row['Date_Taken_ContraceptiveHistory'];
              $_SESSION['AnyContraceptivePregnancy'] = $this->Check_data($row['Any_Contraceptive_Used_Prior_To_Pregnancy']);
              $_SESSION['NameOfContraceptive'] = $this->Check_data($row['If_Yes_Name_Of_Contraceptive']);
              $_SESSION['DateDiscontinued'] = $row['Date_Discontinued'];
            }

            foreach ($this->conn->query("SELECT * from sexuallytransmittedinfectionhistory where MRID='$id'") as $row)
            {
              $_SESSION['StiDate'] = $row['Date_Taken_STI_History'];
              $_SESSION['LowerAbdomenPain'] = $this->Check_data($row['Chronic_Lower_Abdomen_Pain']); $_SESSION['LowerAbdomenPain'] = $this->Check_data($row['Chronic_Lower_Abdomen_Pain']); $_SESSION['BurningSensation'] = $this->Check_data($row['Itching_Burning_Sensation_Or_Swelling']);
              $_SESSION['UrethralDischarge'] = $this->Check_data($row['Abnormal_Vaginal_Or_Urethral_Discharge']);
              $_SESSION['GenitalSores'] = $this->Check_data($row['Genital_Sores']);              $_SESSION['PainfulUrination'] = $this->Check_data($row['Painful_Urination']);          $_SESSION['LumpsGrowth'] = $this->Check_data($row['Genital_Lumps_Or_Growth']);
            }

        }
      }
    }else {
      header("location: View-History1.php?incomplete");
    }

  }
  //getting postnatal records from the database
  public function GetPostnatalRecord()
  {
    $pID = $_SESSION['patientID'];
    $getID = explode("C", $pID);
    $actualId = $getID[1];

    $query = "SELECT * from postnatalfirstvisitcareofmother where MRID='$actualId'";
   $query_res = $this->conn->query($query);
   $count = count($query_res->fetchAll());
    if ($count > 0) {
    foreach ($this->conn->query("SELECT * from postnatalfirstvisitcareofmother where MRID='$actualId'") as $row)
    {
      if($row){
      $_SESSION['complaint1'] = $this->Check_data($row['Complaints']);
      $_SESSION['Temperature1'] = $this->Check_data($row['Temperature']);
    $_SESSION['BP1'] = $this->Check_data($row['BP']);
    $_SESSION['Jaundice1'] = $this->Check_data($row['Jaundice']);
    $_SESSION['Pallor1'] = $this->Check_data($row['Pallor']);
     $_SESSION['Pulse1'] = $this->Check_data($row['Pulse']);
     $_SESSION['AbdomenTendernes1'] = $this->Check_data($row['AbdomenTendernes']);
     $_SESSION['UterusSize1'] = $this->Check_data($row['UterusSize']);
     $_SESSION['PerineumAndLochia1'] = $this->Check_data($row['PerineumAndLochia']);
      $_SESSION['LowerLimbsCalfPain1'] = $this->Check_data($row['LowerLimbsCalfPain']);
      $_SESSION['Swelling1'] = $this->Check_data($row['Swelling']);
      $_SESSION['TreatmentVitaA1'] =$row['Treatment_VitA'];
      $_SESSION['TreatmentFeloate1'] =$row['Treatment_Fefolate'];
      $_SESSION['TreatmentOthers1'] = $this->Check_data($row['Treatment_others']);
      $_SESSION['LabTestHb1'] = $this->Check_data($row['LabTest_Hb']);
     $_SESSION['LabTestHIV1'] = $this->Check_data($row['LabTest_HIV']);
     $_SESSION['Midwife1'] = $this->Check_data($row['Midwife']);
      }
   }

     //reading data from care of baby table
     foreach ($this->conn->query("SELECT * from postnatalfirstvisitcareofbaby where MRID='$actualId'") as $row)
     {
       if ($row) {
      $_SESSION['ComplaintBaby1'] = $this->Check_data($row['Complaints']);
      $_SESSION['TemperatureBaby1'] = $this->Check_data($row['Temperature']);
      $_SESSION['HeartRateBaby1']= $this->Check_data($row['HeartRate']);
      $_SESSION['JaundiceBaby1']= $this->Check_data($row['Jaundice']);
      $_SESSION['PallorBaby1']= $this->Check_data($row['Pallor']);
       $_SESSION['BreastfeedingBaby1']= $this->Check_data($row['Breastfeeding']);
      $_SESSION['ActivityBaby1']= $this->Check_data($row['Activity']);
      $_SESSION['ChestBaby1']= $this->Check_data($row['Chest']);
      $_SESSION['AbdomenBaby1']=$this->Check_data($row['Abdomen']);
      $_SESSION['HeadBaby1']=$this->Check_data($row['Head']);
      $_SESSION['LimbsBaby1']=$this->Check_data($row['Limbs']);
      $_SESSION['SpineBackBaby1']=$this->Check_data($row['SpineBack']);
      $_SESSION['UmblicalCordBaby1']=$this->Check_data($row['UmblicalCord']);
      $_SESSION['SkinBaby1']=$this->Check_data($row['Skin']);
      $_SESSION['DischargeEyesBaby1']=$this->Check_data($row['DischargeEyes']);
      $_SESSION['PassingUrineBaby1']=$this->Check_data($row['PassingUrine']);
      $_SESSION['PassingStoolBaby1']=$this->Check_data($row['PassingStool']);
      $_SESSION['VitKTreatmentBaby1']=$this->Check_data($row['VitKTreatment']);           $_SESSION['BCGTreatmentBaby1']=$this->Check_data($row['BCGTreatment']);
      $_SESSION['PolioOTreatmentBaby1']=$this->Check_data($row['PolioOTreatment']);
      $_SESSION['OtherTreatmentBaby1']=$this->Check_data($row['OtherTreatment']);
       $_SESSION['DateNextVisitBaby1'] =$row['DateNextVisit'];
       }
     }
   }else {
     header("location: Postnatal.php?norecord2");
   }

   }
//chcecking if the data is empty or has string value
   public function Check_data($string)
   {
     $result ="";
     if (empty($string)) {
       $result = "No Record";
     }else {
       $result = $string;
      }
      return $result;
   }
   //getting postnatal records from the database
   public function GetPostnatalFollowupRecord()
   {
     $pID = $_SESSION['patientID'];
     $getID = explode("C", $pID);
     $actualId = $getID[1];

     $query = "SELECT * from  postnatalsecondvisitcareofmother where MRID='$actualId'";
     $query_res = $this->conn->query($query);
     $count = count($query_res->fetchAll());
     if ($count > 0) {

     foreach ($this->conn->query("SELECT * from  postnatalsecondvisitcareofmother where MRID='$actualId'") as $row)
     {
         if($row){
         $_SESSION['complaint2'] = $this->Check_data($row['Complaints']);
         $_SESSION['Temperature2'] = $this->Check_data($row['Temperature']);
       $_SESSION['BP2'] = $this->Check_data($row['BP']);
       $_SESSION['Jaundice2'] = $this->Check_data($row['Jaundice']);
       $_SESSION['Pallor2'] = $this->Check_data($row['Pallor']);
        $_SESSION['Pulse2'] = $this->Check_data($row['Pulse']);
        $_SESSION['AbdomenTendernes2'] = $this->Check_data($row['AbdomenTendernes']);
        $_SESSION['UterusSize2'] = $this->Check_data($row['UterusSize']);
        $_SESSION['PerineumAndLochia2'] = $this->Check_data($row['PerineumAndLochia']);
         $_SESSION['LowerLimbsCalfPain2'] = $this->Check_data($row['LowerLimbsCalfPain']);
         $_SESSION['Swelling2'] = $this->Check_data($row['Swelling']);
         $_SESSION['TreatmentVitaA2'] =$row['Treatment_VitA'];
         $_SESSION['TreatmentFeloate2'] =$row['Treatment_Fefolate'];
         $_SESSION['TreatmentOthers2'] = $this->Check_data($row['Treatment_others']);
         $_SESSION['LabTestHB2'] = $this->Check_data($row['LabTest_Hb']);
        $_SESSION['LabTestHIV2'] = $this->Check_data($row['LabTest_HIV']);
        $_SESSION['Midwife2'] = $this->Check_data($row['Midwife']);
       }
      }

      //reading data from care of baby table
      foreach ($this->conn->query("SELECT * from postnatalsecondvisitcareofbaby where MRID='$actualId'") as $row)
      {
        if ($row) {
       $_SESSION['ComplaintBaby2'] = $this->Check_data($row['Complaints']);
       $_SESSION['TemperatureBaby2'] = $this->Check_data($row['Temperature']);
       $_SESSION['HeartRateBaby2']= $this->Check_data($row['HeartRate']);
       $_SESSION['JaundiceBaby2']= $this->Check_data($row['Jaundice']);
       $_SESSION['PallorBaby2']= $this->Check_data($row['Pallor']);
        $_SESSION['BreastfeedingBaby2']= $this->Check_data($row['Breastfeeding']);
       $_SESSION['ActivityBaby2']= $this->Check_data($row['Activity']);
       $_SESSION['ChestBaby2']= $this->Check_data($row['Chest']);
       $_SESSION['AbdomenBaby2']=$this->Check_data($row['Abdomen']);
       $_SESSION['HeadBaby2']=$this->Check_data($row['Head']);
       $_SESSION['LimbsBaby2']=$this->Check_data($row['Limbs']);
       $_SESSION['SpineBackBaby2']=$this->Check_data($row['SpineBack']);
       $_SESSION['UmblicalCordBaby2']=$this->Check_data($row['UmblicalCord']);
       $_SESSION['SkinBaby2']=$this->Check_data($row['Skin']);
       $_SESSION['DischargeEyesBaby2']=$this->Check_data($row['DischargeEyes']);
       $_SESSION['PassingUrineBaby2']=$this->Check_data($row['PassingUrine']);
       $_SESSION['PassingStoolBaby2']=$this->Check_data($row['PassingStool']);
       $_SESSION['VitKTreatmentBaby2']=$this->Check_data($row['VitKTreatment']);           $_SESSION['BCGTreatmentBaby2']=$this->Check_data($row['BCGTreatment']);
       $_SESSION['PolioOTreatmentBaby2']=$this->Check_data($row['PolioOTreatment']);
       $_SESSION['OtherTreatmentBaby2']=$this->Check_data($row['OtherTreatment']);
        $_SESSION['DateNextVisitBaby2'] =$row['DateNextVisit'];

        }
      }
    }else {
      header("location: Postnatal.php?norecord");
    }
  }

    //getting postnatal records from the database
    public function GetPostnatalSixweeksRecord()
    {
      $pID = $_SESSION['patientID'];
      $getID = explode("C", $pID);
      $actualId = $getID[1];
      //verifying if there are records on postnatal 6weeks table in the database
      $query = "SELECT * from  postnatalsixweekscareofmother where MRID='$actualId'";
      $query_res = $this->conn->query($query);
      $count = count($query_res->fetchAll());
      if ($count > 0) {

      foreach ($this->conn->query("SELECT * from  postnatalsixweekscareofmother where MRID='$actualId'") as $row)
      {
        if($row){
        $_SESSION['complaint3'] = $this->Check_data($row['Complaints']);
        $_SESSION['Temperature3'] = $this->Check_data($row['Temperature']);
      $_SESSION['BP3'] = $this->Check_data($row['BP']);
      $_SESSION['Jaundice3'] = $this->Check_data($row['Jaundice']);
      $_SESSION['Pallor3'] = $this->Check_data($row['Pallor']);
       $_SESSION['Pulse3'] = $this->Check_data($row['Pulse']);
       $_SESSION['AbdomenTendernes3'] = $this->Check_data($row['AbdomenTendernes']);
       $_SESSION['UterusSize3'] = $this->Check_data($row['UterusSize']);
       $_SESSION['PerineumAndLochia3'] = $this->Check_data($row['PerineumAndLochia']);
        $_SESSION['LowerLimbsCalfPain3'] = $this->Check_data($row['LowerLimbsCalfPain']);
        $_SESSION['Swelling3'] = $this->Check_data($row['Swelling']);
        $_SESSION['TreatmentVitaA3'] =$row['Treatment_VitA'];
        $_SESSION['TreatmentFeloate3'] =$row['Treatment_Fefolate'];
        $_SESSION['TreatmentOthers3'] = $this->Check_data($row['Treatment_others']);
        $_SESSION['LabTestHB3'] = $this->Check_data($row['LabTest_Hb']);
       $_SESSION['LabTestHIV3'] = $this->Check_data($row['LabTest_HIV']);
       $_SESSION['Midwife3'] = $this->Check_data($row['Midwife']);
      }
    }

       //reading data from care of baby table
       foreach ($this->conn->query("SELECT * from postnatalsixweekscareofbaby where MRID='$actualId'") as $row)
       {
         if ($row) {

        $_SESSION['ComplaintBaby3'] = $this->Check_data($row['Complaints']);
        $_SESSION['TemperatureBaby3'] = $this->Check_data($row['Temperature']);
        $_SESSION['HeartRateBaby3']= $this->Check_data($row['HeartRate']);
        $_SESSION['JaundiceBaby3']= $this->Check_data($row['Jaundice']);
        $_SESSION['PallorBaby3']= $this->Check_data($row['Pallor']);
         $_SESSION['BreastfeedingBaby3']= $this->Check_data($row['Breastfeeding']);
        $_SESSION['ActivityBaby3']= $this->Check_data($row['Activity']);
        $_SESSION['ChestBaby3']= $this->Check_data($row['Chest']);
        $_SESSION['AbdomenBaby3']=$this->Check_data($row['Abdomen']);
        $_SESSION['HeadBaby3']=$this->Check_data($row['Head']);
        $_SESSION['LimbsBaby3']=$this->Check_data($row['Limbs']);
        $_SESSION['SpineBackBaby3']=$this->Check_data($row['SpineBack']);
        $_SESSION['UmblicalCordBaby3']=$this->Check_data($row['UmblicalCord']);
        $_SESSION['SkinBaby3']=$this->Check_data($row['Skin']);
        $_SESSION['DischargeEyesBaby3']=$this->Check_data($row['DischargeEyes']);
        $_SESSION['PassingUrineBaby3']=$this->Check_data($row['PassingUrine']);
        $_SESSION['PassingStoolBaby3']=$this->Check_data($row['PassingStool']);
        $_SESSION['VitKTreatmentBaby3']=$this->Check_data($row['VitKTreatment']);           $_SESSION['BCGTreatmentBaby3']=$this->Check_data($row['BCGTreatment']);
        $_SESSION['PolioOTreatmentBaby3']=$this->Check_data($row['PolioOTreatment']);
        $_SESSION['OtherTreatmentBaby3']=$this->Check_data($row['OtherTreatment']);
         $_SESSION['DateNextVisitBaby3'] =$row['DateNextVisit'];
         }
       }
     }else {
       header("location: Postnatal.php?norecord3");
     }

     }


//validate records sent to the database to avoid multiple data
   function validateRecord($string)
   {
     if (($string == "No Records") || ($string == "No Record")) {
       $string = '';
       return $string;
     }else{
       return $string;
     }
   }
//update records from postnatal delivery table
   public function Update_Delivery_Outcome()
   {
     //declaring varibales
     $placeOfDelivery = $this->validateRecord(trim($_POST['PlaceOfDelivery']));
     $emergencyOperation = $this->validateRecord(trim($_POST['EmergencyOperation']));
     $date = date("d-M-Y");
     $month = date("m");
     $year = date("Y");
     $emergencyBlood= $this->validateRecord(trim($_POST['BloodContact']));
     $deliveryDate = $this->validateRecord(trim($_POST['deliveryDate']));
     $deliveryPlace = $this->validateRecord(trim($_POST['deliveryPlace']));
     $babyDeadOrAlive= $this->validateRecord(trim($_POST['babyAliveOrDead']));
     $ifHomeDelivery = $this->validateRecord(trim($_POST['ifHome']));
     $facilityName = $this->validateRecord(trim($_POST['FacilityName']));
     $labourSpont = $this->validateRecord(trim($_POST['labourSpont']));
     $labourInduced = $this->validateRecord(trim($_POST['labourInduced']));
     $labourAugmented = $this->validateRecord(trim($_POST['labourAugmented']));
     $deliveryDate2 = trim($_POST['DeliveryDate2']);
     $deliveryTime = trim($_POST['DeliveryTime']);
     $labourDuration = $this->validateRecord(trim($_POST['labourDuration']));
     $deliveryMode = $this->validateRecord(trim($_POST['DeliveryMode']));
     $ifCS= $this->validateRecord(trim($_POST['ifCS']));
     $labourComplication = $this->validateRecord(trim($_POST['labourComplication']));
     $dischargeDate = trim($_POST['dischargeDate']);
     $conditionBP = $this->validateRecord(trim($_POST['conditionBP']));
     $conditionPulse = $this->validateRecord(trim($_POST['conditionPulse']));
     $conditionPerineum = $this->validateRecord(trim($_POST['conditionPerineum']));
     $conditionLocia = $this->validateRecord(trim($_POST['conditionlocia']));
     $lactation = $this->validateRecord(trim($_POST['lactation']));
     $labourSignature = $this->validateRecord(trim($_POST['labourSignature']));
     $nextVisitDate = trim($_POST['nextVisitDate']);
     $babySex =$this->validateRecord(trim($_POST['babySex']));
     $babyWeight= $this->validateRecord(trim($_POST['babyWeight']));
     $oneMin = $this->validateRecord(trim($_POST['oneMin']));
     $fiveMins = $this->validateRecord(trim($_POST['fiveMins']));
     $babyCongenital = $this->validateRecord(trim($_POST['babyCongenital']));
     $babyCondition = $this->validateRecord(trim($_POST['babyCondition']));
     $babyDischarging = $this->validateRecord(trim($_POST['babyDischarging']));
     $babyJaundice = $this->validateRecord(trim($_POST['babyJaundice']));
     $babyMeconium = $this->validateRecord(trim($_POST['meconium']));
     $sucklingEstablished = $this->validateRecord(trim($_POST['sucklingEstablished']));

     //getting patient ID
     $pID = $_SESSION['patID'];
     $getID = explode("C", $pID);
     $actualId = $getID[1];

     try {
       //connecting to database
       $sql = $this->conn->prepare("UPDATE decisionmadeonbirthpreparedness SET Place_Of_Delivery='$placeOfDelivery',Emergency_Operation_Contact='$emergencyOperation',Emergency_Blood_Contact='$emergencyBlood' WHERE MRID='$actualId'");
       $sql->execute();
        $sql = $this->conn->prepare(" UPDATE summaryoflabourordeliveryoutcome SET Date_Of_Delivery='$deliveryDate',Place_Of_Delivery='$deliveryPlace',If_Home_Delivery_Who_Attended_Delivery='$ifHomeDelivery',If_Health_Facility_Name_Of_The_Facility='$facilityName',Type_OF_Labour_Spont='$labourSpont',Type_Of_Labour_Induced='$labourInduced',
        Type_Of_Labour_Augmented='$labourAugmented',Delivery_Date='$deliveryDate2',Delivery_Time='$deliveryTime',Duration_Of_Labour='$labourDuration',Condition_Of_Child='$babyDeadOrAlive',Mode_Of_Delivery='$deliveryMode',Condition_of_Child='$babyDeadOrAlive',If_CS_Delivery_Complication='$ifCS',Labour_complication='$labourComplication',
        Date_OF_Discharge='$dischargeDate',Condition_At_Discharge_In_BP='$conditionBP',Condition_At_Discharge_In_Pulse='$conditionPulse',Condition_At_Discharge_In_Perineum='$conditionPerineum',Condition_At_Discharge_In_Lochia='$conditionLocia',Lactation_Established='$lactation',
        Midwife_Name='$labourSignature',Date_Of_Next_Visit='$nextVisitDate',Sex_Of_Baby='$babySex',Birth_Weight='$babyWeight',Apgar_Score_1min='$oneMin',Apgar_Score_5min='$fiveMins',Congenital_Abnormalities='$babyCongenital',Baby_Condition_At_Discharge='$babyCondition',Baby_Discharging_Eyes='$babyDischarging',Baby_Has_Jaundice='$babyJaundice',
        Baby_Has_Meconium='$babyMeconium',Suckling_Established_In_Baby='$sucklingEstablished'
        WHERE MRID='$actualId'");
        $sql->execute();

        header("Location: View-Delivery-Outcome.php?success");

     } catch (Exception $e) {
       $_SESSION['database_error'] = $ex->getMessage();
       header("Location: View-Delivery-Outcome.php?dataerror");
     }

   }

   //update records from postnatal first visit records
      public function Update_Postnatal_First_Visit()
      {
         $pID = $_SESSION['patientID'];
         $getID = explode("C", $pID);
         $actualId = $getID[1];
            $motherComplaint= $this->validateRecord(trim($_POST['motherComplaint']));
         $motherTemperature= $this->validateRecord(trim($_POST['motherTemperature']));
         $motherBp = $this->validateRecord(trim($_POST['motherBP']));
         $motherPulse = $this->validateRecord(trim($_POST['motherPulse']));
         $motherPallor = $this->validateRecord(trim($_POST['motherPallor']));
         $motherJaundice = $this->validateRecord(trim($_POST['motherJaundice']));
         $motherBreastNipple = "";
         if(isset($_POST['motherBreastNormal'])) {
          $motherBreastNipple = "Normal";
         }else{
          $motherBreastNipple = trim($_POST['motherBreastAbnormalState']);
         }
         $motherTenderness = $this->validateRecord(trim($_POST['motherTenderness']));
         $motherUterusSize = $this->validateRecord(trim($_POST['motherUterusSize']));
         $motherPrenium = $this->validateRecord(trim($_POST['motherPrenium']));
         $motherlimbsCalf = $this->validateRecord(trim($_POST['motherlimbsCalf']));
         $motherSwelling = $this->validateRecord(trim($_POST['motherSwelling']));
         $treatmentVitA = "";
         $treatmentFeloate ="";
         if(isset($_POST['motherVit_A'])) {
          $treatmentVitA = "Vitamin A";
         }
         if(isset($_POST['motherFolate'])){
            $treatmentFeloate  = "Fe/Folate";
         }
         $treatmentOthers  =  $this->validateRecord(trim($_POST['motherOther']));
         $motherHb = $this->validateRecord(trim($_POST['motherHb']));
         $motherHiv = $this->validateRecord(trim($_POST['motherHiv']));
         $babyCareComplaint = $this->validateRecord(trim($_POST['babyCareComplaint']));
         $babyTemp = $this->validateRecord(trim($_POST['babyTemp']));
         $babyHeartRate = $this->validateRecord(trim($_POST['babyHeartRate']));
         $babyPallor = $this->validateRecord(trim($_POST['babyPallor']));
         $babyJaundice = $this->validateRecord(trim($_POST['babyJaundice']));
         $babyBreastfeeding = $this->validateRecord(trim($_POST['babyBreastfeeding']));
         $babyActivity = $this->validateRecord(trim($_POST['babyActivity']));
         $babyChest = $this->validateRecord(trim($_POST['babyChest']));
         $babyAbdomen = $this->validateRecord(trim($_POST['babyAbdomen']));
         $babyLimbs = $this->validateRecord(trim($_POST['babyLimbs']));
         $babyHead = $this->validateRecord(trim($_POST['babyHead']));
         $babySpine = $this->validateRecord(trim($_POST['babySpine']));
         $babyUmbilicalCord = $this->validateRecord(trim($_POST['babyUmbilicalCord']));
         $babySkin = $this->validateRecord(trim($_POST['babySkin']));
         $babyDicharginEyes = $this->validateRecord(trim($_POST['babyDicharginEyes']));
         $babyPassingUrine = $this->validateRecord(trim($_POST['babyPassingUrine']));
         $babyPassingStool = $this->validateRecord(trim($_POST['babyPassingStool']));
         $babyVitaminK = $this->validateRecord(trim($_POST['babyVitaminK']));
         $babybcg = $this->validateRecord(trim($_POST['babybcg']));
         $babyPolio = $this->validateRecord(trim($_POST['babyPolio']));
         $babyOthers = $this->validateRecord(trim($_POST['babyOthers']));
         $babyNextDate = $this->validateRecord(trim($_POST['babyNextDate']));
         $babyMidwifeSig = $this->validateRecord(trim($_POST['babyMidwifeSig']));
         $fullname = $_SESSION['patientName'];


         try {
           $sql = $this->conn->prepare("UPDATE postnatalfirstvisitcareofmother SET Complaints='$motherComplaint',Temperature='$motherTemperature',BP='$motherBp',Jaundice='$motherJaundice',Pallor=' $motherPallor',Pulse='$motherPulse',BreastAndNipple='$motherBreastNipple',AbdomenTendernes='$motherTenderness',PerineumAndLochia='$motherPrenium',LowerLimbsCalfPain='$motherlimbsCalf',UterusSize='$motherUterusSize',
   Swelling='$motherSwelling',Treatment_VitA='$treatmentVitA',Treatment_Fefolate='$treatmentFeloate',Treatment_others='$treatmentOthers',LabTest_Hb='$motherHb',LabTest_HIV='$motherHiv',DateNextVisit='$babyNextDate',Midwife=' $babyMidwifeSig'
              WHERE MRID='$actualId'");
           $sql->execute();

$sql = $this->conn->prepare("UPDATE postnatalfirstvisitcareofbaby SET Complaints='$babyCareComplaint',Breastfeeding='$babyBreastfeeding',Temperature='$babyTemp',HeartRate='$babyHeartRate',Pallor=' $babyPallor',Jaundice='$babyJaundice',Activity='$babyActivity',Chest='$babyChest',Abdomen='$babyAbdomen',Limbs='$babyLimbs',Head='$babyHead',
   SpineBack='$babySpine',UmblicalCord='$babyUmbilicalCord', Skin='$babySkin',DischargeEyes='$babyDicharginEyes', PassingUrine='$babyPassingUrine',PassingStool='$babyPassingStool',VitKTreatment='$babyVitaminK',BCGTreatment='$babybcg',PolioOTreatment='$babyPolio',OtherTreatment='$babyOthers',DateNextVisit='$babyNextDate'
   WHERE MRID='$actualId'");
    $sql->execute();

             header("location: View-Postnatal-First-Visit.php?success");
         } catch (Exception $ex) {
           $_SESSION['database_error'] = $ex->getMessage();
           header("Location: View-Postnatal-First-Visit.php?dataerror");
         }

      }

      //update records from postnatal followup visit records
         public function Update_Postnatal_Followup_Visit()
         {
            $pID = $_SESSION['patientID'];
            $getID = explode("C", $pID);
            $actualId = $getID[1];
            $motherComplaint= $this->validateRecord(trim($_POST['motherComplaint']));
            $motherTemperature= $this->validateRecord(trim($_POST['motherTemperature']));
            $motherBp = $this->validateRecord(trim($_POST['motherBP']));
            $motherPulse = $this->validateRecord(trim($_POST['motherPulse']));
            $motherPallor = $this->validateRecord(trim($_POST['motherPallor']));
            $motherJaundice = $this->validateRecord(trim($_POST['motherJaundice']));
            $motherBreastNipple = "";
            if(isset($_POST['motherBreastNormal'])) {
             $motherBreastNipple = "Normal";
            }else{
             $motherBreastNipple = trim($_POST['motherBreastAbnormalState']);
            }
            $motherTenderness = $this->validateRecord(trim($_POST['motherTenderness']));
            $motherUterusSize = $this->validateRecord(trim($_POST['motherUterusSize']));
            $motherPrenium = $this->validateRecord(trim($_POST['motherPrenium']));
            $motherlimbsCalf = $this->validateRecord(trim($_POST['motherlimbsCalf']));
            $motherSwelling = $this->validateRecord(trim($_POST['motherSwelling']));
            $treatmentVitA = "";
            $treatmentFeloate ="";
            if(isset($_POST['motherVit_A'])) {
             $treatmentVitA = "Vitamin A";
            }
            if(isset($_POST['motherFolate'])){
               $treatmentFeloate  = "Fe/Folate";
            }
            $treatmentOthers  =  $this->validateRecord(trim($_POST['motherOther']));
            $motherHb = $this->validateRecord(trim($_POST['motherHb']));
            $motherHiv = $this->validateRecord(trim($_POST['motherHiv']));
            $babyCareComplaint = $this->validateRecord(trim($_POST['babyCareComplaint']));
            $babyTemp = $this->validateRecord(trim($_POST['babyTemp']));
            $babyHeartRate = $this->validateRecord(trim($_POST['babyHeartRate']));
            $babyPallor = $this->validateRecord(trim($_POST['babyPallor']));
            $babyJaundice = $this->validateRecord(trim($_POST['babyJaundice']));
            $babyBreastfeeding = $this->validateRecord(trim($_POST['babyBreastfeeding']));
            $babyActivity = $this->validateRecord(trim($_POST['babyActivity']));
            $babyChest = $this->validateRecord(trim($_POST['babyChest']));
            $babyAbdomen = $this->validateRecord(trim($_POST['babyAbdomen']));
            $babyLimbs = $this->validateRecord(trim($_POST['babyLimbs']));
            $babyHead = $this->validateRecord(trim($_POST['babyHead']));
            $babySpine = $this->validateRecord(trim($_POST['babySpine']));
            $babyUmbilicalCord = $this->validateRecord(trim($_POST['babyUmbilicalCord']));
            $babySkin = $this->validateRecord(trim($_POST['babySkin']));
            $babyDicharginEyes = $this->validateRecord(trim($_POST['babyDicharginEyes']));
            $babyPassingUrine = $this->validateRecord(trim($_POST['babyPassingUrine']));
            $babyPassingStool = $this->validateRecord(trim($_POST['babyPassingStool']));
            $babyVitaminK = $this->validateRecord(trim($_POST['babyVitaminK']));
            $babybcg = $this->validateRecord(trim($_POST['babybcg']));
            $babyPolio = $this->validateRecord(trim($_POST['babyPolio']));
            $babyOthers = $this->validateRecord(trim($_POST['babyOthers']));
            $babyNextDate = $this->validateRecord(trim($_POST['babyNextDate']));
            $babyMidwifeSig = $this->validateRecord(trim($_POST['babyMidwifeSig']));
            $fullname = $_SESSION['patientName'];


            try {
              $sql = $this->conn->prepare("UPDATE postnatalsecondvisitcareofmother SET Complaints='$motherComplaint',Temperature='$motherTemperature',BP='$motherBp',Jaundice='$motherJaundice',Pallor=' $motherPallor',Pulse='$motherPulse',BreastAndNipple='$motherBreastNipple',AbdomenTendernes='$motherTenderness',PerineumAndLochia='$motherPrenium',LowerLimbsCalfPain='$motherlimbsCalf',UterusSize='$motherUterusSize',
      Swelling='$motherSwelling',Treatment_VitA='$treatmentVitA',Treatment_Fefolate='$treatmentFeloate',Treatment_others='$treatmentOthers',LabTest_Hb='$motherHb',LabTest_HIV='$motherHiv',DateNextVisit='$babyNextDate',Midwife=' $babyMidwifeSig'
                 WHERE MRID='$actualId'");
              $sql->execute();

      $sql = $this->conn->prepare("UPDATE postnatalsecondvisitcareofbaby SET Complaints='$babyCareComplaint',Breastfeeding='$babyBreastfeeding',Temperature='$babyTemp',HeartRate='$babyHeartRate',Pallor=' $babyPallor',Jaundice='$babyJaundice',Activity='$babyActivity',Chest='$babyChest',Abdomen='$babyAbdomen',Limbs='$babyLimbs',Head='$babyHead',
      SpineBack='$babySpine',UmblicalCord='$babyUmbilicalCord', Skin='$babySkin',DischargeEyes='$babyDicharginEyes', PassingUrine='$babyPassingUrine',PassingStool='$babyPassingStool',VitKTreatment='$babyVitaminK',BCGTreatment='$babybcg',PolioOTreatment='$babyPolio',OtherTreatment='$babyOthers',DateNextVisit='$babyNextDate'
      WHERE MRID='$actualId'");
       $sql->execute();

                header("location: View-Postnatal-Followup-Visit.php?success");
            } catch (Exception $ex) {
              $_SESSION['database_error'] = $ex->getMessage();
              header("Location: View-Postnatal-Followup-Visit.php?dataerror");
            }

         }
         //update records from postnatal followup visit records
            public function Update_Postnatal_Sixweeks_Visit()
            {
               $pID = $_SESSION['patientID'];
               $getID = explode("C", $pID);
               $actualId = $getID[1];
                  $motherComplaint= $this->validateRecord(trim($_POST['motherComplaint']));
               $motherTemperature= $this->validateRecord(trim($_POST['motherTemperature']));
               $motherBp = $this->validateRecord(trim($_POST['motherBP']));
               $motherPulse = $this->validateRecord(trim($_POST['motherPulse']));
               $motherPallor = $this->validateRecord(trim($_POST['motherPallor']));
               $motherJaundice = $this->validateRecord(trim($_POST['motherJaundice']));
               $motherBreastNipple = "";
               if(isset($_POST['motherBreastNormal'])) {
                $motherBreastNipple = "Normal";
               }else{
                $motherBreastNipple = trim($_POST['motherBreastAbnormalState']);
               }
               $motherTenderness = $this->validateRecord(trim($_POST['motherTenderness']));
               $motherUterusSize = $this->validateRecord(trim($_POST['motherUterusSize']));
               $motherPrenium = $this->validateRecord(trim($_POST['motherPrenium']));
               $motherlimbsCalf = $this->validateRecord(trim($_POST['motherlimbsCalf']));
               $motherSwelling = $this->validateRecord(trim($_POST['motherSwelling']));
               $treatmentVitA = "";
               $treatmentFeloate ="";
               if(isset($_POST['motherVit_A'])) {
                $treatmentVitA = "Vitamin A";
               }
               if(isset($_POST['motherFolate'])){
                  $treatmentFeloate  = "Fe/Folate";
               }
               $treatmentOthers  =  $this->validateRecord(trim($_POST['motherOther']));
               $motherHb = $this->validateRecord(trim($_POST['motherHb']));
               $motherHiv = $this->validateRecord(trim($_POST['motherHiv']));
               $babyCareComplaint = $this->validateRecord(trim($_POST['babyCareComplaint']));
               $babyTemp = $this->validateRecord(trim($_POST['babyTemp']));
               $babyHeartRate = $this->validateRecord(trim($_POST['babyHeartRate']));
               $babyPallor = $this->validateRecord(trim($_POST['babyPallor']));
               $babyJaundice = $this->validateRecord(trim($_POST['babyJaundice']));
               $babyBreastfeeding = $this->validateRecord(trim($_POST['babyBreastfeeding']));
               $babyActivity = $this->validateRecord(trim($_POST['babyActivity']));
               $babyChest = $this->validateRecord(trim($_POST['babyChest']));
               $babyAbdomen = $this->validateRecord(trim($_POST['babyAbdomen']));
               $babyLimbs = $this->validateRecord(trim($_POST['babyLimbs']));
               $babyHead = $this->validateRecord(trim($_POST['babyHead']));
               $babySpine = $this->validateRecord(trim($_POST['babySpine']));
               $babyUmbilicalCord = $this->validateRecord(trim($_POST['babyUmbilicalCord']));
               $babySkin = $this->validateRecord(trim($_POST['babySkin']));
               $babyDicharginEyes = $this->validateRecord(trim($_POST['babyDicharginEyes']));
               $babyPassingUrine = $this->validateRecord(trim($_POST['babyPassingUrine']));
               $babyPassingStool = $this->validateRecord(trim($_POST['babyPassingStool']));
               $babyVitaminK = $this->validateRecord(trim($_POST['babyVitaminK']));
               $babybcg = $this->validateRecord(trim($_POST['babybcg']));
               $babyPolio = $this->validateRecord(trim($_POST['babyPolio']));
               $babyOthers = $this->validateRecord(trim($_POST['babyOthers']));
               $babyNextDate = $this->validateRecord(trim($_POST['babyNextDate']));
               $babyMidwifeSig = $this->validateRecord(trim($_POST['babyMidwifeSig']));
               $fullname = $_SESSION['patientName'];


               try {
                 $sql = $this->conn->prepare("UPDATE  postnatalsixweekscareofmother SET Complaints='$motherComplaint',Temperature='$motherTemperature',BP='$motherBp',Jaundice='$motherJaundice',Pallor=' $motherPallor',Pulse='$motherPulse',BreastAndNipple='$motherBreastNipple',AbdomenTendernes='$motherTenderness',PerineumAndLochia='$motherPrenium',LowerLimbsCalfPain='$motherlimbsCalf',UterusSize='$motherUterusSize',
         Swelling='$motherSwelling',Treatment_VitA='$treatmentVitA',Treatment_Fefolate='$treatmentFeloate',Treatment_others='$treatmentOthers',LabTest_Hb='$motherHb',LabTest_HIV='$motherHiv',DateNextVisit='$babyNextDate',Midwife=' $babyMidwifeSig'
                    WHERE MRID='$actualId'");
                 $sql->execute();

         $sql = $this->conn->prepare("UPDATE postnatalsixweekscareofbaby SET Complaints='$babyCareComplaint',Breastfeeding='$babyBreastfeeding',Temperature='$babyTemp',HeartRate='$babyHeartRate',Pallor=' $babyPallor',Jaundice='$babyJaundice',Activity='$babyActivity',Chest='$babyChest',Abdomen='$babyAbdomen',Limbs='$babyLimbs',Head='$babyHead',
         SpineBack='$babySpine',UmblicalCord='$babyUmbilicalCord', Skin='$babySkin',DischargeEyes='$babyDicharginEyes', PassingUrine='$babyPassingUrine',PassingStool='$babyPassingStool',VitKTreatment='$babyVitaminK',BCGTreatment='$babybcg',PolioOTreatment='$babyPolio',OtherTreatment='$babyOthers',DateNextVisit='$babyNextDate'
         WHERE MRID='$actualId'");
          $sql->execute();

                   header("location: View-Postnatal-Sixweeks-Visit.php?success");
               } catch (Exception $ex) {
                 $_SESSION['database_error'] = $ex->getMessage();
                 header("Location: View-Postnatal-Sixweeks-Visit.php?dataerror");
               }

            }


//getting patient's id and contact from the database for message processing
   public function FetchData($id)
   {

     try{
       $query = "SELECT * from mothersrecord where MRID='$id'";
       $query_res = $this->conn->query($query);
       $count = count($query_res->fetchAll());
       if ($count > 0) {

         foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
         {
           if ($row)
           {
             $_SESSION['smsAntenatalId'] = $row['Patient_Number'];
             $_SESSION['smsAntenatalFullname']  = $row['Full_Name'];
              $_SESSION['smsAntenatalContact']  = $row['Telephone'];
              $_SESSION['Antenatalfn']  = $row['FirstName'];
               header("location: Send-Antenatal-SMS.php");
               exit();
           }
       }

       }else {
      header("location: SMS-Search.php?Incorrect");
      exit();
     }

    }catch(Exception $e){
     header("location: SMS-Search.php?Incorrect");
    }
  }

  //getting emergency antenatcare details
  public function FetchEmergencyData($id)
  {

    try{
    foreach ($this->conn->query("SELECT * from emergencyconsultation where FID='$id'") as $row)
    {
      if ($row)
      {
        $_SESSION['smsId'] = $row['FID'];
        $_SESSION['smsFullname']  = $row['FirstName']." ".$row['LastName'];
         $_SESSION['smsContact']  = $row['Contact'];
         $_SESSION['fn']  = $row['FirstName'];
          header("location: Send-SMS.php");
          exit();
      }else {
     header("location: SMS-Search.php?iderror");
     exit();
    }
  }
   }catch(Exception $e){
    header("location: SMS-Search.php?iderror");
   }
 }
//this handle SMS reply to patient who apply for emergency consultation
function EmergencySMSReply($name,$contact,$message)
{
  //sms api url
  $smsurl = "http://api.smsonlinegh.com/sendsms.php";
  //account
$user = urlencode("kofiagyemangopambour@gmail.com");
// account password
$password = urlencode("sex.com123");
// the message to send
$message = urlencode("Hi {$name}, {$message}");
// ID to show sender of message.
$sender = urlencode("A_natalCare");
// message type to send. Set it to 0 (Text)
$type = 0;
// destination numbers. Each must be separated by a comma
$destination = $contact;
// set the parameter string.
$params="user={$user}&password={$password}&message={$message}".
"&type={$type}&sender={$sender}&destination={$destination}";
// send the message and show the response.
$liveurl = "{$smsurl}?{$params}";
readfile($liveurl);

}
//send sms method
public function SendSMS($name,$contact,$message)
{
  //sms api url
  $smsurl = "http://api.smsonlinegh.com/sendsms.php";
  //account
$user = urlencode("kofiagyemangopambour@gmail.com");
// account password
$password = urlencode("sex.com123");
// the message to send
$message = urlencode("Hi {$name}, {$message}");
// ID to show sender of message.
$sender = urlencode("A_natalCare");
// message type to send. Set it to 0 (Text)
$type = 0;
// destination numbers. Each must be separated by a comma
$destination = $contact;
// set the parameter string.
$params="user={$user}&password={$password}&message={$message}".
"&type={$type}&sender={$sender}&destination={$destination}";
// send the message and show the response.
$liveurl = "{$smsurl}?{$params}";
//readfile($liveurl);
if(!readfile($liveurl)){
header("location: Send-SMS.php?fail");

}else {

 header("location: Send-SMS.php?Sucess");

}

}
//getting patient's records from the database
public function FetchPatientData($id)
{
      foreach ($this->conn->query("SELECT * from mothersrecord where MRID='$id'") as $row)
      {
        if ($row)
        {
          $_SESSION['eId'] = $row['Patient_Number'];
          $_SESSION['eFirstName']  = $row['FirstName'];
           $_SESSION['eLastName']  = $row['LastName'];
           $_SESSION['eMiddlename']  = $row['MiddleName'];
          $_SESSION['eAge']  = $row['Age'];
          $_SESSION['eDateOfBirth']  = $row['DateOfBirth'];
          $_SESSION['eEducationalStatus']  = $row['EducationalStatus'];
          $_SESSION['eMarritalStatus']  = $row['MarritalStatus'];
          $_SESSION['eOccupation']  = $row['Occupation'];
          $_SESSION['eTelephone']  = $row['Telephone'];
          $_SESSION['eHouseNumber']  = $row['HouseNumber'];
          $_SESSION['eStreetName']  = $row['StreetName'];
          $_SESSION['eLocation']  = $row['Location'];
          $_SESSION['eDateVisit']  = $row['Date_Of_First_Visit'];
          $_SESSION['eMidwife']  = $row['Name_Of_Midwife_Or_Doctor'];

        }
    }
}
//getting patient's records from the database
public function FetchPartnerData($id)
{
      foreach ($this->conn->query("SELECT * from partnersrecord where MRID='$id'") as $row)
      {
        if ($row)
        {
          $_SESSION['pFirstName']  = $row['FirstName'];
           $_SESSION['pLastName']  = $row['LastName'];
           $_SESSION['pMiddlename']  = $row['MiddleName'];
          $_SESSION['pAge']  = $row['Age'];
          $_SESSION['pEducationalStatus']  = $row['EducationalStatus'];
           $_SESSION['pMarritalStatus']  = $row['MarritalStatus'];
          $_SESSION['pOccupation']  = $row['Occupation'];
           $_SESSION['pTelephone']  = $row['Telephone'];
           $_SESSION['pHouseNumber']  = $row['HouseNumber'];
           $_SESSION['pStreetName']  = $row['StreetName'];
           $_SESSION['pLocation']  = $row['Location'];

        }
    }
}
//method to udpate patients personal records
  public function Update_Patner_infomation($identity)
  {

      $fname = $this->validateRecord(trim($_POST['fn2']));
      $midname = $this->validateRecord(trim($_POST['mn2']));
      $lname = $this->validateRecord(trim($_POST['ln2']));
    //  $patientID = $_SESSION['patientID'];
      $age = $this->validateRecord(trim($_POST['age2']));
      $edu_status = $this->validateRecord(trim($_POST['edu_status2']));
      $marital_status = $this->validateRecord(trim($_POST['marital_status2']));
      $occupation = $this->validateRecord(trim($_POST['occupation2']));
      $contact = $this->validateRecord(trim($_POST['contact2']));
      $houseNumber = $this->validateRecord(trim($_POST['houseNo2']));
      $street = $this->validateRecord(trim($_POST['street2']));
      $location = $this->validateRecord(trim($_POST['location2']));

      $fullName = $fname." ".$midname." ".$lname;

    try {

      //connecting to database
      $sql = $this->conn->prepare("UPDATE   partnersrecord SET FirstName='$fname',MiddleName='$midname',LastName='$lname',Full_Name='$fullName',Age='$age',EducationalStatus='$edu_status',MarritalStatus='$marital_status',Occupation='  $occupation',Telephone='$motherlimbsCalf$contact',HouseNumber='$houseNumber',
        StreetName='$street',Location='$location' WHERE MRID='$identity'");
      $sql->execute();

      header("Location: Edit-Partner-Record.php?success");

    }catch (Exception $ex) {
      $_SESSION['database_error'] = $ex->getMessage();

      header("Location: Edit-Partner-Record.php?dataerror");
    }


  }
  //method to udpate patients personal records
    public function Update_Patient_personal_infomation()
    {
          $patid = trim($_POST['apId']);
          $getID = explode("C", $patid);
          $actualId = $getID[1];

            $fname = $this->validateRecord(trim($_POST['fn']));
            $midname = $this->validateRecord(trim($_POST['mn']));
            $lname = $this->validateRecord(trim($_POST['ln']));
            $date_of_birth = trim($_POST['dob']);
            //calculating patient's age
            $getYear = explode("-", $date_of_birth);
            $year = (int)$getYear[0];
            $currentYear = (int) date("Y");
            $age = $currentYear - $year;
            $edu_status = $this->validateRecord(trim($_POST['edu_status']));
            $marital_status = $this->validateRecord(trim($_POST['marital_status']));
            $occupation = $this->validateRecord(trim($_POST['occupation']));
            $contact = $this->validateRecord(trim($_POST['contact']));
            $houseNumber = $this->validateRecord(trim($_POST['houseNo']));
            $street = $this->validateRecord(trim($_POST['street']));
            $location = $this->validateRecord(trim($_POST['location']));
            $dateVisit = $this->validateRecord(trim($_POST['fvisit']));
            $midwife = $this->validateRecord(trim($_POST['midwife']));
            $fullName = $fname." ".$midname." ".$lname;

      try {

        //connecting to database
        $sql = $this->conn->prepare("UPDATE   mothersrecord SET FirstName='$fname',MiddleName='$midname',LastName='$lname',Full_Name='$fullName',Age='$age',DateOfBirth='$date_of_birth',EducationalStatus='$edu_status',MarritalStatus='$marital_status',Occupation='  $occupation',Telephone='$motherlimbsCalf$contact',HouseNumber='$houseNumber',
          StreetName='$street',Location='$location',Date_Of_First_Visit='$dateVisit',Name_Of_Midwife_Or_Doctor='$midwife' WHERE MRID='$actualId'");
        $sql->execute();
        /// header("location.reload(true)");
        header("Location:Edit-Registered-Patient-Record.php?success");

      }catch (Exception $ex) {
        $_SESSION['database_error'] = $ex->getMessage();

        header("Location: Edit-Registered-Patient-Record.php?dataerror");
      }


    }
    //method to send bulk sms to more than one contact
    public function Send_Bulk_Sms()
    {
      $contactlist = $_POST['Contact'];
      $nameslist = $_POST['Names'];
      $text = $_POST['Message'];
      //separating the names using explode method
      $listContacts = explode(",", $contactlist);
      $listNames = explode(",", $nameslist);
      //getting the size of array
      $contactlength = sizeof($listContacts);
      $namelength = sizeof($listNames);
      //using condition to check if they are of the same size
      if ($namelength > $contactlength) {
        header("location: Send-Bulk-SMS.php?nameerror");

      }elseif($contactlength > $namelength) {
        header("location: Send-Bulk-SMS.php?contacterror");
      }else{
        for ($i=0; $i < $contactlength ; $i++) {

          //sms api url
          $smsurl = "http://api.smsonlinegh.com/sendsms.php";
          //account
        $user = urlencode("kofiagyemangopambour@gmail.com");
        // account password
        $password = urlencode("sex.com123");
        // the message to send
        $message = urlencode("Hi {$listNames[$i]}, {$text}");
        // ID to show sender of message.
        $sender = urlencode("A_natalCare");
        // message type to send. Set it to 0 (Text)
        $type = 0;
        // destination numbers. Each must be separated by a comma
        $destination = $listContacts[$i];
        // set the parameter string.
        $params="user={$user}&password={$password}&message={$message}".
        "&type={$type}&sender={$sender}&destination={$destination}";
        // send the message and show the response.
        $liveurl = "{$smsurl}?{$params}";
        //readfile($liveurl);
        readfile($liveurl);

        }

    //   $Myarray[] = array('name' => $listNames , 'phone' => $listContacts);
    //   define ('VALSEP', '__@');
    //   define ('RECPTSEP', '__#');
    //   // Base URL for sending SMS.
    //   $smsurl = "http://api.smsonlinegh.com/sendsms.php";
    //   // account login
    //   $user = urlencode("kofiagyemangopambour@gmail.com");
    //   // account password
    //   $password = urlencode("sex.com123");
    //   // sender ID.
    //   $sender = urlencode("A_natalCare");
    //   // message type (We will send as Text)
    //   $type = 0;
    //   //message to display
    //   $message = urlencode('Hello {$name},{$text}');
    //   $destination = "";
    //   $valuestr = "";
    //
    //   foreach ($Myarray as $contact)
    //   {
    //   @$destination .= (!empty($destination) ? ",":"").$contact['phone'];
    //   @$valuestr .= (!empty($valuestr) ? RECPTSEP :"").$contact['name'];
    // //  $message;
    //   }
    //   // we should URL encode the values.
    //   $valuestr = urlencode($valuestr);
    //
    //   $params = "user={$user}&password={$password}&message={$message}".
    //   "&type={$type}&sender={$sender}&destination={$destination}" .
    //   "&values={$valuestr}";
      // send the message and show the response.
//     $liveurl = "{$smsurl}?{$params}";
      if(readfile($liveurl)){
        header("Send-Bulk-SMS.php?success");
      }else {
        header("Send-Bulk-SMS.php?error");
      }
    //  var_dump($params);
    // echo "<br>";
    // var_dump($Myarray);
    // echo "<br>";
    // var_dump($message);
    }

  }


}

?>
