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
    </style>
  </head>
  <body>
  <div class="row" style="width:100%">
    <div class="col-md-2 shadow-sm" style="padding-right: 0px;">
      <br>
      <center><img src="assets/img/logo.png" alt="" style="width:150px"></center>
      <br>
        <div class="list-group" id="list-tab" role="tablist">
          <h2 class="side-title">Library Database</h2>
          <?php
          $id = $_REQUEST['id'];
          include "app/config/koneksi.php";
          $result = mysqli_query($mysqli, "SHOW TABLES FROM `axlk4822_library`");

          while ($row = mysqli_fetch_row($result)) {
            $data[] = $row[0];
            ?>
            <a class="side-item list-group-item list-group-item-action" id="<?php echo $row[0]; ?>-list" data-toggle="list" href="#<?php echo $row[0]; ?>" role="tab" aria-controls="about"><?php echo $row[0]; ?></a>
          <?php } ?>
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
                     <?php for ($i=0; $i < count($allField[$data]) ; $i++) { ?>
                       <td> <input class="form-control" type="text" name="<?php echo $field[$allField[$data][$i]]; ?>" value="<?php echo $field[$allField[$data][$i]]; ?>"></td>
                     <?php } ?>
                      <td>
                        <button type="button" class="btn btn-warning option-item" name="button"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger option-item" name="button"><i class="fa fa-trash"></i></button>
                      </td>
                   </tr>
                   <?php } ?>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="<?php echo $forId."1"; ?>" role="tabpanel" aria-labelledby="<?php echo $forId."1"; ?>-tab">
              <br>
              <div class="row">
              <form class="" action="index.php" method="post">
              <?php foreach ($allField[$data] as $fieldData) { ?>
                  <div class="col-3">
                    <?php echo $fieldData; ?>
                  </div>
                  <div class="col-9">
                    <input type="text" name="<?php echo $fieldDatal; ?>" class="form-control" value="">
                  </div>
              <?php } ?>
            </form>
            </div>
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
