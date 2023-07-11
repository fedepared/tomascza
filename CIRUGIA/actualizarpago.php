<?php
session_start();
include_once 'class/conexion.php';
if (isset($_POST["pagos"]))
{
if(!($_POST["pagos"]==""))
{	
	$idpagos= explode(",", $_POST["pagos"]);
	for ($i=0;$i<count($idpagos)-1;$i++)
	{
	$link=Conectarse();
    $sqlUpdPay= " update paciente_hc set PAGADO = 1 where ID=".$idpagos[$i]."";
    mysql_query($sqlUpdPay) or die(mysql_error());
	} 
    
}}

//header("location:javascript:window.location.reload(history.go(-1))");
header('Location: ' . $_SERVER['HTTP_REFERER']);
 
?>
