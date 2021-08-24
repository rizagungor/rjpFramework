<form action="dosyakaydet.php" method="post">
    <?php $dir=str_replace("\\",'/',$klist[0]['localfolder']); $dir=$dir."/".$klist[0]['projeadi']."/"; ?>
<input type="text" class="form-control" name="file" value="<?php if(isset($_GET['f'])&&file_exists($dir.$_GET['f'])){echo $_GET['f'];} ?>" id="filename">
		  <textarea name="code" style="color: #000; width: 100%;" class="txtScript1" id="txtScript">
			  <?php $ficerik="File not found";
if(isset($_GET['f'])&&file_exists($dir.$_GET['f'])){
$file=$dir.$_GET['f'];
$fn = fopen($file,"r");
  while(! feof($fn))  {
	$result = fgets($fn); $result=str_replace("			  ","",$result); 
	$result=htmlentities($result); 
	  echo $result;
  }
  fclose($fn);
}else{echo $ficerik;}
?>
		  </textarea>
			  <!--<input type="hidden" name="dir" value="dir">
			  <input type="submit" style="width: 100%;" value="Kaydet" class="btn btn-default">-->
</form>		  		  		  