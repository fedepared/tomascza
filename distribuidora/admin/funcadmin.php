<?

function comboTipoInmueble($db,$connection, $tipoinmueble = ""){
	$sql = "select id_tipoinmueble, tipoinmueble from tbl_tipoinmueble order by id_tipoinmueble";
	$result = $db->Query($sql,$connection);
	$combo = "";
	$combo.= "<select name='cmbtipoinmueble' id='cmbtipoinmueble' class='combo'>" . NL;
	while(($db->FetchArray($result,&$myrow))) {
		$strselected = "";
		if($myrow['id_tipoinmueble'] == $tipoinmueble) {
			$strselected = " selected ";
		}
		$combo.= "<option ".$strselected." value=".$myrow['id_tipoinmueble'].">".$myrow['tipoinmueble']."</option>" . NL;
	}
	$combo.= "</select>" . NL;
	return ($combo);
}

function comboTipoOperacion($db,$connection,$tipooperacion = ""){
	$sql = "select id_tipooperacion, operacion from tbl_operacion order by id_tipooperacion";
	$result = $db->Query($sql,$connection);
	$combo = "";
	$combo.= "<select name='cmboperacion' id='cmboperacion' class='combo'>" . NL;
	while(($db->FetchArray($result,&$myrow))) {
		$strselected = "";
		if($myrow['id_tipooperacion'] == $tipooperacion) {
			$strselected = " selected ";
		}	
	$combo.= "<option ".$strselected." value=".$myrow['id_tipooperacion'].">".$myrow['operacion']."</option>" . NL;
	}
	$combo.= "</select>" . NL;
	return ($combo);
}

function comboZonasBuscador($db,$connection){
	$sql = "select id_zona, zona from tbl_zonas order by orden";
	$result = $db->Query($sql,$connection);
	$combo = "";
	$combo.= "<select name='cmbzonas' id='cmbzonas' class='combo'>" . NL;
	$combo.= "<option value='0'>Todas las zonas</option>" . NL;
	$cont = 1;
	while(($db->FetchArray($result,&$myrow))) {
		if($cont < 6) {
			$combo.= "<option class='zonas1' value=".$myrow['id_zona'].">".$myrow['zona']."</option>" . NL;
		}else{
			$combo.= "<option class='zonas2' value=".$myrow['id_zona'].">".$myrow['zona']."</option>" . NL;
		}
		$cont++;
	}
	$combo.= "</select>" . NL;
	return ($combo);
}

function comboZonas($db,$connection){
	$sql = "select id_zona, zona from tbl_zonas order by orden";
	$result = $db->Query($sql,$connection);
	$combo = "";
	$combo.= "<select name='cmbzonas' id='cmbzonas' class='combo'>" . NL;
	$cont = 1;
	while(($db->FetchArray($result,&$myrow))) {
		if($cont < 6) {
			$combo.= "<option class='zonas1' value=".$myrow['id_zona'].">".$myrow['zona']."</option>" . NL;
		}else{
			$combo.= "<option class='zonas2' value=".$myrow['id_zona'].">".$myrow['zona']."</option>" . NL;
		}
		$cont++;
	}
	$combo.= "</select>" . NL;
	return ($combo);
}

function comboLocalidad($db,$connection){
	$sql = "select id_localidad, localidad from tbl_localidad order by localidad";
	$result = $db->Query($sql,$connection);
	$combo = "";
	$combo.= "<select name='cmblocalidad' id='cmblocalidad' class='combo'>" . NL;
	$combo.= "<option value=0>Todas las localidades</option>" . NL;
	while(($db->FetchArray($result,&$myrow))) {
		$combo.= "<option value=".$myrow['id_localidad'].">".$myrow['localidad']."</option>" . NL;
	}
	$combo.= "</select>" . NL;
	return ($combo);
}

function comboPartido($db,$connection){
	$sql = "select id_partido, partido from tbl_partido order by partido";
	$result = $db->Query($sql,$connection);
	$combo = "";
	$combo.= "<select name='cmbpartido' id='cmbpartido' class='combo'>" . NL;
	$combo.= "<option value=0>Todas las localidades</option>" . NL;
	while(($db->FetchArray($result,&$myrow))) {
		$combo.= "<option value=".$myrow['id_partido'].">".$myrow['partido']."</option>" . NL;
	}
	$combo.= "</select>" . NL;
	return ($combo);
}




?>