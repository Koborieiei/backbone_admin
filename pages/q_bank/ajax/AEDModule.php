<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = @$_POST["action"];
    $id           = @$_POST["id"];
    $type         = @$_POST['type'];
    $skill        = @$_POST['skill'];
    $shuffle      = @$_POST['Shuffle'];
    $hidden       = @$_POST['hidden'];
    $question     = @$_POST['question'];
    $ch1          = @$_POST['ch1'];
    $ch2          = @$_POST['ch2'];
    $ch3          = @$_POST['ch3'];
    $ch4          = @$_POST['ch4'];
    $Grade1       = @$_POST['Grade1'];
    $Grade2       = @$_POST['Grade2'];
    $Grade3       = @$_POST['Grade3'];
    $Grade4       = @$_POST['Grade4'];

    $user_id      = $_SESSION['member'][0]['user_id'];

    $uuid = uniqid();

    // --ADD EDIT DELETE Module-- //
    if($action == "ADD"){
      // to do some thing
      $sql   = "INSERT INTO et_question( uuid, skill_id, q_type, q_text, shuffle, hidden, user_create, create_at) VALUES('$uuid','$skill','$type','$question','$shuffle','$hidden','$user_id',CURRENT_TIMESTAMP)";
     $query = DbQuery($sql,null);
     $sql   = "INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch4',$Grade4); INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch1',$Grade1); INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch2',$Grade2); 
     INSERT INTO et_question_choice(question, c_text, fraction) VALUES ('$uuid','$ch3',$Grade3); ";

    }else if($action == "EDIT"){
      // to do some thing
    }else{
      // to do some thing
    }

    $query = DbQuery($sql,null);
    $json  = json_decode($query,true);
    if(intval($json['errorInfo'][0]) == 0){
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => 'success')));
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "denger","message" => $json['errorInfo'][2])));
    }

  ?>