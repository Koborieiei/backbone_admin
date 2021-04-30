<?php session_start(); ?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Edbot | Home</title>
      <link rel="shortcut icon" type="image/png" href="../../image/favicon.png"/>
      <?php
        include("../../inc/css-header.php");
        $_SESSION["RE_URI"] = $_SERVER["REQUEST_URI"];
      ?>
      <link rel="stylesheet" href="css/home.css">
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
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <?php include("../../inc/boxes.php"); ?>
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <div class="col-md-12">

                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Home Controller</h3>

                    <div class="box-tools pull-right">
                      <button onclick="showForm('ADD')" class="btn btn-success btn-flat pull-right">ADD Home</button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div id="showTable"></div>
                  </div>
                </div>
                <!-- /.box -->

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Management Home</h4>
                      </div>
                      <form id="formAddRoles" data-smk-icon="glyphicon-remove-sign" novalidate enctype="multipart/form-data">
                      <!-- <form id="formAddRoles" data-smk-icon="glyphicon-remove-sign" novalidate enctype="multipart/form-data" action="ajax/AEDRoles.php" method="post"> -->
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
      <script src="js/home.js"></script>
    </body>
  </html>
