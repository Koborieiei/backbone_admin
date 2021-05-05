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
      <td>User Login</td>
      <td>Name</td>
      <td>LastName</td>
      <td>สถานะ</td>
      <td>Re Password</td>
      <td>Edit/Del</td>
    </tr>
  </thead>
  <tbody>
    <?php
      $str    = $_SESSION['member'][0]['user_id']==0?"":" Where user_id > 0";
      //echo $str;
      $sqls   = "SELECT * FROM t_user $str ORDER BY user_id DESC";

      $querys     = DbQuery($sqls,null);
      $json       = json_decode($querys, true);
      $errorInfo  = $json['errorInfo'];
      $dataCount  = $json['dataCount'];
      $rows       = $json['data'];

        foreach ($rows as $key => $value) {
    ?>
    <tr class="text-center">
      <td><?=$key+1;?></td>
      <td><?=$value['user_login']?></td>
      <td align="left"><?=$value['user_name']?></td>
      <td align="left"><?=$value['user_last'];?></td>
      <td><?=$value['is_active']=='Y'?"ACTIVE":"NO ACTIVE";?></td>
      <td>
        <button type="button" class="btn btn-default btn-sm btn-flat" onclick="resetPass('<?=$value['user_id']?>')">Reset</button>
      </td>
      <td>
        <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['user_id']?>')">Edit</button>
        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['user_id']?>')">Del</button>
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
