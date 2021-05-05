<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$action = $_POST['value'];
$id = $_POST['id'];

if($action == 'EDIT'){
  $btn = 'Update changes';

  $sqls   = "SELECT * FROM t_module tm , t_root tr WHERE tm.root_id = tr.root_id AND module_id = '$id'";

  $query      = DbQuery($sqls,null);
  $row        = json_decode($query, true);
  $rows       = $row['data'];


  $module_code = $rows[0]['module_code'];
  $module_name = $rows[0]['module_name'];
  $module_icon = $rows[0]['module_icon'];
  $module_type = $rows[0]['module_type'];
  $module_order = $rows[0]['module_order'];
  $is_active = $rows[0]['is_active'];
  $root_id = $rows[0]['root_id'];
}
if($action == 'ADD'){
 $btn = 'Save changes';
}
?>
<input type="hidden" name="action" value="<?=$action?>">
<input type="hidden" name="module_id" value="<?=@$id?>">
<div class="modal-body">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>Module Code</label>
        <input value="<?=@$module_code?>" name="module_code" type="text" maxlength="6" class="form-control text-uppercase" placeholder="Code" required>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Module Name</label>
        <input value="<?=@$module_name?>" name="module_name" type="text" class="form-control" placeholder="Name" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Module Icon</label>
        <input value="<?=@$module_icon?>" name="module_icon" type="text" class="form-control" placeholder="fa fa-angle-left" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Module Sequence</label>
        <input value="<?=@$module_order?>" name="module_order" type="number" maxlength="3" class="form-control" placeholder="Sequence" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Type</label>
        <select name="module_type" class="form-control select2" style="width: 100%;" required>
          <option value="1" <?=@$module_order==1?"selected":""?>>Black Office</option>
          <option value="2" <?=@$module_order==2?"selected":""?>>Front Office</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Root module</label>
        <select name="root_id" class="form-control select2" style="width: 100%;" required>
          <?php
            // $str    = $_SESSION['member'][0]['user_id']==0?"":"WHERE root_seq < 1000000";
            $str    = '';
            $sqlr   = "SELECT * FROM t_root $str";
            $queryr = DbQuery($sqlr,null);
            $row    = json_decode($queryr, true);
            $rowr   = $row['data'];

              foreach ($rowr as $value) {
          ?>
          <option value="<?=$value['root_id']?>" <?=$value['root_id']==@$root_id?"selected":""?>><?=$value['root_name']?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Status</label>
        <select name="is_active" class="form-control select2" style="width: 100%;" required>
          <option value="Y" <?=@$is_active=='Y'?"selected":""?>>ACTIVE</option>
          <option value="N" <?=@$is_active=='N'?"selected":""?>>NO ACTIVE</option>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
</div>
