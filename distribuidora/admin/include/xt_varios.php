<?
// Usado para Http Post y Get
$HttpVars	= new varFunctions;
$pp = $HttpVars->Inicializar($POST_VARS,$GET_VARS,$SESSION_VARS) ;

// Conexion unica a la BD
$db		= new dbFunctions;
$connection = $db->Conectarse() ;

$idUsuario	= $HttpVars->TraerPost("idUsuario") ;
$idUsuarioAdmin	= $HttpVars->TraerPost("idUsuarioAdmin") ;

if ( strlen($idUsuario) == 0 ) {
	$idUsuario	= $HttpVars->TraerSession("idUsuarioSID") ;
}

if ( strlen($idUsuarioAdmin) == 0 ) {
	$idUsuarioAdmin	= $HttpVars->TraerSession("idUsuarioAdminSID") ;
}




$userSession	= $HttpVars->TraerSession("userSessionSID") ;

if ( strlen($userSession) == 0 ) {
	$userSession = '' ;
}

$pa		= GenerarPassword(4) ;
$al		= date("s") ;

?>