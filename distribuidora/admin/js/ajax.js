var velocidad = 20;

var div_carrito = false;
var flyingDiv = false;
var currentProductDiv = false;

var carrito_x = false;
var carrito_y = false;

var slide_xFactor = false;
var slide_yFactor = false;

var diffX = false;
var diffY = false;

var posXactual = false;
var posYactual = false;

function carrito_tomaPosSuperior(inputObj) {		
  var returnValue = inputObj.offsetTop;
  while((inputObj = inputObj.offsetParent) != null){
  	if(inputObj.tagName!='HTML')returnValue += inputObj.offsetTop;
  }
  return returnValue;
}

function carrito_tomaPosIzquierda(inputObj)
{
  var returnValue = inputObj.offsetLeft;
  while((inputObj = inputObj.offsetParent) != null){
  	if(inputObj.tagName!='HTML')returnValue += inputObj.offsetLeft;
  }
  return returnValue;
}
	

function addToCarrito(idprod)
{

	if(!div_carrito)div_carrito = document.getElementById('carrito');
	if(!flyingDiv){
		flyingDiv = document.createElement('DIV');
		flyingDiv.style.position = 'absolute';
		document.body.appendChild(flyingDiv);
	}
	
	carrito_x = carrito_tomaPosIzquierda(div_carrito);
	carrito_y = carrito_tomaPosSuperior(div_carrito);

	currentProductDiv = document.getElementById('slidingProduct' + idprod);
	
	posXactual = carrito_tomaPosIzquierda(currentProductDiv);
	posYactual = carrito_tomaPosSuperior(currentProductDiv);
	
	diffX = carrito_x - posXactual;
	diffY = carrito_y - posYactual;
	


	var shoppingContentCopy = currentProductDiv.cloneNode(true);
	shoppingContentCopy.id='';
	flyingDiv.innerHTML = '';
	flyingDiv.style.left = posXactual + 'px';
	flyingDiv.style.top = posYactual + 'px';
	flyingDiv.appendChild(shoppingContentCopy);
	flyingDiv.style.display='block';
	flyingDiv.style.width = currentProductDiv.offsetWidth + 'px';
	flyToBasket(idprod);

}


function flyToBasket(idprod)
{
	var maxDiff = Math.max(Math.abs(diffX),Math.abs(diffY));
	var moveX = (diffX / maxDiff) * velocidad;
	var moveY = (diffY / maxDiff) * velocidad;	
	
	posXactual = posXactual + moveX;
	posYactual = posYactual + moveY;
	
	flyingDiv.style.left = Math.round(posXactual) + 'px';
	flyingDiv.style.top = Math.round(posYactual) + 'px';	
	
	
	if(moveX>0 && posXactual > carrito_x){
		flyingDiv.style.display='none';		
	}
	if(moveX<0 && posXactual < carrito_x){
		flyingDiv.style.display='none';		
	}
		
	if(flyingDiv.style.display=='block')setTimeout('flyToBasket("' + idprod + '")',10);
}

function nuevoAjax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
ajax=nuevoAjax();

//function addCarrito (id de producto, cantidad a sumar, precio producto, nro de fila para fly)
function addCarrito(id_prod, cant, precio, id_fila){

	var precarrito = document.getElementById("preciocarrito");
	var cantcarrito = document.getElementById("cantidadcarrito");
	precarrito.innerHTML = "";
	cantcarrito.innerHTML = "";	
	
	if(validaAddCarrito(id_prod, cant) == 1){
		return false;
	}	
		if(id_fila > 0) {
			addToCarrito(id_fila);
		}
		
		ajax.open("GET", "addCarrito.php?id_prod="+id_prod+"&cant="+cant+"&precio="+precio,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				
					datos = new Array();	
					datos = ajax.responseText.split("-")
					precarrito.innerHTML = datos[0];
					cantcarrito.innerHTML = datos[1];

			} else {
				//precarrito.innerHTML = "<font color=#ff0000><h5>actualizando</h5></font>";
			}
		}
		 ajax.send(null)
	
	
}