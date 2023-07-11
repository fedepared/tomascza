<?
function GenerarPassword($intLargo) {
    $strResultado = '' ;
    $Caracter = '';

    //Cargamos la matriz con números y letras
    $caracter = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z") ;
    
    while ( strlen($strResultado) < $intLargo ) {
    	$strResultado = $strResultado . $caracter[rand(0,35)];
    }
    return($strResultado);
}

function agregada($agrega,$imagespath,$item,$volver){
	$salida = "";
	if($agrega == 1){
		$salida.= "		<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>El alta de ".$item." se realiz&oacute; con &eacute;xito. <a href='".$volver."' class='btn btn-info btn-xs'>Ver listado</a></div> " . "\n"; 
	}
	return($salida);
}

function existe($exis,$imagespath,$item){
$salida = "";	
if($exis == 1){
		$salida.= "		<div class='alert alert-info alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>El nombre de ".$item." ya existe, por favor escriba otro. </div> " . "\n"; 
	}
	return($salida);
}
function modificado($modif,$imagespath,$item){
$salida = "";
	if($modif == 1){
		$salida.= "		<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>El ".$item." se modific&oacute; con &eacute;xito.</div> " . "\n"; 
	}
	
	return($salida);
}
function borrado($borra,$imagespath,$item){
$salida = "";
	if($borra == 1){
		$salida.= "		<div class='alert alert-danger alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>El ".$item." se elimin&oacute; con &eacute;xito.</div> " . "\n"; 
	}
	return($salida);
}
function asignado($asigna,$imagespath){
$salida = "";
	if($asigna == 1){
		$salida.="<tr>" . "\n" ;
		$salida.="	<td height='28' colspan='2' valign='middle' class='texto' align='center'><img src='".$imagespath."icomal.gif' hspace='5' align='absmiddle'><span class='titulosMal'>La eliminaci&oacute;n no se realiz&oacute; debido a que hay un productos relacionado.</span> </td>" . "\n" ;
		$salida.="</tr>" . "\n" ;
	}
	return($salida);
}

function ponercaracteres($cadena) {
	$cadena = str_replace("á", "&aacute;", $cadena);
	$cadena = str_replace("é", "&eacute;", $cadena);
	$cadena = str_replace("í", "&iacute;", $cadena);
	$cadena = str_replace("ó", "&oacute;", $cadena);
	$cadena = str_replace("ú", "&uacute;", $cadena);
	$cadena = str_replace("ñ", "&ntilde;", $cadena);
	$cadena = str_replace("Ñ", "&Ntilde;", $cadena);
	
	return $cadena;
}
function buscador($destino){
	$salida = "";
	$salida.= "<form action='".$destino."' method='post' name='frmbusqueda'>" . "\n" ;
	$salida.= "<div class='input-group'>" . "\n" ;
	$salida.= "<input name='palabra' type='text' class='form-control' placeholder='Introduce tu busqueda'>" . "\n" ;
	$salida.= "<span class='input-group-btn'>" . "\n" ;
	$salida.= "<input type='submit' value='Buscar' class='btn btn-primary'> <a href=".$destino." class='btn btn-info'>ver todos</a>" . "\n" ;
	$salida.= "</span></div></form>" . "\n" ;
	
	return($salida);
}
function buscarproducto(){
	$salida = "";
	$salida.="<div id=\"buscador\">" . "\n" ;
	$salida.="<form action=\"busqueda.php\" name=\"frmbusqueda\" method=\"get\">" . "\n" ;
	$salida.="<input name=\"buscar\" class=\"box\" type=\"hidden\" />" . "\n" ;
	$salida.="<input name=\"palabra\" class=\"input_google\" type=\"text\"  value=\"Ingrese aqui su busqueda\" onblur=\"if (this.value == '') {this.value = 'Ingrese aqui su busqueda';}\" onfocus=\"if (this.value == 'Ingrese aqui su busqueda') {this.value = '';}\" />" . "\n" ;
	$salida.="</form>" . "\n" ;
	$salida.="</div>" . "\n" ;
	
	return($salida);
}
function buscarservicios(){
	$salida = "";
	$salida.="<div id=\"buscador\">" . "\n" ;
	$salida.="<form action=\"busqueda.php\" name=\"frmbusqueda\" method=\"get\">" . "\n" ;
	$salida.="<input name=\"buscar\" class=\"box\" type=\"hidden\" />" . "\n" ;
	$salida.="<input name=\"palabra\" class=\"input_google\" type=\"text\"  value=\"Ingrese aqui su busqueda\" onblur=\"if (this.value == '') {this.value = 'Ingrese aqui su busqueda';}\" onfocus=\"if (this.value == 'Ingrese aqui su busqueda') {this.value = '';}\" />" . "\n" ;
	$salida.="<input src='imagenes/btn_buscar.png' id='btn_buscar' align='middle' type='image'>". "\n" ;
	$salida.="</form>" . "\n" ;
	$salida.="</div>" . "\n" ;
	
	return($salida);
}
function formatoprecio($precio) {
	return "$ " . number_format($precio, 2, ',', '.');
}
function pongotitulo($titulo,$imagen) {
	$salida = "";
	$salida.= "<span class='titulosec'>";
	$salida.= "<img src='imagenes/".$imagen."' align='absmiddle' hspace='5'>" . $titulo . "";
	$salida.= "</span>";
	return($salida);
}

function extraeNombre($cadena){
	$index=strpos(strrev($cadena),"/");  
	$index=strlen($cadena)-strlen("/")-$index;  
	$index++;
	$cadena = substr($cadena, $index, strlen($cadena));
	return($cadena);
}

function cortaTexto($string, $limit, $break=" ", $pad="…")
{
// lo devuelve sin cambios si $string es más corto que $limit
if(strlen($string) <= $limit) return $string;

// esta $break presente entren $limit y el final de $string?
if(false !== ($breakpoint = strpos($string, $break, $limit))) {
if($breakpoint < strlen($string) - 1) {
$string = substr($string, 0, $breakpoint) . $pad;
}
}

return $string;
}

?>