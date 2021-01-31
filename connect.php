<?php
$dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "pawan";
 $db = "sample";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, $db);
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

?>