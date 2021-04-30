<?php

session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$action       = isset($_POST['action'])?$_POST['action']:"";
$user         = isset($_POST['user'])?$_POST['user']:"";
$pass         = isset($_POST['pass'])?$_POST['pass']:"";
$tl_session   = isset($_POST['tl_session'])?$_POST['tl_session']:"";

$typeStatus   = 0;
if($action == 'OTP'){

  $sqls   = "SELECT * FROM t_login WHERE tl_otp = '$pass' AND tl_session = '$tl_session' AND tl_date_end >= getdate()";
  $querys = DbQuery($sqls,null);
  $json   = json_decode($querys, true);
  $counts = $json['dataCount'];
  $rows   = $json['data'];

  if($counts == 1){
    $tl_id = $rows[0]['tl_id'];
    $user_id = $rows[0]['user_id'];
    $sql = "UPDATE t_login SET tl_date_login = getdate(), tl_status = '1' WHERE lm_id = '$tl_id'";
    DbQuery($sql,null);
    $typeStatus = 1;
  }else{
    header('Content-Type: application/json');
    exit(json_encode(array('status' => 'danger','message' => 'OTP TIME UP')));
  }
}else{
  $pass = md5($pass);
  $sqls   = "SELECT * FROM t_user WHERE user_login = '$user' AND user_password = '$pass'";
  //echo $sqls;
  $querys = DbQuery($sqls,null);
  $json   = json_decode($querys, true);
  $counts = $json['dataCount'];
  $rows   = $json['data'];

  if($counts == 1){
    $user_id = $rows[0]['user_id'];
    $typeStatus = 1;
  }else{
    header('Content-Type: application/json');
    exit(json_encode(array('status' => 'danger','message' => 'User Or Password Not Macth')));
  }

}

if($typeStatus == 1){
  $_SESSION['member'] = $rows;
  //$_SESSION['branch'] = "";
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'Success','sql' => $sqls)));
}



?>
