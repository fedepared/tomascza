<?
require_once("include/includes.php");
require_once("funcadmin.php");
$accion = $HttpVars->TraerGet('accion');

if ($accion == 'traersubcategorias') {
	$idcate = $HttpVars->TraerGet('idcate');
	$sql = "select id_subcate, nombre from tbl_subcategorias where id_cate = " . $idcate . " order by 1";
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		while(($db->FetchArray($result,&$myrow))) {
			$arraysubcategorias[] = array ('id' => $myrow["id_subcate"], 'subcategoria' => utf8_encode($myrow["nombre"]) );
		}
	}
	echo json_encode($arraysubcategorias);
}
if ($accion == 'traersubcategorias2') {
	$idcate = $HttpVars->TraerGet('idcate');
	$sql = "select id_subcate, nombre from tbl_subcategorias2 where id_cate = " . $idcate . " order by 1";
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		while(($db->FetchArray($result,&$myrow))) {
			$arraysubcategorias[] = array ('id' => $myrow["id_subcate"], 'subcategoria' => utf8_encode($myrow["nombre"]) );
		}
	}
	echo json_encode($arraysubcategorias);
}
 
if ($accion == 'traermodelo') {
	$idmarca = $HttpVars->TraerGet('idmarca');
	$sql = "select id_marca, marca from tbl_marca where id_modelo = " . $idmarca . " order by marca";
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		while(($db->FetchArray($result,&$myrow))) {
			$arraysubcategorias[] = array ('id' => $myrow["id_marca"], 'modelo' => utf8_encode($myrow["marca"]) );
		}
	}
	echo json_encode($arraysubcategorias);
} 
?>