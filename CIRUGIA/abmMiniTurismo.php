<?php
session_start();
include_once 'class/conexion.php';
$row=null;
$root = ((isset($_GET["root"]))?$_GET["root"]:0);
$padre= ((isset($_GET["padre"]))?$_GET["padre"]:0);
$Id= ((isset($_GET["id"]))?$_GET["id"]:0);
//echo "<script type='text/javascript'>alert(".$padre.");</script>";
if (isset($_GET["id"]))
{
	$link=Conectarse();	
	$sql= " select * from menu_categorias where ID = ".$_GET["id"];
	$consulta= mysql_query($sql,$link);
	$row= mysql_fetch_assoc($consulta);
}
$mensaje="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AMESTI-Admin</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div id="page"> 
 <!--Start HEADER -->
 <?php require_once("header.php") ?>
 <!-- End HEADER -->
  <!--Start CENTRAL -->
 <div id="central">
  <h1>Alta Categorias - Subcategorias </h1>
  <!--Start FORM -->
  <form ACTION="actualizarMiniTurismo.php" METHOD="POST" enctype="multipart/form-data">
  <input type="hidden" name="root" id="root" value="<?php echo $root ?>"></input>
  <input type="hidden" name="padre" id="padre" value="<?php echo $padre ?>"></input>
  <input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
     <table class="form" border="0"  align="center">
          
          <tr>
            <td class="formTitle">CATEGORIA</td>
            <td><input type="text" name="PRO_CODIGO" id="PRO_CODIGO" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["categoria"]:''); ?>" /></td>
          </tr>
          <tr>
            <td class="formTitle">DESCRIPCION</td>
            <td><input type="text" name="PRO_DESCRIPCION" id="PRO_DESCRIPCION" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["descripcion"]:''); ?>" /></td>
          </tr>
          
          
	  <tr>
            <td class="formTitle">ORDEN</td>
            <td><input type="text" name="PRO_CANTIDAD_DISPONIBLE" id="PRO_CANTIDAD_DISPONIBLE" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["orden"]:''); ?>" /></td>
          </tr>          
          <tr>
            <td class="formTitle" align="left">IMAGEN</td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type="file" id="imagefile" name="imagefile" />
            </td>
          </tr>          
	  
          <tr>
          	<td colspan="2" >
          		<input type="submit" class="boton" value="Guardar" />
          		
                <a href='<?php echo $_SERVER['HTTP_REFERER']; ?>'><input class="boton" type='button' value='Volver' /></a>
          	</td>
          </tr>
          <tr>
              <td colspan="2" class="mensaje">
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
   <!--End FORM -->
 </div> 
 <!--End CENTRAL -->
 <br clear="all" />
</div>
<script type="text/javascript" src="select_dependientes.js"></script>
</body>
</html>
