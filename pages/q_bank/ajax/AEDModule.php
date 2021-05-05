<?php
session_start();
include "../../../inc/function/mainFunc.php";
include "../../../inc/function/connect.php";
header("Content-Type: application/json");

$action = @$_POST["action"];
$questionId = @$_POST["questionId"];

// Change some of variable
$questionType = @$_POST['questionType'];

// Refers to skillid
$skill = @$_POST['skill'];
$shuffle = @$_POST['Shuffle'];
$hidden = @$_POST['hidden'];
$questionText = addslashes(@$_POST['question']);
$ch1 = addslashes(@$_POST['ch1']);
$ch2 = addslashes(@$_POST['ch2']);
$ch3 = addslashes(@$_POST['ch3']);
$ch4 = addslashes(@$_POST['ch4']);
$ch1Id = @$_POST['ch1Id'];
$ch2Id = @$_POST['ch2Id'];
$ch3Id = @$_POST['ch3Id'];
$ch4Id = @$_POST['ch4Id'];
$Grade1 = @$_POST['Grade1'];
$Grade2 = @$_POST['Grade2'];
$Grade3 = @$_POST['Grade3'];
$Grade4 = @$_POST['Grade4'];

$user_id = $_SESSION['member'][0]['user_id'];
$currentSqlDatetime = date("Y-m-d H:i:s");
$uuid = uniqid();

// --ADD EDIT DELETE Module-- //
if ($action == "ADD") {
  // to do some thing
  $sql = "INSERT INTO et_question( uuid, skill_id, q_type, q_text, shuffle, hidden, user_create, create_at) VALUES('$uuid','$skill','$questionType','$questionText','$shuffle','$hidden','$user_id',CURRENT_TIMESTAMP)";
  $query = DbQuery($sql, null);
  $sql = "INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch4',$Grade4); INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch1',$Grade1); INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch2',$Grade2);
     INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch3',$Grade3); ";
} else if ($action == "EDIT") {
  $sql = "UPDATE et_question SET q_text = '$questionText', skill_id = '$skill', shuffle = '$shuffle', hidden = '$hidden' WHERE id = '$questionId';
    UPDATE et_question_choice SET c_text = '$ch1',fraction = '$Grade1'  WHERE id = '$ch1Id';
    UPDATE et_question_choice SET c_text = '$ch2',fraction = '$Grade2'  WHERE id = '$ch2Id';
    UPDATE et_question_choice SET c_text = '$ch3',fraction = '$Grade3'  WHERE id = '$ch3Id';
    UPDATE et_question_choice SET c_text = '$ch4',fraction = '$Grade4'  WHERE id = '$ch4Id'; ";
} else  if ($action == "DEL") {
  $sql  = "UPDATE et_question SET deleted_at ='$currentSqlDatetime' WHERE id = '$questionId'";
}

$query = DbQuery($sql, null);
$json = json_decode($query, true);
if (intval($json['errorInfo'][0]) == 0) {
  exit(json_encode(array("status" => "success", "message" => 'success')));
} else {

  exit(json_encode(array("status" => "denger", "message" => $json['errorInfo'][2])));
}
