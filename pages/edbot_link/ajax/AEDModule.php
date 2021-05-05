<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];

    // --ADD EDIT DELETE Module-- //
    if(empty($id) && $action == "ADD"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      unset($_POST["etl_id"]);
      $sql = DBInsertPOST($_POST,'et_link');

    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      $sql = DBUpdatePOST($_POST,'et_link','etl_id');

    }else{
      // to do some thing
      $sql = "UPDATE et_link SET is_active = 'D' WHERE etl_id = '{$_POST["id"]}'";
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
