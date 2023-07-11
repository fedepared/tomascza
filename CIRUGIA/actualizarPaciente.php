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


$fecha=str_replace("-", "/", $_POST["f_rangeStart"]);
$link=Conectarse();
$query3 ="";
$cobertura = $_POST["cobertura"];
if ($_POST["COBERTINEX"]!="")
{
	$pIdPaciente="";
	$query = 'START TRANSACTION';	
	mysql_query($query) or die(mysql_error());
	$query1 ="insert into  cobertura 
	(
	COBERTURA
	,ESTADO
	)
	values ('".$_POST["COBERTINEX"]."',1)";
	mysql_query($query1) or die(mysql_error());
	$query2 = 	'SELECT LAST_INSERT_ID() INTO @id ';
	mysql_query($query2) or die(mysql_error());
	if ($_POST["ID"]=='0')
	{
	$query3 = 	"insert into  pacientes 
	(APELLIDO
	,NOMBRES
	,DNI
	,FECHA_NACIMIENTO
	,OCUPACION
	,COBERTURA
	,NRO_AFILIADO
	,PLAN
	,OBSERVACIONES
	
	
	)
	
	values ('".$_POST["APELLIDO"]."','".$_POST["NOMBRES"]."',".$_POST["DNI"].",
	str_to_date( '".$fecha."','%d/%m/%Y'),'".$_POST["OCUPACION"]."',@id,'".$_POST["AFILIADO"]."','".$_POST["PLAN"]."','".$_POST["OBSERVACIONES"]."')";
	
	}
	else
	{
		
		$query3="update   pacientes 
			set
			APELLIDO = '".$_POST["APELLIDO"]."'
			,NOMBRES ='".$_POST["NOMBRES"]."'
			,DNI =".$_POST["DNI"]."
			,FECHA_NACIMIENTO= str_to_date( '".$fecha."','%d/%m/%Y')
			,OCUPACION ='".$_POST["OCUPACION"]."'
			,COBERTURA =@id
			,NRO_AFILIADO ='".$_POST["AFILIADO"]."'
			,PLAN ='".$_POST["PLAN"]."'
			,OBSERVACIONES = '".$_POST["OBSERVACIONES"]."'
			where id =".$_POST["ID"]." ";
		$pIdPaciente =$_POST["ID"];
	}
	mysql_query($query3) or die(mysql_error());
	
	if ($pIdPaciente=="")
	{
		$query9 = 	'SELECT LAST_INSERT_ID() as IDPACIENTE ';
		$rs= mysql_query($query9) ;
		$row = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
		$pIdPaciente = $rowTotal["IDPACIENTE"];
		
	}
	
	$query4 = '	COMMIT';
	mysql_query($query4	) or die(mysql_error());
	
	if($_POST["guardar"]=="Guardar")
		echo"<script language='javascript'>window.location='pacientes.php'</script>;";
	else
		echo"<script language='javascript'>window.location='rescirugia.php?id=$pIdPaciente'</script>;";
	
}

else
{
	$query = 'START TRANSACTION';	
	mysql_query($query) or die(mysql_error());
if ($_POST["ID"]=='0')
{
$query3 = 	"insert into  pacientes 
(APELLIDO
,NOMBRES
,DNI
,FECHA_NACIMIENTO
,OCUPACION
,COBERTURA
,NRO_AFILIADO
,PLAN
,OBSERVACIONES

)

values ('".$_POST["APELLIDO"]."','".$_POST["NOMBRES"]."',".$_POST["DNI"].",
str_to_date( '".$fecha."','%d/%m/%Y'),'".$_POST["OCUPACION"]."',".$_POST["cobertura"].",'".$_POST["AFILIADO"]."','".$_POST["PLAN"]."','".$_POST["OBSERVACIONES"]."')";

}
else
{
	$fecha=str_replace("-", "/", $_POST["f_rangeStart"]);
	$query3="update   pacientes 
		set
		APELLIDO = '".$_POST["APELLIDO"]."'
		,NOMBRES ='".$_POST["NOMBRES"]."'
		,DNI =".$_POST["DNI"]."
		,FECHA_NACIMIENTO= str_to_date( '".$fecha."','%d/%m/%Y')
		,OCUPACION ='".$_POST["OCUPACION"]."'
		,COBERTURA =".$_POST["cobertura"]."
		,NRO_AFILIADO ='".$_POST["AFILIADO"]."'
		,PLAN ='".$_POST["PLAN"]."'
		,OBSERVACIONES ='".$_POST["OBSERVACIONES"]."'
		where id =".$_POST["ID"]." ";
	$pIdPaciente =$_POST["ID"];
}
mysql_query($query3) or die(mysql_error());
if ($pIdPaciente=="")
	{
		$query9 = 	'SELECT LAST_INSERT_ID() as IDPACIENTE ';
		$rs= mysql_query($query9) ;
		$row = mysql_fetch_assoc($rs);
		// Total de registros sin limit
		$pIdPaciente = $row["IDPACIENTE"];
		
	}
	$query4 = '	COMMIT';
	mysql_query($query4	) or die(mysql_error());
	if($_POST["guardar"]=="Guardar")
		echo"<script language='javascript'>window.location='pacientes.php'</script>;";
	else
		echo"<script language='javascript'>window.location='rescirugia.php?id=$pIdPaciente'</script>;";

}






?>
