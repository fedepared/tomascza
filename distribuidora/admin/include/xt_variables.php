<?
define( "TITUADMIN" , "Panel de Administracion :: A. Russoniello" );
define( "TITUCATALOGO" , "Cali Cleo" );
define( "MAIL_ADMIN" , "info@demabranding.com" );
define( "MAIL_NOREPLY" , "no-reply@calicleo.com.ar" );
define( "MAIL_PEDIDOS" , "info@demabranding.com" );

//define("PATHIMAGEN", "C:\\Users\\gonzalo\\Dropbox\\AppServ\\www\\calicleo\\imgprod\\");
//define("PATHIMAGEN", "/home/beasambi/public_html/imgprod/");
//define("URLVOLVER","http://" . $_SERVER['SERVER_NAME'] . ":8080" . $_SERVER['REQUEST_URI'] . $_SERVER['PHP_QUERY'] . ""); 
define("URLVOLVER","http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . $_SERVER['PHP_QUERY'] . ""); 

session_start() ;
$parser_version = phpversion();

if ( ! session_is_registered("userSessionSID") ) {
	session_register("idUsuarioAdminSID");
	session_register("userSessionSID");
	session_register("idUsuarioSID");
	session_register("usuarioNombre");
	session_register("adminValido");
	session_register("usuarioValido");
	$HTTP_SESSION_VARS['idUsuarioSID']	= 0 ;
	$HTTP_SESSION_VARS['userSessionSID']	= session_id();
	$HTTP_SESSION_VARS['idUsuarioAdminSID']	= 0 ;
	$HTTP_SESSION_VARS['perfilUsuarioSID']	= "" ;
	$HTTP_SESSION_VARS['usuarioNombre']	= "" ;
}

if ($parser_version <= "4.1.0") { 
	$GET_VARS = $HTTP_GET_VARS;
	$POST_VARS = $HTTP_POST_VARS;
	$SESSION_VARS = $HTTP_SESSION_VARS;
}
if ($parser_version >= "4.1.0") { 
	$GET_VARS = $_GET;
	$POST_VARS = $_POST;
	$SESSION_VARS = $_SESSION;
}

?>