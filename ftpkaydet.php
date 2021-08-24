<?php
require_once("../sConn.php");
if (!isset($_SESSION)) {
  session_start();
}

function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}

$pd=new rz_PDO();
$klist=$pd->sorgu("SELECT * FROM kullanici where kadi='".$_SESSION['MM_Username']."' and sifre='".$_SESSION['MM_Password']."'"); 

$dir="../".$klist[0]['projeadi']."/";
$file=$_POST['file'];
$dirfile=$dir.$file;

if(isset($_POST['file'])&&file_exists($dirfile)){
	
	$host = $klist[0]['projeftpurl'];
	$usr = $klist[0]['projeftpuser'];
	$pwd = $klist[0]['projeftppass'];
	$local_file = $dirfile;
	$ftp_path = $klist[0]['projeftppath'];
    
    echo $cmd="lftp -e 'set ftp:ssl-allow no; cd $ftp_path; put $dirfile; bye' -u $usr,$pwd ftp.$host";
    exec($cmd, $acl); //echo $acl;
	
    //choco install lftp
    //lftp -e 'set ftp:ssl-allow no; cd public_html/sayfalar; put anasayfa.php; bye' -u btt,Max16Riza ftp.bursatoptantekstil.com
    
    /*echo $conn_id = ftp_connect($host, 21) or die ("Sunucuya bağlanılamadı!");
	ftp_login($conn_id, $usr, $pwd) or die("Cannot login");
	$upload = ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII);
	//print (!$upload) ? 'Yüklenemedi' : 'Yükleme Başarılı';
	//print "\n";
	if (ftp_chmod($conn_id, 0666, $ftp_path) !== false) {
		//print $ftp_path . " chmod başarılı: 666\n";
	} else {
		//print "başarısız chmod $file\n";
	}
	ftp_close($conn_id);*/
	
	
}
?>