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
	$idcate = $HttpVars->TraerPost('cmbcategoria') ;
	$chkpubli = $HttpVars->TraerPost('chkpubli') ;


	$sql="SELECT marca from tbl_marca where marca = '" . $nombre . "' and id_modelo = ".$idcate."";
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{
		if ($chkpubli == "") $chkpubli = 0;
		$sql="INSERT into tbl_marca( marca,id_modelo ,publicado)  VALUES ('".htmlentities($nombre)."',".$idcate.",".$chkpubli.")";
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
      <h1 class="page-header"><i class="fa fa-folder-open"></i>&nbsp;Agregar Modelo</h1>
      <form method="POST" action="a_marca.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'marca','listadomarcas.php');
					echo existe($existe,$imagespath,'marca');
				?>
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Nombre Modelo</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
        </div>
    <div class="form-group">
          <label for="nombre">Marca</label>
   <select name="cmbcategoria">
										<?
										$sql = " SELECT TC.id_modelo , TC.modelo as nombre  from tbl_modelos as TC " ;
										$result = $db->Query($sql,$connection);
										while(($db->FetchArray($result,&$myrow))) {
										?>
											<option value="<? echo $myrow['id_modelo'] ?>"><? echo $myrow['nombre'] ?></option>
										<? } ?>
									</select>
    </div>
         <div class="checkbox">
    <label>
      <input type="checkbox" name="chkpubli" value=1 checked> Publicado
    </label>
  </div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>