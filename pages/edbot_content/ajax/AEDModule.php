<?php
session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$action       = @$_POST['action'];
$cont_id      = @$_POST['cont_id'];
$cont_detail  = @$_POST['cont_detail'];
$cont_seq     = @$_POST['cont_seq'];
$cont_header    = @$_POST['cont_header'];
$cont_head    = @$_POST['cont_head'];
$category     = @$_POST['category'];
$is_active    = @$_POST['is_active'];
$user_id      = $_SESSION['member'][0]['user_id'];
$remove       = @$_POST['remove'];

$attach_imgThum = @$_FILES['cont_imgThum'];
$attach_imgHead = @$_FILES['cont_imgHead'];
$attach_imgBG   = @$_FILES['cont_imgBG'];

$str_category = @implode(",",@$category);
// --ADD EDIT DELETE Module-- //
if(empty($c_id) && $action == 'ADD'){
  $arr_imgThum['image'] = '';
  if($attach_imgThum['error'] == 0){
    $arr_imgThum = uploadfile($attach_imgThum,"../../../../image/blog","b_");
  }
  if($attach_imgBG['error'] == 0){
    $arr_imgBG = uploadfile($attach_imgBG,"../../../../image/blog","bg_");
  }
  if($attach_imgHead['error'] == 0){
    $arr_iimgHead = uploadfile($attach_imgHead,"../../../../image/blog","h_");
  }

  $arr['image'] = '';

  $sql   = "INSERT INTO content VALUES(null,'$cont_header','$cont_head','$cont_detail','{$arr_imgThum['image']}','{$arr['image']}',now(),now(),'0','$str_category','$is_active','$user_id','$cont_seq','{$arr_imgBG['image']}','{$arr_iimgHead['image']}')";

}else if($action == 'EDIT'){

  $sqls   = "SELECT * FROM content WHERE cont_id = '$cont_id'";
  $querys = DbQuery($sqls,null);
  $rows   = json_decode($querys, true)['data'][0];
  // remove image Slide

  if($attach_imgThum['error'] == 0){
    @unlink("../../../../image/blog/{$rows['cont_imgThum']}");
    $uploadfile = uploadfile($attach_imgThum,"../../../../image/blog","b_");
    $sql = "UPDATE content SET cont_imgThum = '{$uploadfile['image']}' WHERE cont_id = '$cont_id'";
    DbQuery($sql,null);
  }
  if($attach_imgBG['error'] == 0){
    @unlink("../../../../image/blog/{$rows['cont_imgBG']}");
    $uploadfile = uploadfile($attach_imgBG,"../../../../image/blog","bg_");
    $sql = "UPDATE content SET cont_imgBG = '{$uploadfile['image']}' WHERE cont_id = '$cont_id'";
    DbQuery($sql,null);
  }
  if($attach_imgHead['error'] == 0){
    @unlink("../../../../image/blog/{$rows['cont_imgHead']}");
    $uploadfile = uploadfile($attach_imgHead,"../../../../image/blog","h_");
    $sql = "UPDATE content SET cont_imgHead = '{$uploadfile['image']}' WHERE cont_id = '$cont_id'";
    DbQuery($sql,null);
  }

  $sql = "UPDATE content SET
              cont_header     = '$cont_header',
              cont_head       = '$cont_head',
              cont_detail     = '$cont_detail',
              cont_dateUpdate = now(),
              cont_category   = '$str_category',
              is_active       = '$is_active',
              cont_seq       = '$cont_seq',
              user_id         = '$user_id'
            WHERE cont_id   = '$cont_id'";
}else{

  $sqls   = "SELECT * FROM content WHERE cont_id = '$cont_id'";
  $querys = DbQuery($sqls,null);
  $rows   = json_decode($querys, true)['data'][0];
  @unlink("../../../../image/blog/{$rows['cont_imgThum']}");
  @unlink("../../../../image/blog/{$rows['cont_imgBG']}");
  @unlink("../../../../image/blog/{$rows['cont_imgHead']}");

  $sql   = "DELETE FROM content WHERE cont_id = '$cont_id'";
}
// --ADD EDIT Module-- //
DbQuery($sql,null);
header('Content-Type: application/json');
exit(json_encode(array('status' => 'success','message' => 'Success')));



?>
