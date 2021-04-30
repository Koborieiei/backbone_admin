<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay" width="100%">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>Name</td>
        <td>Shot Name</td>
        <td>Path</td>
        <td>URL</td>
        <td>DATE UPDATE</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql   = "SELECT * FROM tb_type_lms ORDER BY tl_id DESC";
        $query = DbQuery($sql,null);
        $row  = json_decode($query,true);
        if($row['dataCount'] > 0){
          foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['tl_name']?></td>
        <td><?=$value['tl_shot']?></td>
        <td><?=$value['tl_path']?></td>
        <td><?=$value['tl_url']?></td>
        <td><?=$value['date_update']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['tl_id']?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['tl_id']?>')">Del</button>
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
