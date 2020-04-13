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

$getStudentSkills  = "";
$tableStudentSkills = array();

$counter = 0;

$sql = "SELECT id, name FROM studentSkills";
$getStudentSkills = mysqli_query($link,$sql);
$tableStudentSkills[$counter] = "<option value = '0' selected>Select student skills</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getStudentSkills)){
  $tableStudentSkills[$counter] = "<option value='{$row['id']}'>{$row['name']}</option>";
  $counter++;
}


//=================POST=====================
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'add_student_skills'){
    if($_POST['new_student_skills'] == null){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "INSERT INTO studentSkills(name) VALUES (?)";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"s", $_POST['new_student_skills']);
        if(mysqli_stmt_execute($stmt)){
          //success
          header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
          echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
        }
      }
      else {
        echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
      }
    }
  } else if ($_POST['type'] == 'del_student_skills'){
    if($_POST['remove_student_skills'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "DELETE FROM studentSkills WHERE {$_POST['remove_student_skills']} = id";
      $result = mysqli_query($link,$sql);
      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'edit_student_skills'){
    if($_POST['new_student_skills'] == null || $_POST['old_student_skills'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "UPDATE studentSkills SET name = ? WHERE id = ?";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"si", $_POST['new_student_skills'], $_POST['old_student_skills']);
        if(mysqli_stmt_execute($stmt)){
          //success
          header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
          echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
        }
      }
      else {
        echo '<script type="text/javascript">alert("Database connection error");window.history.go(-1);</script>';
      }
    }
  }
}
//==============================POST END==============
?>

<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-student_skills">
  StudentSkills Control
</button>

<!-- Modal -->
<div class="modal fade" id="modal-student_skills" tabindex="-1" role="dialog" aria-labelledby="modallabel-student_skills" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel-student_skills">Add/Remove/Edit student skills</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info">
          <p>Add/Remove/Edit student skills entries in the database.</p>
        </div>
        <div id="accordion-student_skills">
          <div class="card">
            <div class="card-header" id="headingOne-student_skills">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-student_skills" aria-expanded="true" aria-controls="collapseOne-student_skills">
                  Add student skills
                </button>
              </h5>
            </div>

            <div id="collapseOne-student_skills" class="collapse show" aria-labelledby="headingOne-student_skills" data-parent="#accordion-student_skills">
              <div class="card-body">
                <form action="studentskillsControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='add_student_skills' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col'>
                      <div class='row'>
                        <label for='new_student_skills'>Add new student skills:</label>
                      </div>
                      <div class='row'>
                        <input type="text" name="new_student_skills" class="form-control">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add new student skills">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo-student_skills">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo-student_skills" aria-expanded="true" aria-controls="collapseTwo-student_skills">
                  Edit student skills
                </button>
              </h5>
            </div>

            <div id="collapseTwo-student_skills" class="collapse" aria-labelledby="collapseTwo-student_skills" data-parent="#accordion-student_skills">
              <div class="card-body">
                <form action="studentskillsControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='edit_student_skills' name='type' readonly hidden>
                  </div>
                  <div class="row">
                      <div class='col'>
                        <label for='old_student_skills'>Select student skills:</label>
                      </div>
                      <div class='col'>
                        <select class='form-control' id='old_student_skills' name='old_student_skills'>
                            <?php
                            for($i = 0; $i < count($tableStudentSkills);$i++){
                              echo $tableStudentSkills[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_student_skills'>Enter new name:</label>
                      </div>
                      <div class ='col'>
                        <input type='text' name='new_student_skills'>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Edit student skills">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree-student_skills">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree-student_skills" aria-expanded="true" aria-controls="collapseThree-student_skills">
                  Remove student skills
                </button>
              </h5>
            </div>

            <div id="collapseThree-student_skills" class="collapse" aria-labelledby="headingThree-student_skills" data-parent="#accordion-student_skills">
              <div class="card-body">
                <form action="studentskillsControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='del_student_skills' name='type' readonly hidden>
                  </div>
                  <div class='col'>
                    <div class='row'>
                      <label for='remove_student_skills'>Remove student skills:</label>
                    </div>
                    <div class='row'>
                      <select class='form-control' id='remove_student_skills' name='remove_student_skills'>
                        <?php
                        for($i = 0; $i < count($tableStudentSkills);$i++){
                          echo $tableStudentSkills[$i];
                        }?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Remove student skills">
                  </div>
                </form>
              </div>
            </div>
            <!-- Card -->
          </div>

          <!-- Accordeon -->
        </div>
      </div>
    </div>
  </div>
</div>
