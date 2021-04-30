<?php

include("../../../inc/function/connect.php");

function array2csv(array &$array){
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');

   fputs($df, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

$array = array ();

$sql   = "SELECT * FROM tb_member WHERE tl_id = '{$_GET['tl_id']}' ORDER BY m_id DESC";
$query = DbQuery($sql,null);
$row  = json_decode($query,true);
if($row['dataCount'] > 0){
  download_send_headers("data_export_" . date("Y-m-d") . ".csv");
  echo array2csv($row['data']);
  die();
}else{
  download_send_headers("data_export_" . date("Y-m-d") . ".csv");
  echo array2csv($array);
}

?>
