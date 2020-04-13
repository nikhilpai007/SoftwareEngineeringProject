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
$sql="SELECT * FROM `project` WHERE `status_percentage`= '50%'";
//Retrieve and store as a variablea
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28],$row[29],$row[30],$row[31],$row[32]);
    $counter++;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project Data Table</title>
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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Datatable</h1>
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
              <h3 class="card-title">Project Data Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>office</th>
                  <th>research</th>
                  <th>projectTitle</th>
                  <th>projectDescription</th>
                  <th>deptID</th>
                  <th>dateProposed</th>
                  <th>dateReceived</th>
                  <th>approved</th>
                  <th>signedRPA</th>
                  <th>WEPA</th>
                  <th>dateWithdrawn</th>
                  <th>dateCompleted</th>
                  <th>HostOrganizationName</th>
                  <th>hostOrganizationID</th>
                  <th>courseReq</th>
                  <th>notes</th>
                  <th>BFUser</th>
                  <th>BFActivity</th>
                  <th>facultySupervisorID</th>
                  <th>BFDateOfNote</th>
                  <th>dateProjectMatched</th>
                  <th>callNumber</th>
                  <th>staffID</th>
                  <th>staffCode</th>
                  <th>PClink</th>
                  <th>depatmentCode</th>
                  <th>institutionID</th>
                  <th>regionID</th>
                  <th>status</th>
                  <th>status_percentage</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  for($i = 0; $i < $counter; $i++){
                  ?>
                  <tr>
                  <?php
                    echo "<td>{$projectArray[$i]['0']}</td>";
                    echo "<td>{$projectArray[$i]['1']}</td>";
                    echo "<td>{$projectArray[$i]['2']}</td>";
                    echo "<td>{$projectArray[$i]['3']}</td>";
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
                    echo "<td>{$projectArray[$i]['30']}</td>";
                    echo "<td>{$projectArray[$i]['31']}</td>";
                    echo "<td>{$projectArray[$i]['32']}</td>";
                    ?>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>id</th>
                  <th>office</th>
                  <th>research</th>
                  <th>projectTitle</th>
                  <th>projectDescription</th>
                  <th>deptID</th>
                  <th>dateProposed</th>
                  <th>dateReceived</th>
                  <th>approved</th>
                  <th>signedRPA</th>
                  <th>WEPA</th>
                  <th>dateWithdrawn</th>
                  <th>dateCompleted</th>
                  <th>HostOrganizationName</th>
                  <th>hostOrganizationID</th>
                  <th>courseReq</th>
                  <th>notes</th>
                  <th>BFUser</th>
                  <th>BFActivity</th>
                  <th>facultySupervisorID</th>
                  <th>BFDateOfNote</th>
                  <th>dateProjectMatched</th>
                  <th>callNumber</th>
                  <th>staffID</th>
                  <th>staffCode</th>
                  <th>PClink</th>
                  <th>depatmentCode</th>
                  <th>institutionID</th>
                  <th>regionID</th>
                  <th>status</th>
                  <th>status_percentage</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
             <button type="button">Export as CSV</button>
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
