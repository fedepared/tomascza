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
	$nombre = $HttpVars->TraerPost('nombre') ;
  $apellido = $HttpVars->TraerPost('apellido') ;
  $cuit = $HttpVars->TraerPost('cuit') ;
  $usuario = $HttpVars->TraerPost('usuario') ;
  $password = $HttpVars->TraerPost('password') ;
  $telefono = $HttpVars->TraerPost('telefono') ;
  $celular = $HttpVars->TraerPost('celular') ;
  $provincia = $HttpVars->TraerPost('provincia') ;
  $localidad = $HttpVars->TraerPost('localidad') ;
  $direccion = $HttpVars->TraerPost('direccion') ;
  $cp = $HttpVars->TraerPost('cp') ;
  $email = $HttpVars->TraerPost('email') ;
  

	$idcatemaster = $HttpVars->TraerPost('cmbcatemaster') ;

	$sql="SELECT nombre from tbl_clientes where nombre = '" . $nombre . "' ";
	//echo $sql;
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{
		if ($chkpubli == "") $chkpubli = 0;
		$sql="INSERT into tbl_clientes(usuario, clave, nombre, apellido, cuit, email, direccion, localidad, cp, provincia, telefono, celular)  
    VALUES ('".htmlentities($usuario)."','".$password."','".$nombre."','".$apellido."','".$cuit."','".$email."','".$direccion."','".$localidad."','".$cp."','".$provincia."','".$telefono."','".$celular."')";
		$result = $db->Query($sql,$connection);
		$agregada = 1;
		$nombre = "" ;
	}
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Agregar Cliente</h1>
      <form method="POST" action="a_clie.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'cliente','listadoclientes.php');
					echo existe($existe,$imagespath,'cliente');
				?>
        <input type="hidden" name="envio" value="1">
         <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">usuario</label>
          <input type="text" name="usuario" class="form-control" id="usuario" placeholder="usuario">
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="password">Contrase&ntilde;a</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Contrase&ntilde;a">
        </div>
       </div>
        </div>
       <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Apellido</label>
          <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre">
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">C.U.I.T.</label>
          <input type="text" name="cuit" class="form-control" id="cuit" placeholder="C.U.I.T.">
        </div>
       </div>
        </div>
               
        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Telefono</label>
          <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Telefono">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Celular</label>
          <input type="text" name="celular" class="form-control" id="celular" placeholder="Celular">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Email</label>
          <input type="text" name="email" class="form-control" id="email" placeholder="E-Mail">
        </div>
       </div>
        </div>
        
        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Provincia</label>
          <input type="text" name="provincia" class="form-control" id="provincia" placeholder="Provincia">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Localidad</label>
          <input type="text" name="localidad" class="form-control" id="localidad" placeholder="Localidad">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Direccion</label>
          <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion">
        </div>
       </div>
       
        </div>
         <div class="row">
       <div class="col-md-2">
        <div class="form-group">
          <label for="nombre">Codigo Postal</label>
          <input type="text" name="cp" class="form-control" id="cp" placeholder="Codigo Postal">
        </div>
       </div> 
        </div> 
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="nombre">Lista Precio 1</label>
        <input type="radio" name="listaprecio" value="1" id ="listaprecio">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="nombre">Lista Precio 2</label>
        <input type="radio" name="listaprecio" value="2" id ="listaprecio" >
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="nombre">Lista Precio 3</label>
        <input type="radio" name="listaprecio"  value="3" id ="listaprecio">
        </div></div>
        </div>
       
       
        
                      
        <select name="cmbcatemaster" style="display:none">
										<option value="1">Catalogo</option>
									</select>
         
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>