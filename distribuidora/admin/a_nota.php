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
	

$sql="SELECT titulo from tbl_notas where titulo = '" . $titulo . "'";

	$result = $db->Query($sql,$connection);

	if ($db->CantidadFilas($result) > 0) { 

		$existe = 1;

	}else{	
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
			if (file_exists ($directorio . $nomarchivo1))
			{
				$patharch1 = $directorio . $nomarchivo1 ;
				$pathabs1=str_replace("\\","\\\\",$patharch1);
			}
		}

 if (file_exists ($archivo2)){
			$pathabs2 = "" ;
			copy ($archivo2, $archfinal2 ); 
			if (file_exists ($directorio . $nomarchivo2))
			{
				$patharch2 = $directorio . $nomarchivo2 ;
				$pathabs2=str_replace("\\","\\\\",$patharch2);
			}
		}		

		$titulo = $HttpVars->TraerPost('titulo') ;

		$chkpubli = $HttpVars->TraerPost('chkpubli') ;

		if ($chkpubli == "") {

			$chkpubli = 0;

		}

		$dcorta = $HttpVars->TraerPost('desc_corta') ;
		$dlarga = $HttpVars->TraerPost('desc_larga') ;


		

		$sql="INSERT into tbl_notas( titulo, desc_corta, desc_larga, pathch, filech, pathgr, filegr, publicado, fecha)  VALUES " . 
		                         "('".htmlentities($titulo)."','".$dcorta."','".$dlarga."','".$pathabs1."','".$nomarchivo1."','".$pathabs2."','".$nomarchivo2."',".$chkpubli.",NOW())";

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
      <h1 class="page-header"><i class="fa fa-file"></i>&nbsp;Agregar Novedad</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'novedad','listadonotas.php');
					echo existe($existe,$imagespath,'novedad');
					?>
      <form name="form0" id="form0" method="POST" action="a_nota.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="titulo">Titulo</label>
          <input type="text" name="titulo" class="form-control" id="titulo" placeholder="titulo">
        </div>
        <div class="form-group">
          <label for="desc_corta">Descripción Corta</label>
          <textarea name="desc_corta" id="desc_corta" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="desc_larga">Descripción en detalle</label>
          <textarea name="desc_larga" id="desc_larga" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="imgch">Imagen de la novedad</label><input type="file" id="imgch" name="imgch">
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