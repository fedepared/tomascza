<?php
session_start();
include_once 'class/conexion.php';
$row=null;
$root = ((isset($_GET["root"]))?$_GET["root"]:0);
$padre= ((isset($_GET["padre"]))?$_GET["padre"]:0);
$Id= ((isset($_GET["id"]))?$_GET["id"]:0);
if (isset($_GET["id"]))
{
	$link=Conectarse();	
	$sql= " select * from productos where ID = ".$_GET["id"];
	$consulta= mysql_query($sql,$link);
	$row= mysql_fetch_assoc($consulta);
}
$mensaje="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script type="text/javascript">
        function FilterInput (event) {
            var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

                // returns false if a numeric character has been entered
            return ((chCode >= 48 /* '0' */ && chCode <= 57 /* '9' */) || 
                    (event.keyCode >= 96 && event.keyCode <= 105) || 
                    event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
                    event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190);
        }
        function soloNumeros(event) {
            var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

                // returns false if a numeric character has been entered
            return ((chCode >= 48 /* '0' */ && chCode <= 57 /* '9' */) );
        }
    </script>
<title>AMESTI-Admin</title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<link rel="stylesheet" href="../css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script type="text/javascript" src="../js/menu/jquery.min.js"></script>

<script src="../js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="../js/jquery.validationEngine.js" type="text/javascript"></script>
 <script type="text/javascript">
  function gSubmit()
  {
	  if ((document.getElementById("foto1").value=='' || document.getElementById("foto2").value=='' || document.getElementById("foto3").value=='' ))
	  {	  
		  if (document.getElementById("imagenProd").value=='' || document.getElementById("imagenProd2").value=='' || document.getElementById("imagenProd3").value=='' )
		  {
			  
		    alert('Debe seleccionar las 3 imagenes, para continuar.');
	      	return false;
		  }
	  }
      
        
  }
      </script> 
<script>	
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			
			$("#formID").validationEngine()
			
			
			//$.validationEngine.loadValidation("#date")
			//alert($("#formID").validationEngine({returnIsValid:true}))
			//$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
			//$.validationEngine.closePrompt(".formError",true) 							// CLOSE ALL OPEN PROMPTS
		});		

	</script>
