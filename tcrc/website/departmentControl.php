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

$getDept  = $getDeptInstitution = "";
$tableDept=  $tableDeptInstitution = array();

$counter = 0;

$sql = "SELECT name FROM institution";
$getDeptInstitution = mysqli_query($link,$sql);
$tableDeptInstitution[$counter] = "<option value = '0' selected>Select Institution</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getDeptInstitution)){
  $tableDeptInstitution[$counter] = "<option value='{$row['name']}'>{$row['name']}</option>";
  $counter++;
}

$counter = 0;

$sql = "SELECT id, departmentName,institutionName FROM department";

$getDept = mysqli_query($link,$sql);
$tableDept[$counter] = "<option value='0' selected>Select Department</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getDept)){
  $tableDept[$counter] = "<option value='{$row['id']}'>{$row['institutionName']} > {$row['departmentName']}</option>";
  $counter++;
}

$counter = 0;

//=================POST=====================
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'add_department'){
    if($_POST['new_department'] == null || $_POST['add_institution'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "INSERT INTO department(departmentName,institutionName) VALUES (?,?)";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"ss", $_POST['new_department'], $_POST['add_institution']);
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
  } else if ($_POST['type'] == 'del_department'){
    if($_POST['remove_department'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "DELETE FROM department WHERE {$_POST['remove_department']} = id";
      $result = mysqli_query($link,$sql);
      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'edit_department'){
    if($_POST['new_department'] == null || $_POST['old_department'] == '0' || $_POST['new_institution'] == '0' ){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "UPDATE department SET departmentName = ?, institutionName = ? WHERE id = ?";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"ssi", $_POST['new_department'], $_POST['new_institution'], $_POST['old_department']);
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

<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-dept">
  Department Control
</button>

<!-- Modal -->
<div class="modal fade" id="modal-dept" tabindex="-1" role="dialog" aria-labelledby="modallabel-dept" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel-dept">Add/Remove/Edit Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info">
          <p>Add/Remove/Edit department entries in the database. Keep in mind: If you remove the entry, you will only remove it from the list of active departments. Old projects pertaining to that department will still be linked to that department. Please edit if the department has changed names.</p>
        </div>
        <div id="accordion-dept">
          <div class="card">
            <div class="card-header" id="headingOne-dept">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-dept" aria-expanded="true" aria-controls="collapseOne-dept">
                  Add Department
                </button>
              </h5>
            </div>

            <div id="collapseOne-dept" class="collapse show" aria-labelledby="headingOne-dept" data-parent="#accordion-dept">
              <div class="card-body">
                <form action="departmentControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='add_department' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col'>
                      <div class='row'>
                        <label for='new_department'>Add new department:</label>
                      </div>
                      <div class='row'>
                        <input type="text" name="new_department" class="form-control">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_institution'>Connect institution:</label>
                      </div>
                      <div class ='col'>
                        <select class='form-control' id='add_institution' name='add_institution'>
                            <?php
                            for($i = 0; $i < count($tableDeptInstitution);$i++){
                              echo $tableDeptInstitution[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add new Department">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo-dept">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo-dept" aria-expanded="true" aria-controls="collapseTwo-dept">
                  Edit Department
                </button>
              </h5>
            </div>

            <div id="collapseTwo-dept" class="collapse" aria-labelledby="collapseTwo-dept" data-parent="#accordion-dept">
              <div class="card-body">
                <form action="departmentControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='edit_department' name='type' readonly hidden>
                  </div>
                  <div class="row">
                      <div class='col'>
                        <label for='old_department'>Select department:</label>
                      </div>
                      <div class='col'>
                        <select class='form-control' id='old_department' name='old_department'>
                            <?php
                            for($i = 0; $i < count($tableDept);$i++){
                              echo $tableDept[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_department'>Enter new name:</label>
                      </div>
                      <div class ='col'>
                        <input type='text' name='new_department'>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_institution'>Select new institution:</label>
                      </div>
                      <div class ='col'>
                        <select class='form-control' id='new_institution' name='new_institution'>
                            <?php
                            for($i = 0; $i < count($tableDeptInstitution);$i++){
                              echo $tableDeptInstitution[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Edit Department">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree-dept">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree-dept" aria-expanded="true" aria-controls="collapseThree-dept">
                  Remove Department
                </button>
              </h5>
            </div>

            <div id="collapseThree-dept" class="collapse" aria-labelledby="headingThree-dept" data-parent="#accordion-dept">
              <div class="card-body">
                <form action="departmentControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='del_department' name='type' readonly hidden>
                  </div>
                  <div class='col'>
                    <div class='row'>
                      <label for='remove_department'>Remove department:</label>
                    </div>
                    <div class='row'>
                      <select class='form-control' id='remove_department' name='remove_department'>
                        <?php
                        for($i = 0; $i < count($tableDept);$i++){
                          echo $tableDept[$i];
                        }?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Remove Department">
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
