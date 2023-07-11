<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;

if ($HttpVars->TraerGet('id_tarjeta') != '') {  
	$id_tarjeta = $HttpVars->TraerGet('id_tarjeta') ;
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre');
		$link = $HttpVars->TraerPost('link');
		$target = $HttpVars->TraerPost('target');
	$chkpubli = $HttpVars->TraerPost('chkpubli');
	$id_tarjeta = $HttpVars->TraerPost('id_tarjeta');
  $filech = $HttpVars->TraerPost('filech');


	if ($chkpubli == "") {
		$chkpubli = 0;
	}
	
  extract($_POST);
		if (isset($_FILES["imgch"]) && $_FILES["imgch"]["name"]!="") 
    {
      @unlink("../cards/" . $filech);
      $tmp_name = $_FILES["imgch"]["tmp_name"];
      $name     = $_FILES["imgch"]["name"];
      $name     = uniqid('bc') . '_' . $name;
      move_uploaded_file($tmp_name, "../cards/$name");
    	
      $sql="update tbl_tarjetas set 
    	nombre = '".htmlentities($nombre)."',
      filech = '".$name."' ,
    	link = '".$link."' ,
    	target = '".$target."' ,
    	publicado = ".$chkpubli." 
    	where id_tarjeta =".$id_tarjeta."";
    
    
    	$result = $db->Query($sql,$connection);
	  }
    else
    {
      $sql="update tbl_tarjetas set 
    	nombre = '".htmlentities($nombre)."',
    	link = '".$link."' ,
    	target = '".$target."' ,
    	publicado = ".$chkpubli." 
    	where id_tarjeta =".$id_tarjeta."";
    
    	$result = $db->Query($sql,$connection);
    
    }
	
	header("Location:listadotarjetas.php?modificado=1");

}

if ($HttpVars->TraerPost('envio') == '') { 
	$sql="select nombre, link, target,filech, publicado from tbl_tarjetas where id_tarjeta = ".$id_tarjeta."";
	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow) ;
	$nombre = $myrow['nombre'];
		$link = $myrow['link'];
			$target = $myrow['target'];
      $filech = $myrow['filech'];
	$publicado = $myrow['publicado'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-picture-o"></i>&nbsp;Editar Tarjeta</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'tarjeta','listadotarjetas.php');
					echo existe($existe,$imagespath,'tarjeta');
					?>
      <form name="form0" id="form0" method="POST" enctype="multipart/form-data"   action="" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_tarjeta"  id="id_tarjeta" value="<? echo $id_tarjeta?>">
        <input type="hidden" name="filech" value="<? echo $filech?>">
        <div class="form-group">
          <label for="nombre">Titulo</label>
          <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Titulo" value="<? echo $nombre ?>">
        </div>        
        <div class="form-group">
        <label for="imgch">Archivo</label>
        <table>
        <tr>
        <td> <img width="100px" heigth="100px" src="../cards/<? echo $filech; ?>"> </td>
        <td><input type="file" id="imgch" name="imgch">
          <p class="help-block">La imagen debe medir 570 x 270px</p>
          <p class="help-block">Si agrega una nueva foto Eliminara la Anterior</p></td>
        </tr>
        </table>
        
          
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