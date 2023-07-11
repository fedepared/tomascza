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


$link=Conectarse();
$Pagado =0;
if (isset($_POST["destacado"]))
$Pagado = (($_POST["destacado"]==true)?1:0);

$fecha=str_replace("-", "/", $_POST["f_rangeStart"]);



$query3 ="";
if ($_POST["ID"]=='0' || $_POST["ID"]=='')
{
$query3 = 	"insert into  paciente_hc 
(ID_PACIENTE
,FECHA_CIRUGIA
,HORA_CIRUGIA
,FECHA_RESERVA
,CLINICA
,AYUDANTE
,INSTRUMENTADORA
,PAGADO
,OBSERVACIONES
,COBERTURA
,NROAFILIADO
,CIRUGIA1
,CIRUGIA2
,CIRUGIA3
,CIRUGIA4


)

values (".$_POST["IDPAC"].",str_to_date( '".$fecha."','%d/%m/%Y'),'".$_POST["HORA"]."',
CURDATE(),".$_POST["clinica"].",'".$_POST["AYUDANTE"]."','".$_POST["INSTRUMENTADORA"]."',".$Pagado.",'".$_POST["ADICIONAL"]."','".$_POST["COBERTURA"]."','".$_POST["AFILIADO"]."'
,".$_POST["cirugia1"].",".$_POST["cirugia2"].",".$_POST["cirugia3"].",".$_POST["cirugia4"].")";

}
else
{
	$fecha=str_replace("-", "/", $_POST["f_rangeStart"]);
	$query3="update   paciente_hc 
		set
		FECHA_CIRUGIA = str_to_date( '".$fecha."','%d/%m/%Y')
		,HORA_CIRUGIA = '".$_POST["HORA"]."'
		,FECHA_RESERVA = CURDATE()
		,CLINICA = ".$_POST["clinica"]."
		,AYUDANTE = '".$_POST["AYUDANTE"]."'
		,INSTRUMENTADORA = '".$_POST["INSTRUMENTADORA"]."'
		,PAGADO = ".$Pagado."
		,OBSERVACIONES = '".$_POST["ADICIONAL"]."'
		,COBERTURA  = '".$_POST["COBERTURA"]."'
		,NROAFILIADO = '".$_POST["AFILIADO"]."'
		,CIRUGIA1 = ".$_POST["cirugia1"]."
		,CIRUGIA2 = ".$_POST["cirugia2"]."
		,CIRUGIA3 = ".$_POST["cirugia3"]."
		,CIRUGIA4 = ".$_POST["cirugia4"]."
		where id =".$_POST["ID"]." ";
	
}
echo $query3;

mysql_query($query3) or die(mysql_error());

echo"<script language='javascript'>window.location='pacientes.php'</script>;";
?>
