<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>
<div class="table-responsive">
  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>USERNAME</td>
        <td>NAME</td>
        <td>LNAME</td>
        <td>EMAIL</td>
        <td>TEL</td>
        <td>DATE CREATE</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM asset_token WHERE is_active != 'D' ORDER BY ass_id DESC";
        $query = DbQuery($sql,null);
        $row = json_decode($query,true);
        if($row['dataCount']>0){
        foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['ass_username']?></td>
        <td><?=$value['ass_name']?></td>
        <td><?=$value['ass_last']?></td>
        <td><?=$value['ass_email']?></td>
        <td><?=$value['ass_tel']?></td>
        <td><?=$value['date_create']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['ass_id']?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['ass_id']?>')">Del</button>
        </td>
      </tr>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</div>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
