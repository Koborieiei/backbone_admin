<?php
session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$action       = isset($_POST['action'])?$_POST['action']:"";
$user_id      = isset($_POST['user_id'])?$_POST['user_id']:"";
$user_login   = isset($_POST['user_login'])?$_POST['user_login']:"";
$user_name    = isset($_POST['user_name'])?$_POST['user_name']:"";
$user_last    = isset($_POST['user_last'])?$_POST['user_last']:"";
$user_email   = isset($_POST['user_email'])?$_POST['user_email']:"";
$note1        = isset($_POST['note1'])?$_POST['note1']:"";
$note2        = isset($_POST['note2'])?$_POST['note2']:"";
$user_password= @md5(isset($_POST['user_password'])?$_POST['user_password']:"");
$is_active    = isset($_POST['is_active'])?$_POST['is_active']:"";
$role_list    = @implode(",",isset($_POST['role_list'])?$_POST['role_list']:"");
$branch_id    = @isset($_POST['branch_id'])?$_POST['branch_id']:"0";
$department_id = @isset($_POST['department_id'])?$_POST['department_id']:"0";

$user_img   = "";
$updateImg  = "";

$user_id_update = $_SESSION['member'][0]['user_id'];

$path = "images/";
if(isset($_FILES["user_img"])){
  $user_img = resizeImageToBase64($_FILES["user_img"],'256','256','100',$user_id_update,$path);

  if(!empty($user_img)){
      $updateImg    =  "user_img = '$user_img',";
  }

}


// --ADD EDIT DELETE Module-- //
if(empty($user_id) && $action == 'ADD'){
  $sql   = "INSERT INTO t_user VALUES(
    null,'$user_login','$user_password','$user_email',
    '$user_name','$user_last','$is_active','$role_list',
    '$user_img',NOW(),NOW(),0,
    0,'$user_id_update','$note1','$note2')";
}else if($action == 'EDIT'){
  $sql = "UPDATE t_user SET
            user_login     = '$user_login',
            user_name      = '$user_name',
            user_last      = '$user_last',
            user_email     = '$user_email',
            note1          = '$note1',
            note2          = '$note2',
            branch_id      = '$branch_id',
            department_id  = '$department_id',
            ".$updateImg."
            is_active      = '$is_active',
            role_list      = '$role_list',
            update_date    = NOW(),
            user_id_update = '$user_id_update'
            WHERE user_id = '$user_id'";

    if($user_id_update == $user_id){
      $sqls   = "SELECT * FROM t_user WHERE user_id = '$user_id'";
      $query      = DbQuery($sqls,null);
      $json       = json_decode($query, true);
      $rows       = $json['data'];

      $_SESSION['member'] = $rows;
    }

}else if($action == "DEL"){
  $sql   = "DELETE FROM t_user WHERE user_id = '$user_id'";
}
//echo $sql;
// --ADD EDIT USER-- //
$query      = DbQuery($sql,null);
$row        = json_decode($query, true);
$errorInfo  = $row['errorInfo'];

if(intval($row['errorInfo'][0]) == 0){
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'success')));
}else{
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'danger','message' => 'Fail')));
}


?>
