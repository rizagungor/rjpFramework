<?php 
$kat=$_GET['kat'];
$pd=new rz_PDO();
//$kmt=$pd->Sorgu("SELECT * FROM fr_komut where komut_id=$k"); 
?>
<form action="yenikodEkle_.php" method="post">

<div class="form-group">
  <label for="komutadi">Komut Adı:</label>
  <input name="komutadi" value="" type="text" class="form-control" id="komutadi" required>
</div>

<div class="form-group">
  <label for="komutacikadi">Kısa Açıklama:</label>
  <input name="komutacikadi" value="" type="text" class="form-control" id="komutacikadi">
</div>

	
<div class="form-group">
  <label for="html">HTML:</label>
  <textarea name="html" class="form-control" rows="10" id="comment"></textarea>
</div>

<input type="hidden" name="kat_id" value="<?php echo $kat; ?>">
<button style="width: 100%;" type="submit" class="btn btn-default">Kaydet</button>
	
</form>	  		  		  