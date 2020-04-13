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

$getInstitution  = "";
$tableInstitution = array();

$counter = 0;

$sql = "SELECT id, name FROM institution";
$getInstitution = mysqli_query($link,$sql);
$tableInstitution[$counter] = "<option value = '0' selected>Select institution</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getInstitution)){
  $tableInstitution[$counter] = "<option value='{$row['id']}'>{$row['name']}</option>";
  $counter++;
}


//=================POST=====================
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'add_institution'){
    if($_POST['new_institution'] == null){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "INSERT INTO institution(name) VALUES (?)";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"s", $_POST['new_institution']);
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
  } else if ($_POST['type'] == 'del_institution'){
    if($_POST['remove_institution'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "DELETE FROM institution WHERE {$_POST['remove_institution']} = id";
      $result = mysqli_query($link,$sql);
      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'edit_institution'){
    if($_POST['new_institution'] == null || $_POST['old_institution'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "UPDATE institution SET name = ? WHERE id = ?";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"si", $_POST['new_institution'], $_POST['old_institution']);
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

<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-institution">
  Institution Control
</button>

<!-- Modal -->
<div class="modal fade" id="modal-institution" tabindex="-1" role="dialog" aria-labelledby="modallabel-institution" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel-institution">Add/Remove/Edit institution</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info">
          <p>Add/Remove/Edit institution entries in the database. Keep in mind: If you remove the entry, you will only remove it from the list of active institutions. Old projects pertaining to that institution will still be linked to that institution. Please edit if the institution has changed names.</p>
        </div>
        <div id="accordion-institution">
          <div class="card">
            <div class="card-header" id="headingOne-institution">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-institution" aria-expanded="true" aria-controls="collapseOne-institution">
                  Add institution
                </button>
              </h5>
            </div>

            <div id="collapseOne-institution" class="collapse show" aria-labelledby="headingOne-institution" data-parent="#accordion-institution">
              <div class="card-body">
                <form action="institutionControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='add_institution' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col'>
                      <div class='row'>
                        <label for='new_institution'>Add new institution:</label>
                      </div>
                      <div class='row'>
                        <input type="text" name="new_institution" class="form-control">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add new institution">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo-institution">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo-institution" aria-expanded="true" aria-controls="collapseTwo-institution">
                  Edit institution
                </button>
              </h5>
            </div>

            <div id="collapseTwo-institution" class="collapse" aria-labelledby="collapseTwo-institution" data-parent="#accordion-institution">
              <div class="card-body">
                <form action="institutionControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='edit_institution' name='type' readonly hidden>
                  </div>
                  <div class="row">
                      <div class='col'>
                        <label for='old_institution'>Select institution:</label>
                      </div>
                      <div class='col'>
                        <select class='form-control' id='old_institution' name='old_institution'>
                            <?php
                            for($i = 0; $i < count($tableInstitution);$i++){
                              echo $tableInstitution[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_institution'>Enter new name:</label>
                      </div>
                      <div class ='col'>
                        <input type='text' name='new_institution'>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Edit institution">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree-institution">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree-institution" aria-expanded="true" aria-controls="collapseThree-institution">
                  Remove institution
                </button>
              </h5>
            </div>

            <div id="collapseThree-institution" class="collapse" aria-labelledby="headingThree-institution" data-parent="#accordion-institution">
              <div class="card-body">
                <form action="institutionControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='del_institution' name='type' readonly hidden>
                  </div>
                  <div class='col'>
                    <div class='row'>
                      <label for='remove_institution'>Remove institution:</label>
                    </div>
                    <div class='row'>
                      <select class='form-control' id='remove_institution' name='remove_institution'>
                        <?php
                        for($i = 0; $i < count($tableInstitution);$i++){
                          echo $tableInstitution[$i];
                        }?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Remove institution">
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
