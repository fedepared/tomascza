<?php 
session_start();
include_once 'class/conexion.php';
$link=Conectarse();
$qry =mysql_query("SELECT  FECHA_CIRUGIA
,(SELECT CONCAT(APELLIDO,concat(', ',NOMBRES)) FROM pacientes WHERE pacientes.ID = paciente_hc.ID_PACIENTE) as PACIENTE
,NROAFILIADO
,concat(
( COALESCE ((select concat('| ',CIRUGIA) from cirugia where cirugia.ID = paciente_hc.CIRUGIA1),'')),( COALESCE ((select concat('| ',CIRUGIA) from cirugia where cirugia.ID = paciente_hc.CIRUGIA2),'')),( COALESCE ((select concat('| ',CIRUGIA) from cirugia where cirugia.ID = paciente_hc.CIRUGIA3),'')),( COALESCE ((select concat('| ',CIRUGIA) from cirugia where cirugia.ID = paciente_hc.CIRUGIA4),''))

)
 as CIRUGIA
,concat(( COALESCE ((select concat('| ',CODIGO) from cirugia where cirugia.ID = paciente_hc.CIRUGIA1),'')),( COALESCE ((select concat('| ',CODIGO) from cirugia where cirugia.ID = paciente_hc.CIRUGIA2),'')),( COALESCE ((select concat('| ',CODIGO) from cirugia where cirugia.ID = paciente_hc.CIRUGIA3),'')),( COALESCE ((select concat('| ',CODIGO) from cirugia where cirugia.ID = paciente_hc.CIRUGIA4),''))

)
 as CODIGO
,AYUDANTE
,INSTRUMENTADORA
,(SELECT CLINICA FROM clinica WHERE clinica.ID = paciente_hc.CLINICA)AS CLINICA
 from paciente_hc"); 

$campos = mysql_num_fields($qry);   
$i=0;   

/******************************************** 
Extract field names and write them to the $header 
variable 
/********************************************/
ob_start(); 
echo "&nbsp;<center><table border=\"1\" align=\"center\">"; 
echo "<tr bgcolor=\"#336666\">   
  <td><font color=\"#ffffff\"><strong>Fecha</strong></font></td> 
  <TD><font color=\"#ffffff\"><strong>Paciente</strong></font></TD> 
  <td><font color=\"#ffffff\"><strong>Afiliado</strong></font></td> 
  <td><font color=\"#ffffff\"><strong>Cirugia</strong></font></td> 
  <td><font color=\"#ffffff\"><strong>Codigo</strong></font></td>
  <td><font color=\"#ffffff\"><strong>Ayudante</strong></font></td>
  <td><font color=\"#ffffff\"><strong>Instrumentadora</strong></font></td>
  <td><font color=\"#ffffff\"><strong>Clinica</strong></font></td>
  
  
</tr>"; 
while($row=mysql_fetch_array($qry)) 
{   
    echo "<tr>";   
     for($j=0; $j<$campos; $j++) 
     {
             echo "<td>".$row[$j]."</td>";
        
     }   
     echo "</tr>";         
}   
echo "</table>";


$reporte = ob_get_clean();
/******************************************** 
Set the automatic downloadn section 
/********************************************/

header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=Historico.xls");
header("Pragma: no-cache"); 
header("Expires: 0");


  

echo $reporte; 


?>