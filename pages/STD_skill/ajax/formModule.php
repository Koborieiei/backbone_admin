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

      $sql   = "SELECT * FROM tb_skill AS a LEFT JOIN  tb_skill_standard AS b ON a.hs_id = b.skill_id WHERE b.skill_id = '$id'";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true)['data'][0];
    
      $hs_name = $row['hs_name'];
      $standard = $row['standard'];


    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="skill_id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Skill name</label>
            <input value="<?=$hs_name?>"  type="text" class="form-control" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Standard(%)</label>
            <input value="<?=$standard?>" min="0" max="100" name="standard" type="number" class="form-control" >
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
  