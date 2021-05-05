<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["content_id"];
    $content_img  = @$_FILES["content_img"];
    $_POST["user_id"]  = $_SESSION['member'][0]['user_id'];

    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "ADD"){
      // to do some thing
      unset($_POST["editor1"]);
      unset($_POST["action"]);
      unset($_POST["content_id"]);

      if($content_img['error'] == 0){
        $content_img = uploadfile($content_img,"../../../../image/upload","img_");
        $_POST['content_img'] = $content_img['image'];
      }
      $sql = DBInsertPOST2($_POST,'tb_content');

    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["editor1"]);
      unset($_POST["action"]);

      if($content_img['error'] == 0){
        $sql = "SELECT content_img FROM tb_content WHERE content_id = '{$_POST["content_id"]}'";
        $query   = DbQuery($sql,null);
        $row     = json_decode($query,true)['data'][0];
        @unlink("../../../../image/upload/".$row['content_img']);

        $content_img = uploadfile($content_img,"../../../../image/upload","img_");
        $_POST['content_img'] = $content_img['image'];
      }
      $sql = DBUpdatePOST2($_POST,'tb_content','content_id');

      // uploadfile($attach,$url,$title)

    }else{
      // to do some thing
      $sql = "DELETE FROM tb_content WHERE content_id = '$id'";
    }
    //
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
