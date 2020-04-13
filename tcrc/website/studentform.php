<?php
// Initialize the session
session_start();

$REDIRECT = 'thankyou.php';

//Remove error reporting
error_reporting(0);
// Define variables and initialize with empty values
$fname = $lname =$trent_email = $phone = $stud_num = $college = $major = $address = $stud_status = "";
$source = $mail_TCRC = $mail_ULink = $proj_num1 = $proj_num2 = $proj_num3 = $coursecode = "";
$supervisor = $credits = $cum_grade = $dept_req = $province = $city = "";
$name_err = $trent_email_err = $phone_err = $stud_num_err = $college_err = $major_err = $address_err = $stud_status_err = "";
$source_err = $mail_TCRC_err = $mail_ULink_err = $proj_num1_err = $proj_num2_err = $proj_num3_err = $coursecode_err = "";
$supervisor_err = $credits_err = $cum_grade_err = $dept_req_err = $province_err = $city_err = "";

$sql = "";
$result = "";
$projectArray = array();
$id = $projectTitle = $projectNumber = "";
$i = 0;
$result = array();
$counter = 0;
require_once "config.php";

//Retrieve the list of currently approved but not yet begun projects
$sql = "SELECT id,projectTitle, projectNumber FROM project WHERE status = 'approved'";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray[$counter] = array($row[0],$row[1],$row[2]);
    $counter++;
  }

}


// if($stmt = mysqli_prepare($link,$sql)){
//
//   if(mysqli_stmt_execute($stmt)){
//     mysqli_stmt_store_result($stmt);
//     mysqli_stmt_bind_result($stmt, $id, $projectTitle, $projectNumber);
//
//     while ($stmt->fetch()) {
//         $result[$counter] = array($id, $projectTitle, $projectNumber);
//     }
//
//
//     var_dump($result);
//   }
// }


