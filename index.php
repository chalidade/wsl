<?php
error_reporting(0);
include "app/config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lupi | Lumen Universal API</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style type="text/css" media="screen">
      .side-title {
        font-size:16px;
        font-weight: 700;
        padding-left:20px;
        padding-top:10px;
      }
      .side-item {
        border:none;
        border-radius: 0px;
        font-size:14px;
      }
      .option-item {
        padding: 5px;
        width: 30px;
        height: 34px;
        font-size: 15px;
        color: white;
      }
      .btn-submit {
      background: #f85351;
      color:#fff;
      float:right;
      width:100%;
      }
    </style>
  </head>
  <body>
    <?php
    if (!empty($_REQUEST['action'])) {
      if ($_REQUEST['action'] == 'delete') {
        include "app/helper/delete.php";
      }
    } ?>
  <div class="row" style="width:100%">
    <div class="col-md-2 shadow-sm" style="padding-right: 0px;">
      <br>
      <center><a href="index.php"><img src="assets/img/logo.png" alt="" style="width:150px"></a></center>
      <br>
        <div class="list-group" id="list-tab" role="tablist">
          <?php if (!empty($db)) { ?>
            <h2 class="side-title" style="text-transform:capitalize"><?php echo $db; ?> Database</h2>
          <?php } else { ?>
            <h2 class="side-title">Select Database</h2>
          <?php } ?>
          <?php
          if (!empty($db)) {
            $result = mysqli_query($mysqli, "SHOW TABLES FROM `$db`");
            while ($row = mysqli_fetch_row($result)) {
              $data[] = $row[0];
              ?>
              <a class="side-item list-group-item list-group-item-action" id="<?php echo $row[0]; ?>-list" data-toggle="list" href="#<?php echo $row[0]; ?>" role="tab" aria-controls="about"><?php echo $row[0]; ?></a>
            <?php }} else {
              $result = mysqli_query($mysqli,"SHOW DATABASES");
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <a class="side-item list-group-item list-group-item-action" href="?schema=<?php echo $row['Database']; ?>" role="tab" aria-controls="about"><?php echo $row['Database']; ?></a>
            <?php  }} ?>
      </div>
    </div>
    <div class="col-md-10">
      <div class="container" style="margin-top:20px;padding:20px;font-size:14px">
        <div class="tab-content" id="nav-tabContent">
      <?php foreach ($data as $data) {
        $forId = strtolower(str_replace("_", "",$data));
      ?>
          <div class="tab-pane fade" id="<?php echo $data; ?>" role="tabpanel" aria-labelledby="<?php echo $data; ?>-list">
            <h1><font style="color: #f85351;">#</font> <?php echo $data; ?></h1>
            <hr>
            <p>This is all data from table <?php echo $data ?> in Library Database</p>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="<?php echo $forId;?>-tab" data-toggle="tab" href="#<?php echo $forId;?>" role="tab" aria-controls="<?php echo $forId;?>" aria-selected="true">Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="<?php echo $forId."1"; ?>-tab" data-toggle="tab" href="#<?php echo $forId."1"; ?>" role="tab" aria-controls="<?php echo $forId."1"; ?>" aria-selected="false">Insert</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="<?php echo $forId;?>" role="tabpanel" aria-labelledby="<?php echo $forId;?>-tab">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                  <?php
                   $sql = mysqli_query($mysqli, "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$data' ORDER BY ORDINAL_POSITION");
                   while ($column = mysqli_fetch_row($sql)) {
                     $allField[$data][] = $column[0];
                     echo "<th>".$column[0]."</th>";
                   }
                   ?>
                   <th width="15%">Option</th>
                  </tr>
                  <?php
                  $no = 1;
                   $content = mysqli_query($mysqli, "SELECT * FROM $data");
                   while ($field = mysqli_fetch_array($content)) {
                   ?>
                   <tr>
                     <?php
                     for ($i=0; $i < count($allField[$data]) ; $i++) {
                       $dataInRow[] = $field[$allField[$data][$i]];
                        ?>
                       <td> <input class="form-control" type="text" name="<?php echo $field[$allField[$data][$i]]; ?>" value="<?php echo $field[$allField[$data][$i]]; ?>"></td>
                     <?php } ?>
                      <td>
                        <?php
                          $fieldTable = $allField[$data];
                          $dataTable  = $dataInRow;
                        ?>
                        <button type="button" class="btn btn-warning option-item" name="button"><i class="fa fa-edit"></i></button>
                        <a type="button" class="btn btn-danger option-item" name="button" href="?schema=<?php echo $db; ?>&action=delete&table=<?php echo $data; ?>&field=<?php echo $allField[$data][0]; ?>&id=<?php echo $field[$allField[$data][0]]; ?>"><i class="fa fa-trash"></i></a>
                      </td>
                   </tr>
                   <?php } ?>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="<?php echo $forId."1"; ?>" role="tabpanel" aria-labelledby="<?php echo $forId."1"; ?>-tab">
              <br>
              <form class="" action="index.php" method="post">
                <div class="container">
                <?php foreach ($allField[$data] as $fieldData) { ?>
                  <div class="row">
                    <div class="col-3">
                      <?php echo $fieldData; ?>
                    </div>
                    <div class="col-9">
                      <input type="text" name="<?php echo $fieldDatal; ?>" class="form-control" style="margin-bottom:5px" value="">
                    </div>
                  </div>
                <?php } ?>
                <div class="row">
                  <div class="col-12">
                  <input type="submit" class="btn btn-submit" name="" value="Save">
                  </div>
                </div>
            </div>
            </form>
            </div>
          </div>
          </div>
      <?php } ?>
    </div>
    </div>
  </div>
  </body>
  <script src="assets/js/jquery-3.4.1.slim.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</html>
