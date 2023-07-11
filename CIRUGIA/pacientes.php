<?php
session_start();
include_once 'class/conexion.php';
$_SESSION["k_breadcrumb"] ="";
$paginacion;
if (isset($_GET["idcc"]))
{
if(!($_GET["idcc"]==""))
{	
	$link=Conectarse();
    $sqlUpdPay= " delete from  paciente_hc where ID=".$_GET["idcc"]."";
    mysql_query($sqlUpdPay) or die(mysql_error()); 
    
}}
if (isset($_GET["idcci"]))
{
if(!($_GET["idcci"]==""))
{	
	$link=Conectarse();
    $sqlUpdPay= " update paciente_hc set CONFIRMADO = 1 where ID=".$_GET["idcci"]."";
    mysql_query($sqlUpdPay) or die(mysql_error()); 
    
}}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="src/js/jscal2.js"></script>
    <script src="src/js/unicode-letter.js"></script>
<script src="src/js/lang/es.js"></script>
<link type="text/css" rel="stylesheet" href="src/css/jscal2.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <script type="text/javascript" src="js/cambiarPestanna.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
            $(document).ready(function() {
            	var i=1;
            	for (i; i<=20; i++)		
            	{
					  $("#tooltip"+i).mouseover(function(){
						 eleOffset = $(this).offset();
						  
						$(this).next().fadeIn("fast").css({
								
									left: eleOffset.left + $(this).outerWidth(),
									top: eleOffset.top

								});
						}).mouseout(function(){
							$(this).next().hide();
						});
            }
			
			});		
        </script>

<title>Pacientes</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<link href="css/admin.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript">
    function paginado(pagina) {
    	document.getElementById('pag').value =pagina;
    	document.cookie = "cookieName="+pagina;
    }
</script>
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
</head>

