<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');

$sql = " SELECT * from tbl_tarjetas where nombre like '%".$palabra."%' ";
$result = $db->Query($sql,$connection);
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-picture-o"></i>&nbsp;Listado de Tarjetas</h1>   
      <div class="row">
        <div class="col-md-5">
          <p> <a href="a_tarjeta.php" class="btn btn-success">Nuevo </a> <a href="#" onClick="juntochecks()" class="btn btn-danger ">Borrar seleccionados </a></p>
        </div>
        <div class="col-md-5 pull-right">
        <? echo buscador('listadotarjetas.php') ?>
        </div>
        <div class="col-md-12">
        <? if ($palabra != "") {
						echo "<p class='text-primary'>Resultados de la b&uacute;squeda: <b>";
						echo $palabra;
						echo "</b></p>";
						}
					?></div>
      </div>
      
      <div id="mensaje"></div>

<?
				echo borrado($borrado,$imagespath,'tarjetas');
				echo modificado($modificado,$imagespath,'tarjetas');
				?>
<div class="table-responsive">
<table class="table table-bordered table-striped">
  <form name="frmlistado" method="post" action="b_tarjeta.php">
    <input type="hidden" name="chkborrar" id="chkborrar">
    <tr>
      <th><input type="checkbox" name="chktodos" onClick="checktodos()"> T&iacute;tulo</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Acciones</th>
    </tr>
    <? 
							if ($db->CantidadFilas($result) > 0)  {

									while ($myrow = mysql_fetch_array($result, MYSQL_BOTH)) {
									$leditar="e_tarjeta.php?id_tarjeta=$myrow[id_tarjeta]";
									$lborrar="b_tarjeta.php?id_tarjeta=$myrow[id_tarjeta]";
							?>
    <tr>

      <th><input type="checkbox" name="chkdel" value="<? echo $myrow['id_tarjeta'] ?>"> <? echo $myrow['nombre']; ?></th>
      <th class="text-center"> <? 	
								if($myrow['publicado'] == 1) {
												$icopubli = '<a class="fa fa-thumbs-up fa-lg" style="color:green" id="publi'.$myrow['id_tarjeta'].'" onclick="cambiopubli('.$myrow['id_tarjeta'].',\'tarjeta\')"></a>&nbsp;' ;
											} else {
												$icopubli = '<a class="fa fa-thumbs-down fa-lg" style="color:red" id="publi'.$myrow['id_tarjeta'].'" onclick="cambiopubli('.$myrow['id_tarjeta'].',\'tarjeta\')"></a>&nbsp;';
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
									echo "<tr><th class='text-center' colspan='4'><p>Actualmente no existen Banners.</p></th></tr>";
								}
								?>
  </form>
</table></div>
      
    </div>
  </div>
</div>
<? include ("pie.php") ?>
