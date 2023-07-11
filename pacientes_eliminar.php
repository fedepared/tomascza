<?php
include_once("includes/funciones_bd.php");

$sql = "DELETE FROM pacientes WHERE pac_id = " . $_GET["id"];
Consulta::ejecutar($sql);

@remove_dir("/home4/toma930/public_html/imagenes/" . $_GET["apellido"] . "_" . $_GET["nombre"] . "_" . $_GET["id"]);

header("Location: pacientes.php?a=e");

function remove_dir($dir)
{
$handle = opendir($dir);
while (false!==($item = readdir($handle)))
{
if($item != '.' && $item != '..')
{
if(is_dir($dir.'/'.$item)) 
{
remove_dir($dir.'/'.$item);
}else{
unlink($dir.'/'.$item);
}
}
}
closedir($handle);
if(rmdir($dir))
{
$success = true;
}
return $success;
}
?>
