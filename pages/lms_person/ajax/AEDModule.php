<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];
    $file_csv     = @$_FILES['file'];
    // --ADD EDIT DELETE Module-- //
    if(empty($id) && $action == "ADD"){
      // to do some thing
      $sql = '';
      if($file_csv['error'] == 0){
        if($file_csv = uploadfile($file_csv,"csv","csv_")){
          $new_name = $file_csv['image'];
          $objCSV = fopen('csv/'.$new_name, "r");
          while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
            if(!empty($objArr[0])){
              $sqlc   = "SELECT tl_id FROM tb_member WHERE tl_id = '{$_POST["tl_id"]}' AND m_username = '{$objArr[0]}' AND m_password = '{$objArr[1]}'";
              $query = DbQuery($sqlc,null);
              $row  = json_decode($query,true);
              if($row['dataCount'] == 0){
                $arr['m_username'] = $objArr[0];
                $arr['m_password'] = $objArr[1];
                $arr['m_idcard'] = $objArr[2];
                $arr['m_fname'] = $objArr[3];
                $arr['m_lname'] = $objArr[4];
                $arr['m_email'] = $objArr[5];
                $arr['m_course_id'] = str_replace("|",",",$objArr[6]);
                $arr['tl_id'] = $_POST["tl_id"];
                $sql .= DBInsertPOST($arr,'tb_member');
              }
            }
          }
          unlink("csv/$new_name");
        }else{
          header("Content-Type: application/json");
          exit(json_encode(array("status" => "danger","message" => 'Formacth file Fail')));
        }

      }else{
        header("Content-Type: application/json");
        exit(json_encode(array("status" => "danger","message" => 'File is Empty')));
      }

    }else if($action == "EDIT"){
      // to do some thing
    }else{
      // to do some thing
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
