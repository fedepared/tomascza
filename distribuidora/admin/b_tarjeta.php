<?
require_once("include/includes.php");
if (($HttpVars->TraerSession('adminValido')	!= "si")){
	header("Location: index.php");
}

$chk = $HttpVars->TraerPost('chkborrar');
$chkarray = split( ",", $chk);

for($i=0; $i < count($chkarray); $i++){

 
             $sqlprod="SELECT * from tbl_tarjetas where id_tarjeta=".$chkarray[$i];
             $resultprod = $db->Query($sqlprod,$connection);

             if ($db->CantidadFilas($resultprod) > 0) {
             while ($myrowprod = mysql_fetch_array($resultprod, MYSQL_BOTH)) {               
            
              @unlink("../cards/" . $myrowprod["filech"]);
            }}
	$sql = "DELETE from tbl_tarjetas where id_tarjeta = ".$chkarray[$i]."";
	$result = $db->Query($sql,$connection);
}

header("Location:listadotarjetas.php?borrado=1");
?>