<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';
if(isset($_SESSION['id'])){
  setcookie('id','', time() - 3600, "/");
}
$id = $firstName = $lastName = $studentNum = $email = $street = $city =  $province = "";
$pcode = $phone = $notes = $leftTrent = $major = $credAchieved = $cummuAchieved = $exempt = "";
$altAddress = $altEmail = $altPhone = $yearCreated = $institutionID = $foreignStatus = $showAsFellow = $fellowType = "";

$firstName_err = $lastName_err = $studentNum_err = $email_err = $street_err = $city_err = $province_err = "";
$pcode_err = $phone_err = $notes_err = $leftTrent_err = $major_err = $credAchieved_err = $cummuAchieved_err = $exempt_err = "";
$altAddress_err = $altEmail_err = $altPhone_err = $yearCreated_err = $institutionID_err = $foreignStatus_err = $showAsFellow_err = $fellowType_err = "";


$counter = 0;
$projectArray = array();
$tableStudentProject = "";
$tableProject = "";



require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects

//if user submits form
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(null ==(trim($_POST['first_name']))){
    $firstName_err = "Please enter the first name";
  } else {
    $firstName = filter_var($_POST["first_name"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['last_name']))){
    $lastName_err = "Please enter the last name";
  } else {
    $lastName = filter_var($_POST["last_name"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['studentNum']))){
    $studentNum_err = "Please enter your student number";
  } else {
    $studentNum = filter_var($_POST["studentNum"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['email']))){
    $email_err = "Please enter the email";
  } else {
    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_err = "Invalid Email entry at workEmail";
        $email = "";
      }
  }

  if(null ==(trim($_POST['street']))){
     $street_err = "Please enter street";
  } else {
     $street = filter_var($_POST["street"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['city']))){
  $city_err   = "Please enter the city";
  } else {
    $city = filter_var($_POST["city"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['province']))){
    $province_err = "No province enterred";
  } else {
    $province = filter_var($_POST["province"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['pcode']))){
    $pcode_err = "Please enter the postal code";
  } else {
    $pcode = filter_var($_POST["pcode"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['phone']))){
    $phone_err = "Please enter your phone";
  } else {
    $phone = filter_var($_POST["phone"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['notes']))){
    $notes_err = "Please enter the notes";
  } else {
    $notes = filter_var($_POST["notes"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['leftTrent']))){
    $leftTrent_err = "Please select whether the student has leftTrent";
  } else {
    if(filter_var($_POST["leftTrent"],FILTER_VALIDATE_INT) || $_POST["leftTrent"] == 0)
      $leftTrent = $_POST["leftTrent"];
    else
      $leftTrent_err = "Error at leftTrent entry. Number expected";
  }

  if(null ==(trim($_POST['major']))){
    $major_err = "Please enter major";
  } else {
    $major = filter_var($_POST["major"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['credAchieved']))){
    $credAchieved_err = "Selection required";
  } else {
    if(filter_var($_POST["credAchieved"],FILTER_VALIDATE_INT) || $_POST["credAchieved"] == 0)
      $credAchieved = $_POST["credAchieved"];
    else
      $credAchieved_err = "Error at credAchieved entry. Number expected";
  }

  if(null ==(trim($_POST['cummuAchieved']))){
    $cummuAchieved_err = "Selection required";
  } else {
    if(filter_var($_POST["cummuAchieved"],FILTER_VALIDATE_INT) || $_POST["cummuAchieved"] == 0)
      $cummuAchieved = $_POST["cummuAchieved"];
    else
      $cummuAchieved_err = "Error at cummuAchieved entry. Number expected";
  }

  if(null ==(trim($_POST['exempt']))){
    $exempt_err = "Selection required";
  } else {
    if(filter_var($_POST["exempt"],FILTER_VALIDATE_INT) || $_POST["exempt"] == 0)
      $exempt = $_POST["exempt"];
    else
      $exempt_err = "Error at exempt entry. Number expected";
  }

  if(null ==(trim($_POST['altAddress']))){
    $altAddress_err = "select alternative address";
  } else {
    $altAddress = filter_var($_POST["altAddress"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['altEmail']))){
    $altEmail_err = "Enter alternative email";
  } else {
    $altEmail = filter_var($_POST["altEmail"],FILTER_SANITIZE_EMAIL);
      if(!filter_var($altEmail,FILTER_VALIDATE_EMAIL)){
        $altEmail_err = "Invalid altEmail entry at workEmail";
        $altEmail = "";
      }
  }

  if(null ==(trim($_POST['altPhone']))){
    $altPhone_err = "Enter Alternative Phone";
  } else {
    $altPhone = filter_var($_POST["altPhone"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['yearCreated']))){
    $yearCreated_err = "Year added not selected";
  } else {
    $yearCreated= filter_var($_POST["yearCreated"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['institutionID']))){
    $institutionID_err = "Enter institutionID";
  } else {
    if(filter_var($_POST["institutionID"],FILTER_VALIDATE_INT) || $_POST["institutionID"] == 0)
      $institutionID = $_POST["institutionID"];
    else
      $institutionID_err = "Error at institutionID entry. Number expected";
  }

  if(null ==(trim($_POST['foreignStatus']))){
    $foreignStatus_err = "Enter student status";
  } else {
    $foreignStatus = filter_var($_POST["foreignStatus"],FILTER_SANITIZE_STRING);
  }

  if(null ==(trim($_POST['showAsFellow']))){
    $showAsFellow_err = "Select show as fellow?";
  } else {
    if(filter_var($_POST["showAsFellow"],FILTER_VALIDATE_INT) || $_POST["showAsFellow"] == 0)
      $showAsFellow = $_POST["showAsFellow"];
    else
      $showAsFellow_err = "Error at showAsFellow entry. Number expected";
  }

  if(null ==(trim($_POST['fellowType']))){
    $fellowType_err = "Fellow type not inserted";
  } else {
    $fellowType = filter_var($_POST["fellowType"],FILTER_SANITIZE_STRING);
  }
  if(empty($firstName_err)
   && empty ($lastName_err)
   && empty ($studentNum_err)
   && empty ($email_err)
   && empty ($street_err)
   && empty ($city_err)
   && empty ($province_err)
   && empty ($pcode_err)
   && empty ($phone_err)
   && empty ($notes_err)
   && empty ($leftTrent_err)
   && empty ($major_err)
   && empty ($credAchieved_err)
   && empty ($cummuAchieved_err)
   && empty ($exempt_err)
   && empty ($altAddress_err)
   && empty ($altEmail_err)
   && empty ($altPhone_err)
   && empty ($yearCreated_err)
   && empty ($institutionID_err)
   && empty ($foreignStatus_err)
   && empty ($showAsFellow_err)
   && empty ($fellowType_err))
   {

     //TO DO

     $sql = "INSERT INTO student (firstName , lastName, studentNum, email, street, city, province, pcode, phone, notes , leftTrent, major, credAchieved, cumAchieved , exempt  , altAddress, altEmail, altPhone, yearCreated,institutionID,foreignStatus,showAsFellow,fellowType)
     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

     if($stmt = mysqli_prepare($link,$sql)){
       mysqli_stmt_bind_param($stmt,"ssisssssssisiiissssisis",$firstName , $lastName , $studentNum , $email , $street ,
       $city ,  $province, $pcode , $phone , $notes , $leftTrent , $major , $credAchieved , $cummuAchieved , $exempt ,
       $altAddress , $altEmail , $altPhone , $yearCreated , $institutionID , $foreignStatus , $showAsFellow , $fellowType);

       if(mysqli_stmt_execute($stmt)){
         header("location: index.php");
       } else {
         //if there are problems, display error
         echo "ERROR at execution. Check database connection";
       }
     }
   }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Students </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Nav bar import -->
  <?php include 'includes/nav.php'; ?>
  <!-- Test -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $firstName ?> <?php echo $lastName ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


      <?php include 'includes/studentprofile.php'; ?>












        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">
        </div>
      </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>
