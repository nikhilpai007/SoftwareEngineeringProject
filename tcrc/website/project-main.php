<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';

$projectArray = array();
$counter = 0;

require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects
$sql = "SELECT * FROM project";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
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
  <title>Projects </title>
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
            <h1>Project Profiles</h1>
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button onclick = "location = 'addproject.php';" class='btn btn-secondary'>Add new project</button>
              <?php include 'addlink.php';?>
              <?php include 'removelink.php';?>
              <?php include 'departmentControl.php';?>
              <?php include 'regionControl.php';?>
              <?php include 'institutionControl.php';?>
              <?php include 'studentskillsControl.php';?>
              <?php include 'researchThemeControl.php';?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Edit</th>
                  <th>id</th>
                  <th>office</th>
                  <th>research</th>
                  <th>projectTitle</th>
                  <th>projectID</th>
                  <th>projectDescription</th>
                  <th>DepartmentalCode</th>
                  <th>deptID</th>
                  <th>dateProposed</th>
                  <th>dateReceived</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $_SESSION["theId"] =1;
                  for($i = 0; $i < count($projectArray); $i++){
                  ?>
                  <tr>
                  <?php
                  //  echo "<td><a href='editprojectform.php'>Edit</a></td>";
                    echo "<td><a href='projectprofile.php?id={$projectArray[$i]['0']}' style='color:red'>View</a></td>";
                    echo "<td><a href='search.php?id={$projectArray[$i]['0']}'>{$projectArray[$i]['0']}</a></td>";
                    echo "<td>{$projectArray[$i]['1']}</td>";
                    echo "<td>{$projectArray[$i]['2']}</td>";
                    echo "<td><a href='search.php?all={$projectArray[$i]['3']}'>{$projectArray[$i]['3']}</a></td>";
                    echo "<td><a href='search.php?all={$projectArray[$i]['4']}'>{$projectArray[$i]['4']}</a></td>";
                    echo "<td>{$projectArray[$i]['5']}</td>";
                    echo "<td>{$projectArray[$i]['6']}</td>";
                    echo "<td>{$projectArray[$i]['7']}</td>";
                    echo "<td>{$projectArray[$i]['8']}</td>";
                    echo "<td>{$projectArray[$i]['9']}</td>";
                    ?>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Edit</th>
                  <th>id</th>
                  <th>office</th>
                  <th>research</th>
                  <th>projectTitle</th>
                  <th>projectID</th>
                  <th>projectDescription</th>
                  <th>DepartmentalCode</th>
                  <th>deptID</th>
                  <th>dateProposed</th>
                  <th>dateReceived</th>
                </tr>
                </tfoot>
              </table>
            </div>
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
