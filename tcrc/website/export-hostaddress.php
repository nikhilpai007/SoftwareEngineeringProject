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
if (isset($_POST["export-hostaddress"]))
{
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=hostaddress.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('organizationID', 'address', 'addressAlt', 'city', 'province', 'phone1', 'phone2', 'fax', 'email1', 'email2', 'website'));
    $query = "SELECT * FROM hostAddress";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>
