<?php
include "../config/koneksi.php";
$schema     = $_REQUEST['schema'];
$table      = $_REQUEST['table'];
$editField  = "";
$editValue  = "";
$fieldAll   = json_decode(base64_decode($_REQUEST['field']));
$fieldId    = $fieldAll[0];

foreach ($fieldAll as $field) {
  $editField .= $field.", ";
  $data[$field] = $_POST[$field];
}

foreach ($data as $value) {
  $editValue .= '"'.$value.'", ';
};

$fieldData = "(".substr($editField, 0,-2).")";
$valueData =  "(".substr($editValue, 0,-2).")";
$id   = $data[$fieldId];

$delete = mysqli_query($mysqli, "DELETE FROM `$table` WHERE `$table`.`$fieldId` = '$id'");
$insert = mysqli_query($mysqli, "INSERT INTO $table $fieldData VALUE $valueData");
?>

<script type="text/javascript">
window.setTimeout(function(){
  var url = "index.php?schema=<?php echo $schema; ?>";
   alert("Edit Success");window.location.href = url;
}, 1000);
</script>
