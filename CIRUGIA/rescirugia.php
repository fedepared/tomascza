<?php
session_start();
include_once 'class/conexion.php';
$_SESSION["k_breadcrumb"] ="";
$IdPac= ((isset($_GET["id"]))?$_GET["id"]:0);
$Id= ((isset($_GET["idci"]))?$_GET["idci"]:0);;
$Cobertura;
$Afiliado;

if (isset($_GET["idpay"]))
{
if(!($_GET["idpay"]==""))
{	
	$link=Conectarse();
    $sqlUpdPay= " update paciente_hc set PAGADO = 1 where ID=".$_GET["idpay"]."";
    mysql_query($sqlUpdPay) or die(mysql_error()); 
    
}}
if (isset($_GET["idcc"]))
{
if(!($_GET["idcc"]==""))
{	
	$link=Conectarse();
    $sqlUpdPay= " delete from  paciente_hc where ID=".$_GET["idcc"]."";
    mysql_query($sqlUpdPay) or die(mysql_error()); 
    
}}
if (isset($_GET["idac"]))
{
if(!($_GET["idac"]==""))
{	
	$link=Conectarse();
    $sqlUpdPay= " update paciente_hc set CANCELADO = 0 where ID=".$_GET["idac"]."";
    mysql_query($sqlUpdPay) or die(mysql_error()); 
    
}}  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <script type="text/javascript" src="js/cambiarPestanna.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<title>Pacientes</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<link href="css/admin.css" rel="stylesheet" type="text/css" />-->
<style type="text/css">

fieldset 
{
	border:2px solid #c9e7f1;
	background: #ffffff;
	padding:5px;
	padding-left:15px;
	-moz-border-radius-bottomleft: 5px;
   -moz-border-radius-bottomright: 5px;
   -moz-border-radius-topleft: 5px;
   -moz-border-radius-topright: 5px;
   -webkit-border-radius: 5px;
   border-radius: 5px;
	
	}

legend {
  padding: 0.2em 0.5em;
  color:#666;
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  font-size:11px;
  text-align:right;
  font-weight:bolder; 
  
  
  }
</style>
<link type="text/css" rel="stylesheet" href="src/css/jscal2.css" />
    <link type="text/css" rel="stylesheet" href="src/css/border-radius.css" />
    <!-- <link type="text/css" rel="stylesheet" href="src/css/reduce-spacing.css" /> -->

    <link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="src/css/win2k/win2k.css" />
    <link id="skin-steel" title="Steel" type="text/css" rel="alternate stylesheet" href="src/css/steel/steel.css" />
    <link id="skin-gold" title="Gold" type="text/css" rel="alternate stylesheet" href="src/css/gold/gold.css" />
    <link id="skin-matrix" title="Matrix" type="text/css" rel="alternate stylesheet" href="src/css/matrix/matrix.css" />

    <link id="skinhelper-compact" type="text/css" rel="alternate stylesheet" href="src/css/reduce-spacing.css" />

    <script src="src/js/jscal2.js"></script>
    <script src="src/js/unicode-letter.js"></script>
<script src="src/js/lang/es.js"></script>
</head>
<body >
<div id="page"> 
 <!--Start HEADER -->
 <?php 	 require_once("header.php");
 $link=Conectarse();
    $sql= " select concat(APELLIDO,concat(', ',NOMBRES))AS PACIENTE
    ,TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) as EDAD,OCUPACION, pacientes.ID,NRO_AFILIADO
    ,cobertura.ID as  COBERTURA
    ,cobertura.COBERTURA as  DSCOBERTURA 
     from pacientes , cobertura  where pacientes	.COBERTURA=cobertura.ID and pacientes.ID=".$_GET["id"];
    $consulta= mysql_query($sql,$link);
    
    $row= mysql_fetch_assoc($consulta) ;
    $Cobertura =$row["COBERTURA"];
    $Afiliado =$row["NRO_AFILIADO"];
 			 ?>
 			 <center><fieldset style="width: 650px; vertical-align:top;"  >
            <legend style="text-align:left">Datos Paciente</legend>
            <table>
            
            <tr>
            	<td class="formTitle">Paciente:
            	</td><td class="formFields">
            	<?php echo $row["PACIENTE"]?>	
            	</td>
            	<td class="formTitle">Telefono:
            	</td><td width="150px" class="formFields">
            	<?php echo $row["OCUPACION"]?>	
            	</td>
            	<td  >
            	</td><td >
            		
            	</td>
            	</tr>
            	<tr>
            	<td class="formTitle">Cobertura:
            	</td><td class="formFields">
            	<?php echo $row["DSCOBERTURA"]?>	
            	</td>
            	<td class="formTitle">Nro Afiliado:
            	</td><td class="formFields">
            	<?php echo $row["NRO_AFILIADO"]?> 
            	</td>
            	</tr>
            	<tr>
            	<td colspan="4" height="10px"></td>
            	</tr>
            </table>
            </fieldset>
            </center>
            
