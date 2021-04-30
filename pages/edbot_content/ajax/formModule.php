<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$action = $_POST['value'];
$id = $_POST['id'];
$cont_category = array();
$cont_detail = '';
$cont_imgSlide = '';
$required = 'required';
if($action == 'EDIT'){
  $btn = 'Update changes';
  $required = '';
  $sqls   = "SELECT * FROM content WHERE cont_id = '$id'";
  $querys = DbQuery($sqls,null);
  $rows   = json_decode($querys, true)['data'];

  $cont_id       = $rows[0]['cont_id'];
  $cont_header   = $rows[0]['cont_header'];
  $cont_head     = $rows[0]['cont_head'];
  $cont_detail   = $rows[0]['cont_detail'];
  $cont_seq      = $rows[0]['cont_seq'];
  $cont_imgThum  = $rows[0]['cont_imgThum'];
  $cont_imgBG    = $rows[0]['cont_imgBG'];
  $cont_imgHead  = $rows[0]['cont_imgHead'];
  $is_active     = $rows[0]['is_active'];
}
if($action == 'ADD'){
 $btn = 'Save changes';
}
?>
<input type="hidden" name="action" value="<?=$action?>">
<input type="hidden" name="cont_id" value="<?=@$id?>">
<input type="hidden" name="cont_detail" id="cont_detail">
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Header Top Text</label>
        <input value="<?=@$cont_header?>" name="cont_header" type="text" class="form-control" placeholder="Header Top Text">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Head Text</label>
        <input value="<?=@$cont_head?>" name="cont_head" type="text" class="form-control" placeholder="Head Text">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Status</label>
        <select name="is_active" class="form-control" style="width: 100%;" required>
          <option value="Y" <?=@$is_active=='Y'?"selected":""?>>ACTIVE</option>
          <option value="N" <?=@$is_active=='N'?"selected":""?>>NO ACTIVE</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Seq</label>
        <input value="<?=@$cont_seq?>" name="cont_seq" type="number" maxlength="3" class="form-control" placeholder="Sequence" required>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>File input Header</label>
            <input type="file" name="cont_imgHead" accept="image/*">
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>File input Thumnal</label>
            <input type="file" name="cont_imgThum" accept="image/*" <?=$required?>>
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>File input Thumnal BG</label>
            <input type="file" name="cont_imgBG" accept="image/*" <?=$required?>>
            <p class="help-block">Example block-level help text here.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <textarea name="editor1" id="editor1">
          <?=$cont_detail?>
      </textarea>
      <input type="hidden" id="editor" name="editor">
    </div>
    <div class="col-md-12">
      <?php if($action == 'EDIT'){ ?>
      <h4><strong>ImgHeader</strong></h4>
      <img width="100" src="../../../image/blog/<?=$cont_imgHead?>">
      <?php } ?>
    </div>
    <div class="col-md-12">
      <?php if($action == 'EDIT'){ ?>
      <h4><strong>ImgThum</strong></h4>
      <img width="100" src="../../../image/blog/<?=$cont_imgThum?>">
      <?php } ?>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
</div>

<script type="text/javascript">

  CKEDITOR.replace( 'editor1',{ height: '200px' } );

</script>
