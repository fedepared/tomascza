//trae partidos de la BD
function grabapartido(){
	pongomensaje(0);
	idzona2 = document.getElementById('cmbzonas');
	idzona = idzona2.options[idzona2.selectedIndex].value;
	partido2 = document.getElementById('partido').value;
	//alert(idzona + "---"+ partido2)
	
	$.ajax ({
		type:'post',
		dataType: 'json',
		url: 'apartidox.php',
		data: {envio: 1, partido:partido2, idzona:idzona},
		success:
			function(json) {pongomensaje(json); limpiacampo('partido');
		}
	})
}

function editapartido(){
	pongomensaje(0);
	idzona2 = document.getElementById('cmbzonas');
	idzona = idzona2.options[idzona2.selectedIndex].value;
	partido2 = document.getElementById('partido').value;
	idpartido2 = document.getElementById('idpartido').value;
	$.ajax ({
		type:'post',
		dataType: 'json',
		url: 'epartidox.php',
		data: {envio: 1, partido:partido2, idzona:idzona, idpartido:idpartido2},
		success:
			function(json) {pongomensaje(json);
		}
	})
}

//seteo mensajes
function pongomensaje(idMensaje){
	switch (idMensaje) {
		case 0: //loading
			msg = "<div class='info'>Actualizando datos <img src='imagenes/loading.gif' align='absmiddle'></div>";
			break;
		case 1: //grabado
			msg = "<div class='exito'>La operación se realizó con éxito. El registro fue grabado correctamente.</div>";
			break;
		case 2: //existe
			msg = "<div class='alerta'>El registro ingresado ya existe. Ingrese uno diferente.</div>";
			break;
		case 3: //modificado
			msg = "<div class='exito'>La operación se realizó con éxito. El registro fue modificado correctamente.</div>";
			break;
		case 4: //borrado
			msg = "<div class='exito'>La operación se realizó con éxito. El registro fue eliminado correctamente.</div>";
			break;
		case 5: //borrado
			msg = "<div class='error'>Ha habido un problema en el servidor y la operación no pudo realizarse.</div>";
			break;
		case 6: //borrado
			msg = "<div class='error'>La operación no puede realizarse porque hay elementos asignados.</div>";
			break;
		default:
			msg = ""
			//msg = "<div class='mensajeOK'>"+idMensaje+"</div>";
	}
	if(msg != "") {
		$("#mensaje").html(msg);
	}
}
//seteo mensajes
function pongomensajeJS(msg){
	
	if(msg != "") {
		$("#mensaje").html("<div class='error'>" + msg + "</div>");
	}
}
//muestro preloading en carga de combos
function cargando1(mostrar) {
	if(mostrar) {
		document.getElementById("cargando1").className="visible";
	} else {
		document.getElementById("cargando1").className="oculto";
	}
}

//limpio combos antes de cargar datos
function limpiacombo(combo) {
	while (combo.length > 0){
		combo.remove(combo.length-1);
	}
}

function llenarcombo(json, combopartidos){
	cargando1(false);
	combopartidos.options[0] = new Option("Seleccione un partido","0");
	//si vinieron resultados del php
	if(json != null){
		for(i=1; i<json.length+1;i++){
			combopartidos.options[i] = new Option(json[i-1].partido,json[i-1].id);
		}
	}
}

//trae partidos de la BD
function traigopartidos(cmbzonas,cmbpartidos){
	cargando1(true);
	combopartidos = document.getElementById(cmbpartidos);
	limpiacombo(combopartidos);
	if(cmbzonas.options[cmbzonas.selectedIndex].value != ''){
		cmbzonas.disabled = true;
		combopartidos.disabled = true;
		$.ajax ({
			type:'get',
			dataType: 'json',
			url: 'alocalidadx.php',
			data: {idzona: cmbzonas.options[cmbzonas.selectedIndex].value, accion:'traerpartidos'},
			success:
				function(json) {llenarcombo(json, combopartidos);
				cmbzonas.disabled = false;
				combopartidos.disabled = false;
			}
		})
	}
}
function limpiacampo(campo){
	idcampo = "#"+campo;
	$(idcampo).val("");
	$(idcampo).focus();
}
//trae partidos de la BD
function grabalocalidad(){
	pongomensaje(0);
	idpartido2 = document.getElementById('cmbpartidos');
	idpartido = idpartido2.options[idpartido2.selectedIndex].value;
	localidad2 = document.getElementById('localidad').value;
	$.ajax ({
		type:'post',
		dataType: 'json',
		url: 'alocalidadx.php',
		data: {envio: 1, localidad:localidad2, idpartido:idpartido, accion:'grabalocalidad'},
		success:
			function(json) {pongomensaje(json); limpiacampo('localidad')
		}
	})
}

