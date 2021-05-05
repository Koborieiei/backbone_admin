<?php
session_start();
include "../../../inc/function/connect.php";
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
$skill_id = @$_GET['skill_id'];
?>

<table class="table table-bordered table-striped" id="tableDisplay">
  <thead>
    <tr class="text-center">
      <td>#</td>
      <td>Skill_id</td>
      <td>ลักษณะคำถาม</td>
      <td>คำถาม</td>
      <td>สลับคำตอบ</td>
      <td>การซ่อน</td>
      <td>เครื่องมือ</td>
    </tr>
  </thead>
  <tbody>
    <?php
    // Add soft delete query here 
    $isHasSkillId = $skill_id == null ? " WHERE deleted_at IS NULL" : "WHERE skill_id = '$skill_id' AND deleted_at IS NULL ";
    $sqlCommand = "SELECT * FROM et_question $isHasSkillId  ORDER BY id DESC";
    $querys = DbQuery($sqlCommand, null);

    $queryData = json_decode($querys, true);
    $counts = $queryData['dataCount'];
    $rows = $queryData['data'];

    if ($counts > 0) {
      foreach ($rows as $key => $value) {

    ?>
        <tr class="text-center">
          <td><?= $key + 1 ?></td>
          <td><?= $value['skill_id'] ?></td>
          <td><?= $value['q_type'] ?></td>
          <td><?= $value['q_text'] ?></td>
          <td>
            <?php
            if ($value['shuffle'] == 1) {
            ?> <span class="label label-success">เปิด</span><?php

                                                          } elseif ($value['shuffle'] == 0) {
                                                            ?><span class="label label-danger">ปิด</span><?php
                                                                                                        } else {

                                                                                                          ?> <span class="label label-secondary">unknow</span><?php

                                                                                                            } ?>
          </td>
          <td>
            <?php
            if ($value['hidden'] == 1) {
            ?> <span class="label label-success">เปิด</span><?php

                                                          } elseif ($value['hidden'] == 0) {
                                                            ?><span class="label label-danger">ปิด</span><?php
                                                                                                        } else {

                                                                                                          ?> <span class="label label-secondary">unknow</span><?php

                                                                                                            } ?>
          </td>
          <td>
            <!-- Change variable on skill_id -->
            <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('qmanage','EDIT','<?= $value['skill_id'] ?>','<?= $value['id'] ?>')">แก้ไข</button>
            <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?= $value['id'] ?>')">ลบ</button>
          </td>
        </tr>
    <?php }
    } ?>
  </tbody>
</table>
<script>
  $(function() {
    $("#tableDisplay").DataTable();
  })
</script>