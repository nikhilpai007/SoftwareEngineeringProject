<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

$id = $title = $firstName = $lastName = $workEmail = $workPhone = $workLocation = $institutionID = $contactType = $TCRC = $ULINKS = $CLINKS = $showFellow = $fellowType ="";
$contactID = $personalEmail = $address1 = $address2 = $city = $province = $pcode = $country = $phone = $phoneAlt = $bio = "";

$title_err = $firstName_err = $lastName_err = $workEmail_err = $workPhone_err = $workLocation_err = $institutionID_err = $contactType_err = $TCRC_err = $ULINKS_err = $CLINKS_err = $showFellow_err = $fellowType_err ="";
$personalEmail_err = $address1_err = $address2_err = $city_err = $province_err = $pcode_err = $country_err = $phone_err = $phoneAlt_err = $bio_err = "";

$hostArray = array();
$counter = 0; //keep track of number of linked students
$tableHost = "";  // for retrieving student info from student table
$tableProject = ""; //for retrieving info from studentProject table

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








//if user submits the form
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(empty(trim($_POST['title']))){
    $title_err = "No insert at title";
  } else {
    $title = filter_var($_POST["title"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['firstName']))){
    $firstName_err = "No insert at firstName";
  } else {
    $firstName = filter_var($_POST["firstName"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['lastName']))){
    $lastName_err = "No insert at lastName";
  } else {
    $lastName = filter_var($_POST["lastName"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['workEmail']))){
    $workEmail_err = "No insert at workEmail";
  } else {
    $workEmail = filter_var($_POST["workEmail"],FILTER_SANITIZE_EMAIL);
    if(!filter_var($workEmail,FILTER_VALIDATE_EMAIL)){
      $workEmail_err = "Invalid Email entry at workEmail";
      $workEmail = "";
    }
  }

  if(empty(trim($_POST['workPhone']))){
    $workPhone_err = "No insert at workPhone";
  } else {
    $workPhone = filter_var($_POST["workPhone"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['workLocation']))){
    $workLocation_err = "No insert at workLocation";
  } else {
    $workLocation = filter_var($_POST["workLocation"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['institutionID']))){
    $institutionID_err = "No entry at institutionID";
  } else {
    if(filter_var($_POST["institutionID"],FILTER_VALIDATE_INT))
      $institutionID = $_POST["institutionID"];
    else
      $institutionID_err = "Error at insitutionID entry. Number expected";
  }

  if(empty(trim($_POST['contactType']))){
    $contactType_err = "No entry at contactType";
  } else {
    $contactType = filter_var($_POST["contactType"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['TCRC']))){
    $TCRC_err = "No entry at TCRC";
  } else {
    $TCRC  = filter_var($_POST["TCRC"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['ULINKS']))){
    $ULINKS_err = "No entry at ULINKS";
  } else {
    $ULINKS  = filter_var($_POST["ULINKS"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['CLINKS']))){
    $CLINKS_err = "No entry at CLINKS";
  } else {
    $CLINKS = filter_var($_POST["CLINKS"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['showFellow']))){
    $showFellow_err = "No entry at showFellow";
  } else {
    $showFellow = filter_var($_POST["showFellow"],FILTER_SANITIZE_STRING);
  }


  if(empty(trim($_POST['fellowType']))){
    $fellowType_err = "No entry at fellowType";
  } else {
    $fellowType = filter_var($_POST["fellowType"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['personalEmail']))){
    $personalEmail_err = "No entry at personalEmail";
  } else {
    $personalEmail = filter_var($_POST["personalEmail"],FILTER_SANITIZE_EMAIL);
      if(!filter_var($personalEmail,FILTER_VALIDATE_EMAIL)){
        $personalEmail_err = "Invalid Email entry at workEmail";
        $personalEmail = "";
      }
  }

  if(empty(trim($_POST['address1']))){
    $address1_err = "No entry at address1";
  } else {
    $address1 = filter_var($_POST["address1"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['address2']))){
    $address2_err = "No entry at address2";
  } else {
    $address2 = filter_var($_POST["address2"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['city']))){
    $city_err = "No entry at city";
  } else {
    $city = filter_var($_POST["city"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['province']))){
    $province_err = "No entry at province";
  } else {
    $province = filter_var($_POST["province"],FILTER_SANITIZE_STRING);
  }

  if(empty(trim($_POST['pcode']))){
    $pcode_err = "No entry at pcode";
  } else {
    $pcode = filter_var($_POST["pcode"],FILTER_SANITIZE_STRING);
  }

    if(empty(trim($_POST['country']))){
      $country_err = "No entry at country";
    } else {
      $country = filter_var($_POST["country"],FILTER_SANITIZE_STRING);
    }

    if(empty(trim($_POST['phone']))){
      $phone_err = "No entry at phone";
    } else {
      $phone = filter_var($_POST["phone"],FILTER_SANITIZE_STRING);
    }

    if(empty(trim($_POST['phoneAlt']))){
      $phoneAlt_err = "No entry at phoneAlt";
    } else {
      $phoneAlt = filter_var($_POST["phoneAlt"],FILTER_SANITIZE_STRING);
    }

    if(empty(trim($_POST['bio']))){
      $bio_err = "No entry at bio";
    } else {
      $bio = filter_var($_POST["bio"],FILTER_SANITIZE_STRING);
    }


  $requestedID = $_SESSION["id"];


  if(empty($title_err)
  && empty ($firstName_err)
  && empty ($lastName_err)
  && empty ($workEmail_err)
  && empty ($workPhone_err)
  && empty ($workLocation_err)
  && empty ($institutionID_err)
  && empty ($contactType_err)
  && empty ($TCRC_err)
  && empty ($ULINKS_err)
  && empty ($CLINKS_err)
  && empty ($showFellow_err)
  && empty ($fellowType_err)
  && empty ($personalEmail_err)
  && empty ($address1_err)
  && empty ($address2_err)
  && empty ($city_err)
  && empty ($province_err)
  && empty ($pcode_err)
  && empty ($country_err)
  && empty ($phone_err)
  && empty ($phoneAlt_err)
  && empty ($bio_err))
  {
    //TO DO
    $sql = "UPDATE contact SET title = ?, firstName = ?, lastName = ?, workEmail = ?, workPhone = ?, workLocation = ?, institutionID = ?,
    contactType = ?, TCRC = ?, ULINKS = ?, CLINKS = ?, showFellow = ?, fellowType = ? WHERE id = ?";

    if($stmt = mysqli_prepare($link,$sql)){
      mysqli_stmt_bind_param($stmt,"ssssssissssssi", $title, $firstName, $lastName, $workEmail, $workPhone, $workLocation, $institutionID ,
      $contactType, $TCRC , $ULINKS, $CLINKS , $showFellow, $fellowType, $requestedID);


      if(mysqli_stmt_execute($stmt)){
        $sql = "UPDATE contactInfo SET personalEmail = ?, address1 = ?, address2 = ?, city = ?, province = ?, pcode = ?, country = ?,
        phone = ?, phoneAlt = ?, bio= ? WHERE contactID = ?";

        if($stmt = mysqli_prepare($link,$sql)){
          mysqli_stmt_bind_param($stmt,"ssssssssssi", $personalEmail , $address1 , $address2 , $city , $province ,$pcode ,  $country, $phone , $phoneAlt,
          $bio, $requestedID);



          if(mysqli_stmt_execute($stmt)){
            header("location: contactprofile.php?id=".$requestedID);
          } else {
            //if there are problems, display error
            echo "ERROR at hostOrg update #2. Check database connection";
          }
        }
      } else {
        //if there are problems, display error
        echo "ERROR at hostOrg update #1. Check database connection";
      }
    }
  }
}


