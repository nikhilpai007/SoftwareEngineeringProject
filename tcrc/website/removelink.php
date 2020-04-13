<?php
session_start();
//----------------------------------
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';
require_once "config.php";

//-----------------REG ACCESS---------------



$getFacultyDepartment = $getProjectHost = $getProjectTheme = $getStudentProject = $getStudentStudentSkills = "";
$tableFacultyDepartment = $tableProjectHost = $tableProjectTheme = $tableStudentProject = $tableStudentStudentSkills = array();


$counter = 0;

$sql = "SELECT faculty.firstName,faculty.lastName, facultyDepartment.facultyID, facultyDepartment.departmentID, department.departmentName
        FROM ((facultyDepartment
            INNER JOIN faculty ON faculty.id = facultyDepartment.facultyID)
            INNER JOIN department ON department.id = facultyDepartment.departmentID) ORDER BY faculty.firstName ASC";

$getFacultyDepartment = mysqli_query($link,$sql);
$tableFacultyDepartment[$counter] = "<option value='0' selected>Select Faculty-Department Link</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getFacultyDepartment)){
  $tableFacultyDepartment[$counter] = "<option value='{$row['facultyID']}_{$row['departmentID']}'>#{$row['facultyID']}-{$row['firstName']} {$row['lastName']} <===> #{$row['departmentID']}-{$row['departmentName']}</option>";
  $counter++;
}

$counter = 0;

$sql = "SELECT project.projectTitle,projectHost.projectID, projectHost.hostID, hostOrganization.id, hostOrganization.orgName
        FROM ((projectHost
            INNER JOIN project ON project.id = projectHost.projectID)
            INNER JOIN hostOrganization ON hostOrganization.id = projectHost.hostID) ORDER BY projectHost.projectID DESC";

$getProjectHost = mysqli_query($link,$sql);
$tableProjectHost[$counter] = "<option value='0' selected>Select Project-Host Link</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getProjectHost)){
  $tableProjectHost[$counter] = "<option value='{$row['projectID']}_{$row['hostID']}'>#{$row['projectID']}-{$row['projectTitle']} <===> #{$row['hostID']}-{$row['orgName']}</option>";
  $counter++;
}
$counter = 0;

$sql = "SELECT project.projectTitle,projectTheme.projectID, projectTheme.researchThemeID, research_themes.id, research_themes.themeName
        FROM ((projectTheme
            INNER JOIN project ON project.id = projectTheme.projectID)
            INNER JOIN research_themes ON research_themes.id = projectTheme.researchThemeID) ORDER BY projectTheme.projectID DESC";

$getProjectTheme = mysqli_query($link,$sql);
$tableProjectTheme[$counter] = "<option value='0' selected>Select Project-Theme Link</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getProjectTheme)){
  $tableProjectTheme[$counter] = "<option value='{$row['projectID']}_{$row['researchThemeID']}'>#{$row['projectID']}-{$row['projectTitle']} <===> #{$row['researchThemeID']}-{$row['themeName']}</option>";
  $counter++;
}

$counter = 0;

$sql = "SELECT project.projectTitle,studentProject.projectID, studentProject.studentID, student.firstName, student.lastName
        FROM ((studentProject
            INNER JOIN project ON project.id = studentProject.projectID)
            INNER JOIN student ON student.id = studentProject.studentID) ORDER BY student.firstName ASC";

$getStudentProject = mysqli_query($link,$sql);
$tableStudentProject[$counter] = "<option value='0' selected>Select Student-Project Link</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getStudentProject)){
  $tableStudentProject[$counter] = "<option value='{$row['studentID']}_{$row['projectID']}'>#{$row['studentID']}-{$row['firstName']} {$row['lastName']} <===> #{$row['projectID']}-{$row['projectTitle']}</option>";
  $counter++;
}



$counter = 0;

$sql = "SELECT studentSkills.name,studentStudentSkills.studentSkillsID, studentStudentSkills.studentID, student.firstName, student.lastName
        FROM ((studentStudentSkills
            INNER JOIN studentSkills ON studentSkills.id = studentStudentSkills.studentSkillsID)
            INNER JOIN student ON student.id = studentStudentSkills.studentID) ORDER BY student.firstName ASC";

