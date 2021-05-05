<?php
  session_start();
  include('../../../inc/function/connect.php');
  include('../../../inc/function/mainFunc.php');
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

<div class="btn-group">
  <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select Card <span class="caret"></span>
  </button>
 <ul class="dropdown-menu">
 <li><a href=".">Pre-Test</a></li>
         
                
               
      <?php
        $sql   = "SELECT * FROM tb_skill     ";
        $query = DbQuery($sql,null);
        $json   = json_decode($query, true);
        $counts = $json['dataCount'];
        $rows   = $json['data'];

        if($counts > 0){
          foreach ($rows as $key => $value) {
          
      ?>
 <li><a href=".?skill_id=<?=$value['hs_id']?>&skill_name=<?= $value['hs_name']?>"><?= $value['hs_name']?> </a></li>
            


      <?php } }?>
      </ul>
      </div>

