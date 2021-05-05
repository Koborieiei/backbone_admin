<?php

function addPages($path){
  $path = $path;
  $rootpath = "../../../pages/$path";
  mkdir("$rootpath/js", 0777, true);
  mkdir("$rootpath/css", 0777, true);
  mkdir("$rootpath/ajax", 0777, true);

  $createFileAEDModule=fopen("$rootpath/ajax/AEDModule.php",'w');
  $textAEDModule = '<?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");

    $action       = $_POST["action"];
    $id           = $_POST["id"];

    // --ADD EDIT DELETE Module-- //
    if(empty($module_id) && $action == "ADD"){
      // to do some thing

    }else if($action == "EDIT"){
      // to do some thing
    }else{
      // to do some thing
    }

    header("Content-Type: application/json");
    exit(json_encode(array("status" => "success","message" => $action)));

  ?>';
  fwrite($createFileAEDModule, $textAEDModule);
  fclose($createFileAEDModule);

  $createformModule=fopen("$rootpath/ajax/formModule.php",'w');
  $textformModule = '<?php
    session_start();
    include("../../../inc/function/connect.php");
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action = $_POST["value"];
    $id = $_POST["id"];

    if($action == "EDIT"){
      $btn = "Update changes";


    }
    if($action == "ADD"){
     $btn = "Save changes";
    }
    ?>
    <input type="hidden" name="action" value="<?=$action?>">
    <input type="hidden" name="id" value="<?=@$id?>">
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Input 1</label>
            <input value="" name="" type="text" class="form-control" placeholder="" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Input 2</label>
            <input value="" name="" type="text" class="form-control" placeholder="">
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
    </div>
  ';
  fwrite($createformModule, $textformModule);
  fclose($createformModule);

  $createshowTable=fopen("$rootpath/ajax/showTable.php",'w');
  $textshowTable = '<?php
  session_start();
  include("../../../inc/function/connect.php");
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>COL 1</td>
        <td>COL 2</td>
        <td>COL 3</td>
        <td>COL 4</td>
        <td>COL 5</td>
        <td>Edit/Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        for ($i=1; $i <= 10 ; $i++) {
      ?>
      <tr class="text-center">
        <td><?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>COL <?=$i?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm btn-flat" onclick="showForm(\'EDIT\',\'<?=$i?>\')">Edit</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule(\'<?=$i?>\')">Del</button>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <script>
    $(function () {
      $("#tableDisplay").DataTable();
    })
  </script>
 ';
  fwrite($createshowTable, $textshowTable);
  fclose($createshowTable);

  $createFileCSS=fopen("$rootpath/css/$path.css",'w');
  $createFileJS=fopen("$rootpath/js/$path.js",'w');
  $textJS = '
    showTable();

    function showTable(){
      $.get( "ajax/showTable.php")
      .done(function( data ) {
        $("#showTable").html( data );
      });
    }

    function showForm(value="",id=""){
      $.post("ajax/formModule.php",{value:value,id:id})
        .done(function( data ) {
          $("#myModal").modal("toggle");
          $("#show-form").html(data);
      });
    }

    function delModule(id){
      $.smkConfirm({
        text:"Are You Sure Delete Module?",
        accept:"Yes",
        cancel:"No"
      },function(res){
        // Code here
        if (res) {
          $.post("ajax/AEDModule.php",{action:"DEL",id:id})
            .done(function( data ) {
              $.smkProgressBar({
                element:"body",
                status:"start",
                bgColor: "#000",
                barColor: "#fff",
                content: "Loading..."
              });
              setTimeout(function(){
                $.smkProgressBar({status:"end"});
                showTable();
                showSlidebar();
                $.smkAlert({text: data.message,type: data.status});
              }, 1000);
          });
        }
      });
    }

    $("#formAddModule").on("submit", function(event) {
      event.preventDefault();
      if ($("#formAddModule").smkValidate()) {
        $.ajax({
            url: "ajax/AEDModule.php",
            type: "POST",
            data: new FormData( this ),
            processData: false,
            contentType: false,
            dataType: "json"
        }).done(function( data ) {
          $.smkProgressBar({
            element:"body",
            status:"start",
            bgColor: "#000",
            barColor: "#fff",
            content: "Loading..."
          });
          setTimeout(function(){
            $.smkProgressBar({status:"end"});
            $("#formAddModule").smkClear();
            showTable();
            showSlidebar();
            $.smkAlert({text: data.message,type: data.status});
            $("#myModal").modal("toggle");
          }, 1000);
        });
      }
    });
  ';
  fwrite($createFileJS, $textJS);
  fclose($createFileJS);

  $createFilePHP=fopen("$rootpath/index.php",'w');
  $textPHP = '<?php session_start(); ?>
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
      <link rel="stylesheet" href="css/'.$path.'.css">
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
              <li><a href="#"><i class="fa fa-dashboard"></i> '.ucfirst($path).'</a></li>
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
                  <h3 class="box-title">'.$path.' Controller</h3>

                  <div class="box-tools pull-right">
                    <button onclick="showForm(\'ADD\')" class="btn btn-success btn-flat pull-right">ADD '.$path.'</button>
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
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">'.$path.' Module</h4>
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
      <script src="js/'.$path.'.js"></script>
    </body>
  </html>
  ';
  fwrite($createFilePHP, $textPHP);
  fclose($createFilePHP);

}


function DateDiff($strDate1,$strDate2) //echo "Date Diff = ".DateDiff("2008-08-01","2008-08-31")."<br>";
 {
			return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
 }

 function TimeDiff($strTime1,$strTime2)//echo "Time Diff = ".TimeDiff("00:00","19:00")."<br>";
 {
			return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
 }

 function DateTimeDiff($strDateTime1,$strDateTime2)//echo "Date Time Diff = ".DateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";
 {
			return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
 }


function removePage($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir")
           removePage($dir."/".$object);
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 }

function randomString($length = 4 , $type = 0) {
  // type 0 = UPPER STRING , 1 = LOWER STRING , 2 = MATCH ,
  // 3 = UPPER & LOWER STRING , 4 UPPER & LOWER & MATCH
  if($type == 0){
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }else if($type == 1){
    $characters = 'abcdefghijklmnopqrstuvwxyz';
  }else if($type == 2){
    $characters = '0123456789';
  }else if($type == 3){
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }else if($type == 4){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  }
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function getOTP(){
  return  array('REF' => randomString($length = 5 , $type = 0) , 'OTP' => randomString($length = 4 , $type = 2) );
}

function DateTimeThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("m",strtotime($strDate));
		$strDay= date("d",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		return "$strDay/$strMonth/$strYear $strHour:$strMinute:$strSeconds";
}

function DateThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("m",strtotime($strDate));
		$strDay= date("d",strtotime($strDate));

		return "$strDay/$strMonth/$strYear";
}

function signature(){
  return $str = '<p><br />
  <img src="data:image/png;base64,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" /><br />
  ขอแสดงความนับถือ<br />
  บริษัท เจพี ประกันภัย จำกัด (มหาชน)<br />
  <br />
  อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบโดยอัตโนมัติ กรุณาอย่าตอบกลับ หากท่านมีข้อสงสัยหรือต้องการสอบถามรายละเอียดเพิ่มเติม กรุณาติดต่อตามเบอร์โทรศัพท์ที่ได้ให้ไว้ด้านบน<br />
  <br />
  <a href="http://www.jpinsurance.co.th/" rel="noopener noreferrer" target="_blank">บริษัท เจพี ประกันภัย จำกัด (มหาชน)</a>&nbsp;หมายเลขโทรศัพท์ 0 2290 0555</p>';

}

function mailsend($arr){

  $sql = "SELECT * FROM mail_sent";
  $query = DbQuery($sql,null);
  $row   = json_decode($query, true);

  date_default_timezone_set('Asia/Bangkok');
  require '../../../PHPMailer/PHPMailerAutoload.php';

  $title = '(OTP) '.$arr['ref'].' : BackEnd [System] By JP Insurance Co., Ltd.';
  $fullname = $arr['name'].' '.$arr['last'];

  $date = DateTimeThai($arr['date5m']);

  $strmail = '<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>

      <p>สวัสดี&nbsp;<strong>'.$fullname.'</strong><br />
      <br />
      บริษัท เจพี ประกันภัย จำกัด (มหาชน) ขอแจ้งรหัสผ่านของคุณให้ทราบว่า<br />
      <br />
      รหัสผ่าน OTP สำหรับระบบ <strong>System</strong> ของคุณคือ&nbsp;<br />
      <br />
      <span style="color:#e74c3c"><strong>'.$arr['otp'].'</strong></span>&nbsp;( รหัสอ้างอิง '.$arr['ref'].' )&nbsp;<br />
      <br />
      <span style="color:#e74c3c"><strong>*** รหัสผ่านนี้จะหมดอายุเมื่อ '.$date.' ***</strong>&nbsp;</span><br />
      <br />
      '.signature().'
      </body>
    </html>
    ';

  $mail             = new PHPMailer(true);
  $mail->isSMTP();
  $mail->CharSet    = "utf-8";
  $mail->Host       = $row['data'][0]['mail_host'];
  $mail->Port       = $row['data'][0]['mail_port'];
  $mail->SMTPSecure = $row['data'][0]['mail_SMTPSecure'];
  $mail->SMTPAuth   = true;
  $mail->Username   = $row['data'][0]['mail_Username'];
  $mail->Password   = $row['data'][0]['mail_Password'];
  $mail->SetFrom($row['data'][0]['mail_Username'], $title);
  $mail->addAddress($arr['mail'], 'ToEmail');
  //$mail->SMTPDebug  = 3;
  //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
  $mail->IsHTML(true);

  $mail->Subject = $title;
  $mail->Body    = $strmail;
  // $mail->addAttachment('../image/Preloader_3.gif', 'Preloader_3.gif');

  if($mail->send()) { return 200; } else { return 404; }
  // $mail->send()?return 200;:return 404;

}


function mailsendAttachment($title,$message,$addBCC,$addAttachment){

  $sql = "SELECT * FROM mail_sent";
  $query = DbQuery($sql,null);
  $row   = json_decode($query, true)['data'];
  // print_r($row);
  $strmail = '<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>
      '.$message.'
      </body>
    </html>
    ';

  $mail             = new PHPMailer(true);
  $mail->isSMTP();
  $mail->CharSet    = "utf-8";
  $mail->Host       = $row[0]['mail_host'];
  $mail->Port       = $row[0]['mail_port'];
  $mail->SMTPSecure = $row[0]['mail_SMTPSecure'];
  $mail->SMTPAuth   = true;
  $mail->Username   = $row[0]['mail_Username'];
  $mail->Password   = $row[0]['mail_Password'];
  $mail->SetFrom($row[0]['mail_Username'], $title);
  foreach ($addBCC as $value) {
    $mail->addBCC($value, 'ToEmail');
  }
  $mail->IsHTML(true);

  $mail->Subject = $title;
  $mail->Body    = $strmail;
  $mail->addAttachment($addAttachment['path'], $addAttachment['newname']);

  if($mail->send()) { return 200; } else { return 404; }

}

function getDataSSL($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function updateDataLog($arr){
  // ut_event = INS , UPD , DEL
  // ut_topic = table DB
  $sql  = "INSERT INTO uplate_time VALUES(null,now(),'{$arr['ut_event']}','{$arr['ut_topic']}','{$arr['user_id']}')";
  $query = DbQuery($sql,null);
  $row  = json_decode($query, true);
  $num  = $row['dataCount'];

  if(intval($row['errorInfo'][0]) == 0){
    return 200;
  }else{
    return 400;
  }
}

function showUpdateLog($event,$topic){
  $sql = "SELECT * FROM uplate_time WHERE ut_event = '$event' AND ut_topic = '$topic' ORDER BY ut_timestamp DESC";
  $query = DbQuery($sql,null);
  // $row   = json_decode($query, true);
  return $query;
}

function getoptionProvince($id){
    $option = "";
    $sql   = "SELECT * FROM t_provinces order by code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    for ($i=0; $i < $dataCount; $i++) {
      $idPro     = $json['data'][$i]['id'];
      $name_th   = $json['data'][$i]['name_th'];
      $selected =  ' ';
      if($id == $idPro && $id != ""){
        $selected =  'selected="selected"';
      }
      $option .= '<option value="'.$idPro.'" '.$selected.'>'.$name_th.'</option>';
    }
    return $option;
}

function getProvinceName($id){
    $name = "";
    $sql   = "SELECT * FROM t_provinces where id = '$id' order by code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    if($json['data'][0]['name_th'] != null && $json['data'][0]['name_th'] != "")
    {
      $name    = $json['data'][0]['$name_th'];
    }
    return $name;
}

function getoptionAmphures($province_id,$id){
    $option = "";
    $sql   = "SELECT * FROM t_amphures where province_id = $province_id order by code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    for ($i=0; $i < $dataCount; $i++) {
      $idPro     = $json['data'][$i]['id'];
      $name_th   = $json['data'][$i]['name_th'];
      $selected =  ' ';
      if($id == $idPro && $id != ""){
        $selected =  'selected="selected"';
      }
      $option .= '<option value="'.$idPro.'" '.$selected.'>'.$name_th.'</option>';
    }
    return $option;
}

function getAmphuresName($id){
    $name = "";
    $sql   = "SELECT * FROM t_amphures where id = '$id' order by code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    if($json['data'][0]['name_th'] != null && $json['data'][0]['name_th'] != "")
    {
      $name    = $json['data'][0]['$name_th'];
    }
    return $name;
}

function getoptionDistricts($amphure_id,$id){
    $option = "";
    $sql   = "SELECT * FROM t_districts where amphure_id = $amphure_id order by id";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    for ($i=0; $i < $dataCount; $i++) {
      $idPro     = $json['data'][$i]['id'];
      $name_th   = $json['data'][$i]['name_th'];
      $selected =  ' ';
      if($id == $idPro && $id != ""){
        $selected =  'selected="selected"';
      }
      $option .= '<option value="'.$idPro.'" '.$selected.'>'.$name_th.'</option>';
    }
    return $option;
}

function getDistrictsName($province_id,$id){
    $name = "";
    $sql   = "SELECT * FROM t_districts where id = '$id' order by code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    if($json['data'][0]['name_th'] != null && $json['data'][0]['name_th'] != "")
    {
      $name    = $json['data'][0]['name_th'];
    }
    return $name;
}

function getZipCode($id){
    $name = "";
    $sql   = "SELECT * FROM t_districts where id = '$id'";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    if($json['data'][0]['zip_code'] != null && $json['data'][0]['zip_code'] != "")
    {
      $name    = $json['data'][0]['zip_code'];
    }
    return $name;
}

function getMember($id){
    $member['id'] = "";
    $member['name'] = "";
    $sql   = "SELECT * FROM t_member where member_id = $id";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    $member['id']     = $json['data'][$i]['member_id'];
    $member['name']   = $json['data'][$i]['member_name_th']." ".$json['data'][$i]['member_lname_th'];

    return $member;
}

function getEmployee($id){
    $employee['id'] = "";
    $employee['name'] = "";
    $sql   = "SELECT * FROM t_employee where employee_id = $id";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    $employee['id']     = $json['data'][$i]['employee_id'];
    $employee['name']   = $json['data'][$i]['employee_name_th']." ".$json['data'][$i]['employee_lname_th'];

    return $employee;
}

function getoptionBranch($id){
    $optionBranch = "";
    $sql   = "SELECT * FROM t_branch where is_active = 'Y' order by branch_code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    for ($i=0; $i < $dataCount; $i++) {
      $branch_id    = $json['data'][$i]['branch_id'];
      $cname        = $json['data'][$i]['cname'];
      $selected =  ' ';
      if($id == $branch_id && $id != ""){
        $selected =  'selected="selected"';
      }
      $optionBranch .= '<option value="'.$branch_id.'" '.$selected.'>'.$cname.'</option>';
    }
    return $optionBranch;
}

