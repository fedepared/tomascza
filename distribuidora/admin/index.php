<?
require_once("include/includes.php");
$username = "" ;
$password = "" ;	
$claveinvalida = "NO";

if (isset($_POST['username']) ) { 
	$username = $_POST['username'] ;
	$password = $_POST['password'] ;	
	$claveinvalida = "SI";

	$sql = "SELECT * FROM tbl_admin WHERE usuadmin='".$username."' AND clave ='".$password."' AND publicado =1";
	$result = $db->Query($sql,$connection);

	if ($db->CantidadFilas($result) > 0) {
		while( $db->FetchArray($result,&$row) ) {

			//$idUsuarioAdmin = $row['id_contacto'];
			$_SESSION["idUsuarioAdminSID"]=$row['id'];
			$_SESSION["idUsuarioAdminSUser"]=$row['usuadmin'];
		}
		$HttpVars->PonerSession("adminValido","si");	
		$_SESSION['adminValido']  = "si" ;
		header("Location: listadoproductos.php");
	} else {
		$password = "";
	}
}
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
<link rel="stylesheet" href="../assets/style.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.form-signin {
	max-width: 350px;
	margin: 0 auto;
}
</style>
</head>

<body>
<div class="container">
  <form class="form-signin" method="post" action="index.php">
    <h2 class="form-signin-heading text-center"><img src="logoo.png" style="width:70%"><br>
</h2>
    <? if ( $claveinvalida == "SI" ) { ?>
    <div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only">Error:</span> Los datos ingresados son incorrectos </div>
    <? } ?>
    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
      <input class="form-control" id="username" name="username" type="text" value="<? echo $username;?>" placeholder="Nombre de usuario">
    </div>
    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
      <input class="form-control" type="password" id="password" name="password" value="<? echo $password;?>" placeholder="Password">
    </div>
    <button class="btn btn-default btn-primary pull-right" type="submit">INGRESAR</button>
  </form>
</div>
<!-- /container --> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 

<!-- wow script --> 
<script src="../assets/wow/wow.min.js"></script> 

<!-- uniform --> 
<script src="../assets/uniform/js/jquery.uniform.js"></script> 

<!-- boostrap --> 
<script src="../assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script> 

<!-- jquery mobile --> 
<script src="../assets/mobile/touchSwipe.min.js"></script> 

<!-- jquery mobile --> 
<script src="../assets/respond/respond.js"></script> 

<!-- custom script --> 
<script src="../assets/script.js"></script>
</body>
</html>