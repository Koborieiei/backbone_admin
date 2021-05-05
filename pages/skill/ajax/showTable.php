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
        <td>NO</td>
        <td>SKILL NAME</td>
        <td>SKILL DESC</td>
        <td>CREATE DATE</td>
        <td>UPDATE DATE</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql   = "SELECT * FROM tb_skill ORDER BY hs_id DESC";
        $query = DbQuery($sql,null);
        $row  = json_decode($query,true);
        if($row['dataCount'] > 0){
          foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['hs_name']?></td>
        <td><?=$value['hs_desc']?></td>
        <td><?=$value['date_create']?></td>
        <td><?=$value['date_update']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['hs_id']?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['hs_id']?>')">Del</button>
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
