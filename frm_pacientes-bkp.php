<?php
include_once("includes/authentication.php");
include_once("includes/funciones_bd.php");
include_once("includes/funciones.php");

$nombre        = "";
$apellido      = "";
$direccion     = "";
$telefono      = "";
$fecha_nac     = "";
$edad          = "";
$observaciones = date("d-m-y");
$prepaga       = "";
	
if($_GET["id"] != ""){
	$mod = true;
    $id = $_GET["id"];
    
    $sql   = "SELECT * FROM pacientes WHERE pac_id = $id";
    $datos = Consulta::traer($sql);
    $fila  = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
    
    $nombre        = utf8_decode($fila["pac_nombre"]);
    $apellido      = utf8_decode($fila["pac_apellido"]);
    $direccion     = utf8_decode($fila["pac_direccion"]);
    $telefono      = utf8_decode($fila["pac_telefono"]);
    $fecha_nac     = empty($fila["pac_fechanac"])? "" : fechaEU($fila["pac_fechanac"]);
    $edad          = $fila["pac_edad"];
    $observaciones = utf8_decode($fila["pac_observaciones"]) . "\r" . date("d-m-y") ;	
    $prepaga       = utf8_decode($fila["pac_prepaga"]);
}
?>

<html>
	<head>
		<link href="includes/estilos.css" rel="stylesheet" type="text/css">
		<link href="jquery/jquery-ui/css/custom-theme/jquery-ui.css" rel="stylesheet" type="text/css">
		
		<script language="javascript" type="text/javascript" src="jquery/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="jquery/jquery-ui/js/jquery-ui.min.js"></script>
		
		<script language="javascript" type="text/javascript">
		$(document).ready(function(){
			var oDate   = new Date();
			var iYearTo = oDate.getFullYear();
			
		 	$("#fecha_nac").datepicker({
				showOn:          "button",
				buttonImage:     "calendar.gif",
				dateFormat:      "dd/mm/yy",
				buttonImageOnly: true,
				dayNamesMin:     ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
				monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
				changeMonth:	 true,
				changeYear: 	 true,
				yearRange: 		 "1920:" + iYearTo
			});
		})
</script>
	</head>
	<body>
    	<form method="post" action="frm_pacientes_proc.php">
    		<input type="hidden" name="pac_id" value="<?php echo($id) ?>" />
    		<input type="hidden" name="nombre_ant" value="<?php echo($nombre) ?>" />
    		<input type="hidden" name="apellido_ant" value="<?php echo($apellido) ?>" />
        	<table>
            	<tr><td>Nombre:</td><td><input type="text" name="nombre" id="nombre" size="30" value="<?php echo($nombre) ?>" /></td></tr>
            	<tr><td>Apellido:</td><td><input type="text" name="apellido" id="apellido" size="30"  value="<?php echo($apellido) ?>" /></td></tr>
				<tr><td>Prepaga:</td><td><input type="text" name="prepaga" id="prepaga" size="30"  value="<?php echo($prepaga) ?>" /></td></tr>
            	<tr><td>Ocupación:</td><td><input type="text" name="direccion" id="direccion" size="60"  value="<?php echo($direccion) ?>" /></td></tr>
            	<tr><td>Teléfono:</td><td><input type="text" name="telefono" id="telefono" size="30" value="<?php echo($telefono) ?>"  /></td></tr>
            	<tr><td>Fecha de nacimiento:</td><td><input type="text" name="fecha_nac" id="fecha_nac" size="10" value="<?php echo($fecha_nac) ?>" readonly /></td></tr>
            	<tr><td>Edad:</td><td><input type="text" name="edad" id="edad" size="30" value="<?php echo($edad) ?>"  /></td></tr>
            	<tr><td colspan="2">Observaciones:<br><textarea name="observaciones" id="observaciones" cols="100" rows="20"><?php echo($observaciones) ?></textarea></td></tr>
            	<tr><td colspan="2"><input type="submit" value="Guardar" /></td></tr>
        	</table>
    	</form>    
    	<?php
    	if($mod){ 
			$dir = "imagenes/". $apellido . "_" . $nombre . "_" . $id;
			if(is_dir($dir)){		
				echo("<div align=\"center\">"); 
				$d = dir($dir);
				while (false !== ($entry = $d->read()) ) {
					if($entry != ".." && $entry != "."){
						echo("<a href=\"$dir/$entry\" target=\"_blank\"><img border=\"0\" src=\"$dir/$entry\" width=\"800\" /></a><br /><br />");
					}
				}
				$d->close();
				echo("</div>");
			}
    	}
    	?> 
	</body>
</html>
