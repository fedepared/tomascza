<?
require_once("include/includes.php");

if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$imagespath = "imagenes/";
$idUsuarioName = $_SESSION['idUsuarioAdminSUser'];
$agregada = 0;
$existe = 0;

$id_prod = $HttpVars->TraerGet('id_prod');

if ($HttpVars->TraerPost('envio') != '') { 
	
	$id_prod = $HttpVars->TraerPost('id_prod') ;
	$id_cate = $HttpVars->TraerPost('cmbcategoria') ;
	$id_subcate = $HttpVars->TraerPost('cmbsubcate') ;
  $id_subcate2 = $HttpVars->TraerPost('cmbsubcate2') ;
  if ($id_subcate2=="")
  {
    $id_subcate2=0;
    }
	$id_marca = $HttpVars->TraerPost('cmbmarca') ;
	$id_modelo = $HttpVars->TraerPost('cmbmodelo') ;
	$nombre = $HttpVars->TraerPost('nombre') ;
	$codigo = $HttpVars->TraerPost('codigo') ;
	$fecha = $HttpVars->TraerPost('fecha') ;
  
	$precioD = $HttpVars->TraerPost('precioDistrib') ;
  if ($precioD=="")
  {
    $precioD=0;
  } 
  
    
	$chkpubli = $HttpVars->TraerPost('chkpubli') ;
	$oferta = $HttpVars->TraerPost('chkoferta') ;
	$destacado = $HttpVars->TraerPost('chkdestacado') ;

	
	
	if ($chkpubli == "") {
		$chkpubli = 0;
	}
	$dcorta = $HttpVars->TraerPost('dcorta') ;
	$dlarga = $HttpVars->TraerPost('dlarga') ;
	
	$sql="update tbl_productos set 
		id_cate = ".$id_cate.",
		id_subcate = ".$id_subcate.",
    id_subcate2 = ".$id_subcate2.",    
    precioDistrib = ".str_replace(",",".",$precioD).",
    nombre = '".$nombre."',		
		dlarga = '".$dlarga."',
    dcorta = '".$dcorta."',
		codigo = '".$codigo."',
		publicado = ".$chkpubli."
		
    
		where id_prod =".$id_prod."";
		$result = $db->Query($sql,$connection);

	
	
	header("Location:listadoproductos.php?modificado=1");
} else {
	$sql = "select id_prod, nombre, dlarga, codigo,precioDistrib,dcorta,id_cate,id_subcate,id_subcate2, publicado from tbl_productos where id_prod = ".$id_prod."";

	$result = $db->Query($sql,$connection);
	$db->FetchArray($result,&$myrow);
	$id_prod = $myrow['id_prod'];
	$id_cate = $myrow['id_cate'];	
	$id_subcate = $myrow['id_subcate'];
  $id_subcate2 = $myrow['id_subcate2'];
	$nombre = $myrow['nombre'];
  $precioD = $myrow['precioDistrib'];
  $dcorta = $myrow['dcorta'];
	$dlarga = $myrow['dlarga'];
	$codigo = $myrow['codigo'];	
	$publicado = $myrow['publicado'];

	
}
?>  
<? include ("header.php") ?>
<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-shopping-cart"></i>&nbsp;Editar Articulo</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'servicio','listadoproductos.php');
					echo existe($existe,$imagespath,'producto');
					?>
      <form name="form0" id="form0" method="POST" action="e_prod.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <input type="hidden" name="id_prod" value="<? echo $id_prod?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input name="nombre" type="text" class="form-control" id="nombre" placeholder="nombre" value="<? echo $nombre ?>">
        </div>
		    <div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Costo </label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" name="precioDistrib" class="form-control" value="<? echo $precioD ?>" id="precioDistrib" placeholder="precio">
              </div>
            </div>
          </div>
          
          </div>
     
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="codigo">Codigo</label>
              <input name="codigo" type="text" class="form-control" id="codigo" placeholder="nombre" value="<? echo $codigo ?>" size="7" maxlength="7">
            </div>
          </div>
          
        </div>
        <div class="form-group">
          <label for="dlarga">Descripción Corta</label>
          <textarea name="dcorta" id="dcorta" rows="5" class="form-control"><? echo $dcorta ?></textarea>
        </div>        
        <div class="form-group">
          <label for="dlarga">Descripción en detalle</label>
          <textarea name="dlarga" id="dlarga" rows="5" class="form-control"><? echo $dlarga ?></textarea>
        </div>
		
        <div class="form-group">
		<label for="cmbcategoria">Categoria</label>
		
                                  
                             <select name='cmbcategoria' id='cmbcategoria' onChange='traigoSubcategorias(this,"cmbsubcate")'>
                            <? 
												$sql = "select id_cate, nombre from tbl_categorias order by nombre";
												$result = $db->Query($sql,$connection);
												
												while(($db->FetchArray($result,&$myrow))) {
													$selected ="";
													if($myrow['id_cate'] == $id_cate){
														$selected = " selected";
													}
													echo "<option value='".$myrow['id_cate']."' ".$selected.">".$myrow['nombre']."</option>";
												}
												?>
                          </select> 
                            
        </div>
		
		<div class="form-group">
		<label for="cmbsubcate">Sub - Nivel 1</label>
                              
                             <select name="cmbsubcate" id="cmbsubcate" onChange='traigoSubcategorias2(this,"cmbsubcate2")'> 
                            <? 
												$sql = "select id_subcate, nombre from tbl_subcategorias where id_cate=".$id_cate." order by 1";
												$result = $db->Query($sql,$connection);
												
												while(($db->FetchArray($result,&$myrow))) {
													$selected ="";
													if($myrow['id_subcate'] == $id_subcate){
														$selected = " selected";
													}
													echo "<option value='".$myrow['id_subcate']."' ".$selected.">".$myrow['nombre']."</option>";
												}
												?>
                          </select> 
                            
        </div>                                          
        <div class="form-group">
		<label for="cmbsubcate2">Sub - Nivel 2</label>
		
                                  
                             <select name="cmbsubcate2" id="cmbsubcate2" >
                            <? 
												$sql = "select id_subcate, nombre from tbl_subcategorias2 where id_subcate=".$id_subcate2." order by 1";
												$result = $db->Query($sql,$connection);
												
												while(($db->FetchArray($result,&$myrow))) {
													$selected ="";
													if($myrow['id_subcate'] == $id_subcate2){
														$selected = " selected";
													}
													echo "<option value='".$myrow['id_subcate']."' ".$selected.">".$myrow['nombre']."</option>";
												}
												?>
                          </select> 
                            
        </div>
		
        <div class="checkbox-inline text-primary">
        <?
												$checked = "";
												if($publicado ==1){ $checked = " checked ";	}
												?>
          <label>
            <input type="checkbox" name="chkpubli" value=1 <? echo $checked ?>>
            Publicado </label>
        </div>
        
        <div class="clearfix"></div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<? include ("pie.php") ?>