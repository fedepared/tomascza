<?php
session_start();
include_once 'class/conexion.php';
$_SESSION["k_breadcrumb"] ="";
$idPacientes="";
$paginacion;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pacientes</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<link href="css/admin.css" rel="stylesheet" type="text/css" />-->
<script src="src/js/jscal2.js"></script>
    <script src="src/js/unicode-letter.js"></script>
<script src="src/js/lang/es.js"></script>
<link type="text/css" rel="stylesheet" href="src/css/jscal2.css" />
<script type="text/javascript">
    function cargar()
    {
    	document.getElementById('mails').value =document.getElementById('mailstopas').value; 
    } 
    </script>
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
 <center>
 <fieldset style="width: 550px; vertical-align:top;"  >
            <legend style="text-align:left">Facturacion Mensual</legend>
 <form ACTION="excel.php" method="post" >
		<input type="hidden" id="mails" name="mails" value="" />
		<input type="submit" class="boton" value="Generar Excel"  />
	</form>
	</fieldset>
	</center>
 <form name="form"  id="form" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
 <center><fieldset style="width: 550px; vertical-align:top;"  >
            <legend style="text-align:left">Busqueda Paciente</legend>
            
            <table width="100%" cellspacing ="10" cellpadding="10" border="0" >
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
			<td>Clinica</td>
            <td>
            <select name="clinica" id="clinica">
            <option value="0">Seleccione Cobertura</option>
            <?php 
            $link1=Conectarse();
            $sql1= " select * from clinica order by CLINICA";
			$consulta1= mysql_query($sql1,$link1);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["ID"]?>" 
            <?php 
            if (isset($_POST["clinica"]))
            {
	            if ($row1["ID"]==$_POST["clinica"])
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
            </select>
            </td>
        </tr>
            	
            	<tr>
            	<TD WIDTH="30PX"></TD>
            		<td>Mes
            		
            		</td>
            		<td>
            		<select name="mes" id="mes">
            		<option value="1"
            		<?php if (01==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Enero</option>
            		<option value="2"
            		<?php if (02==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Febrero</option>
            		<option value="3"
            		<?php if (03==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Marzo</option>
            		<option value="4"
            		<?php if (04==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Abril</option>
            		<option value="5"
            		<?php if (05==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Mayo</option>
            		<option value="6"
            		<?php if (06==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Junio</option>
            		<option value="7"
            		<?php if (07==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Julio</option>
            		<option value="8"
            		<?php if (08==date("m"))
            		{?>
            		selected
            		<?php }?>
            		>Agosto</option>
					<option value="9"
					<?php if (09==date("m"))
            		{?>
            		selected
            		<?php }?>
					>Septiembre</option>
					<option value="10"
					<?php if (10==date("m"))
            		{?>
            		selected
            		<?php }?>
					>Octubre</option>
					<option value="11"
					<?php if (11==date("m"))
            		{?>
            		selected
            		<?php }?>
					>Noviembre</option>
					<option value="12"
					<?php if (12==date("m"))
            		{?>
            		selected
            		<?php }?>
					>Diciembre</option>
            		</select>
            		</td>
            		<td>Año
            		<?php ;?>
            		</td>
            		<td><select name="anio" id="anio">
            		<?php for ($i=2000;$i<2060;$i++)
            		{?>
            		<option value="<?php echo $i ?>"
            		<?php if ($i==date("Y"))
            		{
            		?>
            		 selected
            		 <?php }?>
            		> <?php
            		
            		 echo $i ?> </option>
            		<?php }?>
            		</select></td>
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
            	<td colspan="4" align="right">
            		
            		
            		<input type="submit" class="boton" value="Buscar"  />
            		<a href="panelpacientes.php" class="boton" >Limpiar</a> 
            	</td>
            	</tr>
            </table>
            
     
 
  </fieldset></center>
   <br>
   <!--Start FORM -->
   
	<?php 
       $limit = 30;
       		
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
		$finalqry = 	"order by FECHA_CIRUGIA desc LIMIT  $offset, $limit";	
		?>
	</br>
	
    <table class="form">
  	<tr class="rowGris">
  	<td class="formTitle" width="80px">
  		Clinica
  		</td>
  	<td class="formTitle" width="80px">
  		Fecha
  		</td>
  		<td class="formTitle" width="50px">
  		Hora
  		</td>
  		<td class="formTitle" width="170px">
  		Paciente
  		</td>
  		<td class="formTitle" width="170px">
  		Telefono
  		</td>
  		<td class="formTitle" width="190px">
  		Cobertura
  		</td>
  		<td class="formTitle" width="120px">
  		Nro Afiliado
  		</td>
  		<td class="formTitle" width="220px">
  		Observaciones Cirugia
  		</td>
  		
  		<td class="formTitle">Facturar</td>
  		
  		
    <?php
    $link=Conectarse();
    $condition ="";
    if (isset($_POST["mes"]) && isset($_POST["anio"]))
    {
    	$mesPro=$_POST["mes"]+1;
    	
    		$condition.=" AND  FECHA_CIRUGIA >= str_to_date('01/".$_POST["mes"]."/".$_POST["anio"]."','%d/%m/%Y') ";
    		$condition.=" AND  FECHA_CIRUGIA < str_to_date('01/".$mesPro."/".$_POST["anio"]."','%d/%m/%Y') ";
    }
    if (isset($_POST["cobertura"]))
    {
    	if ($_POST["cobertura"])
    		$condition.=" AND  pacientes.COBERTURA =".$_POST["cobertura"]." ";
    }

    if (isset($_POST["clinica"]))
    {
    	if ($_POST["clinica"])
    		$condition.=" AND  paciente_hc.CLINICA =".$_POST["clinica"]." ";
    }
    
    
    
    $sql= " select concat(APELLIDO,concat(', ',NOMBRES))AS PACIENTE
    ,paciente_hc.ID
    ,NRO_AFILIADO
    ,(select COBERTURA from cobertura where paciente_hc.COBERTURA = cobertura.ID ) as COBERTURA
    ,paciente_hc.OBSERVACIONES
    ,(case when PAGADO = 1 then 'Pagado' 
    		when   PAGADO = 0 then 'Adeuda' end) as ESTADO 
    ,FECHA_CIRUGIA
    ,OCUPACION
    ,HORA_CIRUGIA
    ,pacientes.ID as IDPAC
    ,(select CLINICA from clinica where clinica.ID = paciente_hc.CLINICA) as DSCLINICA
     from pacientes  , paciente_hc where pacientes.ID = paciente_hc.ID_PACIENTE 
     and CANCELADO =0 ".$condition.$finalqry;
    
    $consulta= mysql_query($sql,$link);
    
    $sqlTotal = "SELECT count(*) as total from pacientes , paciente_hc WHERE pacientes.ID=paciente_hc.ID_PACIENTE ".$condition;
   
    
		  
	$rs = mysql_query($sql);
	$rsTotal = mysql_query($sqlTotal);
		 
	$rowTotal = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
	$total = $rowTotal["total"];
	if ($consulta)
	{
    while($row= mysql_fetch_assoc($consulta)) 
    {$idPacientes =$idPacientes .$row["ID"].",";
    ?>
    
   
    <tr class="rowBlanco">
    <td class="formFields"> <?php echo $row["DSCLINICA"] ?></td>
    <td class="formFields"> <?php echo $row["FECHA_CIRUGIA"] ?></td>
    <td class="formFields"> <?php echo $row["HORA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["PACIENTE"] ?></td>
    	<td class="formFields"> <?php echo $row["OCUPACION"] ?></td>
    	<td class="formFields"> <?php echo $row["COBERTURA"] ?></td>
    	<td class="formFields"> <?php echo $row["NRO_AFILIADO"] ?></td>
    	<td class="formFields"> <?php echo $row["OBSERVACIONES"] ?></td>
    	
    	<td class="formFields" >
    	<center>
    							<input type="checkbox"  value="<?php echo $row["ID"]?>"
    							onChange="if(this.checked){document.getElementById('mails').value =document.getElementById('mails').value+this.value+','; }else{document.getElementById('mails').value =document.getElementById('mails').value.replace( this.value+',','');};"
    							/>
    						<!-- 	<a href="actualizarpago.php?idpay=<?php echo $row["ID"] ?>"><img src="images/payment.png" alt="Pagado" align="absmiddle" /> Pagado</a> -->
    	</center>
  </td>    	
  
  </tr>
    	<?php 
    }  }   
     ?>
     <input type="hidden" id="mailstopas" name="mailstopas" value="<?php echo $idPacientes;?>" />
   <?php
    echo "<script  languaje='javascript'>
         cargar();     
    </script>"; 
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