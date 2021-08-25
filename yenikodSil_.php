<?php 
if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");

$id=$_GET['id'];

$pd=new rz_PDO();
$q1=$pd->Sorgu("delete from fr_komut where komut_id=$id");
$q2=$pd->Sorgu("delete from fr_komuticerik where komut_id=$id"); 
header("Location:index.php");
?>
		  		  