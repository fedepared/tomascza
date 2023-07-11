<?php
session_start();
include_once 'class/conexion.php';
	$link=Conectarse();
	
	$sql= " select * from curriculum ";
	$consulta= mysql_query($sql,$link);
	$row= mysql_fetch_assoc($consulta);
	$Id=0;
if ($row)
{
	$Id= $row["ID"];
}
if (isset($_GET["mde"]))
{
if(!($_GET["mde"]==""))
{
	
	$link=Conectarse();
	
	$sqlDel= " select * from curriculum where id  = ".$_GET["mde"];
	$consultaDel= mysql_query($sqlDel,$link);
	$rowDel= mysql_fetch_assoc($consultaDel);
	$archivoBorar ="../slider/".$rowDel["imagen"]."";	
    unlink($archivoBorar ); 
    
    $sqlBedDel= " delete from curriculum where ID=".$_GET["mde"]."";
    mysql_query($sqlBedDel) or die(mysql_error()); 
    
} 
}
$mensaje="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="shortcut icon" href="../imagenes/tu-logo-mitad2.jpg"></link>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
 <?php require_once("header.php") ?>
 <!-- End HEADER -->
  <!--Start CENTRAL -->
 <div id="central">
  <h1>Infomacion  CV</h1>
  <!--Start FORM -->
  <center>
  <fieldset style="width: 550px; vertical-align:top;"  >
            <legend style="text-align:left">Envia CV</legend>
 			<form ACTION="enviarcv.php" method="post" >
 			<select name="persona" id="persona">
            <option value="0">Seleccione persona..</option>
            <?php 
            $link1=Conectarse();
            $sql1= " select * from curriculum order by NOMBRE";
			$consulta1= mysql_query($sql1,$link1);			
			while($row1= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row1["EMAIL"]?>" 
            <?php 
            if (isset($_POST["persona"]))
            {
	            if ($row1["ID"]==$_POST["persona"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            
            > 
            <?php echo $row1["NOMBRE"]?>
            </option>
            <?php } ?>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Enviar a:
            <input size="30" type="text" name="DESTINATARIO" id="DESTINATARIO" class="campos"/>
            <br></br>
		<input type="hidden" id="mails" name="mails" value="" />
		<input type="hidden" id="ortopedia" name="ortopedia" value="" />
		<input type="submit" class="boton" value="Enviar Mails"  />
			</form>
	</fieldset>
	</center>
  <form ACTION="actualizarcurriculum.php" METHOD="POST" enctype="multipart/form-data">
    <input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
     <table class="form" border="0"  align="center">
        <tr>
                    <td class="formTitle" align="left">Nombre</td>
            <td align="left">
                <input type="text" name="TITULO" id="TITULO" class="campos"/>
            </td>
          </tr>
          
          <tr>

          
            <td class="formTitle" align="left">Subir CV </td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type="file" id="imagenSlider" name="imagenSlider" />
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
   <form ACTION="<?php echo $_SERVER['PHP_SELF']; ?>" METHOD="POST" enctype="multipart/form-data">    
        
     <table class="form">
  	<tr class="rowGris">
  		<td class="formTitle" width="100px">
  		Nombre
  		</td>
  		<td class="formTitle" width="190px">
  		Email 
  		</td>
  		
  		<td></td>
  		<td></td>
    <?php
    $limit = 20;		
		// pagina pedida
	$pag = 0;
	if (isset($_GET["pag"]))
		$pag = (int) ($_GET["pag"]);
	
	
	if ($pag < 1)
		{
		   $pag = 1;
		}		
		$offset = ($pag-1) * $limit;
	$finalqry = 	"order by 1 LIMIT  $offset, $limit";
    $link=Conectarse();
    $sql= " select * from curriculum ".$finalqry;
    
    $consulta= mysql_query($sql,$link);
    $sqlTotal = "SELECT count(*) as total from curriculum ";
   
    	  
	$rs = mysql_query($sql);
	$rsTotal = mysql_query($sqlTotal);
		 
	$rowTotal = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
	$total = $rowTotal["total"];
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["NOMBRE"] ?></td>
    	<td class="formFields"> <?php echo $row["EMAIL"] ?></td>
  
  <td>
    	<img src="images/edit.png" alt="Eliminar" align="absmiddle" /><a href="curriculum.php?mde=<?php echo $row["id"] ?>" > Eliminar</a>
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
   </form>     
   <!--End FORM -->
 </div> 
 <!--End CENTRAL -->
 <br clear="all" />
</div>
<script type="text/javascript" src="select_dependientes.js"></script>
</body>
</html>
