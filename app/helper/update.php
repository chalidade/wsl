<?php
include "../config/koneksi.php";
$schema     = $_REQUEST['schema'];
$table      = $_REQUEST['table'];
$editField  = "";
$editValue  = "";
$field      = json_decode(base64_decode($_REQUEST['field']));

foreach ($field as $field) {
  $editField .= $field.", ";
  $data[$field] = $_POST[$field];
}

foreach ($data as $data) {
  $editValue .= '"'.$data.'", ';
};

$field = "(".substr($editField, 0,-2).")";
echo "(".substr($editValue, 0,-2).")";
 ?>
