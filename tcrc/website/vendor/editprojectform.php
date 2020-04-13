<?php
// Initialize the session
session_start();
$theid = $_GET["id"];

require_once "config.php";

//TO-DO: Add Security (Check if user requesting the change is of right account type)







//=============================

include 'includes/nav.php';

$sql = "SELECT * FROM projectForm WHERE id = $theid";

//Retrieve and store as a variable
if($result = $link -> query($sql)){
  while ($row = $result -> fetch_row()){
    $projectArray = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],
    $row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],
  $row[22],$row[23],$row[24],$row[25],$row[26],$row[27],$row[28]);

  }
}


$orgName =  $contact = $address = $phone = $email = $website = $logoConsent = $orgPurpose = "";
$orgYear = $orgEmployee = $approved =  $theme = $projectScale = $projectTitle = $projectDescription = $projectTask= "";
$projectStartDate = $projectEndDate = $researchEthics1 = $researchEthics2 = $researchEthics3 = $projectImplementation = $screeningReq1 = $screeningReq2 = "";
$additionalSkills = $resourcesNeeded = $fundingNeeded =	$additionalNotes = $photoLink= "";

$orgName = $projectArray[1];
$contact = $projectArray[2];
$address = $projectArray[3];
$phone = $projectArray[4];
$email = $projectArray[5];
$website = $projectArray[6];


$logoConsent = $projectArray[7];
if ($logoConsent == 1) {
  $logoConsent = 'Yes';
}
else {
  $logoConsent = 'No';
}

$orgPurpose = $projectArray[8];
$orgYear = $projectArray[9];
$orgEmployee = $projectArray[10];
$approved = $projectArray[11];

$theme = $projectArray[12];
$themeA[] = $theme;
$projectScale = $projectArray[13];
$projectTitle = $projectArray[14];
$projectDescription = $projectArray[15];
$projectTask = $projectArray[16];
$projectStartDate = $projectArray[17];
$projectEndDate =  $projectArray[18];
$researchEthics1 = $projectArray[19];
$researchEthics2 = $projectArray[20];
$researchEthics3 = $projectArray[21];
$projectImplementation = $projectArray[22];
$screeningReq1 = $projectArray[23];
$screeningReq2 = $projectArray[24];
$additionalSkills = $projectArray[25];
$resourcesNeeded = $projectArray[26];
$fundingNeeded =	$projectArray[27];
$additionalNotes = $projectArray[28];
//$photoLink = $projectArray[29];



$orgName_err =  $contact_err = $address_err = $phone_err = $email_err = $website_err = $logoConsent_err = $orgPurpose_err = "";
$orgYear_err = $orgEmployee_err = $approved_err =  $theme_err = $projectScale_err = $projectTitle_err = $projectDescription_err1 = $projectTask_err= "";
$projectStartDate_err = $projectEndDate_err = $researchEthics_err1 =$researchEthics_err2 = $researchEthics_err3 = $projectImplementation_err = $screeningReq_err1 = $screeningReq_err2 = "";
$additionalSkills_err = $resourcesNeeded_err = $fundingNeeded_err =	$additionalNotes_err = $photoLink_err= "";


$projectDescription_err2 = $projectDescription_err3 = $projectDescription_err4 = $projectDescription_err5 = "";

require_once "config.php";

error_reporting(0);

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty(trim($_POST["orgName"]))){
    //error declaration
    $orgName_err = "Please input your Organization Name.";
  } else {
    //variable declaration
    $orgName  = trim($_POST["orgName"]);
  }


  if(empty(trim($_POST["contact"]))){
    //error declaration
    $contact_err = "Please input your Contact.";
  } else {
    //variable declaration
    $contact  = trim($_POST["contact"]);
  }

  if(empty(trim($_POST["address"]))){
    //error declaration
    $address_err = "Please input your Address.";
  } else {
    //variable declaration
    $address  = trim($_POST["address"]);
  }


  if(empty(trim($_POST["phone"]))){
    //error declaration
    $phone_err = "Please input your Phone number.";
  } else {
    //variable declaration
    $phone  = trim($_POST["phone"]);
  }


  if(empty(trim($_POST["email"]))){
    //error declaration
    $email_err = "Please input your Email.";
  } else {
    //variable declaration
    $email = trim($_POST["email"]);
  }


  if(empty(trim($_POST["website"]))){
    //error declaration
    $website_err = "Please input your Website.";
  } else {
    //variable declaration
    $website = trim($_POST["website"]);
  }




  if(empty(trim($_POST["logoConsent"]))){
    //error declaration
    $logoConsent_err = "Please choose an option for Logo Consent.";
  } else {
    //variable declaration
    $logoConsent = trim($_POST["logoConsent"]);

    if($logoConsent == 'Yes'){
      $logoConsent = 1;
    }
      else {
        $logoConsent = 0;
      }

  }




  if(empty(trim($_POST["orgPurpose"]))){
    //error declaration
    $orgPurpose_err = "Please input your Organization Purpose.";
  } else {
    //variable declaration
    $orgPurpose = trim($_POST["orgPurpose"]);
  }




  if(empty(trim($_POST["orgYear"]))){
    //error declaration
    $orgYear_err = "Please input your Organization Year.";
  } else {
    //variable declaration
    $orgYear = trim($_POST["orgYear"]);
  }




  if(empty(trim($_POST["orgEmployee"]))){
    //error declaration
    $orgEmployee_err = "Please input your Organization Employee.";
  } else {
    //variable declaration
    $orgEmployee = trim($_POST["orgEmployee"]);
  }


  if(empty(trim($_POST["approved"]))){
    //error declaration
    $approved_err = "Please input answer for this question.";
  } else {
    //variable declaration
    $approved = trim($_POST["approved"]);
  }



