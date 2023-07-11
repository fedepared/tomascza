                                                                   <?

require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){

	header("Location: index.php");

}



$chk = $HttpVars->TraerPost('chkborrar');

$chkarray = split( ",", $chk);



for($i=0; $i < count($chkarray); $i++){

	$sql = "DELETE from tbl_clientes where id_clie = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);

}



	header("Location:listadoclientes.php?borrado=1");

?>