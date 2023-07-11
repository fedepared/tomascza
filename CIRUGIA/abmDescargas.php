<?php
session_start();
include_once 'class/conexion.php';
	$link=Conectarse();
	
	$sql= " select * from catalogo ";
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
	 
    $sqlDel= " select * from catalogo where id  = ".$_GET["mde"];
	$consultaDel= mysql_query($sqlDel,$link);
	$rowDel= mysql_fetch_assoc($consultaDel);
	$archivoBorar ="../catalogo/".$rowDel["imagen"]."";	
    unlink($archivoBorar ); 
    
	
    $sqlBedDel= " delete from catalogo where ID=".$_GET["mde"]."";
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
</head>
<body>
<div id="page"> 
 <!--Start HEADER -->
 <?php require_once("header.php") ?>
 <!-- End HEADER -->
  <!--Start CENTRAL -->
 <div id="central">
  <h1>Infomacion  Catalogo</h1>
  <!--Start FORM -->
  <form ACTION="actualizardescarga.php" METHOD="POST" enctype="multipart/form-data">
    <input type="hidden" name="ID" id="ID" value="<?php echo $Id ?>"></input>
     <table class="form" border="0"  align="center">
       
       <tr>

          
            <td class="formTitle" align="left">Titulo</td>
            <td align="left">
                <input type="text" name="TITULO" id="TITULO" class="campos"/>
            </td>
          </tr>
          <tr>

          
            <td class="formTitle" align="left">Subir Catalogo </td>
            <td align="left">
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input type="file" id="imagenCatalogo" name="imagenCatalogo" />
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
  		Titulo
  		</td>
  		<td class="formTitle" width="190px">
  		Imagen 
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
    $sql= " select * from catalogo ".$finalqry;
    
    $consulta= mysql_query($sql,$link);
    $sqlTotal = "SELECT count(*) as total from catalogo ";
   
    	  
	$rs = mysql_query($sql);
	$rsTotal = mysql_query($sqlTotal);
		 
	$rowTotal = mysql_fetch_assoc($rsTotal);
		// Total de registros sin limit
	$total = $rowTotal["total"];
	
    while($row= mysql_fetch_assoc($consulta)) 
    {?>
    <tr class="rowBlanco">
    	<td class="formFields"> <?php echo $row["catalogo"] ?></td>
    	<td class="formFields"> <?php echo $row["imagen"] ?></td>
  
  <td>
    	<img src="images/edit.png" alt="Eliminar" align="absmiddle" /><a href="abmDescargas.php?mde=<?php echo $row["id"] ?>" > Eliminar</a>
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
