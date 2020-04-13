<?php
/* Database credentials. running MySQL*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'apollosoftware');
define('DB_PASSWORD', 'cois4000Y');
define('DB_NAME', 'apollosoftware');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
