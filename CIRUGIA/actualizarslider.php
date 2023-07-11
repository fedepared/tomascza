<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';
//include "res/imemail.inc.php";
//para la web
/*
$host="localhost";
$usuario="root";
$pass="";
$base="abogados";	
$conexion = mysql_connect($host,$usuario,$pass);
mysql_select_db($base,$conexion);
*/


// Get the details of "imagefile"
$filename = $_FILES['imagenSlider']['name'];
if (!($filename==''))
{	
	$uploaddir = '../slider/';
	$uploadfile =$uploaddir . basename($_FILES['imagenSlider']['name']);
	
	echo '<pre>';
	if (move_uploaded_file($_FILES['imagenSlider']['tmp_name'], $uploadfile)) {
	    echo "El archivo es valido y fue cargado exitosamente.\n";
	} else {
	    echo "�Posible ataque de carga de archivos!\n";
	}
	
}

$link=Conectarse();


$query3 = 	"insert into  sliders 
(
slider
,descripcion
,mensaje_link
,imagen

)

values ('".$_POST["TITULO"]."','".$_POST["DESCRIPCION"]."','".$_POST["LINK"]."','".$filename."')";
mysql_query($query3) or die(mysql_error());
echo"<script language='javascript'>window.location='abmSliders.php'</script>;";
?>
