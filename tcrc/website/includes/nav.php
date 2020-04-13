<?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light" >

<script src="../js/search.js"></script>
<script src="js/search.js"></script>

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="contactme.php" class="nav-link">Contact & Feedback</a>
    </li>
  </ul>
<center>

<form method = "POST" class="form-inline ml-3">
  <div class="input-group input-group-sm">
  <input type ="text" id="navSearch" class="form-control form-control-navbar" name="Search" placeholder = "Search"/>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <input type="Submit" class='fab' name="Searcho" value="&#xf3eb;" >
</div>
</form>
  <?php
  error_reporting(0);
  ini_set('display_errors', 0);
  $Search = $_POST["Search"];
  $page = 'search.php?all='.$Search;
  if ($_POST['Searcho'] && (strlen($Search) >= 4)){
      header("Location: $page");
  }
  else if($_POST['Searcho'] && (strlen($Search) == 0)){
    header("Location: search.php");
  }
  else if($_POST['Searcho'] && (strlen($Search) < 4)){
      echo '<script type="text/javascript">alert("Min. search length: 4 characters");</script>';
  }
  ?>

  </center>

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

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
   <center> <img src="images/TrentCommResCentre.jpg" alt="TCRC"
         style="opacity: .8" width = "90%" height = "70%"> </center>
    <!-- <span class="brand-text font-weight-light">TCRC</span> -->
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
      </div>
      <div class="info">
        <a href="#" class="d-block"> Logged in as <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
        <a href="logout.php" class="d-block" style= "color: red"> Log Out </a>

      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="index.php" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
              <!-- <i class="right fas fa-angle-left"></i> -->
            </p>
          </a>
        </li>


      <li class="nav-item">
        <a href="project-main.php" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Projects
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>
        <li class="nav-item">
          <a href="student-main.php" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Students
              <!-- <i class="right fas fa-angle-left"></i> -->
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="faculty-main.php" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Faculty
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>


          <li class="nav-item">
            <a href="hostOrganization.php" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Host Organization
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="contact.php" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Contacts
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Applications
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="studentformentries.php" class="nav-link">
                <i class="fas fa-pen nav-icon"></i>
                <p>Student Form</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="projectformentries.php" class="nav-link">
                <i class="fas fa-pen nav-icon"></i>
                <p>Project Form</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="main.php" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>
        </li>
	      <li class="nav-header">ADDITIONAL FEATURES </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Mailbox
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="email.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Send Email</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="groupemail.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Send Group/Bulk Email</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="createtemp.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Template</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              User Operations
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Log Out</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lockscreen</p>
              </a>
            </li>

          </ul>
        </li>
        <li class="nav-header">MISCELLANEOUS</li>
        <li class="nav-item">
          <a href="usermanagement.php" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              User Management
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>
        </li>
      </li>
  
        <li class="nav-item">
          <a href="/~apollosoftware/tcrc/docs/" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Documentation</p>
          </a>
        </li>
      </ul>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
