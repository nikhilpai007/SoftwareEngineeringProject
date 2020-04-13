<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';
$error =""; //used to check for errors on submission
$projectArray = array();
$submitArray = array();
$counter = 0; //keep track of number of linked students
$tableUser = "";  // for retrieving student info from student table
 //for retrieving info from studentProject table

require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects

if($_SESSION['flag'] == 'b'){
  header('location: index.php');
}


//gets all rows in the users table
$sql = "SELECT * FROM users";

if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[4]);
    $counter++;
  }
}


//if user submits the form
if($_SERVER['REQUEST_METHOD'] == "POST"){

  $boxCheck = 0; //used to set which flag row to check

//go through and check each flag
while ($boxCheck < $counter) {
$b = $boxCheck+1;


  if(empty(trim($_POST["usertype{$b}"]))){      //check if atleast 1 option was chosen
    $error = "MISSING VALUE";   //populate error field
  } else {
    $submitArray[] = trim($_POST["usertype{$b}"]);    //add value to array
  }

  $boxCheck++;  //increment to the next flag option
}//end while


//iif there are no errors
if ($error == "") {
  // Update database

$i = 0;
while ($i < $counter) {

if ($_SESSION["id"] == $projectArray[$i]['0']) {
$_SESSION["flag"] = $submitArray[$i];
}

  $sql = "UPDATE users SET Flag = ? WHERE id = ?";

//Updating the database
  if($stmt = mysqli_prepare($link,$sql)){
    mysqli_stmt_bind_param($stmt,"ss",$submitArray[$i], $projectArray[$i]['0'] );

    if(mysqli_stmt_execute($stmt)){
      header("location: usermanagement.php");
    } else {
      //if there are problems, display error
      echo "ERROR at execution. Check database connection";
    }
  }
$i++;
}


}
else {
  echo "Invalid form submission";
}


}//end if (Request post method chekck)

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
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="project-main.php">DataTables</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<br>

        <h4 style="text-align:center;" >Configure Users flags to determine the users type</h4>
        <h5 style="text-align:center;">A = Admin </h5>
        <h5 style="text-align:center;">B = Student Employee </h5>
        <h5 style="text-align:center;">C = Student </h5>


<br>
<br>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users (<?php if($counter !=0) echo $counter?> results)</h3>
        </div>
      </div>
      <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>Username</th>

            <th>Flag</th>



          </tr>
        </thead>
        <tbody>
          <?php
          $t=1;
          for($i = 0; $i < $counter; $i++){
          ?>
          <tr>
          <?php
          //  echo "<td><a href='editprojectform.php'>Edit</a></td>";
            echo "<td>{$projectArray[$i]['0']}</td>";
            echo "<td>{$projectArray[$i]['1']}</td>";
            $valA ="";
            $valB ="";
            $valC ="";
          if ($projectArray[$i]['4'] == "A") {
              $valA = "checked";
            }
          else if ($projectArray[$i]['4'] == "B") {
            $valB = "checked";
            }
         else if ($projectArray[$i]['4'] == "C") {
            $valC = "checked";
            }
            echo "<td>
            <input type='radio' id='admin' name='usertype{$t}' value='A' {$valA}>
            <label for='admin'>A</label><br>
            <input type='radio' id='studentemployee' name='usertype{$t}' value='B' {$valB}>
            <label for='studentemployee'>B</label><br>
            <input type='radio' id='student' name='usertype{$t}' value='C' {$valC}>
            <label for='student'>C</label><br>
              </td>";
            ?>
          </tr>
          <?php
          $t++;
          }
          ?>
        </tbody>
      </table>
    </div>


        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">
        </div>
      </form>
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
$(function(){
$("input:checkbox").click(function(){
  var checkboxgroup = "input:checkbox[name='"+$(this).attr("name")+"']";
  $(checkboxgroup).attr("checked",false);
  $(this).attr("checked",true);
});
});
</script>






</body>
</html>