function editalocalidad(){
	pongomensaje(0);
	idpartido2 = document.getElementById('cmbpartidos');
	idpartido = idpartido2.options[idpartido2.selectedIndex].value;
	localidad2 = document.getElementById('localidad').value;
	idlocalidad2 = document.getElementById('idlocalidad').value;
	$.ajax ({
		type:'post',
		dataType: 'json',
		url: 'elocalidadx.php',
		data: {envio: 1, localidad:localidad2, idpartido:idpartido, idlocalidad:idlocalidad2, accion:'grabalocalidad'},
		success:
			function(json) {pongomensaje(json);
		}
	})
}


/********************************************************* PARA PRODUCTOS **********************************************************************/

//trae Modelos de la BD para el alta de productos
function traigomodelo(cmbmarca,cmbmodelo){
	//cargandoProp(true,"cargando1");
	combomodelo = document.getElementById(cmbmodelo);
	limpiaCombomodelo(document.getElementById('cmbmodelo'));
	
	if(cmbmarca.options[cmbmarca.selectedIndex].value != ''){
		cmbmarca.disabled = true;
		cmbmarca.disabled = true;
		$.ajax ({
			type:'get',
			dataType: 'json',
			url: 'aprodx.php',
			data: {idmarca: cmbmarca.options[cmbmarca.selectedIndex].value, accion:'traermodelo'},
			success:
				function(json) {llenarCombomodelo(json, combomodelo);
				cmbmarca.disabled = false;
				if(json != null) {
					cmbmodelo.disabled = false;
				}
			}
		})
	}
}
//llena combo Modelos en alta productos
function llenarCombomodelo(json, combomodelo){
	//cargandoProp(false,"cargando1");
	combomodelo.options[0] = new Option("Seleccione un modelo","0");
	//si vinieron resultados del php
	if(json != null){
		//sumo 1 y resto 1 al indice de json por la primer posicion del combo
		for(i=1; i<json.length+1;i++){
			combomodelo.options[i] = new Option(json[i-1].modelo,json[i-1].id);
		}
	}
}

//limpio combos antes de cargar datos en propiedades
function limpiaCombomodelo(combo) {
	while (combo.length > 0){
		combo.remove(combo.length-1);
	}
	combo.options[0] = new Option("-------------","0");
}


//trae subcategorias de la BD para el alta de productos
function traigoSubcategorias(cmbcategorias,cmbsubcate){
	//cargandoProp(true,"cargando1");
	combosubcategorias = document.getElementById(cmbsubcate);
	limpiaComboSubcate(document.getElementById('cmbsubcate'));
	
	if(cmbcategorias.options[cmbcategorias.selectedIndex].value != ''){
		cmbcategorias.disabled = true;
		cmbsubcate.disabled = true;
		$.ajax ({
			type:'get',
			dataType: 'json',
			url: 'aprodx.php',
			data: {idcate: cmbcategorias.options[cmbcategorias.selectedIndex].value, accion:'traersubcategorias'},
			success:
				function(json) {llenarComboSubcategorias(json, combosubcategorias);
				cmbcategorias.disabled = false;
				if(json != null) {
					cmbsubcate.disabled = false;
				}
			}
		})
	}
}

//llena combo subcategorias en alta productos
function llenarComboSubcategorias(json, combosubcate){
	//cargandoProp(false,"cargando1");
	combosubcate.options[0] = new Option("Seleccione una subcategoria","0");
	//si vinieron resultados del php
	if(json != null){
		//sumo 1 y resto 1 al indice de json por la primer posicion del combo
		for(i=1; i<json.length+1;i++){
			combosubcate.options[i] = new Option(json[i-1].subcategoria,json[i-1].id);
		}
	}
}

