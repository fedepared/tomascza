<?php
session_start();
include_once 'class/conexion.php';
	$link=Conectarse();	
	$sql= " select * from empresa";
	$consulta= mysql_query($sql,$link);
	$row= mysql_fetch_assoc($consulta);
	$Id=0;
if ($row)
{
	$Id= $row["ID"];
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
  <h1>Infomacion  Empresa</h1>
  <!--Start FORM -->
  <form ACTION="actualizarEmpresa.php" METHOD="POST" enctype="multipart/form-data">
    <input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
     <table class="form" border="0"  align="center">
         <tr >
            <td class="formTitle">DESCRIPCION </td>
            <td><textarea name="DESCRIPCION" id="DESCRIPCION" class="campos" cols="100" rows="7" ><?php echo ((isset($row))?$row["DESCRIPCION"]:''); ?></textarea></td>
          </tr>
          <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>
         <tr>
            <td class="formTitle">VISION</td>
            <td><textarea name="VISION" id="VISION" class="campos" cols="100" rows="7" ><?php echo ((isset($row))?$row["VISION"]:''); ?></textarea></td>
          </tr>
          <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>
          <tr>
           <td class="formTitle">MISION</td>
            <td><textarea name="MISION" id="MISION" class="campos" cols="100" rows="7" ><?php echo ((isset($row))?$row["MISION"]:''); ?></textarea></td>
          </tr>
          <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>
          <tr>
            <td class="formTitle">POLITICA</td>
            <td><textarea name="POLITICA" id="POLITICA" class="campos" cols="100" rows="7" ><?php echo ((isset($row))?$row["POLITICA"]:''); ?></textarea></td>
          </tr>
          <tr>
          <td  height="10px">
          </td>
          <td  height="10px">
          </td>
          </tr>
          <tr>

          
            <td class="formTitle" align="left">FOTO </td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type="file" id="imagenEmpresa" name="imagenEmpresa" />
            </td>
          </tr>
          
          <tr>
          	<td colspan="2" >
          		<input type="submit" class="boton" value="Guardar Cambios"  />
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
