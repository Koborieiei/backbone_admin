<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];

    // --ADD EDIT DELETE Module-- //
    if(empty($id) && $action == "ADD"){
      // to do some thing
    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      $sql = DBUpdatePOST($_POST,'tb_member','m_id');
    }else{
      // to do some thing
    }

    $query = DbQuery($sql,null);
    $json  = json_decode($query,true);
    if(intval($json['errorInfo'][0]) == 0){
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => "success")));
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "danger","message" => 'fail')));
    }

  ?>
