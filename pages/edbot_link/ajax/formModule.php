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

      $sql = "SELECT * FROM et_link WHERE etl_id = '$id'";
      $query = DbQuery($sql,null);
      $row = json_decode($query,true)['data'][0];

      $etl_id         = $row['etl_id'];
      $etl_name       = $row['etl_name'];
      $etl_link       = $row['etl_link'];
      $etl_target     = $row['etl_target'];
      $is_active      = $row['is_active'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="etl_id" value="<?=@$etl_id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Name</label>
            <input value="<?=@$etl_name?>" name="etl_name" type="text" class="form-control" placeholder="Name" required>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>Link</label>
            <input value="<?=@$etl_link?>" name="etl_link" type="text" class="form-control" placeholder="Link" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>TARGET</label>
            <select class="form-control" name="etl_target">
              <option value="_parent" <?=@$etl_target=='_parent'?"selected":""?>>เปิดหน้าเดิม</option>
              <option value="_blank" <?=@$etl_target=='_blank'?"selected":""?>>ขึ้นหน้าใหม่</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
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
