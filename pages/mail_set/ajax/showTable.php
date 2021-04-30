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
        <td>Mail Username</td>
        <td>Mail Password</td>
        <td>Mail Host</td>
        <td>Mail Port</td>
        <td>SMTPSecure</td>
        <td>Tool</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM mail_sent";
        $query = DbQuery($sql,null);
        $json = json_decode($query,true);
        if($json['dataCount'] > 0){
          foreach ($json['data'] as $key => $value) {
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['mail_Username']?></td>
        <td><?=$value['mail_Password']?></td>
        <td><?=$value['mail_host']?></td>
        <td><?=$value['mail_port']?></td>
        <td><?=$value['mail_SMTPSecure']?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['mail_id']?>')">Edit</button>
        </td>
      </tr>
      <?php } }?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
