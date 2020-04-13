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



$getFaculty = $getProject = $getDepartment = $getHost = $getStudent = $getSkills = $getTheme = "";
$tableFaculty = $tableProject = $tableDepartment = $tableHost = $tableStudent = $tableSkills = $tableTheme = array();


$counter = 0;

$sql = "SELECT id,firstName,lastName FROM faculty ORDER BY firstName ASC";
$getFaculty = mysqli_query($link,$sql);
$tableFaculty[$counter] = "<option value='0' selected>Select Faculty</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getFaculty)){
  $tableFaculty[$counter] = "<option value={$row['id']}>{$row['firstName']} {$row['lastName']}</option>";
  $counter++;
}


$counter = 0;
$sql = "SELECT id,departmentName FROM department ORDER BY departmentName ASC";
$getDepartment = mysqli_query($link,$sql);
$tableDepartment[$counter] = "<option value='0' selected>Select Department</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getDepartment)){
  $tableDepartment[$counter] = "<option value={$row['id']}>{$row['departmentName']}</option>";
  $counter++;
}

$counter = 0;
$sql = "SELECT id,projectNumber,projectTitle FROM project ORDER BY projectNumber DESC";
$getProject = mysqli_query($link,$sql);
$tableProject[$counter] = "<option value='0' selected>Select Project</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getProject)){
  $tableProject[$counter] = "<option value={$row['id']}>{$row['projectNumber']}-{$row['projectTitle']}</option>";
  $counter++;
}

$counter = 0;
$sql = "SELECT id,orgName FROM hostOrganization ORDER BY orgName ASC";
$getHost = mysqli_query($link,$sql);
$tableHost[$counter] = "<option value='0' selected>Select Host</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getHost)){
  $tableHost[$counter] = "<option value={$row['id']}>{$row['orgName']}</option>";
  $counter++;
}

$counter = 0;
$sql = "SELECT id,firstName,lastName FROM student ORDER BY firstName ASC";
$getStudent = mysqli_query($link,$sql);
$tableStudent[$counter] = "<option value='0' selected>Select Student</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getStudent)){
  $tableStudent[$counter] = "<option value={$row['id']}>{$row['firstName']} {$row['lastName']}</option>";
  $counter++;
}

$counter = 0;
$sql = "SELECT id,themeName FROM research_themes ORDER BY themeName ASC";
$getTheme = mysqli_query($link,$sql);
$tableTheme[$counter] = "<option value='0' selected>Select Theme</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getTheme)){
  $tableTheme[$counter] = "<option value={$row['id']}>{$row['themeName']}</option>";
  $counter++;
}

$counter = 0;
$sql = "SELECT id,name FROM studentSkills ORDER BY name ASC";
$getSkills = mysqli_query($link,$sql);
$tableSkills[$counter] = "<option value='0' selected>Select Skills</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getSkills)){
  $tableSkills[$counter] = "<option value={$row['id']}>{$row['name']}</option>";
  $counter++;
}
//-----------------------POST -------------------------
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'facultyDepartment'){
    if($_POST['faculty'] == '0' || $_POST['deparment'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "SELECT * FROM facultyDepartment WHERE {$_POST['faculty']} = facultyID AND {$_POST['department']} = departmentID";
      $result = mysqli_query($link,$sql);

      if(mysqli_num_rows($result) > 0){
        echo '<script type="text/javascript">alert("Link already exists. Moving you back.");window.history.go(-1);</script>';
      }else {
        $sql = "INSERT INTO facultyDepartment(facultyID,departmentID) VALUES (?,?)";
        if($stmt = mysqli_prepare($link,$sql)){
          mysqli_stmt_bind_param($stmt,"ii", $_POST['faculty'], $_POST['department']);
          if(mysqli_stmt_execute($stmt)){
            //success
            header("Location: " . $_SERVER["HTTP_REFERER"]);
          } else {
            echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
          }
        } else {echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';}
      }
    }
  } else if ($_POST['type'] == 'projectHost'){
      if($_POST['project'] == '0' || $_POST['host'] == '0'){
        echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
      } else {
        $sql = "SELECT * FROM projectHost WHERE {$_POST['project']} = projectID AND {$_POST['host']} = hostID";
        $result = mysqli_query($link,$sql);

        if(mysqli_num_rows($result) > 0){
          echo '<script type="text/javascript">alert("Link already exists. Moving you back.");window.history.go(-1);</script>';
        }else {
          $sql = "INSERT INTO projectHost(projectID,hostID) VALUES (?,?)";
          if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"ii", $_POST['project'], $_POST['host']);
            if(mysqli_stmt_execute($stmt)){
              //success
              header("Location: " . $_SERVER["HTTP_REFERER"]);
            } else {
              echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
            }
          } else {echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';}
        }
      }
  }else if ($_POST['type'] == 'projectTheme'){
      if($_POST['project'] == '0' || $_POST['theme'] == '0'){
        echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
      } else {
        $sql = "SELECT * FROM projectTheme WHERE {$_POST['project']} = projectID AND {$_POST['theme']} = researchThemeID";
        $result = mysqli_query($link,$sql);

        if(mysqli_num_rows($result) > 0){
          echo '<script type="text/javascript">alert("Link already exists. Moving you back.");window.history.go(-1);</script>';
        }else {
          $sql = "INSERT INTO projectTheme(projectID,researchThemeID) VALUES (?,?)";
          if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"ii", $_POST['project'], $_POST['theme']);
            if(mysqli_stmt_execute($stmt)){
              //success
              header("Location: " . $_SERVER["HTTP_REFERER"]);
            } else {
              echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
            }
          } else {echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';}
        }
      }
  }else if ($_POST['type'] == 'studentProject'){
      if($_POST['student'] == '0' || $_POST['project'] == '0'){
        echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
      } else {
        $sql = "SELECT * FROM studentProject WHERE {$_POST['student']} = studentID AND {$_POST['project']} = projectID";
        $result = mysqli_query($link,$sql);

        if(mysqli_num_rows($result) > 0){
          echo '<script type="text/javascript">alert("Link already exists. Moving you back.");window.history.go(-1);</script>';
        }else {
          $sql = "INSERT INTO studentProject(studentID,projectID) VALUES (?,?)";
          if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"ii", $_POST['student'], $_POST['project']);
            if(mysqli_stmt_execute($stmt)){
              //success
              header("Location: " . $_SERVER["HTTP_REFERER"]);
            } else {
              echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
            }
          } else {echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';}
        }
      }
  }else if ($_POST['type'] == 'studentSkills'){
      if($_POST['student'] == '0' || $_POST['skills'] == '0'){
        echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
      } else {
        $sql = "SELECT * FROM studentStudentSkills WHERE {$_POST['student']} = studentID AND {$_POST['skills']} = studentSkillsID";
        $result = mysqli_query($link,$sql);

        if(mysqli_num_rows($result) > 0){
          echo '<script type="text/javascript">alert("Link already exists. Moving you back.");window.history.go(-1);</script>';
        }else {
          $sql = "INSERT INTO studentStudentSkills(studentID,studentSkillsID) VALUES (?,?)";
          if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"ii", $_POST['student'], $_POST['skills']);
            if(mysqli_stmt_execute($stmt)){
              //success
              header("Location: " . $_SERVER["HTTP_REFERER"]);
            } else {
              echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
            }
          } else {echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';}
        }
      }
  }
}

