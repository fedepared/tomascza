<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_modelo') != '') {  
	$id_color = $HttpVars->TraerGet('id_modelo') ;		
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_color = $HttpVars->TraerPost('id_modelo') ;
	$codcolor = $HttpVars->TraerPost('codcolor') ;
	$sql="update tbl_modelos set 
	modelo = '".htmlentities($nombre)."',  
	codigo_modelo = '".$codcolor."' 
	where id_modelo =".$id_color."";
	$result = $db->Query($sql,$connection);
	header("Location:listadomodelos.php?modificado=1");

} else {
	$sql="select id_modelo, modelo, codigo_modelo from tbl_modelos where id_modelo = ".$id_color."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['modelo'];
	$codcolor = $myrow['codigo_modelo'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar Marca</h1>
      <form method="POST" action="e_modelos.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'modelo','listadomodelos.php');
					echo existe($existe,$imagespath,'modelo');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_color" value="<? echo $id_color ?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>" placeholder="nombre">
        </div>
		<div class="form-group">
          <label for="nombre">Código de Marca</label>
          <input type="text" name="codcolor" class="form-control" id="codcolor" value="<? echo $codcolor ?>" placeholder="código de Marca">
			<div style="width:25px; height:25px; background:#<? echo $codcolor ?>"></div>
		</div>
		<input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>