<body>
<div id="page"> 
 <!--Start HEADER -->
 <?php 	 require_once("header.php"); 
 			 ?>
 <!-- End HEADER -->
 <!--Start CENTRAL -->
 
 <div id="central">
 
 <br/>
 <form name="form"  id="form" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
 <center><fieldset style="width: 550px; vertical-align:top;"  >
            <legend style="text-align:left">Busqueda Paciente</legend>
            
            <table width="100%" cellspacing ="10" cellpadding="10" border="0" >
            	<tr>
            	<TD WIDTH="30PX"></TD>
            		<td>Apellido </td>
            		<td>
            			<INPUT name="apellido" id="apellido" class="apellido" value="<?php echo  ((isset($_POST["apellido"]))?$_POST["apellido"]:'' ); ?>" />
            		</td>           	
            		<td>Nombre</td>
            		<td>
            			<INPUT name="nombre" id="nombre" class="nombre" value="<?php echo  ((isset($_POST["nombre"]))?$_POST["nombre"]:'' ); ?>"  />
            		</td>
            	</tr>
            	<tr>
            	<TD WIDTH="30PX"></TD>
            		<td>Cobertura </td>
            		<td>
            		<select name="cobertura" id="cobertura">
            <option value="0">Seleccione Cobertura</option>
            <?php 
            $link1=Conectarse();
            $sql1= " select * from cobertura order by COBERTURA";
			$consulta1= mysql_query($sql1,$link1);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>" 
            <?php 
            if (isset($_POST["cobertura"]))
            {
	            if ($row1["ID"]==$_POST["cobertura"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            
            > 
            <?php echo $row1["COBERTURA"]?>
            </option>
            <?php } ?>
            </select>	
            		</td>           	
            		<td>Cirugia</td>
            		<td>
            			<INPUT name="cirugia" id="cirugia" class="nombre" value="<?php echo  ((isset($_POST["cirugia"]))?$_POST["cirugia"]:'' ); ?>"  />
            		</td>
            	</tr>
            	<tr>
            	<TD WIDTH="30PX"></TD>
            		<td></td>
            		<td></td>
            		<td></td>
            		<td></td>
            	</tr>
            	<tr>
            	<TD WIDTH="30PX"></TD>
            		<td>Telefono</td>
            		<td>
            			<INPUT name="ocupacion" id="ocupacion" class="ocupacion" value="<?php echo  ((isset($_POST["ocupacion"]))?$_POST["ocupacion"]:'' ); ?>" />
            		</td>
            		<td>Año</td>
            		<td>
            			<INPUT name="anio" id="anio" size="2" class="ocupacion" value="<?php echo  ((isset($_POST["anio"]))?$_POST["anio"]:'' ); ?>" />
            		</td>
            	</tr>
            	<tr>
            	<TD WIDTH="30PX"></TD>
            		<td>Fecha Desde</td>
            		<td>
            			<input size="8" id="f_rangeStart" NAME="f_rangeStart"  value="<?php
			$hoy ="";	
			$fecaho_hoy ="";
            if (isset($_POST["f_rangeStart"]))
			{
				$fecaho_hoy =explode("/", $_POST["f_rangeStart"]);
				$date =date_create($fecaho_hoy[0].'-'.$fecaho_hoy[1].'-'.$fecaho_hoy[2]);
			
            echo  date_format($date,'d/m/Y');
			}
			?>"
            />
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
                 
                </script>
            		</td>
            		<td>Hasta</td>
            		<td>
            			<input size="8" id="f_rangeEnd" NAME="f_rangeEnd"  value="<?php
			$hoy ="";	
			$fecaho_hoy ="";
            if (isset($_POST["f_rangeEnd"]))
			{
				$fecaho_hoy =explode("/", $_POST["f_rangeEnd"]);
				$date =date_create($fecaho_hoy[0].'-'.$fecaho_hoy[1].'-'.$fecaho_hoy[2]);
			
            echo  date_format($date,'d/m/Y');
			}
			?>"
            />
                <button id="f_rangeEnd_trigger">...</button>                
                <script type="text/javascript">
                  RANGE_CAL_1 = new Calendar({
                          inputField: "f_rangeEnd",
                          dateFormat: " %d/%m/%Y",
                          trigger: "f_rangeEnd_trigger",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                  this.hide();
                          }
                  });
                 
                </script>
            		</td>
            	</tr>
            	<tr>
            	<TD WIDTH="30PX"></TD>
            	<td colspan="4" align="right">
            		
            		
            		<input type="submit" class="boton" value="Buscar"  />
            		<a href="pacientes.php" class="boton" >Limpiar</a> 
            	</td>
            	</tr>
            </table>
            
     
 
  </fieldset></center>
   <a href="abmPacientes.php"><img src="images/add.png" alt="Agregar" align="absmiddle" /> Agregar Paciente </a><br><br>
   <!--Start FORM -->
   
	<?php 
       $limit = 20;
       		
		// pagina pedida
		$pag = 0;
		if (isset($_POST["pag"]))
		{
				if (isset($_COOKIE['cookieName']))
					$pag = (int) ($_COOKIE['cookieName']);
				else
					$pag = 0;
					 			 
		}
		
		if ($pag < 1)
		{
		   $pag = 1;
		}		
		$offset = ($pag-1) * $limit;
		$finalqry = 	"order by 1 LIMIT  $offset, $limit";	
		?>
	<div class="contenedor">	
	<div id="pestanas">
                <ul id=lista>
                    <li id="pestana1"><a href='javascript:cambiarPestanna(pestanas,pestana1);'>Pacientes </a></li>
                    <li id="pestana2"><a href='javascript:cambiarPestanna(pestanas,pestana2);'>Cirugias programadas</a></li>
                </ul>
            </div>
            
            <body <?php 
            if (isset($_GET["idcc"]) || isset($_GET["idcci"]))
            {?>
            onload="javascript:cambiarPestanna(pestanas,pestana2);"
            <?php 
            }
            else
            {?>
            onload="javascript:cambiarPestanna(pestanas,pestana1);"
            <?php }?>> 
            
            
	<div id="contenidopestanas">
                <div id="cpestana1">
	
    <table class="form">
  	<tr class="rowGris">
  	<td></td>
  		<td class="formTitle" width="170px">
  		Paciente
  		</td>
  		<td class="formTitle" width="190px">
  		Telefono
  		</td>
  		<td class="formTitle" width="120px">
  		Cobertura
  		</td>
  		<td class="formTitle" width="190px">
  		Nro Afiliado
  		</td>
  		
  		
  		<td></td>
  		<td></td>
  		
    <?php
    $link=Conectarse();
    $condition =" WHERE (1=1) ";
    if (isset($_POST["f_rangeStart"]) && isset($_POST["f_rangeEnd"]))
    {
    	if ($_POST["f_rangeStart"] &&  $_POST["f_rangeEnd"])
    		$condition.=" AND ID IN(select ID_PACIENTE from paciente_hc where  FECHA_CIRUGIA >= str_to_date('".$_POST["f_rangeStart"]."','%d/%m/%Y') and FECHA_CIRUGIA <= str_to_date('".$_POST["f_rangeEnd"]."','%d/%m/%Y') )";
    }
    else
    {
    	if (isset($_POST["f_rangeStart"]) )
    	{
    		if ($_POST["f_rangeStart"] )
    		$condition.=" AND ID IN(select ID_PACIENTE from paciente_hc where  FECHA_CIRUGIA >= str_to_date('".$_POST["f_rangeStart"]."','%d/%m/%Y') )";
    	}
    	if (isset($_POST["f_rangeEnd"]) )
    	{
    		if ($_POST["f_rangeEnd"] )
    		$condition.=" AND ID IN(select ID_PACIENTE from paciente_hc where  FECHA_CIRUGIA <= str_to_date('".$_POST["f_rangeEnd"]."','%d/%m/%Y') )";
    	}
    	
    }
    if (isset($_POST["nombre"]))
    {
    	if ($_POST["nombre"])
    		$condition.=" AND  NOMBRES LIKE '%".$_POST["nombre"]."%' ";
    }
    if (isset($_POST["apellido"]))
    {
    	if ($_POST["apellido"])
    		$condition.=" AND  APELLIDO LIKE '%".$_POST["apellido"]."%' ";
    }
    if (isset($_POST["cobertura"]))
    {
    	if ($_POST["cobertura"])
    		$condition.=" AND  COBERTURA =".$_POST["cobertura"]." ";
    }
    if (isset($_POST["ocupacion"]))
    {
    	if ($_POST["ocupacion"])
    		$condition.=" AND  OCUPACION LIKE '%".$_POST["ocupacion"]."%' ";
    }
    if (isset($_POST["cirugia"]))
    {
    	if ($_POST["cirugia"])
    		$condition.=" AND  OBSERVACIONES LIKE '%".$_POST["cirugia"]."%' ";
    }
    
    if ($condition==" WHERE (1=1) ")
    	$condition=" where ID =0 " ;
    $sql= " select concat(APELLIDO,concat(', ',NOMBRES))AS PACIENTE
    ,(select COBERTURA from cobertura where cobertura.ID =pacientes.COBERTURA) as COBERTURA
    ,OCUPACION, ID,NRO_AFILIADO 
     from pacientes  ".$condition.$finalqry;
    
    $consulta= mysql_query($sql,$link);
    $sqlTotal = "SELECT count(*) as total from pacientes ".$condition;
   
    
		  
	$rs = mysql_query($sql);
	$rsTotal = mysql_query($sqlTotal);
		 
	$rowTotal = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
	$total = $rowTotal["total"];
	$contador=0;
    while($row= mysql_fetch_assoc($consulta)) 
    {$contador++;
    ?>
    <tr class="rowBlanco">
    <td>
    	<a id="tooltip<?php echo $contador?>" href="#"><img width="28px" height="28px" src="images/info.png" align="absmiddle" /></a>
    	<div class="tooltip">
    
    <!-- Inicio Tooltip para mostrar info agrupada -->
    <table class="form">
  	<tr class="rowGris">
  	<td class="formTitle" width="80px">
  		Fecha
  		</td>
  		<td class="formTitle" width="120px">
  		Nro Afiliado
  		</td>
  		<td class="formTitle" width="190px">
  		Observaciones Cirugia
  		</td>
  		<td class="formTitle" width="80px">
  		Estado
  		</td>
  	</tr>	
    <?php
   
    $condition =" and paciente_hc.ID_PACIENTE =".$row["ID"]." order by FECHA_CIRUGIA desc";
    $sqltool= " select concat(APELLIDO,concat(', ',NOMBRES))AS PACIENTE
    ,paciente_hc.ID
    ,NRO_AFILIADO
    ,(select COBERTURA from cobertura where paciente_hc.COBERTURA = cobertura.ID ) as COBERTURA
    ,paciente_hc.OBSERVACIONES
    ,(case when PAGADO = 1 then 'Pagado' 
    		when   PAGADO = 0 then 'Adeuda' end) as ESTADO 
    ,date_format(FECHA_CIRUGIA,'%d/%m/%Y') as FECHA_CIRUGIA
    ,pacientes.ID as IDPAC
     from pacientes  , paciente_hc where pacientes.ID = paciente_hc.ID_PACIENTE ".$condition;
    
    $consultatool= mysql_query($sqltool,$link);
    $rs = mysql_query($sqltool);
	
	if ($consultatool)
	{
    while($rowTool= mysql_fetch_assoc($consultatool)) 
    {?>
    <tr class="rowBlanco">
    <td class="formFields"> <?php echo $rowTool["FECHA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $rowTool["NRO_AFILIADO"] ?></td>
    	<td class="formFields"> <?php echo $rowTool["OBSERVACIONES"] ?></td>
    	<td class="formFields"> <?php if ($rowTool["ESTADO"]=='Pagado')
    						{
    							echo $rowTool["ESTADO"];
    						}
    						else 
    						{?>
    	<font color="red"><B><?php echo $rowTool["ESTADO"] ?></B></font>
    	<?php }?></td>
    	  </tr>
    	<?php 
    }  }   
     ?>
  
 </table>
    <!-- Fin mostrar info agrupada en tooltip -->
    
    
    	</div> 
  </td>
    	<td class="formFields"> <?php echo $row["PACIENTE"] ?></td>
    	<td class="formFields"> <?php echo $row["OCUPACION"] ?></td>
    	<td class="formFields"> <?php echo $row["COBERTURA"] ?></td>
    	<td class="formFields"> <?php echo $row["NRO_AFILIADO"] ?></td>    	
    	<td>
    	<a href="rescirugia.php?id=<?php echo $row["ID"] ?>"><img src="images/select.png" alt="Cirugia" align="absmiddle" /> Cirugia</a>
  </td>    	
  <td>
    	<a href="abmPacientes.php?id=<?php echo $row["ID"] ?>&root=1" ><img src="images/Modify.png" alt="Modificar" align="absmiddle" /> Modificar</a>
  </td>  
  </tr>
    	<?php 
    }     
     ?>
  
  <tr>
  <td  class="mensaje" colspan="3">
         <?php
          	if (isset($mensaje)) {
                    echo $mensaje;
          	}
         ?>
  </td>
  </tr>
 </table>
 </div>
 <div id="cpestana2">
 <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="100px">
  		Clinica
  		</td>
  		<td class="formTitle" width="70px">
  		fecha
  		</td>
  		<td class="formTitle" width="30px">
  		Hora
  		</td>
  		<td class="formTitle" width="100px">
  		Paciente
  		</td>
  		<td class="formTitle" width="100px">
  		Telefono
  		</td>
  		
  		<td class="formTitle" width="100px">
  		Cirugia
  		</td>
  		<td width="120px">
  		</td>
  		<td width="120px">
  		</td>
  		<td width="80px">
  		</td>
  		<td width="130px">
  		</td>
  		
  		
  	</tr>
  	<?php
    
    $sqlT= " select  	ID,
    DATE_FORMAT(FECHA_CIRUGIA,'%d-%m-%Y') as FECHACIRUGIA,HORA_CIRUGIA,AYUDANTE,INSTRUMENTADORA
    ,(SELECT CLINICA FROM clinica WHERE clinica.ID = paciente_hc.CLINICA) AS CLINICA
    ,OBSERVACIONES
    ,(select concat(APELLIDO,concat(', ',NOMBRES)) from pacientes where pacientes.ID =paciente_hc.ID_PACIENTE  )AS PACIENTE
    ,(select OCUPACION from pacientes where pacientes.ID =paciente_hc.ID_PACIENTE  )AS TELEFONO
    ,ID_PACIENTE 
    ,CONFIRMADO
     from paciente_hc WHERE FECHA_CIRUGIA>=curdate()
     and CANCELADO =0 
     order by FECHA_CIRUGIA,HORA_CIRUGIA
        
     ";
    
    $consultaT= mysql_query($sqlT,$link);   
	
    while($rowT= mysql_fetch_assoc($consultaT)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $rowT["CLINICA"] ?></td>
    	<td class="formFields"> <?php echo $rowT["FECHACIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $rowT["HORA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $rowT["PACIENTE"] ?></td>
    	<td class="formFields"> <?php echo $rowT["TELEFONO"] ?></td>    	
    	
    	<td class="formFields"> <?php echo $rowT["OBSERVACIONES"] ?></td>
    	<td>
    	<a href="abmPacientes.php?id=<?php echo $rowT["ID_PACIENTE"] ?>&root=1" ><img src="images/Modify.png" alt="Modificar" align="absmiddle" /> Filiacion</a>
  </td>
    	<td>
    	<?php if ($rowT["CONFIRMADO"]==0)
    		{?>
    		<a href="pacientes.php?idcci=<?php echo $rowT["ID"]?>"><img src="images/confirm.png" alt="No confirmada" align="absmiddle" /> No confirmado</a>
    		<?php 
    		}
    		else
    		{
    		?>
    		<font color="green"><b>Confirmado</b></font>
    		<?php 
    		}
    		?>
  </td> 
    	<td>
    	<a href="rescirugia.php?id=<?php echo $rowT["ID_PACIENTE"] ?>&idci=<?php echo $rowT["ID"]?>"><img src="images/select.png" alt="Cirugia" align="absmiddle" /> Cirugia</a>
  </td> 
  <td>
    	<a href="pacientes.php?idcc=<?php echo $rowT["ID"]?>"><img src="images/cancel.png" alt="Modificar" align="absmiddle" /> Anular Cirugia</a>
  </td>
    	 
  </tr>
  	<?php
    } 
  	?>
  	
  	</table>
 </div>
 </div>
 </body>
 </div>
		<div id="paginacion" style="text-align:left; margin-top:30px;">     <?php
         $totalPag = ceil($total/$limit);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
         	?>
         	<input type="hidden" name="pag" id="pag" value="0" />
         	<input type="submit"  onclick="return paginado(this.value);" value="  <?php echo $i?>  "  />
         	<?php 
             
         }
         
      ?>
    </div>
    <br></br>
	
   </form>
   <!--End FORM -->
 </div> <!--End CENTRAL -->
 <br clear="all" />
</div>
<!--
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
-->
</body>
</html>