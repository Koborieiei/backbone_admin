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

      $sql = "SELECT * FROM tb_certificate WHERE cert_id = '$id'";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true)['data'][0];

      $cert_id = $row['cert_id'];
      $cert_name = $row['cert_name'];
      $tl_id = $row['tl_id'];
      $cert_sign1 = $row['cert_sign1'];
      $cert_sign2 = $row['cert_sign2'];
      $cert_course_id = $row['cert_course_id'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="cert_id" value="<?=@$cert_id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>CERT NAME</label>
            <input value='<?=@$cert_name?>'name="cert_name" type="text" class="form-control" placeholder="" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>LMS NAME</label>
            <select class="form-control" name="tl_id" required>
              <?php
                $sql = "SELECT * FROM tb_type_lms";
                $query = DbQuery($sql,null);
                $row  = json_decode($query,true);
                if($row['dataCount'] > 0){
                  foreach ($row['data'] as $value) {
              ?>
              <option value="<?=$value['tl_id']?>" <?=@$tl_id==$value['tl_id']?"selected":""?>><?=$value['tl_name']?></option>
              <?php }} ?>
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>COURSE ID COMPLATE</label>
            <input value="<?=@$cert_course_id?>" name="cert_course_id" type="text" class="form-control" placeholder="" required>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>CERT SING 1 (300×120)</label>
            <textarea name="cert_sign1" class="form-control" rows="4" required><?=@$cert_sign1?></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>CERT SING 2 (300×120)</label>
            <textarea name="cert_sign2" class="form-control" rows="4"><?=@$cert_sign2?></textarea>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>TEMPLATE</label>
            <input type="file" name="cert_template" accept="application/pdf" class="form-control" <?=$required?>>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
