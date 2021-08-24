<?php 
if (!isset($_SESSION)) {

  session_start();

}
error_reporting(0);

$pdohost="localhost";

$pdodbname=$_SESSION['MM_Username'];

$pdocharset="utf8";

$pdodbusername=$_SESSION['MM_Username'];

$pdodbpassword=$_SESSION['MM_Password'];

$host="http://".$_SERVER['HTTP_HOST'];

$hosturl=$_SERVER['PHP_SELF']; $hosturl=str_replace("#","",$hosturl);

$sefd=explode("/",$_SERVER['REQUEST_URI']);

$sef=$sefd[count($sefd)-1]; $sef=str_replace("?","",$sef); $sef=str_replace("#","",$sef); $sef=str_replace("index.php","",$sef);

if($sef==""){$sef="anasayfa";} 

$hurl=str_replace($sef,"",$host.$hosturl);





class rz_PDO{

	public $pdo;

	function Sutungetir($tablo){global $pdohost; global $pdodbname; global $pdocharset; global $pdodbusername; global $pdodbpassword;

		$db = new PDO("mysql:host=$pdohost; dbname=$pdodbname; charset=$pdocharset", "$pdodbusername", "$pdodbpassword");

		$q = $db->prepare("DESCRIBE ".$tablo."");

		$q->execute();

		$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

		return $table_fields;

		$db=NULL;

	}

	

	function Sorgu($query) {global $pdohost; global $pdodbname; global $pdocharset; global $pdodbusername; global $pdodbpassword;
echo "dnm:".$pdodbusername;
	$db = new PDO("mysql:host=$pdohost; dbname=$pdodbname; charset=$pdocharset", "$pdodbusername", "$pdodbpassword");

    $sql = $db->prepare($query);

    $sql->execute();

    $row = $sql->fetchAll();
	$db=null;
    return $row;
							

	/*
	$pd=new rz_PDO();
	$list=$pd->Sorgu("select * from z_okul where okulbolge=1");

		foreach($list as $row) {

			$id = $row['id'];

			$content = $row['content'];

		}

	*/

	$db=NULL;

	}

}

?>