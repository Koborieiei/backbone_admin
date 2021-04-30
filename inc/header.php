<?php
$USERIMG = isset($_SESSION['member'][0]['user_img'])?$_SESSION['member'][0]['user_img']:"";
?>
<header class="main-header" >

  <!-- Logo -->
  <a href="../home" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><strong>E</strong>B</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><strong>ED</strong>-BOT</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background:#13436b">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= $USERIMG ?>" onerror="this.onerror='';this.src='images/user.png'" class="user-image" alt="User Image">
            <span class="hidden-xs"><?=$NameTOP = ucwords($_SESSION['member'][0]['user_name'])?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?= $USERIMG ?>" onerror="this.onerror='';this.src='images/user.png'" class="img-circle" alt="User Image">
              <p>
                <?=ucwords($_SESSION['member'][0]['user_name'].' '.$_SESSION['member'][0]['user_last'])?>
                <small>Member since <?=date("d M. Y",strtotime($_SESSION['member'][0]['user_since']))?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a onclick="logout()" href="#" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </nav>
</header>
