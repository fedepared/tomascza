<?php
session_start();
include_once 'class/conexion.php';
$row=null;
$Id= ((isset($_GET["id"]))?$_GET["id"]:0);
if (isset($_GET["id"]))
{
	$link=Conectarse();	
	$sql= " select * from novedades where ID = ".$_GET["id"];
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
  <h1>Alta de  Novedad </h1>
  <!--Start FORM -->
  <form ACTION="actualizarNovedadesDetalle.php" METHOD="POST" enctype="multipart/form-data">    
 	<input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
 	<input type="hidden" name="PRINCIPAL" id="PRINCIPAL" value="0"></input>
     <table class="form" border="0"  align="center">
      <tr>
            <td class="formTitle">TITULO</td>
            <td><input name="TITULO" id="TITULO" class="campos"  value="<?php echo ((isset($_GET["id"]))?$row["TITULO"]:''); ?>" /input></td>
          </tr>
          <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>    
          <tr>
            <td class="formTitle">DESCRIPCION BREVE</td>
            <td><textarea name="DESCRIPCION" id="DESCRIPCION" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["DESCRIPCION"]:''); ?></textarea></td>
          </tr>
      <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>
          <tr>
            <td class="formTitle">DESCRIPCION COMPLETA</td>
            <td><textarea name="DESCRIPCION_COMPLETA" id="DESCRIPCION_COMPLETA" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["DESCRIPCION_COMPLETA"]:''); ?></textarea></td>
          </tr>
          
	  <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>
          <tr>
            <td class="formTitle" align="left">FOTO NOVEDAD</td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type="file" id="imagenProd" name="imagenProd" />
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