</head>
<body>
<div id="page"> 
 <!--Start HEADER -->
 <?php require_once("header.php") ?>
 <!-- End HEADER -->
  <!--Start CENTRAL -->
 <div id="central">
  <h1>Alta Turismo </h1>
  <!--Start FORM -->
  <form anme= "formID" id="formID" ACTION="actualizarProductos.php" METHOD="POST" enctype="multipart/form-data" onSubmit="return checkForm(this);">
    <input type="hidden" name="root" id="root" value="<?php echo $root ?>"></input>
 	<input type="hidden" name="padre" id="padre" value="<?php echo $padre ?>"></input>
 	<input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
 	<input type="hidden" name="CD_PRINCIPAL_FIJO" id="CD_PRINCIPAL_FIJO" value="ZAPATOS"></input>
 	
     <table class="form" border="0"  align="center">
          <tr>
            <td class="formTitle">CODIGO</td>
            <td><input type="text" class="validate[required] text-input" name="PRO_CODIGO" id="PRO_CODIGO" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["CODIGO"]:''); ?>" /></td>
          </tr>
          <tr>
            <td class="formTitle">TITULO</td>
            <td><input type="text" class="validate[required] text-input" name="TITULO" id="TITULO" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["TITULO"]:''); ?>" /></td>
          </tr>
          <tr>          
            <td class="formTitle">DESCRIPCION</td>
            <td><textarea name="DESCRIPCION" id="DESCRIPCION" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["DESCRIPCION"]:''); ?></textarea></td>
          </tr>
          <tr>          
            <td class="formTitle">HOTELES</td>
            <td><textarea name="HOTELES" id="HOTELES" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["HOTELES"]:''); ?></textarea></td>
          </tr>
          <tr>          
            <td class="formTitle">EXCURSIONES</td>
            <td><textarea name="EXCURSIONES" id="EXCURSIONES" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["EXCURSIONES"]:''); ?></textarea></td>
          </tr>
          <tr>          
            <td class="formTitle">SERVICIOS</td>
            <td><textarea name="SERVICIOS" id="SERVICIOS" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["SERVICIOS"]:''); ?></textarea></td>
          </tr>
          <tr>          
            <td class="formTitle">INFORMACION ADICIONAL</td>
            <td><textarea name="ADICIONAL" id="ADICIONAL" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["ADICIONAL"]:''); ?></textarea></td>
          </tr>
          <tr>
            <td class="formTitle">MONEDA</td>
            <td><input type="text" class="validate[required] text-input" name="MONEDA" id="MONEDA" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["MONEDA"]:''); ?>" /></td>
          </tr>
          <tr>
            <td class="formTitle">PRECIO TEMPORADA ALTA</td>
            <td><input  onkeypress="return FilterInput (event)"  type="text" name="PRECIO_ALTA" id="PRECIO_ALTA" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["PRECIO_ALTA"]:''); ?>" /></td>          
          
          </tr>
          <tr>
            <td class="formTitle">PRECIO TEMPORADA BAJA</td>
            <td><input  onkeypress="return FilterInput (event)"  type="text" name="PRECIO_BAJA" id="PRECIO_BAJA" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["PRECIO_BAJA"]:''); ?>" /></td>          
         </tr>
         <tr>
            <td class="formTitle">FECHA INICIO</td>
            <td></td>          
          
          </tr>
          <tr>
            <td class="formTitle">FECHA FIN</td>
            <td></td>          
         </tr> 
          <tr>
            <td class="formTitle" align="left">Foto - Detalle 1</td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='hidden' id='foto1' name='foto1' value='<?php echo $row["FOTO_CHICA"]?>' />
                <input type="file" id="imagenProd" name="imagenProd" />
                <img  width="32px"  height="32px" src="../images/producto/original<?php echo $row["FOTO_CHICA"]?>"/>                
            </td>
          </tr>          
          <tr>
            <td class="formTitle" align="left">Foto - Detalle 2</td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='hidden' id='foto2' name='foto2' value='<?php echo $row["FOTO_MEDIDAS"]?>' />
                <input type="file" id="imagenProd2" name="imagenProd2"  />
               <img  width="32px"  height="32px" src="../images/producto/original<?php echo $row["FOTO_MEDIDAS"]?>"/>
            </td>
          </tr>
          <tr>
            <td class="formTitle" align="left">Foto - Detalle 3</td>
            <td align="left">               
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type='hidden' id='foto3' name='foto3' value='<?php echo $row["FOTO_GRANDE"]?>' />
                <input type="file" id="imagenProd3" name="imagenProd3"  />
                <img  width="32px"  height="32px" src="../images/producto/original<?php echo $row["FOTO_GRANDE"]?>"/>
            </td>
          </tr>
          <tr>
            <td class="formTitle">MINI TURISMO</td>
            <td>
              <input type="checkbox" id="mostrar" name="mostrar" <?php if (isset($_GET["id"])) {if  ($row["MOSTRAR"]=="1"){ ?> checked<?php }}?> ></input>
            </td>
          </tr>
	  <tr>
            <td class="formTitle">DESTACADO</td>
            <td>
              <input type="checkbox" id="destacado" name="destacado" <?php if (isset($_GET["id"])) {if  ($row["DESTACADO"]=="1"){ ?> checked<?php }}?> ></input>
            </td>
          </tr>          
          <tr>
          	<td colspan="2" >
          		<input type="submit" class="boton" value="Guardar" class="confirm_btn" onclick="return gSubmit();" />
          		
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
		 <script type="text/javascript" src="../js/jquery-ui.js"></script>

</body>
</html>
