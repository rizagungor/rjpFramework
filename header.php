    <div class="row">
    <div class="col-sm-3" style="background-color:#333;">Hoşgeldin <?php echo $klist[0]['adsoyad']; ?></div>
	<div class="col-sm-5" style="background-color:#333;"><a title="Home" href="index.php">RJP Framework <?php echo $klist[0]['projeadi']; ?></a> 
        <a style="float: right;" title="Refresh" onClick="location.reload();" class="btn btn-primary btn-flat"><i class="fa fa-refresh"></i></a>
    </div>
		<div class="col-sm-4" style="background-color:#333;">
			<?php if(isset($_GET['f'])){ ?>
            <a style="float: left;" title="Save" onClick="dosyakadet();" class="btn btn-default btn-flat"><i class="fa fa-hdd-o"></i></a>
			<a style="float: left;" title="Upload FTP this file" onClick="ftpkaydet();" class="btn btn-default btn-flat"><i class="fa fa-cloud-upload"></i></a>
            <?php } ?>
			<a style="float: right; margin-left: 20px;" href="<?php echo $logoutAction; ?>" class="btn btn-danger btn-flat">Exit</a>
            
            <!--<a style="float: right;" title="Git Push" onClick="github('p.bat');" class="btn btn-warning btn-flat"><i class="fa fa-cloud-upload"></i></a>-->
            <!--<a style="float: right;" title="Git Commit" onClick="github('git commit -am  \"<?php echo $_GET['f']; ?> Düzenleme\"');" class="btn btn-warning btn-flat"><i class="fa fa-hdd-o"></i></a>-->
            <a style="float: right;" title="Git Add Commit" onClick="github1();" class="btn btn-primary btn-flat"><i class="fa fa-hdd-o"></i></a>
            <input style="width: 100px; float: right;" type="text" id="commit" class="form-control" placeholder="Commit ->">
            <a style="float: right;" title="Git Pull" onClick="github('git pull'); location.reload();" class="btn btn-primary btn-flat"><i class="fa fa-cloud-download"></i></a>
            
            <?php $dircl=str_replace("\\",'/',$klist[0]['localfolder']); $dircl=$dircl."/".$klist[0]['projeadi'];
                 if(!is_dir($dircl)){ ?>
            <a style="float: right;" title="Git Clone project" onClick="github('git clone <?php echo $klist[0]['giturl'] ?>'); location.reload();" class="btn btn-warning btn-flat"><i class="fa fa-cloud-download"></i></a>
            <?php } ?>
               
        </div>
            
	</div>