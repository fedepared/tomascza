<?php
session_start();
include_once 'class/conexion.php';
$_SESSION["k_breadcrumb"] ="";
$paginacion;
if (isset($_GET["idpay"]))
{
if(!($_GET["idpay"]==""))
{	
	$link=Conectarse();
    $sqlUpdPay= " update paciente_hc set PAGADO = 1 where ID=".$_GET["idpay"]."";
    mysql_query($sqlUpdPay) or die(mysql_error()); 
    
}}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pacientes</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<link href="css/admin.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript">
function pagar(obj)
{
if(obj.checked==true)
	{
	
	obj.checked=true;
	document.getElementById('pagos').value =+ document.getElementById('pagos').value+obj.value+',';
	alert(document.getElementById('pagos').value );	
	}
else
	{
	obj.checked=false;
	document.getElementById('pagos').value =document.getElementById('pagos')value.replace( obj.value+',');
	alert(document.getElementById('pagos').value );	
	}

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
            <legend style="text-align:left">Aplicar pagos</legend>
 <form ACTION="actualizarpago.php" method="post" >
		<input type="hidden" id="pagos" name="pagos" value="" />
		<input type="submit" class="boton" value="Aplicar Pagos"  />
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
            		    		<td><select name="cobertura" id="cobertura">
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
            </select></td>
			<td>Estado</td>
            <td>
            <select name="estado" id="estado">
            <option value=""
             <?php 
            if (isset($_POST["estado"]))
            {
	            if (''==$_POST["estado"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?> 
            >Ambos</option>
            <option value="1"
             <?php 
            if (isset($_POST["estado"]))
            {
	            if ('1'==$_POST["estado"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>  
            >Pagado</option>
            <option value="0"
             <?php 
            if (isset($_POST["estado"]))
            {
	            if ('0'==$_POST["estado"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>  
            >Adeuda</option>
            
            </select> 
            </td>
        </tr>
        
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
            		<td>Cirugia</td>
            		<td>
            			<INPUT name="cirugia" id="cirugia" class="apellido" value="<?php echo  ((isset($_POST["cirugia"]))?$_POST["cirugia"]:'' ); ?>" />
            		</td>           	
            		<td>Clnica</td>
            		<td>
            			<select name="clinica" id="clinica">
            <option value="0">Seleccione Clinica</option>
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
		$finalqry = 	"order by FECHA_CIRUGIA  LIMIT  $offset, $limit";	
		?>
	</br>
	
    <table class="form">
  	<tr class="rowGris">
  	<td class="formTitle" width="80px">
  		Fecha
  		</td>
  		<td class="formTitle" width="170px">
  		Paciente
  		</td>
  		<td class="formTitle" width="190px">
  		Cobertura
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
  		<td class="formTitle">Pagar</td>
  		<td></td>
  		
    <?php
    $link=Conectarse();
    $condition ="";
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
    		$condition.=" AND  paciente_hc.COBERTURA =".$_POST["cobertura"]." ";
    }
    if (isset($_POST["cirugia"]))
    {
    	if ($_POST["cirugia"])
    		$condition.=" AND  paciente_hc.OBSERVACIONES like '%".$_POST["cirugia"]."%' ";
    }
    if (isset($_POST["estado"]))
    {
    	if (!($_POST["estado"]==''))
    	{
    		
    		if ($_POST["estado"]>=0)
    		{
    			$condition.=" AND  paciente_hc.PAGADO = ".$_POST["estado"]." ";
    		}
    		
    	}
    }
    if (isset($_POST["clinica"]))
    {
    	if ($_POST["clinica"])
    		$condition.=" AND  CLINICA =".$_POST["clinica"]." ";
    }
        
    if ($condition=="")
    	$condition=" and pacientes.ID =0";
    
    
    
    $sql= " select concat(APELLIDO,concat(', ',NOMBRES))AS PACIENTE
    ,paciente_hc.ID
    ,NRO_AFILIADO
    ,(select COBERTURA from cobertura where paciente_hc.COBERTURA = cobertura.ID ) as COBERTURA
    ,paciente_hc.OBSERVACIONES
    ,(case when PAGADO = 1 then 'Pagado' 
    		when   PAGADO = 0 then 'Adeuda' end) as ESTADO 
    ,date_format(FECHA_CIRUGIA,'%d/%m/%Y') as FECHA_CIRUGIA
    ,pacientes.ID as IDPAC
     from pacientes  , paciente_hc where pacientes.ID = paciente_hc.ID_PACIENTE ".$condition.$finalqry;
    
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
    {?>
    <tr class="rowBlanco">
    <td class="formFields"> <?php echo $row["FECHA_CIRUGIA"] ?></td>
    	<td class="formFields"> <?php echo $row["PACIENTE"] ?></td>
    	<td class="formFields"> <?php echo $row["COBERTURA"] ?></td>
    	<td class="formFields"> <?php echo $row["NRO_AFILIADO"] ?></td>
    	<td class="formFields"> <?php echo $row["OBSERVACIONES"] ?></td>
    	<td class="formFields"> <?php if ($row["ESTADO"]=='Pagado')
    						{
    							echo $row["ESTADO"];
    						}
    						else 
    						{?>
    	<font color="red"><B><?php echo $row["ESTADO"] ?></B></font>
    	<?php }?></td>
    	<td class="formFields" >
    	  						<?php if (!($row["ESTADO"]=='Pagado'))
    						{
    							?>
    							<input type="checkbox"  value="<?php echo $row["ID"]?>"
    							onChange="if(this.checked){document.getElementById('pagos').value =document.getElementById('pagos').value+this.value+','; }else{document.getElementById('pagos').value =document.getElementById('pagos').value.replace( this.value+',','');};"
    							/>
    						<!-- 	<a href="actualizarpago.php?idpay=<?php echo $row["ID"] ?>"><img src="images/payment.png" alt="Pagado" align="absmiddle" /> Pagado</a> -->
    							<?php 
    						}
    					?>
    	
  </td>    	
  <td>

    	<a href="rescirugia.php?id=<?php echo $row["IDPAC"] ?>&idci=<?php echo $row["ID"]?>" ><img src="images/select.png" alt="Cirugia" align="absmiddle" /> Cirugia</a>
  </td>  
  </tr>
    	<?php 
    }  }   
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