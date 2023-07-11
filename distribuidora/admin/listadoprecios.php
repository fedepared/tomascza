<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT tbl_productos.id_prod as prod,
tbl_productos.nombre
,tbl_productos.codigo
,tbl_productos.precioDistrib
,tbl_precios.* 
from   tbl_productos left join tbl_precios
    on tbl_productos.id_prod = tbl_precios.id_prod  
 where tbl_productos.publicado = 1 and tbl_productos.borrado < 1 and  (tbl_productos.nombre like '%".$palabra."%' or tbl_productos.codigo like '%".$palabra."%') order by nombre  ";
$result = $db->Query($sql,$connection);
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-shopping-cart"></i>&nbsp;Listado de Precios</h1>   
      <div class="row">
        <div class="col-md-5">
          <p>  <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadoprecios.php') ?>
        </div>
        <div class="col-md-12">
        <? if ($palabra != "") {
						echo "<p class='text-primary'>Resultados de la busqueda: <b>";
						echo $palabra;
						echo "</b></p>";
						}
					?></div>
      </div>
      
      <div id="mensaje"></div>

<?
				echo borrado($borrado,$imagespath,'precio');
				echo modificado($modificado,$imagespath,'precio');
				?>
<div class="table-responsive">
<table class="table table-bordered table-striped">
  <form name="frmlistado" method="post" action="b_precio.php">
    <input type="hidden" name="chkborrar" id="chkborrar">
    <tr>
      <th><input type="checkbox" name="chktodos" onClick="checktodos()">
      Articulo</th>
            
      <th class="text-center">Costo</th>
      <th class="text-center">vigencia</th>
      <th class="text-center">Precio 1</th>
      <th class="text-center">Precio 2</th>
                        <th class="text-center">Precio 3</th>
      <th class="text-center">Acciones</th>
    </tr>
    <? 
							if ($db->CantidadFilas($result) > 0)  {

									while ($myrow = mysql_fetch_array($result, MYSQL_BOTH)) {
									$leditar="e_precio.php?id_prod=".$myrow['prod']."&id_precio=$myrow[id_precio]";
									$lborrar="b_precio.php?id_precio=$myrow[id_precio]";
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_precio'] ?>"> 
      <? echo  $myrow['nombre']." - ".$myrow['codigo']; ?></th>
      <th class="text-center" ><? echo $myrow['precioDistrib']; ?></th><br />
      <th class="text-center" ><? echo $myrow['vigencia']; ?></th>
      <th class="text-center" ><? echo $myrow['nu_precio1']; ?></th>
      <th class="text-center" ><? echo $myrow['nu_precio2']; ?></th>
      <th class="text-center" ><? echo $myrow['nu_precio3']; ?></th>     
      <th class="text-center">                                                             
                        <a href='<? echo $leditar; ?>' class="fa fa-pencil-square fa-lg" title="Editar <? echo $myrow['nombre']; ?> " > </a>
                        </th>
 
    </tr>
    <? 		
									} 
								} else {
									echo "<tr><th class='text-center' colspan='7'><p>Actualmente no existen Precios definidos.</p></th></tr>";
								}
								?>
  </form>
</table></div>
      
    </div>
  </div>
</div>
<? include ("pie.php") ?>
