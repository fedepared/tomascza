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
	$sql= " select * from pacientes where ID = ".$_GET["id"];
	$consulta= mysql_query($sql,$link);
	$row= mysql_fetch_assoc($consulta);
}
$mensaje="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
  <h1>Paciente </h1>
  <!--Start FORM -->
  <center>
  <fieldset style="width: 850px; vertical-align:top;"  >
            <legend style="text-align:left">Datos Paciente</legend>
  <form anme= "formID" id="formID" ACTION="actualizarPaciente.php" METHOD="POST" enctype="multipart/form-data" onSubmit="return checkForm(this);">
    
 	<input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
 	 <table class="form" border="0"  align="center">
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">APELLIDO</td>
            <td><input type="text" class="validate[required] text-input" name="APELLIDO" id="APELLIDO" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["APELLIDO"]:''); ?>" /></td>
            <td class="formTitle">NOMBRES</td>
            <td><input type="text" class="validate[required] text-input" name="NOMBRES" id="NOMBRES" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["NOMBRES"]:''); ?>" /></td>
          </tr>
          <tr style="display:none;">
          <TD WIDTH="30PX"></TD>
            <td class="formTitle" WIDTH="150PX">FECHA NACIMIENTO</td>
            <td><input size="10" id="f_rangeStart" NAME="f_rangeStart"  value="<?php
			if (isset($_GET["id"]))
			{
            $date = date_create($row["FECHA_NACIMIENTO"]);
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
            <td class="formTitle">DNI</td>
            <td><input type="text" class="validate[required] text-input" name="DNI" id="DNI" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["DNI"]:0); ?>" /></td>
          
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">TELEFONO</td>
            <td><input type="text" class="validate[required] text-input" name="OCUPACION" id="OCUPACION" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["OCUPACION"]:''); ?>" /></td>
            <td class="formTitle">COBERTURA</td>
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
            if (isset($_GET["id"]))
            {
	            if ($row1["ID"]==$row["COBERTURA"])
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
            <input type="text" class="validate[required] text-input" name="COBERTINEX" id="COBERTINEX" class="campos" value="" />
            </td>
          </tr>
          
          <tr>
          <TD WIDTH="30PX"></TD>
            <td class="formTitle">NRO AFILIADO</td>
            <td> <input type="text" class="validate[required] text-input" name="AFILIADO" id="AFILIADO" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["NRO_AFILIADO"]:''); ?>" /></td>
            <td style="display:none;">PLAN</td>
            <td style="display:none;"><input type="text" class="validate[required] text-input" name="PLAN" id="PLAN" class="campos" value="<?php echo ((isset($_GET["id"]))?$row["PLAN"]:''); ?>" /></td>
          
          </tr>
          
          <tr>
          <TD WIDTH="30PX"></TD>
          <td colspan="4"> 
          <textarea name="OBSERVACIONES" id="OBSERVACIONES" class="campos" cols="100" rows="7" ><?php echo ((isset($_GET["id"]))?$row["OBSERVACIONES"]:''); ?></textarea>
          </td>
          </tr>
          <tr>
          <TD WIDTH="30PX"></TD>
          	<td colspan="4" align="right">
          	<input type="submit" class="boton" id="guardar" name="guardar" value="Guardar e ir Cirugia" class="confirm_btn" />
          		<input type="submit" class="boton" id="guardar" name="guardar" value="Guardar" class="confirm_btn"  />
                <a href='<?php echo $_SERVER['HTTP_REFERER']; ?>'><input class="boton" type='button' value='Volver' /></a>
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
   </form>   </fieldset>	</center>
   <!--End FORM -->
 </div> 
 <!--End CENTRAL -->
 <br clear="all" />
</div>
		 <script type="text/javascript" src="../js/jquery-ui.js"></script>

</body>
</html>
