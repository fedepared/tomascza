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
	$nombre = $HttpVars->TraerPost('nombre') ;
  $orden = $HttpVars->TraerPost('orden') ;
	$chkpubli = $HttpVars->TraerPost('chkpubli') ;
	$idcatemaster = $HttpVars->TraerPost('cmbcatemaster') ;

	$sql="SELECT nombre from tbl_ubicacion where nombre = '" . $nombre . "' ";
	//echo $sql;
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{
		if ($chkpubli == "") $chkpubli = 0;
		$sql="INSERT into tbl_ubicacion(nombre,publicado,orden)  VALUES ('".htmlentities($nombre)."',".$chkpubli.",".$orden.")";
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
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Agregar Categoria</h1>
      <form method="POST" action="a_ubi.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'ubicaion','listadoubicacion.php');
					echo existe($existe,$imagespath,'ubicacion');
				?>
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
        </div>
         <div class="row">
          <div class="col-md-2">
        <div class="form-group">
        
          <label for="nombre">Orden</label>
          <input type="text" name="orden" class="form-control" id="orden"  placeholder="orden">
          </div>
        </div>
        </div>
                      
        <select name="cmbcatemaster" style="display:none">
										<option value="1">Catalogo</option>
									</select>
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