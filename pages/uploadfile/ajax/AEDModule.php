<?php
session_start();
include("../../../inc/function/mainFunc.php");
include("../../../inc/function/connect.php");

$action       = @$_POST['action'];
$uf_id        = @$_POST['uf_id'];
$attach       = @$_FILES['file'];
$user_id      = $_SESSION['member'][0]['user_id'];

if($action == 'DEL'){
  $sqls   = "SELECT * FROM upload_file WHERE uf_id = '$uf_id'";
  $querys = DbQuery($sqls,null);
  $rows   = json_decode($querys, true)[0];
  @unlink("../../../../image/upload/{$rows['uf_url']}");
  $sql   = "DELETE FROM upload_file WHERE uf_id = '$uf_id'";
  DbQuery($sql,null);
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'Success')));
}

if($attach['error'] == 0){
  $randomString = randomString(4,4);
  $uploadfile = uploadfile($attach,"../../../../image/upload","upload_$randomString"."_");
  $sql   = "INSERT INTO upload_file VALUES(null,'{$attach['name']}','{$uploadfile['image']}',now(),'$user_id')";
  DbQuery($sql,null);
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'Success')));
}

?>
