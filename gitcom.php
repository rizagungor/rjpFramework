<?php 
if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");
$pd=new rz_PDO();
$klist=$pd->Sorgu("SELECT * FROM kullanici where kadi='".$_SESSION['MM_Username']."' and sifre='".$_SESSION['MM_Password']."'"); 
$dir=str_replace("\\",'/',$klist[0]['localfolder'])."/".$klist[0]['projeadi'];

$command=$_POST['command'];

function execPrint($command) {
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "\n");
    }
}
// Print the exec output inside of a pre element
//execPrint("git pull https://user:password@bitbucket.org/user/repo.git master");
//$cmd="cd $dir & git checkout -b \"".$klist[0]['gitbranch']."\" & git checkout \"".$klist[0]['gitbranch']."\" & git config --global user.email ".$klist[0]['gituser']." & git remote add origin ".$klist[0]['giturl']." & git config --global user.name ".$klist[0]['gitbranch']." & $command & git status";
if(strstr($command,"clone")){
    $cmd="cd .. & $command & git status";
}elseif(strstr($command,"pull")){
    $cmd="cd $dir & git checkout master & git config --global user.email ".$klist[0]['gituser']." & git remote add origin ".$klist[0]['giturl']." & git config --global user.name ".$klist[0]['gitbranch']." & git pull & git add . & git status";
}else{
    $cmd="cd $dir & git checkout master & git add . & git config --global user.email ".$klist[0]['gituser']." & git remote add origin ".$klist[0]['giturl']." & git config --global user.name ".$klist[0]['gitbranch']." & $command & git status";
}
execPrint($cmd);

if($command=="p.bat"){exec($command);}

//execPrint("cd $dir & $command");	execPrint("cd $dir & git status ");	




$dir=str_replace("\\",'/',$klist[0]['localfolder']); $dir=$dir."/"."framework"."/";
$file="p.bat";
$dirfile=$dir.$file;
$prgad=$klist[0]['projeadi'];
$giturl=$klist[0]['giturl'];
$code="cd c:\\wamp\\www\\$prgad \n
git remote add origin $giturl \n
git push -u origin master \n
cd c:\\wamp\\www\\framework ";
chmod($dirfile,0777);
$myfile = fopen($dirfile, "w") or die("Unable to open file!");
$txt = $result=remove_utf8_bom($code);
fwrite($myfile, $txt);
fclose($myfile);
chmod($dirfile,0644);

function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}
?>
