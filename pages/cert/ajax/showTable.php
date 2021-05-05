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
        <td>TEST CERT</td>
        <td>LMS NAME</td>
        <td>CERT NAME</td>
        <td>COURSE ID</td>
        <td>DATE CREATE</td>
        <td>USER CREATE</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT tc.*, tl.tl_name , tu.user_login  FROM tb_certificate tc , tb_type_lms tl , t_user tu
        WHERE tc.tl_id = tl.tl_id AND tc.user_id = tu.user_id
        ORDER BY cert_id DESC";
        $query = DbQuery($sql,null);
        $row  = json_decode($query,true);
        if($row['dataCount'] > 0){
          foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td>
          <button type="button" class="btn btn-info btn-sm btn-flat" onclick="testCert('<?=$value['cert_id']?>')">GEN CERT</button></td>
        <td><?=$value['tl_name']?></td>
        <td><?=$value['cert_name']?></td>
        <td><?=$value['cert_course_id']?></td>
        <td><?=$value['date_create']?></td>
        <td><?=$value['user_login']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['cert_id']?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['cert_id']?>')">Del</button>
        </td>
      </tr>
      <?php }} ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
