<?
require_once("include/includes.php");
require_once("funcadmin.php");


switch($HttpVars->TraerGet('elem')) {
	case 'nota':
		$idnota =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_notas where id_nota = " . $idnota;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_notas set publicado = " . $publicar . " where id_nota = " . $idnota;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idnota, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'banner':
		$id_banner =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_banners where id_banner = " . $id_banner;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_banners set publicado = " . $publicar . " where id_banner = " . $id_banner;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_banner, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
    
  case 'tarjeta':
		$id_tarjeta =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_tarjetas where id_tarjeta = " . $id_tarjeta;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_tarjetas set publicado = " . $publicar . " where id_tarjeta = " . $id_tarjeta;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_tarjeta, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'video':
		$id_video =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_videos where id_video = " . $id_video;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_videos set publicado = " . $publicar . " where id_video = " . $id_video;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_video, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'glosario':
		$idglosario =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_glosario where id_glosario = " . $idglosario;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_glosario set publicado = " . $publicar . " where id_glosario = " . $idglosario;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idglosario, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'curiosidades':
		$idcuriosidades =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_curiosidades where id_curiosidades = " . $idcuriosidades;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_curiosidades set publicado = " . $publicar . " where id_curiosidades = " . $idcuriosidades;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idcuriosidades, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'aparatologias':
		$id_aparatologia =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_aparatologia where id_aparatologia = " . $id_aparatologia;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_aparatologia set publicado = " . $publicar . " where id_aparatologia = " . $id_aparatologia;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_aparatologia, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
			case 'depilacion':
		$id_depilacion =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_depilacion where id_depilacion = " . $id_depilacion;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_depilacion set publicado = " . $publicar . " where id_depilacion = " . $id_depilacion;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_depilacion, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
		case 'promociones':
		$id_promociones =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_promociones where id_promociones = " . $id_promociones;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_promociones set publicado = " . $publicar . " where id_promociones = " . $id_promociones;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_promociones, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
		case 'galeria':
		$id_galeria =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_galeria where id_galeria = " . $id_galeria;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_galeria set publicado = " . $publicar . " where id_galeria = " . $id_galeria;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $id_galeria, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'categoria':
		$idcate =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_categorias where id_cate = " . $idcate;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_categorias set publicado = " . $publicar . " where id_cate = " . $idcate;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idcate, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
    
  case 'ubicacion':
		$idcate =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_ubicacion where id_ubi = " . $idcate;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_ubicacion set publicado = " . $publicar . " where id_ubi = " . $idcate;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idcate, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'subcategoria':
		$idsubcate =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_subcategorias where id_subcate = " . $idsubcate;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_subcategorias set publicado = " . $publicar . " where id_subcate = " . $idsubcate;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idsubcate, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'color':
		$idcolor =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_colores where id_color = " . $idcolor;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_colores set publicado = " . $publicar . " where id_color = " . $idcolor;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idcolor, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'modelo':
		$idmodelo =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_modelos where id_modelo = " . $idmodelo;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_modelos set publicado = " . $publicar . " where id_modelo = " . $idmodelo;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idmodelo, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'general':
		$idgeneral =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_general where id_general = " . $idgeneral;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_general set publicado = " . $publicar . " where id_general = " . $idgeneral;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idgeneral, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;	
	case 'exterior':
		$idexterior =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_exterior where id_exterior = " . $idexterior;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_exterior set publicado = " . $publicar . " where id_exterior = " . $idexterior;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idexterior, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;		
		case 'confort':
		$idconfort =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_confort where id_confort = " . $idconfort;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_confort set publicado = " . $publicar . " where id_confort = " . $idconfort;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idconfort, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;		
		case 'otros':
		$idotros =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_otros where id_otros = " . $idotros;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_otros set publicado = " . $publicar . " where id_otros = " . $idotros;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idotros, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;		
		case 'marca':
		$idmarca =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_marca where id_marca = " . $idmarca;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_marca set publicado = " . $publicar . " where id_marca = " . $idmarca;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idmarca, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'talle':
		$idtalle =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_talles where id_talle = " . $idtalle;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);
			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
			}

			$sql = "update tbl_talles set publicado = " . $publicar . " where id_talle = " . $idtalle;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idtalle, 'icono' => $icono );
			echo json_encode($arraydatos);
		}
		break;
	case 'producto':
		$idprod =  $HttpVars->TraerGet('idelem');
		if ($HttpVars->TraerGet('accion') == 'cambiapubli') {
			$sql = "select publicado from tbl_productos where id_prod = " . $idprod;
			$result = $db->Query($sql,$connection);
			$myrow = mysql_fetch_array($result, MYSQL_BOTH);

			if ($myrow['publicado'] == 1) {
				$publicar = 0;
				$icono = "no";
				//$icono = "no";
			} else {
				$publicar = 1;
				$icono = "si";
				//$icono = "si";
			}
			

			$sql = "update tbl_productos set publicado = " . $publicar . " where id_prod = " . $idprod;
			$result = $db->Query($sql,$connection);

			$arraydatos[] = array ('idelem' => $idprod, 'icono' => $icono );
			echo json_encode($arraydatos);
		} else {
			if ($HttpVars->TraerGet('accion') == 'cambiadesta') {
				$sql = "select destacado from tbl_productos where id_prod = " . $idprod;
				$result = $db->Query($sql,$connection);
				$myrow = mysql_fetch_array($result, MYSQL_BOTH);

				if ($myrow['destacado'] == 1) {
					$destacar = 0;
					$icono = "no";
				} else {
					$destacar = 1;
					$icono = "si";
				}

				$sql = "update tbl_productos set destacado = " . $destacar . " where id_prod = " . $idprod;
				$result = $db->Query($sql,$connection);

				$arraydatos[] = array ('idelem' => $idprod, 'icono' => $icono );
				echo json_encode($arraydatos);
			} else {
				if ($HttpVars->TraerGet('accion') == 'cambiaoferta') {
					$sql = "select oferta from tbl_productos where id_prod = " . $idprod;
					$result = $db->Query($sql,$connection);
					$myrow = mysql_fetch_array($result, MYSQL_BOTH);

					if ($myrow['oferta'] == 1) {
						$oferta = 0;
						$icono = "no";
					} else {
						$oferta = 1;
						$icono = "si";
					}

					$sql = "update tbl_productos set oferta = " . $oferta . " where id_prod = " . $idprod;
					$result = $db->Query($sql,$connection);

					$arraydatos[] = array ('idelem' => $idprod, 'icono' => $icono );
					echo json_encode($arraydatos);
				}
			}
		}
		break;
}




?>