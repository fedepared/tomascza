<?php
session_start();
include_once 'class/conexion.php';
$idcategoria =((isset($_GET["md"]))?$_GET["md"]:0) ;
if (isset($_GET["mde"]))
{
if(!($_GET["mde"]==""))
{	
	$link=Conectarse();
    $sqlBedDel= " delete from menu_categorias where id =".$_GET["mde"]."";
    mysql_query($sqlBedDel) or die(mysql_error()); 
    
} 
}
if (isset($_GET["elpro"]))
{
if(!($_GET["elpro"]==""))
{	
	$link=Conectarse();
    $sqlBedDel= " delete from productos where id =".$_GET["elpro"]."";
    mysql_query($sqlBedDel) or die(mysql_error()); 
    
} 
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
   
   <b><a href="Mini-Turista.php" >INICIO</a>
   <?php
   $link=Conectarse();
    $sqlBed= " 
    	select categoria
		,id
		from menu_categorias
		where id = ".$idcategoria." and CD_MINITURISMO = 1"; 
   $consultaBed= mysql_query($sqlBed,$link);
   if ($rowBed= mysql_fetch_assoc($consultaBed))
   {
   	//echo "<script type='text/javascript'>alert(".strlen($rowBed["categoria"]).");</script>";
   	if (!(strpos($_SESSION["k_breadcrumb"],$rowBed["id"])>0))
   	{
   	   	$_SESSION["k_breadcrumb"] .= "> <a href='newcateg-subcateg.php?md=".$rowBed["id"]."' >". strtoupper($rowBed["categoria"])."</a>";
   	   	$_SESSION["k_breadcrumb"] = substr($_SESSION["k_breadcrumb"],0,strripos($_SESSION["k_breadcrumb"],$rowBed["id"])+strlen($rowBed["categoria"])+5);
   	}
   	else
   	{
   		//echo "<script type='text/javascript'>alert(".strlen($rowBed["categoria"]).");</script>";
   		$_SESSION["k_breadcrumb"] = substr($_SESSION["k_breadcrumb"],0,strripos($_SESSION["k_breadcrumb"],$rowBed["id"])+strlen($rowBed["categoria"])+5);
   	}
   	echo $_SESSION["k_breadcrumb"] ;   	
   }
   ?></b>
 			 <br></br>
 			 <h1>Subcategorias </h1>
   <a href="abmMiniTurismo.php?root=0&padre=<?php echo $idcategoria?>"><img src="images/add.png" alt="Agregar" align="absmiddle" /> Agregar Subcategorias</a><br><br>
   <!--Start FORM -->
   <form ACTION="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<?php 
       	
		?>
    <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="100px">
  		Tipo 
  		</td>
  		<td class="formTitle" width="190px">
  		Descripcion
  		</td>
  		<td></td>
  		<td></td>
  		<td></td>
    <?php
    $link=Conectarse();
    
    $sql= " select * from menu_categorias  where padre =".$idcategoria." and CD_MINITURISMO = 1 ".$finalqry;
    
     
    $consulta= mysql_query($sql,$link);
    if ($consulta)
    {
	
    while($row= mysql_fetch_assoc($consulta)) 
    {
    	
    ?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["categoria"] ?></td>
    	<td class="formFields"> <?php echo $row["descripcion"] ?></td>    	
  <td>
    	<img src="images/edit.png" alt="Seleccionar" align="absmiddle" /><a href="newMini-Turismo.php?md=<?php echo $row["id"] ?>"> Seleccionar</a>
  </td>    	
  <td>
    	<img src="images/edit.png" alt="Modificar" align="absmiddle" /><a href="abmMiniTurismo.php?id=<?php echo $row["id"] ?>&root=0&padre=<?php echo $idcategoria ?>" > Modificar</a>
  </td>
  <td>
    	<img src="images/edit.png" alt="Eliminar" align="absmiddle" /><a href="newMini-Turismo.php?mde=<?php echo $row["id"] ?>&md=<?php echo $idcategoria ?>" > Eliminar</a>
  </td>
  </tr>  	<?php 
    }}     
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
 <!-- paginacion
  -->

    <br></br>
	<h1>Productos </h1>
	<a href="abmProcductosMini.php?padre=<?php echo $idcategoria?>"><img src="images/add.png" alt="Agregar" align="absmiddle" /> Agregar Producto</a><br><br>	
      
    <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="100px">
  		Titulo
  		</td>
  		<td class="formTitle" width="450px">
  		Descripcion
  		</td>  		
  		<td></td>
  		<td></td>
    <?php
    $link1=Conectarse();
    $sql1= " select * from productos  where id_menu_categoria = ".$idcategoria;
    $consulta1= mysql_query($sql1,$link1);
    if ($consulta1)
    {    
		
	
    while($row1= mysql_fetch_assoc($consulta1)) 
    {
    	    
	?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row1["TITULO"] ?></td>
    	<td class="formFields"> <?php echo $row1["DESCRIPCION"] ?></td>    	    	
  <td>
    	<img src="images/edit.png" alt="Modificar" align="absmiddle" /><a href="abmProcductosMini.php?id=<?php echo $row1["ID"] ?>&padre=<?php echo $idcategoria ?>"> Modificar</a>
  </td>
  <td>
    	<img src="images/edit.png" alt="Eliminar" align="absmiddle" /><a href="newMini-Turismo.php?elpro=<?php echo $row1["ID"] ?>&md=<?php echo $idcategoria ?>" > Eliminar</a>
  </td>
  </tr>
    	<?php 
    } }    
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
	
<!--  paginacion  -->


   </form>
   <!--End FORM -->
 </div> 
 <!--End CENTRAL -->
 <br clear="all" />
</div>
<!--
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/menu.js"></script>
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
-->
</body>
</html>