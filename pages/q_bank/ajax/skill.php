<!-- Info boxes -->
<?php 
ini_set('display_errors', 1);
session_start();
include("../../../inc/function/connect.php");
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
 $sql   = "SELECT * FROM tb_skill";
 $querys = DbQuery($sql,null);
 $json       = json_decode($querys, true);
 $errorInfo  = $json['errorInfo'];
 $dataCount  = $json['dataCount'];
 $rows       = $json['data'];
?>



<center><a class="btn btn-primary" id="skillshow" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Skill Question
  </a></center>

  <div class="row" id="labelskill" style="margin-top:10px">
<div class="col-md-12 col-sm-12 col-xs-12">
<?php
   foreach ($rows as $key => $value) {
?>

  <span style="padding-top:10px;">
  <span class="label label-success" ><?=$value['hs_name'];?></span>
  </span>
  

<?php
   }
?>
  <!-- fix for small devices only -->
  <!-- <div class="clearfix visible-sm-block"></div> -->

  <!-- /.col -->
</div>
</div>
<!-- /.row -->

          <div class="collapse" id="collapseExample">
            <div class="well">
              <div class="row" id="skillbox">
                <?php
                  foreach ($rows as $key => $value) {
                ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><?=$value['hs_name'];?></span>
                        <span class="info-box-number"></span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                <?php
                  }
                ?>
              </div>
            </div>
          </div>

          <script>
    $(function () {
      $("#skillshow").on("click", function(t) {
       
        if($("#labelskill").is(":visible")){
                    $("#skillbox").show("slow");
                    $("#labelskill").hide("slow");
                } else{
                    $("#labelskill").show("slow");
                    $("#skillbox").hide("slow");
                }
      
    });
  })
  </script>





