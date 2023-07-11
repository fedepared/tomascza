<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT tbl_categorias.nombre as cate,tbl_productos.id_prod , tbl_productos.nombre, tbl_productos.codigo, tbl_productos.dlarga
, tbl_productos.publicado from tbl_productos, tbl_categorias
 where tbl_productos.id_cate=tbl_categorias.id_cate  and tbl_productos.borrado < 1 and  (tbl_productos.nombre like '%".$palabra."%' or tbl_productos.codigo like '%".$palabra."%') order by 1,tbl_productos.nombre  ";
$result = $db->Query($sql,$connection);
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-shopping-cart"></i>&nbsp;Listado de Articulos</h1>   
      <div class="row">
        <div class="col-md-5">
          <p> <a href="a_prod.php" class="btn btn-success">Nuevo Producto</a> <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadoproductos.php') ?>
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
				echo borrado($borrado,$imagespath,'producto');
				echo modificado($modificado,$imagespath,'producto');
				?>
<div class="table-responsive">
<table class="table table-bordered table-striped">
  <form name="frmlistado" method="post" action="b_prod.php">
    <input type="hidden" name="chkborrar" id="chkborrar">
    <tr>
      <th><input type="checkbox" name="chktodos" onClick="checktodos()">
      Nombre</th>
      <th class="text-center">Descripcion</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Acciones</th>
    </tr>
    <? 
							if ($db->CantidadFilas($result) > 0)  {

									while ($myrow = mysql_fetch_array($result, MYSQL_BOTH)) {
									$leditar="e_prod.php?id_prod=$myrow[id_prod]";
									$lborrar="b_prod.php?id_prod=$myrow[id_prod]";
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_prod'] ?>"> <? echo  $myrow['nombre']; ?></th>
      <th class="text-center"><? echo $myrow['codigo']; ?></th>
      <th class="text-center"> <? 	
								if($myrow['publicado'] == 1) {
												$icopubli = '<a class="fa fa-thumbs-up fa-lg" style="color:green" id="publi'.$myrow['id_prod'].'" onclick="cambiopubli('.$myrow['id_prod'].',\'producto\')"></a>&nbsp;' ;
											} else {
												$icopubli = '<a class="fa fa-thumbs-down fa-lg" style="color:red" id="publi'.$myrow['id_prod'].'" onclick="cambiopubli('.$myrow['id_prod'].',\'producto\')"></a>&nbsp;';
											}
											echo $icopubli ;
								
								
							?>
						</th>
      <th class="text-center">
                        
                        <a href='<? echo $leditar; ?>' class="fa fa-pencil-square fa-lg" title="Editar <? echo $myrow['nombre']; ?> " > </a>
                        <? echo '<a class="fa fa-camera fa-lg" href="javascript:cargofotos('.$myrow['id_prod'].')" data-toggle="tooltip" data-placement="right" title="Agregar Fotos"></a>'; ?>   
                        <? echo '<a class="fa fa-adjust fa-lg" href="javascript:cargofotosfront('.$myrow['id_prod'].')" data-toggle="tooltip" data-placement="right" title="Agregar Front"></a>'; ?>
                           
                        </th>
                        
						
 
    </tr>
    <? 		
									} 
								} else {
									echo "<tr><th class='text-center' colspan='4'><p>Actualmente no existen Articulos.</p></th></tr>";
								}
								?>
  </form>
</table></div>
      
    </div>
  </div>
</div>
<? include ("pie.php") ?>
