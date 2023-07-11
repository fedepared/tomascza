<?php
session_start();
include_once 'class/conexion.php';
$_SESSION["k_breadcrumb"] ="";
if(isset($_GET["ape"]))
{
	$link=Conectarse();
    $sqlBedDel= " UPDATE PEDIDOS  set ENTREGADO=1, FECHA_ENTREGA=curdate()  where NRO_PEDIDO =".$_GET["ape"]; 
    $consultaBed= mysql_query($sqlBedDel,$link);
}
if(isset($_GET["apc"]))
{
	$link=Conectarse();
    $sqlBedDel= " UPDATE PEDIDOS  set CAMBIO=1 where NRO_PEDIDO =".$_GET["apc"]; 
    $consultaBed= mysql_query($sqlBedDel,$link);
}
if(isset($_GET["apce"]))
{
	$link=Conectarse();
    $sqlBedDel= " UPDATE PEDIDOS  set ENTREGADO=1, FECHA_ENTREGA=curdate()  where NRO_PEDIDO =".$_GET["apce"]; 
    $consultaBed= mysql_query($sqlBedDel,$link);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Titulo ECOMMERS:.</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<link href="css/admin.css" rel="stylesheet" type="text/css" />-->
</head>

<body>
<div id="page"> 
 <!--Start HEADER -->
 <?php 	 require_once("header.php"); 
 			 ?>
 <!-- End HEADER -->
 <!--Start CENTRAL -->
 <div id="central">
   <h1>Administración de Compras de Productos</h1>
   
   <!--Start FORM -->
   <form ACTION="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<?php 
       $limit = 30;		
		// pagina pedida
		$pag = 0;
		if (isset($_GET["pag"]))
				$pag = (int) ($_GET["pag"]);
		
		
		if ($pag < 1)
		{
		   $pag = 1;
		}		
		$offset = ($pag-1) * $limit;
		$finalqry = 	"order by 1 desc LIMIT  $offset, $limit";	
		?>
    <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="120px">
  		Nro de Pedido
  		</td>
  		<td class="formTitle" width="200">
  		Usuario
  		</td>
  		<td class="formTitle" width="200">fecha de compra</td>
  		<td class="formTitle" width="200">Estado</td>
  		<td>Entregado</td>
  		<td>Cambio</td>
  		<td>Entrega por<br />
  		  Cambio</td>
    <?php
    $link=Conectarse();
    $sql= " select FECHA,NRO_PEDIDO, SUM(PRECIO*CANTIDAD)as MONTO 
			,(SELECT USUARIO from clientes where ID = PEDIDOS.CLIENTE) as CLIENTE
			,(case when ENTREGADO = 1 && CAMBIO=0 then 'Entregado' when CAMBIO = 1 && ENTREGADO=0 then 'Devuelto a Cambio'
				when ENTREGADO = 1 && CAMBIO = 1 then 'Entrega por Cambio'
              	else  'Entrega Pendiente'
              end) as ESTADO
			,FECHA_ENTREGA
			,ENTREGADO
			,CAMBIO
			from PEDIDOS group by FECHA,NRO_PEDIDO,ENTREGADO,CAMBIO
			".$finalqry;
    
    $consulta= mysql_query($sql,$link);
    
    $sqlTotal = "SELECT FOUND_ROWS() as total";
       
	if ($consulta)
	{	  
		$rsTotal = mysql_query($sqlTotal,$link);		 	
		$rowTotal = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
		$total = $rowTotal["total"];
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["NRO_PEDIDO"] ?></td>
    	<td class="formFields"> <?php echo $row["CLIENTE"] ?></td>
    	<td class="formFields"><?php echo $row["FECHA"] ?></td>
    	<td class="formFields">    		 
    	<?php	if ($row["ENTREGADO"]>0 && $row["CAMBIO"]>0)
    		{
    		?>
    		<font color="darkgreen"><b>
    		<?php 
    		
    		}
    		else{ if ($row["ENTREGADO"]>0 && $row["CAMBIO"]<1)
    		{?>
    		<font color="green"><b>
    		<?php }
    		else {?><font color="darkred"><b><?php }
    		} 
    		echo $row["ESTADO"] ?> 
    	</b></font>
    	</td>
 <td>
 	<?php if ($row["ENTREGADO"]>0 || $row["CAMBIO"]>0)
 	{
 	?>
    	  <font color="darkblue"><b>Entregado</b> </font>
    	  <?php }
    	  else 
    	  {?><img src="images/edit.png" alt="Entregado" align="absmiddle" /><a href="administracion_de_producto.php?ape=<?php echo $row["NRO_PEDIDO"] ?>"> Entregado</a>
    	  <?php 
    	  	
    	  }?>
  </td>    	
  <td>
	  	<?php if ($row["ENTREGADO"]>0 || $row["CAMBIO"]>0)
	 	{
	 	?>	  <font color="darkblue"><b>Cambio</b> </font>
    	  <?php }
    	  else 
    	  {?>
    	<img src="images/edit.png" alt="Cambio" align="absmiddle" /><a href="administracion_de_producto.php?apc=<?php echo $row["NRO_PEDIDO"] ?>" > Cambio</a>
    	<?php }?>
  </td>
  <td>
  <?php if ($row["ENTREGADO"]>0)
	 	{
	 	?>	  <font color="darkblue"><b>Entrega Cambio</b> </font>
    	  <?php }
    	  else 
    	  {?>
    	<img src="images/edit.png" alt="Entrega por Cambio" align="absmiddle" /><a href="administracion_de_producto.php?apce=<?php echo $row["NRO_PEDIDO"] ?>" > Entrega Cambio</a>
    	<?php }?>
  </td>
  </tr>
    	<?php 
    }   }  
     ?>
  
  <tr>
  <td  class="mensaje">
         <?php
          	if (isset($mensaje)) {
                    echo $mensaje;
          	}
         ?>
  </td>
  <td  class="mensaje">&nbsp;</td>
  <td  class="mensaje">&nbsp;</td>
  <td  class="mensaje">&nbsp;</td>
  </tr>
 </table>
		<div id="paginacion" style="text-align:left; margin-top:30px;">     <?php
         $totalPag = ceil($total/$limit);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
            $links[] = "<a href=\"?pag=$i\">Pag $i</a>"; 
         }
         echo implode(" - ", $links);
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