function getoptionDepartment($id){
    $option = "";
    $sql   = "SELECT * FROM t_department where is_active = 'Y' order by department_code";
    $query = DbQuery($sql,null);
    $json       = json_decode($query, true);
    $dataCount  = $json['dataCount'];

    for ($i=0; $i < $dataCount; $i++) {
      $department_id  = $json['data'][$i]['department_id'];
      $name           = $json['data'][$i]['department_name'];

      $selected =  ' ';
      if($id == $department_id && $id != ""){
        $selected =  'selected="selected"';
      }
      $option .= '<option value="'.$department_id.'" '.$selected.'>'.$name.'</option>';
    }
    return $option;
}

function convert($number){ //inputString  example require .00
  $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
  $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
  $number = str_replace(",","",$number);
  $number = str_replace(" ","",$number);
  $number = str_replace("บาท","",$number);
  $number = explode(".",$number);
  if(sizeof($number)>2){
    $number = number_format($number, 2);
  }

  $strlen = strlen($number[0]);
  $convert = '';
  for($i=0;$i<$strlen;$i++){
  	$n = substr($number[0], $i,1);
  	if($n!=0){
  		if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
  		elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
  		elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
  		else{ $convert .= $txtnum1[$n]; }
  		$convert .= $txtnum2[$strlen-$i-1];
  	}
  }
  $convert .= 'บาท';
  if($number[1]=='0' || $number[1]=='00' || $number[1]==''){
  $convert .= 'ถ้วน';
  }else{
  $strlen = strlen($number[1]);
  for($i=0;$i<$strlen;$i++){
  $n = substr($number[1], $i,1);
  	if($n!=0){
  	if($i==($strlen-1) AND $n==1){$convert
  	.= 'เอ็ด';}
  	elseif($i==($strlen-2) AND
  	$n==2){$convert .= 'ยี่';}
  	elseif($i==($strlen-2) AND
  	$n==1){$convert .= '';}
  	else{ $convert .= $txtnum1[$n];}
  	$convert .= $txtnum2[$strlen-$i-1];
  	}
  }
  $convert .= 'สตางค์';
  }
  return $convert;
}

