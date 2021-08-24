
<?php if($login){ ?>
<?php  $dir=str_replace("\\",'/',$klist[0]['localfolder']); echo $dir=$dir."/".$klist[0]['projeadi'];
                 if(is_dir($dir)){
	$files = scandir($dir); sort($files);
foreach($files as $key =>$val){ if($val=="."||$val==".."||$val==".git"||$val=="README.md"){}else{ ?>
<div>
	  <a style="float: left; padding-right: 10px;" href="index.php?f=<?php echo $val; ?>"><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $val; ?></a><br>
</div><?php }} ?>
<?php }else{echo "<br><br>Klasör Bulunamadı<br>Proje clone yapılmalı.";}
                } ?>