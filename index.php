<?php $login=false; ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");

$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  $isValid = False; 
  if (!empty($UserName)) { 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}



$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], 1)))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_Password'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_Password']);
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <title>Framework by Rıza Güngör</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script language="Javascript" type="text/javascript" src="lib/editarea/edit_area/edit_area_full.js"></script>
	<script language="Javascript" type="text/javascript">
		editAreaLoader.init({
			id: "txtScript"	// id of the textarea to transform	
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,allow_toggle: true
			,word_wrap: true
			,language: "en"
			,syntax: "php"
			,min_height: (screen.height-385)
		});
		function test_setSelectedText(id,code){
			text= code; 
			editAreaLoader.setSelectedText(id, text);
		}
	</script>
</head>

<body style="background-color:#333; color: aliceblue;">

<?php 
	$pd=new rz_PDO();
	$klist=$pd->Sorgu("SELECT * FROM kullanici where kadi='".$_SESSION['MM_Username']."' and sifre='".$_SESSION['MM_Password']."'"); 
	?>

<div class="container-fluid">

	<div class="row">
    <div class="col-sm-3" style="background-color:#333;">Hoşgeldin <?php echo $klist[0]['adsoyad']; ?></div>
	<div class="col-sm-5" style="background-color:#333;">RJP Framework <?php echo $klist[0]['projeadi']; ?></div>
		<div class="col-sm-4" style="background-color:#333;">
			<a style="float: left;" title="Save" onClick="dosyakadet();" class="btn btn-default btn-flat"><i class="fa fa-hdd-o"></i></a>
			<a style="float: left;" title="Upload FTP this file" onClick="ftpkaydet();" class="btn btn-default btn-flat"><i class="fa fa-cloud-upload"></i></a>
			<a style="float: right; margin-left: 20px;" href="<?php echo $logoutAction; ?>" class="btn btn-danger btn-flat">Exit</a>
            
            <!--<a style="float: right;" title="Git Push" onClick="github('p.bat');" class="btn btn-warning btn-flat"><i class="fa fa-cloud-upload"></i></a>-->
            <!--<a style="float: right;" title="Git Commit" onClick="github('git commit -am  \"<?php echo $_GET['f']; ?> Düzenleme\"');" class="btn btn-warning btn-flat"><i class="fa fa-hdd-o"></i></a>-->
            <a style="float: right;" title="Git Add Commit" onClick="github1();" class="btn btn-primary btn-flat"><i class="fa fa-hdd-o"></i></a>
            <input style="width: 100px; float: right;" type="text" id="commit" class="form-control" placeholder="Commit ->">
            <a style="float: right;" title="Git Pull" onClick="github('git pull'); location.reload();" class="btn btn-primary btn-flat"><i class="fa fa-cloud-download"></i></a>
            <a style="float: right;" title="Git Clone project" onClick="github('git clone <?php echo $klist[0]['giturl'] ?>'); location.reload();" class="btn btn-warning btn-flat"><i class="fa fa-cloud-download"></i></a>
        </div>
            
	</div>

	<div class="row">
    	<?php  $login=true;
		include_once("ust_fr.php"); ?>
	</div>
	

  <div class="row">
	  <div class="col-sm-2" style="background-color:#333;">

	  	<?php include_once("sol_fr.php"); ?>
	  </div>

	  <div class="col-sm-7" style="background-color:#333;">

		<?php include_once("orta_fr.php"); ?>
	  </div>

	  <div class="col-sm-3" style="background-color:#333;">

		<?php include_once("sag_fr.php"); ?>
	  </div> 

	</div>
  </div>

	

<script>
$.fn.insertAtCaret = function (text) {
    return this.each(function () {
        if (document.selection && this.tagName == 'TEXTAREA') {
            //IE textarea support
            this.focus();
            sel = document.selection.createRange();
            sel.text = text;
            this.focus();
        } else if (this.selectionStart || this.selectionStart == '0') {
            //MOZILLA/NETSCAPE support
            startPos = this.selectionStart;
            endPos = this.selectionEnd;
            scrollTop = this.scrollTop;
            this.value = this.value.substring(0, startPos) + text + this.value.substring(endPos, this.value.length);
            this.focus();
            this.selectionStart = startPos + text.length;
            this.selectionEnd = startPos + text.length;
            this.scrollTop = scrollTop;
        } else {
            // IE input[type=text] and other browsers
            this.value += text;
            this.focus();
            this.value = this.value; // forces cursor to end
        }
    });
};
/*


$('#emoticons a[name="smile"]').click(function (event) {
    event.preventDefault();
    var code = $(this).find('img').attr('title');
    $('#txtScript').insertAtCaret(code);
});
*/

function dosyakadet(){
	$.post("dosyakaydet.php", {file:$("#filename").val(), code:editAreaLoader.getValue("txtScript")}, function( code ) {
		//alert(code);
	});		
}

function ftpkaydet(){
	$.post("ftpkaydet.php", {file:$("#filename").val()}, function( code ) {
		//alert(code);
	});		
}
    
function github(command){
	$.post("gitcom.php", {command:command}, function( code ) {
		alert(code);
	});		
}
    
function github1(){
    var command = "git commit -m '"+$("#commit").val()+"'";
	$.post("gitcom.php", {command:command}, function( code ) {
		alert(code);
	});		
}
	
function kodEkle(katid,tur){
	$.post("kodget.php", {k:katid, t:tur}, function( code ) {
  		$('#txtScript').insertAtCaret(code);
		test_setSelectedText("txtScript",code);
	});		
}
	
function yaziEkle(code){
  	$('#txtScript').insertAtCaret(code);
	test_setSelectedText("txtScript",code);
}

function tablogetir(tablo){
	$.post("ust_tabloget.php", {t:tablo}, function( code ) {
  		$("#colun").html(code);
	});	
}
	
	</script>	
</body>
</html>		  