<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

  $action = $_POST['value'];
  $id = $_POST['id'];
  $content_id = '';
  $content_select = 1;
  if($action == 'EDIT'){
    $btn = 'Update changes';

    $sql   = "SELECT * FROM tb_content WHERE content_id = '$id'";

    $query      = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $row        = $json['data'][0];

    $content_id       = $row['content_id'];
    $content_select   = $row['content_select'];
    $content_menu     = $row['content_menu'];
    $content_show     = $row['content_show'];
    $content_sqe      = $row['content_sqe'];
    $content_name1    = $row['content_name1'];
    $content_bg1      = $row['content_bg1'];
    $content_btn1     = $row['content_btn1'];
    $content_url1     = $row['content_url1'];
    $content_target1  = $row['content_target1'];
    $content_btn2     = $row['content_btn2'];
    $content_url2     = $row['content_url2'];
    $content_target2  = $row['content_target2'];
    $content_name2    = $row['content_name2'];
    $content_bg3      = $row['content_bg3'];
    $content_message  = $row['content_message'];
    $content_btn3     = $row['content_btn3'];
    $content_url3     = $row['content_url3'];
    $content_target3  = $row['content_target3'];
    $content_img      = $row['content_img'];

  }
  if($action == 'ADD'){
   $btn = 'Save changes';
  }
?>
<input type="hidden" name="action" value="<?=$action?>">
<input type="hidden" name="content_id" value="<?=@$id?>">
<div class="modal-body">
  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label>เลือกผลการแสดง</label>
        <select class="form-control content_select" name="content_select" onchange="showFeild(this.value,'<?=$id?>','<?=$action?>')" required>
          <option value="1" <?=@$content_select=='1'?"selected":""?>>แบบที่ 1</option>
          <option value="2" <?=@$content_select=='2'?"selected":""?>>แบบที่ 2</option>
        </select>
      </div>
    </div>

    <div class="col-md-5">
      <div class="form-group">
        <label>ชื่อเมนู</label>
        <input value="<?=@$content_menu?>" name="content_menu" type="text" class="form-control" placeholder="ชื่อเมนู" required>
      </div>
    </div>



    <div class="col-md-3">
      <div class="form-group">
        <label>ลำดับการแสดง</label>
        <input value="<?=@$content_sqe?>" name="content_sqe" type="number" class="form-control" placeholder="ลำดับการแสดง" required>
      </div>
    </div>

    <div id="showFeild"></div>

  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
</div>

<script type="text/javascript">
  showFeild(<?=$content_select?>,'<?=$id?>','<?=$action?>');
  function showFeild(content_select,id,action){
    $.post("ajax/showFeild.php",{content_select:content_select,action:action,id:id})
      .done(function( data ) {
        $('#showFeild').html(data);
    });
  }
</script>