//trae subcategorias de la BD para el alta de productos
function traigoSubcategorias2(cmbcategorias,cmbsubcate){
	//cargandoProp(true,"cargando1");
	combosubcategorias = document.getElementById(cmbsubcate);
	limpiaComboSubcate(document.getElementById('cmbsubcate2'));
	
	if(cmbcategorias.options[cmbcategorias.selectedIndex].value != ''){
		cmbcategorias.disabled = true;
		cmbsubcate.disabled = true;
		$.ajax ({
			type:'get',
			dataType: 'json',
			url: 'aprodx.php',
			data: {idcate: cmbcategorias.options[cmbcategorias.selectedIndex].value, accion:'traersubcategorias2'},
			success:
				function(json) {llenarComboSubcategorias(json, combosubcategorias);
				cmbcategorias.disabled = false;
				if(json != null) {
					cmbsubcate.disabled = false;
				}
			}
		})
	}
}

//llena combo subcategorias en alta productos
function llenarComboSubcategorias2(json, combosubcate){
	//cargandoProp(false,"cargando1");
	combosubcate.options[0] = new Option("Seleccione una subcategoria","0");
	//si vinieron resultados del php
	if(json != null){
		//sumo 1 y resto 1 al indice de json por la primer posicion del combo
		for(i=1; i<json.length+1;i++){
			combosubcate.options[i] = new Option(json[i-1].subcategoria,json[i-1].id);
		}
	}
}
//muestro preloading en carga de combos
function cargandoProp(mostrar,id) {
	if(mostrar) {
		document.getElementById(id).className="visible";
	} else {
		document.getElementById(id).className="oculto";
	}
}

//limpio combos antes de cargar datos en propiedades
function limpiaComboSubcate(combo) {
	while (combo.length > 0){
		combo.remove(combo.length-1);
	}
	combo.options[0] = new Option("-------------","0");
}



function grabaPropiedad(){
	pongomensaje(0);
	window.top.scroll(0,0)
	
	idzona = $("#cmbzonas").val();
	idpartido = $("#cmbpartidos").val();
	idlocalidad = $("#cmblocalidad").val();
	codigo2 = $("#codigo").val();
	tipoinmueble = $("#cmbtipoinmueble").val();
	operacion = $("#cmboperacion").val();
	precio2 = $("#precio").val();
	moneda = $("#cmbmoneda").val();
	titulo2 = $("#titulo").val();
	descripcion2 = $("#descripcion").val();
	ambientes = $("#cmbambientes").val();
	habitaciones = $("#cmbhabitaciones").val();
	banios = $("#cmbbanios").val();
	balcon2 = "--";
	if ($("#balcon").attr("checked")){balcon2 = "SI";}
	telefono2 = "--";
	if ($("#telefono").attr("checked")){telefono2 = "SI";}
	expensas2 = $("#expensas").val();
	if(expensas2 == "") {expensas2="--";}
	profesional2 = "--";
	if ($("#profesional").attr("checked")){profesional2 = "SI";}
	metros2 = "--";
	if($("#metros").val() != "") {metros2 = $("#metros").val()};
	metroscub2 = "--";
	if($("#metroscub").val() != "") {metroscub2 = $("#metroscub").val()};
	orientacion2 = $("#orientacion").val();
	ubicacion2 = $("#ubicacion").val();
	servicios = $("#otros").val();
	publicar = $("#publicar").val();
	publicar = 0;
	if ($("#publicar").attr("checked")){publicar = 1;}
	destacada = 0;
	if ($("#destacada").attr("checked")){destacada = 1;}

	$.ajax ({
		type:'post',
		dataType: 'json',
		url: 'apropiedadx.php',
		data: {envio: 1, accion:'grabapropiedad', idzona:idzona, idpartido:idpartido, idlocalidad:idlocalidad, codigo:codigo2, 
				tipoinmueble:tipoinmueble, tipooperacion:operacion, precio:precio2, moneda:moneda, titulo:titulo2, descripcion:descripcion2, ambientes:ambientes, 
				habitaciones:habitaciones, banios:banios, balcon:balcon2, telefono:telefono2, expensas:expensas2, profesional:profesional2,
				metros:metros2, orientacion:orientacion2, ubicacion:ubicacion2, servicios:servicios, publicar:publicar, metroscub:metroscub2, destacada:destacada },
		success:
			function(json) {pongomensaje(json); $("#form0").reset();
		}
	})

	

/*
	salida = "";
	salida+= "idzona" + idzona + "\n";
	salida+= "idpartido" + idpartido + "\n";
	salida+= "idlocalidad" + idlocalidad + "\n";
	salida+= "codigo2" + codigo2 + "\n"
	salida+= "tipoinmueble" + tipoinmueble + "\n"
	salida+= "operacion" + operacion + "\n"
	salida+= "titulo2" + titulo2 + "\n"
	salida+= "descripcion2" + descripcion2 + "\n"
	salida+= "ambientes" + ambientes + "\n"
	salida+= "habitaciones" + habitaciones + "\n"
	salida+= "banios" + banios + "\n"
	salida+= "balcon2" + balcon2 + "\n"
	salida+= "telefono2" + telefono2 + "\n"
	salida+= "expensas2" + expensas2 + "\n"
	salida+= "profesional2" + profesional2 + "\n"
	salida+= "metros2" + metros2 + "\n"
	salida+= "orientacion2" + orientacion2 + "\n"
	salida+= "ubicacion2" + ubicacion2 + "\n"
	salida+= "otros2" + servicios + "\n"
	
	alert(salida)

	*/


}

jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}

function cambiodesta(idelem,elem){
	document.getElementById("desta"+idelem).src="imagenes/loading.gif";
	$.ajax ({
			type:'get',
			dataType: 'json',
			url: 'cambiopubli.php',
			data: {idelem: idelem, accion:'cambiadesta',elem:elem},
			success:
				function(json) {cambiaIconoDesta(json);}
		})
}
function cambiaIconoDesta(json) {
	if(json[0].icono == "si") {
		$("#desta"+json[0].idelem).removeClass("fa fa-star");
		$("#desta"+json[0].idelem).addClass("fa fa-star");
		$("#desta"+json[0].idelem).css({ color: "#fc0" });
	}else{
		$("#desta"+json[0].idelem).removeClass("fa fa-star");
		$("#desta"+json[0].idelem).addClass("fa fa-star");
		$("#desta"+json[0].idelem).css({ color: "#ddd" });
	}
//	document.getElementById("publi"+json[0].idelem).src="imagenes/" + json[0].icono;
}


function cambiooferta(idelem,elem){
	document.getElementById("oferta"+idelem).src="imagenes/loading.gif";
	$.ajax ({
			type:'get',
			dataType: 'json',
			url: 'cambiopubli.php',
			data: {idelem: idelem, accion:'cambiaoferta',elem:elem},
			success:
				function(json) {cambiaIconoOferta(json);}
		})
}

function cambiaIconoOferta(json) {
	if(json[0].icono == "si") {
		$("#oferta"+json[0].idelem).removeClass("fa fa-bolt");
		$("#oferta"+json[0].idelem).addClass("fa fa-bolt");
		$("#oferta"+json[0].idelem).css({ color: "#f90" });
	}else{
		$("#oferta"+json[0].idelem).removeClass("fa fa-bolt");
		$("#oferta"+json[0].idelem).addClass("fa fa-bolt");
		$("#oferta"+json[0].idelem).css({ color: "#ddd" });
	}
//	document.getElementById("publi"+json[0].idelem).src="imagenes/" + json[0].icono;
}



function cambiopubli(idelem, elem){
	document.getElementById("publi"+idelem).src="imagenes/loading.gif";
	$.ajax ({
	
			type:'get',
			dataType: 'json',
			url: 'cambiopubli.php',
			data: {idelem: idelem, accion: 'cambiapubli', elem:elem},
			
			success:
				function(json) {cambiaIconoPubli(json);}
		})
}
function cambiaIconoPubli(json) {
	if(json[0].icono == "si") {
		$("#publi"+json[0].idelem).removeClass("fa fa-thumbs-down");
		$("#publi"+json[0].idelem).addClass("fa fa-thumbs-up");
		$("#publi"+json[0].idelem).css({ color: "green" });
	}else{
		$("#publi"+json[0].idelem).removeClass("fa fa-thumbs-up");
		$("#publi"+json[0].idelem).addClass("fa fa-thumbs-down");
		$("#publi"+json[0].idelem).css({ color: "red" });
	}
//	document.getElementById("publi"+json[0].idelem).src="imagenes/" + json[0].icono;
}


