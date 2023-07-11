<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_marca') != '') {  
	$id_subcate = $HttpVars->TraerGet('id_marca') ;	
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_cate = $HttpVars->TraerPost('cmbcate') ;
	$id_subcate = $HttpVars->TraerPost('id_marca') ;
	$sql="update tbl_marca set 
	id_modelo = ". $id_cate ." ,
	marca = '".htmlentities($nombre)."' 
	where id_marca =".$id_subcate."";
	$result = $db->Query($sql,$connection);
	header("Location:listadomarcas.php?modificado=1");

} else {
	$sql="select marca,id_modelo from tbl_marca where id_marca = ".$id_subcate."";
	$result = $db->Query($sql,$connection);;
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['marca'];
	$id_cate = $myrow['id_modelo'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder-open"></i>&nbsp;Editar Marca</h1>
      <form method="POST" action="e_marca.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'marca','listadomarcas.php');
					echo existe($existe,$imagespath,'marca');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_marca" value="<? echo $id_subcate ?>">
		
        <div class="form-group">
          <label for="nombre">Nombre Modelo</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>" placeholder="nombre">
        </div>
		<div class="form-group">
          <label for="nombre">Marca</label>
		<select name="cmbcate">
									<?
									$sql = " SELECT id_modelo , modelo from tbl_modelos";
									$result = $db->Query($sql,$connection);
									while(($db->FetchArray($result,&$myrow))) {
										$selected = "";
										if($myrow['id_modelo'] == $id_cate){
											$selected = " selected";
										}
									?>
												
												
										<option value="<? echo $myrow['id_modelo'] ?>" <? echo $selected ?>><? echo $myrow['modelo'] ?></option>
									
									
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