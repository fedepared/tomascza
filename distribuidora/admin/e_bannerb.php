<?
require_once("includeadmin/includes.php");

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

	$directorio = PATHIMAGEN ;

	if ($chkpubli == "") {
		$chkpubli = 0;
	}
	

	$sql="update tbl_banners set 
	nombre = '".htmlentities($nombre)."',
	link = '".$link."' ,
	target = '".$target."' ,
	publicado = ".$chkpubli." 
	where id_banner =".$id_banner."";

	$result = $db->Query($sql,$connection);
	header("Location:listadobanners.php?modificado=1");

}

if ($HttpVars->TraerPost('envio') == '') { 
	$sql="select nombre, link, target, publicado from tbl_banners where id_banner = ".$id_banner."";
	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow) ;
	$nombre = $myrow['nombre'];
		$link = $myrow['link'];
			$target = $myrow['target'];
	$publicado = $myrow['publicado'];
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo TITUADMIN ?></title>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/funcionesajax.js"></script>
	<script language="javascript" src="imagenes/funciones.js"></script>
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.validate.js" ></script>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>

<body>
 <script type="text/javascript">
$(document).ready(function() {
	$("#form0").validate();
});
</script> 
<table class="wrapper" align="center" cellpadding="0" cellspacing="0">
	<tr><td colspan="2"><? include("top_admin.php") ?></td></tr>
	<tr>
		<td width="170" valign="top" style="padding:20px 0; border-right:1px solid #ddd;"><? require_once("botonera.php") ?></td>
		<!-- INICIO CENTRAL //-->
		<td valign="top">
			 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td valign="top" style="padding:20px"><? echo pongotitulo("MODIFICAR BANNER","ico-banner.png") ?></td></tr>
				<tr>
					<td style="padding:5px 0px 20px 20px">
					  <div id="mensaje"></div>
                    <?	
					echo agregada($agregada,$imagespath, 'banners','listadobanners.php');
					echo existe($existe,$imagespath, 'banners');
					?> 
						<input type="hidden" name="envio" value="1">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td>
							<form name="form0" id="form0" enctype="multipart/form-data" method="POST" action="e_banner.php" onSubmit="return validaCampos(this)">
                   <input type="hidden" name="envio" value="1">
                    <input type="hidden" name="id_banner" value="<? echo $id_banner?>">
                <input type="image" src="imagenes/ico-grabar.png" name="enviar">  <a href="javascript:history.go(-1)"><img src="imagenes/ico-volver.png" hspace="10" border="0"></a>
                          
                    <table width="100%" border="0" cellpadding="3" cellspacing="2" id="tblprods">
                      <tr height="30">
                        <td width="20%" valign="middle" class="texto">Nombre</td>
                        <td width="80%" valign="middle" ><input name="nombre" type="text" class="boxentra" value="<? echo $nombre ?>" size="60"></td>
                      </tr>
					  					<tr height="30">
                        <td width="20%" valign="middle" class="texto">Link</td>
                        <td width="80%" valign="middle" ><input name="link" type="text" class="boxentra" size="60" value="<? echo $link?>"></td>
                      </tr>
					  					<tr height="30">
                        <td width="20%" valign="middle" class="texto">Destino</td>
                        <td width="80%" valign="middle" >
															<select name="target" id="target">
										<option value="_blank">Nueva ventana</option>
										<option value="_self">Misma ventana</option>
									</select>
															<script language="javascript">
							if('<?=$target?>' == "_self") {
								document.getElementById("target").selectedIndex = 1;
							}
						</script>
						</td>
                      </tr>
                      <tr height="30">
                        <td class="texto" valign="middle" >Publicado</td>
                        <?
												$checked = "";
												if($publicado ==1){ $checked = " checked ";	}
												?>
                        <td valign="middle" ><input type="checkbox" name="chkpubli" value=1 <? echo $checked?>></td>
                      </tr>
                    </table>
                    <div align="right"><input type="image" src="imagenes/ico-grabar.png" name="enviar"><a href="javascript:history.go(-1)"><img src="imagenes/ico-volver.png" hspace="10" border="0"></a></div>
                  </form>
							</td>
							</tr>
						</table>
						

					</td>
				</tr>
			</table>
           
		</td>
		<!-- FIN CENTRAL //-->
	</tr>
	
</table>
<? include("pie_admin.php") ?>
</body>
</html>