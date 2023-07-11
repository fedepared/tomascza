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
$filename = $_FILES['imagenEmpresa']['name'];
if (!($filename==''))
{	
	$temporary_name = $_FILES['imagefile']['tmp_name'];
	$mimetype = $_FILES['imagefile']['type'];
	$filesize = $_FILES['imagefile']['size'];
	
	//Open the image using the imagecreatefrom..() command based on the MIME type.
	switch($mimetype) {
	case "image/jpg":
	case "image/jpeg":
	$i = imagecreatefromjpeg($temporary_name);
	break;
	case "image/gif":
	$i = imagecreatefromgif($temporary_name);
	break;
	case "image/png":
	$i = imagecreatefrompng($temporary_name);
	break;
	}
	
	//Delete the uploaded file
	unlink($temporary_name);
	
	//Save a copy of the original
	imagejpeg($i,"images/users/original".$_POST['IdUsuario'].".jpg",80);
	
	//Specify the size of the thumbnail
	$dest_x = 170;
	$dest_y = 145;
	
	//Is the original bigger than the thumbnail dimensions?
	if (imagesx($i) > $dest_x or imagesy($i) > $dest_y) {
	//Is the width of the original bigger than the height?
	if (imagesx($i) >= imagesy($i)) {
	$thumb_x = $dest_x;
	$thumb_y = imagesy($i)*($dest_x/imagesx($i));
	} else {
	$thumb_x = imagesx($i)*($dest_y/imagesy($i));
	$thumb_y = $dest_y;
	}
	} else {
	//Using the original dimensions
	$thumb_x = imagesx($i);
	$thumb_y = imagesy($i);
	}
	
	//Generate a new image at the size of the thumbnail
	$thumb = imagecreatetruecolor($thumb_x,$thumb_y);
	
	//Copy the original image data to it using resampling
	imagecopyresampled($thumb, $i ,0, 0, 0, 0, $thumb_x, $thumb_y, imagesx($i), imagesy($i));
	
	//Save the thumbnail
	imagejpeg($thumb, "images/users/galeria".$_POST['IdUsuario'].".jpg", 80);
	
	//Specify the size of the thumbnail
	$dest_x = 90;
	$dest_y = 70;
	
	//Is the original bigger than the thumbnail dimensions?
	if (imagesx($i) > $dest_x or imagesy($i) > $dest_y) {
	//Is the width of the original bigger than the height?
	if (imagesx($i) >= imagesy($i)) {
	$thumb_x = $dest_x;
	$thumb_y = imagesy($i)*($dest_x/imagesx($i));
	} else {
	$thumb_x = imagesx($i)*($dest_y/imagesy($i));
	$thumb_y = $dest_y;
	}
	} else {
	//Using the original dimensions
	$thumb_x = imagesx($i);
	$thumb_y = imagesy($i);
	}
	
	//Generate a new image at the size of the thumbnail
	$thumb = imagecreatetruecolor($thumb_x,$thumb_y);
	
	//Copy the original image data to it using resampling
	imagecopyresampled($thumb, $i ,0, 0, 0, 0, $thumb_x, $thumb_y, imagesx($i), imagesy($i));
	
	//Save the thumbnail
	imagejpeg($thumb, "images/users/thumbnail".$_POST['IdUsuario'].".jpg", 80);

}
$link=Conectarse();

$query3 ="";
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  empresa 
(
DESCRIPCION
,VISION
,MISION
,POLITICA
,IMAGEN
)

values ('".$_POST["DESCRIPCION"]."','".$_POST["VISION"]."','".$_POST["MISION"]."',
'".$_POST["POLITICA"]."','')";

}
else
{
	$query3="update   EMPRESA 
		set
		DESCRIPCION = '".$_POST["DESCRIPCION"]."'
		,MISION = '".$_POST["MISION"]."'		
		,VISION = '".$_POST["VISION"]."'
		,POLITICA = '".$_POST["POLITICA"]."'
		,IMAGEN = ''
		where id =".$_POST["ID"]." ";
	
}
mysql_query($query3) or die(mysql_error());

echo"<script language='javascript'>window.location='abmEmpresa.php'</script>;";
?>
