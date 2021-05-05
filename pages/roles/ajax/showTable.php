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
      <td>Num</td>
      <td>Code</td>
      <td>Name</td>
      <td>รายละเอียด</td>
      <td>สถานะ</td>
      <td>Edit/Del</td>
    </tr>
  </thead>
  <tbody>
    <?php
      $str    = $_SESSION['member'][0]['user_id']==0?"":"AND role_id > 0";
      $sqls   = "SELECT * FROM t_role ORDER BY role_id DESC";

      $querys     = DbQuery($sqls,null);
      $json       = json_decode($querys, true);
      $errorInfo  = $json['errorInfo'];
      $dataCount  = $json['dataCount'];
      $rows       = $json['data'];

        foreach ($rows as $key => $value) {
    ?>
    <tr class="text-center">
      <td><?=$key+1;?></td>
      <td><?=$value['role_code'];?></td>
      <td><?=$value['role_name'];?></td>
      <td><?=$value['role_desc'];?></td>
      <td><?=$value['is_active']=='Y'?"ACTIVE":"NO ACTIVE";?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['role_id']?>')">Edit</button>
        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['role_id']?>')">Del</button>
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
