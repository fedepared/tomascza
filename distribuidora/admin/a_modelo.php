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
	$codcolor = $HttpVars->TraerPost('codcolor') ;
	$chkpubli = $HttpVars->TraerPost('chkpubli') ;
	
	$sql="SELECT modelo from tbl_modelos where modelo = '" . $nombre . "' ";
	//echo $sql;
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{
		if ($chkpubli == "") $chkpubli = 0;
		$sql="INSERT into tbl_modelos(modelo, codigo_modelo,publicado)  VALUES ('".htmlentities($nombre)."','".$codcolor."',".$chkpubli.")";
		$result = $db->Query($sql,$connection);
		$agregada = 1;
		$nombre = "" ;
		$codcolor = "" ;
	}
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Agregar Marca</h1>
      <form method="POST" action="a_modelo.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'modelo','listadomodelos.php');
					echo existe($existe,$imagespath,'modelo');
				?>
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Marca</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
        </div>
		<div class="form-group">
          <label for="nombre">Código de Marca </label>
          <input type="text" name="codcolor" class="form-control" id="codcolor" placeholder="código de Marca">
        </div>
         <div class="checkbox">
    <label>
      <input type="checkbox" name="chkpubli" value=1> Publicado
    </label>
  </div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>