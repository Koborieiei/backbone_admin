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

      $sql   = "SELECT * FROM tb_company WHERE tc_id = '$id'";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true)['data'][0];

      $tl_name    = $row['tc_id'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>

    <style media="screen">
      input[type="file"]{
        display: block;
      }
    </style>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="tc_id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>ชื่อบริษัท</label>
            <input value="<?=@$tc_name?>" name="tc_name" type="text" class="form-control" placeholder="ชื่อบริษัท" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>อีเมล์</label>
            <input value="<?=@$tc_name?>" name="tc_email" type="email" class="form-control" placeholder="อีเมล์" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>เบอร์โทรศัพท์</label>
            <input value="<?=@$tc_tel?>" name="tc_tel" type="text" class="form-control" placeholder="เบอร์โทรศัพท์" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>ที่อยู่บริษัท</label>
            <textarea name="tc_address" class="form-control" rows="3" placeholder="ที่อยู่บริษัท" required><?=@$tc_address?></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>ข้อมูลอื่นๆ</label>
            <textarea name="tc_message" class="form-control" rows="3" placeholder="ข้อมูลอื่นๆ"><?=@$tc_message?></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>ไฟล์เอกสาร</label>
            <input type="file" name="tc_img" class="form-control">
            </div>
        </div>

      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
