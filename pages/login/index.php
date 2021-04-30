<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edbot | Log in</title>
  <link rel="shortcut icon" type="image/png" href="../../image/favicon.png"/>

  <?php include('../../inc/css-header.php'); ?>
  <link rel="stylesheet" href="css/login.css">

</head>
<body class="login-page bgHey" onload="showProcessbar();">
  <div class="content">
  <div class="row">
    <div class="col-md-4 col-md-offset-3" >
      <form id="formLogin" smk-icon="glyphicon-remove" novalidate autocomplete="off">
      <div class="row login">
        <div class="col-md-4">
          <h4 style="color:#FFFFFF;margin-bottom:30px;">&nbsp;</h4>
          <div align="center">
            <!-- <img src="../../image/logo.png" style="width: 100%;"> -->
          </div>
        </div>
        <div class="col-md-8">
          <h4 style="color:#FFFFFF;margin-bottom:30px;">WEB APPLICATION</h4>
          <div class="form-group">
            <input name="user" id="user" type="text" class="form-control" placeholder="Username" name="user" id="user" smk-text="กรุณากรอก Username" required>
          </div>
          <div class="form-group">
            <input name="pass" type="password" autocomplete="new-password" class="form-control" placeholder="Password" name="pass" id="pass" smk-text="กรุณากรอก Password" required>
          </div>
          <div class="form-group">
            <button type="submit" style="background :#231F30;color:#ffff;width:100%" class="btn btn-block btn-flat"><i></i>Sign in</button>
          </div>
          <div class="form-group">
            <!-- <h5 style="color:#FFFFFF;"><a>Forget Username or Password?</a></h5> -->
          </div>
        </div>
      </div>
      </form>
  </div>
</div>
</div>
<?php include('../../inc/js-footer.php'); ?>
<script src="js/login.js"></script>
</body>
</html>
