<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if ($_SESSION["id"] != $_GET["id"]) {
  header("location: studentIndex.php?id=". $_SESSION["id"]);
}


$id = $firstName = $lastName = $studentNum = $email = $street = $city =  $province = "";
$pcode = $phone = $notes = $leftTrent = $major = $credAchieved = $cummuAchieved = $exempt = "";
$altAddress = $altEmail = $altPhone = $yearCreated = $institutionID = $foreignStatus = $showAsFellow = $fellowType = "";

$firstName_err = $lastName_err = $studentNum_err = $email_err = $street_err = $city_err = $province_err = "";
$pcode_err = $phone_err = $notes_err = $leftTrent_err = $major_err = $credAchieved_err = $cummuAchieved_err = $exempt_err = "";
$altAddress_err = $altEmail_err = $altPhone_err = $yearCreated_err = $institutionID_err = $foreignStatus_err = $showAsFellow_err = $fellowType_err = "";

$counter = 0;
$index=0;
$projectArray = array();
$tableStudentProject = "";
$tableProject = "";

require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects

//CHECK GET
if (isset($_SESSION["id"])){
  $requestedID = $_SESSION["id"];
} else {
  $message = "No GET/POST found. Ensure you are accessing correctly.";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header("location: index.php");
}

$sql = "SELECT * FROM studentProject WHERE studentID = ".$_SESSION["id"];

  if($tableStudentProject = mysqli_query($link,$sql)){
    //success
  } else {
    echo "Error at execution";
  }


$linkedProject = "";

  if(is_a($tableStudentProject,"mysqli_result")){
  while( $row = mysqli_fetch_assoc($tableStudentProject)){

   $linkedProject = $row["projectID"];

   $sql = "SELECT * FROM project WHERE id = ".$linkedProject;

     if($tableProject = mysqli_query($link,$sql)){
       //success
       if ($row = mysqli_fetch_assoc($tableProject)) {
         $projectArray[$counter] =  array($row["id"], $row["projectTitle"], $row["projectNumber"], $row["staffCode"], $row["status"], $row["status_percentage"]);
       }

     } else {
       echo "Error at execution";
     }

  $counter++;
  }
}

if(isset($requestedID)){
  $query = "SELECT * FROM student WHERE id = ?";
  if($stmt = mysqli_prepare($link,$query)){
    mysqli_stmt_bind_param($stmt, "s", $requestedID);
    $stmt -> execute();

    $result = $stmt -> get_result();
    while($row = $result -> fetch_assoc()){
        $id = $row['id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $studentNum = $row['studentNum'];
        $email = $row['email'];
        $street = $row['street'];
        $city =  $row['city'];
        $province = $row['province'];
        $pcode = $row['pcode'];
        $phone = $row['phone'];
        $notes = $row['notes'];
        $leftTrent = $row['leftTrent'];
        $major = $row['major'];
        $credAchieved = $row['credAchieved'];
        $cumAchieved = $row['cumAchieved'];
        $exempt = $row['exempt'];
        $altAddress = $row['altAddress'];
        $altEmail = $row['altEmail'];
        $altPhone = $row['altPhone'];
        $yearCreated = $row['yearCreated'];
        $institutionID = $row['institutionID'];
        $foreignStatus = $row['foreignStatus'];
        $showAsFellow = $row['showAsFellow'];
        $fellowType = $row['fellowType'];
}
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel='icon' href='images/icons/favicon.jpg' type='image/jpg' >
  <title> Dashboard - T.C.R.C </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed"  style="background-image: url('images/stylish-hexagonal-line-pattern-background_1017-19742.jpg');">
  <div class="wrapper">

    <!-- Nav bar import -->
    <?php include 'includes/studentnav.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-4">
              <h4>Active Project and status</h4>
            </div>
            <div class="col-md-4">
              <p>Current Progress</p>
            </div>
            <div class="col-md-4">
              <div class="dropdown dropup">
                <p>Set new status</p>
              </div>
            </div>
          </div>

          <?php for($index = 0; $index < count($projectArray); $index++){?>

            <div class="row">
              <div class="col-md-4">
                <div class="col-md-6">
                  <?php  echo "<p>Project #".$projectArray[$index][2]." - Status: <strong>".$projectArray[$index][4]."</strong></p>";?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="progress">
                  <?php echo '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$projectArray[$index][5].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$projectArray[$index][5].'">'.$projectArray[$index][5].'</div>'; ?>

                </div>
              </div>
              <div class="col-md-4">
                <div class="dropdown dropup">

                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                    Select new status
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    echo '<a class="dropdown-item" href="changeStatus.php?id='.$projectArray[$index][0].'&value=25&studentID='.$_SESSION['id'].'">25%</a>';
                    echo '<a class="dropdown-item" href="changeStatus.php?id='.$projectArray[$index][0].'&value=50&studentID='.$_SESSION['id'].'">50%</a>';
                    echo '<a class="dropdown-item" href="changeStatus.php?id='.$projectArray[$index][0].'&value=90&studentID='.$_SESSION['id'].'">90%</a>';
                    echo '<a class="dropdown-item" href="changeStatus.php?id='.$projectArray[$index][0].'&value=finish&studentID='.$_SESSION['id'].'">Finished</a>';
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php }?>

          <h4>Student Profile Information</h4>
          <div class="row">
            <div class="col-md-12">
              <section class="content">
                <?php include 'includes/studentprofile.php' ?>
              </section>
            </div>
          </div>




        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    </div>
    <!-- /.content-wrapper -->


  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $.widget.bridge('uibutton', $.ui.button)
  $( "input" ).prop('disabled',true);
  $( "select" ).prop('disabled',true);
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
