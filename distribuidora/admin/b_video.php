<?
require_once("include/includes.php");
if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$chk = $HttpVars->TraerPost('chkborrar');
$chkarray = split( ",", $chk);

for($i=0; $i < count($chkarray); $i++){
	$sql = "DELETE from tbl_videos where id_video = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);
}

header("Location:listadovideos.php?borrado=1");
?>