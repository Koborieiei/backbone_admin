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
    }else{
      // to do some thing
    }

    header("Content-Type: application/json");
    exit(json_encode(array("status" => "success","message" => $action)));

  ?>