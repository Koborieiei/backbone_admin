<!-- Info boxes -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Totle LMS</span>
        <?php
          $sql   = "SELECT COUNT(tl_id) AS Total FROM tb_type_lms";
          $query = DbQuery($sql,null);
          $row   = json_decode($query,true);
          $total = $row['dataCount']>0?$row['data'][0]['Total']:"N/A";
        ?>
        <span class="info-box-number"><?=number_format($total,0)?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Member</span>
        <?php
          $sql   = "SELECT COUNT(m_id) AS Total FROM tb_member";
          $query = DbQuery($sql,null);
          $row   = json_decode($query,true);
          $total = $row['dataCount']>0?$row['data'][0]['Total']:"N/A";
        ?>
        <span class="info-box-number"><?=number_format($total,0)?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Sales</span>
        <span class="info-box-number">N/A</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Certificate</span>
        <?php
          $sql   = "SELECT COUNT(cert_id) AS Total FROM tb_certificate";
          $query = DbQuery($sql,null);
          $row   = json_decode($query,true);
          $total = $row['dataCount']>0?$row['data'][0]['Total']:"N/A";
        ?>
        <span class="info-box-number"><?=number_format($total,0)?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
