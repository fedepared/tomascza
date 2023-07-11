<?
require_once("includeadmin/includes.php");

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
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo TITUADMIN ?></title>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/funcionesajax.js"></script>
	<script language="javascript" src="imagenes/funciones.js"></script>
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.validate.js" ></script>

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
				<tr><td valign="top" style="padding:20px"><? echo pongotitulo("MODIFICAR video","ico-video.png") ?></td></tr>
				<tr>
					<td style="padding:5px 0px 20px 20px">
					  <div id="mensaje"></div>
                    <?	
					echo agregada($agregada,$imagespath, 'video','listadovideos.php');
					echo existe($existe,$imagespath, 'video');
					?> 
						<input type="hidden" name="envio" value="1">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td>
							<form name="form0" id="form0" enctype="multipart/form-data" method="POST" action="e_video.php" onSubmit="return validaCampos(this)">
                   <input type="hidden" name="envio" value="1">
                    <input type="hidden" name="id_video" value="<? echo $id_video?>">
                <input type="image" src="imagenes/ico-grabar.png" name="enviar">  <a href="javascript:history.go(-1)"><img src="imagenes/ico-volver.png" hspace="10" border="0"></a>
                          
                    <table width="100%" border="0" cellpadding="3" cellspacing="2" id="tblprods">
                      <tr height="30">
                        <td width="20%" valign="middle" class="texto">Titulo</td>
                        <td width="80%" valign="middle" ><input name="titulo" type="text" class="boxentra" value="<? echo $titulo ?>" size="60"></td>
                      </tr>
                      <tr height="30">
                        <td valign="middle" class="texto">Descripcion<br><span style="font:normal 10px arial;">(pegue en el campo el código de "embeb" de YouTube)</td>
                        <td valign="middle" ><textarea name="descripcion" style="height:70px; width:500px" cols="50" rows="6"><? echo $descripcion ?></textarea></td>
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