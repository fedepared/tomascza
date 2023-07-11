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
$pathabs1 = "";
$pathabs2 = "";
	

$sql="SELECT * from tbl_videos where titulo = '" . $titulo . "'";

	$result = $db->Query($sql,$connection);

	if ($db->CantidadFilas($result) > 0) { 

		$existe = 1;

	}else{	
	
		$directorio = PATHIMAGEN ;

		$titulo = $HttpVars->TraerPost('titulo') ;
		$descripcion = $HttpVars->TraerPost('descripcion') ;
		$chkpubli = $HttpVars->TraerPost('chkpubli') ;

		if ($chkpubli == "") {

			$chkpubli = 0;

		}


		$sql="INSERT into tbl_videos (titulo, descripcion, publicado)  VALUES " . 
		                         "('".htmlentities($titulo)."','".$descripcion."',".$chkpubli.")";

		$result = $db->Query($sql,$connection);
		$agregada = 1;		
	}
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-video-camera"></i>&nbsp;Agregar Video</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'video','listadovideos.php');
					echo existe($existe,$imagespath,'video');
					?>
      <form name="form0" id="form0" method="POST" action="a_video.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="titulo">Titulo</label>
          <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo">
        </div>
       <div class="form-group">
          <label for="descripcion">Código del video</label>
          <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Inserte el codigo de youtube">
        </div>

        <div class="checkbox-inline text-primary">
          <label>
            <input type="checkbox" name="chkpubli" value=1 checked>
            Publicado </label>
        </div>
        <div class="clearfix"></div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>