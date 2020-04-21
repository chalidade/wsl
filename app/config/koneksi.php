<?php
$host     = "localhost";
$username = "root";
$password = "";
if (empty($_REQUEST['schema'])) {
  $db     = "";
} else {
  $db     = $_REQUEST['schema'];
}

$mysqli = new mysqli($host,$username,$password,$db);
$myArray = array();
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
