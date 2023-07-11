<?php
include_once("includes/funciones_bd.php");

$submit   = $_POST["submit"];
$username = $_POST["username"];
$password = $_POST["password"];

if($submit == "true"){
	$sql   = "SELECT * FROM medicos WHERE med_username = '$username' AND med_password = '$password'";

    //ACA SE CAMBIO
	$datos = Consulta::traer($sql); 
	//$datos = (new Consulta)->traer($sql);
    $fila  = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
    
    if($fila){
    	session_start();
    	$_SESSION["medicoId"] = $fila["med_id"]; 
    	header("location: pacientes.php");
    	die();
    }
}
?>

<html>
	<head>
		<link href="includes/estilos.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    	<form method="post" action="">
    		<input type="hidden" name="submit" value="true" />
        	<table>
        		<?php if($submit == "true"){ ?><tr><td colspan="2" align="center"><b>El username no existe o el password es incorrect</b></td></tr><?php } ?>
            	<tr><td>Username:</td><td><input type="text" name="username" id="username" size="30" value="<?php echo($username) ?>" /></td></tr>
            	<tr><td>Password:</td><td><input type="password" name="password" id="password" size="30"  value="<?php echo($password) ?>" /></td></tr>
            	<tr><td></td><td><input type="submit" value="Ingresar" /></td></tr>
        	</table>
    	</form>
	</body>
</html>