$themeA = array();
  if(empty(trim($_POST["culturalTheme"])) && empty(trim($_POST["economicTheme"])) &&
empty(trim($_POST["environmentalTheme"])) &&empty(trim($_POST["socialTheme"]))
 &&empty(trim($_POST["themeOther"]))){
    //error declaration
    $theme_err = "Please select at least 1 Theme";
  } else {
    //variable declaration

    if (isset($_POST['culturalTheme'])) {
      $themeA[] = $_POST['culturalTheme'];
    }

    if (isset($_POST['economicTheme'])) {
      $themeA[] = $_POST['economicTheme'];
    }
    if (isset($_POST['environmentalTheme'])) {
      $themeA[] = $_POST['environmentalTheme'];
    }
    if (isset($_POST['socialTheme'])) {
      $themeA[] = $_POST['socialTheme'];
    }
    if (isset($_POST['themeOther'])) {
      $themeA[] = $_POST['themeOther'];
    }

    $theme = implode( ", ", $themeA );
  }











  $projectScaleA = array();
  if(empty(trim($_POST["scale1"])) && empty(trim($_POST["scale2"])) &&
empty(trim($_POST["scale3"])) && empty(trim($_POST["scale4"])) &&
empty(trim($_POST["scale5"])) && empty(trim($_POST["scale6"])) &&
empty(trim($_POST["scale7"])) && empty(trim($_POST["projectScale"]))){
    //error declaration
    $projectScale_err = "Please select at least 1 Project Scale.";
  } else {

    if (isset($_POST['scale1'])) {
      $projectScaleA[] = $_POST['scale1'];
    }

    if (isset($_POST['scale2'])) {
      $projectScaleA[] = $_POST['scale2'];
    }
    if (isset($_POST['scale3'])) {
      $projectScaleA[] = $_POST['scale3'];
    }
    if (isset($_POST['scale4'])) {
      $projectScaleA[] = $_POST['scale4'];
    }
    if (isset($_POST['scale5'])) {
      $projectScaleA[] = $_POST['scale5'];
    }
    if (isset($_POST['scale6'])) {
      $projectScaleA[] = $_POST['scale6'];
    }
    if (isset($_POST['scale7'])) {
      $projectScaleA[] = $_POST['scale7'];
    }

    //variable declaration
    $projectScale = implode( ", ", $projectScaleA );
  }




  if(empty(trim($_POST["projectTitle"]))){
    //error declaration
    $projectTitle_err = "Please input your Project Title.";
  } else {
    //variable declaration
    $projectTitle = trim($_POST["projectTitle"]);
  }













   $description1 = "";
   $description2 = "";
   $description3 = "";
   $description4 = "";
   $description5 = "";
  if(empty(trim($_POST["description1"]))){
    //error declaration
    $projectDescription_err1 = "Please input your Project Description.";
  }else {
    $description1 = $_POST['description1'];
  }



  if(empty(trim($_POST["description2"]))) {
    // error declaration
    $projectDescription_err2 = "Please input your Project Description.";
  }else {
    $description2 = $_POST['description2'];
  }

  if(empty(trim($_POST["description3"]))) {
    // error declaration
    $projectDescription_err3 = "Please input your Project Description.";
  }else {
    $description3 = $_POST['description3'];
  }


  if(empty(trim($_POST["description4"]))) {
    // error declaration
    $projectDescription_err4 = "Please input your Project Description.";
  }else {
    $description4 = $_POST['description4'];
  }


  if(empty(trim($_POST["description5"]))) {
    // error declaration
    $projectDescription_err5 = "Please input your Project Description.";
  }else {
    $description5 = $_POST['description5'];
  }


    $projectDescription = $description1.", ".$description2.", ".$description3.", ".$description4.", ".$description5;





  $projectTask1 = $_POST['projectTask1'];
  $projectTask2 = $_POST['projectTask2'];
  $projectTask3 = $_POST['projectTask3'];
  if(empty(trim($_POST["projectTask1"])) && empty(trim($_POST["projectTask2"])) &&
empty(trim($_POST["projectTask3"]))){
    //error declaration
    $projectTask_err = "Please input a Project Task.";
  } else {
    //variable declaration
    $projectTask = "Task 1: ".$projectTask1.". Task2: ".$projectTask2.". Task3: ".$projectTask3;
  }


  if(empty(trim($_POST["startDate"]))){
    //error declaration
    $projectStartDate_err = "Please input your Project Start Date.";
  } else {
    //variable declaration
    $projectStartDate = trim($_POST["startDate"]);
  }




  if(empty(trim($_POST["endDate"]))){
    //error declaration
    $projectEndDate_err = "Please input your Project End Date.";
  } else {
    //variable declaration
    $projectEndDate = trim($_POST["endDate"]);
  }



  $projectImplementationA = array();
  if(empty(trim($_POST["projectImplementation1"])) && empty(trim($_POST["projectImplementation2"])) &&
empty(trim($_POST["projectImplementation3"])) && empty(trim($_POST["projectImplementation4"])) &&
empty(trim($_POST["projectImplementation5"])) && empty(trim($_POST["projectImplementation6"])) &&
empty(trim($_POST["otherProjectImplementation"]))){
    //error declaration
    $projectImplementation_err = "Please choose at least 1 option for Project Implementation.";
  } else {
    //variable declaration
    if (isset($_POST['projectImplementation1'])) {
      $projectImplementationA[] = $_POST['projectImplementation1'];
    }

    if (isset($_POST['projectImplementation2'])) {
      $projectImplementationA[] = $_POST['projectImplementation2'];
    }
    if (isset($_POST['projectImplementation3'])) {
      $projectImplementationA[] = $_POST['projectImplementation3'];
    }
    if (isset($_POST['projectImplementation4'])) {
      $projectImplementationA[] = $_POST['projectImplementation4'];
    }
    if (isset($_POST['projectImplementation5'])) {
      $projectImplementationA[] = $_POST['projectImplementation5'];
    }
    if (isset($_POST['projectImplementation6'])) {
      $projectImplementationA[] = $_POST['projectImplementation6'];
    }
    if (isset($_POST['otherProjectImplementation'])) {
      $projectImplementationA[] = $_POST['otherProjectImplementation'];
    }

    $projectImplementation = implode( ", ", $projectImplementationA );
  }




  if(empty(trim($_POST["q1"]))){
    //error declaration
    $researchEthics_err1 = "Please choose an option!";
  }
  else {
  //variable declaration
  $q1 = $_POST['q1'];


if($q1 == 'Research invovles human subjects'){
  $researchEthics1 = 1;
}
  else {
    $researchEthics1 = 0;
  }

}



