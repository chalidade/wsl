<?php

$host     = "localhost";
$username = "axlk4822_library";
$password = "Siapanamaanda";
$db       = "axlk4822_library";

$mysqli = new mysqli($host,$username,$password,$db);
$myArray = array();
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
