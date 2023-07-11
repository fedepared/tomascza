<?php
class Consulta{

    function traerFila($consulta){
        //ACA SE CAMBIO
        $conn = pg_connect("host=localhost dbname=toma930_adpac user=toma930_user password=tomy_colorado2015");
        //$conn = pg_connect("host=127.0.0.1 port=5432 dbname=toma930_adpac user=postgres");
        $datos = pg_query($conn, $consulta);
        return(pg_fetch_array($datos, NULL, PGSQL_ASSOC));
        pg_free_result($datos);
        pg_close($conn);
    }

    function traer($consulta){
        $conn = pg_connect("host=localhost dbname=toma930_adpac user=toma930_user password=tomy_colorado2015");
        //$conn = pg_connect("host=127.0.0.1 port=5432 dbname=toma930_adpac user=postgres");
        return(pg_query($conn, $consulta));
        pg_close($conn);
    }

    function ejecutar($consulta){
        $conn = pg_connect("host=localhost dbname=toma930_adpac user=toma930_user password=tomy_colorado2015");
        //$conn = pg_connect("host=127.0.0.1 port=5432 dbname=toma930_adpac user=postgres");
        pg_query($conn, $consulta);
        pg_close($conn);
    }
}

class IdsDAO{
    function getNextId($tabla){
        $consulta = "UPDATE ids SET id = id+1 WHERE tabla = '$tabla'";
        $consulta2 = "SELECT id FROM ids WHERE tabla = '$tabla'";
        //ACA SE CAMBIO
        Consulta::ejecutar($consulta);
        $id = Consulta::traerFila($consulta2);
        // (new Consulta)->ejecutar($consulta);
        // $id = (new Consulta)->traerFila($consulta2);
        return($id["id"]);
    }
}
?>
