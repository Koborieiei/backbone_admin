<?php
    session_start();
    include("../../../inc/function/connect.php");
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action = $_POST["value"];
    $id = $_POST["id"];

    if($action == "EDIT"){
      $btn = "Update changes";

      $sql = "SELECT * FROM asset_token WHERE ass_id = '$id'";
      $query = DbQuery($sql,null);
      $row = json_decode($query,true)['data'][0];

      $ass_id         = $row['ass_id'];
      $ass_username   = $row['ass_username'];
      $ass_password   = $row['ass_password'];
      $ass_token_uat  = $row['ass_token_uat'];
      $ass_token      = $row['ass_token'];
      $ass_type       = $row['ass_type'];
      $ass_name       = $row['ass_name'];
      $ass_last       = $row['ass_last'];
      $ass_email      = $row['ass_email'];
      $ass_tel        = $row['ass_tel'];
      $is_active      = $row['is_active'];


    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="ass_id" value="<?=@$ass_id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>username</label>
            <input value="<?=@$ass_username?>" name="ass_username" type="text" class="form-control" placeholder="username" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>password</label>
            <input value="<?=@$ass_password?>" name="ass_password" type="text" class="form-control" placeholder="password" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>name</label>
            <input value="<?=@$ass_name?>" name="ass_name" type="text" class="form-control" placeholder="name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>lastname</label>
            <input value="<?=@$ass_last?>" name="ass_last" type="text" class="form-control" placeholder="lastname" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>email</label>
            <input value="<?=@$ass_email?>" name="ass_email" type="email" class="form-control" placeholder="email" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>tel</label>
            <input value="<?=@$ass_tel?>" name="ass_tel" type="text" class="form-control" placeholder="tel" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>TOKEN UAT</label>
            <input value="<?=@$ass_token_uat?>" name="ass_token_uat" type="text" class="form-control" placeholder="TOKEN UAT" readonly>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>TOKEN PRODUCTION</label>
            <input value="<?=@$ass_token?>" name="ass_token" type="text" class="form-control" placeholder="TOKEN PRODUCTION" readonly>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>TYPE ACCESS</label>
            <select class="form-control" name="ass_type" required>
              <option value="1" <?=@$ass_type=='1'?"selected":""?>>UAT</option>
              <option value="2" <?=@$ass_type=='2'?"selected":""?>>UAT AND PRODUCTION</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>IS ACTIVE</label>
            <select class="form-control" name="is_active" required>
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
