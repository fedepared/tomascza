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

		
		$nombre = $HttpVars->TraerPost('nombre') ;

		$chkpubli = $HttpVars->TraerPost('chkpubli') ;
		
		if ($chkpubli == "") $chkpubli = 0;
		

		$id_cate = $HttpVars->TraerPost('cmbcategoria') ;
		$id_subcate = $HttpVars->TraerPost('cmbsubcate') ;
    $id_subcate2 = $HttpVars->TraerPost('cmbsubcate2') ;
		$porcentaje = $HttpVars->TraerPost('porcentaje') ;
		
    $addUpdate="";
		if ($id_subcate2!="")
    {
      $addUpdate=" where id_subcate2 = ".$id_subcate2;
    
    }
    else
    {
      if ($id_subcate!="")
      {
             $addUpdate=" where id_subcate = ".$id_subcate;
      }
      else
      {
        if ($id_cate!="")
        {
          $addUpdate=" where id_cate = ".$id_cate;
        
        }
      
      }
      
    }       
		$sql="
    UPDATE tbl_precios p join (
                            select  max(id_precio) as id
                            from tbl_precios
                            where id_prod in 
                            (select id_prod from tbl_productos ".$addUpdate.")
                            group by id_prod
                        ) m
        on p.id_precio = m.id
        
        SET p.nu_precio1= p.nu_precio1+(p.nu_precio1*".$porcentaje."/100)
        ,p.nu_precio2= p.nu_precio2+(p.nu_precio2*".$porcentaje."/100)
        ,p.nu_precio3= p.nu_precio3+(p.nu_precio3*".$porcentaje."/100)
    ";
    
		$result = $db->Query($sql,$connection);
		
		
header("Location:listadomasivoprecio.php?modificado=1");	
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
      <form name="form0" id="form0" method="POST" action="a_preciomasivo.php" onSubmit="return validaCampos(this)">
        <input type="hidden" name="envio" value="1">
         
		
        
<br> 
		<div>
		

        
		
        <div class="form-group">
          <label for="cmbcategoria">Categoria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <?
									$sql = "select id_cate,nombre from tbl_categorias   order by nombre";
									$result = $db->Query($sql,$connection);
									echo "<select name='cmbcategoria' id='cmbcategoria' class='combo' onChange='traigoSubcategorias(this,\"cmbsubcate\")'>";
									echo "<option value='0'>Seleccione una categor&iacute;a</option>";
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
        <div class="row">
     <div class="col-md-3">
            <div class="form-group">
              <label for="precioDistrib">Porcentaje </label>
              <div class="input-group">              
                <div class="input-group-addon">%</div>
                <input type="text" name="porcentaje" class="form-control" value="0" id="porcentaje" placeholder="Porcentaje">
              </div>
            </div>
          </div>
          </div>
          
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