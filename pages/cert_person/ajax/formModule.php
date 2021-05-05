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

      $sql = "SELECT * FROM certificate_person WHERE cp_id = '$id'";
      $query = DbQuery($sql,null);
      $row = json_decode($query,true)['data'][0];

      $m_name    = $row['m_name'];
      $m_lname   = $row['m_lname'];
      $is_active = $row['is_active'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="cp_id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>IS ACTIVE</label>
            <select class="form-control" name="is_active">
              <option value="Y" <?=@$is_active=="Y"?"selected":""?>>ACTIVE</option>
              <option value="N" <?=@$is_active=="N"?"selected":""?>>NO ACTIVE</option>
            </select>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group">
            <label>FNAME</label>
            <input value="<?=@$m_name?>" name="m_name" type="text" class="form-control" placeholder="" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>LNAME</label>
            <input value="<?=@$m_lname?>" name="m_lname" type="text" class="form-control" placeholder="" required>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
