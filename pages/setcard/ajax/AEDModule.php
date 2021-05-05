<?php
session_start();
include("../../../inc/function/mainFunc.php");
include("../../../inc/function/connect.php");

$action       = @$_POST['action'];
$uf_id        = @$_POST['id'];
$attach       = @$_FILES['file'];
$skill_id     = @$_POST['skill_id'];
$user_id      = $_SESSION['member'][0]['user_id'];


if($action == 'DEL'){
  $sqls   = "SELECT * FROM et_upload_files WHERE id = '$uf_id'";
  $querys = DbQuery($sqls,null);
  $rows   = json_decode($querys, true)[0];
  @unlink("../../../../image/upload/{$rows['f_url']}");
  $sql   = "DELETE FROM et_upload_files WHERE id = '$uf_id'";
  DbQuery($sql,null);
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'Success')));

}elseif($action == 'UPDATE'){
  if($skill_id!="null"){
    $sqls   = "UPDATE et_upload_files  SET is_active=0 WHERE type = 2 AND skill_id = $skill_id ; UPDATE et_upload_files  SET is_active=1 WHERE id = $uf_id  ; ";//update all to unactive then this id one to active
    $querys = DbQuery($sqls,null);
    header('Content-Type: application/json');
    exit(json_encode(array('status' => 'success','message' => 'Success')));  

  }else {
    $sqls   = "UPDATE et_upload_files  SET is_active=0 WHERE type = 3 ; UPDATE et_upload_files  SET is_active=1 WHERE id = $uf_id  ; ";//update all to unactive then this id one to active
    $querys = DbQuery($sqls,null);
    header('Content-Type: application/json');
    exit(json_encode(array('status' => 'success','message' => 'Success')));  
  
  }
}

if($attach['error'] == 0){
  if($skill_id != null){
    $randomString = randomString(4,4);
    $uploadfile = uploadfile($attach,"../../../../image/upload","upload_$randomString"."_");
    $sql   = "INSERT INTO et_upload_files (f_name, f_url, type, user_create, create_at,skill_id) VALUES ('{$attach['name']}','{$uploadfile['image']}',2,'$user_id',CURRENT_TIMESTAMP,$skill_id)";
    DbQuery($sql,null);
    header('Content-Type: application/json');
    exit(json_encode(array('status' => 'success','message' => 'Success')));
  }else {
    $randomString = randomString(4,4);
    $uploadfile = uploadfile($attach,"../../../../image/upload","upload_$randomString"."_");
    $sql   = "INSERT INTO et_upload_files (f_name, f_url, type, user_create, create_at) VALUES ('{$attach['name']}','{$uploadfile['image']}',3,'$user_id',CURRENT_TIMESTAMP)";
    DbQuery($sql,null);
    header('Content-Type: application/json');
    exit(json_encode(array('status' => 'success','message' => 'Success')));
    
  }
}

?>
