<?php include('function/authen.php'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= $USERIMG ?>" onerror="this.onerror='';this.src='images/user.png'" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=$NameTOP ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" id="showSlidebar">
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
