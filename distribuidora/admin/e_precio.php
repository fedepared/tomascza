<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$agregada = 0;
$existe = 0;

$id_prod = $HttpVars->TraerGet('id_prod');
$id_precio = "";

if ($HttpVars->TraerPost('envio') != '') { 
	
	$id_prod = $HttpVars->TraerPost('id_prod') ;	
  $id_precio = $HttpVars->TraerPost('id_precio') ;
	$fecha = $HttpVars->TraerPost('fecha') ;
  
	$precioD = $HttpVars->TraerPost('precioDistrib') ;
  if ($precioD=="")
  {
    $precioD=0;
  } 
  $precio1 = $HttpVars->TraerPost('precio1') ;
  if ($precio1=="")
  {
    $precio1=0;
  }
  $precio2 = $HttpVars->TraerPost('precio2') ;
  if ($precio2=="")
  {
    $precio2=0;
  }
  $precio3 = $HttpVars->TraerPost('precio3') ;
  if ($precio3=="")
  {
    $precio3=0;
  }	
  if ($id_precio!="")
  {
    $sql = "select * from tbl_precios where id_prod  = ".$id_prod." and vigencia = '".$fecha."'";
    $result = $db->Query($sql,$connection);
    if ($db->CantidadFilas($result) > 0) 
    {
        $db->FetchArray($result,&$myrow);
        $sql1="update tbl_precios set 
    		id_prod = ".$id_prod.",       
        vigencia = '".$fecha."',
        nu_precio1 = ".str_replace(",",".",$precio1).",
        nu_precio2 = ".str_replace(",",".",$precio2).",
        nu_precio3 = ".str_replace(",",".",$precio3)."
    		where id_precio =".$myrow['id_precio']." ";
    		$result1 = $db->Query($sql1,$connection);
    
    }
    else
    {
      $sql1=" INSERT INTO  `tbl_precios` (  `id_prod` ,  `nu_precio1` ,  `nu_precio2` ,  `nu_precio3` ,  `vigencia` ) values 
    		 (".$id_prod.",".str_replace(",",".",$precio1).",".str_replace(",",".",$precio2).",".str_replace(",",".",$precio3).",'".$fecha."')";
   		$result1 = $db->Query($sql1,$connection);
    }
    
  }
	 else
    {
      $sql1=" INSERT INTO  `tbl_precios` (  `id_prod` ,  `nu_precio1` ,  `nu_precio2` ,  `nu_precio3` ,  `vigencia` ) values 
    		 (".$id_prod.",".str_replace(",",".",$precio1).",".str_replace(",",".",$precio2).",".str_replace(",",".",$precio3).",'".$fecha."')";
   		$result1 = $db->Query($sql1,$connection);
    }
    
header("Location:listadoprecios.php?modificado=1");	
} 
else {
$addSql="";
	if (isset($_GET['id_precio']))
		$addSql=" and  id_precio = ".$_GET['id_precio'].""	;	
$sql = "SELECT tbl_productos.id_prod as prod,
tbl_productos.nombre
,tbl_productos.codigo
,tbl_productos.precioDistrib
,tbl_precios.* 
from   tbl_productos left join tbl_precios
    on tbl_productos.id_prod = tbl_precios.id_prod and tbl_productos.id_prod = ".$id_prod.""
    .$addSql;
    

	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow);	
	$id_precio = $myrow['id_precio'];	
	$nombre = $myrow['nombre'];
  $fecha = $myrow['vigencia'];
  $precioD = $myrow['precioDistrib'];
  $precio1 = $myrow['nu_precio1'];
	$precio2 = $myrow['nu_precio2'];
	$precio3 = $myrow['nu_precio3'];	
}
?>  
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-dollar"></i>&nbsp;Editar Lista de Percio</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'precio','listadoprecios.php');
					echo existe($existe,$imagespath,'precio');
					?>
      <form name="form0" id="form0" method="POST" action="e_precio.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_prod" value="<? echo $id_prod; ?>">
        <input type="hidden" name="id_precio" value="<? echo $id_precio?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input name="nombre" type="text" class="form-control" id="nombre" placeholder="nombre" value="<? echo $nombre ?>">
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="fecha">Vigencia</label>
              <input name="fecha" type="date" class="form-control" id="fecha" placeholder="fecha" value="<? echo $fecha ?>" size="7" maxlength="7">
            </div>
          </div>
          
        </div>
		    <div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Costo </label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" name="precioDistrib" class="form-control" value="<? echo $precioD ?>" id="precioDistrib" placeholder="precio">
              </div>
            </div>
          </div>
          
          </div>
      <div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Lista Precio 1 </label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" name="precio1" class="form-control" value="<? echo $precio1 ?>" id="precio1" placeholder="precio">
              </div>
            </div>
          </div>
          
          </div>
        <div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Lista Precio 2 </label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" name="precio2" class="form-control" value="<? echo $precio2 ?>" id="precio2" placeholder="precio">
              </div>
            </div>
          </div>
          
          </div>
        <div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Lista Precio 3 </label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" name="precio3" class="form-control" value="<? echo $precio3 ?>" id="precio3" placeholder="precio">
              </div>
            </div>
          </div>
          
          </div>
     
        
        
		
		
		
        
        
        <div class="clearfix"></div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>