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
	

$sql="SELECT * from tbl_banners where nombre= '" . $nombre . "'";

	$result = $db->Query($sql,$connection);

	if ($db->CantidadFilas($result) > 0) { 

		$existe = 1;

	}else{	
		$archivo1=$_FILES['imgch']['tmp_name'];
		$nomarchivo1=$_FILES['imgch']['name'];
		$archivo2=$_FILES['imggr']['tmp_name'];
		$nomarchivo2=$_FILES['imggr']['name'];
		extract($_POST);
		if (isset($_FILES["imgch"])) {
                $nombre = $HttpVars->TraerPost('nombre') ;
            		$chkpubli = $HttpVars->TraerPost('chkpubli') ;            
            		if ($chkpubli == "") {            
            			$chkpubli = 0;            
            		}
                $dcorta = $HttpVars->TraerPost('desc_corta') ;
            		$dlarga = $HttpVars->TraerPost('desc_larga') ;
              	$link = $HttpVars->TraerPost('link') ;
               	$target = $HttpVars->TraerPost('target') ;
                $tmp_name = $_FILES["imgch"]["tmp_name"];
                $name     = $_FILES["imgch"]["name"];
                $name     = uniqid('bc') . '_' . $name;
                move_uploaded_file($tmp_name, "../banner/$name");
                $sql="INSERT into tbl_banners( nombre, pathch, filech, link, target, publicado)  VALUES " . 
		                         "('".htmlentities($nombre)."','".$pathabs1."','".$name."','".$link."','".$target."',".$chkpubli.")";
                //$sql    = "insert into tbl_imgprop(id_prod, imagen) values (" . $id_prod . ",'" . $name . "') ";
                $result = $db->Query($sql, $connection);
               
        
    }
		$agregada = 1;		
	}
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-picture-o"></i>&nbsp;Agregar Banner</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'banner','listadobanners.php');
					echo existe($existe,$imagespath,'banner');
					?>
      <form name="form0" id="form0" method="POST" enctype="multipart/form-data" action="" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Titulo</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Titulo">
        </div>
        <div class="form-group">
          <label for="imgch">Archivo</label><input type="file" id="imgch" name="imgch">
          <p class="help-block">La imagen debe medir 570 x 270px</p>
        </div>
       <div class="form-group">
          <label for="link">Link</label>
          <input type="text" name="link" class="form-control" id="link" placeholder="Inserte el link">
        </div>
        <div class="form-group">
          <label for="target">Abrir en:</label>
          <select name="target" class="form-control">
										<option value="_blank">Nueva ventana</option>
										<option value="_self">Misma ventana</option>
									</select>
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