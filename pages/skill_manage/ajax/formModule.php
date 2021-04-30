<?php
    session_start();
    include("../../../inc/function/connect.php");
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action = $_POST["value"];
    $id = $_POST["id"];

    $not_in = '';

    if($action == "EDIT"){
      $btn = "Update changes";

      $sqlc   = "SELECT * FROM tb_job WHERE j_id = '$id'";
      $queryc = DbQuery($sqlc,null);
      $rowc   = json_decode($queryc,true)['data'][0];

      $j_name       = $rowc['j_name'];
      $j_detail     = $rowc['j_detail'];
      $j_hard_skill = $rowc['j_hard_skill'];
      $j_soft_skill = $rowc['j_soft_skill'];

      $not_in = "WHERE hs_id NOT IN($j_hard_skill".','."$j_soft_skill)";
    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <input type="hidden" name="j_id" value="<?=@$id?>">
    <div class="modal-body modal-full">

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>JOB NAME</label>
            <input value="<?=@$j_name?>" name="j_name" type="text" class="form-control" placeholder="JOB NAME" required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>JOB DETAIL</label>
            <input value="<?=@$j_detail?>" name="j_detail" type="text" class="form-control" placeholder="JOB DETAIL" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div id="example2Left" class="list-group col">
            <p class="center-div">HARD SKILL</p>
            <?php
              if(isset($j_hard_skill)){
                $sql = "SELECT * FROM tb_skill WHERE hs_id IN ($j_hard_skill)";
                $query = DbQuery($sql,null);
                $row = json_decode($query,true);
                if($row['dataCount'] > 0){
                  foreach ($row['data'] as $key => $value) {
            ?>
            <div class="list-group-item"><?=$value['hs_name']?>
              <input type="hidden" name="j_hard_skill[]" value="<?=$value['hs_id']?>">
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </div>
          <br>
          <div id="example3Left" class="list-group col">
            <p class="center-div">SOFT SKILL</p>
            <?php
              if(isset($j_soft_skill)){
                $sql = "SELECT * FROM tb_skill WHERE hs_id IN ($j_soft_skill)";
                $query = DbQuery($sql,null);
                $row = json_decode($query,true);
                if($row['dataCount'] > 0){
                  foreach ($row['data'] as $key => $value) {
            ?>
            <div class="list-group-item"><?=$value['hs_name']?>
              <input type="hidden" name="j_soft_skill[]" value="<?=$value['hs_id']?>">
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </div>

        </div>
        <div class="col-sm-6">
          <div id="example2Right" class="list-group col list-empty">
            <p class="center-div">ALL SKILL</p>
            <?php
              $sql = "SELECT * FROM tb_skill $not_in ORDER BY hs_id DESC";
              $query = DbQuery($sql,null);
              $row = json_decode($query,true);
              if($row['dataCount'] > 0){
                foreach ($row['data'] as $value) {
            ?>
              <div class="list-group-item"><?=$value['hs_name']?>
                <input type="hidden" name="empty[]" value="<?=$value['hs_id']?>">
              </div>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>





    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>


    <script type="text/javascript">
      new Sortable(example2Left, {
          group: 'shared',
          animation: 150,
          onChange: function(evt) {
            $(evt.item.lastElementChild).attr('name', 'j_hard_skill[]');
          }
      });

      new Sortable(example3Left, {
          group: 'shared',
          animation: 150,
          onChange: function(evt) {
            $(evt.item.lastElementChild).attr('name', 'j_soft_skill[]');
          }
      });

      new Sortable(example2Right, {
          group: 'shared',
          animation: 150,
          onChange: function(evt) {
            $(evt.item.lastElementChild).attr('name', 'empty[]');
          }
      });
    </script>
