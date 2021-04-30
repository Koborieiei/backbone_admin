<?php
session_start();
include('../../../inc/function/connect.php');
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

$id = $_POST['id'];
$content_select2 = $_POST['content_select'];
$action = $_POST['action'];
if($action == 'EDIT'){
  $sql   = "SELECT * FROM tb_content WHERE content_id = '$id'";

  $query      = DbQuery($sql,null);
  $json       = json_decode($query, true);
  $row        = $json['data'][0];

  $content_id       = $row['content_id'];
  $content_select   = $row['content_select'];
  $content_menu     = $row['content_menu'];
  $content_show     = $row['content_show'];
  $content_sqe      = $row['content_sqe'];
  $content_name1    = $row['content_name1'];
  $content_bg1      = $row['content_bg1'];
  $content_btn1     = $row['content_btn1'];
  $content_url1     = $row['content_url1'];
  $content_target1  = $row['content_target1'];
  $content_btn2     = $row['content_btn2'];
  $content_url2     = $row['content_url2'];
  $content_target2  = $row['content_target2'];
  $content_name2    = $row['content_name2'];
  $content_bg3      = $row['content_bg3'];
  $content_message  = $row['content_message'];
  $content_btn3     = $row['content_btn3'];
  $content_url3     = $row['content_url3'];
  $content_target3  = $row['content_target3'];
  $content_img      = $row['content_img'];
  $content_text_slide = $row['content_text_slide'];
  $content_widthIMG = $row['content_widthIMG'];
  $content_widthTEXT = $row['content_widthTEXT'];
  $content_inv = $row['content_inv'];

}

?>

<?php if($content_select2 == 1){ ?>
  <div class="col-md-12">
    <p>แผน 1</p>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>ชื่อ</label>
      <input value="<?=@$content_name1?>" name="content_name1" type="text" class="form-control" placeholder="ชื่อ">
    </div>
  </div>
  <div class="col-md-9">
    <div class="form-group">
      <label>พื้นหลัง</label>
      <input value="<?=@$content_bg1?>" name="content_bg1" type="text" class="form-control" placeholder="พื้นหลัง">
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label>ข้อความ slide</label>
      <input value="<?=@$content_text_slide?>" name="content_text_slide" type="text" class="form-control" placeholder="พื้นหลัง">
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>IMAGE</label>
      <input name="content_img" type="file" class="form-control" onchange="readURL(this,'showimage')" placeholder="รูปภาพ">
    </div>
  </div>
  <div class="col-md-6">
    <p>SHOW IMAGE</p>
    <div id="showimage">
      <?php if(!empty($content_img)){ ?>
        <img width="100" src="../../../image/upload/<?=$content_img?>">
      <?php } ?>
    </div>
  </div>
  <div class="clearfix"></div>



  <div class="col-md-3">
    <div class="form-group">
      <label>ชื่อปุ่ม ซ้าย</label>
      <input value="<?=@$content_btn1?>" name="content_btn1" type="text" class="form-control" placeholder="ชื่อปุ่ม ซ้าย">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>URL</label>
      <input value="<?=@$content_url1?>" name="content_url1" type="text" class="form-control" placeholder="ลำดับการแสดง">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>TARGET</label>
      <select class="form-control" name="content_target1">
        <option value="_parent" <?=@$content_target1=='_parent'?"selected":""?>>เปิดหน้าเดิม</option>
        <option value="_blank" <?=@$content_target1=='_blank'?"selected":""?>>ขึ้นหน้าใหม่</option>
      </select>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label>ชื่อปุ่ม ขวา</label>
      <input value="<?=@$content_btn2?>" name="content_btn2" type="text" class="form-control" placeholder="ชื่อปุ่ม ขวา">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>URL</label>
      <input value="<?=@$content_url2?>" name="content_url2" type="text" class="form-control" placeholder="URL">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>TARGET</label>
      <select class="form-control" name="content_target2">
        <option value="_parent" <?=@$content_target2=='_parent'?"selected":""?>>เปิดหน้าเดิม</option>
        <option value="_blank" <?=@$content_target2=='_blank'?"selected":""?>>ขึ้นหน้าใหม่</option>
      </select>
    </div>
  </div>
<?php }else{ ?>
  <div class="col-md-12">
    <p>แผน 2</p>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>ขนาดรูปภาพ (ของหน้าจอ PC)</label>
      <select class="form-control" name="content_widthIMG">
        <?php for ($i=1; $i <=12 ; $i++) { ?>
        <option value="<?=$i?>" <?=@$content_widthIMG==$i?"selected":""?>><?=$i." ส่วน"?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>ขนาดข้อความ (ของหน้าจอ PC)</label>
      <select class="form-control" name="content_widthTEXT">
        <?php for ($i=1; $i <=12 ; $i++) { ?>
        <option value="<?=$i?>" <?=@$content_widthTEXT==$i?"selected":""?>><?=$i." ส่วน"?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>สลับตำแหน่ง</label>
      <select class="form-control" name="content_inv">
        <option value="I" <?=@$content_inv=='I'?"selected":""?>>รูปด้านซ้าย</option>
        <option value="T" <?=@$content_inv=='T'?"selected":""?>>ข้อความด้านซ้าย</option>
      </select>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>ชื่อ</label>
      <input value="<?=@$content_name2?>" name="content_name2" type="text" class="form-control" placeholder="ชื่อ" required>
    </div>
  </div>
  <div class="col-md-9">
    <div class="form-group">
      <label>รูปด้านข้าง</label>
      <input value="<?=@$content_bg3?>" name="content_bg3" type="text" class="form-control" placeholder="รูปด้านข้าง" required>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label>ข้อความ</label>
      <textarea id="editor1" name="editor1">
          <?=@$content_message?>
      </textarea>
      <input type="hidden" id="editor" name="content_message">
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label>ชื่อปุ่ม</label>
      <input value="<?=@$content_btn3?>" name="content_btn3" type="text" class="form-control" placeholder="ชื่อปุ่ม ซ้าย" required>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>URL</label>
      <input value="<?=@$content_url3?>" name="content_url3" type="text" class="form-control" placeholder="ลำดับการแสดง" required>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>TARGET</label>
      <select class="form-control" name="content_target3">
        <option value="_parent" <?=@$content_target3=='_parent'?"selected":""?>>เปิดหน้าเดิม</option>
        <option value="_blank" <?=@$content_target3=='_blank'?"selected":""?>>ขึ้นหน้าใหม่</option>
      </select>
    </div>
  </div>
  <script type="text/javascript">

    CKEDITOR.replace( 'editor1',{ height: '200px' } );

  </script>
<?php } ?>