function editaPropiedad(){
	pongomensaje(0);
	window.top.scroll(0,0)
	idprop = $("#idpropiedad").val();
	idzona = $("#cmbzonas").val();
	idpartido = $("#cmbpartidos").val();
	idlocalidad = $("#cmblocalidad").val();
	codigo2 = $("#codigo").val();
	tipoinmueble = $("#cmbtipoinmueble").val();
	operacion = $("#cmboperacion").val();
	precio2 = $("#precio").val();
	moneda = $("#cmbmoneda").val();
	titulo2 = $("#titulo").val();
	descripcion2 = $("#descripcion").val();
	ambientes = $("#cmbambientes").val();
	habitaciones = $("#cmbhabitaciones").val();
	banios = $("#cmbbanios").val();
	balcon2 = "--";
	if ($("#balcon").attr("checked")){balcon2 = "SI";}
	telefono2 = "--";
	if ($("#telefono").attr("checked")){telefono2 = "SI";}
	expensas2 = $("#expensas").val();
	if(expensas2 == "") {expensas2="--";}
	profesional2 = "--";
	if ($("#profesional").attr("checked")){profesional2 = "SI";}
	metros2 = "--";
	if($("#metros").val() != "") {metros2 = $("#metros").val()};
	metroscub2 = "--";
	if($("#metroscub").val() != "") {metroscub2 = $("#metroscub").val()};
	orientacion2 = $("#orientacion").val();
	ubicacion2 = $("#ubicacion").val();
	servicios = $("#otros").val();
	publicar = $("#publicar").val();
	publicar = 0;
	if ($("#publicar").attr("checked")){publicar = 1;}

	$.ajax ({
		type:'post',
		dataType: 'json',
		url: 'epropiedadx.php',
		data: {envio: 1, accion:'editapropiedad', idprop:idprop, idzona:idzona, idpartido:idpartido, idlocalidad:idlocalidad, codigo:codigo2, 
				tipoinmueble:tipoinmueble, tipooperacion:operacion, precio:precio2, moneda:moneda,titulo:titulo2, descripcion:descripcion2, ambientes:ambientes, 
				habitaciones:habitaciones, banios:banios, balcon:balcon2, telefono:telefono2, expensas:expensas2, profesional:profesional2,
				metros:metros2, orientacion:orientacion2, ubicacion:ubicacion2, servicios:servicios, publicar:publicar, metroscub:metroscub2 },
		success:
			function(json) {pongomensaje(json); 
		}
	})

}

function cargofotos(id_prod){
	window.open("fotos.php?id_prod="+id_prod,"ventana","width=540, height=500, scrollbars=yes")
}
function cargofotosfront(id_prod){
	window.open("fotosFront.php?id_prod="+id_prod,"ventana","width=540, height=500, scrollbars=yes")
}


function cargopdf(id_prod){
	window.open("pdf.php?id_prod="+id_prod,"ventana","width=540, height=500, scrollbars=yes")
}

function confirmaborradoprop(idprop,pagina){
	if(confirm("Esta seguro de eliminar la propiedad?")){
		document.location="bpropiedad.php?idprop="+idprop+"&_pagi_pg="+pagina;
	}
}
function confirmaborradopart(idpartido,pagina,palabra,cmbzonas){
	if(confirm("Esta seguro de eliminar el partido?")){
		document.location="bpartido.php?idpartido="+idpartido+"&_pagi_pg="+pagina+"&palabra="+palabra+"&cmbzonas="+cmbzonas;
	}
}
function confirmaborradoloc(idlocalidad,pagina){
	if(confirm("Esta seguro de eliminar la localidad?")){
		document.location="blocalidad.php?idlocalidad="+idlocalidad+"&_pagi_pg="+pagina;
	}
}