<?php
    session_start();
    include("../../../inc/function/connect.php");
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action = $_POST["value"];
    $id = $_POST["id"];
    $required = 'required';
    if($action == "EDIT"){
      $btn = "Update changes";
      $required = '';
      $sql   = "SELECT * FROM tb_type_lms WHERE tl_id = '$id'";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true)['data'][0];

      $tl_name    = $row['tl_name'];
      $tl_shot    = $row['tl_shot'];
      $tl_path    = $row['tl_path'];
      $tl_url     = $row['tl_url'];
      $tl_url_service     = $row['tl_url_service'];
      $tl_wstoken = $row['tl_wstoken'];
      $tl_ex_wstoken = $row['tl_ex_wstoken'];
      $tl_enrol = $row['tl_enrol'];
      $tl_img_bg = $row['tl_img_bg'];
      $tl_img_bg_top = $row['tl_img_bg_top'];
      $tl_img_bg_btn = $row['tl_img_bg_btn'];
      $is_active  = $row['is_active'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="tl_id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Name</label>
            <input value="<?=@$tl_name?>" name="tl_name" type="text" class="form-control" placeholder="Name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Shot Name</label>
            <input value="<?=@$tl_shot?>" name="tl_shot" type="text" class="form-control" placeholder="Shot Name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Set Path</label>
            <input value="<?=@$tl_path?>" name="tl_path" type="text" class="form-control" placeholder="Set Path" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>is active</label>
            <select class="form-control" name="is_active" required>
              <option value="Y" <?=@$is_active=='Y'?"selected":""?>>ACTIVE</option>
              <option value="N" <?=@$is_active=='N'?"selected":""?>>NO ACTIVE</option>
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>URL LOGIN</label>
            <input value="<?=@$tl_url?>" name="tl_url" type="url" class="form-control" placeholder="URL" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>URL SERVICE</label>
            <input value="<?=@$tl_url_service?>" name="tl_url_service" type="url" class="form-control" placeholder="URL" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Token</label>
            <input value="<?=@$tl_wstoken?>" name="tl_wstoken" type="text" class="form-control" placeholder="Token" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Token Extra</label>
            <input value="<?=@$tl_ex_wstoken?>" name="tl_ex_wstoken" type="text" class="form-control" placeholder="Token Extra">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Enrol Course</label>
            <input value="<?=@$tl_enrol?>" name="tl_enrol" type="text" class="form-control" placeholder="Enrol Course">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>BG Banner</label>
            <input type="file" name="tl_img_bg" accept="image/*"  onchange="readURL(this,'showImage')" <?=$required?>>
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
        <div class="col-md-6">
          <h4><strong>IMAGE</strong></h4>
          <div id="showImage">
            <?php if($action == 'EDIT'){ ?>
            <img width="100" src="../../../image/<?=$tl_img_bg?>">
            <?php } ?>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group">
            <label>BG TOP</label>
            <input type="file" name="tl_img_bg_top" accept="image/*"  onchange="readURL(this,'showImageTop')" <?=$required?>>
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
        <div class="col-md-6">
          <h4><strong>IMAGE</strong></h4>
          <div id="showImageTop">
            <?php if($action == 'EDIT'){ ?>
            <img width="100" src="../../../image/<?=$tl_img_bg_top?>">
            <?php } ?>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group">
            <label>BG BTN</label>
            <input type="file" name="tl_img_bg_btn" accept="image/*"  onchange="readURL(this,'showImageBtn')" <?=$required?>>
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
        <div class="col-md-6">
          <h4><strong>IMAGE</strong></h4>
          <div id="showImageBtn">
            <?php if($action == 'EDIT'){ ?>
            <img width="100" src="../../../image/<?=$tl_img_bg_btn?>">
            <?php } ?>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
