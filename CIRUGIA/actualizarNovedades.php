<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';
$link=Conectarse();

$query3 ="";
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  novedades 
(
DESCRIPCION_COMPLETA
,PRINCIPAL
,fecha 
)

values ('".$_POST["DESCRIPCION"]."','".$_POST["PRINCIPAL"]."',CURRENT_TIMESTAMP)";

}
else
{
	$query3="update   novedades 
		set
		DESCRIPCION_COMPLETA = '".$_POST["DESCRIPCION"]."'
		,PRINCIPAL = ".$_POST["PRINCIPAL"]."
		,fecha =CURRENT_TIMESTAMP 		
		
		where id =".$_POST["ID"]." ";
	
}
mysql_query($query3) or die(mysql_error());

echo"<script language='javascript'>window.location='abmNovedades.php'</script>;";
?>
