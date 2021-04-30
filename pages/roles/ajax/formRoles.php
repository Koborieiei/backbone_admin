<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$action = $_POST['value'];
$id = $_POST['id'];
$page_icon    = 'fa fa-circle-o';
$role_access  = '';
$arr_page_list = array();
if($action == 'EDIT'){
  $btn = 'Update changes';

  $sql   = "SELECT * FROM t_role WHERE role_id = '$id' ORDER BY role_id DESC";

  $query      = DbQuery($sql,null);
  $json       = json_decode($query, true);
  $errorInfo  = $json['errorInfo'];
  $dataCount  = $json['dataCount'];
  $row        = $json['data'];

  $role_code    = $row[0]['role_code'];
  $role_name    = $row[0]['role_name'];
  $role_desc    = $row[0]['role_desc'];
  $page_list    = $row[0]['page_list'];
  $role_access  = $row[0]['role_access'];
  $is_active    = $row[0]['is_active'];

  if(!empty($page_list)){
      $arr_page_list = explode(",",$page_list);
  }

}
if($action == 'ADD'){
 $btn = 'Save changes';
}
?>
<input type="hidden" name="action" value="<?=$action?>">
<input type="hidden" name="role_access" value="ALL">
<input type="hidden" name="role_id" value="<?=@$id?>">
<div class="modal-body">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>Roles Code</label>
        <input value="<?=@$role_code?>" name="role_code" type="text" maxlength="6" class="form-control text-uppercase" placeholder="Code" required>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Roles Name</label>
        <input value="<?=@$role_name?>" name="role_name" type="text" class="form-control" placeholder="Name" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Status</label>
        <select name="is_active" class="form-control select2" style="width: 100%;" required>
          <option value="Y" <?=@$is_active=='Y'?"selected":""?>>ACTIVE</option>
          <option value="N" <?=@$is_active=='N'?"selected":""?>>NO ACTIVE</option>
        </select>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label>Roles DESC</label>
        <input value="<?=@$role_desc?>" name="role_desc" type="text" class="form-control" placeholder="" required>
      </div>
    </div>
    <!-- <div class="col-md-12">
      <label>Select Pages</label>
    </div> -->
    <?php
      $sqlm   = "SELECT * FROM t_module where is_active='Y'";

      $querym     = DbQuery($sqlm,null);
      $json       = json_decode($querym, true);
      $errorInfo  = $json['errorInfo'];
      $dataCount  = $json['dataCount'];
      $rowm       = $json['data'];

      foreach ($rowm as $valuem) {
        $module_name = $valuem['module_name'];
        $module_id   = $valuem['module_id'];
    ?>
    <div class="col-md-12">
      <label><?=$module_name?></label>
      <div class="form-group">
        <?php
          $sqlp   = "SELECT * FROM t_page WHERE module_id = '$module_id'";

          $queryp     = DbQuery($sqlp,null);
          $json       = json_decode($queryp, true);
          $errorInfo  = $json['errorInfo'];
          $dataCount  = $json['dataCount'];
          $rowp       = $json['data'];

          foreach ($rowp as $key => $value) {
        ?>
        <div class="col-md-6">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="pagelist[]" value="<?=$value['page_id']?>" <?php if (@in_array($value['page_id'], @$arr_page_list)){ echo 'checked'; } ?> required>
              <?=$value['page_name']?>
            </label>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
</div>