if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Checking for missing entries
  if(empty(trim($_POST["fname"]) || empty(trim($_POST["lname"])))){
    //error declaration
    $name_err = "Please input your name.";
  } else {
    //variable declaration
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
  }

  if(empty(trim($_POST["email"]))){
    //error declaration
    $trent_email_err = "Please input your email.";
  } else {
    //variable declaration
    $trent_email  = trim($_POST["email"]);
  }

  if(empty(trim($_POST["phone"]))){
    //error declaration
    $phone_err = "Please input your phone.";
  } else {
    //variable declaration
    $phone  = trim($_POST["phone"]);
  }

  if(empty(trim($_POST["stud_num"]))){
    //error declaration
    $stud_num_err = "Please input your student number.";
  } else {
    //variable declaration
    $stud_num  = trim($_POST["stud_num"]);
  }

  if(empty(trim($_POST["college"]))){
    //error declaration
    $college_err = "Please select your college.";
  } else {
    //variable declaration
    $college  = trim($_POST["college"]);
  }

  if(empty(trim($_POST["major"]))){
    //error declaration
    $major_err = "Please input your major.";
  } else {
    //variable declaration
    $major  = trim($_POST["major"]);
  }

  if(empty(trim($_POST["address"]))){
    //error declaration
    $address_err = "Please input your address.";
  } else {
    //variable declaration
    $address  = trim($_POST["address"]);
  }

  if(empty(trim($_POST['province']))){
    $province_err = "Please input the province";
  } else {
    $province = trim($_POST['province']);
  }

  if(empty(trim($_POST['city']))){
    $city_err = "Please input the city";
  } else {
    $city = trim($_POST['city']);
  }

  if(empty(trim($_POST["stud_status"]))){
    //error declaration
    $stud_status_err = "Please select your student status.";
  } else {
    //variable declaration
    $stud_status  = trim($_POST["stud_status"]);

  }


  if(empty(trim($_POST["source"]))){
    //error declaration
    $source_err = "Please input your advertisement source.";
  } else {
    //variable declaration
    $source  = trim($_POST["source"]);
  }

  if(empty(trim($_POST["mail_TCRC"]))){
    //error declaration
    $mail_TCRC_err = "Please select TCRC mailing consent.";
  } else {
    //variable declaration
    $mail_TCRC  = trim($_POST["mail_TCRC"]);
    if($mail_TCRC == 'yes'){
      $mail_TCRC = 1;
    } else {
      $mail_TCRC = 0;
    }
  }

  if(empty(trim($_POST["mail_ULink"]))){
    //error declaration
    $mail_ULink_err = "Please select ULinks mailing consent.";
  } else {
    //variable declaration
    $mail_ULink  = trim($_POST["mail_ULink"]);
    if($mail_ULink == 'yes'){
      $mail_ULink = 1;
    } else {
      $mail_ULink = 0;
    }
  }

  if(empty(trim($_POST["proj_num1"]))){
    //error declaration
    $proj_num1_err = "Please input your first preferred project";
  } else {
    //variable declaration
    $proj_num1  = trim($_POST["proj_num1"]);
    if($proj_num1 == 'no_select'){
      $proj_num1 = 0;
    }
  }

  if(empty(trim($_POST["proj_num2"]))){
    //error declaration
    $proj_num2_err = "Please input your second preferred project";
  } else {
    //variable declaration
    $proj_num2  = trim($_POST["proj_num2"]);
    if($proj_num2 == 'no_select'){
      $proj_num2 = 0;
    }
  }

  if(empty(trim($_POST["proj_num3"]))){
    //error declaration
    $proj_num3_err = "Please input your third preferred project.";
  } else {
    //variable declaration
    $proj_num3  = trim($_POST["proj_num3"]);
    if($proj_num3 == 'no_select'){
      $proj_num3 = 0;
    }
  }


  //Project input checking.
  //If all 3 selected projects are identical
  if ($proj_num1 == $proj_num2 && $proj_num1 == $proj_num3)
  {
    $proj_num1_err = $proj_num2_err = $proj_num3_err = "You cannot select a project you already selected/You must select atleast one project";
    $proj_num1 = $proj_num2 = $proj_num3 = "";
  } elseif ($proj_num1 == $proj_num2)
  { //if two selected projects match
    if ($proj_num1 == 0)
    {
      //If both are no_select, ignore
    } else {
      //Else, warn that they cannot be the same
      $proj_num1_err = $proj_num2_err = "You cannot select a project you already selected";
      $proj_num1 = $proj_num2 = "";
    }
  } elseif ($proj_num1 == $proj_num3)
  {
    if ($proj_num1 == 0){
      //If both are no_select, ignore
    } else {
      //Else, warn that they cannot be the same
      $proj_num1_err = $proj_num3_err = "You cannot select a project you already selected";
      $proj_num1 = $proj_num3 = "";
    }
  } elseif ($proj_num2 == $proj_num3)
  {
    if ($proj_num2 == 0)
    {
      //If both are no_select, ignore
    } else {
      //Else, warn that they cannot be the same
      $proj_num3_err = $proj_num2_err = "You cannot select a project you already selected";
      $proj_num3 = $proj_num2 = "";
    }
  } else {
    //Do nothing
  }


  if(empty(trim($_POST["coursecode"]))){
    //error declaration
    $coursecode_err = "Please input your course code.";
  } else {
    //variable declaration
    $coursecode  = trim($_POST["coursecode"]);
  }

  if(empty(trim($_POST["supervisor"]))){
    //error declaration
    $supervisor_err = "Please input your supervisor name.";
  } else {
    //variable declaration
    $supervisor  = trim($_POST["supervisor"]);
  }

  if(empty(trim($_POST["credits"]))){
    //error declaration
    $credits_err = "Please select your credits requirement choice.";
  } else {
    //variable declaration
    $credits  = trim($_POST["credits"]);
    if($credits == 'yes'){
      $credits = 1;
    } else {
      $credits = 0;
    }
  }

  if(empty(trim($_POST["cum_grade"]))){
    //error declaration
    $cum_grade_err = "Please select your cummulative grade requirement choice.";
  } else {
    //variable declaration
    $cum_grade  = trim($_POST["cum_grade"]);
    if($cum_grade == 'yes'){
      $cum_grade = 1;
    } else {
      $cum_grade = 0;
    }
  }

  if(empty(trim($_POST["dept_req"]))){
    //error declaration
    $dept_req_err = "Please select your departamental requirement choice.";
  } else {
    //variable declaration
    $dept_req  = trim($_POST["dept_req"]);
    if($dept_req == 'yes'){
      $dept_req = 1;
    } else {
      $dept_req = 0;
    }
  }


