<?
require_once("include/includes.php");
$HttpVars->PonerSession("userAdminSID",0) ;
$HTTP_SESSION_VARS['userAdminSID'] = 0 ;
$HttpVars->PonerSession("userAdminNameSID","") ;
$HTTP_SESSION_VARS['userAdminNameSID'] = "" ;
header("Location: index.php" );	
?>
