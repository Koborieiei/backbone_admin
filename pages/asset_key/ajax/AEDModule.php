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
      unset($_POST["ass_id"]);

      $_POST["ass_token_uat"] = 'skey_test_'.strtoupper(bin2hex(openssl_random_pseudo_bytes(32)));
      $_POST["ass_token"] = 'skey_pro_'.strtoupper(bin2hex(openssl_random_pseudo_bytes(32)));

      $sql = DBInsertPOST($_POST,'asset_token');

    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      $sql = DBUpdatePOST($_POST,'asset_token','ass_id');

    }else{
      // to do some thing
      $sql = "UPDATE asset_token SET is_active = 'D' WHERE ass_id = '{$_POST["id"]}'";
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
