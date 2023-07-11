<?

require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){

	header("Location: index.php");

}



$chk = $HttpVars->TraerPost('chkborrar');

$chkarray = split( ",", $chk);



for($i=0; $i < count($chkarray); $i++){

	$sql = "DELETE from tbl_general where id_general = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);

}



	header("Location:listadomodelos.php?borrado=1");

?>