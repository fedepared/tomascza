<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_confort') != '') {  
	$id_color = $HttpVars->TraerGet('id_confort') ;		
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_color = $HttpVars->TraerPost('id_confort') ;
	
	$sql="update tbl_confort set 
	confort = '".htmlentities($nombre)."'  	
	where id_confort =".$id_color."";
	$result = $db->Query($sql,$connection);
	header("Location:listadoconfort.php?modificado=1");

} else {
	$sql="select id_confort, confort from tbl_confort where id_confort = ".$id_color."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['confort'];
	
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar </h1>
      <form method="POST" action="e_confort.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'confort','listadoconfort.php');
					echo existe($existe,$imagespath,'confort');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_confort" value="<? echo $id_color ?>">
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