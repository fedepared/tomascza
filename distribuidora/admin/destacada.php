<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
if ($HttpVars->TraerGet('id_nota') != '') { 
	$id_nota = $HttpVars->TraerGet('id_nota') ;
}
	$sql="update tbl_notas set destacada = 0";
	$result = $db->Query($sql,$connection);
	$sql="update tbl_notas set destacada = 1 where id_nota = ".$id_nota;
	$result = $db->Query($sql,$connection);
	header("Location:listadonotas.php");
?>