function convDatetoThai($date){
  $year  = date('Y',strtotime($date)) < 2500?date('Y',strtotime($date))+543:date('Y',strtotime($date));
  $dm = date('d/m/',strtotime($date));
  return "$dm$year";
}

function convDatetoThaiMonth($date){
  $day   = date('d',strtotime($date));
  $month = monthThai(date('n',strtotime($date)));
  $year  = substr(date("Y", strtotime($date))+543,2,2);
  return "$day $month $year";
}

function monthThai($month){
  $arr = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
  return $arr[$month];
}

function monthThaiFull($month){
  $arr = array(
    '0' => '',
    '01' => 'มกราคม',
    '02' => 'กุมภาพันธ์',
    '03' => 'มีนาคม',
    '04' => 'เมษายน',
    '05' => 'พฤษภาคม',
    '06' => 'มิถุนายน',
    '07' => 'กรกฎาคม',
    '08' => 'สิงหาคม',
    '09' => 'กันยายน',
    '10' => 'ตุลาคม',
    '11' => 'พฤศจิกายน',
    '12' => 'ธันวาคม',
    '1' => 'มกราคม',
    '2' => 'กุมภาพันธ์',
    '3' => 'มีนาคม',
    '4' => 'เมษายน',
    '5' => 'พฤษภาคม',
    '6' => 'มิถุนายน',
    '7' => 'กรกฎาคม',
    '8' => 'สิงหาคม',
    '9' => 'กันยายน',);
  return $arr[$month];
}