//If there are no errors with user input
  var_dump($name_err,$trent_email_err
  ,$phone_err
  ,$stud_num_err
  ,$college_err
  ,$major_err
  ,$address_err
  ,$province_err
  ,$city_err
  ,$stud_status_err
  ,$source_err
  ,$mail_TCRC_err
  ,$mail_ULink_err
  ,$proj_num1_err
  ,$proj_num2_err
  ,$proj_num3_err
  ,$coursecode_err
  ,$supervisor_err
  ,$credits_err
  ,$dept_req_err,$cum_grade_err);#)

  if(empty($name_err)
  && empty ($trent_email_err)
  && empty ($phone_err)
  && empty ($stud_num_err)
  && empty ($college_err)
  && empty ($major_err)
  && empty ($address_err)
  && empty ($province_err)
  && empty ($city_err)
  && empty ($stud_status_err)
  && empty ($source_err)
  && empty ($mail_TCRC_err)
  && empty ($mail_ULink_err)
  && empty ($proj_num1_err)
  && empty ($proj_num2_err)
  && empty ($proj_num3_err)
  && empty ($coursecode_err)
  && empty ($supervisor_err)
  && empty ($credits_err)
  && empty ($dept_req_err)
  && empty ($cum_grade_err))
  {
    //Assemble an SQL query
    $sql = "INSERT INTO studentForm(id,fname, lname, tNumber, studNumber, email, college, major, address, city, province, studentStatus, notes, mailConsentTCRC, mailConsentULinks, projectInterestID, projectInterestID_2, projectInterestID_3,coursecode,facultySupervisor, CreditAchieved, CumulativeAchieved,deptPrereq)
    VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?,?,?, ?, ?,?)";


    //Prepare the query
    if($stmt = mysqli_prepare($link,$sql)){
      $id = null;
      //BInd parameters
      mysqli_stmt_bind_param($stmt, "isssissssssssiiiiissiii", $id, $fname, $lname,$phone,$stud_num,$trent_email,$college,$major,$address,$city,$province,
      $stud_status,$source,$mail_TCRC,$mail_ULink, $proj_num1,$proj_num2,$proj_num3,$coursecode,$supervisor,
      $credits,$cum_grade,$dept_req);

      //Execute. If there are no problems, redirect
      if(mysqli_stmt_execute($stmt)){
          // Redirect to login page
          $sql = "INSERT INTO student(id,firstName, lastName, studentNum, email,street, city, province, phone, major, credAchieved, cumAchieved,foreignStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
          $id = null;
          if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "ississsssssis", $id,$fname,$lname,$stud_num,$trent_email,$address,$city,$province,$phone,$major,$credits,$cum_grade,$studentStatus);

            if(mysqli_stmt_execute($stmt)){
              header("location: $REDIRECT");
            } else {
              //failed to create student.
            }
          }
        } else{ //if there are problems, resume page and print out an error message
          echo "Something went wrong. Please try again later.";
      }
    }
  }


  mysqli_close($link);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.jpg"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/stud_form.css">
<!--===============================================================================================-->

</head>

