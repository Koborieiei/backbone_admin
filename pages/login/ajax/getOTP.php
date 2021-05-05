<?php
session_start();
include('../../../inc/function/mainFunc.php');
include('../../../inc/function/connect.php');

$email  = $_POST['email'];
$getOTP = getOTP();
$session =  password_hash($getOTP['REF'].microtime(), PASSWORD_DEFAULT);

$sqls   = "SELECT * FROM t_user WHERE user_email = '$email'";
$querys = DbQuery($sqls,null);
$rows   = json_decode($querys, true)['data'];
$counts = sizeof($rows);
if($counts < 1){
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'danger','message' => 'Email Is Not Macth')));
}

$user_id = $rows[0]['user_id'];

//(now() + INTERVAL 5 MINUTE)
$sql   = "INSERT INTO t_login VALUES(null,'$session','{$getOTP['REF']}','{$getOTP['OTP']}',now(),(now() + INTERVAL 5 MINUTE),0,'0000-00-00 00:00:00',$user_id)";
$id    = json_decode( DbInsert($sql,null), true);
$sqld   = "SELECT tl_date_end FROM t_login WHERE tl_id = '$id'";
$queryd = DbQuery($sqld,null);
$rowd   = json_decode($queryd, true)['data'];

$arr['mail']   = $email; //'nateenon.nu@jpinsurance.co.th';
$arr['name']   = $rows[0]['user_name'];
$arr['last']   = '';
$arr['ref']    = $getOTP['REF'];
$arr['otp']    = $getOTP['OTP'];
$arr['date5m'] = $rowd[0]['tl_date_end'];

if(mailsend($arr) == 200){
  header('Content-Type: application/json');
  exit(json_encode(array('status' => 'success','message' => 'Success', 'tl_session' => $session , 'REF' => $getOTP['REF'])));
}

// if($action == 'OTP'){
//   header('Content-Type: application/json');
//   exit(json_encode(array('status' => 'success','message' => 'Success')));
// }else{
//   header('Content-Type: application/json');
//   exit(json_encode(array('status' => 'danger','message' => 'Success')));
// }

?>