function dateFormactThai($date){
  $arr  = explode("-",$date);
  $y = $arr[0]+543;
  $m = monthThaiFull($arr[1]);
  $d = $arr[2];
  return $d.' '.$m.' '.$y;
}

function dateFull($strDate){
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strMonth = $strDay." ".monthThaiFull($strMonth)." ".$strYear;
  return $strMonth;
}

function dateThToEn($date,$format,$delimiter){
    $formatLowerCase  = strtolower($format);//var formatLowerCase=format.toLowerCase();
    $formatItems      = explode($delimiter,$formatLowerCase);//var formatItems=formatLowerCase.split(delimiter);
    $dateItems        = explode($delimiter,$date);//var dateItems=date.split(delimiter);
    $monthIndex       = array_search("mm",$formatItems);//var monthIndex=formatItems.indexOf("mm");
    $dayIndex         = array_search("dd",$formatItems);//var dayIndex=formatItems.indexOf("dd");
    $yearIndex        = array_search("yyyy",$formatItems);//var yearIndex=formatItems.indexOf("yyyy");
    $month            = $dateItems[$monthIndex];//var month=parseInt(dateItems[monthIndex]);

    $yearth = $dateItems[$yearIndex];
    if( $yearth > 2450){
      $yearth -= 543;
    }
    $dateEN = $yearth."-".sprintf("%02d", $month)."-".sprintf("%02d", $dateItems[$dayIndex]);
    return $dateEN;
}

