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

      $sql   = "SELECT * FROM tb_skill WHERE hs_id = '$id'";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true)['data'][0];

      $hs_name = $row['hs_name'];
      $hs_desc = $row['hs_desc'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="hs_id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>SKILL NAME</label>
            <input value="<?=@$hs_name?>" name="hs_name" type="text" class="form-control" placeholder="SKILL NAME" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>SKILL DESC</label>
            <textarea name="hs_desc" rows="3" class="form-control" placeholder="SKILL DESC" required><?=@$hs_desc?></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