if(empty(trim($_POST["q2"]))){
  //error declaration
  $researchEthics_err2 = "Please choose an option!";
}
else {
//variable declaration
$q2 = $_POST['q2'];

if($q2 == 'Yes, I want access to the raw data at the end of the project'){
  $researchEthics2 = 1;
}
  else {
    $researchEthics2 = 0;
  }

}


if(empty(trim($_POST["q3"]))){
  //error declaration
  $researchEthics_err3 = "Please choose an option!";
}
else {
//variable declaration
$q3 = $_POST['q3'];

if($q3 == 'Yes, lead had policies about research ethics approval.'){
  $researchEthics3 = 1;
}
  else {
    $researchEthics3 = 0;
  }


}






  if (empty(trim($_POST["screeningQ1"]))) {
    $screeningReq_err1 = "Please choose an option!";
  }
  else {
  //variable declaration
  $screeningQ1 = $_POST['screeningQ1'];

  if($screeningQ1 == 'Yes, the students require specific training.'){
    $screeningReq1 = 1;
  }
    else {
      $screeningReq1 = 0;
    }

}


  if (empty(trim($_POST["screeningQ2"]))) {
    $screeningReq_err2 = "Please choose an option!";
  }
  else {
  //variable declaration
  $screeningQ2 = $_POST['screeningQ2'];

  if($screeningQ2 == 'Yes, the students will be conducting research on site, or working with valuable equipment.'){
    $screeningReq2 = 1;
  }
    else {
      $screeningReq2 = 0;
    }


}




if(empty(trim($_POST["resourcesNeeded"]))){
  //error declaration
  $resourcesNeeded_err = "Please input your Needed Resources.";
} else {
  //variable declaration
  $resourcesNeeded = trim($_POST["resourcesNeeded"]);
}



if(empty(trim($_POST["fundingNeeded"]))){
  //error declaration
  $fundingNeeded_err = "Please input your Project funding needed.";
} else {
  //variable declaration
  $fundingNeeded = trim($_POST["fundingNeeded"]);
}


if(empty(trim($_POST["additionalNotes"]))){
  //error declaration
  $additionalNotes_err = "Please input an answer for this question.";
} else {
  //variable declaration
  $additionalNotes = trim($_POST["additionalNotes"]);
}





$additionalSkills = $_POST["additionalSkills"];
$photoLink = $_POST["photoLink"];

