<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT id_prod , nombre, codigo, dcorta, publicado from tbl_productos where id_cate=9 and borrado < 1 and  (nombre like '%".$palabra."%' or codigo like '%".$palabra."%') order by destacado desc ";
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
          <p> <a href="a_prodp.php" class="btn btn-success">Nuevo Articulo</a> <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadoproductosp.php') ?>
        </div>
        <div class="col-md-12">
        <? if ($palabra != "") {
						echo "<p class='text-primary'>Resultados de la búsqueda: <b>";
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
      <th class="text-center">Descripcion Corta</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Acciones</th>
    </tr>
    <? 
							if ($db->CantidadFilas($result) > 0)  {

									while ($myrow = mysql_fetch_array($result, MYSQL_BOTH)) {
									$leditar="e_prodp.php?id_prod=$myrow[id_prod]";
									$lborrar="b_prodp.php?id_prod=$myrow[id_prod]";
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_prod'] ?>"> <? echo $myrow['nombre']; ?></th>
      <th class="text-center"><? echo $myrow['dcorta']; ?></th>
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
                        <? echo '<a class="fa fa-camera fa-lg" href="javascript:cargopdf('.$myrow['id_prod'].')" data-toggle="tooltip" data-placement="right" title="Agregar PDF"></a>'; ?>   
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
