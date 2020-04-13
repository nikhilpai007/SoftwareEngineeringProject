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
$sql = "SELECT * FROM hostAddress";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10]);
    $counter++;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Host Address Data Table</title>
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
            <h1>Host Address Datatable</h1>
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
              <h3 class="card-title">Host Address Data Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>organizationID</th>
                  <th>address</th>
                  <th>addressAlt</th>
                  <th>city</th>
                  <th>province</th>
                  <th>phone1</th>
                  <th>phone2</th>
                  <th>fax</th>
                  <th>email1</th>
                  <th>email2</th>
                  <th>website</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  for($i = 0; $i < $counter; $i++){
                  ?>
                  <tr>
                  <?php
                    echo "<td>{$projectArray[$i]['0']}</td>";
                    echo "<td><a href='search.php?address={$projectArray[$i]['1']}'>{$projectArray[$i]['1']}</a></td>";
                    echo "<td><a href='search.php?addressALT={$projectArray[$i]['2']}'>{$projectArray[$i]['2']}</a></td>";
                    echo "<td><a href='search.php?city={$projectArray[$i]['3']}'>{$projectArray[$i]['3']}</a></td>";
                    echo "<td><a href='search.php?province={$projectArray[$i]['4']}'>{$projectArray[$i]['4']}</a></td>";
                    echo "<td><a href='search.php?phone1={$projectArray[$i]['5']}'>{$projectArray[$i]['5']}</a></td>";
                    echo "<td><a href='search.php?phone2={$projectArray[$i]['6']}'>{$projectArray[$i]['6']}</a></td>";
                    echo "<td><a href='search.php?fax={$projectArray[$i]['7']}'>{$projectArray[$i]['7']}</a></td>";
                    echo "<td><a href='search.php?email1={$projectArray[$i]['8']}'>{$projectArray[$i]['8']}</a></td>";
                    echo "<td><a href='search.php?email2={$projectArray[$i]['9']}'>{$projectArray[$i]['9']}</a></td>";
                    echo "<td><a href='search.php?website={$projectArray[$i]['10']}'>{$projectArray[$i]['10']}</a></td>";
                    ?>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>organizationID</th>
                  <th>address</th>
                  <th>addressAlt</th>
                  <th>city</th>
                  <th>province</th>
                  <th>phone1</th>
                  <th>phone2</th>
                  <th>fax</th>
                  <th>email1</th>
                  <th>email2</th>
                  <th>website</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- Export to CSV -->
                         <center>
            <form method="post" action="export-hostaddress.php">
               <input type="submit" name="export-hostaddress" value="CSV Export"/>
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
