 x<?php session_start();
@$skill_id = $_GET['skill_id']==null?"null":$_GET['skill_id'];
@$skill_name = $_GET['skill_name']==null?"All":$_GET['skill_name'];
?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Edbot | Dashboard</title>
      <?php
        include("../../inc/css-header.php");
        $_SESSION["RE_URI"] = $_SERVER["REQUEST_URI"];
      ?>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
      <link rel="stylesheet" href="css/q_bank.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="showProcessbar();showSlidebar();">
      <div class="wrapper">
        <?php include("../../inc/header.php"); ?>

        <?php include("../../inc/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Dashboard
              <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Question bank</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
          <?php include("../../inc/boxes.php"); ?>

          <!-- Tabs -->
          <div class="row">
              <div class="col-md-12">
                  <div class="box box-primary" >
                    <!-- tabs skill -->
                    <div id="showTabs"></div>
                  </div>
              </div>
            </div>

            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Question Bank Controller : <?=$skill_name?> </h3>
                  <input type="hidden" id="skill_id" name="skill_id" value=<?=$skill_id ?>>
                  <div class="box-tools pull-right">
                  <button onclick="showFormupload()" class="btn btn-warning btn-flat ">Import CSV</button> | 
                    <button onclick="showForm('qmanage','ADD',<?=$skill_id?>)" class="btn btn-success btn-flat pull-right">ADD Question</button>
                  </div>
             
                </div>

           
                <!-- /.box-header -->
                <div class="box-body">
                  <div id="showTable"></div>
                </div>
              </div>
              <!-- /.box -->

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Question Management</h4>
                    </div>
                    <div id="uploadform">
                      <input type="hidden" name="action" value="<?=$type?>">
                      <input type="hidden" name="id" value="<?=@$id?>">
                           <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">

                                  <label>Import Csv file</label>
                        
                                  <div class="box-body">
                                  <a href="example.csv" download>***Example csv format***</a>

                                        <form action="ajax/AEDModuleUpload.php" class="dropzone" id="dropzoneFrom" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="addfile">
                                        </form>
                                          <script>
                                            Dropzone.options.dropzoneFrom = {
                                            autoProcessQueue: false,
                                            addRemoveLinks:true,
                                            maxFilesize: 1000, // MB
                                            parallelUploads:5,
                                            maxFiles : 1, // ไฟล์สูงสุด 5 ไฟล์
                                            acceptedFiles: ".xls, .xlsx, .csv",
                                            dictDefaultMessage: "วางไฟล์ CSV",
                                            init: function(){
                                              var submitButton = document.querySelector('#submit-all');
                                              myDropzone = this;
                                              submitButton.addEventListener("click", function(){
                                                myDropzone.processQueue();
                                              });
                                              this.on("success", function( file ,response ){
                                                console.log(response);

                                                if(this.getQueuedFiles().length == 0)
                                                  {
                                                  var _this = this;
                                                  _this.removeAllFiles();
                                                  $.smkProgressBar({
                                                    element:'body',
                                                    status:'start',
                                                    bgColor: '#000',
                                                    barColor: '#fff',
                                                    content: 'Loading...'
                                                  });
                                                 
                                                  setTimeout(function(){
                                                    $.smkProgressBar({status:'end'});
                                                    $("#dropzoneFrom").smkClear();
                                                    showTable();
                                                    showSlidebar();
                                                    $.smkAlert({ text: response.message, type: response.status });
                                                    $("#myModal").modal("toggle");
                                                    $("#uploadform").hide();
                                                  
                                                  }, 1000);

                                                  }


                                              });
                                              },
                                            };
                                            </script>
                                    </div>
            
                                 </div>
                            </div>
                       </div>
                       </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="button" id="submit-all" class="btn btn-success btn-flat ">Upload File</button>
                      </div>
                    
                    </div>

                    <form id="formAddModule" data-smk-icon="glyphicon-remove-sign" novalidate enctype="multipart/form-data">
                      <div id="show-form"></div>
                    </form>
                  </div>
                </div>
              </div>


              </div>
            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include("../../inc/footer.php"); ?>
      </div>
      <!-- ./wrapper -->
      <?php include("../../inc/js-footer.php"); ?>
      <script src="js/q_bank.js"></script>
    </body>
  </html>
  