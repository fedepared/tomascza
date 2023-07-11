<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_talle') != '') {  
	$id_talle = $HttpVars->TraerGet('id_talle') ;	
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_talle = $HttpVars->TraerPost('id_talle') ;
	$sql="update tbl_talles set 
	talle = '".htmlentities($nombre)."' 
	where id_talle =".$id_talle."";
	$result = $db->Query($sql,$connection);
	header("Location:listadotalles.php?modificado=1");

} else {
	$sql="select id_talle, talle from tbl_talles where id_talle = ".$id_talle."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['talle'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar Color</h1>
      <form method="POST" action="e_talle.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'color','listadotalles.php');
					echo existe($existe,$imagespath,'talle');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_talle" value="<? echo $id_talle ?>">
        <div class="form-group">
          <label for="nombre">Talle</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>" placeholder="talle">
        </div>
		<input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>