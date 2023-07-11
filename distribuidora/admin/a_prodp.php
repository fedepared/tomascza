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

	$sql="SELECT nombre from tbl_productos where id_cate=9 and nombre = '" . $nombre . "'";
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
		$precio = $HttpVars->TraerPost('precio') ;
		$id_cate = $HttpVars->TraerPost('cmbcategoria') ;
		$id_subcate = $HttpVars->TraerPost('cmbsubcate') ;
		$id_marca = $HttpVars->TraerPost('cmbmarca') ;
		$id_modelo = $HttpVars->TraerPost('cmbmodelo') ;
		
		$id_general = $HttpVars->TraerPost('idgeneral') ;
		$id_otros = $HttpVars->TraerPost('idotros') ;
		$id_confort = $HttpVars->TraerPost('idconfort') ;
		$id_exterior = $HttpVars->TraerPost('idexterior') ;
		
		
		
		$sql="INSERT into tbl_productos( nombre, id_cate, id_subcate, codigo, dcorta, dlarga,   publicado,fecha_emision)  VALUES " . 
		                         "('".$nombre."',".$id_cate.",".$id_subcate.",'".$codigo."','".$dcorta."','".$dlarga."',".$chkpubli.",'".$fecha."')";
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
					echo agregada($agregada,$imagespath,'producto','listadoproductosp.php');
					echo existe($existe,$imagespath,'producto');
					?>
      <form name="form0" id="form0" method="POST" action="a_prodp.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
        <div class="form-group">
          <label for="nombre">Titulo</label>
          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
        </div>
		<div class="row">
          <div class="col-md-3">
		<div class="form-group">
          <label for="fecha">Fecha</label>
          <input  type="date" name="fecha" class="form-control" id="fecha" placeholder="fecha">
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
        <div class="form-group">
          <label for="dcorta">Descripción Corta</label>
          <textarea name="dcorta" id="dcorta" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="dlarga">Descripción en detalle</label>
          <textarea name="dlarga" id="dlarga" rows="5" class="form-control"></textarea>
        </div>
<br> 
		<div>
		

        
		
        <div class="form-group">
          <label for="cmbcategoria">Categoria</label>
          <?
									$sql = "select id_cate,nombre from tbl_categorias where id_cate=9  order by nombre";
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
          <label for="cmbsubcate">Subcategoria</label>
          <select name="cmbsubcate" id="cmbsubcate">
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