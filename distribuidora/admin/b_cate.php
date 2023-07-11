<?

require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){

	header("Location: index.php");

}



$chk = $HttpVars->TraerPost('chkborrar');

$chkarray = split( ",", $chk);



for($i=0; $i < count($chkarray); $i++){

	$sql = "DELETE from tbl_categorias where id_cate = ".$chkarray[$i]."";
$sql = "DELETE from tbl_categorias where id_cate = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);

}



	header("Location:listadocategorias.php?borrado=1");

?>