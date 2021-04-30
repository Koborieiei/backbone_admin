<?php
session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$action       = isset($_POST['action'])?$_POST['action']:"ADD";
$role_id      = isset($_POST['role_id'])?$_POST['role_id']:"";
$role_code    = strtoupper(isset($_POST['role_code'])?$_POST['role_code']:"");
$role_name    = isset($_POST['role_name'])?$_POST['role_name']:"";
$role_desc    = isset($_POST['role_desc'])?$_POST['role_desc']:"";
$role_access  = isset($_POST['role_access'])?$_POST['role_access']:"";
$is_active    = isset($_POST['is_active'])?$_POST['is_active']:"is_active";
$page_list    = @implode(",",isset($_POST['pagelist'])?$_POST['pagelist']:"");

// --ADD EDIT DELETE Module-- //
if(empty($role_id) && $action == 'ADD'){
  $sql   = "INSERT INTO t_role VALUES(null,'$role_name','$role_desc','$role_code','$is_active','$page_list',NOW(),'1','$role_access')";
}else if($action == 'EDIT'){
  $sql = "UPDATE t_role SET
            role_name      = '$role_name',
            role_desc      = '$role_desc',
            role_code      = '$role_code',
            is_active      = '$is_active',
            page_list      = '$page_list',
            update_date    =  NOW(),
            user_id_update = '1',
            role_access    = '$role_access'
            WHERE role_id = '$role_id'";
}else{
  $sql   = "DELETE FROM t_role WHERE role_id = '$role_id'";
}

// --ADD EDIT Roles-- //
$query      = DbQuery($sql,null);
$row        = json_decode($query, true);
$errorInfo  = $row['errorInfo'];

if(intval($row['errorInfo'][0]) == 0){
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'Success')));
}else{
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'danger','message' => 'Fail')));
}



?>
