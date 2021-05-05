<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action            = $_POST["action"];
    $id                = $_POST["id"];
    $_POST["user_id"]  = $_SESSION['member'][0]['user_id'];

    // --ADD EDIT DELETE Module-- //
    if(empty($id) && $action == "ADD"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      unset($_POST["hs_id"]);

      $sql = DBInsertPOST($_POST,'tb_skill');

    }else if($action == "EDIT"){
      unset($_POST["action"]);
      unset($_POST["id"]);
      $sql = DBUpdatePOST($_POST,'tb_skill','hs_id');
    }else{
      // to do some thing
      $sql = "DELETE FROM tb_skill WHERE hs_id = '{$_POST["id"]}'";
    }

    $query = DbQuery($sql,null);
    $json  = json_decode($query,true);
    if(intval($json['errorInfo'][0]) == 0){
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => 'success')));
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "denger","message" => 'fail')));
    }



  ?>
