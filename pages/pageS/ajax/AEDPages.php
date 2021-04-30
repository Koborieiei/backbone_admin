<?php
session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$action       = @$_POST['action'];
$page_id      = @$_POST['page_id'];
$page_code    = @$_POST['page_code'];
$page_name    = @$_POST['page_name'];
$page_path    = @$_POST['page_path'];
$module_id    = @$_POST['module_id'];
$page_seq     = @$_POST['page_seq'];
$is_active    = @$_POST['is_active'];
$page_icon    = @$_POST['page_icon'];

// --ADD EDIT DELETE Module-- //
if(empty($page_id) && $action == 'ADD'){
  $sql   = "INSERT INTO t_page VALUES(null,'$page_code','$page_name','$page_icon','$page_path','$module_id','$page_seq','$is_active',NOW(),'1')";
  addPages($page_path);
}else if($action == 'EDIT'){

  $sqlc   = "SELECT * FROM t_page WHERE page_id = '$page_id'";
  $queryc      = DbQuery($sqlc,null);
  $row        = json_decode($queryc, true);
  $errorInfo  = $row['errorInfo'];
  $rowc       = $row['data'];

  $page_pathc    = $rowc[0]['page_path'];
  if($page_pathc != $page_path){
    rename("../../$page_pathc","../../$page_path");
  }

  $sql = "UPDATE t_page SET
            page_code   = '$page_code',
            page_name   = '$page_name',
            page_icon   = '$page_icon',
            page_path   = '$page_path',
            module_id   = '$module_id',
            page_seq    = '$page_seq',
            is_active   = '$is_active',
            update_date = NOW()
            WHERE page_id = '$page_id'";
}else{
  $sqld   = "SELECT * FROM t_page WHERE page_id = '$page_id'";

  $queryd     = DbQuery($sqld,null);
  $row        = json_decode($queryd, true);
  $errorInfo  = $row['errorInfo'];
  $rowd       = $row['data'];

  $page_pathd    = $rowd[0]['page_path'];
  removePage("../../$page_pathd");
  $sql   = "DELETE FROM t_page WHERE page_id = '$page_id'";
}
// --ADD EDIT Module-- //
if($_SESSION['member'][0]['user_id'] == 0 && $action == 'ADD'){
  $queryid     = DbQuery($sql,null);
  $rowid       = json_decode($queryid, true);
  $id          = $rowid['id'];

  $sqlc   = "SELECT * FROM t_role WHERE role_id = '0'";
  $queryc     = DbQuery($sqlc,null);
  $row        = json_decode($queryc, true);
  $errorInfo  = $row['errorInfo'];
  $rowc       = $row['data'];

  $page_list = $rowc[0]['page_list'].",$id";
  //DbQuery($sqlc,null);
  $sqlu = "UPDATE t_role SET page_list = '$page_list' WHERE role_id = '0'";
  DbQuery($sqlu,null);
}else{
  DbQuery($sql,null);
}

header('Content-Type: application/json');
exit(json_encode(array('status' => 'success','message' => 'Success','sql' => $sql)));



?>
