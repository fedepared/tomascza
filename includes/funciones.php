<?php
    require_once('flash.php');
function fecha_a_stamp($fecha){
    $fecha = split('-', $fecha);
    return(mktime(0,0,0,$fecha[1], $fecha[2], $fecha[0]));
}

function stamp_a_fecha($stamp){
    return(date("Y-m-d", $stamp));
}

function sumar_dias($fecha, $cant_dias){
    $stamp = fecha_a_stamp($fecha);
    $stamp += $cant_dias * (24*60*60);
    return(date("Y-m-d", $stamp));
}

function fechaSTD($fecha){
    $fecha = split("/", $fecha);
    return($fecha[2] . "-" . $fecha[1] . "-" . $fecha[0]);
}

function fechaEU($fecha){
    // ACA SE CAMBIO
    $fecha = split("-", $fecha);
    //$fecha = explode("-", $fecha);
    return($fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]);
}

function fechaCanonical($fecha){
    //ACA SE CAMBIO
    $fecha = split("/", $fecha);
    //$fecha = explode("/",$fecha);
    return($fecha[2] . "-" . $fecha[1] . "-" . $fecha[0]);
}

function cantidadDeHoras($per_id){
    $consulta = "SELECT COUNT(*) as horas FROM horarios WHERE hor_per_id = '$per_id'";
    $fila = Consulta::traerFila($consulta);
    $horas = $fila["horas"];
    $horas /= 2;

    return($horas);
}

function dircopy($source, $dest, $overwrite = false){ 
    if(!is_dir($dest)) //Lets just make sure our new folder is already created. Alright so its not efficient to check each time... 
    mkdir($dest);
    if($handle = opendir($source)){        // if the folder exploration is sucsessful, continue
        while(false !== ($file = readdir($handle))){ // as long as storing the next file to $file is successful, continue
            if($file != "." && $file != ".." && $file != ".svn"){
                $path = $source . '/' . $file;
                if(is_file($path)){
                    if(!is_file($dest . '/' . $file) || $overwrite)
                    if(!@copy($path, $dest . '/' . $file)){
                        echo '<font color="red">File ('.$path.') could not be copied, likely a permissions problem.</font>';
                    }
                } elseif(is_dir($path)){
                    if(!is_dir($dest . '/' . $file)) 
                    mkdir($dest . '/' . $file); // make subdirectory before subdirectory is copied
                    LOC_recursive_dircopy($path, $dest . '/' . $file, $overwrite); //recurse!
                }
            }
        }
        closedir($handle);
    }
}

function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}



/*ACA SE CAMBIO */

/**
 *  Messages associated with the upload error code
 */
// const MESSAGES = [
//     UPLOAD_ERR_OK => 'File uploaded successfully',
//     UPLOAD_ERR_INI_SIZE => 'File is too big to upload',
//     UPLOAD_ERR_FORM_SIZE => 'File is too big to upload',
//     UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
//     UPLOAD_ERR_NO_FILE => 'No file was uploaded',
//     UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server',
//     UPLOAD_ERR_CANT_WRITE => 'File is failed to save to disk.',
//     UPLOAD_ERR_EXTENSION => 'File is not allowed to upload to this server',
// ];

/**
 * Redirect user with a session based flash message
 * @param string $message
 * @param string $type
 * @param string $name
 * @param string $location
 * @return void
 */
// function redirect_with_message(string $message, string $type=FLASH_ERROR, string $name='upload', string $location='../pacientes_images.php'): void
// {
//     flash($name, $message, $type);
//     // header("Location: $location", true, 303);
//     // exit;
// }

// function format_messages(string $title, array $messages): string
// {
//     $message = "<p>$title</p>";
//     $message .= '<ul>';
//     foreach ($messages as $key => $value) {
//         $message .= "<li>$value</li>";
//     }
//     $message .= '<ul>';

//     return $message;
// }

?>
