<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida de archivos</title>
</head>
<body>
    <?php
    include_once("authentication.php");
    include_once("funciones_bd.php");
    include_once("funciones.php");

    /*Preparo subida de archivos*/
    const ALLOWED_FILES = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg'
    ];
    const MAX_SIZE = 8 * 1024 * 1024; //  4MB

    $is_post_request = strtolower($_SERVER['REQUEST_METHOD']) === 'post';
    $has_files = isset($_FILES['files']);
    if (count($_FILES['files'])==0 || !$is_post_request || !$has_files) {

        echo('Error en la carga: se ha intentado ejecutar un método distinto a post o no se ha agregado ningun archivo');
    }

    // if () {
    //     // redirect_with_message('Invalid file upload operation', FLASH_ERROR);
    //     die();
    // }
    else
    {
        $id 		   = $_POST["pac_id"];
        $nombre        = mb_convert_encoding($_POST["nombre"], "UTF-8");
        $apellido      = mb_convert_encoding($_POST["apellido"], "UTF-8");


        // const UPLOAD_DIR = __DIR__ . '/uploads';

        $dir = "../imagenes"."/".$apellido . "_" . $nombre . "_" . $id;

    

        


        $files = $_FILES['files'];
        $file_count = count($files['name']);

        // validation
        $errors = [];
        for ($i = 0; $i < $file_count; $i++) {
            // get the uploaded file info
            $status = $files['error'][$i];
            $filename = $files['name'][$i];
            $tmp = $files['tmp_name'][$i];
            $message="";
            // an error occurs
            if ($status !== UPLOAD_ERR_OK) {
                $errors[$filename] = $status;
                
                switch($status)
                {
                    case UPLOAD_ERR_INI_SIZE:

                        $message = "El archivo excede la directiva de máximo tamaño en php.ini";
        
                        break;
        
                    case UPLOAD_ERR_FORM_SIZE:
        
                        $message = "El archivo subido excede la directiva MAX_FILE_SIZE especificada en el formulario";
        
                        break;
        
                    case UPLOAD_ERR_PARTIAL:
        
                        $message = "El archivo fue solo parcialmente subido";
        
                        break;
        
                    case UPLOAD_ERR_NO_FILE:
        
                        $message = "No fue encontrado ningún archivo";
        
                        break;
        
                    case UPLOAD_ERR_NO_TMP_DIR:
        
                        $message = "Carpeta temporaria perdida";
        
                        break;
        
                    case UPLOAD_ERR_CANT_WRITE:
        
                        $message = "Fallo en la escritura del disco";
        
                        break;
        
                    case UPLOAD_ERR_EXTENSION:
        
                        $message = "La carga del archivo se detuvo por una extensión";
        
                        break;
        
        
        
                    default:
        
                        $message = "Error de carga desconocido";
        
                        break;
                }
                echo "<p> Falla en " . $files['name'][$i] . ": " . $message . "</p><br>";
                continue;
            }
            else{
                echo "<p>datos de " . $filename . " validados correctamente</p><br>";
                continue;
            }
            // validate the file size
            $filesize = filesize($tmp);
            
            // echo 'filesize: ' . $filesize;
            // echo 'MaxSIZE: ' . MAX_SIZE;
            if ($filesize > MAX_SIZE) {
                echo "<p>fiesta</p>";
                // construct an error message
                $message = sprintf("The file %s is %s which is greater than the allowed size %s",
                    $filename,
                    format_filesize($filesize),
                    format_filesize(MAX_SIZE));

                $errors[$filesize] = $message;
                // echo "<b>$message</b>";
                continue;
            }
            // validate the file type
            // if (!in_array(get_mime_type($tmp), array_keys(ALLOWED_FILES))) {
            //     $errors[$filename] = "The file $filename is allowed to upload";
            // }
            
        }

        // move the files
        for($i = 0; $i < $file_count; $i++) {
            $filename = $files['name'][$i];
            $tmp = $files['tmp_name'][$i];
            // $mime_type = get_mime_type($tmp);

            // set the filename as the basename + extension
            //$uploaded_file = pathinfo($filename, PATHINFO_FILENAME) . '.' . ALLOWED_FILES[$mime_type];
            // new filepath
            $filepath = $dir . '/' . $filename;

            // move the file to the upload dir
            $success = move_uploaded_file($tmp, $filepath);
            if(!$success) {
                $errors[$filename] = "Hubo un error al subir $filename.";

            }
        }

        // $errors ?
        //     redirect_with_message(format_messages('The following errors occurred:',$errors), FLASH_ERROR) :
        //     redirect_with_message('All the files were uploaded successfully.', FLASH_SUCCESS);
        
        if(count($errors)>0){
                echo "<p>$errors[$filename]</p><br>";
        }
        else{
            echo "<p>Los archivos se subieron exitosamente</p><br>";
            echo "<button><a href='../pacientes.php'>volver a inicio</a></button><br>";
        }
    }



    ?>


</body>
</html>