<?php
include "res/imemail.inc.php";
$asunto = 'Envio CV';
$email="tomascza@icloud.com";

$email_to = $_POST["DESTINATARIO"]; // The email you are sending to (example)
$email_from = "tomascza@icloud.com"; // The email you are sending from (example)
$email_subject = "Envio CV"; // The Subject of the email
$email_txt = "Te adjunto CV"; // Message that the email has in it
$fileatt = "CV/".$_POST["persona"]; // Path to the file (example)
 
$fileatt_type = "application/msword"; // File Type
$fileatt_name = $_POST["persona"]; // Filename that will be used for the file as the attachment
$file = fopen($fileatt,'rb');
$data = fread($file,filesize($fileatt));
fclose($file);
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers="From: $email_from"; // Who the email is from (example)
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
$email_message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $email_txt;
$email_message .= "\n\n";
$data = chunk_split(base64_encode($data));
$email_message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"--{$mime_boundary}--\n";

mail($email_to,$email_subject,$email_message,$headers);


/*
$uid = md5(uniqid(time()));

$semi_rand = md5(time());
$mime_boundary = "==TecniBoundary_x{$semi_rand}x"; 

$header = 'From: ' . $email . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";

$header .= "Content-type: multipart/mixed;";
$header .= "boundary=\"--_Separador-de-mensajes_--\"\n";
$mensaje = "----_Separador-de-mensajes_--\n";

$mensaje .= "Content-Type: text/plain; charset='iso-8859-1' \r\n";
$mensaje .= "Content-Transfer-Encoding: 7bit \r\n\r\n";
$file="CV/".$_POST["persona"];
$fp = fopen("CV/".$_POST["persona"]."", "rb");
$data = fread($fp, filesize("CV/".$_POST["persona"].""));
fclose($fp);
$data = chunk_split(base64_encode($data));


$mensaje .= "--{$mime_boundary}\r\n";
$mensaje .= "Content-Type: ".$fp["type"]."; name=\"" . basename($file). "\"\r\n" . "Content-Transfer-Encoding: base64\r\n" . $data . "\r\n" . "Content-Disposition: attachment\r\n";

$mensaje .= "--{$mime_boundary}--";

$boundary='didondinaditondelosdudosdodudundodudindon';
//Cabeceras del email
$headers="From: $email\r\n
MIME-Version: 1.0\r\n
Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n\n";

//Cuerpo del email comenzando por el mensaje principal
$body="--". $boundary ."\n
Content-Type: text/plain; charset=ISO-8859-1\r\n\n
Mensaje principal del email.\n\n";

 Archivo adjunto, vamos a indicar que nuestro archivo se llama bidule.doc y que se encuentra
 en el directorio actual 

$archivo=file_get_contents("CV/".$_POST["persona"]);
 Utilizaremos chunk_split() que organizará come se debe la codificación hecha en base 64 para
 estar conforme a los estándares 
$archivo=chunk_split( base64_encode($archivo) );

//Escritura del archivo adjunto
$body = $body . "--" .$boundary. "\n
Content-Type: application/msword; name=\"".$archivo["name"]."\"\r\n
Content-Transfer-Encoding: base64\r\n
Content-Disposition: attachment; filename=\"".$archivo["name"]."\"\r\n\n
$archivo";

//Cierre de la frontera
$body = $body . "--" . $boundary ."--";
*/
//Envío del email
//mail($_POST["DESTINATARIO"], $asunto, $body, $headers);

?>