<?
require_once("include/includes.php");
if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$chk = $HttpVars->TraerPost('chkborrar');
$chkarray = split( ",", $chk);

for($i=0; $i < count($chkarray); $i++){
	$sql = "DELETE from tbl_notas where id_nota = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);
}

header("Location:listadonotas.php?borrado=1");
?>