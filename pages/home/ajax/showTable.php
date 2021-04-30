<?php
  session_start();
  include('../../../inc/function/mainFunc.php');
  include('../../../../inc/function/mainFunc.php');
  include('../../../inc/function/connect.php');
  include('../../../../inc/function/simple_html_dom.php');
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);


  $sql   = "SELECT * FROM tb_type_lms WHERE tl_id = '{$_GET['lms']}'";
  $query = DbQuery($sql,null);
  $row  = json_decode($query,true)['data'][0];

  $wstoken = $row['tl_wstoken'];

  $data = array(
    "wsfunction"=>"core_course_get_courses",
  );

  $array = service($wstoken , $data);
?>

<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%">
    <thead>
      <tr>
        <th>No.</th>
        <th>Shortname.</th>
        <th>Categoryid.</th>
        <th>Fullname.</th>
        <th>Displayname.</th>
        <th>Date Create.</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(sizeof($array) > 0){
        foreach ($array as $key => $value) {

          $data = array(
            "wsfunction"=>"core_course_get_categories",
            "criteria[0][key]"=>"ids",
            "criteria[0][value]"=>$value['categoryid'],
          );
          $array_cat = service($wstoken , $data);
      ?>
      <tr>
        <td><?=$key+1?></td>
        <td><?=$value['shortname']?></td>
        <td><?=sizeof($array_cat)>0?$array_cat[0]['name']:"-"?></td>
        <td><?=$value['fullname']?></td>
        <td><?=$value['displayname']?></td>
        <td><?=date('d/m/Y H:i:s',$value['timecreated']);?></td>
      </tr>
      <?php } } ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable({
      responsive: true
    });
  });
</script>
