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
        <td>CERT NO</td>
        <td>FNAME</td>
        <td>LNAME</td>
        <td>CERT NAME</td>
        <td>DATE CREATE</td>
        <td>DATE UPDATE</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM certificate_person ORDER BY date_create DESC";
        $query = DbQuery($sql,null);
        $row = json_decode($query,true);
        if($row['dataCount']>0){
        foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['cert_no']?></td>
        <td><?=$value['m_name']?></td>
        <td><?=$value['m_lname']?></td>
        <td><?=$value['cp_name']?></td>
        <td><?=$value['date_create']?></td>
        <td><?=empty($value['date_update'])?"-":$value['date_update']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['cp_id']?>')">Edit</button>
        </td>
      </tr>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable({
        responsive : true
      });
    })
  </script>
