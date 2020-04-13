<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';

require_once "config.php";

if(isset($_GET["id"]) && isset($_GET['value']) && isset($_GET['studentID'])){
  $requestedID = filter_var($_GET["id"],FILTER_SANITIZE_STRING);
  $requestedValue = filter_var($_GET['value'],FILTER_SANITIZE_STRING);
  $studentID = filter_var($_GET['studentID'],FILTER_SANITIZE_STRING);
  if($requestedValue == 'finish'){
    $status = 'completed';
    $requestedValue = '100%';
  }else{
    $status = 'in_progress';
    $requestedValue = $requestedValue.'%';
  }

  $sql = "UPDATE project SET status = ?, status_percentage = ? WHERE id = ?";

     if($stmt = mysqli_prepare($link,$sql)){
       mysqli_stmt_bind_param($stmt,"ssi",$status,$requestedValue,$requestedID);

       if(mysqli_stmt_execute($stmt)){
         header("location: studentIndex.php?id=".$studentID);
       } else {
         //if there are problems, display error
         echo "ERROR at execution. Check database connection";
       }
     }
} else {
  if(isset($_GET["id"]) && isset($_GET['value'])){
    $requestedID = filter_var($_GET["id"],FILTER_SANITIZE_STRING);
    $requestedValue = filter_var($_GET['value'],FILTER_SANITIZE_STRING);
    if($requestedValue == 'finish'){
      $status = 'completed';
      $requestedValue = '100%';
    }else{
      $status = 'in_progress';
      $requestedValue = $requestedValue.'%';
    }

    $sql = "UPDATE project SET status = ?, status_percentage = ? WHERE id = ?";

       if($stmt = mysqli_prepare($link,$sql)){
         mysqli_stmt_bind_param($stmt,"ssi",$status,$requestedValue,$requestedID);

         if(mysqli_stmt_execute($stmt)){
           header("location: index.php");
         } else {
           //if there are problems, display error
           echo "ERROR at execution. Check database connection";
         }
       }
  }
}




?>
