<?php
session_start();
include "res/imemail.inc.php";
include_once 'class/conexion.php';

$htmData1="<head>";
$htmData1.="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
$htmData1.="<title>Adminsitrador de Cirugias.</title>";
$htmData1.="</head>";

$htmData1.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
$htmData1.="  <tr>";
$htmData1.="    <td><table width='0' border='1'  bordercolor='black' align='center' cellpadding='0' cellspacing='0'>";
$htmData1.="      <tr>";
$htmData1.="        <td width='874'><table width='0' border='1' align='center' cellpadding='0' cellspacing='0'>";
$htmData1.="          <tr>";
$htmData1.="            <td width='640' align='center' bgcolor='black'></td>";
$htmData1.="          </tr>";



if (isset($_POST["mails"]))
{
if(!($_POST["mails"]==""))
{	
	$idcir="";
	$idpagos= explode(",", $_POST["mails"]);
	$idOrto=explode(",", $_POST["ortopedia"]);
	
	for ($i=0;$i<count($idpagos)-1;$i++)
	{
		if ($i==0)
			$idcir="'".$idpagos[$i]."'";
		else
			$idcir.=",'".$idpagos[$i]."'";
	}		
	$link=Conectarse();
	$sql= " select concat(APELLIDO,concat(', ',NOMBRES))AS PACIENTE
    ,paciente_hc.ID
    ,NRO_AFILIADO
    ,(select COBERTURA from cobertura where paciente_hc.COBERTURA = cobertura.ID ) as COBERTURA
    ,paciente_hc.OBSERVACIONES
    ,(case when PAGADO = 1 then 'Pagado' 
    		when   PAGADO = 0 then 'Adeuda' end) as ESTADO 
    ,FECHA_CIRUGIA
    ,HORA_CIRUGIA
    ,pacientes.ID as IDPAC
    ,paciente_hc.NROAFILIADO 
    ,paciente_hc.CLINICA as CLINICA
    ,(select MAIL1 from contacto where contacto.CLINICA =paciente_hc.CLINICA) as MAIL1
    ,(select MAIL2 from contacto where contacto.CLINICA =paciente_hc.CLINICA) as MAIL2
    ,(select MAIL3 from contacto where contacto.CLINICA =paciente_hc.CLINICA) as MAIL3
    ,(select MAIL4 from contacto where contacto.CLINICA =paciente_hc.CLINICA) as MAIL4
     from pacientes  , paciente_hc where pacientes.ID = paciente_hc.ID_PACIENTE and paciente_hc.ID in(".$idcir.")
     order by paciente_hc.CLINICA,1";
    
    $consulta= mysql_query($sql,$link);
    $idclinica="";
    $mail1="";
    $mail2="";
    $mail3="";
    $mail4="";
    while($row= mysql_fetch_assoc($consulta)) 
    {
    	
    	if($idclinica=="")
    	{
    		$idclinica = $row["CLINICA"];
    	}
    	if ($idclinica == $row["CLINICA"])
    	{
    		$dsOrto="";
    		for($j=0;$j<count($idOrto);$j++)
			{
				if ($row["ID"]==$idOrto[$j])
					$dsOrto=" SI ";
				
			}
    		$mail1=$row["MAIL1"];
    		$mail2=$row["MAIL2"];
    		$mail3=$row["MAIL3"];
    		$mail4=$row["MAIL4"];
    		$htmData1.="          <tr style='border-bottom:1pt solid black;'>";
    		$htmData1.="            <td  style='text-align:left; font-family:Arial, Helvetica, sans-serif;'>";
    		$htmData1.="<p style='color:blue; font-size:14px'>";
			$htmData1.=" <b>Fecha</b>:".$row["FECHA_CIRUGIA"]."";
			$htmData1.=" <b>Hora</b>:".$row["HORA_CIRUGIA"]."";
			$htmData1.=" - <b>Paciente</b>: ".$row["PACIENTE"]."";
			$htmData1.=" - <b>Cobertura</b>: ".$row["COBERTURA"]."";
			$htmData1.=" - <b>Nro Afiliado</b>: ".$row["NROAFILIADO"]."";
			$htmData1.=" - <b>Ortopedia</b>: ".$dsOrto."";
			$htmData1.=" - <b>Cirugia</b>: ".$row["OBSERVACIONES"]."</p><br>";
			$htmData1.="            </td>";
          	$htmData1.="</tr>";
          
    	}
    	else 
    	{
    		
    		$htmData1.="          <tr>";
			$htmData1.="            <td bgcolor='black' style='font-family:Arial, Helvetica, sans-serif; color:#DF7401; text-align:center;' ></td>";
			$htmData1.="</tr>";
			$htmData1.="        </table></td>";
			$htmData1.="      </tr>";
			$htmData1.="    </table></td>";
			$htmData1.="  </tr>";
			$htmData1.="</table>";
			
			
    		if ($mail1!="")
    		{
    			
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomascza@hotmail.com>",$mail1, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    		}
    		if ($mail2!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail2, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    			
    		}
    		if ($mail3!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail3, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    		}
    		if ($mail4!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail4, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    		}
			
    		$txtMsg = "|MAIL DE CONFIRMACION|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>","tomas czarnitzki <tomascza@hotmail.com>", "*Mail de confirmacion* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
			
			$mail1="";
    		$mail2="";
    		$mail3="";
    		$mail4="";
			$idclinica ="";
    		for($j=0;$j<count($idOrto);$j++)
			{
				if ($row["ID"]==$idOrto[$j])
					$dsOrto=" SI ";
			}
    		$htmData1="<head>";
			$htmData1.="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
			$htmData1.="<title>Adminsitrador de Cirugias.</title>";
			$htmData1.="</head>";
			
			$htmData1.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			$htmData1.="  <tr>";
			$htmData1.="    <td><table width='0' border='1'  bordercolor='black' align='center' cellpadding='0' cellspacing='0'>";
			$htmData1.="      <tr>";
			$htmData1.="        <td width='874'><table width='0' border='1' align='center' cellpadding='0' cellspacing='0'>";
			$htmData1.="          <tr>";
			$htmData1.="            <td width='740' align='center' bgcolor='black'></td>";
			$htmData1.="          </tr>";
			$htmData1.="          <tr>";
    		$htmData1.="            <td  style='text-align:left; font-family:Arial, Helvetica, sans-serif;'>";
    		$htmData1.="<p style='color:blue; font-size:14px'>";
			$htmData1.=" <b>Fecha</b>:".$row["FECHA_CIRUGIA"]."";
			$htmData1.=" <b>Hora</b>:".$row["HORA_CIRUGIA"]."";
			$htmData1.=" - <b>Paciente</b>: ".$row["PACIENTE"]."";
			$htmData1.=" - <b>Cobertura</b>: ".$row["COBERTURA"]."";
			$htmData1.=" - <b>Nro Afiliado</b>: ".$row["NROAFILIADO"]."";
			$htmData1.=" - <b>Ortopedia</b>: ".$dsOrto."";
			$htmData1.=" - <b>Cirugia</b>: ".$row["OBSERVACIONES"]."</p><br>";
			$htmData1.="            </td>";
          	$htmData1.="</tr>";
			
			
    	}
    	
    }
			$htmData1.="          <tr>";
			$htmData1.="            <td bgcolor='black' style='font-family:Arial, Helvetica, sans-serif; color:#DF7401; text-align:center;' ></td>";
			$htmData1.="</tr>";
			$htmData1.="        </table></td>";
			$htmData1.="      </tr>";
			$htmData1.="    </table></td>";
			$htmData1.="  </tr>";
			$htmData1.="</table>";
			
			
    		if ($mail1!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail1, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    		}
    		if ($mail2!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail2, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    			
    		}
    		if ($mail3!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail3, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    		}
    		if ($mail4!="")
    		{
    			$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>",$mail4, "*Cirugias* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
    		}
    
    			$txtMsg = "|MAIL DE CONFIRMACION|";
				$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
				$oEmail = new imEMail("tomas czarnitzki <tomycza@hotmail.com>","tomas czarnitzki <tomascza@hotmail.com>", "*Mail de confirmacion* ","iso-8859-1");
				$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
				$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
				$oEmail->send();
	 
    
}}
echo"<script language='javascript'>alert('Se enviaron correctamente los Mails.')</script>;";
echo"<script language='javascript'>window.location='enviarMails.php'</script>;";
/*
$email =$_POST["email"];
$Nombre =$_POST["nombre"];
$Telefono =$_POST["web"];
$Mensaje =$_POST["mensaje"];


          
$htmData1.="            </td>";
          $htmData1.="</tr>";
$htmData1.="          <tr>";
$htmData1.="            <td bgcolor='black' style='font-family:Arial, Helvetica, sans-serif; color:#DF7401; text-align:center;' ><a href='http://www.jfsoluciones.com.ar/' target='_blank' style='color:fff;'>www.jfsoluciones.com.ar</a> | <a href='mailto:ferreira.jorgen@gmail.com' style='color:fff;'>ferreira.jorgen@gmail.com </a></td>";
          $htmData1.="</tr>";
$htmData1.="        </table></td>";
$htmData1.="      </tr>";
$htmData1.="    </table></td>";
$htmData1.="  </tr>";
$htmData1.="</table>";


$txtMsg = "|DATOS ENVIADOS DESDE LA WEB|";
$htmMsg = $htmHead . "<tr><td></td></tr >" . $htmFoot;
$oEmail = new imEMail("ferreira.jorgen@gmail.com",$email, "*Cirugias* ","iso-8859-1");
$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData1 . $htmFoot . "</center></body></html>");
$oEmail->send();
*/?>