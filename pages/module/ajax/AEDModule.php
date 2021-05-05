<?php
session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$action       = @$_POST['action'];
$module_id    = @$_POST['module_id'];
$module_code  = @$_POST['module_code'];
$module_name  = @$_POST['module_name'];
$module_icon  = @$_POST['module_icon'];
$module_order = @$_POST['module_order'];
$module_type  = @$_POST['module_type'];
$root_id      = @$_POST['root_id'];
$is_active    = @$_POST['is_active'];

// --ADD EDIT DELETE Module-- //
if(empty($module_id) && $action == 'ADD'){
  $sql   = "INSERT INTO t_module VALUES(null,'$module_code','$module_name','$module_order','$is_active','$module_type','$module_icon',NOW(),'1','','$root_id')";
}else if($action == 'EDIT'){
  $sql = "UPDATE t_module SET
            module_code = '$module_code',
            module_name = '$module_name',
            module_icon = '$module_icon',
            module_order= '$module_order',
            module_type = '$module_type',
            root_id     = '$root_id',
            is_active   = '$is_active',
            update_date = NOW()
            WHERE module_id = '$module_id'";
}else{
  $sql   = "DELETE FROM t_module WHERE module_id = '$module_id'";
}
// --ADD EDIT Module-- //
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
