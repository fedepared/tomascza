<?php
function Conectarse()
{
   if (!($link=mysql_connect("localhost","toma930_cirugia","zct*207")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db("toma930_cirugias",$link))//ecommerce
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}
?>