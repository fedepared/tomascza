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


	$sql="SELECT nombre from tbl_subcategorias where  nombre = '" . $nombre . "' and id_cate = ".$idcate."";
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{
		if ($chkpubli == "") $chkpubli = 0;
		$sql="INSERT into tbl_subcategorias( nombre,id_cate ,publicado)  VALUES ('".htmlentities($nombre)."',".$idcate.",".$chkpubli.")";
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
      <h1 class="page-header"><i class="fa fa-folder-open"></i>&nbsp;Agregar Sub-Nivel 1</h1>
      <form method="POST" action="a_subcate.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'subcategoria','listadosubcategorias.php');
					echo existe($existe,$imagespath,'subcategoria');
				?>
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Nombre Sub-Nivel1</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
        </div>
    <div class="form-group">
          <label for="nombre">Categoria</label>
   <select name="cmbcategoria">
										<?
										$sql = " SELECT TC.id_cate , TC.nombre, TCM.nombre as catemaster from tbl_categorias as TC, tbl_catemaster as TCM where  TC.id_catemaster = TCM.id_catemaster" ;
										$result = $db->Query($sql,$connection);
										while(($db->FetchArray($result,&$myrow))) {
										?>
											<option value="<? echo $myrow['id_cate'] ?>"><? echo $myrow['nombre'] ?></option>
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