<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT id_subcate , nombre, publicado from tbl_subcategorias where  nombre like '%".$palabra."%'";

$sql = " SELECT TC.id_subcate , TC.nombre, TC.publicado, TCM.nombre as categoria from tbl_subcategorias as TC, tbl_categorias as TCM where  TC.nombre like '%".$palabra."%' and TC.id_cate = TCM.id_cate ORDER by TCM.nombre asc";


$result = $db->Query($sql,$connection);
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder-open"></i>&nbsp;Listado de Sub-nivel 1</h1>   
      <div class="row">
        <div class="col-md-5">
          <p> <a href="a_subcate.php" class="btn btn-success">Nuevo Sub-nivel1</a> <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadosubcategorias.php') ?>
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
				echo borrado($borrado,$imagespath,'Subcategoria');
				echo modificado($modificado,$imagespath,'Subcategoria');
				?>
<div class="table-responsive">
<table class="table table-bordered table-striped">
  <form name="frmlistado" method="post" action="b_subcate.php">
    <input type="hidden" name="chkborrar" id="chkborrar">
    <tr>
      <th><input type="checkbox" name="chktodos" onClick="checktodos()"> 
      Nombre</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Acciones</th>
    </tr>
    <? 
							if ($db->CantidadFilas($result) > 0)  {

									while ($myrow = mysql_fetch_array($result, MYSQL_BOTH)) {
									$leditar="e_subcate.php?id_subcate=$myrow[id_subcate]";
									$lborrar="b_subcate.php?id_subcate=$myrow[id_subcate]";
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_subcate'] ?>"> <? echo html_entity_decode($myrow['nombre']) . " <i><small style='color:#ccc'>-" . html_entity_decode($myrow['categoria']) . "</small></i>";   ?></th>
      <th class="text-center"> <? 	
								if($myrow['publicado'] == 1) {
												$icopubli = '<a class="fa fa-thumbs-up fa-lg" style="color:green" id="publi'.$myrow['id_subcate'].'" onclick="cambiopubli('.$myrow['id_subcate'].',\'subcategoria\')"></a>&nbsp;' ;
											} else {
												$icopubli = '<a class="fa fa-thumbs-down fa-lg" style="color:red" id="publi'.$myrow['id_subcate'].'" onclick="cambiopubli('.$myrow['id_subcate'].',\'subcategoria\')"></a>&nbsp;';
											}
											echo $icopubli ;
							?>
						</th>
      <th class="text-center">
                        
                        <a href='<? echo $leditar; ?>' class="fa fa-pencil-square fa-lg" title="Editar <? echo $myrow['nombre']; ?> " > </a>
                       
                        
                        </th>
 
    </tr>
    <? 		
									} 
								} else {
									echo "<tr><th class='text-center' colspan='4'><p>Actualmente no existen Subcategorias.</p></th></tr>";
								}
								?>
  </form>
</table></div>
      
    </div>
  </div>
</div>
<? include ("pie.php") ?>
