<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;

if ($HttpVars->TraerGet('id_banner') != '') {  
	$id_banner = $HttpVars->TraerGet('id_banner') ;
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre');
		$link = $HttpVars->TraerPost('link');
		$target = $HttpVars->TraerPost('target');
	$chkpubli = $HttpVars->TraerPost('chkpubli');
	$id_banner = $HttpVars->TraerPost('id_banner');
  $filech = $HttpVars->TraerPost('filech');

	$directorio = PATHIMAGEN ;

	if ($chkpubli == "") {
		$chkpubli = 0;
	}
	 extract($_POST);
		if (isset($_FILES["imgch"]) && $_FILES["imgch"]["name"]!="") 
    {
      @unlink("../banner/" . $filech);
      $tmp_name = $_FILES["imgch"]["tmp_name"];
      $name     = $_FILES["imgch"]["name"];
      $name     = uniqid('bc') . '_' . $name;
      move_uploaded_file($tmp_name, "../banner/$name");
    	$sql="update tbl_banners set 
    	nombre = '".htmlentities($nombre)."',
      filech = '".$name."' ,
    	link = '".$link."' ,
    	target = '".$target."' ,
    	publicado = ".$chkpubli." 
    	where id_banner =".$id_banner."";
    
    	$result = $db->Query($sql,$connection);
	  }
    else
    {
      $sql="update tbl_banners set 
    	nombre = '".htmlentities($nombre)."',      
    	link = '".$link."' ,
    	target = '".$target."' ,
    	publicado = ".$chkpubli." 
    	where id_banner =".$id_banner."";
    
    	$result = $db->Query($sql,$connection);
    
    }
  
  header("Location:listadobanners.php?modificado=1");

}

if ($HttpVars->TraerPost('envio') == '') { 
	$sql="select nombre, link,filech, target, publicado from tbl_banners where id_banner = ".$id_banner."";
	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow) ;
	$nombre = $myrow['nombre'];
		$link = $myrow['link'];
			$target = $myrow['target'];
	$publicado = $myrow['publicado'];
  $filech = $myrow['filech'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-picture-o"></i>&nbsp;Editar Banner</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'banner','listadobanners.php');
					echo existe($existe,$imagespath,'banner');
					?>
      <form name="form0" id="form0" method="POST" enctype="multipart/form-data"  action=""  onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_banner" value="<? echo $id_banner?>">
        <input type="hidden" name="filech" value="<? echo $filech?>">
        <div class="form-group">
          <label for="nombre">Titulo</label>
          <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Titulo" value="<? echo $nombre ?>">
        </div>
        <div class="form-group">
        <label for="imgch">Archivo</label>
        <table>
        <tr>
        <td> <img width="100px" heigth="100px" src="../banner/<? echo $filech; ?>"> </td>
        <td><input type="file" id="imgch" name="imgch">
          <p class="help-block">La imagen debe medir 570 x 270px</p>
          <p class="help-block">Si agrega una nueva foto Eliminara la Anterior</p></td>
        </tr>
        </table>
        
          
        </div>        
       <div class="form-group">
          <label for="link">Link</label>
          <input name="link" type="text" class="form-control" id="link" placeholder="Inserte el link" value="<? echo $link?>">
        </div>
        <div class="form-group">
          <label for="target">Abrir en:</label>
          <select name="target" class="form-control">
										<option value="_blank">Nueva ventana</option>
										<option value="_self">Misma ventana</option>
									</select>
                                    <script language="javascript">
							if('<?=$target?>' == "_self") {
								document.getElementById("target").selectedIndex = 1;
							}
						</script>
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