<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
include_once 'class/conexion.php';
$link=Conectarse();
$query3 ="";
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  contacto
(
CLINICA
,MAIL1
,MAIL2
,MAIL3
,MAIL4
)

values (".$_POST["clinica"].",'".$_POST["MAIL1"]."','".$_POST["MAIL2"]."','".$_POST["MAIL3"]."','".$_POST["MAIL4"]."')";

}
else
{
	$query3="update   contacto 
		set
		CLINICA = ".$_POST["clinica"]."
		,MAIL1 = '".$_POST["MAIL1"]."'
		,MAIL2 = '".$_POST["MAIL2"]."'
		,MAIL3 = '".$_POST["MAIL3"]."'
		,MAIL4 = '".$_POST["MAIL4"]."'
		where ID =".$_POST["ID"]." ";
	
}
mysql_query($query3) or die(mysql_error());

echo"<script language='javascript'>window.location='abmContacto.php'</script>;";
?>
