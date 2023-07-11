<?php 
session_start();
include_once 'class/conexion.php';
$link=Conectarse();
$idpacientes= explode(",", $_POST["mails"]);
$idcir="";
for ($i=0;$i<count($idpacientes);$i++)
	{
		if ($i==0)
			$idcir="'".$idpacientes[$i]."'";
		else
			$idcir.=",'".$idpacientes[$i]."'";
	}		
$qry =mysql_query("SELECT  
CASE WHEN MONTH(FECHA_CIRUGIA) = 1 THEN 'ENERO'
WHEN MONTH(FECHA_CIRUGIA) = 2 THEN 'FEBRERO'
WHEN MONTH(FECHA_CIRUGIA) = 3 THEN 'MARZO'
WHEN MONTH(FECHA_CIRUGIA) = 4 THEN 'ABRIL'
WHEN MONTH(FECHA_CIRUGIA) = 5 THEN 'MAYO'
WHEN MONTH(FECHA_CIRUGIA) = 6 THEN 'JUNIO'
WHEN MONTH(FECHA_CIRUGIA) = 7 THEN 'JULIO'
WHEN MONTH(FECHA_CIRUGIA) = 8 THEN 'AGOSTO'
WHEN MONTH(FECHA_CIRUGIA) = 9 THEN 'SEPTIEMBRE'
WHEN MONTH(FECHA_CIRUGIA) = 10 THEN 'OCTUBRE'
WHEN MONTH(FECHA_CIRUGIA) = 11 THEN 'NOVIEMBRE'
WHEN MONTH(FECHA_CIRUGIA) = 12 THEN 'DICIEMBRE'
ELSE 'esto no es un mes' END AS MES
,FECHA_CIRUGIA
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
 from paciente_hc where ID in(".$idcir.") 
 order by FECHA_CIRUGIA, CONVERT(HORA_CIRUGIA, SIGNED INTEGER)"); 

$campos = mysql_num_fields($qry);   
$i=0;   

/******************************************** 
Extract field names and write them to the $header 
variable 
/********************************************/
ob_start(); 
$rowMes=mysql_fetch_array($qry);
echo "<style type='text/css'>
<!--
.xl65
 {mso-style-parent:style0;
 mso-number-format:'\@';}

-->
</style>";
echo "&nbsp;<center><table border=\"1\" align=\"center\">"; 
echo "<tr bgcolor=\"#336666\"> 
<td colspan='8'><font color=\"#ffffff\"><strong>CIRUGIA MES ".$rowMes["MES"]."</strong></font></td>
</tr>
<tr bgcolor=\"#336666\">
<td colspan='8'><font color=\"#ffffff\"><strong>DR. TOMAS CZARNITZKI PRESTADOR 207289 </strong></font></td>
</TR>
<tr bgcolor=\"#336666\">
<td colspan='8'><font color=\"#ffffff\"><strong>AV. ACOYTE 76 PISO 4°</strong></font></td>
</TR>
</table>
";


echo "&nbsp;<center><table border=\"1\" align=\"center\">"; 
echo "<tr bgcolor=\"#336666\">   
<td><font color=\"#ffffff\"><strong>Orden</strong></font></td>

  <td><font color=\"#ffffff\"><strong>Fecha</strong></font></td> 
  <TD><font color=\"#ffffff\"><strong>Paciente</strong></font></TD> 
  <td><font color=\"#ffffff\"><strong>Afiliado</strong></font></td> 
  <td><font color=\"#ffffff\"><strong>Cirugia</strong></font></td> 
  <td><font color=\"#ffffff\"><strong>Codigo</strong></font></td>
  <td><font color=\"#ffffff\"><strong>Ayudante</strong></font></td>
  <td><font color=\"#ffffff\"><strong>Instrumentadora</strong></font></td>
  <td><font color=\"#ffffff\"><strong>Clinica</strong></font></td>
  
  
</tr>"; 
$contado=1;
$sql1= " SELECT  
CASE WHEN MONTH(FECHA_CIRUGIA) = 1 THEN 'ENERO'
WHEN MONTH(FECHA_CIRUGIA) = 2 THEN 'FEBRERO'
WHEN MONTH(FECHA_CIRUGIA) = 3 THEN 'MARZO'
WHEN MONTH(FECHA_CIRUGIA) = 4 THEN 'ABRIL'
WHEN MONTH(FECHA_CIRUGIA) = 5 THEN 'MAYO'
WHEN MONTH(FECHA_CIRUGIA) = 6 THEN 'JUNIO'
WHEN MONTH(FECHA_CIRUGIA) = 7 THEN 'JULIO'
WHEN MONTH(FECHA_CIRUGIA) = 8 THEN 'AGOSTO'
WHEN MONTH(FECHA_CIRUGIA) = 9 THEN 'SEPTIEMBRE'
WHEN MONTH(FECHA_CIRUGIA) = 10 THEN 'OCTUBRE'
WHEN MONTH(FECHA_CIRUGIA) = 11 THEN 'NOVIEMBRE'
WHEN MONTH(FECHA_CIRUGIA) = 12 THEN 'DICIEMBRE'
ELSE 'esto no es un mes' END AS MES
,FECHA_CIRUGIA
,(SELECT CONCAT(APELLIDO,concat(', ',NOMBRES)) FROM pacientes WHERE pacientes.ID = paciente_hc.ID_PACIENTE) as PACIENTE
,CAST(NROAFILIADO as char) as  NROAFILIADO
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
 from paciente_hc where ID in(".$idcir.") 
 order by FECHA_CIRUGIA, CONVERT(HORA_CIRUGIA, SIGNED INTEGER)";
$consulta1= mysql_query($sql1,$link);			
while($row= mysql_fetch_assoc($consulta1)) 
{
//while($row=mysql_fetch_array($qry)) 
//{   
    echo "<tr>"; 
    echo "<td>".$contado."</td>";  
     //for($j=0; $j<$campos; $j++) 
     {
       
             echo "<td>".$row["FECHA_CIRUGIA"]."</td>";
             echo "<td>".$row["PACIENTE"]."</td>";
             echo "<td class='xl65'>".$row["NROAFILIADO"]."</td>";
             echo "<td>".$row["CIRUGIA"]."</td>";
             echo "<td>".$row["CODIGO"]."</td>";
             echo "<td>".$row["AYUDANTE"]."</td>";
             echo "<td>".$row["INSTRUMENTADORA"]."</td>";
             echo "<td>".$row["CLINICA"]."</td>";
        
     }   
     echo "</tr>";
     $contado++;         
}   
echo "</table>";
echo "<PRE>".$row."</PRE>";

$reporte = ob_get_clean();
/******************************************** 
Set the automatic downloadn section 
/********************************************/

header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=Facturacion.xls");
header("Pragma: no-cache"); 
header("Expires: 0");


  

echo $reporte; 


?>