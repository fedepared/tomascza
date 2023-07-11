<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><? echo TITUADMIN ?></title>
<!-- font awesome -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />

<!-- uniform -->
<link type="text/css" rel="stylesheet" href="../assets/uniform/css/uniform.default.min.css" />

<!-- favicon -->
<link rel="shortcut icon" href="images/logo-favicon.png" type="image/x-icon">
<link rel="icon" href="images/logo-favicon.png" type="image/x-icon">

<!-- Custom styles for this template -->
<link rel="stylesheet" href="../assets/style-admin.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <span class="navbar-brand" href="#">Distribuidora El Trebol</span> </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenido/a <? echo $idUsuarioName; ?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
      </ul>
    </div>
  </div>
</nav>
