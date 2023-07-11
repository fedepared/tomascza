<?
require_once("include/includes.php");
if (($HttpVars->TraerSession('adminValido') != "si")) {
    header("Location: index.php");
}
$idUsuarioName = $HTTP_SESSION_VARS['idUsuarioAdminSUser'];
$id_prod    = $HttpVars->TraerGet('id_prod');
if ($HttpVars->TraerGet('idfoto') != "") {
    $idfoto = $HttpVars->TraerGet('idfoto');
    $sql    = "delete from tbl_pdfprop where id_pdf = " . $idfoto;
    $result = $db->Query($sql, $connection);
    @unlink("../pdfprop/" . $HttpVars->TraerGet('nomarch'));
}
$sql    = "select nombre from tbl_productos where id_prod = " . $id_prod;
$result = $db->Query($sql, $connection);
$db->FetchArray($result, &$myrow);
$titulogal = $myrow['nombre'];
$postback  = isset($_POST['postback']) ? true : false;
if ($postback) {
    extract($_POST);
    if (isset($_FILES["archivos"])) {
        foreach ($_FILES["archivos"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["archivos"]["tmp_name"][$key];
                $name     = $_FILES["archivos"]["name"][$key];
                $name     = uniqid('bc') . '_' . $name;
                move_uploaded_file($tmp_name, "../pdfprod/$name");
                $sql    = "insert into tbl_pdfprop(id_prod, pdf) values (" . $id_prod . ",'" . $name . "') ";
                $result = $db->Query($sql, $connection);
            }
        }
    }
}
$sql      = "select id_pdf, pdf, principal from tbl_pdfprop where id_prod = " . $id_prod;
$result   = $db->Query($sql, $connection);
$cantidad = $db->CantidadFilas($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo TITUADMIN ?></title>
<!-- font awesome -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />

<!-- uniform -->
<link type="text/css" rel="stylesheet" href="../assets/uniform/css/uniform.default.min.css" />

<!-- favicon -->
<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
<link rel="icon" href="../images/favicon.png" type="image/x-icon">

<!-- Custom styles for this template -->
<link rel="stylesheet" href="../assets/style-admin.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script type="text/javascript">
var numero = 0;

// Funciones comunes
c= function (tag) { // Crea un elemento
   return document.createElement(tag);
}
d = function (id) { // Retorna un elemento en base al id
   return document.getElementById(id);
}
e = function (evt) { // Retorna el evento
   return (!evt) ? event : evt;
}
f = function (evt) { // Retorna el objeto que genera el evento
   return evt.srcElement ?  evt.srcElement : evt.target;
}
cont = <? echo $cantidad ?>;
addField = function () {

if(cont <= 1) {
cont++;
   container = d('files');
   
   span = c('SPAN');
   span.className = 'file';
   span.id = 'file' + (++numero);

   field = c('INPUT');   
   field.name = 'archivos[]';
   field.type = 'file';
   field.size = '55';
   
   br = c("br");
   
   a = c('A');
   a.name = span.id;
   a.href = '#';
   a.onclick = removeField;
   a.innerHTML = 'Quitar';

   span.appendChild(field);
   
   span.appendChild(a);
   container.appendChild(span);
   span.appendChild(br)
   }
}
removeField = function (evt) {
	
	cont--;
   lnk = f(e(evt));
   span = d(lnk.name);
   span.parentNode.removeChild(span);
}

function validarfotos(){
	arrayperm = new Array("pdf","PDF");
	f = document.frm;
	for(i=0;i<f.elements.length;i++){
		if(f.elements[i].type=="file"){
			archivo = f.elements[i].value;
			ultimopunto = archivo.lastIndexOf(".");
			ext = archivo.substring(ultimopunto+1,archivo.length);
			//existe = 0
			if(f.elements[i].value != ""){
				if (ext != "pdf" && ext != "PDF") {
					//existe = 1;
				
					f.elements[i].value = "";
					document.getElementById("mensaje").innerHTML = "Los formatos del archivo soportados son pdf.";
					return false;
				}
			}
			
			
		}
	
	}
	return true;

}

</script> 
</head>
<body style="padding-top:0px;">
<div class="container-fluid">
<h1><? echo $titulogal ?></h1>
<div id="mensaje" style="color:#f00"></div>
<div class="row gallery">
<?
if ($db->CantidadFilas($result) > 0)  {
	while(($db->FetchArray($result,&$myrow))) {
		echo '<div class="col-xs-3" style="position:relative"><div class="gallery-image"><img src="../pdfprod/'.$myrow['pdf'].'" class="img-rounded"></div><a class="btn btn-danger btn-xs" href="fotos.php?idfoto='.$myrow['id_img'].'&id_prod='.$id_prod.'&nomarch='.$myrow['imagen'].'" style="position:absolute; bottom:5px; right:5px">Borrar</a></div>';
	}
} else {
	echo '<div class="col-xs-12"><p class="bg-info text-center">Actualmente no hay PDF`s para esta Galeria</p></div>';
}
?>
</div>
<? if ($cantidad < 10) { ?>
<form name="frm" id="frm" action="pdf.php?id_prod=<? echo $id_prod ?>" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-xs-12">
<div style="border:1px solid #ddd; padding:5px;">
<p class="text-primary">Elija su PDF</p>
<dd><div id="files"></div></dd><a href="#" onClick="addField();return false" accesskey="10" class="btn btn-info btn-xs">Agregar Otra</a>
</div></div>
<div class="col-xs-12">
</div>
<div class="col-xs-12 text-center"><br>
<input type="submit" value="Enviar" id="postback" name="postback" accesskey="6" onClick="return validarfotos()" class="btn btn-success"> <button class="btn btn-primary" onClick="window.close();return false">Listo!</button></div>
</div>
</form>				
				<? } ?>
</div>               

<script language="javascript">
addField();
</script>     
</body>
</html>