<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_color') != '') {  
	$id_color = $HttpVars->TraerGet('id_color') ;	
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
	$id_color = $HttpVars->TraerPost('id_color') ;
	$codcolor = $HttpVars->TraerPost('codcolor') ;
	$sql="update tbl_colores set 
	color = '".htmlentities($nombre)."',  
	codigo_color = '".$codcolor."' 
	where id_color =".$id_color."";
	$result = $db->Query($sql,$connection);
	header("Location:listadocolores.php?modificado=1");

} else {
	$sql="select id_color, color, codigo_color from tbl_colores where id_color = ".$id_color."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	$nombre = $myrow['color'];
	$codcolor = $myrow['codigo_color'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar Color</h1>
      <form method="POST" action="e_color.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'color','listadocolores.php');
					echo existe($existe,$imagespath,'color');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_color" value="<? echo $id_color ?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $nombre ?>" placeholder="nombre">
        </div>
		<div class="form-group">
          <label for="nombre">Código de Color (sin numeral)</label>
          <input type="text" name="codcolor" class="form-control" id="codcolor" value="<? echo $codcolor ?>" placeholder="código de color hexadecimal">
			<div style="width:25px; height:25px; background:#<? echo $codcolor ?>"></div>
		</div>
		<input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>