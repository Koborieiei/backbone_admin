<?php
session_start();
include('../../../inc/function/connect.php');
include('../../../inc/function/mainFunc.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$action = $_POST['value'];
$id = $_POST['id'];
$arr_role_list = array();

if($action == 'EDIT'){
  $btn = 'Update changes';

  $sql   = "SELECT * FROM t_user WHERE user_id = '$id'";

  $query      = DbQuery($sql,null);
  $json       = json_decode($query, true);
  $errorInfo  = $json['errorInfo'];
  $dataCount  = $json['dataCount'];
  $row        = $json['data'];

  $user_login   = $row[0]['user_login'];
  $user_name    = $row[0]['user_name'];
  $user_last    = $row[0]['user_last'];
  $user_email   = $row[0]['user_email'];
  $role_list    = $row[0]['role_list'];
  $user_password= $row[0]['user_password'];
  $note1        = $row[0]['note1'];
  $note2        = $row[0]['note2'];
  $is_active    = $row[0]['is_active'];
  $user_img     = isset($row[0]['user_img'])?$row[0]['user_img']:"";
  $branch_id      = $row[0]['branch_id'];
  $department_id = $row[0]['department_id'];
  if($role_list != ""){
      $arr_role_list = explode(",",$role_list);
  }

}
if($action == 'ADD'){
 $btn = 'Save changes';
}
?>
<input type="hidden" id="action" name="action" value="<?=$action?>">
<input type="hidden" name="user_id" value="<?=@$id?>">
<input type="hidden" name="branch_id" value="<?=@$branch_id?>">
<input type="hidden" name="department_id" value="<?=@$department_id?>">
<input type="hidden" name="user_img" value="<?=@$user_img?>">


<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>User Login</label>
        <input value="<?=@$user_login?>" name="user_login" type="text" class="form-control" placeholder="User Login" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>อีเมล์</label>
        <input value="<?=@$user_email?>" name="user_email" type="email" class="form-control" placeholder="Email" required>
      </div>
    </div>
    <?php if($action == 'ADD'){ ?>
    <div class="col-md-5">
      <div class="form-group">
        <label>Password</label>
        <input value="" name="user_password" id="pass1" type="text" class="form-control" placeholder="Password" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Confirm Password</label>
        <input value="" name="cfm_user_password" id="pass2" type="text" class="form-control" placeholder="Confirm Password" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Gen Pass</label>
        <button type="button" onclick="CreatePass()" class="btn btn-primary btn-flat btn-block">Gen Pass</button>
      </div>
    </div>
    <?php } ?>
    <div class="col-md-6">
      <div class="form-group">
        <label>Name</label>
        <input value="<?=@$user_name?>" name="user_name" type="text" class="form-control" placeholder="Name" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Last</label>
        <input value="<?=@$user_last?>" name="user_last" type="text" class="form-control" placeholder="Last" required>
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
    <div class="col-md-8">
      <div class="form-group">
        <label>รายละเอียด</label>
        <input value="<?=@$note1?>" name="note1" type="text" class="form-control" placeholder="รายละเอียด" >
      </div>
    </div>
    <div class="col-md-12">
      <label>Select Role</label>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <?php
          $str    = $_SESSION['member'][0]['user_id']==0?"":"WHERE role_id > 0";
          $sqlp   = "SELECT * FROM t_role $str ORDER BY role_id ASC";
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
              <input type="checkbox" name="role_list[]" value="<?=$value['role_id']?>"
              <?= @in_array($value['role_id'], @$arr_role_list)?"checked":"" ?> required>
              <?=$value['role_name']?>
            </label>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
</div>
