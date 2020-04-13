<?php
// Initialize the session
session_start();

include 'includes/accesscontrol.php';

require_once 'config.php';

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
    <?php include 'includes/nav.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Home</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <h4> Project Status </h4>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php

                  $sql="SELECT * FROM `project` WHERE  `approved` = 0";

                  if ($result=mysqli_query($link,$sql))
                  {
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    // Free result set
                    mysqli_free_result($result);
                  }

                  mysqli_close($con);
                  ?></h3>
                  <p>UNAPPROVED</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-remove-circle"></i>
                </div>
                <a href="unapproved.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php

                  $sql="SELECT * FROM `project` WHERE `status_percentage`= '25%'";

                  if ($result=mysqli_query($link,$sql))
                  {
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    // Free result set
                    mysqli_free_result($result);
                  }

                  mysqli_close($con);
                  ?></h3>
                  <p>25% PROGRESS</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="twentyfive.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php

                  $sql="SELECT * FROM `project` WHERE `status_percentage`= '50%'";

                  if ($result=mysqli_query($link,$sql))
                  {
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    // Free result set
                    mysqli_free_result($result);
                  }

                  mysqli_close($con);
                  ?></h3>
                  <p>50% PROGRESS</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-pulse"></i>
                </div>
                <a href="fifty.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-success">
                <div class="inner">
                  <h3><?php

                  $sql="SELECT * FROM `project` WHERE `status_percentage`= '90%'";

                  if ($result=mysqli_query($link,$sql))
                  {
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    // Free result set
                    mysqli_free_result($result);
                  }

                  mysqli_close($con);
                  ?></h3>

                  <p>90% PROGRESS</p>
                </div>
                <div class="icon">
                  <i class="ion ion-arrow-graph-up-right"></i>
                </div>
                <a href="ninety.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">


              <!-- DIRECT CHAT -->

              <iframe width="950" height="725" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowtransparency="true" src="https://chatroll.com/embed/chat/tcrc-chat?id=gmqd-iwjWb8&platform=html"></iframe>
              <!-- Direct Chat -->


              <!-- TO DO List -->
              <iframe src='https://flask.io/ticuUZL8bpRd?embed=true' style='width: 950px; height: 500px;' frameborder='0' allowfullscreen='allowfullscreen'></iframe>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <!-- Calendar -->
              <div id="calendar" style="width: 100%">
                <iframe src="https://calendar.google.com/calendar/embed?src=trentcommunityresearch%40gmail.com&ctz=America%2FToronto" style="border: 0" width="550" height="700" frameborder="0" scrolling="no"></iframe>              <!--The calendar -->
              </div>
            </section>
          </div>
          <!-- Calendar -->
        </div>

        <!-- Sticky notes  -->
      </section>
        <!-- sticky notes -->
        <!-- /.content-wrapper -->
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
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
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