if(empty($orgName_err) && empty ($contact_err) && empty ($address_err)
&& empty ($phone_err) && empty ($email_err) && empty ($website_err)
&& empty ($logoConsent_err) && empty ($orgPurpose_err)
&& empty ($orgYear_err) && empty ($orgEmployee_err) && empty ($approved_err) && empty ($theme_err)
&& empty ($projectScale_err) && empty ($projectTitle_err)
&& empty ($projectDescription_err1) && empty ($projectDescription_err2) && empty ($projectDescription_err3) && empty ($projectDescription_err4)
&& empty ($projectDescription_err5) && empty ($projectTask_err)
&& empty ($projectStartDate_err) && empty ($projectEndDate_err)
&& empty ($researchEthics_err1) && empty ($researchEthics_err2) && empty ($researchEthics_err3)
&& empty ($projectImplementation_err) && empty ($screeningReq_err1) && empty ($screeningReq_err2)
&& empty ($resourcesNeeded_err) && empty ($fundingNeeded_err)
&& empty ($additionalNotes_err) && empty ($resourcesNeeded_err))
{

include 'includes/library.php';
  $pdo = & dbconnect();


  //add account details to database
    $sql="UPDATE projectForm SET orgName = ?, contact = ?, address = ?, phone = ?, email = ?,
      website = ?, 	logoConsent = ?, orgPurpose = ?, orgYear = ?, orgEmployee = ?, approved = ?, theme = ?,
  	  projectScale = ?, projectTitle = ?, projectDescription = ?, projectTask = ?, 	projectStartDate = ?,
    	projectEndDate = ?, researchEthics1 = ?, researchEthics2 = ?, researchEthics3 = ?, projectImplementation = ?, 	screeningReq1 = ?, screeningReq2 = ?, additionalSkills = ?,
    	resourcesNeeded = ?, fundingNeeded = ?,	additionalNotes = ?, photoLink = ?) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt ->execute([$orgName, $contact, $address, $phone, $email,
      $website, 	$logoConsent, $orgPurpose, $orgYear, $orgEmployee, $approved, $theme,
  	  $projectScale, $projectTitle, $projectDescription, $projectTask, 	$projectStartDate,
    	$projectEndDate, $researchEthics1, $researchEthics2, $researchEthics3, $projectImplementation, $screeningReq1, $screeningReq2, $additionalSkills,
    	$resourcesNeeded, $fundingNeeded,	$additionalNotes, $photoLink]);


  echo "application submitted";
  header("location: google.com");

}








}


 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
  <!--     <link href="css/sstylee.css" rel="stylesheet" type="text/css">  -->

    <!--  Example - CDN absolute path -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!--fallback for jQuery if CDN is unavailable-->
        <script>window.jQuery || document.write('<script src="scripts/jquery.js"><\/script>');</script>

        <!--Example - Relative Path --->
        <script src="scripts/scripts.js"></script>

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
          <link rel="stylesheet" type="text/css" href="css/proj_form.css">
        <!--===============================================================================================-->




  </head>

  <body>

    <div class="limiter">
      <div class="container-login100" style="background-image: url('images/Login_background.jpg');">
        <div class="studentform-wrap">
<img src="images/TrentCommResCentre.jpg" alt="" class="center" >

<p class="underlogo"><i> Visit our <a href="https://www.trentu.ca/community-based-research/">website</a> for frequently asked questions and other helpful tips.
   You can also talk with one of our projects coordinators if you would like assistance developing your proposal.
    If there are sections you’re not sure of, our staff can help.</i></p>

<!-- Project Form-->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<!-- Title-->
      <h2>Community-Based Research Project Proposal Form</h2>


<p class="titleSec"><u>1. Lead Organization/Group/Employer:</u></p>

<!-- Organization Name-->
    <div >
      <label for="orgName">Organization/Group/Employer name:</label>
      <input type="text" name="orgName" id="createOrgname" value="<?php echo $orgName; ?>">
      <span class="help-block"><?php echo $orgName_err; ?></span>
    </div>


<!-- Contact-->
    <div>
      <label for="contact">Contact:</label>
      <input type="text" name="contact" id="createContact" value="<?php echo $contact; ?>">
      <span class="help-block"><?php echo $contact_err; ?></span>
    </div>

<!-- Address-->
    <div>
      <label for="address">Address:</label>
      <input type="text" name="address" id="createAddress" value="<?php echo $address; ?>">
      <span class="help-block"><?php echo $address_err; ?></span>
    </div>


<!-- Phone number-->
    <div>
      <label for="phone">Phone:</label>
      <input type="text" name="phone" id="createPhone" value="<?php echo $phone; ?>">
      <span class="help-block"><?php echo $phone_err; ?></span>
    </div>

<!-- Email-->
    <div>
      <label for="email">Email:</label>
      <input type="text" name="email" id="createEmail" value="<?php echo $email; ?>">
      <span class="help-block"><?php echo $email_err; ?></span>
    </div>


<!-- Website-->
    <div>
      <label for="website">Website:</label>
      <input type="text" name="website" id="createWebsite" value="<?php echo $website; ?>">
      <span class="help-block"><?php echo $website_err; ?></span>
    </div>


<!-- Logo Consent-->
    <div>
      <label for="logoConsent">Can we post your logo on our website? </label>
      <br>
      <input type="radio" class="btns" name="logoConsent" id="logoConsent1" value="Yes" <?php if($logoConsent == 'Yes') echo 'checked = \'checked\''?> >    Yes
      <input type="radio" class="btns" name="logoConsent" id="logoConsent2" value="No" <?php if($logoConsent == 'No') echo 'checked = \'checked\''?>>  No
      <span class="help-block"><?php echo $logoConsent_err; ?></span>
    </div>








