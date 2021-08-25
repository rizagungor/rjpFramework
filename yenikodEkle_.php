<?php 
if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");

$kat_id=$_POST['kat_id'];
$komutadi=$_POST['komutadi'];
$komutacikadi=$_POST['komutacikadi'];
$html=base64_encode($_POST['html']);

$pd=new rz_PDO();
$q1=$pd->Sorgu("insert into fr_komut (kat_id, komutadi, komutacikadi, html, css, js, aciklama, ozelmi) values ('$kat_id', '$komutadi', '$komutacikadi', 1, 0, 0, 0, 0)");
$kmt=$pd->Sorgu("SELECT * FROM fr_komut order by komut_id desc limit 1"); 
$q2=$pd->Sorgu("insert into fr_komuticerik (komut_id, tur, kod) values (".$kmt[0]['komut_id'].", '1', '$html')"); 
header("Location:index.php");
?>
		  		  