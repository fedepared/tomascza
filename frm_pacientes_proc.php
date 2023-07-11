<?php
include_once("includes/authentication.php");
include_once("includes/funciones_bd.php");
include_once("includes/funciones.php");


$id 		   = $_POST["pac_id"];
//ACA SE CAMBIO
// $nombre        = mb_convert_encoding($_POST["nombre"], "utf8");
// $apellido      = mb_convert_encoding($_POST["apellido"], "utf8");
// $direccion     = mb_convert_encoding($_POST["direccion"], "utf8");
// $telefono      = mb_convert_encoding($_POST["telefono"], "utf8");
// $fecha_nac     = empty($_POST["fecha_nac"])? "NULL" : "'" . fechaCanonical($_POST["fecha_nac"]) . "'";
// $edad          = $_POST["edad"];
// $observaciones = mb_convert_encoding($_POST["observaciones"], "utf8");;
// $prepaga 	   = mb_convert_encoding($_POST["prepaga"], "utf8");

// if($id != ""){
//     $nombre_ant   = mb_convert_encoding($_POST["nombre_ant"], "utf8");
//     $apellido_ant = mb_convert_encoding($_POST["apellido_ant"], "utf8");
//     $mod = true;
// }
$nombre        = mb_convert_encoding($_POST["nombre"], "UTF-8");
$apellido      = mb_convert_encoding($_POST["apellido"], "UTF-8");
$direccion     = mb_convert_encoding($_POST["direccion"], "UTF-8");
$telefono      = mb_convert_encoding($_POST["telefono"], "UTF-8");
$fecha_nac     = empty($_POST["fecha_nac"])? "NULL" : "'" . fechaCanonical($_POST["fecha_nac"]) . "'";
$edad          = $_POST["edad"];
$observaciones = mb_convert_encoding($_POST["observaciones"], "UTF-8");;
$prepaga 	   = mb_convert_encoding($_POST["prepaga"], "UTF-8");

if($id != ""){
    $nombre_ant   = mb_convert_encoding($_POST["nombre_ant"], "UTF-8");
    $apellido_ant = mb_convert_encoding($_POST["apellido_ant"], "UTF-8");
    $mod = true;
}
else{
	//ACA SE CAMBIO
	$id = IdsDAO::getNextId("pacientes");
	//$id = (new IdsDAO)->getNextId("pacientes");
}

//ACA SE CAMBIO
$basedir = "/home4/toma930/public_html/imagenes/";
//$basedir = "imagenes/";

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

// ACA SE CAMBIO
Consulta::ejecutar($sql);
//(new consulta)->ejecutar($sql);

// ACA SE CAMBIO : SE COMENTO ESTA LINEA
header("Location: pacientes.php");

?>
