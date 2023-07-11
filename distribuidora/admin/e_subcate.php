<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_subcate') != '') {  
	$id_subcate = $HttpVars->TraerGet('id_subcate') ;	
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_cate = $HttpVars->TraerPost('cmbcate') ;
	$id_subcate = $HttpVars->TraerPost('id_subcate') ;
	$sql="update tbl_subcategorias set 
	id_cate = ". $id_cate ." ,
	nombre = '".htmlentities($nombre)."' 
	where id_subcate =".$id_subcate."";
	$result = $db->Query($sql,$connection);
	header("Location:listadosubcategorias.php?modificado=1");

} else {
	$sql="select nombre,id_cate from tbl_subcategorias where  id_subcate = ".$id_subcate."";
	$result = $db->Query($sql,$connection);;
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['nombre'];
	$id_cate = $myrow['id_cate'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder-open"></i>&nbsp;Editar Novedad</h1>
      <form method="POST" action="e_subcate.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'subcategoria','listadosubcategorias.php');
					echo existe($existe,$imagespath,'subcategoria');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_subcate" value="<? echo $id_subcate ?>">
        <div class="form-group">
          <label for="nombre">Nombre Novedad</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo html_entity_decode($nombre) ?>" placeholder="nombre">
        </div>
		<div class="form-group">
          <label for="nombre">Categoria</label>
		<select name="cmbcate">
									<?
									$sql = " SELECT id_cate , nombre from tbl_categorias ";
									$result = $db->Query($sql,$connection);
									while(($db->FetchArray($result,&$myrow))) {
										$selected = "";
										if($myrow['id_cate'] == $id_cate){
											$selected = " selected";
										}
									?>
												
												
										<option value="<? echo $myrow['id_cate'] ?>" <? echo $selected ?>><? echo html_entity_decode($myrow['nombre']) ?></option>
									
									
									<? } ?>
									</select>
		</div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>