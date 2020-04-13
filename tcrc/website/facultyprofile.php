<?php
// Initialize the session
session_start();
$id = $firstName = $lastName = $email = "";
$firstName_err = $lastName_err = $email_err = "";
$facultyArray = array();
$counter = 0;


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';


require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects

//CHECK GET
if(isset($_GET["id"])){
  $requestedID = filter_var($_GET["id"],FILTER_SANITIZE_STRING);
  $_SESSION["id"] = $requestedID;
}
elseif (isset($_SESSION["id"])){
  $requestedID = $_SESSION["id"];
} else {
  $message = "No GET/POST found. Ensure you are accessing correctly.";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header("location: index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(empty(trim($_POST['first_name']))){
    $firstName_err = "Please enter the first name";
  } else {
    $firstName = filter_var($_POST["first_name"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['last_name']))){
    $lastName_err = "Please enter the last name";
  } else {
    $lastName = filter_var($_POST["last_name"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['email']))){
    $email_err = "Please enter the email";
  } else {
    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_err = "Invalid Email entry at email";
        $email = "";
      }
  }

  if(empty($firstName_err)
   && empty ($lastName_err)
   && empty ($email_err))
   {
     $sql = "UPDATE faculty SET firstName = ?, lastName = ?, email = ? WHERE id = ?";

     if($stmt = mysqli_prepare($link,$sql)){
       mysqli_stmt_bind_param($stmt,"sssi",$firstName,$lastName,$email,$requestedID);

       if(mysqli_stmt_execute($stmt)){
         header("location: facultyprofile.php?id=".$requestedID);
       } else {
         //if there are problems, display error
         echo "ERROR at execution. Check database connection";
       }
     }
   }
   mysqli_close($link);
}

if(isset($requestedID)){
  $query = "SELECT * FROM faculty WHERE id = ?";
  if($stmt = mysqli_prepare($link,$query)){
    mysqli_stmt_bind_param($stmt, "s", $requestedID);
    $stmt -> execute();

    $result = $stmt -> get_result();
    while($row = $result -> fetch_assoc()){
        $id = $row['id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
      }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Faculty </title>
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
            <h1><?php echo $firstName;?> <?php echo $lastName; ?></h1>
              <h5 style="color:red;">Field's with a '*' are required for submission!</h5>
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

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group first-name">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">First name:</p>
            <input type="text" name="first_name" class="form-control" value="<?php echo $firstName; ?>">
          </div>
          <span class="help-block"><?php echo $firstName_err; ?></span>
        </div>

        <div class="form group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group last-name">
          <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Last name:</p>
            <input type="text" name="last_name" class="form-control" value="<?php echo $lastName; ?>">
          </div>
          <span class="help-block"><?php echo $lastName_err; ?></span>
        </div>
        <div class="form group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
          <span class "label inbox-info"></span>
          <div class = "group email">
        <h3 style="color:red; display:inline">*</h3>     <p style="display:inline">Email:</p>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
          </div>
          <span class="help-block"><?php echo $email_err; ?></span>
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

</body>
</html>
