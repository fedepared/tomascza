<?
require_once("include/includes.php");
ini_set('display_errors','Off');
if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;

if ($HttpVars->TraerGet('id_empresa') != '') {  
	$id_empresa = $HttpVars->TraerGet('id_empresa') ;
}
if ($HttpVars->TraerPost('envio') != '') { 
	$titulo = $HttpVars->TraerPost('titulo');
	$desc_corta = $HttpVars->TraerPost('desc_corta');
	//$imgch = $HttpVars->TraerPost('imgch');
	//$imggr = $HttpVars->TraerPost('imggr');
	$chkpubli = $HttpVars->TraerPost('chkpubli');
	$id_empresa = $HttpVars->TraerPost('id_empresa');

	
	$archivo1=$_FILES['imgch']['tmp_name'];
	$nomarchivo1=$_FILES['imgch']['name'];
	$archivo2=$_FILES['imggr']['tmp_name'];
	$nomarchivo2=$_FILES['imggr']['name'];
		
		
	if (is_dir( PATHIMAGEN ) == false) {
		mkdir( PATHIMAGEN );
	}

	$directorio = PATHIMAGEN ;
	$archfinal1 = $directorio . $nomarchivo1 ;
	$archfinal2 = $directorio . $nomarchivo2 ;

	if (file_exists ($archivo1)){
		$pathabs1 = "" ;
		copy ($archivo1, $archfinal1 ); 
		if (file_exists ($directorio . $nomarchivo1)){
			$patharch1 = $directorio . $nomarchivo1 ;
			$pathabs1=str_replace("\\","\\\\",$patharch1);
		}
	}

	if (file_exists ($archivo2)){
		$pathabs2 = "" ;
		copy ($archivo2, $archfinal2 ); 
		if (file_exists ($directorio . $nomarchivo2)) {
			$patharch2 = $directorio . $nomarchivo2 ;
			$pathabs2=str_replace("\\","\\\\",$patharch2);
		}
	}
	
	
	/*
	echo "--->" . $nomarchivo1 . "<br>";
	echo "--->" . $nomarchivo2;
	echo "--->" . $HttpVars->TraerPost('imgch2') . "<br>";
	echo "--->" . $HttpVars->TraerPost('imggr2') . "<br>";
	exit();
	*/
	
	if($nomarchivo1 == ""){
		$nomarchivo1 = $HttpVars->TraerPost('imgch2');
	}
	if($nomarchivo2 == ""){
		$nomarchivo2 = $HttpVars->TraerPost('imggr2');
	}

	if ($chkpubli == "") {
		$chkpubli = 0;
	}
	
	

	$sql="update tbl_empresa set 
	titulo = '".htmlentities($titulo)."',
	desc_corta = '".$desc_corta."',
	filech = '".$nomarchivo1."',
	publicado = ".$chkpubli." 
	where id_empresa =".$id_empresa."";

	$result = $db->Query($sql,$connection);
	header("Location:e_empresa.php?id_empresa=".$id_empresa."");

}

if ($HttpVars->TraerPost('envio') == '') { 
	$sql="select titulo,desc_corta, filech, publicado from tbl_empresa where id_empresa = ".$id_empresa."";
	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow) ;
	$titulo = $myrow['titulo'];
	$desc_corta = $myrow['desc_corta'];
	$imgch2 = $myrow['filech'];
	$publicado = $myrow['publicado'];
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-briefcase"></i>&nbsp;La empresa</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'empresa');
					echo existe($existe,$imagespath,'empresa');
					?>
      <form name="form0" id="form0" method="POST" action="e_empresa.php" enctype="multipart/form-data" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_empresa" value="<? echo $id_empresa?>">
        <div class="form-group">
          <label for="titulo">Nombre</label>
          <input name="titulo" type="text" class="form-control" id="titulo" placeholder="titulo" value="<? echo $titulo ?>">
        </div>
        <div class="form-group">
          <label for="desc_corta">Descripción</label>
          <textarea name="desc_corta" id="desc_corta" rows="3" class="form-control"><? echo $desc_corta ?></textarea>
        </div>
        <div class="form-group">
          <input type="file" name="imgch" size="50" class="boxentra"><br />
						<img src="../imgprod/<? echo $imgch2 ?>" width="200">
						<input type="hidden" name="imgch2" value="<? echo $imgch2 ?>">
        </div>
       
        <div class="checkbox-inline text-primary">
         <?
												$checked = "";
												if($publicado ==1){ $checked = " checked ";	}
												?>
          <label>
<input type="checkbox" name="chkpubli" value=1 <? echo $checked?> >
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