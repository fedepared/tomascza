<?php
    session_start();
    include_once '../../ONLINE/admin/class/conexion.php';
    include "../../ONLINE/admin/res/imemail.inc.php";

    require_once realpath(dirname(__FILE__) . '/../src/Google/autoload.php');
 

    // ********************************************************  //
    // Get these values from https://console.developers.google.com
    // Be sure to enable the Analytics API
    // ********************************************************    //
    $client_id = '659506219685-cliq0fnlfgs27h5qo7cv6peo92sjolck.apps.googleusercontent.com';
    $client_secret = '5m-k10k66jV8fdKlYW2Z76hA';
    $redirect_uri = 'http://tomasczarnitzki.com.ar/google-api/examples/endoscopia.php';

    $client = new Google_Client();
    $client->setApplicationName("Client_Library_Examples");
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->setAccessType('offline');   // Gets us our refreshtoken

    $client->setScopes(array('https://www.googleapis.com/auth/calendar.readonly'));



    //For loging out.
    if (isset($_GET['logout'])) {
	unset($_SESSION['token']);
    }


    // Step 2: The user accepted your access now you need to exchange it.
    if (isset($_GET['code'])) {
	
	$client->authenticate($_GET['code']);  
	$_SESSION['token'] = $client->getAccessToken();
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    }

    // Step 1:  The user has not authenticated we give them a link to login    
    if (!isset($_SESSION['token'])) {

	$authUrl = $client->createAuthUrl();

	print "<a class='login' href='$authUrl'>Connect Me!</a>";
    }    


    // Step 3: We have access we can now create our service
    if (isset($_SESSION['token'])) {
	$client->setAccessToken($_SESSION['token']);
	print "<a class='logout' href='http://www.daimto.com/Tutorials/PHP/GCOAuth.php?logout=1'>LogOut</a><br>";	
	
  
  
  $service = new Google_Service_Calendar($client);    
	
    
 //////////
// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 100000,
  'orderBy' => 'startTime',
  'singleEvents' => TRUE,
  'timeMin'=> date('c')
  // 'timeMin'=> date(DATE_ATOM, strtotime('2015-11-01T00:01:01Z'))
   //,   'timeMax'=> date(DATE_ATOM, strtotime('2015-10-04T00:30:01Z'))
     
);
/*
$results = $service->events->listEvents($calendarId, $optParams);

if (count($results->getItems()) == 0) {
  print "No upcoming events found.\n";
} else {
  print "Upcoming events:\n";
  
  foreach ($results->getItems() as $event) {
    $start = $event->start->dateTime;
    if (empty($start)) {
      $start = $event->start->date;
    }
    printf("%s (%s)\n", $event->getSummary(), $start);
  }
}
///////////
 */
 $mailLunes="iorlendoscopia@yahoo.com.ar";
 $mailMartes="emilianoparlagreco@hotmail.com,Yempa22@hotmail.com";
 $mailMiercoles="raul.saiman@swissmedical.com.ar,martinalberto.blanco@swissmedical.com.ar,enlaceagote@swissmedical.com.ar";
 $mailJueves="iorlendoscopia@yahoo.com.ar";
 $mailVierenes="admision.zabala@swissmedical.com.ar,coord.admzabala@swissmedical.com.ar,monicabeatriz.novo@swissmedical.com.ar";
 $mailsGrupo="adege2000@yahoo.com.ar,cesar@didomenico.com.ar,mfpereyra79@gmail.com,ferabbott@hotmail.com,cinthiasole@yahoo.com.ar"; 
 
 
 
 $htmData="";
	$calendarList  = $service->calendarList->listCalendarList();
 $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');       
