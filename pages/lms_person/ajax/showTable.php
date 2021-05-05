<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay" style="width:100%;">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>M_ID</td>
        <td>FNAME</td>
        <td>LNAME</td>
        <td>EMAIL</td>
        <td>MOBILE</td>
        <td>COMPANY NAME</td>
        <td>DATE CREATE</td>
        <td>TOOL</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql   = "SELECT * FROM tb_member WHERE tl_id = '{$_GET['tl_id']}' ORDER BY m_id DESC";
        $query = DbQuery($sql,null);
        $row  = json_decode($query,true);
        if($row['dataCount'] > 0){
          foreach ($row['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['m_id'];?></td>
        <td><?=$value['m_fname'];?></td>
        <td><?=$value['m_lname'];?></td>
        <td><?=$value['m_email'];?></td>
        <td><?=$value['m_mobile'];?></td>
        <td><?=$value['m_com_name'];?></td>
        <td><?=$value['m_date_create'];?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showFormperson('EDIT','<?=$value['m_id']?>')">Edit</button>
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