<p><u>Please answer the following questions:</u></p>

<!-- Organization Purpose-->
    <div>
      <label for="orgPurpose">a)	Briefly state your organization/group’s purpose and the products or services offered.</label>
      <input type="text" name="orgPurpose" id="createOrgPurpose" value="<?php echo $orgPurpose; ?>">
      <span class="help-block"><?php echo $orgPurpose_err; ?></span>
    </div>


<!-- Organization Year-->
    <div>
      <label for="orgYear">b)	Year your organization/group was established:</label>
      <input type="number" name="orgYear" id="createOrgYear" value="<?php echo $orgYear; ?>" min="1800" max="2020">
      <span class="help-block"><?php echo $orgYear_err; ?></span>
    </div>

<!-- Organization Employee-->
    <div>
      <label for="orgEmployee">c)	How many staff members (including contract workers) work for your organization/group?:</label>
      <input type="number" name="orgEmployee" id="createOrgEmployee" value="<?php echo $orgEmployee; ?>">
      <span class="help-block"><?php echo $orgEmployee_err; ?></span>
    </div>


    <div>
      <label for="approved">d)	Has your immediate supervisor or board approved this application? If necessary, please provide a name and contact information.</label>
      <input type="text" name="approved" id="approved" value="<?php echo $approved; ?>">
      <span class="help-block"><?php echo $approved_err; ?></span>
    </div>










    <!----------------------------->

    <!--        Theme            -->

    <!----------------------------->

    <p><u>2. Select the theme(s) for your project (check all that apply):</u></p>

  <div>
    <span class="help-block"><?php echo $theme_err; ?></span>
    <div class="block">
      <label for="culturalTheme">Cultural</label>
      <input type="checkbox" name="culturalTheme" id="culturalTheme"  value="Cultural" <?php if(in_array("Cultural", $themeA)) echo 'checked = \'checked\''?>  >



      <label for="economicTheme">Economic</label>
      <input type="checkbox" name="economicTheme" id="economicTheme" value="Economic"  <?php if(in_array("Economic", $themeA)) echo 'checked = \'checked\''?>>



      <label for="environmentalTheme">Environmental</label>
      <input type="checkbox" name="environmentalTheme" id="environmentalTheme" value="Environmental" <?php if(in_array("Environmental", $themeA)) echo 'checked = \'checked\''?>>



      <label for="socialTheme">Social</label>
      <input type="checkbox" name="socialTheme" id="socialTheme" value="Social" <?php if(in_array("Social", $themeA)) echo 'checked = \'checked\''?>>


      <label for="themeOther">Other (please state):</label>
      <input type="text" name="themeOther" id="createTheme" value="">
    </div>

  </div>









  <!----------------------------->

  <!-- Project Scale-->

  <!----------------------------->

    <p><u>3. Tell us about the potential scale of your project</u></p>

    <p class="outform"><i> We understand that it can be difficult to determine the scale of your research project,
       however it helps us if you can provide some details about project scope, including how many students might be involved and the potential time frame.
        Use the check boxes below to guide your thinking – check all that apply.</i></p>


  <div>
    <span class="help-block"><?php echo $projectScale_err; ?></span>
    <div class="block">
      <label for="scale1">It’s a single/discreet project</label>
      <input type="checkbox" name="scale1" id="scale1" value="It’s a single/discreet project"  <?php if(in_array("It’s a single/discreet project", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="scale2">It contains multiple community-based research projects</label>
      <input type="checkbox" name="scale2" id="scale2" value="It contains multiple community-based research projects" <?php if(in_array("It contains multiple community-based research projects", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="scale3">It’s a single year project</label>
      <input type="checkbox" name="scale3" id="scale3" value="It’s a single year project"<?php if(in_array("It’s a single year project", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="scale4">It’s a multi-year project</label>
      <input type="checkbox" name="scale4" id="scale4" value="It’s a multi-year project"  <?php if(in_array("It’s a multi-year project", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="scale5">This project is a great opportunity for undergraduate students</label>
      <input type="checkbox" name="scale5" id="scale5" value="This project is a great opportunity for undergraduate students" <?php if(in_array("This project is a great opportunity for undergraduate students", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="scale6">This project is a great opportunity for graduate students</label>
      <input type="checkbox" name="scale6" id="scale6" value="This project is a great opportunity for graduate students"  <?php if(in_array("This project is a great opportunity for graduate students", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="scale7">There may be external funding opportunities and a role for Trent Centre staff beyond student project
        coordination (e.g. overall project management, mentoring, research design and facilitation, etc.)</label>
      <input type="checkbox" name="scale7" id="scale7" value="External funding"  <?php if(in_array("External funding", $projectScaleA)) echo 'checked = \'checked\''?>>
    </div>

    <div class="block">
      <label for="projectScale">Other (please state):</label>
      <input type="text" name="projectScale" id="createProjectScale" value="">
    </div>
  </div>









  <!----------------------------->

  <!-- Project Title-->

  <!----------------------------->


<p><u>4. Tentative project title:</u></p>
    <div>
      <label for="projectTitle"></label>
      <input type="text" name="projectTitle" id="createProjectTitle" value="<?php echo $projectTitle; ?>">
      <span class="help-block"><?php echo $projectTitle_err; ?></span>
    </div>










    <!----------------------------->

    <!-- Project Description-->

    <!----------------------------->

<p><u>5. Tell us your project idea</u></p>


  <div>
      <label for="description1">a)	What is the purpose of the project and how it will benefit your clients and the social, cultural, environmental and/or economic health of the community?</label>
      <input type="text" name="description1" id="description1" value="<?php echo $description1; ?>">
      <span class="help-block"><?php echo $projectDescription_err1; ?></span>
      <label for="description2">b)	Will there be more than one research project for this initiative? If so, please list and describe each sub-project briefly:</label>
      <input type="text" name="description2" id="description2" value="<?php echo $description2; ?>">
      <span class="help-block"><?php echo $projectDescription_err2; ?></span>
      <label for="description3">c)	What are the proposed research questions to be answered?</label>
      <input type="text" name="description3" id="description3" value="<?php echo $description3; ?>">
      <span class="help-block"><?php echo $projectDescription_err3; ?></span>
      <label for="description4">d)	Can you describe what methods might be used to answer the above question(s)?</label>
      <input type="text" name="description4" id="description4" value="<?php echo $description4; ?>">
      <span class="help-block"><?php echo $projectDescription_err4; ?></span>
      <label for="description5">e)	Briefly describe what the student(s) would do (e.g. creating a manual, evaluating a program, conducting a survey, etc.):	</label>
      <input type="text" name="description5" id="description5" value="<?php echo $description5; ?>">
      <span class="help-block"><?php echo $projectDescription_err5; ?></span>
  </div>











  <!----------------------------->

  <!-- Project Tasks-->

  <!----------------------------->

  <p><u>6. Please outline the major tasks involved in completing the project. </u></p>
  <p class="outform"><i> For example: Important information to be gathered,
     key stakeholders who should be involved, relevant dates for your organization,
     and critical meetings for the student to attend. The following is a suggested format
      for recording project details - please adapt as necessary:</i></p>

  <div>

    <div class="block">
      <label for="projectTask1">Task 1:</label>
      <input type="text" name="projectTask1" id="projectTask1" value="<?php echo $projectTask1; ?>">
      <span class="help-block"><?php echo $projectTask_err; ?></span>
    </div>
    <div class="block">
      <label for="projectTask2">Task 2:</label>
      <input type="text" name="projectTask2" id="projectTask2" value="<?php echo $projectTask2; ?>">
    </div>
    <div class="block">
      <label for="projectTask3">Task 3:</label>
      <input type="text" name="projectTask3" id="projectTask3" value="<?php echo $projectTask3; ?>">
    </div>

  </div>











  <!----------------------------->

  <!-- Start and End Date-->

  <!----------------------------->


<p><u>7. Please explain any important start and end dates for the project</u></p>
    <div>
      <label for="startDate">Start Date:</label>
      <input type="date" name="startDate" id="createStartDate" value="<?php echo $projectStartDate; ?>">
      <span class="help-block"><?php echo $projectStartDate_err; ?></span>
    </div>


    <div>
      <label for="endDate">End Date:</label>
      <input type="date" name="endDate" id="createEndDate" value="<?php echo $projectEndDate; ?>">
      <span class="help-block"><?php echo $projectEndDate_err; ?></span>
    </div>







    <!----------------------------->

    <!-- Project Implementation-->

    <!----------------------------->

    <p><u>8. Please explain how you would like project results to be disseminated and made useful to the broader community. (check all that apply)</u></p>

<div>
 <div class="block">
   <span class="help-block"><?php echo $projectImplementation_err; ?></span>
      <label for="projectImplementation1">Conference/Forum paper or presentation</label>
      <input type="checkbox" name="projectImplementation1" id="projectImplementation1" value="Conference/Forum paper or presentation"  <?php if(in_array("Conference/Forum paper or presentation", $projectImplementationA)) echo 'checked = \'checked\''?>>
    </div>
 <div class="block">
      <label for="projectImplementation2">Manual</label>
      <input type="checkbox" name="projectImplementation2" id="projectImplementation2" value="Manual"  <?php if(in_array("Manual", $projectImplementationA)) echo 'checked = \'checked\''?>>
    </div>
 <div class="block">
      <label for="projectImplementation3">Report</label>
      <input type="checkbox" name="projectImplementation3" id="projectImplementation3" value="Report" <?php if(in_array("Report", $projectImplementationA)) echo 'checked = \'checked\''?>>
    </div>
 <div class="block">
      <label for="projectImplementation4">Workshop</label>
      <input type="checkbox" name="projectImplementation4" id="projectImplementation4" value="Workshop" <?php if(in_array("Workshop", $projectImplementationA)) echo 'checked = \'checked\''?>>
    </div>
 <div class="block">
      <label for="projectImplementation5">Presentation</label>
      <input type="checkbox" name="projectImplementation5" id="projectImplementation5" value="Presentation" <?php if(in_array("Presentation", $projectImplementationA)) echo 'checked = \'checked\''?>>
    </div>
 <div class="block">
      <label for="projectImplementation6">Academic Article</label>
      <input type="checkbox" name="projectImplementation6" id="projectImplementation6" value="Academic Article" <?php if(in_array("Academic Article", $projectImplementationA)) echo 'checked = \'checked\''?>>
    </div>
 <div class="block">
      <label for="otherProjectImplementation">Other:</label>
      <input type="text" name="otherProjectImplementation" id="projectImplementation7" value="" >
      <p class="note"><i>NOTE: Please note the researcher(s) will own the copyright for all work completed as part of his/her involvement,
        but the lead organization/group/employer may use all project outputs in whole or in part, as it sees fit as long as the
        researcher(s) is duly credited as the author. If work is completed collaboratively, copyright will be decided by all project participants</i></p>
 </div>
</div>








<!----------------------------->

<!-- Research Ethics-->

<!----------------------------->



<p><u>9. Research ethics</u></p>

<div>
  <label> a) Does the research involve human subjects? (e.g. surveys, interviews)</label>
  <div>
      <label for="q1Y">Yes:</label>
      <input type="radio" name="q1" id="q1Yes" value="Research invovles human subjects" <?php if($q1 == 'Research invovles human subjects') echo 'checked = \'checked\''?>>
      <label for="q1No">No:</label>
      <input type="radio" name="q1" id="q1No" value="Research does not invovle human subjects" <?php if($q1 == 'Research does not invovle human subjects') echo 'checked = \'checked\''?>>
      <p class="note"><i>NOTE:  If yes, the project may be required to submit an application for ethical review of the research.
         This process may take up to 4-6 weeks and will need to be taken into consideration when creating project timelines.</i></p>
         <span class="help-block"><?php echo $researchEthics_err1; ?></span>
  </div>
</div>




<div>
    <label> b)	If your project involves collecting human subject data (e.g. interview transcripts), would you like access to that “raw” data at the end of the project?  </label>

    <div>
      <label for="q2Y">Yes:</label>
      <input type="radio" name="q2" id="q2Yes" value="Yes, I want access to the raw data at the end of the project" <?php if($q2 == 'Yes, I want access to the raw data at the end of the project') echo 'checked = \'checked\''?> >
      <label for="q2No">No:</label>
      <input type="radio" name="q2" id="q2No" value="No, I dont want access to the raw data at the end of the project" <?php if($q2 == 'No, I dont want access to the raw data at the end of the project') echo 'checked = \'checked\''?>>
      <label for="q2IfYes">If yes, please explain:</label>
      <input type="text" name="q2IfYes" id="q2IfYes" value=""> <p id="re2"></p>
      <span class="help-block"><?php echo $researchEthics_err2; ?></span>
    </div>
</div>



<div>
    <label> c)	Does the lead organization/group/employer have policies about research ethics approval? </label>

    <div>
      <label for="q3Y">Yes:</label>
      <input type="radio" name="q3" id="q3Yes" value="Yes, lead had policies about research ethics approval." <?php if($q3 == 'Yes, lead had policies about research ethics approval.') echo 'checked = \'checked\''?> >
      <label for="q3No">No:</label>
      <input type="radio" name="q3" id="q3No" value="No policies about research ethics approval" <?php if($q3 == 'No policies about research ethics approval') echo 'checked = \'checked\''?> >
      <label for="q3IfYes">If yes, please explain:</label>
      <input type="text" name="q3IfYes" id="q3IfYes" value=""> <p id="re3"></p>
      <span class="help-block"><?php echo $researchEthics_err3; ?></span>
    </div>
</div>







<!----------------------------->

<!-- Screening Requirements-->

<!----------------------------->

<p><u>10. Screening and/or training</u></p>


<div>
    <label> a)  Do the students require any specific screening or training? (e.g. police checks, confidentiality agreements, CPR, WHMIS):</label>

    <div>
      <label for="screeningQ1Y">Yes:</label>
      <input type="radio" name="screeningQ1" id="screeningQ1Yes" value="Yes, the students require specific training." <?php if($screeningQ1 == 'Yes, the students require specific training.') echo 'checked = \'checked\''?>>
      <label for="screeningQ1No">No:</label>
      <input type="radio" name="screeningQ1" id="screeningQ1No" value="No, I dont want require specific tranining."  <?php if($screeningQ1 == 'No, I dont want require specific tranining.') echo 'checked = \'checked\''?>>
      <label for="screeningQ1IfYes">If yes, please explain:</label>
      <input type="text" name="screeningQ1IfYes" id="screeningQ1IfYes" value=""> <p id="screeningReqError"></p>
      <span class="help-block"><?php echo $screeningReq_err1; ?></span>
    </div>
</div>


<div>
    <label> b) Will the student(s) be conducting research on site, or working with valuable equipment?</label>

    <div>
      <label for="screeningQ2Y">Yes:</label>
      <input type="radio" name="screeningQ2" id="screeningQ2Yes" value="Yes, the students will be conducting research on site, or working with valuable equipment." <?php if($screeningQ2 == 'Yes, the students will be conducting research on site, or working with valuable equipment.') echo 'checked = \'checked\''?> >
      <label for="screeningQ2No">No:</label>
      <input type="radio" name="screeningQ2" id="screeningQ2No" value="No, the students wont be conducting research on site, or working with valuable equipment." <?php if($screeningQ2 == 'No, the students wont be conducting research on site, or working with valuable equipment.') echo 'checked = \'checked\''?>>
      <label for="screeningQ2IfYes">If yes, please attach proof of insurance.</label>
      <input type="text" name="screeningQ2IfYes" id="screeningQ2IfYes" value="">
      <span class="help-block"><?php echo $screeningReq_err2; ?></span>
    </div>
</div>








<!----------------------------->

<!-- Resources Needed-->

<!----------------------------->

<p><u>11. Adequate resourcing</u></p>


<div>
  <label for="resourcesNeeded">a)	What resources are needed and in place to support the research – financial or otherwise? </label>
  <input type="text" name="resourcesNeeded" id="createResourcesNeeded" value=""> <p id="resourcesNeededError"></p>
  <span class="help-block"><?php echo $resourcesNeeded_err; ?></span>
</div>



<!----------------------------->

<!-- Funding Needed-->

<!----------------------------->


<div>
  <label for="fundingNeeded">b)	Do you anticipate needing funding or other types of resources? If so, please explain (including any ideas on where resourcing may be obtained):</label>
  <input type="text" name="fundingNeeded" id="createFundingNeeded" value=""> <p id="fundingNeededError"></p>
  <p class="note"><i>	NOTE: All known and needed resources should be listed here
     (e.g. for project coordination, data collection and analysis, software, hardware, photocopying, office supplies, workspace,
      computer, phone, travel expenses, food and refreshments, training, etc.). </i></p>
      <span class="help-block"><?php echo $fundingNeeded_err; ?></span>
