
    <?php
    session_start();
    include("../../../inc/function/mainFunc.php");
    include("../../../inc/function/connect.php");
    require_once '../../../mpdf2/vendor/autoload.php';

    $user_login = $_SESSION['member'][0]['user_login'];
    $user_email = $_SESSION['member'][0]['user_email'];
    $user_name  = $_SESSION['member'][0]['user_name'];
    $user_last  = $_SESSION['member'][0]['user_last'];

    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => ['2858', '2223'],
        'fontDir' => array_merge($fontDirs, [
             __DIR__ . '/font',
        ]),
        'fontdata' => $fontData + [
            'kanits' => [
                'R' => 'Kanit-Regular.ttf'
            ]
        ],
        'default_font' => 'kanits'
    ]);

    ob_start();

    $cert_id = $_POST['cert_id'];
    $sql = "SELECT tc.cert_template, tc.cert_name, tu.user_name, tu.user_last, tc.cert_sign1, tc.cert_sign2 FROM tb_certificate tc , t_user tu
    WHERE tc.user_id = tu.user_id
    AND cert_id = '$cert_id'";
    $query = DbQuery($sql,null);
    $row  = json_decode($query,true)['data'][0];
    ?>

      <div class="date">
        <p>Date : <?=date("j F, Y")?></p>
        <p class="text-right">No : 00-000-0001</p>
      </div>

      <h1 class="name"><?=$row['user_name'].' '.$row['user_last']?></h1>
      <h1 class="cert-name"><?=$row['cert_name']?></h1>

      <div class="cert_sign <?=$row['cert_sign2']==''?"c-right":""?>">
        <img class="cert_sign-img" src="<?=$row['cert_sign1']?>">
      </div>
      <div class="cert_sign-right">
        <img class="cert_sign-img" src="<?=$row['cert_sign2']?>">
      </div>


<?php

  $html = ob_get_contents();
  ob_end_clean();
  $stylesheet = file_get_contents('../css/style.css');
  $mpdf->SetTitle("Certificate | MB ONLINE");
  $mpdf->img_dpi = 100;
  // $mpdf->showImageErrors = true;
  $pagecount = $mpdf->setSourceFile("../cert/{$row['cert_template']}");

  $tplId = $mpdf->ImportPage($pagecount);
  $mpdf->UseTemplate($tplId, 0, 0, 2858, 2223);
  $mpdf->SetProtection(array('print'), $user_login, null,128);

  $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
  $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

  $random = 'PDF_'.time().rand(0,1000);
  // $mpdf->Output("pdf/$random.pdf", \Mpdf\Output\Destination::INLINE);
  if(!$mpdf->Output("pdf/$random.pdf", \Mpdf\Output\Destination::FILE)){

    require '../../../PHPMailer/PHPMailerAutoload.php';

    $title = "MBONLINE SEND CERTIFICATE";
    $message = "Deer, $user_name  $user_last<br /> Congratulations with {$row['cert_name']}";
    $addBCC = array($user_email);
    $addAttachment = array('path' => "pdf/$random.pdf" , 'newname' => md5($random).'.pdf');
    if(mailsendAttachment($title,$message,$addBCC,$addAttachment) == 200){
      unlink("pdf/$random.pdf");
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "success","message" => "success")));
    }else{
      header("Content-Type: application/json");
      exit(json_encode(array("status" => "denger","message" => "mail Fail")));
    }
  }else{
    header("Content-Type: application/json");
    exit(json_encode(array("status" => "denger","message" => "fail")));
  }
?>
