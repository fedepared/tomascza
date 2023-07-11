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
$destacad = (($_POST["destacado"]==true)?1:0);
$filename = $_FILES['imagenProd']['name'];
if (!($filename==''))
{	
	$filename = $_POST["PRO_CODIGO"].$filename;
	$temporary_name = $_FILES['imagenProd']['tmp_name'];
	$mimetype = $_FILES['imagenProd']['type'];
	$filesize = $_FILES['imagenProd']['size'];
	
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
	imagejpeg($i,"../images/producto/original".$filename,80);
	
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
	imagejpeg($thumb, "../images/producto/tendencia/".$filename, 80);

	//Specify the size of the thumbnail
	$dest_x = 140;
	$dest_y = 159;
	
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
	imagejpeg($thumb, "../images/producto/liquidacion/".$filename, 80);
	
	
	//Specify the size of the thumbnail
	$dest_x = 75;
	$dest_y = 110;
	
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
	imagejpeg($thumb, "../images/producto/carrito/".$filename, 80);


}
else 
	$filename=$_POST["foto1"];
$link=Conectarse();

$query3 ="";
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  productos 
(ID_MENU_CATEGORIA
,CODIGO
,TITULO
,DESCRIPCION
,DESTACADO
,FOTO_CHICA
,MOSTRAR
,ESTADO


)

values ('".$_POST["padre"]."','".$_POST["PRO_CODIGO"]."','".$_POST["TITULO"]."',
'".$_POST["DESCRIPCION"]."',".$destacad.",'".$filename."',1,1)";

}
else
{
	$query3="update   productos 
		set 
		CODIGO = '".$_POST["PRO_CODIGO"]."'
		,TITULO = '".$_POST["TITULO"]."'
		,DESCRIPCION= '".$_POST["DESCRIPCION"]."'
		,DESTACADO = ".$destacad."		
		,FOTO_CHICA = '".$filename."'
		,MOSTRAR = 1
		,ESTADO = 1
		where id =".$_POST["ID"]." ";
	
}
echo $qry;

mysql_query($query3) or die(mysql_error());

//echo"<script language='javascript'>window.location='newMini-Turismo.php?md=".$_POST["padre"]."'</script>;";
?>