function resizeImageToBase64($obj,$h,$w,$quality,$user_id_update,$path) {
  $img = "";
  if(isset($obj) && !empty($obj["name"]))
  {

    if(getimagesize($obj['tmp_name']))
    {
      $ext = pathinfo($obj["name"], PATHINFO_EXTENSION);
      if($ext == 'gif' || $ext !== 'png' || $ext !== 'jpg' )
      {
        if(!empty($h) || !empty($w))
        {
          $filePath       = $obj['tmp_name'];
          $image          = addslashes($filePath);
          $name           = addslashes($obj['name']);
          $new_images     = "thumbnails_".$user_id_update;

          $x  = 0;
          $y  = 0;

          list($width_orig, $height_orig) = getimagesize($filePath);

          if(empty($h)){
              if($width_orig > $w){
                $new_height  = $height_orig*($w/$width_orig);
                $new_width   = $w;
              }else{
                $new_height  = $height_orig;
                $new_width   = $width_orig;
              }
          }
          else if(empty($w))
          {
              if($height_orig > $h){
                $new_height  = $h;
                $new_width   = $width_orig*($h/$height_orig);
              }else{
                $new_height  = $height_orig;
                $new_width   = $width_orig;
              }
          }
          else
          {
            if($height_orig > $width_orig)
            {
              $new_height  = $height_orig*($w/$width_orig);
              $new_width   = $w;
            }else{
              $new_height  = $h;
              $new_width   = $width_orig*($h/$height_orig);
            }
          }

          $create_width   =  $new_width;
          $create_height  =  $new_height;


          if(!empty($h) && $new_height > $h){
             $create_height = $h;
          }

          if(!empty($w) && $new_width > $w){
            $create_width = $w;
          }


          $imageOrig;
          $imageResize    = imagecreatetruecolor($create_width, $create_height);
          $background     = imagecolorallocatealpha($imageResize, 255, 255, 255, 127);
          imagecolortransparent($imageResize, $background);
          imagealphablending($imageResize, false);
          imagesavealpha($imageResize, true);

          if($ext == 'png'){
            $imageOrig      = imagecreatefrompng($filePath);
            $new_images     = $new_images.".png";
            imagecopyresampled($imageResize, $imageOrig, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
            imagepng($imageResize,$path.$new_images);
          }else if ($ext == 'jpg'){
            $imageOrig      = imagecreatefromjpeg($filePath);
            $new_images     = $new_images.".jpg";
            imagecopyresampled($imageResize, $imageOrig, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
            imagejpeg($imageResize,$path.$new_images);
          }else if ($ext == 'gif'){
            $imageOrig      = imagecreatefromgif($filePath);
            $new_images     = $new_images.".gif";
            imagecopyresampled($imageResize, $imageOrig, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
            imagegif($imageResize,"$path".$new_images);
          }

          imagedestroy($imageOrig);
          imagedestroy($imageResize);

          $image   = file_get_contents($path.$new_images);
          $img     = 'data:image/png;base64,'.base64_encode($image);
        }else{
          $image   = file_get_contents($path.$name);
          $img     = 'data:image/png;base64,'.base64_encode($image);
        }

      }
    }
  }
  return $img;
}

function chkNum($obj){
  $obj = str_replace(",","",$obj);
  if(!isset($obj) || empty($obj)){
      $obj = 0;
  }
  if(!is_numeric($obj)){
    $obj = "0";
  }
  return $obj;
}

function uploadfile($attach,$url,$title){
  $fileinfo = pathinfo($attach['name']);
  $filetype = strtolower($fileinfo['extension']);
  $image = $title.time().".$filetype";
  move_uploaded_file($attach['tmp_name'],$url.'/'.$image);

  return array('image' => $image);
}

?>