if(isset($requestedID)){
  $query = "SELECT * FROM contact LEFT OUTER JOIN contactInfo ON contact.id = contactInfo.contactID WHERE contact.id = ".$requestedID;

  if($result = $link -> query($query)){

    //  $result = $stmt -> get_result();
    while($row = $result -> fetch_assoc()){
      $id = $row['id'];
      $title = $row['title'];
      $firstName = $row['firstName'];
      $lastName = $row['lastName'];
      $workEmail = $row['workEmail'];
      $workPhone = $row['workPhone'];
      $workLocation = $row['workLocation'];
      $institutionID = $row['institutionID'];
      $contactType = $row['contactType'];
      $TCRC = $row['TCRC'];
      $ULINKS = $row['ULINKS'];
      $CLINKS = $row['CLINKS'];
      $showFellow = $row['showFellow'];
      $fellowType = $row['fellowType'];
      $contactID = $row['contactID'];
      $personalEmail = $row['personalEmail'];
      $address1 = $row['address1'];
      $address2 = $row['address2'];
      $city = $row['city'];
      $province = $row['province'];
      $pcode = $row['pcode'];
      $country = $row['country'];
      $phone = $row['phone'];
      $phoneAlt = $row['phoneAlt'];
      $bio = $row['bio'];
    }
    //Retrieve the list of currently approved but not yet begun projects
    $sql = "SELECT id,name FROM institution";
    $institutionTable = array();
    //Retrieve and store as a variable
    $counter=1;
    if($result = $link -> query($sql)){
      while ($row = $result -> fetch_row()){
        if($row[0] == $institutionID)
          $institutionTable[$counter] = "<option value = '{$institutionID}' selected>SELECTED {$institutionID} > {$row[1]}</option>";
        else
          $institutionTable[$counter] = "<option value = '{$row[0]}'>{$row[0]}>{$row[1]}</option>";
        $counter++;
      }
    }
  }

}

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
              <h1><?php echo $title ?></h1>
              <h5 style="color:red;">Field's with a '*' are required for submission!</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="contact.php">DataTables</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <div class="card">
            <div class="card-header">
            <h3 class='card-title' ><strong> Contact Details </strong> </h3>
            </div>
          </div>
          <div class="card-body">
          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group title">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Title:</p>
                  <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $title_err; ?></span>
              </div>
            </div>


            <div  class="col-6">
              <div class="form group <?php echo (!empty($workLocation_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group workLocation">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Work Location</p>
                  <input type="text" name="workLocation" class="form-control" value="<?php echo $workLocation; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $workLocation_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group firstName">
                  <h3 style="color:red; display:inline">*</h3>  <p style="display:inline">First Name:</p>
                  <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $firstName_err; ?></span>
              </div>
            </div>


            <div  class="col-6">
              <div class="form group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group lastName">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Last Name:</p>
                  <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $lastName_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>


          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($workEmail_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group workEmail">
                  <h3 style="color:red; display:inline">*</h3>  <p style="display:inline">Work Email:</p>
                  <input type="text" name="workEmail" class="form-control" value="<?php echo $workEmail; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $workEmail_err; ?></span>
              </div>
            </div>


            <div  class="col-6">
              <div class="form group <?php echo (!empty($workPhone_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group workPhone">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Work Phone:</p>
                  <input type="text" name="workPhone" class="form-control" value="<?php echo $workPhone; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $workPhone_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div  class="col-3">
              <div class="form group <?php echo (!empty($institutionID_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group institutionID">
               <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">institutionID:</p>
               <select name = "institutionID" class="form-control">
                 <option value = "0">No link</option>
                 <?php for($i = 1; $i < count($institutionTable)+1; $i++){
                   //For all rows in the projects array, print out the value as an <option>
                   echo $institutionTable[$i];
                 }?>
               </select>
                </div>
                <span class="help-block" style="color:red;"><?php echo $institutionID_err; ?></span>
              </div>
            </div>

            <div  class="col-3">
              <div class="form group <?php echo (!empty($contactType_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group contactType">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Contact Type:</p>
                  <input type="text" name="contactType" class="form-control" value="<?php echo $contactType; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $contactType_err; ?></span>
              </div>
            </div>

            <div  class="col-3">
              <div class="form group <?php echo (!empty($showFellow_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group showFellow">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Show Fellow?:</p>
                  <input type="text" name="showFellow" class="form-control" value="<?php echo $showFellow; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $showFellow_err; ?></span>
              </div>
            </div>

            <div  class="col-3">
              <div class="form group <?php echo (!empty($fellowType_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group fellowType">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Fellow Type:</p>
                  <input type="text" name="fellowType" class="form-control" value="<?php echo $fellowType; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $fellowType_err; ?></span>
              </div>
            </div>
          </div>

          <br>
          <br>

          <div class="row">
            <div  class="col-4">
              <div class="form group <?php echo (!empty($TCRC_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group TCRC">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">TCRC:</p>
                  <input type="text" name="TCRC" class="form-control" value="<?php echo $TCRC; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $TCRC_err; ?></span>
              </div>
            </div>

            <div  class="col-4">
              <div class="form group <?php echo (!empty($ULINKS_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group ULINKS">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">ULINKS:</p>
                  <input type="text" name="ULINKS" class="form-control" value="<?php echo $ULINKS; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $ULINKS_err; ?></span>
              </div>
            </div>

            <div  class="col-4">
              <div class="form group <?php echo (!empty($CLINKS_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group CLINKS">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">CLINKS:</p>
                  <input type="text" name="CLINKS" class="form-control" value="<?php echo $CLINKS; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $CLINKS_err; ?></span>
              </div>
            </div>

          </div>

          <br>
          <br>




        </div>


          <div class="card">
            <div class="card-header">
            <h3 class='card-title' ><strong> Contact Information <strong> </h3>
            </div>
          </div>

          <div class="card-body">



          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($address1_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group address1">
                  <h3 style="color:red; display:inline">*</h3>  <p style="display:inline">Primary Address:</p>
                  <input type="text" name="address1" class="form-control" value="<?php echo $address1; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $address1_err; ?></span>
              </div>
            </div>

            <div  class="col-6">
              <div class="form group <?php echo (!empty($address2_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group address2">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Alternative Address:</p>
                  <input type="text" name="address2" class="form-control" value="<?php echo $address2; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $address2_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group city">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">City:</p>
                  <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $city_err; ?></span>
              </div>
            </div>

            <div  class="col-6">
              <div class="form group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group province">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Province:</p>
                  <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $province_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>


          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group phone">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Phone #1:</p>
                  <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $phone_err; ?></span>
              </div>
            </div>

            <div  class="col-6">
              <div class="form group <?php echo (!empty($phoneAlt_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group phoneAlt">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Phone #2:</p>
                  <input type="text" name="phoneAlt" class="form-control" value="<?php echo $phoneAlt; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $phoneAlt_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">
            <div  class="col-6">
              <div class="form group <?php echo (!empty($pcode_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group pcode">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Postal Code:</p>
                  <input type="text" name="pcode" class="form-control" value="<?php echo $pcode; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $pcode_err; ?></span>
              </div>
            </div>

            <div  class="col-6">
              <div class="form group <?php echo (!empty($personalEmail_err)) ? 'has-error' : ''; ?>">
                <span class "label inbox-info"></span>
                <div class = "group personalEmail">
                <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Personal Email:</p>
                  <input type="text" name="personalEmail" class="form-control" value="<?php echo $personalEmail; ?>">
                </div>
                <span class="help-block" style="color:red;"><?php echo $personalEmail_err; ?></span>
              </div>
            </div>
          </div>



          <br>
          <br>

          <div class="row">

            <div  class="col-6">
                        <div class="form group <?php echo (!empty($country_err)) ? 'has-error' : ''; ?>">
                          <span class "label inbox-info"></span>
                          <div class = "group country">
                          <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Country:</p>
                            <input type="text" name="country" class="form-control" value="<?php echo $country; ?>">
                          </div>
                          <span class="help-block" style="color:red;"><?php echo $country_err; ?></span>
                        </div>
                      </div>

                      <div class="col-6" >
                        <div class="form group <?php echo (!empty($bio_err)) ? 'has-error' : ''; ?>">
                          <span class "label inbox-info"></span>
                          <div class = "group bio">
                          <h3 style="color:red; display:inline">*</h3>    <p style="display:inline">Bio:</p>
                            <textarea  name="bio" class="form-control"  style="height: 5em;" ><?php echo $bio; ?> </textarea>
                          </div>
                          <span class="help-block" style="color:red;"><?php echo $bio_err; ?></span>
                        </div>
                      </div>


          </div>

        </div>





          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">

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
