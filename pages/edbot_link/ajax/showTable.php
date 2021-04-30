<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>NAME</td>
        <td>LINK</td>
        <td>TARGET</td>
        <td>ACTIVE</td>
        <td>DATE CREATE</td>
        <td>DATE UPDATE</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM et_link WHERE is_active != 'D' ORDER BY etl_id DESC";
        $query = DbQuery($sql,null);
        $row = json_decode($query,true);
        if($row['dataCount']>0){
        foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['etl_name']?></td>
        <td><?=$value['etl_link']?></td>
        <td><?=$value['etl_target']?></td>
        <td><?=$value['is_active']?></td>
        <td><?=$value['date_create']?></td>
        <td><?=$value['date_update']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['etl_id']?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['etl_id']?>')">Del</button>
        </td>
      </tr>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
