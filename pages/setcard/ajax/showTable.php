  <?php
  session_start();
  include('../../../inc/function/connect.php');
  include('../../../inc/function/mainFunc.php');
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  $skill_id = @$_GET['skill_id'];

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>ชื่อไฟล์</td>
        <td>status</td>
        <td>Link URL</td>
        <td>Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $role_list= $_SESSION['member'][0]['role_list'];
        $user_id= $_SESSION['member'][0]['user_id'];
        $str    = $skill_id==null?"WHERE type = 3":"WHERE skill_id = '$skill_id' AND type = 2 ";
        $sqls   = "SELECT * FROM et_upload_files $str ORDER BY id DESC";
        $querys = DbQuery($sqls,null);

        $json   = json_decode($querys, true);
        $counts = $json['dataCount'];
        $rows   = $json['data'];

        if($counts > 0){
          foreach ($rows as $key => $value) {


            $url = str_replace("admin/pages/SetCoverpage/ajax/showTable.php","image/upload/","https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$value['f_url']);

      ?>
      <tr class="text-center">
        <td><?=$key+1;?></td>
        <td class="text-left"><?=$value['f_name'];?></td>
        <td class="text-center">
        <?php 
         if($value['is_active']==1){
          ?> <span class="label label-success" >active</span><?php

        }elseif( $value['is_active']==0){
          ?><span class="label label-danger" > unactive</span><?php
        }else {

          ?>  <span class="label label-secondary" >unknow</span><?php
         
        }?>
        </td>
        <td>
          <input type="text" class="none-input" value="<?=$url?>" id="url_<?=$value['id']?>" readonly>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="updateModule('<?=$value['id']?>')">SET</button>
          <a href="../../../image/upload/<?=$value['f_url'];?>" download class="btn btn-info btn-sm btn-flat"><span class="glyphicon glyphicon-save"></span></a>
          <button type="button" class="btn btn-success btn-sm btn-flat" onclick="CopyMessage('url_<?=$value['id']?>')">Copy</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['id']?>')">Del</button>
        </td>
      </tr>
      <?php } }?>
    </tbody>
  </table>
  <script>
    $(function () {
      $('#tableDisplay').DataTable();
    })
  </script>
