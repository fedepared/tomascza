<?php
session_start();
include_once 'class/conexion.php';
	$link=Conectarse();
	$row1;
	$Id=0;
	if (isset($_GET["id"]))
	{
	$sql= " select * from contacto where ID=".$_GET["id"];
	$consulta= mysql_query($sql,$link);
	$row1= mysql_fetch_assoc($consulta);
	
	}
if (isset($_GET["id"]))
{
	$Id= $row1["ID"];
}
if (isset($_GET["mde"]))
{
if(!($_GET["mde"]==""))
{
	echo $_GET["mde"];
	$link=Conectarse();
    $sqlBedDel= " delete from contacto where ID=".$_GET["mde"]."";
    mysql_query($sqlBedDel) or die(mysql_error()); 
    
} 
}
$mensaje="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AMESTI-Admin</title>
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
  <h1>Contactos</h1>
<center>
  <!--Start FORM -->
  <fieldset style="width: 450px; vertical-align:top;"  >
            <legend style="text-align:left">Generar contacto</legend>
  <form ACTION="actualizarContacto.php" METHOD="POST" enctype="multipart/form-data">
    <input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
    <input type="hidden" name="PRINCIPAL" id="PRINCIPAL" value="1"></input>
    
     <table class="form"  border="0"  align="center">
         <tr >
         <TD WIDTH="30PX"></TD>
            <td class="formTitle">Contacto</td>
            <td><select name="clinica" id="clinica">
            <option value="0">Seleccione Clinica</option>
            <?php 
            $link1=Conectarse();
            $sql1= " select * from clinica order by CLINICA";
			$consulta1= mysql_query($sql1,$link1);			
			while($row2= mysql_fetch_assoc($consulta1)) 
    		{
            ?>
            <option value="<?php echo $row2["ID"]?>" 
            <?php 
            if (isset($row1))
            {
	            if ($row2["ID"]==$row1["CLINICA"])
	            {
	            	?>
	            	selected
	            	<?php 
	            }
            }
            
            ?>
            
            > 
            <?php echo $row2["CLINICA"]?>
            </option>
            <?php } ?>
            </select></td>
          </tr>
          <tr >
         <TD WIDTH="30PX"></TD>
            <td class="formTitle">Mail 1</td>
            <td><INPUT name="MAIL1" id="MAIL1" class="campos"  VALUE="<?php echo ((isset($row1))?$row1["MAIL1"]:''); ?>" /></td>
            <td class="formTitle">Mail 2</td>
            <td><INPUT name="MAIL2" id="MAIL2" class="campos"  VALUE="<?php echo ((isset($row1))?$row1["MAIL2"]:''); ?>" /></td>

          </tr>
          <tr >
         <TD WIDTH="30PX"></TD>
            <td class="formTitle">Mail 3</td>
            <td><INPUT name="MAIL3" id="MAIL3" class="campos"  VALUE="<?php echo ((isset($row1))?$row1["MAIL3"]:''); ?>" /></td>
            <td class="formTitle">Mail 4</td>
            <td><INPUT name="MAIL4" id="MAIL4" class="campos"  VALUE="<?php echo ((isset($row1))?$row1["MAIL4"]:''); ?>" /></td>

          </tr>
          
          
                     
          <tr>
          <TD WIDTH="30PX"></TD>
          	<td colspan="4" align="right" >
          	<a href="abmContacto.php" class="boton"> Limpiar</a>
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
     
     </form>
     </fieldset>
     <br><br>
<form ACTION="<?php echo $_SERVER['PHP_SELF']; ?>" METHOD="POST" enctype="multipart/form-data">     
        
     <table class="form" style="width:700px;">
  	<tr class="rowGris">
  		<td class="formTitle" width="100px">
  		Contacto
  		</td>
  		<td class="formTitle" width="100px">
  		mail 1
  		</td>
  		<td class="formTitle" width="100px">
  		mail 2
  		</td>
  		<td class="formTitle" width="100px">
  		mail 3
  		</td>
  		<td class="formTitle" width="100px">
  		mail 4
  		</td>
  		<td width="150px"></td>
  		<td width="150px"></td>
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
    $sql= " select *,(select CLINICA from clinica where clinica.ID=contacto.CLINICA) as DSCLINICA from contacto ".$finalqry;
    
    $consulta= mysql_query($sql,$link);
    $sqlTotal = "SELECT count(*) as total from contacto ";
   
    	  
	$rs = mysql_query($sql);
	$rsTotal = mysql_query($sqlTotal);
		 
	$rowTotal = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
	$total = $rowTotal["total"];
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["DSCLINICA"] ?></td>    	
    	   	
  
  	<td class="formFields"> <?php echo $row["MAIL1"] ?></td>
  	<td class="formFields"> <?php echo $row["MAIL2"] ?></td>
  	<td class="formFields"> <?php echo $row["MAIL3"] ?></td>
  	<td class="formFields"> <?php echo $row["MAIL4"] ?></td>    	
    	   	
  <td>
    	<img src="images/Modify.png" alt="Modificar" align="absmiddle" /><a href="abmContacto.php?id=<?php echo $row["ID"] ?>" > Modificar</a>
  </td>
  <td>
    	<img src="images/edit.png" alt="Eliminar" align="absmiddle" /><a href="abmContacto.php?mde=<?php echo $row["ID"] ?>" > Eliminar</a>
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
 </center>
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