<div class="contenedor">
            
            <div id="pestanas">
                <ul id=lista>
                    <li id="pestana1"><a href='javascript:cambiarPestanna(pestanas,pestana1);'>Datos Reserva </a></li>
                    <li id="pestana2"><a href='javascript:cambiarPestanna(pestanas,pestana2);'>Pagados</a></li>
                    <!-- 
                    <li id="pestana3"><a href='javascript:cambiarPestanna(pestanas,pestana3);'>Cancelados</a></li>
                     -->
                    <li id="pestana4"><a href='javascript:cambiarPestanna(pestanas,pestana4);'>Turnos ocupados</a></li>
                    
                </ul>
            </div>
            
            <body onload="javascript:cambiarPestanna(pestanas,pestana1);">
       <?php
       	
		$sql= " select * from paciente_hc where CANCELADO= 0 and  ID = ".((isset($_GET["idci"]))?$_GET["idci"]:0);
		$consulta= mysql_query($sql,$link);
		$row= mysql_fetch_assoc($consulta); 
		$Id= $row["ID"];
       ?>
            <div id="contenidopestanas">
                <div id="cpestana1">
                
                    <form id="formID" ACTION="actualizarCirugiaReserva.php" METHOD="POST"  >
    
    			<input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
 				<input type="hidden" name="IDPAC" id="IDPAC" value="<?php echo $IdPac ?>"></input>
 				<input type="hidden" name="COBERTURA" id="COBERTURA" value="<?php echo $Cobertura ?>"></input>
 				<input type="hidden" name="AFILIADO" id="AFILIAFO" value="<?php echo $Afiliado ?>"></input>
 	 			<table class="form" border="0"  align="center">
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">FECHA</td>
            <td><input size="10" id="f_rangeStart" name="f_rangeStart"  value="<?php
			if (isset($_GET["idci"]))
			{
            $date = date_create($row["FECHA_CIRUGIA"]);
            echo  date_format($date,'d-m-Y');
            }?>"/>
                <button id="f_rangeStart_trigger">...</button>                
                <script type="text/javascript">
                  RANGE_CAL_1 = new Calendar({
                          inputField: "f_rangeStart",
                          dateFormat: " %d/%m/%Y",
                          trigger: "f_rangeStart_trigger",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                  this.hide();
                          }
                  });
                 
                </script></td>
            <td class="formTitle">HORA</td>
            <td><input size="2" type="text" class="validate[required] text-input" name="HORA" id="HORA" class="campos" value="<?php echo ((isset($_GET["idci"]))?$row["HORA_CIRUGIA"]:''); ?>" /></td>
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle" WIDTH="150PX">CLINICA </td>
            <td><select name="clinica">
            <option value="0">Seleccione Clinica</option>
            <?php 
            $sql1= " select * from clinica ";
			$consulta1= mysql_query($sql1,$link);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>"
              <?php 
            if (isset($_GET["idci"]))
            {
	            if ($row1["ID"]==$row["CLINICA"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            >
            <?php echo $row1["CLINICA"]?>
            </option>
            <?php } ?>
            </select></td>
            <td class="formTitle">AYUDANTE</td>
            <td><input type="text" class="validate[required] text-input" name="AYUDANTE" id="AYUDANTE" class="campos" value="<?php echo ((isset($_GET["idci"]))?$row["AYUDANTE"]:''); ?>" /></td>
          
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">INSTRUMENTADORA</td>
            <td><input type="text" class="validate[required] text-input" name="INSTRUMENTADORA" id="INSTRUMENTADORA" class="campos" value="<?php echo ((isset($_GET["idci"]))?$row["INSTRUMENTADORA"]:''); ?>" /></td>
            <td class="formTitle">PAGADO</td>
            <td>&nbsp;&nbsp;<input type="checkbox" id="destacado" name="destacado" <?php if (isset($_GET["idci"])) {if  ($row["PAGADO"]=="1"){ ?> checked<?php }}?> ></input></td>
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">OBSERVACIONES</td>
            <td COLSPAN="3"><textarea name="ADICIONAL" id="ADICIONAL" class="campos" cols="100" rows="4" ><?php echo ((isset($_GET["idci"]))?$row["OBSERVACIONES"]:''); ?></textarea></td>
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">Cirugia 1</td>
            <td><select name="cirugia1">
            <option value="0"><font color="red">Seleccione Cirugia</font></option>
            <?php 
            $sql1= " select * from cirugia ";
			$consulta1= mysql_query($sql1,$link);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>"
              <?php 
            if (isset($_GET["idci"]))
            {
	            if ($row1["ID"]==$row["CIRUGIA1"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            >
            <?php echo $row1["CIRUGIA"]?>
            </option>
            <?php } ?>
            </select></td>
            <td class="formTitle">Cirugia 2</td>
            <td><select name="cirugia2">
            <option value="0"><font color="red">Seleccione Cirugia</font></option>
            <?php 
            $sql1= " select * from cirugia ";
			$consulta1= mysql_query($sql1,$link);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>"
              <?php 
            if (isset($_GET["idci"]))
            {
	            if ($row1["ID"]==$row["CIRUGIA2"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            >
            <?php echo $row1["CIRUGIA"]?>
            </option>
            <?php } ?>
            </select></td>
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">Cirugia 3</td>
            <td><select name="cirugia3">
            <option value="0"><font color="red">Seleccione Cirugia</font></option>
            <?php 
            $sql1= " select * from cirugia ";
			$consulta1= mysql_query($sql1,$link);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>"
              <?php 
            if (isset($_GET["idci"]))
            {
	            if ($row1["ID"]==$row["CIRUGIA3"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            >
            <?php echo $row1["CIRUGIA"]?>
            </option>
            <?php } ?>
            </select></td>
            <td class="formTitle">cirugia 4</td>
            <td><select name="cirugia4">
            <option  value="0" >Seleccione Cirugia</option>
            <?php 
            $sql1= " select * from cirugia ";
			$consulta1= mysql_query($sql1,$link);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>"
              <?php 
            if (isset($_GET["idci"]))
            {
	            if ($row1["ID"]==$row["CIRUGIA4"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            >
            <?php echo $row1["CIRUGIA"]?>
            </option>
            <?php } ?>
            </select></td>
          </tr>
          <tr>
          
          <tr>
          <TD WIDTH="30PX"></TD>
          	<td colspan="4" align="right">
          		<a href='rescirugia.php?id=<?php echo $IdPac?>'><input class="boton" type='button' value='Limpiar' /></a>
          		<input type="submit" class="boton" value="Guardar" class="confirm_btn" onclick="return gSubmit();" />
                <a href='pacientes.php'><input class="boton" type='button' value='Volver' /></a>
          	</td>
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
              <td colspan="4" class="mensaje">
          		<?php 
          		if (isset($mensaje)) {
          			echo $mensaje;
          		}
          		?>
          	</td>
          </tr>
     </table>
     <?php
	if (isset($_POST["mensaje"])) {
            if ($_POST["mensaje"]!=""){
        	$mensaje=$_POST["mensaje"];
		echo "<br><br><span class='Estilo3'><B>$mensaje</span>";
	}}
     ?>
   </form>
   
   
   <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="70px">
  		fecha
  		</td>
  		<td class="formTitle" width="50px">
  		Hora
  		</td>
  		<td class="formTitle" width="100px">
  		Clinica
  		</td>
  		<td class="formTitle" width="150px">
  		Ayudante
  		</td>
  		<td class="formTitle" width="150px">
  		Instrumentadora
  		</td>
  		<td ></td>
  		<td ></td>
  		<td ></td>
  	</tr>
  	<?php
    $link=Conectarse();
    $sql= " select  	ID,DATE_FORMAT(FECHA_CIRUGIA,'%d-%m-%Y') as FECHA_CIRUGIA,HORA_CIRUGIA,AYUDANTE,INSTRUMENTADORA
    ,(SELECT CLINICA FROM clinica WHERE clinica.ID = paciente_hc.CLINICA) AS CLINICA
     from paciente_hc WHERE PAGADO = 0 and CANCELADO =0 and  ID_PACIENTE = ".$IdPac."
     ORDER BY FECHA_CIRUGIA DESC  
     ";
    
    $consulta= mysql_query($sql,$link);   
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["FECHA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["HORA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["CLINICA"] ?></td>
    	<td class="formFields"> <?php echo $row["AYUDANTE"] ?></td>
    	<td class="formFields"> <?php echo $row["INSTRUMENTADORA"] ?></td>
    	<td>
    	<a href="rescirugia.php?id=<?php echo $IdPac ?>&idpay=<?php echo $row["ID"]?>"><img src="images/payment.png" alt="Pagado" align="absmiddle" /> Pagado</a>
  </td>    	
  <td>
    	<a href="rescirugia.php?id=<?php echo $IdPac ?>&idci=<?php echo $row["ID"]?>"><img src="images/Modify.png" alt="Modificar" align="absmiddle" /> Modificar</a>
  </td>
  <td>
    	<a href="rescirugia.php?id=<?php echo $IdPac ?>&idcc=<?php echo $row["ID"]?>"><img src="images/cancel.png" alt="Modificar" align="absmiddle" /> Cancelar Cirugia</a>
  </td>  
  </tr>
  	<?php
    } 
  	?>
  	
  	</table>
                </div>
                <div id="cpestana2">
                    <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="70px">
  		fecha
  		</td>
  		<td class="formTitle" width="50px">
  		Hora
  		</td>
  		<td class="formTitle" width="100px">
  		Clinica
  		</td>
  		<td class="formTitle" width="150px">
  		Ayudante
  		</td>
  		<td class="formTitle" width="150px">
  		Instrumentadora
  		</td>
  		
  		<td ></td>
  		
  	</tr>
  	<?php
    $link=Conectarse();
    $sql= " select  	ID,FECHA_CIRUGIA,HORA_CIRUGIA,AYUDANTE,INSTRUMENTADORA
    ,(SELECT CLINICA FROM clinica WHERE clinica.ID = paciente_hc.CLINICA) AS CLINICA
    
     from paciente_hc WHERE PAGADO = 1 and  ID_PACIENTE = ".$IdPac."
     ORDER BY FECHA_CIRUGIA DESC  
     ";
    
    $consulta= mysql_query($sql,$link);   
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["FECHA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["HORA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["CLINICA"] ?></td>
    	<td class="formFields"> <?php echo $row["AYUDANTE"] ?></td>
    	<td class="formFields"> <?php echo $row["INSTRUMENTADORA"] ?></td>    	
  <td>
  		<a href="rescirugia.php?id=<?php echo $IdPac ?>&idci=<?php echo $row["ID"]?>"><img src="images/Modify.png" alt="Modificar" align="absmiddle" /> Modificar</a>
    
  </td>
    
  </tr>
  	<?php
    } 
  	?>
  	
  	</table> 
  	
  	
  	
                </div>
                <div id="cpestana3">                
  	 <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="70px">
  		fecha
  		</td>
  		<td class="formTitle" width="50px">
  		Hora
  		</td>
  		<td class="formTitle" width="100px">
  		Clinica
  		</td>
  		<td class="formTitle" width="150px">
  		Ayudante
  		</td>
  		<td class="formTitle" width="150px">
  		Instrumentadora
  		</td>
  		
  		<td ></td>
  		<td ></td>
  	</tr>
  	<?php
    $link=Conectarse();
    $sql= " select  	ID,FECHA_CIRUGIA,HORA_CIRUGIA,AYUDANTE,INSTRUMENTADORA
    ,(SELECT CLINICA FROM clinica WHERE clinica.ID = paciente_hc.CLINICA) AS CLINICA
    ,CANCELADO
    
     from paciente_hc WHERE CANCELADO = 1 and  ID_PACIENTE = ".$IdPac."
     ORDER BY FECHA_CIRUGIA DESC  
     ";
    
    $consulta= mysql_query($sql,$link);   
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["FECHA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["HORA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["CLINICA"] ?></td>
    	<td class="formFields"> <?php echo $row["AYUDANTE"] ?></td>
    	<td class="formFields"> <?php echo $row["INSTRUMENTADORA"] ?></td>    	
  <td>
  <a href="rescirugia.php?id=<?php echo $IdPac ?>&idac=<?php echo $row["ID"]?>"><img src="images/active.png" alt="Activar" align="absmiddle" /> Activar</a>
  </td>  
  </tr>
  	<?php
    } 
  	?>
  	
  	</table> 
                </div>
                <div id="cpestana4">
                <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="70px">
  		fecha
  		</td>
  		<td class="formTitle" width="50px">
  		Hora
  		</td>
  		<td class="formTitle" width="100px">
  		Clinica
  		</td>
  		<td class="formTitle" width="150px">
  		Ayudante
  		</td>
  		<td class="formTitle" width="150px">
  		Instrumentadora
  		</td>
  		
  	</tr>
  	<?php
    $link=Conectarse();
    $sql= " select  	ID,FECHA_CIRUGIA,HORA_CIRUGIA,AYUDANTE,INSTRUMENTADORA
    ,(SELECT CLINICA FROM clinica WHERE clinica.ID = paciente_hc.CLINICA) AS CLINICA
     from paciente_hc WHERE FECHA_CIRUGIA>=curdate() 
     ORDER BY FECHA_CIRUGIA   
     ";
    
    $consulta= mysql_query($sql,$link);   
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["FECHA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["HORA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["CLINICA"] ?></td>
    	<td class="formFields"> <?php echo $row["AYUDANTE"] ?></td>
    	<td class="formFields"> <?php echo $row["INSTRUMENTADORA"] ?></td>
    	 
  </tr>
  	<?php
    } 
  	?>
  	
  	</table>
                </div>
                
            </div>
        </div>
</div>
</body>
<?php