<body>
  <div class="limiter">
    <div class="container-login100" style="background-image: url('images/Login_background.jpg');">
      <div class="studentform-wrap">
      <h2>Student Project Form</h2>
      <p>Please fill this form to create an account.</p>
      <p>This application is for students wanting to undertake a community-based research project with the Trent Community Research Centre (TCRC) or U-Links Centre for Community-Based Research.</p>
      <p>Students generally connect with our projects either by enrolling in a course that we work with, or by
        doing an independent project under the supervision of a faculty member. There is a course code for
        community-based research in most departments at Trent University.</p>
        <p>Please refer to the Academic Calendar for details.</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Name</span>
          <div class = "group name">
            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
          </div>
          <span class="help-block"><?php echo $name_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($trent_email_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Email</span>
          <input type="text" name="email" class="form-control" value="<?php echo $trent_email; ?>">
          <span class="help-block"><?php echo $trent_email_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Phone</span>
          <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
          <span class="help-block"><?php echo $phone_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($stud_num_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Student Number</span>
          <input type="text" name="stud_num" class="form-control" value="<?php echo $stud_num; ?>">
          <span class="help-block"><?php echo $stud_num_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($college_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">College</span>
          <div class = "group college">
          <input type="radio" name="college" value="Traill"  <?php if($college == 'Traill') echo 'checked = \'checked\''?>> Traill College </input>
          <input type="radio" name="college" value="Champlain"  <?php if($college == 'Champlain') echo 'checked = \'checked\''?>> Champlain College </input>
          <input type="radio" name="college" value="Lady_Eaton"  <?php if($college == 'Lady_Eaton') echo 'checked = \'checked\''?>> Lady Eaton College </input>
          <input type="radio" name="college" value="Otanabee"  <?php if($college == 'Otanabee') echo 'checked = \'checked\''?>> Otanabee College </input>
          <input type="radio" name="college" value="Gzowski"  <?php if($college == 'Gzowski') echo 'checked = \'checked\''?>> Gzowksi College </input>
          <input type="radio" name="college" value="No_affiliation"  <?php if($college == 'No_affiliation') echo 'checked = \'checked\''?>> Not affiliated </input>
        </div>
          <span class="help-block"><?php echo $college_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($major_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Major</span>
          <input type="text" name="major" class="form-control" value="<?php echo $major; ?>">
          <span class="help-block"><?php echo $major_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Address</span>
          <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
          <span class="help-block"><?php echo $address_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">City</span>
          <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
          <span class="help-block"><?php echo $city_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Province</span>
          <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
          <span class="help-block"><?php echo $province_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($stud_status_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Student Status</span>
          <div class = "group status">
          <input type="radio" name="stud_status" value="international"  <?php if($stud_status == 'international') echo 'checked = \'checked\''?>> International </input>
          <input type="radio" name="stud_status" value="canadian"  <?php if($stud_status == 'canadian') echo 'checked = \'checked\''?>> Canadian </input>
        </div>
          <span class="help-block"><?php echo $stud_status_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($source_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Where did you hear about us?</span>
          <input type="text" name="source" class="form-control" value="<?php echo $source; ?>">
          <span class="help-block"><?php echo $source_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($mail_TCRC_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Join TCRC Mailing list?</span>
          <div class = "group mail">
          <input type="radio" name="mail_TCRC" value="yes"  <?php if($mail_ULink == 'yes') echo 'checked = \'checked\''?>> Yes </input>
          <input type="radio" name="mail_TCRC" value="no" <?php if($mail_ULink == 'no') echo 'checked = \'checked\''?>> No </input>
          </div>
          <span class="help-block"><?php echo $mail_TCRC_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($mail_ULink_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Join ULinks Mailing list?</span>
          <div class = "group college">
          <input type="radio" name="mail_ULink" value="yes"<?php if($mail_ULink == 'yes') echo 'checked = \'checked\''?>> Yes </input>
          <input type="radio" name="mail_ULink" value="no" <?php if($mail_ULink == 'no') echo 'checked = \'checked\''?>> No </input>
        </div>
          <span class="help-block"><?php echo $mail_ULink_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($proj_num1_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Select Project #1</span>
          <select name = "proj_num1">
            <option value = "no_select">No preference</option>
            <?php for($i = 0; $i < $counter; $i++){
              //For all rows in the projects array, print out the value as an <option>
              echo "<option value = '{$projectArray[$i]['2']}'>{$projectArray[$i]['2']} {$projectArray[$i]['1']}</option>";
            }?>
          </select>
          <span class="help-block"><?php echo $proj_num1_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($proj_num2_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Select Project #2</span>
          <select name = "proj_num2">
            <option value = "no_select">No preference</option>
            <?php for($i = 0; $i < $counter; $i++){
              //For all rows in the projects array, print out the value as an <option>
              echo "<option value = '{$projectArray[$i]['2']}'>{$projectArray[$i]['2']} {$projectArray[$i]['1']}</option>";
            }?>
          </select>
          <span class="help-block"><?php echo $proj_num2_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($proj_num3_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Select Project #3</span>
          <select name = "proj_num3">
            <option value = "no_select">No preference</option>
            <?php for($i = 0; $i < $counter; $i++){
              //For all rows in the projects array, print out the value as an <option>
              echo "<option value = '{$projectArray[$i]['2']}'>{$projectArray[$i]['2']} {$projectArray[$i]['1']}</option>";
            }?>
          </select>
          <span class="help-block"><?php echo $proj_num3_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($coursecode_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Course Code</span>
          <input type="text" name="coursecode" class="form-control" value="<?php echo $coursecode; ?>">
          <span class="help-block"><?php echo $coursecode_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($supervisor_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Supervisor Name</span>
          <input type="text" name="supervisor" class="form-control" value="<?php echo $supervisor; ?>">
          <span class="help-block"><?php echo $supervisor_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($credits_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Do you meet credit requirements?</span>
          <div class = "group credits">
          <input type="radio" name="credits" value="yes"  <?php if($credits == 'yes') echo 'checked = \'checked\''?>> Yes </input>
          <input type="radio" name="credits" value="no"  <?php if($credits == 'no') echo 'checked = \'checked\''?>> No </input>
        </div>
          <span class="help-block"><?php echo $credits_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($cum_grade_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Do you meet average grade requirements?</span>
          <div class = "group grade">
          <input type="radio" name="cum_grade" value="yes" <?php if($cum_grade == 'yes') echo 'checked = \'checked\''?>> Yes </input>
          <input type="radio" name="cum_grade" value="no" <?php if($cum_grade == 'no') echo 'checked = \'checked\''?>> No </input>
          </div>
          <span class="help-block"><?php echo $cum_grade_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($dept_req_err)) ? 'has-error' : ''; ?>">
          <span class= "label inbox-info">Do you meet departamental requirements?</span>
          <div class = "group depreq">
          <input type="radio" name="dept_req" value="yes" <?php if($dept_req == 'no') echo 'checked = \'checked\''?>> Yes </input>
          <input type="radio" name="dept_req" value="no"  <?php if($dept_req == 'no') echo 'checked = \'checked\''?>> No </input>
          </div>
          <span class="help-block"><?php echo $dept_req_err; ?></span>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
      </form>
    </div>
    </div>
  </div>

</body>
</html>
