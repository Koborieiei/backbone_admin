<?php
// path , name , pwd
function gen_pwd_pdf($filename,$pwd){
    if($filename == '' or $pwd == ''){
        $status = 401;
        $message = 'Value is not Empty';
        $url = '';
        $array = array('status' => $status , 'message' => $message , 'timestamp' => $date_create , 'data' => array('url' => $url));
        return json_encode($array);
    }
    $mpdf = new \Mpdf\Mpdf();
    $pagecount = $mpdf->setSourceFile("PDF/$filename");
    for ($i=1; $i<=($pagecount); $i++) {
        $mpdf->AddPage();
        $import_page = $mpdf->ImportPage($i);
        $mpdf->UseTemplate($import_page);
    }
    $mpdf->setProtection(array(),$pwd,$pwd);
    $status = 403;
    $message = 'Gen PDF Fail';
    $url = '';
    if(!$mpdf->Output("PDF_P/$filename", \Mpdf\Output\Destination::FILE)){
        $date_create = date('Y-m-d h:m:s');
        $status = 200;
        $message = 'Gen PDF Success';
        $url = "https://daijaii.jpinsurancefriend.com/GENP/PDF_P/$filename";
    }
    $array = array('status' => $status , 'message' => $message , 'timestamp' => $date_create , 'data' => array( 'filename' => $filename , 'url' => $url));
    return json_encode($array);
}

?>
