<?
require_once("include/includes.php");
if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$chk = $HttpVars->TraerPost('chkborrar');
$chkarray = split( ",", $chk);

for($i=0; $i < count($chkarray); $i++){
	$sql = "UPDATE tbl_productos set borrado = 1 where id_prod = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);
}

header("Location:listadoproductosp.php?borrado=1");
?>