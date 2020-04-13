<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$projectArray = array();
$counter = 0;

require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects
$sql = "SELECT * FROM projectForm";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    if ($row[11] == 1) {
      continue;
    }
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],
    $row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],
  $row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28],$row[29]);
    $counter++;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Project Forms</title>
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
            <h1>Edit Project Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <!--    <h5>To approve a project:</h5><br>-->
            <!--      <h6>Click the approve button below for the project entry you would like to approve, then edit the form by selecting yes at the approved section</h6> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Approve</th>
                  <th>Edit</th>
                  <th>id</th>
                  <th>Organization Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Website</th>
                  <th>Logo Consent</th>
                  <th>Organization Purpose</th>
                  <th>Organization Year</th>
                  <th>Organization Employee</th>
                  <th>Approved</th>
                  <th>Theme</th>
                  <th>Project Scale</th>
                  <th>Project Title</th>
                  <th>Project Description</th>
                  <th>Project Task</th>
                  <th>Project Start Date</th>
                  <th>Project End Date</th>
                  <th>Research Ethics 1</th>
                  <th>Research Ethics 2</th>
                  <th>Research Ethics 3</th>
                  <th>Project Implementation</th>
                  <th>Screening Requirements 1</th>
                  <th>Screening Requirements 2</th>
                  <th>Additional Skills</th>
                  <th>Resources Needed</th>
                  <th>Funding Needed</th>
                  <th>Additional Notes</th>
                  <th>Photo Link</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $_SESSION["theId"] =1;
                  for($i = 0; $i < $counter; $i++){
                  ?>
                  <tr>
                  <?php
                  //  echo "<td><a href='editprojectform.php'>Edit</a></td>";

                  if ($projectArray[$i]['11'] == 0) {
                      $projectArray[$i]['11'] = "No";
                  }
                    echo "<td><a href='approveproject.php?id={$projectArray[$i]['0']}'>Approve</a></td>";
                    echo "<td><a href='editprojectform.php?id={$projectArray[$i]['0']}'>Edit</a></td>";
                    echo "<td>{$projectArray[$i]['0']}</td>";
                    echo "<td>{$projectArray[$i]['1']}</td>";
                    echo "<td>{$projectArray[$i]['2']}</td>";
                    echo "<td>{$projectArray[$i]['3']}</td>";
                    echo "<td>{$projectArray[$i]['4']}</td>";
                    echo "<td>{$projectArray[$i]['5']}</td>";
                    echo "<td>{$projectArray[$i]['6']}</td>";
                    echo "<td>{$projectArray[$i]['7']}</td>";
                    echo "<td>{$projectArray[$i]['8']}</td>";
                    echo "<td>{$projectArray[$i]['9']}</td>";
                    echo "<td>{$projectArray[$i]['10']}</td>";
                    echo "<td>{$projectArray[$i]['11']}</td>";
                    echo "<td>{$projectArray[$i]['12']}</td>";
                    echo "<td>{$projectArray[$i]['13']}</td>";
                    echo "<td>{$projectArray[$i]['14']}</td>";
                    echo "<td>{$projectArray[$i]['15']}</td>";
                    echo "<td>{$projectArray[$i]['16']}</td>";
                    echo "<td>{$projectArray[$i]['17']}</td>";
                    echo "<td>{$projectArray[$i]['18']}</td>";
                    echo "<td>{$projectArray[$i]['19']}</td>";
                    echo "<td>{$projectArray[$i]['20']}</td>";
                    echo "<td>{$projectArray[$i]['21']}</td>";
                    echo "<td>{$projectArray[$i]['22']}</td>";
                    echo "<td>{$projectArray[$i]['23']}</td>";
                    echo "<td>{$projectArray[$i]['24']}</td>";
                    echo "<td>{$projectArray[$i]['25']}</td>";
                    echo "<td>{$projectArray[$i]['26']}</td>";
                    echo "<td>{$projectArray[$i]['27']}</td>";
                    echo "<td>{$projectArray[$i]['28']}</td>";
                    echo "<td>{$projectArray[$i]['29']}</td>";
                    ?>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Approve</th>
                  <th>Edit</th>
                  <th>id</th>
                  <th>Organization Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Website</th>
                  <th>Logo Consent</th>
                  <th>Organization Purpose</th>
                  <th>Organization Year</th>
                  <th>Organization Employee</th>
                  <th>Approved</th>
                  <th>Theme</th>
                  <th>Project Scale</th>
                  <th>Project Title</th>
                  <th>Project Description</th>
                  <th>Project Task</th>
                  <th>Project Start Date</th>
                  <th>Project End Date</th>
                  <th>Research Ethics 1</th>
                  <th>Research Ethics 2</th>
                  <th>Research Ethics 3</th>
                  <th>Project Implementation</th>
                  <th>Screening Requirements 1</th>
                  <th>Screening Requirements 2</th>
                  <th>Additional Skills</th>
                  <th>Resources Needed</th>
                  <th>Funding Needed</th>
                  <th>Additional Notes</th>
                  <th>Photo Link</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- Export as CSV  -->
            <center>
            <form method="post" action="export.php">
               <input type="submit" name="export" value="CSV Export"/>
                </form>
                </center>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "scrollX": true
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
