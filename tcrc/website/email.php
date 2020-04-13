<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//include 'includes/accesscontrol.php';


$projectArray = array();
$counter = 0;

require_once "config.php";
//Retrieve the list of currently approved but not yet begun projects
$sql = "SELECT * FROM contact";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13]);
    $counter++;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Send Templated Emails</title>
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
  <style>
  p{
    margin-left: 1em;
  }

  h3{
    margin-left: 1em;
  }
  input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
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

  .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }

  .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
  }

  .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }

  </style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Nav bar import
  <?php include 'includes/nav.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Send Templated Emails</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Mailbox/Send Emails</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <p>   To view templates, select template from the dropdown list and do not enter email </p>
  <p>   If you enter the email address in the email textbox and hit submit, the email will be sent </p>
  <p>   To send emails to multiple recipent seperate emails by ", " example: hello@trentu.ca, world@trentu.ca </p>
  </br>
  <center>
<?php
$dirpath= "/home/apollosoftware/public_html/www_data/";
$filenames = array();
if(is_dir($dirpath))
{
  $files=opendir($dirpath);
  if($files)
  {
    while(($filename=readdir($files)) !=false)
    {
        if(preg_match('/(.html)$/', $filename))
          $filenames[sizeof($filenames)]='<option>'.$filename.'</option>';
      }
  }
}
?>

<form method="POST">
<select name = "Template" placeholder = "Select Template">
<?php for($i=0;$i < sizeOf($filenames); $i++)
  echo $filenames[$i];
  ?>
  </select> <br> <br>
  <input type ="text" name="email" placeholder = "Email"/> <br> <br>
  <input type ="text" name="Subject" placeholder = "Subject"/> <br><br>
  <center><input type="Submit" name="Submit"></center>
  </form>
  </center>
  </br>

<?php
error_reporting(0);
ini_set('display_errors', 0);
 define ("DEMO", false);
 //Location of the template
 $template = $_POST["Template"];
 $template_file = '../../www_data/'.$template;
 $Subjectt = $_POST["Subject"];
 $subject = $Subjectt;

 $email = $_POST["email"];
 $email_to = $email;
 //$bcc_to = 'tcrc@trentu.ca';
 $headers = "From: Trent Community Research Center  <tcrc@trentu.ca>\r\n";
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 if (file_exists($template_file))
 $message = file_get_contents($template_file);
 else
     die("Unable to find template file");

     echo $message;
 if(DEMO)
     die("<hr />No email was sent on purpose");
 if ( mail($email_to, $subject, $message, $headers, $bcc_to) )
     echo '<hr />Email Send SUCESSFUL';
 else
     echo '<hr />Email Send UNSUCESSFUL';

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
