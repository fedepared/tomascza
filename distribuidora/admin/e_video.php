<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;

if ($HttpVars->TraerGet('id_video') != '') {  
	$id_video = $HttpVars->TraerGet('id_video') ;
}
if ($HttpVars->TraerPost('envio') != '') { 
	$titulo = $HttpVars->TraerPost('titulo');
	$descripcion = $HttpVars->TraerPost('descripcion');
	$chkpubli = $HttpVars->TraerPost('chkpubli');
	$id_video = $HttpVars->TraerPost('id_video');

	$directorio = PATHIMAGEN ;

	if ($chkpubli == "") {
		$chkpubli = 0;
	}
	

	$sql="update tbl_videos set 
	titulo = '".htmlentities($titulo)."',
	descripcion = '".$descripcion."',
	publicado = ".$chkpubli." 
	where id_video =".$id_video."";

	$result = $db->Query($sql,$connection);
	header("Location:listadovideos.php?modificado=1");

}

if ($HttpVars->TraerPost('envio') == '') { 
	$sql="select * from tbl_videos where id_video = ".$id_video."";
	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow) ;
	$titulo = $myrow['titulo'];
	$descripcion = $myrow['descripcion'];
	$publicado = $myrow['publicado'];
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
      <form name="form0" id="form0" method="POST" action="e_video.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_video" value="<? echo $id_video?>">
        <div class="form-group">
          <label for="titulo">Titulo</label>
          <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo" value="<? echo $titulo ?>">
        </div>
       <div class="form-group">
          <label for="descripcion">Código del video</label>
          <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Inserte el codigo de youtube" value="<? echo $descripcion ?>">
        </div>

        <div class="checkbox-inline text-primary">
         <?
												$checked = "";
												if($publicado ==1){ $checked = " checked ";	}
												?>
        
          <label>
            <input type="checkbox" name="chkpubli" value=1 <? echo $checked?>>
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