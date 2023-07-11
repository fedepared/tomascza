<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';
$link=Conectarse();
$query3 ="";
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  cirugia
(
CIRUGIA
,CODIGO
)

values ('".$_POST["TITULO"]."','".$_POST["CODIGO"]."')";

}
else
{
	$query3="update   cirugia 
		set
		CIRUGIA = '".$_POST["TITULO"]."'
		,CODIGO = '".$_POST["CODIGO"]."'
		where ID =".$_POST["ID"]." ";
	
}
mysql_query($query3) or die(mysql_error());

echo"<script language='javascript'>window.location='abmCirugias.php'</script>;";
?>
