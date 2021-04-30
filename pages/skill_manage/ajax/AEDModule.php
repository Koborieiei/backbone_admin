<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];

    $_POST['j_hard_skill'] = @implode(",",$_POST['j_hard_skill']);
    $_POST['j_soft_skill'] = @implode(",",$_POST['j_soft_skill']);

    $_POST["user_id"]  = $_SESSION['member'][0]['user_id'];

    // --ADD EDIT DELETE Module-- //
    if(empty($id) && $action == "ADD"){
      // to do some thing
      unset($_POST['action']);
      unset($_POST['id']);
      unset($_POST['j_id']);
      unset($_POST['empty']);

      $sql = DBInsertPOST($_POST,'tb_job');

    }else if($action == "EDIT"){
      unset($_POST['action']);
      unset($_POST['id']);
      unset($_POST['empty']);

      $sql = DBUpdatePOST($_POST,'tb_job','j_id');

    }else{
      $sql = "DELETE FROM tb_job WHERE j_id = '$id'";
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
