<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  $skill_id = @$_GET['skill_id'];
  ?>

  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>Skill_id</td>
        <td>type</td>
        <td>Question Text</td>
        <td>Shuffle</td>
        <td>Hidden</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
    <?php
        $str    = $skill_id==null?" ":"WHERE skill_id = '$skill_id'  ";
        $sqls   = "SELECT * FROM et_question $str ORDER BY id DESC";
        $querys = DbQuery($sqls,null);

        $json   = json_decode($querys, true);
        $counts = $json['dataCount'];
        $rows   = $json['data'];

        if($counts > 0){
          foreach ($rows as $key => $value) {   
      ?>
      <tr class="text-center">
        <td><?=$key+1?></td>
        <td><?=$value['skill_id']?></td>
        <td><?=$value['q_type']?></td>
        <td><?=$value['q_text']?></td>
        <td> 
        <?php 
         if($value['shuffle']==1){
          ?> <span class="label label-success" >yes</span><?php

        }elseif( $value['shuffle']==0){
          ?><span class="label label-danger" >no</span><?php
        }else {

          ?>  <span class="label label-secondary" >unknow</span><?php
         
        }?>
        </td>
        <td> 
        <?php 
         if($value['hidden']==1){
          ?> <span class="label label-success" >yes</span><?php

        }elseif( $value['hidden']==0){
          ?><span class="label label-danger" >no</span><?php
        }else {

          ?>  <span class="label label-secondary" >unknow</span><?php
         
        }?>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm('EDIT','<?=$i?>')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$i?>')">Del</button>
        </td>
      </tr>
      <?php } }?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
 