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
        <td>COL 1</td>
        <td>COL 2</td>
        <td>COL 3</td>
        <td>COL 4</td>
        <td>COL 5</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        for ($i=1; $i <= 10 ; $i++) {
      ?>
      <tr class="text-center">
        <td><?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$i?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$i?>')">Del</button>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
 