</div>




<!----------------------------->

<!-- Additional Notes-->

<!----------------------------->



<p><u>12. Please explain when project results will be disseminated and made useful to the broader community.</u>
   If there are special circumstances where results might not be made public, please explain:</p>


<div>
  <label for="additionalNotes"></label>
  <input type="text" name="additionalNotes" id="createAdditionalNotes" value=""> <p id="additionalNotesError"></p>
  <span class="help-block"><?php echo $additionalNotes_err; ?></span>
</div>





<!----------------------------->

<!-- Photo Link-->

<!----------------------------->

<p><u>13. Please submit a photo to help promote your project</u></p>

<div>
  <label for="photoLink"></label>
  <input type="file" name="photoLink" id="createPhotoLink" value=""> <p id="photoLinkError"></p>
</div>


    <div>
      <label for="additionalSkills">Additional Skills:</label>
      <input type="text" name="additionalSkills" id="createAdditionalSkills" value=""> <p id="additionalSkillsError"></p>
    </div>


    <input type="submit" id="submitbtn" name="submit" value="Submit Project">
    <br>
    <br>
</form>




<div>

<p class="whatsNext"> <strong>What Happends Next?</strong> </p>

<p class="next"><strong>1.	Review and preliminary matching:</strong> Email your proposal to rsisson@trentu.ca
    Proposals are reviewed according to the community-based research expected outcomes criteria*(please see below).
     We will strive to explore any preliminary matches with academic courses, faculty research and students across the university.</p>


