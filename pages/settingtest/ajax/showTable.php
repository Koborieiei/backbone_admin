<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
      <td>No</td>
        <td>Skill Name</td>
        <td>number of question</td>
        <td>status</td>
        <td></td>
      </tr>
    </thead>
    <tbody>
   
      <?php
          $sql   = "SELECT * FROM tb_skill AS a RIGHT JOIN  et_config AS b ON a.hs_id = b.skill_id     ";
          $query = DbQuery($sql,null);
          $row  = json_decode($query,true);
          if($row['dataCount'] > 0){
            $result = array();
            foreach ($row['data'] as $element) {
                $result[$element['hs_id']][] = $element;
            }
             
            $i = 1 ;
            foreach ($result as $values) {
              ?>
               <tr class="text-center">
              <?php
              // var_dump($values);
              
              $datalists = array();
              $n = 1 ;
               foreach ($values as $value) {
                
              
                if ( $n == 1 ){
                $hs_id =  $value['hs_id'];
                $hs_name =  $value['hs_name'];
                ?>
               
                <td><?=$i?></td>
               <td> <?=$hs_name?></td>
                <?php
              }
                $data['status'] = $value['is_active'] ;
              if($value['type_id']==1){
                $data['type'] = "Pre-Test";
                $data['n_question'] = $value['n_question'] ;
               
              }else if($value['type_id']==2){
                $data['type'] = "Post-Test";
                $data['n_question'] = $value['n_question'] ;
              }else {
                $data['type'] = "dont know type";
                $data['n_question'] = $value['n_question'] ;
              }
              array_push($datalists,$data);

             
              
              $n++;
            }  
      ?>
      
        <td>
        <?php

        foreach ($datalists as   $valuedata) {
       

          ?>
           <span class="label label-success" ><?=$valuedata['type']." ".$valuedata['n_question'];?></span>
  
          <?php
          
          }?>
    
        </td>
        <td>
        <?php
        foreach ($datalists as   $valuedata) {

          if($valuedata['status']==1){
            ?> <span class="label label-success" ><?=$valuedata['type']." : active";?></span><?php

          }elseif($valuedata['status']==0){
            ?><span class="label label-danger" ><?=$valuedata['type']." : unactive";?></span><?php
          }else {

            ?>  <span class="label label-secondary" ><?=$valuedata['type']." ".$valuedata['status'];?></span><?php
           
          }
          }?>
    
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$hs_id?>','<?=$hs_name?>')">SETTING</button>
        </td>
      </tr>
      <?php 
          $i++ ; 
        }
     } ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
 