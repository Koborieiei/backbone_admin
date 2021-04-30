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

      $sql   = "SELECT * FROM mail_sent WHERE mail_id = '$id'";
      $query = DbQuery($sql,null);
      $row   = json_decode($query,true)['data'][0];

      $mail_Username   = $row['mail_Username'];
      $mail_Password   = $row['mail_Password'];
      $mail_host       = $row['mail_host'];
      $mail_port       = $row['mail_port'];
      $mail_SMTPSecure = $row['mail_SMTPSecure'];

    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="mail_id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Mail Username</label>
            <input value="<?=@$mail_Username?>" name="mail_Username" type="text" class="form-control" placeholder="Mail Username" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Mail Password</label>
            <input value="<?=@$mail_Password?>" name="mail_Password" type="text" class="form-control" placeholder="Mail Password" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Mail Host</label>
            <input value="<?=@$mail_host?>" name="mail_host" type="text" class="form-control" placeholder="Mail Host" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Mail Port</label>
            <input value="<?=@$mail_port?>" name="mail_port" type="text" class="form-control" placeholder="Mail Port" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Mail SMTPSecure</label>
            <input value="<?=@$mail_SMTPSecure?>" name="mail_SMTPSecure" type="text" class="form-control" placeholder="Mail SMTPSecure" required>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
