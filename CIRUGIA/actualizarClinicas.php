<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';
$link=Conectarse();
$query3 ="";
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  clinica 
(
CLINICA
)

values ('".$_POST["TITULO"]."')";

}
else
{
	$query3="update   clinica 
		set
		CLINICA = '".$_POST["TITULO"]."'
		where ID =".$_POST["ID"]." ";
	
}
mysql_query($query3) or die(mysql_error());

echo"<script language='javascript'>window.location='abmClinicas.php'</script>;";
?>
