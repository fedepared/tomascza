<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_cate') != '') {  
	$id_cate = $HttpVars->TraerGet('id_cate') ;	
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
  $orden = $HttpVars->TraerPost('orden') ;
	$idcatemaster = $HttpVars->TraerPost('cmbcatemaster') ;
	$id_cate = $HttpVars->TraerPost('id_cate') ;
	$sql="update tbl_categorias set 
	id_catemaster = ".$idcatemaster.",
  orden = ".$orden.",
	nombre = '".htmlentities($nombre)."' 
	where id_cate =".$id_cate."";
	$result = $db->Query($sql,$connection);
	header("Location:listadocategorias.php?modificado=1");

} else {
	$sql="select id_catemaster, nombre, orden from tbl_categorias where id_cate = ".$id_cate."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$idcatemaster = $myrow['id_catemaster'];
	$nombre = $myrow['nombre'];
  $orden = $myrow['orden'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar Categoria</h1>
      <form method="POST" action="e_cate.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'categoria','listadocategorias.php');
					echo existe($existe,$imagespath,'categoria');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_cate" value="<? echo $id_cate ?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>" placeholder="nombre">
        </div>
        <div class="row">
          <div class="col-md-2">
        <div class="form-group">
        
          <label for="nombre">Orden</label>
          <input type="text" name="orden" class="form-control" id="orden" value="<? echo $orden ?>"  placeholder="orden">
          </div>
        </div>
        </div>
		<select name="cmbcatemaster" id="cmbcatemaster" style="display:none">
											<option value="1">Catalogo</option>
										</select>
										<script language="javascript">
document.getElementById("cmbcatemaster").selectedIndex = <? echo $idcatemaster - 1 ?>
</script>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>