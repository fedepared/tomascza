<?php
include_once("includes/authentication.php");
include_once("includes/funciones_bd.php");

$letra = $_GET["letra"];
?>

<html>
	<head>
		<link href="includes/estilos.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php if($_GET["a"] == "e"){ echo("<div align=\"center\"><p><h3><font color=\"red\">Paciente eliminado</font></h3></p></div>"); } ?>
		<p><a href="frm_pacientes.php">Cargar nuevo paciente</a></p>
		<p><?php foreach(range("a", "z") as $s){ ?>&nbsp;<a href="pacientes.php?letra=<?php echo($s); ?>"><?php echo($s); ?></a>&nbsp;<?php } ?></p>
		<table>
			<thead>
	    		<tr>
	    			<td>Apellido</td>
	    			<td>Nombre</td>
	    			<td>Prepaga</td>
	    			<td>Ocupaci�n</td>
	    			<td>Telefono</td>
	    			<td>Edad</td>
	    			<td>Accion</td>
	    		</tr>
			</thead>
			<tbody>
				<?php
					$sql = "
						SELECT 
							*
						FROM 
							pacientes 
						WHERE
							pac_med_id = $medicoId ";
					
					if(!empty($letra)){ $sql .= "AND SUBSTR(LOWER(pac_apellido), 1, 1) = '$letra' "; }

					$sql .= "
						ORDER BY 
							pac_apellido, 
							pac_nombre";
					
					// echo("<p>$sql</p>");
				
					$datos = Consulta::traer($sql);
		
					while($fila = pg_fetch_array($datos, NULL, PGSQL_ASSOC)){
		    			$id        = $fila["pac_id"];
		    			$nombre    = utf8_decode($fila["pac_nombre"]);
		    			$apellido  = utf8_decode($fila["pac_apellido"]);
						$prepaga   = utf8_decode($fila["pac_prepaga"]);
		    			$telefono  = utf8_decode($fila["pac_telefono"]);
		    			$ocupacion = utf8_decode($fila["pac_direccion"]);
		    			$email 	   = $fila["pac_edad"];
		    			    			
		    			echo("
		    				<tr>
		    					<td>$apellido</td>
		    					<td>$nombre</td>
		    					<td>$prepaga</td>
		    					<td>$ocupacion</td>
		    					<td>$telefono</td>
		    					<td>$email</td>
		    					<td colspan='2'><a href=\"frm_pacientes.php?id=$id\">Modificar</a> | <a href=\"pacientes_eliminar.php?id=$id&nombre=$nombre&apellido=$apellido\">Eliminar</a></td>
		    				</tr>
		    			");
					}
				?>
			</tbody>
		</table>
	</body>
</html>
