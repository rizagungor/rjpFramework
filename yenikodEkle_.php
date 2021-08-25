<?php 
if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");

$id=$_POST['id'];
$komutadi=$_POST['komutadi'];
$komutacikadi=$_POST['komutacikadi'];
$html=base64_encode($_POST['html']);

$pd=new rz_PDO();
//$kmt=$pd->Sorgu("SELECT * FROM fr_komut where komut_id=$id"); 
$q1=$pd->Sorgu("update fr_komut set  komutadi='$komutadi', komutacikadi='$komutacikadi' where komut_id=$id"); 
$q2=$pd->Sorgu("update fr_komuticerik set kod='$html' where komut_id=$id and tur=1"); 
header("Location:index.php");
?>
		  		  