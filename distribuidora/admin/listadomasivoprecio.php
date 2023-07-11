<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$modificado = $HttpVars->TraerGet('modificado');
$palabra = $HttpVars->TraerPost('palabra');


?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
  <? include ("botonera.php") ?>
<div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-shopping-cart"></i>&nbsp;Actualizacion masiva de precios</h1>   
      <div class="row">
        <div class="col-md-5">
          <p> <a href="a_preciomasivo.php" class="btn btn-success">Nuevo acturalizacion</a> </p>
        </div>
        
      </div>
      
      <div id="mensaje"></div>

<?
				echo borrado($borrado,$imagespath,'precio');
				echo modificado($modificado,$imagespath,'precio');
				?>
    </div>
  </div>
</div>
<? include ("pie.php") ?>
