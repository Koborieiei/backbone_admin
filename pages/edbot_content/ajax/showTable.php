<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

?>

<style media="screen">
  .owl-carousel{
    width: 200px;
  }

  .Copylink,.Copylink:focus{
    border: none;
    background: transparent;
    outline: none;
  }
</style>
<table class="table table-bordered table-striped" id="tableDisplay">
  <thead>
    <tr class="text-center">
      <td>No</td>
      <td>Img Thum</td>
      <td>Img BG</td>
      <td>Head Text</td>
      <td>Seq</td>
      <td>Status</td>
      <td>Link</td>
      <td>Edit/Del</td>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql   = "SELECT * FROM content ORDER BY cont_id DESC";
      $query = DbQuery($sql,null);
      $row   = json_decode($query, true);
        foreach ($row['data'] as $key => $value) {
          $link = "https://edbot.com/edbot/blog.php?cont_id=".$value['cont_id'];
    ?>
    <tr class="text-center">
      <td><?=$key+1;?></td>
      <td>
        <img width="100" src="../../../image/blog/<?=$value['cont_imgThum'];?>">
      </td>
      <td>
        <img width="100" src="../../../image/blog/<?=$value['cont_imgBG'];?>">
      </td>
      <td><?=$value['cont_head'];?></td>
      <td><?=$value['cont_seq'];?></td>
      <td><?=$value['is_active']=='Y'?"ACTIVE":"NO ACTIVE";?></td>
      <td>
        <input class="Copylink" id="Copylink" type="text" value="<?=$link?>" readonly>
      </td>
      <td>
        <button type="button" class="btn btn-info btn-sm btn-flat" onclick="copyLink()">Copy</button>
        <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$value['cont_id']?>')">Edit</button>
        <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['cont_id']?>')">Del</button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
