<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action       = $_POST["action"];
    $id           = $_POST["id"];

    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "CHECK"){

      $sql   = "SELECT * FROM tb_skill AS a LEFT JOIN  tb_skill_standard AS b ON a.hs_id = b.skill_id  ";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true);

      
      if($row['dataCount'] > 0){
        $insertSQL = null ;
        foreach ($row['data'] as $value) {
            
            // check if id have not standard 
            if($value['standard']==null){
              $insertSQL = $insertSQL."INSERT INTO tb_skill_standard (skill_id, standard, date_create) VALUES (".$value['hs_id'].", 0, CURRENT_TIMESTAMP);";
            }

        }

        if($insertSQL!=null){
          $query = DbQuery($insertSQL,null);
          $row  = json_decode($query,true);

            if(intval($row['errorInfo'][0]) == 0){
              header("Content-Type: application/json");
              exit(json_encode(array("status" => "success","message" => "success ")));
            }else{
              header("Content-Type: application/json");
              exit(json_encode(array("status" => "fail","message" => $row['errorInfo'][2],"SQL"=>$insertSQL)));
            }
        }

      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => "NOT DATA INSERT ")));

      }

      header("Content-Type: application/json");
      exit(json_encode(array("status" => "error","message" =>"DATA NOT FOUND")));

      // to do some thing

    }else if($action == "EDIT"){
      // to do some thing
      unset($_POST["action"]);
      unset($_POST["id"]);
      $sql = DBUpdatePOST($_POST,'tb_skill_standard','skill_id');
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "fail","message" => "fail Action","action" => $action)));
    }

    $query = DbQuery($sql,null);
    $json  = json_decode($query,true);
    if(intval($json['errorInfo'][0]) == 0){
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => 'success')));
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "denger","message" => 'fail',"error message"=>$json['errorInfo'][2])));
    }

   

  ?>