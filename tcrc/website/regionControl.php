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

$getRegion  = "";
$tableRegion = array();

$counter = 0;

$sql = "SELECT id, regionName FROM region";
$getRegion = mysqli_query($link,$sql);
$tableRegion[$counter] = "<option value = '0' selected>Select region</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getRegion)){
  $tableRegion[$counter] = "<option value='{$row['id']}'>{$row['regionName']}</option>";
  $counter++;
}


//=================POST=====================
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'add_region'){
    if($_POST['new_region'] == null){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "INSERT INTO region(regionName) VALUES (?)";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"s", $_POST['new_region']);
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
  } else if ($_POST['type'] == 'del_region'){
    if($_POST['remove_region'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "DELETE FROM region WHERE {$_POST['remove_region']} = id";
      $result = mysqli_query($link,$sql);
      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'edit_region'){
    if($_POST['new_region'] == null || $_POST['old_region'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "UPDATE region SET regionName = ? WHERE id = ?";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"si", $_POST['new_region'], $_POST['old_region']);
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

<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-region">
  Region Control
</button>

<!-- Modal -->
<div class="modal fade" id="modal-region" tabindex="-1" role="dialog" aria-labelledby="modallabel-region" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel-region">Add/Remove/Edit region</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info">
          <p>Add/Remove/Edit region entries in the database. Keep in mind: If you remove the entry, you will only remove it from the list of active regions. Old projects pertaining to that region will still be linked to that region. Please edit if the region has changed names.</p>
        </div>
        <div id="accordion-region">
          <div class="card">
            <div class="card-header" id="headingOne-region">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-region" aria-expanded="true" aria-controls="collapseOne-region">
                  Add region
                </button>
              </h5>
            </div>

            <div id="collapseOne-region" class="collapse show" aria-labelledby="headingOne-region" data-parent="#accordion-region">
              <div class="card-body">
                <form action="regionControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='add_region' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col'>
                      <div class='row'>
                        <label for='new_region'>Add new region:</label>
                      </div>
                      <div class='row'>
                        <input type="text" name="new_region" class="form-control">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add new region">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo-region">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo-region" aria-expanded="true" aria-controls="collapseTwo-region">
                  Edit region
                </button>
              </h5>
            </div>

            <div id="collapseTwo-region" class="collapse" aria-labelledby="collapseTwo-region" data-parent="#accordion-region">
              <div class="card-body">
                <form action="regionControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='edit_region' name='type' readonly hidden>
                  </div>
                  <div class="row">
                      <div class='col'>
                        <label for='old_region'>Select region:</label>
                      </div>
                      <div class='col'>
                        <select class='form-control' id='old_region' name='old_region'>
                            <?php
                            for($i = 0; $i < count($tableRegion);$i++){
                              echo $tableRegion[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_region'>Enter new name:</label>
                      </div>
                      <div class ='col'>
                        <input type='text' name='new_region'>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Edit region">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree-region">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree-region" aria-expanded="true" aria-controls="collapseThree-region">
                  Remove region
                </button>
              </h5>
            </div>

            <div id="collapseThree-region" class="collapse" aria-labelledby="headingThree-region" data-parent="#accordion-region">
              <div class="card-body">
                <form action="regionControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='del_region' name='type' readonly hidden>
                  </div>
                  <div class='col'>
                    <div class='row'>
                      <label for='remove_region'>Remove region:</label>
                    </div>
                    <div class='row'>
                      <select class='form-control' id='remove_region' name='remove_region'>
                        <?php
                        for($i = 0; $i < count($tableRegion);$i++){
                          echo $tableRegion[$i];
                        }?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Remove region">
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
