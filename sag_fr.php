<div>

  <ul class="nav nav-pills">
	  <?php 
	$pd=new rz_PDO(); $say=0;
        
	$katlist=$pd->Sorgu("SELECT * FROM fr_kat where seviye<".$klist[0]['seviye_id']."");
	  foreach ($katlist as $key){ $say++;
		  if($say==1){
	?>
    <li class="active"><a data-toggle="pill" href="#kk<?php echo $key['kat_id']; ?>"><?php echo $key['kat_adi']; ?></a></li>
	  <?php }else{ ?>
    <li><a data-toggle="pill" href="#kk<?php echo $key['kat_id']; ?>"><?php echo $key['kat_adi']; ?></a></li>
	  <?php }} ?>
  </ul>
  <div class="tab-content">

	  <?php 
	$pd=new rz_PDO(); $say=0;
	$katlist=$pd->Sorgu("SELECT * FROM fr_kat where seviye<".$klist[0]['seviye_id']."");
	  foreach ($katlist as $key){ $say++;
	?>
	<div id="kk<?php echo $key['kat_id']; ?>" class="tab-pane fade <?php if($say==1){ echo "in active";} ?>">
        <p>
			<a href="yenikodEkle.php?kat=<?php echo $key['kat_id']; ?>"><i class="glyphicon glyphicon-plus-sign"></i></a><br><br>
				
			<?php 
						$pd=new rz_PDO(); $sayi=0;
						$katlisti=$pd->Sorgu("SELECT * FROM fr_komut where kat_id='$key[kat_id]'");
						  foreach ($katlisti as $keyi){ $sayi++;
						?>
				<div>
				<a title="<?php echo htmlentities($keyi['komutadi']); ?>" style="cursor: pointer;"><?php echo htmlentities($keyi['komutadi']); ?></a>
					<!--<a style="cursor: pointer;" onClick="kodEkle('kid','html')" title="HTML5"><img src="img/html5.png" style="height: 20px;"></a>
					<a style="cursor: pointer;" onClick="kodEkle('kid','js')" title="JS"><img src="img/js.png" style="height: 20px;"></a>
					<a style="cursor: pointer;" onClick="kodEkle('kid','css')" title="CSS"><img src="img/css.png" style="height: 20px;"></a>-->
					<?php if($keyi['html']==1){ ?>
					<a style="cursor: pointer;" onClick="kodEkle('<?php echo $keyi["komut_id"]; ?>','html')" title="HTML5"><img src="img/html5.png" style="height: 20px;"></a><?php } ?>
					
				<a href="yenikodSil.php?id=<?php echo $keyi["komut_id"]; ?>" style="cursor: pointer; float: right;" title="Delete this code"><span class="	glyphicon glyphicon-trash"></span> &nbsp;</a>
				<a href="yenikodDuzenle.php?id=<?php echo $keyi["komut_id"]; ?>" style="cursor: pointer; float: right; padding-right: 25px;" title="Edit this code"><span class="glyphicon glyphicon-edit"></span> &nbsp;</a>	
			</div>
		<?php } ?>
		</p>
    </div> 
	<?php } ?>
	
	
  </div>
</div>





