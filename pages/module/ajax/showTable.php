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
      <td>No</td>
      <td>Code</td>
      <td>Name</td>
      <td>ประเภทการแสดง</td>
      <td>ลำดับการแสดง</td>
      <td>สถานะ</td>
      <td>Edit/Del</td>
    </tr>
  </thead>
  <tbody>
    <?php
      // $str    = $_SESSION['member'][0]['user_id']==0?"":"WHERE module_id < 100000";
      $str    = '';
      $sqls   = "SELECT * FROM t_module $str ORDER BY module_id DESC";
      $querys = DbQuery($sqls,null);
      $row    = json_decode($querys, true);
      $rows   = $row['data'];
        foreach ($rows as $key => $value) {
    ?>
    <tr class="text-center">
      <td><?=$key+1;?></td>
      <td><?=$value['module_code'];?></td>
      <td><?=$value['module_name'];?></td>
      <td><?=$value['module_type']==1?"BACK OFFICE":"FONT END";?></td>
      <td><?=$value['module_order'];?></td>
      <td><?=$value['is_active']=='Y'?"ACTIVE":"NO ACTIVE";?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['module_id']?>')">Edit</button>
        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['module_id']?>')">Del</button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(function () {
    $('#tableDisplay').DataTable();
  })
</script>
