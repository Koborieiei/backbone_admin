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
        <td>Skill Name</td>
        <td>Standard(100%)</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      <?php 
        $sql   = "SELECT * FROM tb_skill AS a LEFT JOIN  tb_skill_standard AS b ON a.hs_id = b.skill_id ORDER BY b.standard ASC ";
        $query = DbQuery($sql,null);
        $row  = json_decode($query,true);
        if($row['dataCount'] > 0){
          foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td> <?=$value['hs_name']?></td>
        <td><?=$value['standard']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['hs_id']?>')">Update</button>
        </td>
      </tr>
      <?php }
              } ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
 