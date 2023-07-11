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
	$pathabs1 = "";
	$pathabs2 = "";
	$nombre = $HttpVars->TraerPost('nombre');	

	$sql="SELECT nombre from tbl_productos where nombre = '" . $nombre . "'";
	$result = $db->Query($sql,$connection);
	if ($db->CantidadFilas($result) > 0) { 
		$existe = 1;
	}else{	
		$nombre = $HttpVars->TraerPost('nombre') ;

		$chkpubli = $HttpVars->TraerPost('chkpubli') ;
		
		if ($chkpubli == "") $chkpubli = 0;
		


		$dcorta = $HttpVars->TraerPost('dcorta') ;
		$dlarga = $HttpVars->TraerPost('dlarga') ;
		$fecha = $HttpVars->TraerPost('fecha') ;
		$codigo = $HttpVars->TraerPost('codigo') ;
		$precioD = $HttpVars->TraerPost('precioDistrib') ;
    $precioM = $HttpVars->TraerPost('precioMetro') ;
    $precioC = $HttpVars->TraerPost('precioCorte') ;
    $rolloM = $HttpVars->TraerPost('rmetro') ;
    $rolloA = $HttpVars->TraerPost('rancho') ;
    $rolloR = $HttpVars->TraerPost('rrmetros') ;
    
    
		$id_cate = $HttpVars->TraerPost('cmbcategoria') ;
		$id_subcate = $HttpVars->TraerPost('cmbsubcate') ;
    $id_subcate2 = $HttpVars->TraerPost('cmbsubcate2') ;
		$id_marca = $HttpVars->TraerPost('cmbmarca') ;
		$id_modelo = $HttpVars->TraerPost('cmbmodelo') ;
		
		$id_general = $HttpVars->TraerPost('idgeneral') ;
		$id_otros = $HttpVars->TraerPost('idotros') ;
		$id_confort = $HttpVars->TraerPost('idconfort') ;
		$id_exterior = $HttpVars->TraerPost('idexterior') ;
		
		
		
		$sql="INSERT into tbl_productos( nombre, id_cate, id_subcate,id_subcate2, codigo, dlarga, publicado,precioDistrib,dcorta)  VALUES " . 
		                          "('".$nombre."',".$id_cate.",".$id_subcate.",".$id_subcate2.",'".$codigo."','".$dlarga."',".$chkpubli.",".str_replace(",",".",$precioD).",'".$dcorta."')";
		$result = $db->Query($sql,$connection);
		
		
		$sqlmax="SELECT max(id_prod) as id_prod from tbl_productos";
		$resultmax = $db->Query($sqlmax,$connection);
		$myrowmax = mysql_fetch_array($resultmax, MYSQL_BOTH);
		$max_id_prod = $myrowmax['id_prod'];
		
		
		$agregada = 1;		
		
		//grabo las categorias en la tabla relcateprod
		$sql = "SELECT MAX(id_prod) as id_prod FROM tbl_productos";
		$result = $db->Query($sql,$connection);
		$db->FetchArray($result,&$myrow);
		$id_prod = $myrow["id_prod"];

		$idcate=$HttpVars->TraerPost('id_cate');
		while (list ($key,$val) = @each ($idcate)) {
			$sql = "INSERT INTO tbl_relcateprod(id_prod, id_cate) VALUES (".$id_prod.",".intval($val).")";
			$result = $db->Query($sql,$connection);
		} 
		
		
	}
}
?>
<? include ("header.php") ?>

<div class="container">
  <div class="row">
    <? include ("botonera.php") ?>
    <div class="col-md-10 main">
      <h1 class="page-header"><i class="fa fa-shopping-cart"></i>&nbsp;Agregar Articulo</h1>
      <div id="mensaje"></div>
      <?	
					echo agregada($agregada,$imagespath,'producto','listadoproductos.php');
					echo existe($existe,$imagespath,'producto');
					?>
      <form name="form0" id="form0" method="POST" action="a_prod.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
         <div class="row">
          <div class="col-md-6">
        <div class="form-group">
          <label for="nombre">Titulo</label>
          <input type="text" name="nombre" size="20" class="form-control" id="nombre" placeholder="nombre">
          
        </div>
        
        </div>
        </div>                
        
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="codigo">Codigo</label>
              <input name="codigo" type="text" class="form-control" id="codigo" placeholder="codigo" size="7" maxlength="7">
            </div>
          </div>
          
        </div>
		<div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Costo </label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" name="precioDistrib" class="form-control" value="0" id="precioDistrib" placeholder="precio">
              </div>
            </div>
          </div>
          </div>
        <div class="form-group">
          <label for="dlarga">Descripción Corta</label>
          <textarea name="dcorta" id="dcorta" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="dlarga">Descripción en detalle</label>
          <textarea name="dlarga" id="dlarga" rows="5" class="form-control"></textarea>
        </div>
        
<br> 
		<div>
		

        
		
        <div class="form-group">
          <label for="cmbcategoria">Categoria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <?
									$sql = "select id_cate,nombre from tbl_categorias   order by nombre";
									$result = $db->Query($sql,$connection);
									echo "<select name='cmbcategoria' id='cmbcategoria' class='combo' onChange='traigoSubcategorias(this,\"cmbsubcate\")'>";
									echo "<option value='0'>Seleccione una categoría</option>";
									$cont = 1;
									while(($db->FetchArray($result,&$myrow))) {
											echo "<option value=".$myrow['id_cate'].">".$myrow['nombre']."</option>";
									}
									echo "</select>";
									?>
        </div>
        <div class="form-group">
          <label for="cmbsubcate">Sub - Nivel 1&nbsp;</label>
          <select name="cmbsubcate" id="cmbsubcate" class="combo" onChange='traigoSubcategorias2(this,"cmbsubcate2")'>
            <option value="0">-------------</option>
          </select>
        </div>
        <div class="form-group">
          <label for="cmbsubcate2">Sub - Nivel 2&nbsp;</label>
          <select name="cmbsubcate2" id="cmbsubcate2">
            <option value="0">-------------</option>
          </select>
        </div>
        <div class="checkbox-inline text-primary">
          <label>
            <input type="checkbox" name="chkpubli" value=1 checked>
            Publicado </label>
        </div>
		
        <div class="clearfix"></div>
        <input type="submit" class="btn btn-success" name="enviar" value="Grabar">
        <button class="btn btn-info" value="volver" onClick="history.go(-1)">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<?
 include ("pie.php") ?>