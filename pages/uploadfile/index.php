<?php session_start(); ?>
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
      <link rel="stylesheet" href="css/uploadfile.css">
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
              <li><a href="#"><i class="fa fa-dashboard"></i> Uploadfile</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <?php include("../../inc/boxes.php"); ?>
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <div class="col-md-4">
                <div class="box box-primary" style="min-height: 58vh;">
                  <div class="box-header with-border">
                    <h3 class="box-title">Banner Controller</h3>

                    <div class="box-tools pull-right">
                      <button type="button" id="submit-all" class="btn btn-success btn-flat pull-right">Upload File</button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form action="ajax/AEDModule.php" class="dropzone" id="dropzoneFrom" enctype="multipart/form-data"></form>
                  </div>
                </div>
                <!-- /.box -->
              </div>

              <div class="col-md-8">

                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Show Data Controller</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div id="showTable"></div>
                  </div>
                </div>
                <!-- /.box -->
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
      <script src="js/uploadfile.js"></script>




    </body>
  </html>
