<?

class dbFunctions {
	/*
	var $server  	= "127.0.0.1"; 	// Server String
	var $usuario 	= "root";	// Usuario Db String
	var $password 	= "root"; 		// Pass Db
	var $db		= "cali"; 	// Db Elegida
	var $link 	= "";
	*/
	var $server  	= "localhost"; 	// Server String
	var $usuario 	= "toma930_distri"; 	// Usuario Db String
	var $password 	= "distribuidora"; 		// Pass Db
	var $db		= "toma930_distri"; 	// Db Elegida

	Function Conectarse(){ 
		if(!($link=mysql_connect($this->server,$this->usuario,$this->password))){ 
		echo $link=mysql_connect($this->server,$this->usuario,$this->password);
			echo "Se ha producido un error en la conexión a la Base de Datos.<br><br>Posiblemente el servidor de Base de Datos se encuentre caido en este momento. <br><br>Disculpe las molestias."; 
			exit(-1); 
		} 
		if(!(mysql_select_db($this->db,$link))){ 
			echo "Error cambiando a la base de datos."; 
			exit(-1); 
		}
		return($link); 
	}

	Function Query($strSql,$link){
		if (!($result=mysql_query($strSql) or die ("Se ha producido un error en la consulta. $link " . mysql_error() . ". <br><br>La consulta es: <br><br>" . $strSql ))) { 
			echo "Error ejecutando la consulta.." . $link . "=>" . $strSql; 
			exit(); 

		} 

		return $result; 

	}

	Function FetchArray($link,$Fila){
		$bnlEstado = false ;
		$Fila = '' ;
		if ( $Fila = @mysql_fetch_array($link) ) {
			$bnlEstado = true ;			
		}
		return ($bnlEstado); 
	}

	Function LimpiaToQuery($strCad){
		/*donde hay algo raro ej. ' le agregar \' */
		$result = addslashes($strCad);
		return $result; 
	}

	Function LimpiaToView($strCad){
		$result = stripslashes($strCad);
		return $result; 
	}

	Function SelCantidadFilas($cnt){
		$result = @mysql_num_rows($cnt);
		return $result; 
	}

	// Debo poner esto porque no todos los ODBC lo soportan 
	Function CantidadFilas($result){
		$result = mysql_num_rows($result);
		return $result; 
	}

	Function CantidadPaginas($result,$numArts){
		$numPags = round(($this->CantidadFilas()/$numArts),0);
		return ( $numPags );
	}

	Function LastIdInsertado($link){
		$result = @mysql_insert_id ($link);
		return $result; 
	}

	Function CerrarConeccion($cnt){
		$result = @mysql_close($cnt);
		return $result; 
	}
}
?>