<p class="next"><strong>2.	Student application review and first meeting (if applicable):</strong>
  If a student expresses interest in your project, or a faculty is interested in connecting your project to a course,
   TCRC staff will contact you to discuss the best way to initiate the project and set up a first meeting. </p>


<p class="note"> <i>NOTE: Your organization has the option to accept or decline students who express interest in your project if you do not feel they have the necessary background or skills.</i></p>

<p class="next"><strong>3.	Doing the research:</strong> Once everyone is on board, all parties will work together to complete a project agreement, insurance forms, budget, etc. so the research can begin!</p>



<p class="community-b"> <strong>Community-based research expected outcomes criteria:</strong> </p>


<ol>
<li>Thorough research is conducted.</li>
<li>Positive benefits to the social, cultural, environmental and/or economic health of the community are demonstrated.</li>
<li>Local partnerships are strengthened.</li>
<li>Students experience is transformative learning that is purposeful.</li>
</ol>

<p class="supprt">We Appreciate Your Support!</p>
<p class="toRaise">To raise awareness of the work we do, we ask project partners to publicly acknowledge
our support in print or in-person wherever possible.
</p>



<footer>
  <p>Trent Community Research Centre</p>
  <p>Trent University, 1600 West Bank Drive, Peterborough, ON K9L 0G2</p>
  <p>Ryan Sisson, Coordinator, Trent Community-Based Research, rsisson@trentu.ca 705.748.1093</p>
</footer>
</div>

</div>
</div>
</div>


  </body>
  </html>
