<?
require_once("include/includes.php");
if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$chk = $HttpVars->TraerPost('chkborrar');
$chkarray = split( ",", $chk);

for($i=0; $i < count($chkarray); $i++){

 
             $sqlprod="SELECT * from tbl_banners where id_banner=".$chkarray[$i];
             $resultprod = $db->Query($sqlprod,$connection);

             if ($db->CantidadFilas($resultprod) > 0) {
             while ($myrowprod = mysql_fetch_array($resultprod, MYSQL_BOTH)) {               
            
              @unlink("../banner/" . $myrowprod["filech"]);
            }}
	$sql = "DELETE from tbl_banners where id_banner = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);
}

header("Location:listadobanners.php?borrado=1");
?>