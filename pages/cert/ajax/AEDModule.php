<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = @$_POST["action"];
    $cert_id      = @$_POST["cert_id"];

    $cert_template    = @$_FILES['cert_template'];
    $_POST["user_id"]  = $_SESSION['member'][0]['user_id'];

    // --ADD EDIT DELETE Module-- //
    if(empty($cert_id) && $action == "ADD"){
      // to do some thing

      unset($_POST["action"]);
      unset($_POST["cert_id"]);

      $cert_template = uploadfile($cert_template,"../cert","template_");
      $_POST['cert_template'] = $cert_template['image'];
      $sql = DBInsertPOST($_POST,'tb_certificate');


    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      if($cert_template['error'] == 0){
        $sql = "SELECT cert_template FROM tb_certificate WHERE cert_id = '{$_POST["cert_id"]}'";
        $query   = DbQuery($sql,null);
        $row     = json_decode($query,true)['data'][0];
        @unlink("../cert/".$row['cert_template']);
        $cert_template = uploadfile($cert_template,"../cert","template_");
        $_POST['cert_template'] = $cert_template['image'];
      }
      $sql = DBUpdatePOST($_POST,'tb_certificate','cert_id');

    }else{
      // to do some thing
      $sql = "UPDATE tb_certificate SET is_active = 'N' WHERE cert_id = '$cert_id'";
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
