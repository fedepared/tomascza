
<?php
include_once("includes/authentication.php");
include_once("includes/funciones_bd.php");
include_once("includes/funciones.php");


/*traigo datos de la db*/
$nombre        = "";
$apellido      = "";
$fecha_nac     = "";
$edad          = "";
$observaciones = "";
$prepaga       = "";

if($_GET["id"] != ""){
	$mod = true;
    $id = $_GET["id"];
    
    $sql   = "SELECT * FROM pacientes WHERE pac_id = $id";
    //ACA SE CAMBIO
	$datos = Consulta::traer($sql);
	//$datos = (new Consulta)->traer($sql);
    $fila  = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
    
    $nombre        = utf8_decode($fila["pac_nombre"]);
    $apellido      = utf8_decode($fila["pac_apellido"]);
    $edad          = empty($fila["pac_fechanac"])? $fila["pac_edad"] : calculaedad($fila["pac_fechanac"]);
    $observaciones = utf8_decode($fila["pac_observaciones"]) . "\r" . date("d-m-y") ;	
    $prepaga       = utf8_decode($fila["pac_prepaga"]);
	// $nombre        = mb_convert_encoding($fila["pac_nombre"],'UTF-8','ISO-8859-1');
    // $apellido      = mb_convert_encoding($fila["pac_apellido"],'UTF-8','ISO-8859-1');
    // $edad          = empty($fila["pac_fechanac"])? $fila["pac_edad"] : calculaedad($fila["pac_fechanac"]);
    // $observaciones = mb_convert_encoding($fila["pac_observaciones"],'UTF-8','ISO-8859-1');
    // $prepaga       = mb_convert_encoding($fila["pac_prepaga"],'UTF-8','ISO-8859-1');
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
        <div>
            <h2>Nombre:<?php echo($nombre) ?> <?php echo($apellido) ?></h2>
            <h2>Edad:<?php echo($edad) ?></h2>
            <h3>Observaciones:</h3><p><?php echo($observaciones) ?></p>
        </div>
        <form method="post" action="/includes/upload_images.php" enctype="multipart/form-data">
    		<input type="hidden" name="pac_id" value="<?php echo($id) ?>" />
    		<input type="hidden" name="nombre" value="<?php echo($nombre) ?>" />
    		<input type="hidden" name="apellido" value="<?php echo($apellido) ?>" />
			<input type="file" multiple id="files" name="files[]"/>
            <button type="submit">subir imagenes</button>
        </form>
	</body>
</html>
