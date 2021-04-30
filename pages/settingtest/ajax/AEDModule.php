<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];

    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "CHECK"){

      $sql   = "SELECT * FROM tb_skill AS a LEFT JOIN et_config AS b ON a.hs_id = b.skill_id  ";
      $query = DbQuery($sql,null);
      $row  = json_decode($query,true);

      
      if($row['dataCount'] > 0){
        $insertSQL = null ;
        foreach ($row['data'] as $value) {
            
            // check if id have not standard 
            if($value['n_question']==null){
              $insertSQL = $insertSQL."INSERT INTO et_config (skill_id,type_id) VALUES (".$value['hs_id'].", 1 ); INSERT INTO et_config (skill_id,type_id) VALUES (".$value['hs_id'].",2);";
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
      exit(json_encode(array("status" => "success","message" => "NOT DATA INSERT")));

      }

      header("Content-Type: application/json");
      exit(json_encode(array("status" => "error","message" =>"DATA NOT FOUND")));

      // to do some thing

    }else if($action == "EDIT"){
      // to do some thing
      $cofigarr    = $_POST["config"];

      $sql = "";
      foreach($cofigarr as $value){
        // Check timeduration is null?
        $timeduration = $value['timeduration']==null?"null":$value['timeduration']*60; // min-> sec
        $sql =$sql."UPDATE et_config  SET n_question=".$value['nq'].",timeduration=".$timeduration." WHERE id = ".$value['id']." ; " ;

      }
      $query      = DbQuery($sql,null);
      $row        = json_decode($query, true);
      $errorInfo  = $row['errorInfo'];

      if(intval($row['errorInfo'][0]) == 0){
        header('Content-Type: application/json');
        exit(json_encode(array('status' => 'success','message' => 'Success','command'=>$sql)));
      }else{
        header('Content-Type: application/json');
        exit(json_encode(array('status' => 'danger','message' => 'Fail')));
      }
  
      
    }else{
      // to do some thing
    }

    header("Content-Type: application/json");
    exit(json_encode(array("status" => "success","message" => $action)));

  ?>