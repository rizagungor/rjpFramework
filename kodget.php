<?php 
require_once("../sConn.php");
if (!isset($_SESSION)) {
  session_start();
}

$k=$_POST['k'];
$t=$_POST['t'];

$pd=new rz_PDO();
$klist=$pd->sorgu("SELECT * FROM kullanici where kadi='".$_SESSION['MM_Username']."' and sifre='".$_SESSION['MM_Password']."'"); 

if($t=="html"){$query = $pd->sorgu("SELECT * FROM fr_komuticerik where komut_id=$k and tur=1");}
//if($t=="css"){$query = $pd->sorgu("SELECT * FROM fr_komuticerik where komut_id=$k and tur=2");}
//if($t=="js"){$query = $pd->sorgu("SELECT * FROM fr_komuticerik where komut_id=$k and tur=3");}
//if($t=="aciklama"){$pd = $sorgu->query("SELECT * FROM fr_komuticerik where komut_id=$k and tur=4");}
$kod=base64_decode($query[0]['kod']);

echo html_entity_decode($kod);

?>