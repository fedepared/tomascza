<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$imagespath = "imagenes/";
$existe = 0;
if ($HttpVars->TraerGet('id_clie') != '') {  
	$id_clie = $HttpVars->TraerGet('id_clie') ;	
}
if ($HttpVars->TraerPost('envio') != '') { 
	$nombre = $HttpVars->TraerPost('nombre') ;
  $apellido = $HttpVars->TraerPost('apellido') ;
  $usuario = $HttpVars->TraerPost('usuario') ;
  $password = $HttpVars->TraerPost('password') ;
  $provincia = $HttpVars->TraerPost('provincia') ;
  $localidad = $HttpVars->TraerPost('localidad') ;
  $direccion = $HttpVars->TraerPost('direccion') ;
  $cp = $HttpVars->TraerPost('cp') ;
    $cuit = $HttpVars->TraerPost('cuit') ;
  $telefono = $HttpVars->TraerPost('telefono') ;
  $celular = $HttpVars->TraerPost('celular') ;
  $email = $HttpVars->TraerPost('email') ;
                  
  
	
	$id_clie = $HttpVars->TraerPost('id_clie') ;
	$sql="update tbl_clientes set 
	nombre = '".($nombre)."' 
  ,apellido = '".($apellido)."'
  ,usuario = '".($usuario)."'
  ,clave = '".($password)."'
  ,provincia = '".($provincia)."'
  ,localidad = '".($localidad)."'
  ,direccion = '".($direccion)."'
  ,cp = '".($cp)."'
  ,cuit = '".($cuit)."'
  ,telefono = '".($telefono)."'
  ,celular = '".($celular)."'
  ,email = '".($email)."'
	where id_clie =".$id_clie."";
	$result = $db->Query($sql,$connection);
	header("Location:listadoclientes.php?modificado=1");

} else {
	$sql="select * from tbl_clientes where id_clie = ".$id_clie."";
	$result = $db->Query($sql,$connection);
	$myrow = mysql_fetch_array($result, MYSQL_BOTH);
	
	$nombre = $myrow['nombre'];
  $apellido = $myrow['apellido'];
  $usuario = $myrow['usuario'];
  $password = $myrow['clave'];
  $provincia = $myrow['provincia'];
  $localidad = $myrow['localidad'];
  $direccion = $myrow['direccion'];
  $cp = $myrow['cp'];
  $telefono = $myrow['telefono'];  
  $celular = $myrow['celular'];
  $cuit = $myrow['cuit'];
  $email = $myrow['email'];
  
  
}
?>
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-folder"></i>&nbsp;Editar Categoria</h1>
      <form method="POST" action="e_clie.php" onSubmit="return validaCampos(this)">
        <?	
					echo agregada($agregada,$imagespath,'cliente','listadoclientes.php');
					echo existe($existe,$imagespath,'cliente');
				?>
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_clie" value="<? echo $id_clie ?>">
        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">usuario</label>
          <input type="text" name="usuario" class="form-control" id="usuario" value="<? echo $myrow['usuario'] ?>" placeholder="usuario">
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="password">Contrase&ntilde;a</label>
          <input type="password" name="password" class="form-control" id="password"  value="<? echo $myrow['clave'] ?>" placeholder="Contrase&ntilde;a">
        </div>
       </div>
        </div>
       <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Apellido</label>
          <input type="text" name="apellido" class="form-control" id="apellido" value="<? echo $myrow['apellido'] ?>" placeholder="Apellido">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" class="form-control" id="nombre" value="<? echo $myrow['nombre'] ?>" placeholder="Nombre">
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">C.U.I.T.</label>
          <input type="text" name="cuit" class="form-control" id="cuit" value="<? echo $myrow['cuit'] ?>" placeholder="C.U.I.T.">
        </div>
       </div>
        </div>
               
        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Telefono</label>
          <input type="text" name="telefono" class="form-control" id="telefono" value="<? echo $myrow['telefono'] ?>" placeholder="Telefono">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Celular</label>
          <input type="text" name="celular" class="form-control" id="celular" value="<? echo $myrow['celular'] ?>" placeholder="Celular">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Email</label>
          <input type="text" name="email" class="form-control" id="email" value="<? echo $myrow['email'] ?>" placeholder="E-Mail">
        </div>
       </div>
        </div>
        
        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Provincia</label>
          <input type="text" name="provincia" class="form-control" id="provincia"  value="<? echo $myrow['provincia'] ?>" placeholder="Provincia">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Localidad</label>
          <input type="text" name="localidad" class="form-control" id="localidad" value="<? echo $myrow['localidad'] ?>" placeholder="Localidad">          
        </div>
       </div>
       <div class="col-md-4">
        <div class="form-group">
          <label for="nombre">Direccion</label>
          <input type="text" name="direccion" class="form-control" id="direccion" value="<? echo $myrow['direccion'] ?>" placeholder="Direccion">
        </div>
       </div>
       
        </div> 
		<select name="cmbcatemaster" id="cmbcatemaster" style="display:none">
											<option value="1">Catalogo</option>
										</select>
										<script language="javascript">
document.getElementById("cmbcatemaster").selectedIndex = <? echo $idcatemaster - 1 ?>
</script>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>