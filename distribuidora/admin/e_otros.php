<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_otros') != '') {  
	$id_color = $HttpVars->TraerGet('id_otros') ;		
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_color = $HttpVars->TraerPost('id_otros') ;
	
	$sql="update tbl_otros set 
	otros = '".htmlentities($nombre)."'  	
	where id_otros =".$id_color."";
	$result = $db->Query($sql,$connection);
	header("Location:listadootros.php?modificado=1");

} else {
	$sql="select id_otros, otros from tbl_otros where id_otros = ".$id_color."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['otros'];
	
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar </h1>
      <form method="POST" action="e_otros.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'otros','listadootros.php');
					echo existe($existe,$imagespath,'otros');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id	_otros" value="<? echo $id_color ?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>" placeholder="nombre">
        </div>
		
		<input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>