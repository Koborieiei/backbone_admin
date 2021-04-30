<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];

    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "ADD"){
      // to do some thing

    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      $sql = DBUpdatePOST($_POST,'certificate_person','cp_id');

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
