<?php
include_once("includes/authentication.php");
include_once("includes/funciones_bd.php");
include_once("includes/funciones.php");

$id 		   = $_POST["pac_id"];
$nombre        = utf8_encode($_POST["nombre"]);
$apellido      = utf8_encode($_POST["apellido"]);
$direccion     = utf8_encode($_POST["direccion"]);
$telefono      = utf8_encode($_POST["telefono"]);
$fecha_nac     = empty($_POST["fecha_nac"])? "NULL" : "'" . fechaCanonical($_POST["fecha_nac"]) . "'";
$edad          = $_POST["edad"];
$observaciones = utf8_encode($_POST["observaciones"]);
$prepaga 	   = utf8_encode($_POST["prepaga"]);

if($id != ""){
    $nombre_ant   = utf8_encode($_POST["nombre_ant"]);
    $apellido_ant = utf8_encode($_POST["apellido_ant"]);
    $mod = true;
}
else{
	$id = IdsDAO::getNextId("pacientes");
}

$basedir = "/home4/toma930/public_html/imagenes/";

if($mod){
	if(is_dir($basedir . $apellido_ant . "_" . $nombre_ant . "_" . $id)){
		@rename($basedir . $apellido_ant . "_" . $nombre_ant . "_" . $id, $basedir . $apellido. "_" . $nombre . "_" . $id);
	}
	else{
		mkdir($basedir . $apellido . "_" . $nombre . "_" . $id);
	}
    $sql = "UPDATE pacientes SET pac_nombre = '$nombre', pac_apellido = '$apellido',pac_direccion = '$direccion',pac_telefono = '$telefono',pac_edad = '$edad',pac_observaciones = '$observaciones', pac_prepaga = '$prepaga', pac_fechanac = $fecha_nac WHERE pac_id = $id";	
}
else{
    mkdir($basedir . $apellido . "_" . $nombre . "_" . $id);
    $sql = "INSERT INTO pacientes VALUES ($id, '$nombre', '$apellido', '$direccion', '$telefono', '$edad', '$observaciones', $medicoId, '$prepaga', $fecha_nac)";
}

// ACA CAMBIE
// Consulta::ejecutar($sql);
(new Consulta)->ejecutar($sql);

header("Location: pacientes.php");

?>
