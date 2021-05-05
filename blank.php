<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <?php include("inc/css-header.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("inc/header.php"); ?>

  <?php include("inc/sidebar.php"); ?>

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
      <?php include("inc/boxes.php"); ?>
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("inc/footer.php"); ?>
</div>
<!-- ./wrapper -->
<?php include("inc/js-footer.php"); ?>
</body>
</html>
