<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';

//Remove error reportings
$tableStudent = $tableProject = $tableFaculty = $tableContact = $tableHost = array();

$counter = 0;
$variableType = $requestedQuery = "";

//CHECK GET. Redirect if no get is set, or session is absent
if(isset($_GET["id"])){
  //Filter get
  $requestedID = filter_var($_GET["id"],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "id";
}else if (isset($_GET["studentID"])){
  $requestedID = filter_var($_GET['studentID'],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "studentID";
}else if (isset($_GET["orgID"])){
  $requestedID = filter_var($_GET['orgID'],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "orgID";
}else if (isset($_GET["projectID"])){
  $requestedID = filter_var($_GET['projectID'],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "projectID";
}else if (isset($_GET["facultyID"])){
  $requestedID = filter_var($_GET['facultyID'],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "facultyID";
}else if (isset($_GET["contactID"])){
  $requestedID = filter_var($_GET['contactID'],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "contactID";
}else if (isset($_GET["email"])){
  $requestedID = filter_var($_GET['email'],FILTER_SANITIZE_EMAIL);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "email";
}else if (isset($_GET["all"])){
  $requestedID = filter_var($_GET['all'],FILTER_SANITIZE_STRING);
  $_SESSION["requestedVariable"] = $requestedID;
  $_SESSION["variableType"] = "all";
}
else if (isset($_SESSION["requestedQuery"])){
  $requestedQuery = $_SESSION["requestedQuery"];
  $variableType = $_SESSION["variableType"];
} else {
  $_SESSION["requestedQuery"] = "";
  $_SESSION["variableType"] = "";
  $requestedQuery = "";
  $variableType = "";
}

//Import the database connector
require_once "config.php";

//If the search begins with an id, search all datatables by ID
if($_SESSION['variableType'] == 'id'){
  //get all contents from the student table
  $sql = "SELECT * FROM student WHERE id = ".$_SESSION['requestedVariable'];

    if($tableStudent = mysqli_query($link,$sql)){
      //success
    } else {

    //echo "Error at execution";
    }

//get all contents from the projects table
  $sql = "SELECT * FROM project WHERE id = ".$_SESSION['requestedVariable'];

      if($tableProject = mysqli_query($link,$sql)){
        //success
      } else {

      //echo "Error at execution";
      }
      //get all from faculty table
      $sql = "SELECT * FROM faculty WHERE id = ".$_SESSION['requestedVariable'];

        if($tableFaculty = mysqli_query($link,$sql)){
          //success
        } else {

        //echo "Error at execution";
        }

      //get contents of the contact table
      $sql = "SELECT contact.id, contact.firstName, contact.lastName, contact.workEmail, contact.workPhone, contact.contactType, contactInfo.address1, contactInfo.city, contactInfo.province, contactInfo.pcode FROM contact LEFT JOIN contactInfo ON contact.id = contactInfo.contactID WHERE contact.id = ".$_SESSION['requestedVariable'];

    if($tableContact = mysqli_query($link,$sql)){
      //success
    } else {

    //echo "Error at execution";
    }

    //get the contents of the host table
      $sql = "SELECT * FROM hostOrganization LEFT JOIN hostAddress ON hostOrganization.id = hostAddress.organizationID WHERE hostOrganization.id = ".$_SESSION['requestedVariable'];

        if($tableHost = mysqli_query($link,$sql)){
          //success
        } else {

        //echo "Error at execution";
        }

//if the search begins with studentID, search by student ID
}else if($_SESSION['variableType'] == 'email'){
  //echo $_SESSION['requestedVariable'];
  $sql = "SELECT * FROM student WHERE email = '".$_SESSION['requestedVariable']."'";

    if($tableStudent = mysqli_query($link,$sql)){
      //success
    } else {

    //echo "Error at execution";
    }


      $sql = "SELECT * FROM faculty WHERE email = ".$_SESSION['requestedVariable'];

        if($tableFaculty = mysqli_query($link,$sql)){
          //success
        } else {

        //echo "Error at execution";
        }

      $sql = "SELECT contact.id, contact.firstName, contact.lastName, contact.workEmail, contact.workPhone, contact.contactType, contactInfo.address1, contactInfo.city, contactInfo.province, contactInfo.pcode FROM contact LEFT JOIN contactInfo ON contact.id = contactInfo.contactID WHERE contact.workEmail = ".$_SESSION['requestedVariable'];

    if($tableContact = mysqli_query($link,$sql)){
      //success
    } else {

    //echo "Error at execution";
    }

      $sql = "SELECT * FROM hostOrganization LEFT JOIN hostAddress ON hostOrganization.id = hostAddress.id WHERE hostOrganization.email1 = ".$_SESSION['requestedVariable'];

        if($tableHost = mysqli_query($link,$sql)){
          //success
        } else {

        //echo "Error at execution";
        }

//if the search begins with studentID, search by student ID
} else if ($_SESSION['variableType'] == 'studentID'){
  $sql = "SELECT * FROM student WHERE studentNum = ".$_SESSION['requestedVariable'];

    if($tableStudent = mysqli_query($link,$sql)){
      //success
    } else {
      //Empty table

      //echo "Error at execution";
    }
//if the search begins with projectId, search by project ID inside project
}else if ($_SESSION['variableType'] == 'projectID'){
  $sql = "SELECT * FROM project WHERE id = ".$_SESSION['requestedVariable'];

    if($tableProject = mysqli_query($link,$sql)){
      //success
    } else {
      //Empty table

      //echo "Error at execution";
    }
//if the search begins with departmentCode/deparmentID, search by dept ID inside project, department
}else if ($_SESSION['variableType'] == 'orgID'){
  $sql = "SELECT * FROM hostOrganization LEFT JOIN hostAddress ON hostOrganization.id = hostAddress.organizationID WHERE hostOrganization.id = ".$_SESSION['requestedVariable'];

    if($tableHost = mysqli_query($link,$sql)){
      //success
    } else {
      //Empty table

      //echo "Error at execution";
    }
//if the search begins with email, search by email  inside all datatables
}else if ($_SESSION['variableType'] == 'facultyID'){
  $sql = "SELECT * FROM faculty WHERE id = ".$_SESSION['requestedVariable'];

    if($tableFaculty = mysqli_query($link,$sql)){
      //success
    } else {
      //Empty table

      //echo "Error at execution";
    }
//if the search begins with projectId, search by project ID inside project
}else if ($_SESSION['variableType'] == 'contactID'){
  $sql = "SELECT contact.id, contact.firstName, contact.lastName, contact.workEmail, contact.workPhone, contact.contactType, contactInfo.address1, contactInfo.city, contactInfo.province, contactInfo.pcode FROM contact LEFT JOIN contactInfo ON contact.id = contactInfo.contactID WHERE contact.id = ".$_SESSION['requestedVariable'];

    if($tableContact = mysqli_query($link,$sql)){
      //success
    } else {
      //Empty table

      //echo "Error at execution";
    }
//if the search begins with projectId, search by project ID inside project
}else if($_SESSION['variableType'] == 'all'){
   if(strlen($_SESSION['requestedVariable']) != 0){

    //Search every single datatable for that entry (except the login stuff of course)
      $sql = "SELECT * FROM student WHERE id LIKE '%".$_SESSION['requestedVariable']."%'
                                  OR firstName LIKE '%".$_SESSION['requestedVariable']."%'
                                 OR lastName LIKE '%".$_SESSION['requestedVariable']."%'
                                  OR studentNum LIKE '%".$_SESSION['requestedVariable']."%'
                                  OR email LIKE '%".$_SESSION['requestedVariable']."%'"
                                  ;

      if($tableStudent = mysqli_query($link,$sql)){
        //success
      } else {

      //echo "Error at execution";
      }

      $sql = "SELECT * FROM project WHERE id LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR projectTitle LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR projectNumber LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR staffCode LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR status LIKE '%".$_SESSION['requestedVariable']."%'"
                                    ;

        if($tableProject = mysqli_query($link,$sql)){
          //success
        } else {

        //echo "Error at execution";
        }

        $sql = "SELECT * FROM faculty WHERE id LIKE '%".$_SESSION['requestedVariable']."%'
                                      OR firstName LIKE '%".$_SESSION['requestedVariable']."%'
                                      OR lastName LIKE '%".$_SESSION['requestedVariable']."%'
                                      OR email LIKE '%".$_SESSION['requestedVariable']."%'
                                      ";
          if($tableFaculty = mysqli_query($link,$sql)){
            //success
          } else {

          //echo "Error at execution";
          }

          $sql = "SELECT * FROM contact INNER JOIN contactInfo ON contact.id = contactInfo.contactID WHERE contact.id LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contact.firstName LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contact.lastName LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contact.workEmail LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contact.workPhone LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contact.contactType LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contactInfo.address1 LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contactInfo.city LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contactInfo.province LIKE '%".$_SESSION['requestedVariable']."%'
                                        OR contactInfo.pcode LIKE '%".$_SESSION['requestedVariable']."%'
                                        ";
      if($tableContact = mysqli_query($link,$sql)){
        //success
      } else {

      //echo "Error at execution";
      }
      $sql = "SELECT * FROM hostOrganization INNER JOIN hostAddress ON hostOrganization.id = hostAddress.organizationID WHERE hostOrganization.id LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostOrganization.orgName LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostOrganization.orgType LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostOrganization.hostClass LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostAddress.address LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostAddress.phone1 LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostAddress.email1 LIKE '%".$_SESSION['requestedVariable']."%'
                                    OR hostAddress.website LIKE '%".$_SESSION['requestedVariable']."%'
                                    ";
          if($tableHost = mysqli_query($link,$sql)){
            //success
          } else {

          //echo "Error at execution";
          }

   }
 } else {
  //do nothing
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Search </title>
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
  <!-- Filtering JS File -->





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
            <h1>Search</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Search</li>
            </ol>
          </div>
        </div>
        <div class="container-fluid">



	<div class="row">
		<div class="col-md-10">
			<div class="row">
				<div class="col-sm-12">
          <input type="text" id ="txtSearch" name="major" class="form-control"  placeholder="Select filters and enter your search query:"></input>
        </div>
			</div>
			<div class="row" >
				<div class="col-sm-2">
          <input type="checkbox" id="cbAll" class="check" value="all" checked onclick="checkAll()"> All</input>
        </div>
        <div class="col-sm-2">
          <input type="checkbox" id="cbProject" class="check" value="project" checked onclick="checkProject()"> Project</input>
        </div>
        <div class="col-sm-2">
          <input type="checkbox" id="cbStudent" class="check" value="student" checked onclick="checkStudent()"> Student</input>
        </div>
        <div class="col-sm-2">
          <input type="checkbox" id="cbFaculty" class="check" value="faculty" checked onclick="checkFaculty()"> Faculty</input>
        </div>
        <div class="col-sm-2">
          <input type="checkbox" id="cbContact" class="check" value="contact" checked onclick="checkContacts()" > Contacts</input>
        </div>
        <div class="col-sm-2">
          <input type="checkbox" id="cbHost" class="check" value="hostOrg" checked onclick="checkHost()" > Host Organizations</input>
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="row">
				<div class="col-lg-6">
					<button type="button" id="btnSearch" onclick="search()"  class="btn btn-primary">

            Search
					</button>
				</div>
				<div class="col-lg-6">
					<button type="button" id="btnReset" onclick="reset()" class="btn btn-secondary btn-sm">
						Reset
					</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.container-fluid -->

          <!-- Main content -->
          <section class="content">
              <div class="row">
                <div id="student" class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Student search (<?php if(is_a($tableStudent,"mysqli_result")) echo mysqli_num_rows($tableStudent); else echo 0;?> results)</h3>
                    </div>
                  </div>
                  <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Student ID</th>
                        <th>email</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(is_a($tableStudent,"mysqli_result"))while( $row = mysqli_fetch_assoc($tableStudent)){
                        echo "<tr>";
                          echo "<td><a href='studentprofile.php?id={$row['id']}' style='color:red'>{$row['id']}</a></td>";
                          echo "<td>".$row["firstName"]."</td>";
                          echo "<td>".$row["lastName"]."</td>";
                          echo "<td>".$row["studentNum"]."</td>";
                          echo "<td>".$row["email"]."</td>";
                          echo "</tr>";
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>

                <div id="project" class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Project search (<?php if(is_a($tableProject,"mysqli_result")) echo mysqli_num_rows($tableProject); else echo 0;?> results)</h3>
                    </div>
                  </div>
                  <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Project Title</th>
                        <th>Project Number</th>
                        <th>Staff Code</th>
                        <th>Project Status</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php if(is_a($tableProject,"mysqli_result"))while( $row = mysqli_fetch_assoc($tableProject)){
                        echo "<tr>";
                          echo "<td><a href='projectprofile.php?id={$row['id']}' style='color:red'>{$row['id']}</a></td>";
                          echo "<td>".$row["projectTitle"]."</td>";
                          echo "<td>".$row["projectNumber"]."</td>";
                          echo "<td>".$row["staffCode"]."</td>";
                          echo "<td>".$row["status"]."</td>";
                          echo "</tr>";
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                <div class="row">
                <div id="faculty" class="col-4">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Faculty search (<?php if(is_a($tableFaculty,"mysqli_result")) echo mysqli_num_rows($tableFaculty); else echo 0;?> results)</h3>
                    </div>
                  </div>
                  <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>email</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(is_a($tableFaculty,"mysqli_result")) while( $row = mysqli_fetch_assoc($tableFaculty)){
                          echo "<tr>";
                          echo "<td><a href='facultyprofile.php?id={$row['id']}' style='color:red'>{$row['id']}</a></td>";
                          echo "<td>".$row["firstName"]."</td>";
                          echo "<td>".$row["lastName"]."</td>";
                          echo "<td>".$row["email"]."</td>";
                          echo "</tr>";
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>



                <div id="host" class="col-8">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Host search (<?php if(is_a($tableHost,"mysqli_result")) echo mysqli_num_rows($tableHost); else echo 0;?> results)</h3>
                    </div>
                  </div>
                  <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Organization Name</th>
                        <th>Organization Type</th>
                        <th>Host Class</th>
                        <th>Contact Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Website</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php if(is_a($tableHost,"mysqli_result")) while( $row = mysqli_fetch_assoc($tableHost)){
                        echo "<tr>";
                          echo "<td><a href='search.php?id={$row['id']}' style='color:red'>{$row['id']}</a></td>";
                          echo "<td>".$row["orgName"]."</td>";
                          echo "<td>".$row["orgType"]."</td>";
                          echo "<td>".$row["hostClass"]."</td>";
                          echo "<td>".$row["contactName"]."</td>";
                          echo "<td>".$row["address"]."</td>";
                          echo "<td>".$row["phone1"]."</td>";
                          echo "<td>".$row["email1"]."</td>";
                          echo "<td>".$row["website"]."</td>";
                          echo "</tr>";
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>



            </div>
              <div class="row">
                <div id="contact" class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Contact search (<?php if(is_a($tableContact,"mysqli_result")) echo mysqli_num_rows($tableContact); else echo 0;?> results)</h3>
                    </div>
                  </div>
                  <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email </th>
                        <th>Phone</th>
                        <th>Contact Type</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(is_a($tableContact,"mysqli_result")) while( $row = mysqli_fetch_assoc($tableContact)){
                          echo "<tr>";
                          echo "<td><a href='search.php?id={$row['id']}' style='color:red'>{$row['id']}</a></td>";
                          echo "<td>".$row["firstName"]."</td>";
                          echo "<td>".$row["lastName"]."</td>";
                          echo "<td>".$row["workEmail"]."</td>";
                          echo "<td>".$row["workPhone"]."</td>";
                          echo "<td>".$row["contactType"]."</td>";
                          echo "<td>".$row["address1"]."</td>";
                          echo "<td>".$row["city"]."</td>";
                          echo "<td>".$row["province"]."</td>";
                          echo "<td>".$row["pcode"]."</td>";
                          echo "</tr>";
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

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
      <script>
        $(function () {
          $(".example1").DataTable({
            "scrollX": true
          });
          $('.table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
          });

        });
      </script>

    </body>

  </html>

  <?php echo '<script type="text/javascript">filterController();</script>';?>
