<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT id_marca , marca as nombre, publicado from tbl_marca where marca like '%".$palabra."%'";

$sql = " SELECT TC.id_marca , TC.marca as nombre, TC.publicado, TCM.modelo  	 from tbl_marca as TC, tbl_modelos as TCM where TC.marca like '%".$palabra."%' and TC.id_modelo = TCM.id_modelo ORDER by TCM.modelo asc";


$result = $db->Query($sql,$connection);
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder-open"></i>&nbsp;Listado de Modelos</h1>   
      <div class="row">
        <div class="col-md-5">
          <p> <a href="a_marca.php" class="btn btn-success">Nuevo Modelo</a> <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadomarcas.php') ?>
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
				echo borrado($borrado,$imagespath,'marca');
				echo modificado($modificado,$imagespath,'marca');
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
									$leditar="e_marca.php?id_marca=$myrow[id_marca]";
									$lborrar="b_marca.php?id_marca=$myrow[id_marca]";
								
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_marca'] ?>"> <? echo $myrow['nombre'] . " <i><small style='color:#ccc'>-" . $myrow['modelo'] . "</small></i>";   ?></th>
      <th class="text-center"> <? 	
								if($myrow['publicado'] == 1) {
												$icopubli = '<a class="fa fa-thumbs-up fa-lg" style="color:green" id="publi'.$myrow['id_marca'].'" onclick="cambiopubli('.$myrow['id_marca'].',\'marca\')"></a>&nbsp;' ;
											} else {
												$icopubli = '<a class="fa fa-thumbs-down fa-lg" style="color:red" id="publi'.$myrow['id_marca'].'" onclick="cambiopubli('.$myrow['id_marca'].',\'marca\')"></a>&nbsp;';
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
									echo "<tr><th class='text-center' colspan='4'><p>Actualmente no existen Modelos.</p></th></tr>";
								}
								?>
  </form>
</table></div>
      
    </div>
  </div>
</div>
<? include ("pie.php") ?>
