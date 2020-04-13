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
$counter = 0;
$getResearchTheme  = $getParent ="";
$tableResearchTheme = $tableParent = array();

$sql = "SELECT id, themeName,parentID FROM research_themes";
$getParent = mysqli_query($link,$sql);
$counter++;
while ($row = mysqli_fetch_assoc($getParent)){
  if($row['parentID'] == 0)
    $tableParent[$counter] = $row['themeName'];
  $counter++;
}

$counter = 0;

$sql = "SELECT id, themeName,parentID FROM research_themes";
$getResearchTheme = mysqli_query($link,$sql);
$tableResearchTheme[$counter] = "<option value = '0' selected>Select research-theme</option>";
$counter++;
while ($row = mysqli_fetch_assoc($getResearchTheme)){
  if($row['parentID'] == 0)
    $tableResearchTheme[$counter] = "<option value='{$row['id']}'> {$row['themeName']}</option>";
  else
    $tableResearchTheme[$counter] = "<option value='{$row['id']}'> {$tableParent[$row['parentID']]} > {$row['themeName']}</option>";
  $counter++;
}


//=================POST=====================
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['type'] == 'add_research_theme'){
    if($_POST['new_research_theme'] == null){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "INSERT INTO research_themes(themeName,parentID) VALUES (?,?)";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"si", $_POST['new_research_theme'], $_POST['add_parentTheme']);
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
  } else if ($_POST['type'] == 'del_research_theme'){
    if($_POST['remove_research_theme'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "DELETE FROM research_themes WHERE {$_POST['remove_research_theme']} = id";
      $result = mysqli_query($link,$sql);
      if($result){
        //success
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }else {
        echo '<script type="text/javascript">alert("Database error.");window.history.go(-1);</script>';
      }
    }
  }else if ($_POST['type'] == 'edit_research_theme'){
    if($_POST['new_research_theme'] == null || $_POST['old_research_theme'] == '0'){
      echo '<script type="text/javascript">alert("Incorrect selection. Moving you back.");window.history.go(-1);</script>';
    } else {
      $sql = "UPDATE research_themes SET themeName = ?,parentID = ? WHERE id = ?";
      if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"sii", $_POST['new_research_theme'],$_POST['add_parentTheme'], $_POST['old_research_theme']);
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

<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-research_theme">
  Research Theme Control
</button>

<!-- Modal -->
<div class="modal fade" id="modal-research_theme" tabindex="-1" role="dialog" aria-labelledby="modallabel-research_theme" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel-research_theme">Add/Remove/Edit research-theme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="info">
          <p>Add/Remove/Edit research-theme entries in the database.</p>
        </div>
        <div id="accordion-research_theme">
          <div class="card">
            <div class="card-header" id="headingOne-research_theme">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-research_theme" aria-expanded="true" aria-controls="collapseOne-research_theme">
                  Add research-theme
                </button>
              </h5>
            </div>

            <div id="collapseOne-research_theme" class="collapse show" aria-labelledby="headingOne-research_theme" data-parent="#accordion-research_theme">
              <div class="card-body">
                <form action="researchThemeControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='add_research_theme' name='type' readonly hidden>
                  </div>
                  <div class="row">
                    <div class='col'>
                      <div class='row'>
                        <label for='new_research_theme'>Add new research-theme:</label>
                      </div>
                      <div class='row'>
                        <input type="text" name="new_research_theme" class="form-control">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_institution'>Select new parent theme:</label>
                      </div>
                      <div class ='col'>
                        <select class='form-control' id='add_parentTheme' name='add_parentTheme'>
                            <?php
                            echo "<option value = '0' selected>No parent</option>";
                            for($i = 0; $i < count($tableResearchTheme);$i++){
                              if($tableParent[$i] != null){
                                echo "<option value = '{$i}'>$tableParent[$i]</option>";
                              }
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add new research-theme">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo-research_theme">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo-research_theme" aria-expanded="true" aria-controls="collapseTwo-research_theme">
                  Edit research-theme
                </button>
              </h5>
            </div>

            <div id="collapseTwo-research_theme" class="collapse" aria-labelledby="collapseTwo-research_theme" data-parent="#accordion-research_theme">
              <div class="card-body">
                <form action="researchThemeControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='edit_research_theme' name='type' readonly hidden>
                  </div>
                  <div class="row">
                      <div class='col'>
                        <label for='old_research_theme'>Select research-theme:</label>
                      </div>
                      <div class='col'>
                        <select class='form-control' id='old_research_theme' name='old_research_theme'>
                            <?php
                            for($i = 0; $i < count($tableResearchTheme);$i++){
                              echo $tableResearchTheme[$i];
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_research_theme'>Enter new name:</label>
                      </div>
                      <div class ='col'>
                        <input type='text' name='new_research_theme'>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col">
                        <label for='new_institution'>Select new parent theme:</label>
                      </div>
                      <div class ='col'>
                        <select class='form-control' id='add_parentTheme' name='add_parentTheme'>
                            <?php
                            echo "<option value = '0' selected>No parent</option>";
                            for($i = 0; $i < count($tableResearchTheme);$i++){
                              if($tableParent[$i] != null){
                                echo "<option value = '{$i}'>$tableParent[$i]</option>";
                              }
                            }?>
                        </select>
                      </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Edit research-theme">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree-research_theme">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree-research_theme" aria-expanded="true" aria-controls="collapseThree-research_theme">
                  Remove research-theme
                </button>
              </h5>
            </div>

            <div id="collapseThree-research_theme" class="collapse" aria-labelledby="headingThree-research_theme" data-parent="#accordion-research_theme">
              <div class="card-body">
                <form action="researchThemeControl.php" method="post">
                  <div class='d-none'>
                    <input type='text' value='del_research_theme' name='type' readonly hidden>
                  </div>
                  <div class='col'>
                    <div class='row'>
                      <label for='remove_research_theme'>Remove research-theme:</label>
                    </div>
                    <div class='row'>
                      <select class='form-control' id='remove_research_theme' name='remove_research_theme'>
                        <?php
                        for($i = 0; $i < count($tableResearchTheme);$i++){
                          echo $tableResearchTheme[$i];
                        }?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Remove research-theme">
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
