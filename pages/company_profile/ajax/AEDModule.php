<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];
    $_POST["user_id"]  = $_SESSION['member'][0]['user_id'];
    
    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "ADD"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      unset($_POST["tc_id"]);
      $sql = DBInsertPOST($_POST,'tb_company');

    }else if($action == "EDIT"){
      // to do some thing
    }else{
      // to do some thing
    }

    header("Content-Type: application/json");
    exit(json_encode(array("status" => "success","message" => $sql)));

  ?>
