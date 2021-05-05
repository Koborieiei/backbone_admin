<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = @$_POST['action'];
    $uf_id        = @$_POST['uf_id'];
    $attach       = @$_FILES['file'];
    $user_id      = $_SESSION['member'][0]['user_id'];
    $columnsfile  = 4 ;


     function arrQuesAndCh($filesop,$query)
    {
      $uuid = uniqid();
      $num = count($filesop);
      $arrQuest = [
        "uuid"  => $uuid ,
        "skill_id" =>$filesop[0] ,
        "q_type" => $filesop[1],
        "q_text" => $filesop[3],
        "shuffle" => $filesop[2] ,
        "hidden" => 0,
        "user_create" => $user_id
      ];
      $tableName = "et_question";
      $columns = implode(", ",array_keys($arrQuest));
      $escaped_values = array_values($arrQuest);
      foreach ($escaped_values as $idx=>$data) $escaped_values[$idx] = "'".$data."'";
      $values  = implode(", ", $escaped_values);
      $query = $query."INSERT INTO $tableName($columns) VALUES ($values); ";
      
      $arrChoices = [];
      $ftcheck = $filesop[4];
      $j=1;
        for ($i=4; $i < $num; $i++) {
          // echo "Answer".$ftcheck."ch".$j;
          $arrChoice = [
            "question"  => $uuid ,
            "c_text" =>$filesop[$i] ,
            "fraction" => ($j==$ftcheck?1:0),
            ];
          $tableName = "et_question_choice";
          $columns = implode(", ",array_keys($arrChoice));
          $escaped_values = array_values($arrChoice);
          foreach ($escaped_values as $idx=>$data) $escaped_values[$idx] = "'".$data."'";
          $values  = implode(", ", $escaped_values);
          $query = $query."INSERT INTO $tableName($columns) VALUES ($values); ";
          array_push($arrChoices,$arrChoice);
          $j++;
      }
      print_r($arrQuest);
      print_r($arrChoices);
    }

    function validatefile($filename)
    {
      $allowed = array('csv', 'xlsx');
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if (!in_array($ext, $allowed)) {
        header("Content-Type: application/json");
        exit(json_encode(array("status" => "danger","message" => "Error File format : it is not csv file ")));
      }
    }


    $file = $_FILES['file']['tmp_name'];
    $filename = $_FILES['file']['name'];
    validatefile($filename);
 

          $handle = fopen($file, "r");
          $c = 0;
          $query ="";
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                    {
                      if( $c != 0 && $c >  $columnsfile ){
                        arrQuesAndCh($filesop,$query);
                      }else{
                        header("Content-Type: application/json");
                        exit(json_encode(array("status" => "danger","message" => "Error File format ")));
                      }
                    $c++;
                    }
              //  endloop
           $query = DbQuery($query,null);
           $json  = json_decode($query,true);
           if(intval($json['errorInfo'][0]) == 0){
             header("Content-Type: application/json");
             exit(json_encode(array("status" => "success","message" => 'success')));
           }else{
             header("Content-Type: application/json");
             exit(json_encode(array("status" => "danger","message" => $json['errorInfo'][2])));
           }


          //  if(DbQuery($query,null)){
          //   // header('Content-Type: application/json');
          //   exit(json_encode(array('status' => 'success','message' => 'Success')));
          //  }else{
          //   exit(json_encode(array('status' => 'error','message' => 'import error')));
          //  }



    // // --ADD EDIT DELETE Module-- //
    // if($attach['error'] == 0){
    //   $randomString = randomString(4,4);
    //   $uploadfile = uploadfile($attach,"../../../../image/upload","upload_$randomString"."_");
    //   $sql   = "INSERT INTO upload_file VALUES(null,'{$attach['name']}','{$uploadfile['image']}',now(),'$user_id')";
    //   DbQuery($sql,null);
    //   header('Content-Type: application/json');
    //   exit(json_encode(array('status' => 'success','message' => 'Success')));
    // }



  ?>