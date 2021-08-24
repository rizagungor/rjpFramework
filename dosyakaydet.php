<?php
function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}

if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");
$pd=new rz_PDO();
$klist=$pd->Sorgu("SELECT * FROM kullanici where kadi='".$_SESSION['MM_Username']."' and sifre='".$_SESSION['MM_Password']."'"); 


if(isset($_POST['file'])){
$dir=str_replace("\\",'/',$klist[0]['localfolder']); $dir=$dir."/".$klist[0]['projeadi']."/";
$file=$_POST['file'];
$dirfile=$dir.$file;
$code=$_POST['code'];
chmod($dirfile,0777);
$myfile = fopen($dirfile, "w") or die("Unable to open file!");
$txt = $result=remove_utf8_bom($code);
fwrite($myfile, $txt);
fclose($myfile);
chmod($dirfile,0644);
//header("Location:index.php?d=$dir&f=$file");
	//echo $txt;
}
?>