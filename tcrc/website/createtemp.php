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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Create Email Templates</title>
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
<style>
input[type=file] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=submit] {
  background-color: #0398fc;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

  </style>
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
          <h1>Send Templated Emails</h1>
          <br>
         
          <p> <img src="images/stripo.png" href="https://www.stripo.email"> <br> Make your templates on <a href= "https://www.stripo.email" > Stripo </a></p>
</br>
          <h3 align: center> Instructions </h3>
          <p align: center> Create Templates on https://Stripo.email </p>
          <p align: center> Download as .html file </p>
          <p align: center> Upload the .html file </p>
          <br>
          <center>
            <div class="container">
          <form method = "POST" enctype ="multipart/form-data" class="form">
          <p><input type="file" name="file" class="file-upload-field"/></p>
          <p><input type="submit" name="upload" value = "Upload Template"></p>
          </form>
</div>

          </center>
<?php
if (isset($_POST['upload'])){
  $file_name = $_FILES['file']['name'];
  $file_type = $_FILES['file']['type'];
  $file_size = $_FILES['file']['size'];
  $file_temp_loc = $_FILES['file']['tmp_name'];
  $file_store = "/home/apollosoftware/public_html/www_data/".$file_name;

 if( move_uploaded_file($file_temp_loc, $file_store))
 echo 'Template Upload Sucess';
}
?>

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
</body>
</html>