?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addlink-modal">
  Create Link
</button>

<!-- Modal -->
<div class="modal fade" id="addlink-modal" tabindex="-1" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel">Add link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info">
          <p>Select the link type you wish to add, select the items you wish to link and hit submit. The link will be added and you are able to view the link on the profile of the specific item.</p>
        </div>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Faculty-Department
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <form action="addlink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='facultyDepartment' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col-5'>
                      <div class='row'>
                        <label for='faculty'>Select faculty:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='faculty' name='faculty'>
                            <?php for($i = 0; $i < count($tableFaculty);$i++){
                              echo $tableFaculty[$i];
                            }?>
                        </select>
                      </div>
                    </div>
                    <i class="col-2 fas fa-arrows-alt-h"></i>
                    <div class='col-5'>
                      <div class='row'>
                        <label for='department'>Select Department:</label>
                      </div>
                      <div class='row'>
                        <select id='department' class='form-control' name='department'>
                          <?php for($i = 0; $i < count($tableDepartment);$i++){
                            echo $tableDepartment[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add Faculty-Department Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Project-HostOrganization
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <form action="addlink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='projectHost' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col-5'>
                      <div class='row'>
                        <label for='project'>Select project:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='project' name='project'>
                          <?php for($i = 0; $i < count($tableProject);$i++){
                            echo $tableProject[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                    <i class="col-2 fas fa-arrows-alt-h"></i>
                    <div class='col-5'>
                      <div class='row'>
                        <label for='host'>Select Host:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='host' name='host'>
                          <?php for($i = 0; $i < count($tableHost);$i++){
                            echo $tableHost[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add Project-Host Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Project-ResearchTheme
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <form action="addlink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='projectTheme' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col-5'>
                      <div class='row'>
                        <label for='project'>Select project:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='project' name='project'>
                          <?php for($i = 0; $i < count($tableProject);$i++){
                            echo $tableProject[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                    <i class="col-2 fas fa-arrows-alt-h"></i>
                    <div class='col-5'>
                      <div class='row'>
                        <label for='theme'>Select Theme:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='theme' name='theme'>
                          <?php for($i = 0; $i < count($tableTheme);$i++){
                            echo $tableTheme[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add Project-Theme Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Student-Project
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <form action="addlink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='studentProject' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col-5'>
                      <div class='row'>
                        <label for='student'>Select student:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='student' name='student'>
                          <?php for($i = 0; $i < count($tableStudent);$i++){
                            echo $tableStudent[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                    <i class="col-2 fas fa-arrows-alt-h"></i>
                    <div class='col-5'>
                      <div class='row'>
                        <label for='project'>Select project:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control' id='project' name='project'>
                          <?php for($i = 0; $i < count($tableProject);$i++){
                            echo $tableProject[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add Student-Project Link">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFive">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  Student-StudentSkills
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
              <div class="card-body">
                <form action="addlink.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='studentSkills' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col-5'>
                      <div class='row'>
                        <label for='student'>Select student:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control'id='student' name='student'>
                          <?php for($i = 0; $i < count($tableStudent);$i++){
                            echo $tableStudent[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                    <i class="col-2 fas fa-arrows-alt-h"></i>
                    <div class='col-5'>
                      <div class='row'>
                        <label for='Skills'>Select skills:</label>
                      </div>
                      <div class='row'>
                        <select class='form-control'id='skills' name='skills'>
                          <?php for($i = 0; $i < count($tableSkills);$i++){
                            echo $tableSkills[$i];
                          }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add Student-StudentSkills Link">
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
