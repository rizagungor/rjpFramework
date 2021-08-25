<?php 
$k=$_GET['id'];
$pd=new rz_PDO();
$kmt=$pd->Sorgu("SELECT * FROM fr_komut where komut_id=$k"); 
$q1=$pd->Sorgu("SELECT * FROM fr_komuticerik where komut_id=$k and tur=1"); 
?>
<form action="yenikodDuzenle_.php" method="post">

<div class="form-group">
  <label for="komutadi">Komut Adı:</label>
  <input name="komutadi" value="<?php echo $kmt[0]['komutadi']; ?>" type="text" class="form-control" id="komutadi" required>
</div>

<div class="form-group">
  <label for="komutacikadi">Kısa Açıklama:</label>
  <input name="komutacikadi" value="<?php echo $kmt[0]['komutacikadi']; ?>" type="text" class="form-control" id="komutacikadi">
</div>

	
<div class="form-group">
  <label for="html">HTML:</label>
  <textarea name="html" class="form-control" rows="10" id="comment"><?php echo htmlentities(base64_decode($q1[0]['kod'])); ?></textarea>
</div>

<input type="hidden" name="id" value="<?php echo $k; ?>">
<button style="width: 100%;" type="submit" class="btn btn-default">Kaydet</button>
	
</form>	  		  		  