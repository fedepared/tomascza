<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';


// Get the details of "imagefile"
/*
$filename = $_FILES['imagenSlider']['name'];
if (!($filename==''))
{	
	$uploaddir = '../slider/';
	$uploadfile =$uploaddir . basename($_FILES['imagenSlider']['name']);
	
	echo '<pre>';
	if (move_uploaded_file($_FILES['imagenSlider']['tmp_name'], $uploadfile)) {
	    echo "El archivo es válido y fue cargado exitosamente.\n";
	} else {
	    echo "¡Posible ataque de carga de archivos!\n";
	}
	
}*/

$link=Conectarse();
$query3 = 	"insert into  videos 
(
video
,enlace
,epigrafe

)

values ('".$_POST["TITULO"]."','".$_POST["ENLACE"]."','".$_POST["EPIGRAFE"]."')";
mysql_query($query3) or die(mysql_error());
echo"<script language='javascript'>window.location='abmVideos.php'</script>;";
?>
