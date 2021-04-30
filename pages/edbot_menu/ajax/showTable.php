<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

?>

<table class="table table-bordered table-striped" id="tableDisplay">
  <thead>
    <tr class="text-center">
      <td>NO.</td>
      <td>CONTENT TYPE</td>
      <td>MENU NAME</td>
      <td>SEQ</td>
      <td>DATE UPDATE</td>
      <td>Edit/Del</td>
    </tr>
  </thead>
  <tbody>
    <?php
      $sqls   = "SELECT * FROM tb_content ORDER BY content_id DESC";
      $querys     = DbQuery($sqls,null);
      $json       = json_decode($querys, true);
      $errorInfo  = $json['errorInfo'];
      $dataCount  = $json['dataCount'];
      $rows       = $json['data'];
      if($dataCount > 0){
        foreach ($rows as $key => $value) {
    ?>
    <tr class="text-center">
      <td><?=$key+1;?></td>
      <td><?=$value['content_select'];?></td>
      <td><?=$value['content_menu'];?></td>
      <td><?=$value['content_sqe'];?></td>
      <td><?=$value['date_update'];?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['content_id']?>')">Edit</button>
        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['content_id']?>')">Del</button>
      </td>
    </tr>
    <?php }} ?>
  </tbody>
</table>
<script>
  $(function () {
    $('#tableDisplay').DataTable();
  })
</script>
