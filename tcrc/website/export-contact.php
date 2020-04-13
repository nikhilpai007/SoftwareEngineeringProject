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
if (isset($_POST["export-contact"]))
{
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=contact.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'Title', 'First Name', 'Last Name', 'Work Email', 'Work Phone', 'Work Location', 'Institution ID', 'Contact Type', 'TCRC mailing approval', 'ULinks mailing Approval', 'CLinks mailing Approval', 'Show as fellow', 'Fellow Type'));
    $query = "SELECT * FROM contact";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>
