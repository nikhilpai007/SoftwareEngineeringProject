<?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}





?>

<!-- Navbar -->
<style>
.fab:hover {
  background-color: #0398fc;
}
  .fab {
    font-family: georgia, "FontAwesome 5";
    background-color: #9874db;
  color: white;
  padding: 7px 5px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}
  </style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light" >


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
  <!-- lockscreen  -->
  <li class="nav-item d-none d-sm-inline-block">
      <a href="logout.php" accesskey="l" class="nav-link">
      <i class="nav-icon fas fa-lock"></i>
      </a>
    </li>
</nav>
<!-- /.navbar -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
   <center> <img src="images/TrentCommResCentre.jpg" alt="TCRC"
         style="opacity: .8" width = "90%" height = "70%"> </center>
    <!-- <span class="brand-text font-weight-light">TCRC</span> -->
  </a>
</aside>
