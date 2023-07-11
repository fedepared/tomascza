<?

require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){

	header("Location: index.php");

}



$chk = $HttpVars->TraerPost('chkborrar');

$chkarray = split( ",", $chk);



for($i=0; $i < count($chkarray); $i++){

	$sql = "DELETE from tbl_suscriptos where id_suscripto = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);

}



	header("Location:listadosuscriptos.php?borrado=1");

?>