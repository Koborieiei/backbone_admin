<?php

function connect_ftp(){
  $ftp_server = "192.168.50.2";
  $ftp_user = "daijaii";
  $ftp_pass = "Pass$1234";
  $ftp = ftp_connect($ftp_server,21) or die("Couldn't connect to $ftp_server");
  if (ftp_login($ftp, $ftp_user, $ftp_pass)) {
    return json_encode(array("status" => 200, "ftp_connect" => base64_encode("ftp://$ftp_user:$ftp_pass@$ftp_server") ));
  } else {
    return json_encode(array("status" => 404, "ftp_connect" => "" ));
  }
}

function copyPDF($rootpath,$url,$name,$pass){

  $contextOptions = array(
  	"ssl" => array(
  		"verify_peer"      => false,
  		"verify_peer_name" => false,
  	),
  );

  // the copy or upload shebang
  $copy = copy( $url, $rootpath, stream_context_create( $contextOptions ) );
  //
  // $copy = copy($url, $rootpath);
  if(!$copy){
    $status = 402;
    $message ="FILE'S is not copy";
  }else{
    $status = 200;
    $message ="Sucess";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://daijaii.jpinsurancefriend.com/GENP/gen_pdf_pwd.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
                "url=$url&name=$name&pass=$pass");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    return $server_output;

  }
  return json_encode(array( "status" => $status , "message" => $message , "data" => array()));
}

?>
