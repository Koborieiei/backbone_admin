<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$action = $_POST['value'];
$id = $_POST['id'];
$page_icon    = 'fa fa-circle-o';
$countNum = 1;
if($action == 'EDIT'){
  $btn = 'Update changes';


  $sql   = "SELECT * FROM t_page WHERE page_id = '$id' ORDER BY page_id DESC";
  $query = DbQuery($sql,null);
  $json   = json_decode($query, true);
  $counts = $json['dataCount'];
  $row    = $json['data'];

  $page_code    = $row[0]['page_code'];
  $page_name    = $row[0]['page_name'];
  $page_icon    = $row[0]['page_icon'];
  $page_path    = $row[0]['page_path'];
  $module_id    = $row[0]['module_id'];
  $page_seq     = $row[0]['page_seq'];
  $is_active    = $row[0]['is_active'];

  $sqlc   = "SELECT COUNT(page_id) AS countNum FROM t_page WHERE module_id = '$module_id'";
  $queryc = DbQuery($sqlc,null);
  $json   = json_decode($queryc, true);
  $rowc   = $json['data'];

  $countNum  = $rowc[0]['countNum'];

}
if($action == 'ADD'){
 $btn = 'Save changes';
}
?>
<input type="hidden" name="action" value="<?=$action?>">
<input type="hidden" name="page_id" value="<?=@$id?>">
<div class="modal-body">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>Page Code</label>
        <input value="<?=@$page_code?>" name="page_code" type="text" maxlength="6" class="form-control text-uppercase" placeholder="Code" required>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Page Name</label>
        <input value="<?=@$page_name?>" name="page_name" type="text" class="form-control" placeholder="Name" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Page Icon</label>
        <input value="<?=@$page_icon?>" name="page_icon" type="text" class="form-control" placeholder="fa fa-angle-left" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Page Sequence</label>
        <input value="<?=@$page_seq?>" name="page_seq" type="number" max="<?=$countNum?>" min="1" class="form-control" placeholder="Sequence" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Page Path</label>
        <input value="<?=@$page_path?>" name="page_path" type="text" class="form-control" placeholder="Page Path" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Page Module</label>
        <select name="module_id" class="form-control select2" style="width: 100%;" required>
          <?php
            // $str    = $_SESSION['member'][0]['user_id']==0?"":"WHERE module_id < 100000";
            $str    = '';
            $sqlr   = "SELECT * FROM t_module $str where is_active = 'Y'";
            $queryr = DbQuery($sqlr,null);
            $json   = json_decode($queryr, true);
            $rowr   = $json['data'];

            foreach ($rowr as $value) {
          ?>
          <option value="<?=$value['module_id']?>" <?=$value['module_id']==@$module_id?"selected":""?>><?="({$value['module_code']}) {$value['module_name']}"?></option>
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
