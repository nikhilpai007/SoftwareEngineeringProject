<?php

session_start();
require_once 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/accesscontrol.php';
if ($_SESSION["flag"] == 'B') {
  header("location: index.php");
}

if (isset($_POST["export-studentform"]))
{
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=StudentForm.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'First Name', 'Last Name', 'Student No', 'Email', 'Project of Interest #1', 'Project of Interest #2', 'Project of Interest #3'));
    $query = "SELECT id, fname, lname, studNumber, email, projectInterestID, projectInterestID_2, projectInterestID_3 FROM studentForm";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>
