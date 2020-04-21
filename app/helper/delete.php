<?php
  include "../config/koneksi.php";
  $id     = $_REQUEST['id'];
  $schema = $_REQUEST['schema'];
  $table  = $_REQUEST['table'];
  $field  = $_REQUEST['field'];

  $delete = mysqli_query($mysqli, "DELETE FROM `$table` WHERE `$table`.`$field` = '$id'");

 ?>
<script type="text/javascript">
window.setTimeout(function(){
  var url = "index.php?schema=<?php echo $schema; ?>";
   alert("Delete Success");window.location.href = url;
}, 1000);
</script>
