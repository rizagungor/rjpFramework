<?php 
$id=$_POST['id'];
$komutadi=$_POST['komutadi'];
$komutacikadi=$_POST['komutacikadi'];
$html=base64_encode($_POST['html']);

$pd=new rz_PDO();
//$kmt=$pd->Sorgu("SELECT * FROM fr_komut where komut_id=$id"); 
$q1=$pd->Sorgu("update set fr_komut komutadi='$komutadi', komutacikadi='$komutacikadi' where komut_id=$id"); 
$q2=$pd->Sorgu("update set fr_komuticerik kod='$html' where komut_id=$id and tur=1"); 
header("index.php");
?>
		  		  