<?php
function Conectarse()
{
   if (!($link=mysql_connect("dbp03.lineadns.com","seraviat_ecomm","seraviat2014")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db("seraviat_ecommerce",$link))//ecommerce
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}
?>