<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];
    $tl_img_bg    = @$_FILES['tl_img_bg'];
    $tl_img_bg_top    = @$_FILES['tl_img_bg_top'];
    $tl_img_bg_btn    = @$_FILES['tl_img_bg_btn'];
    $_POST["user_id"]  = $_SESSION['member'][0]['user_id'];

    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "ADD"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      unset($_POST["tl_id"]);
      $tl_img_bg = uploadfile($tl_img_bg,"../../../../image","bg_");
      $_POST['tl_img_bg'] = $tg_img['image'];

      $tl_img_bg_top = uploadfile($tl_img_bg_top,"../../../../image","bgt_");
      $_POST['tl_img_bg_top'] = $tg_img['image'];

      $tl_img_bg_btn = uploadfile($tl_img_bg_btn,"../../../../image","bgb_");
      $_POST['tl_img_bg_btn'] = $tg_img['image'];

      $sql = DBInsertPOST($_POST,'tb_type_lms');
    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);

      if($tl_img_bg['error'] == 0){
        $sql = "SELECT tl_img_bg FROM tb_type_lms WHERE tl_id = '{$_POST["tl_id"]}'";
        $query   = DbQuery($sql,null);
        $row     = json_decode($query,true)['data'][0];
        @unlink("../../../../image/".$row['tl_img_bg']);
        $tl_img_bg = uploadfile($tl_img_bg,"../../../../image","bg_");
        $_POST['tl_img_bg'] = $tl_img_bg['image'];
      }

      if($tl_img_bg_top['error'] == 0){
        $sql = "SELECT tl_img_bg_top FROM tb_type_lms WHERE tl_id = '{$_POST["tl_id"]}'";
        $query   = DbQuery($sql,null);
        $row     = json_decode($query,true)['data'][0];
        @unlink("../../../../image/".$row['tl_img_bg_top']);
        $tl_img_bg_top = uploadfile($tl_img_bg_top,"../../../../image","bgt_");
        $_POST['tl_img_bg_top'] = $tl_img_bg_top['image'];
      }

      if($tl_img_bg_btn['error'] == 0){
        $sql = "SELECT tl_img_bg_btn FROM tb_type_lms WHERE tl_id = '{$_POST["tl_id"]}'";
        $query   = DbQuery($sql,null);
        $row     = json_decode($query,true)['data'][0];
        @unlink("../../../../image/".$row['tl_img_bg_btn']);
        $tl_img_bg_btn = uploadfile($tl_img_bg_btn,"../../../../image","bgb_");
        $_POST['tl_img_bg_btn'] = $tl_img_bg_btn['image'];
      }


      $sql = DBUpdatePOST($_POST,'tb_type_lms','tl_id');
    }else{
      // to do some thing
      $sql = "DELETE FROM tb_type_lms WHERE tl_id = '{$_POST["id"]}'";
    }

    $query = DbQuery($sql,null);
    $json  = json_decode($query,true);
    if(intval($json['errorInfo'][0]) == 0){
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => 'success')));
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "danger","message" => 'fail')));
    }

  ?>