$getStudentStudentSkills = mysqli_query($link,$sql);
$tableStudentStudentSkills[$counter] = "<option value='0' selected>Select Student-StudentSkills Link</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getStudentStudentSkills)){
  $tableStudentStudentSkills[$counter] = "<option value='{$row['studentID']}_{$row['studentSkillsID']}'>#{$row['studentID']}-{$row['firstName']} {$row['lastName']} <===> #{$row['studentSkillsID']}-{$row['name']}</option>";
  $counter++;
}
//-----------------------POST -------------------------
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'facultyDepartment'){
    if($_POST['facultyDepartment'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $split = explode('_',$_POST['facultyDepartment']);
      $faculty = $split[0];
      $department = $split[1];
      $sql = "DELETE FROM facultyDepartment WHERE {$faculty} = facultyID AND {$department} = departmentID";
      $result = mysqli_query($link,$sql);
      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  } else if ($_POST['type'] == 'projectHost'){
    if($_POST['projectHost'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $split = explode('_',$_POST['projectHost']);
      $project = $split[0];
      $host = $split[1];
      $sql = "DELETE FROM projectHost WHERE {$project} = projectID AND {$host} = hostID";
      $result = mysqli_query($link,$sql);

      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'projectTheme'){
    if($_POST['projectTheme'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $split = explode('_',$_POST['projectTheme']);
      $project = $split[0];
      $theme = $split[1];
      $sql = "DELETE FROM projectTheme WHERE {$project} = projectID AND {$theme} = researchThemeID";
      $result = mysqli_query($link,$sql);

      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'studentProject'){
    if($_POST['studentProject'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $split = explode('_',$_POST['studentProject']);
      $student = $split[0];
      $project = $split[1];
      $sql = "DELETE FROM studentProject WHERE {$student} = studentID AND {$project} = projectID";
      $result = mysqli_query($link,$sql);

      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'studentSkills'){
    if($_POST['studentSkills'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $split = explode('_',$_POST['studentSkills']);
      $student = $split[0];
      $skills = $split[1];
      $sql = "DELETE FROM studentStudentSkills WHERE {$student} = studentID AND {$skills} = studentSkillsID";
      $result = mysqli_query($link,$sql);

      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }
}

?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#removelink-modal">
  Remove Link
</button>

<!-- Modal -->
<div class="modal fade" id="removelink-modal" tabindex="-1" role="dialog" aria-labelledby="removelink_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removelink_label">Remove link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info-remove">
          <p>Select the link type you wish to delete and hit delete.</p>
        </div>
        <div id="accordion-remove">
          <div class="card">
            <div class="card-header" id="headingOne-remove">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-remove" aria-expanded="true" aria-controls="collapseOne-remove">
                  Faculty-Department
                </button>
              </h5>
            </div>

            <div id="collapseOne-remove" class="collapse show" aria-labelledby="headingOne-remove" data-parent="#accordion-remove">
              <div class="card-body">
                <form action="removelink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='facultyDepartment' name='type' readonly hidden>
                  </div>
                  <div class='row'>
                    <select class='form-control' id='facultyDepartment' name='facultyDepartment'>
                      <?php for($i = 0; $i < count($tableFacultyDepartment);$i++){
                        echo $tableFacultyDepartment[$i];
                      }?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Delete Faculty-Department Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo-remove">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo-remove" aria-expanded="false" aria-controls="collapseTwo-remove">
                  Project-HostOrganization
                </button>
              </h5>
            </div>
            <div id="collapseTwo-remove" class="collapse" aria-labelledby="headingTwo-remove" data-parent="#accordion-remove">
              <div class="card-body">
                <form action="removelink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='projectHost' name='type' readonly hidden>
                  </div>
                  <div class='row'>
                    <select class='form-control'  name='projectHost'>
                      <?php for($i = 0; $i < count($tableProjectHost);$i++){
                        echo $tableProjectHost[$i];
                      }?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Delete Project-Host Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree-remove">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree-remove" aria-expanded="false" aria-controls="collapseThree-remove">
                  Project-ResearchTheme
                </button>
              </h5>
            </div>
            <div id="collapseThree-remove" class="collapse" aria-labelledby="headingThree-remove" data-parent="#accordion-remove">
              <div class="card-body">
                <form action="removelink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='projectTheme' name='type' readonly hidden>
                  </div>
                  <div class='row'>
                    <select class='form-control'  name='projectTheme'>
                      <?php for($i = 0; $i < count($tableProjectTheme);$i++){
                        echo $tableProjectTheme[$i];
                      }?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Delete Project-Theme Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour-remove">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour-remove" aria-expanded="false" aria-controls="collapseFour-remove">
                  Student-Project
                </button>
              </h5>
            </div>
            <div id="collapseFour-remove" class="collapse" aria-labelledby="headingFour-remove" data-parent="#accordion-remove">
              <div class="card-body">
                <form action="removelink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='studentProject' name='type' readonly hidden>
                  </div>
                  <div class='row'>
                    <select class='form-control'id='studentProject' name='studentProject'>
                      <?php for($i = 0; $i < count($tableStudentProject);$i++){
                        echo $tableStudentProject[$i];
                      }?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Delete Student-Project Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFive-remove">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive-remove" aria-expanded="false" aria-controls="collapseFive-remove">
                  Student-StudentSkills
                </button>
              </h5>
            </div>
            <div id="collapseFive-remove" class="collapse" aria-labelledby="headingFive-remove" data-parent="#accordion-remove">
              <div class="card-body">
                <form action="removelink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='studentSkills' name='type' readonly hidden>
                  </div>
                  <div class='row'>
                    <select class='form-control'id='studentSkills' name='studentSkills'>
                      <?php for($i = 0; $i < count($tableStudentStudentSkills);$i++){
                        echo $tableStudentStudentSkills[$i];
                      }?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Delete Student-Skills Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
