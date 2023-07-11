<?php
session_start();
//datos para establecer la conexion con la base de mysql.
/*
mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db('abogados')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
*/
//conexion para web

mysql_connect('localhost','abogadox_web','abogadosdema')or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db('abogadox_web')or die ('Error al seleccionar la Base de Datos: '.mysql_error());

function quitar($mensaje)
{
	$nopermitidos = array("'",'\\','<','>',"\"");
	$mensaje = str_replace($nopermitidos, "", $mensaje);
	return $mensaje;
}
 
if(trim($_POST["usuario"]) != "" && trim($_POST["password"]) != "")
{
	// Puedes utilizar la funcion para eliminar algun caracter en especifico
	//$usuario = strtolower(quitar($HTTP_POST_VARS["usuario"]));
	//$password = $HTTP_POST_VARS["password"];
	// o puedes convertir los a su entidad HTML aplicable con htmlentities
	$usuario = strtolower(htmlentities($_POST["usuario"], ENT_QUOTES));
	$password = $_POST["password"];
	$result = mysql_query('SELECT ds_password, ds_usuario,id_usuario,IFNULL((select "panel_usuarios_preguntas.php" from tbl_cliente where id_usuario = tbl_usuario.id_usuario), (select "panel_abogados.php" from tbl_abogados where id_usuario = tbl_usuario.id_usuario)) as panel FROM tbl_usuario WHERE cd_estado = 1 and ds_mail=\''.$usuario.'\'');
	$row = mysql_fetch_array($result);	
	if($row ){
		if($row["ds_password"] == $password){
			$_SESSION["k_username"] = $row['ds_usuario'];
			$_SESSION["k_userId"] = $row['id_usuario'];
			$_SESSION["k_panel"] = $row['panel'];
			if ('panel_abogados.php'==$row['panel'])
						echo"<script language='javascript'>window.location='".$row['panel']."'</script>;";
			else
						echo"<script language='javascript'>window.location='index.php '</script>;";
			
		}else{
			echo 'Password incorrecto';
		}
	}else{
		echo 'Usuario no existente en la base de datos';
	}
	mysql_free_result($result);
}else{
	echo 'Debe especificar un usuario y password';
}
mysql_close();
?>