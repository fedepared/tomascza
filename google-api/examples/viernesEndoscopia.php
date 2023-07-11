<?php    
    session_start();
    include_once '../../ONLINE/admin/class/conexion.php';
    include "../../ONLINE/admin/res/imemail.inc.php";
   $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
     $link1=Conectarse();
            $sql1= " select * from reservaendoscopia  where DATETIME>=now() and DATETIME<= (now()+INTERVAL 8 day)  order by DATETIME";                              
			$consulta1= mysql_query($sql1,$link1);
     
      	$htmData="<head>";
          	$htmData.="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
          	$htmData.="<title>Documento sin título</title>";
          	$htmData.="</head>";
          	
          	$htmData.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
          	$htmData.="  <tr>";
          	$htmData.="    <td height='272'><table width='703' border='0' align='center' cellpadding='0' cellspacing='0'>";
          	$htmData.="  <tr>";
          	$htmData.="    <td width='403' align='rigth' style='border-bottom:solid 1px #483c2e; border-top:solid 2px #483c2e;'></td>";
          	$htmData.="  </tr>";
          	$htmData.="  <tr>";
            $htmData.="    <td height='149' align='rigth' style='font-family:Verdana, Geneva, sans-serif; font-size:12px;'>";
          	$htmData.="    <p style='font-size:14px;'> Turnos Endoscopia dia Viernes <br>";
            
       $i ;    			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
        $fecha = $dias[date('N', strtotime($row1['DATETIME']))];
        $hora =date('h:m A', strtotime($row1['DATETIME']));
        
        $i++;
        
         $contador=0;
        if ($fecha=="Viernes" )
         {
         $contador++;
        if (($i % 2)==0)
            {
                $htmData.=" <font color='green'>   <strong >Fecha: ".$row1['DATETIME']."  Paciente :".$row1['PACIENTE']."</strong><br><br></font> ";
            } 
            else
            {
                $htmData.=" <font color='blue'>   <strong >Fecha: ".$row1['DATETIME']."  Paciente :".$row1['PACIENTE']."</strong><br><br></font>";
            }
        }
         
        }
        if ($contador>0)
        {
        $htmData.=" <font color='blue'>   <strong > NO POSEE TURNOS </strong><br><br></font>";
        }
        
          $htmData.="    </p><p style='color:#473b2d;'>Muchas Gracias!</p>";
            	$htmData.="    </td>";
            	$htmData.="  </tr>";
            	$htmData.="  <tr>";
            	$htmData.="    <td height='35' align='center' bgcolor='#CCCCCC' style='font-family:Verdana, Geneva, sans-serif; font-size:12px;'><a href='mailto:secretariaendoscopias@gmail.com' style='color:#333; text-decoration:none; font-weight:bold;'>secretariaendoscopias@gmail.com</a> </td>";
            	$htmData.="  </tr>";
            	$htmData.="    </table>";
            	$htmData.="</td>";
            	$htmData.="  </tr>";
            	$htmData.="</table>";
              
              
              $emailDiana ='dianajudit@hotmail.com';
              $emailSole ='cinthiasole@yahoo.com.ar';
              $emailEnviar="admision.zabala@swissmedical.com.ar,coord.admzabala@swissmedical.com.ar,monicabeatriz.novo@swissmedical.com.ar,cinthiasole@yahoo.com.ar";

             echo $diaAnterio." <br>"; 
              $txtMsg = "|DATOS ENVIADOS DESDE LA WEB - Turnos |";
            	$htmMsg = $htmHead . "<tr><td></td></tr>" . $htmFoot;
            	$oEmail = new imEMail("secretariaendoscopias@gmail.com",$emailSole,"*Reserva desde la Web* ","iso-8859-1");
            	$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
            	$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData . $htmFoot . "</center></body></html>");
            	$oEmail->send();
              
              Echo "Se envio mail Correctamente."
?>