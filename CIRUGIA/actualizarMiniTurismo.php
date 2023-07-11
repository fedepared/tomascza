<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';
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
$filename = $_FILES['imagefile']['name'];
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
	$dest_x = 180;
	$dest_y = 252;
	
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
	$query3 = "insert into  menu_categorias (categoria,descripcion,imagen,estado,orden,root,padre,CD_MINITURISMO) 
			values ('".$_POST["PRO_CODIGO"]."','".$_POST["PRO_DESCRIPCION"]."','',1,
			".$_POST["PRO_CANTIDAD_DISPONIBLE"].",".$_POST["root"].",".$_POST["padre"].",1)";	
}
else 
{
	$query3="update   menu_categorias 
		set categoria ='".$_POST["PRO_CODIGO"]."'
		,descripcion = '".$_POST["PRO_DESCRIPCION"]."'
		,imagen = ''		
		,orden = ".$_POST["PRO_CANTIDAD_DISPONIBLE"]."
		,CD_MINITURISMO= 1
		where id = ".$_POST["ID"]."";
	
}
echo $query3;
mysql_query($query3) or die(mysql_error());


if ($_POST["root"]=="1") 
	echo"<script language='javascript'>window.location='Mini-Turista.php'</script>;";
else 
	echo"<script language='javascript'>window.location='newMini-Turismo.php?md=".$_POST["padre"]."'</script>;";
?>
