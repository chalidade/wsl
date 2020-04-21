<?php
include "../config/koneksi.php";
$schema = $_REQUEST['schema'];
$table  = $_REQUEST['table'];
$editField = "";
$field  = json_decode(base64_decode($_REQUEST['field']));

foreach ($field as $field) {
  $editField .= $field.", ";
  $data[$field] = $_POST[$field];
}

echo $editField;

 ?>
