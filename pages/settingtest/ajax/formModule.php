<?php
    session_start();
    include("../../../inc/function/connect.php");
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action     = $_POST["value"];
    $id         = $_POST["id"];
    $name       = $_POST["name"];

    if($action == "EDIT"){
      $btn = "Update changes";

      // count number question in DB
      $sql   = "SELECT COUNT(id) as nq_data FROM et_question  WHERE skill_id  = $id ";
      $query      = DbQuery($sql,null);
      $jsoncount       = json_decode($query, true);
      $nq_data =  $jsoncount['data'][0]['nq_data'];
      // $nq_data =  $jsoncount['errorInfo'][0];


      $sql   = "SELECT * FROM tb_skill AS a RIGHT JOIN  et_config AS b ON a.hs_id = b.skill_id   WHERE b.skill_id  = $id ";
      $query      = DbQuery($sql,null);
      $json       = json_decode($query, true);
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input value=<?=$nq_data?> id="nq-ch" type="hidden" class="form-control" placeholder="">
    <input type="hidden" name="id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Skill name</label>
            <input value="<?=$name?>"  type="text" class="form-control" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Total Question BANK(ข้อ)</label>
            <input value="<?=$nq_data?>"  name="nq_data" type="text" class="form-control" readonly>
          </div>
        </div>
      </div>

      <?php
      $n=0;
      foreach ($json['data'] as $value) {
        
       if($value['type_id']==1){
         $typename = "Pre-Test";

       }elseif($value['type_id']==2){
        $typename = "Post-Test";
       }else {
        $typename = "Unknow";
       } 
      
      ?>
      <!-- config -->
      <b><h4> <?=$typename?></h4></b>
      <input value=<?=$value['id']?> name="config[<?=$n?>][id]"  type="hidden" class="form-control " >
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Number of questions (ข้อ) </label>
            <input value=<?=$value['n_question']?> name="config[<?=$n?>][nq]"  type="number" class="form-control nq_ch" data-smk-msg="Required field" Required>
          </div>
        </div>
        <?php  if($value['type_id']!=1){ ?>
        <div class="col-md-6">
          <div class="form-group">
            <label>Time Duration(Minute)</label>
            <input value=<?=($value['timeduration'])/60?> name="config[<?=$n?>][timeduration]" type="" class="form-control" data-smk-msg="Required field" Required>
          </div>
        </div>
        <?php }
        ?>
      </div>
      
      <?php
         if($value['is_active']==1){
        ?>
       <!-- status -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Status : </label>
            <span class="label label-success" > ACTIVE</span>
          </div>
        </div>
      </div>
       <!-- End status -->
       <?php 
         }else {
       ?>
        <!-- status -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Status : </label>
            <span class="label label-danger" > UNACTIVE</span>
          </div>
        </div>
      </div>
       <!-- End status -->

       <?php 
       }

       $n++;
       }
       ?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
  