$diaAnterior;
	while(true) {
		foreach ($calendarList->getItems() as $calendarListEntry) {

			if ($calendarListEntry->getSummary()=="secretariaendoscopias@gmail.com")
      {
      echo $calendarListEntry->getSummary()."<br>\n";
      }


			// get events 
			$events = $service->events->listEvents($calendarListEntry->id,$optParams);
      
      if ($calendarListEntry->getSummary()=="secretariaendoscopias@gmail.com")
      {
      $i=1;
      
			foreach ($events->getItems() as $event) {
          $link=Conectarse();
      
      
     /*
     $aaa = $events->getItems();
     extract($event);        
     var_dump($event->getStart()->getDateTime());
     echo "<br>";
     echo "<br>";
     var_dump($event);
     //var_dump($event);
      
      
      
            */
         /*
          $link=Conectarse();
            
          ///Se verifica que el paciente con el turno que se esta generando no exista en la base
          /// Si el usuario exite le actualiza el turno al usuario.
          
          $variables = explode ("|",$event->getSummary());          
          $pIdPaciente="";
          $TurnoExiste;
          $pIdConsultorio="";
          $query3 ="";
          $email=trim($variables[5]);
          $link=Conectarse();
          
          	$query = 'START TRANSACTION';	
	         mysql_query($query) or die(mysql_error());
            
          if ($email!="")
         {
          $sql1= " select * from pacientes where EMAIL ='".$email."' ";           
          $consulta1= mysql_query($sql1,$link);
          $row= mysql_fetch_assoc($consulta1);		
          if($row )
          {
            
            $pIdPaciente=$row["ID"];            
          } 
         }  
          $sqlCon= " select * from clinica where CLINICA ='Consultorio Acoyte' ";           
          $consultaCon= mysql_query($sqlCon,$link);
          $rowCon= mysql_fetch_assoc($consultaCon);		
          if($rowCon )
          {
            
            $pIdConsultorio=$rowCon["ID"];            
          }
         
              ///Verifica si no existe
              if ($pIdPaciente=="" )
              {
              	  
              	$query3 = 	"insert into  pacientes 
              		(APELLIDO
              		,NOMBRES              		
              		,TELEFONO
                  ,CELULAR
              		,EMAIL  
                  ,ANEXO            		
              		)              		
              		values ('".$variables[0]."','".$variables[1]."'
              		,'".$variables[3]."','".trim($variables[5])."')";
              }
              else
              {              		
              		$query3="update   pacientes 
              			set
              			APELLIDO = '".$variables[0]."'
              			,NOMBRES ='".$variables[1]."'              			
              			,TELEFONO='".$variables[3]."'              			
              			,EMAIL ='".$email."'              		
              			where id =".$pIdPaciente." ";
              		
              }
              mysql_query($query3) or die(mysql_error());
              
          //echo $variables[0]; NOMBRE
          //echo $variables[1]; APELLIDO
          //echo $variables[2];  ESTUDIO
          //echo $variables[3];  COBERTURA
          //echo $variables[3];  NRO
          //echo $variables[4]; TELEFONO
          //echo trim($variables[5]);  CELULAR
          //echo $variables[6];   MAIL
          //echo $variables[7];   MAIL
          if ($pIdPaciente=="")
          {
          		$query9 = 	'SELECT LAST_INSERT_ID() as IDPACIENTE ';
          		$rs= mysql_query($query9) ;
          		$row = mysql_fetch_assoc($rs);
          		// Total de registros sin limit
          		$pIdPaciente = $row["IDPACIENTE"];
          }
          
          
          $sql1= " select * from reservaconsultorio where IDGOOGLE ='".$event->getId()."' ";           
          $consulta1= mysql_query($sql1,$link);
          $row= mysql_fetch_assoc($consulta1);		
          if($row )
          {
            $TurnoExiste= "Se Actualizo Correctamente";
            $queryrescons="UPDATE reservaconsultorio
            SET
          	IDCONSULTORIO =$pIdConsultorio
            ,DATETIME='".$event->getStart()->getDateTime()."'
            where ID ='".$row["ID"]."'";
            mysql_query($queryrescons) or die(mysql_error());                        
                        
          }
          else
          {    
                
            $queryrescons="INSERT INTO  reservaconsultorio
          	(IDPACIENTE,IDCONSULTORIO,ESTADO,DATETIME,IDGOOGLE,COBERTURA)
          	VALUES
          	($pIdPaciente,$pIdConsultorio ,1,'".$event->getStart()->getDateTime()."','".$event->getId()."','".$variables[2]."')";
          	mysql_query($queryrescons) or die(mysql_error());
        	 }
          
        	
        	
        	$query9 = 	'SELECT LAST_INSERT_ID() as IDCONSULTORIO ';
        	$rs= mysql_query($query9) ;
        	$row = mysql_fetch_assoc($rs);
        	// Total de registros sin limit
        	$pIdConsultorio = $row["IDCONSULTORIO"];
        		
        	$query4 = '	COMMIT';
        	mysql_query($query4) or die(mysql_error());
          
           
           {  
          	$htmData="<head>";
          	$htmData.="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
          	$htmData.="<title>Documento sin título</title>";
          	$htmData.="</head>";
          	
          	$htmData.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
          	$htmData.="  <tr>";
          	$htmData.="    <td height='272'><table width='403' border='0' align='center' cellpadding='0' cellspacing='0'>";
          	$htmData.="  <tr>";
          	$htmData.="    <td width='403' align='center' style='border-bottom:solid 1px #483c2e; border-top:solid 2px #483c2e;'></td>";
          	$htmData.="  </tr>";
          	$htmData.="  <tr>";
          	$htmData.="    <td height='149' align='center' style='font-family:Verdana, Geneva, sans-serif; font-size:12px;'>";
          	$htmData.="    <p style='font-size:14px;'> Usted recibio una confirmacion de  turno de consultorio <br> ";          	
          	$htmData.="    <strong>Para el ".str_replace("T"," ",$event->getStart()->getDateTime())."</strong></p>";
          	$htmData.="    <p style='color:#473b2d;'>Muchas Gracias!</p>";
            $htmData.="    <p style='color:#473b2d;'>En caso de no poder asistir favor de comunicarnos con 24hs de antelación.</p>";
            $htmData.="    <p style='color:#473b2d;'>Telefono: 15-5182-5634 .</p>";
          	$htmData.="    </td>";
          	$htmData.="  </tr>";
          	$htmData.="  <tr>";
          	$htmData.="    <td height='35' align='center' bgcolor='#CCCCCC' style='font-family:Verdana, Geneva, sans-serif; font-size:12px;'><a href='mailto:secretariaendoscopias@gmail.com' style='color:#333; text-decoration:none; font-weight:bold;'>secretariaendoscopias@gmail.com</a> </td>";
          	$htmData.="  </tr>";
          	$htmData.="    </table>";
          	$htmData.="</td>";
          	$htmData.="  </tr>";
          	$htmData.="</table>";
          	
          	
          	
          	$txtMsg = "|DATOS ENVIADOS DESDE LA WEB |";
          	$htmMsg = $htmHead . "<tr><td></td></tr>" . $htmFoot;
          	$oEmail = new imEMail("secretariaendoscopias@gmail",$email ,"*Reserva desde la Web* ","iso-8859-1");
          	$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
          	$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData . $htmFoot . "</center></body></html>");
          	$oEmail->send();    
          }  
          */
          $summa =$event->getSummary();
          $summa =str_replace("ú","&uacute;",$summa);
          $summa =str_replace("é","&eacute;",$summa);
          $summa =str_replace("í","&iacute;",$summa);
          $summa =str_replace("ó","&oacute;",$summa);
          $summa =str_replace("á","&aacute;",$summa);
          $summa =str_replace("ñ","&ntilde;",$summa);
          $variables = explode ("|",$summa);
          $aaa = explode("T",$event->getStart()->getDateTime());
          $hora  = explode("-",$aaa[1]); 
          
          
          $sql1= " select * from reservaendoscopia where IDGOOGLE ='".$event->getId()."' ";           
          $consulta1= mysql_query($sql1,$link);
          $row= mysql_fetch_assoc($consulta1);		
          if($row )
          {
            $TurnoExiste= "Se Actualizo Correctamente";
            $queryrescons="UPDATE reservaendoscopia
            SET
          	PACIENTE= '".$variables[0]."'
            ,MAIL_TEL= '".$variables[1]."'
            ,COMENTARIO= '".$variables[2]."'
            ,DATETIME='".$event->getStart()->getDateTime()."'
            where ID ='".$row["ID"]."'";
            mysql_query($queryrescons) or die(mysql_error());                        
                        
          }
          else
          {    
                
            $queryrescons="INSERT INTO  reservaendoscopia
          	(PACIENTE,MAIL_TEL,COMENTARIO,ESTADO,DATETIME,IDGOOGLE)
          	VALUES
          	('".$variables[0]."','".$variables[1]."','".$variables[2]."' ,1,'".$event->getStart()->getDateTime()."','".$event->getId()."')";
          	mysql_query($queryrescons) or die(mysql_error());
        	 }
           
          /* 
          $fecha = $dias[date('N', strtotime($aaa[0]))];
          if ($diaAnterior=="" )
          {
            $diaAnterior =$fecha ;
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
          	$htmData.="    <p style='font-size:14px;'> Turnos endoscopicos ".$fecha." <br> ";
          }            
          
          if($diaAnterior ==$fecha )
          { 
            if (($i % 2)==0)
            {
                $htmData.=" <font color='green'>   <strong >Fecha: ".$aaa[0]." " .$hora[0]."  Paciente :".$variables[0]."</strong><br><br></font> ";
            } 
            else
            {
                $htmData.=" <font color='blue'>   <strong >Fecha: ".$aaa[0]." " .$hora[0]." Paciente :".$variables[0]."</strong><br><br></font>";
            }   	
          }
          else
          {
          
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
            	
            
             
            $emailEnviar;
            switch ($diaAnterior) {
                            case 'Lunes':
                                //$emailEnviar=$mailLunes;
                                    $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                break;                                
                            case 'Martes':
                            
                                //$emailEnviar=$mailMartes;                                
                                $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                break;
                            case 'Miercoles':
                            
                                //$emailEnviar=$mailMiercoles;
                                $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                break;
                            case 'Jueves':
                            $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                //$emailEnviar=$mailJueves;
                                
                                break;
                            case 'Viernes':
                            
                                //$emailEnviar=$mailVierenes;
                                $emailEnviar="9";
                                break;                                
                        }
            	
              $emailDiana ='dianajudit@hotmail.com';
              $emailSole ='cinthiasole@yahoo.com.ar';

             echo $diaAnterio." <br>"; 
              $txtMsg = "|DATOS ENVIADOS DESDE LA WEB - Turnos |";
            	$htmMsg = $htmHead . "<tr><td></td></tr>" . $htmFoot;
            	$oEmail = new imEMail("secretariaendoscopias@gmail.com",$emailEnviar,"*Reserva desde la Web* ","iso-8859-1");
            	$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
            	$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData . $htmFoot . "</center></body></html>");
            	$oEmail->send();       
              
             
            $diaAnterior =$fecha ;
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
          	$htmData.="    <p style='font-size:14px;'> Turnos endoscopicos ".$fecha." <br> ";  
              if (($i % 2)==0)
            {
                $htmData.=" <font color='green'>   <strong >Fecha: ".$aaa[0]." " .$hora[0]."  Paciente :".$variables[0]."</strong><br><br></font> ";
            } 
            else
            {
                $htmData.=" <font color='blue'>   <strong >Fecha: ".$aaa[0]." " .$hora[0]." Paciente :".$variables[0]."</strong><br><br></font>";
            }
              
                 	
          }
          */
          //if (count($variables)!=9)
          
         echo "<font color='blue'><b>Endoscopia  Nro ".$i." - ".count($variables)."</b></font><br>";
          echo "--------------------------------------------------"."<br>";
          echo "<font color='red'><b>".$TurnoExiste."</b></font><br>";
			    echo "Fecha - ".$event->getStart()->getDateTime()."<br>";
          echo "Titulo - ". $summa."<br>";          
          
          echo "--------------------------------------------------"."<br>";
      $i++;    
          
          
          
			}
      }
		}
		$pageToken = $calendarList->getNextPageToken();
		if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$calendarList = $service->calendarList->listCalendarList($optParams);
		} else {
			break;
		}
	}
  /*
   $emailEnviar;
            switch ($diaAnterior) {
                            case 'Lunes':
                                //$emailEnviar=$mailLunes;
                                $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";    
                                break;                            
                            case 'Martes':
                               // $emailEnviar=$mailMartes;
                                $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                break;                                
                            case 'Miercoles':
                                //$emailEnviar=$mailMiercoles;
                                $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                break;
                            case 'Jueves':
                                //$emailEnviar=$mailJueves;
                                $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                                break;
                            case 'Viernes':
                            
                            //    $emailEnviar=$mailVierenes;
                            $emailEnviar="ferreira.jorgen@gmail.com,dianajudit@hotmail.com";
                            break;                                
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
            	
            	$emailAcoyte="ferreira.jorgen@gmail.com,dianajudit@hotmail.com,cinthiasole@yahoo.com.ar";
              $emailDiana ='dianajudit@hotmail.com';
              $emailSole ='cinthiasole@yahoo.com.ar';

              
              $txtMsg = "|DATOS ENVIADOS DESDE LA WEB - Turnos |";
            	$htmMsg = $htmHead . "<tr><td></td></tr>" . $htmFoot;
            	$oEmail = new imEMail("secretariaendoscopias@gmail.com",$emailEnviar,"*Reserva desde la Web* ","iso-8859-1");
            	$oEmail->setText($txtMsg . "\r\n\r\n" . $txtData);
            	$oEmail->setHTML("<html><body bgcolor=\"#fff\"><center>" . $htmMsg . "<br>" . $htmHead . $htmData . $htmFoot . "</center></body></html>");
            	$oEmail->send();   */     
    }
?>