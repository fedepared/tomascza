<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT * from tbl_suscriptos as TC where email like '%".$palabra."%' ";
$result = $db->Query($sql,$connection);
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-users"></i>&nbsp;Listado de Suscriptos</h1>   
      <div class="row">
	  <div class="col-md-5">
          <p> <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadosuscriptos.php') ?>
        </div>
        <div class="col-md-12">
        <? if ($palabra != "") {
						echo "<p class='text-primary'>Resultados de la búsqueda: <b>";
						echo $palabra;
						echo "</b></p>";
						}
					?>
	</div>
	
      </div>
      <p><small><i>Los suscriptos que "no" tienen nombre son los que llegaron desde la suscripcion al newsletter. El resto desde el formulario de contacto.</i></small></p>
      <div id="mensaje"></div>

<?
				echo borrado($borrado,$imagespath,'suscriptos');
				echo modificado($modificado,$imagespath,'suscriptos');
				?>
<div class="table-responsive">
<table class="table table-bordered table-striped">
  <form name="frmlistado" method="post" action="b_suscripto.php">
    <input type="hidden" name="chkborrar" id="chkborrar">
    <tr>
      <th><input type="checkbox" name="chktodos" onClick="checktodos()"> Email</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Fecha</th>
    </tr>
    <? 
							if ($db->CantidadFilas($result) > 0)  {

									while ($myrow = mysql_fetch_array($result, MYSQL_BOTH)) {
									$leditar="e_suscripto.php?id_suscripto=$myrow[id_suscripto]";
									$lborrar="b_suscripto.php?id_suscripto=$myrow[id_suscripto]";
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_suscripto'] ?>"> <? echo $myrow['email']; ?></th>
      <th><? echo $myrow['nombre']; ?></th>
      <th class="text-center"><? echo $myrow['fecha']; ?>
						</th>
 
 
    </tr>
    <? 		
									} 
								} else {
									echo "<tr><th class='text-center' colspan='4'><p>Actualmente no existen Suscriptos.</p></th></tr>";
								}
								?>
  </form>
</table></div>
      
    </div>
  </div>
</div>
<? include ("pie.php") ?>
