<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$agregada = 0;
$existe = 0;
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('talle') ;
	$chkpubli = $HttpVars->TraerPost('chkpubli') ;
	
	$sql="SELECT talle from tbl_talles where talle = '" . $nombre . "' ";
	//echo $sql;
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{
		if ($chkpubli == "") $chkpubli = 0;
		$sql="INSERT into tbl_talles(talle,publicado)  VALUES ('".htmlentities($nombre)."',".$chkpubli.")";
		$result = $db->Query($sql,$connection);
		$agregada = 1;
		$nombre = "" ;
	}
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Agregar Talle</h1>
      <form method="POST" action="a_talle.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'talle','listadotalles.php');
					echo existe($existe,$imagespath,'talle');
				?>
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Talle</label>
          <input type="text" name="talle" class="form-control" id="talle" placeholder="talle">
        </div>
		<div class="checkbox">
    <label>
      <input type="checkbox" name="chkpubli" value=1> Publicado
    </label>
  </div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>