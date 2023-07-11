<?php
session_start();
include_once 'admin/class/conexion.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
		<meta name="viewport" content="width=device-width" />
		<title>Cambios | MALDITO ZAPATO</title>
	
	<!-- Font CSS Link -->
	    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<!-- Font CSS Link -->	
		
	<!-- Start CSS Link -->
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/main.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/custom_responsive.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/menu.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/supermenu.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/bounce_slider.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/jcarousel.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" media="screen" />	
		<link rel="stylesheet" href="css/grid-list.css" type="text/css" />
		<link rel="stylesheet" href="css/accrodin.css" type="text/css"/>
		<link rel="stylesheet" href="css/ui.css" type="text/css"/>
		<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css"/>
	<!-- End CSS Link -->
	
	</head>
	<body>
		<div class="header">
			<div class="container main">
					
			  <div class="row">
					<div class="header_top">
						<div class="span4" style="width:180px;">
							<a href="index.php">
								<div class="logo"></div>
							</a>
						</div>
                        
	
						<div class="account_login span7">
						
						  <ul class="account_info">
								<li><a href="mi_cuenta.php"><img alt="" src="images/my_account.png"> MI CUENTA</a></li>
							
								<li><a href="carrito.php"><img alt="" src="images/shopping_cart.png"> MI CARRITO DE COMPRAS</a></li>
								<li><a href="registro.php"><img alt="" src="images/checkout.png"> REGISTRARSE</a></li>
								<?php if(isset($_SESSION["k_userId"]))
								{?>
								<li><a href="login.php"><img alt="" src="images/log_out.png"> USUARIO: </a><span style="font-size:11px; color:#F36; margin-left:20px;"><?php echo $_SESSION["k_username"] ?></span></li>
								<?php 
								}
								else 
								{?>
                                <li><a href="login.php"><img alt="" src="images/log_out.png"> LOGIN</a></li>
                                
                                <?php }?>
							</ul>
						
						</div>
					
					  <div class="call_info span4" style="width:52%; margin-top:15px;">
		<div style="float:left;width:140px; margin-left:20px;" >				<div style="float:left;" >	
                        <img src="images/icon_envio.png" width="58" height="46" ></div>
                  <div style="float:left; margin-right:10px; margin-left:10px;" >      <strong>Envíos a todo<br>
el País</strong></div> </div> 

<div style="float:left;width:140px; margin-left:20px;" >	
			<div style="float:left;" >	<img src="images/icon_tarjetas.png" width="44" height="41" ></div>
                  <div style="float:left; margin-left:10px;margin-right:10px;" >      <strong>Todos las tarjetas</strong><br>
Sin interes</div> </div> 
<div style="float:left;width:140px;  margin-left:20px;" >	
	<div style="float:left;" >	<img src="images/icon_sobre.png"  ></div>
                  <div style="float:left; margin-left:6px;" >      <strong>Contactate</strong><br>
<span style="font-size:12px;">info@malditozapato.com</span></div> </div> 
					
							
					  </div>
						<div class="cart_info span3">
								<div class="cart_data">Carrito de Compras - $ 
							<?php
								if (isset($_SESSION["COSTOTOTAL"]))
									echo $_SESSION["COSTOTOTAL"];
								else 
									Echo "00.0"
									 
							?></div>
							<button class="cart_btn btn btn-navbar" data-toggle="collapse" data-target=".item_cart_wrap"><img alt="" src="images/shopping_cart_btn_img.png"></button>
							<div class="item_cart_content">
								<div class="item_cart_wrap collapse">
									<div class="item_cart">
										<p class="item_cart_products">No Products</p>
										<p class="item_cart_info">Compra - $<?php
								if (isset($_SESSION["COSTOTOTAL"]))
									echo $_SESSION["COSTOTOTAL"];
								else 
									Echo "00.0"
									 
							?></p>
										<p class="item_cart_info">Total - $<?php
								if (isset($_SESSION["COSTOTOTAL"]))
									echo $_SESSION["COSTOTOTAL"];
								else 
									Echo "00.0"
									 
							?></p>
										<button class="carrito.php" style="margin-right:15px;">Ir a carrito</button>
										 <button class="index.php">Comprar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
			
		<div class="navigation navbar">
			
			<div class="row">
				<div class="navbar">
					<div class="container main">
	 
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>     
                              
				      <div class="nav-collapse collapse">
					      <!-- .nav, .navbar-search, .navbar-form, etc -->
			<ul class="sf-menu">
								<li class="deeper parent current"><a href="index.php">Home</a></li>
								<li >
									<a onclick="location.href='productos.php'" style="cursor:hand;" class="dropdown-toggle" data-toggle="dropdown">
										Zapatos
									</a>
									<ul class="dropdown-menu">
										<?php 
				                        $link1=Conectarse();
									    $sql1= " select * from menu_categorias  where padre=48 ";
									    $consulta1= mysql_query($sql1,$link1);
									    if ($consulta1)
									     {
									    	while($row1= mysql_fetch_assoc($consulta1)) 
									    	{
				                        ?>
				                        <li><a href="productos.php?ic=<?php echo $row1["id"]?>"><?php echo $row1["categoria"]?></a></li>
										<?php }}?>
										
										
									</ul>
								</li>
								<li class="deeper parent dropdown">
									<a onclick="location.href='carteras.php'" class="dropdown-toggle" data-toggle="dropdown">
										Carteras
									</a>
									<ul class="dropdown-menu">
										<?php 
				                        $link1=Conectarse();
									    $sql1= " select * from menu_categorias  where padre=49 ";
									    $consulta1= mysql_query($sql1,$link1);
									    if ($consulta1)
									     {
									    	while($row1= mysql_fetch_assoc($consulta1)) 
									    	{
				                        ?>
				                        <li><a href="carteras.php?ic=<?php echo $row1["id"]?>"><?php echo $row1["categoria"]?></a></li>
										<?php }}?>
									</ul>
								</li>
			
								<li><a onclick="location.href='liquidaciones.php'">Liquidaciones</a>
									<ul class="dropdown-menu">
										<?php 
				                        $link1=Conectarse();
									    $sql1= " select * from menu_categorias  where padre=50 ";
									    $consulta1= mysql_query($sql1,$link1);
									    if ($consulta1)
									     {
									    	while($row1= mysql_fetch_assoc($consulta1)) 
									    	{
				                        ?>
				                        <li><a href="liquidaciones.php?ic=<?php echo $row1["id"]?>"><?php echo $row1["categoria"]?></a></li>
										<?php }}?>
									</ul>
								</li>
								<li><a href="contacto.php">Contacto</a></li>	
								
							</ul>
				        
					      <div class="search">
					        <input type="search" name="search" placeholder="buscar">
					        <button class="search_btn"> <img alt="" src="images/icon_search.png"> </button>
				        </div>
				      </div>

				      <!-- Be sure to leave the brand out there if you want it shown -->
	 
					<!-- Everything you want hidden at 940px or less, place within here --></div>
				</div>
				
			</div>
			
		</div>
	
		<div class="breadcrumbs">
			<div class="container main">
				<ul>
					<li><a href="#">Home</a></li><li>&#47;</li><li class="active"><a href="#">sobre MALDITO ZAPATO</a></li>
				</ul>
			</div>	
		</div>	
	
		<div class="main_content">
			<div class="container main">
				<div class="row">
					<div class="span3 widget-area">
					<div class="left-sidebar">
						<div class="widget-info">
							<div class="widget-title">Sobre MALDITO ZAPATO</div>
							<div class="line"></div>
							<div class="widget-content">
								<ul>
									<li><a href="sobre_nosotros.php" >¿Qué es MALDITO ZAPATO?</a></li>
									<li><a href="como_registro.php" >¿Cómo me registro en el sitio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MALDITO ZAPATO?</a></li>
									
								  <li><a href="como_comprar.php" >¿Cómo comprar en MALDITO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ZAPATO? </a></li>
									<li><a href="disponibilidad_producto.php" >Disponibilidad de productos.</a></li>
									<li><a href="entrega.php" >Entrega</a></li>
                                    <li><a href="formas_de_pago.php">Formas de Pago</a></li>
                                    
                                                <li><a href="cambios.php" style="color:#db0080;">Cambios</a></li>
								</ul>
							</div>
                            
                            <div class="line" style="margin-bottom:70px;"></div>
						</div>
						
					</div>
					
				</div>
					<div class="span9 product_details">					
						<div class="row">
							<div class="span4" style="width:100%;">
								<div class="porduct_info" >
									
									<div class="porduct_info_details" >
										<div class="row">
											<div class="product_single_title span2">
												Cambios
											</div>
											<div class="product_single_info span4" style="width:100%;">
											  <p style="color:#333;">

Los cambios gratuitos solo una vez y por el mismo articulo y color, solo se puede cambiar por Número,(si se solicita más de un cmabio, va a tener un costo de $50, por cada cambio).Si tenés alguna duda acerca de los productos, o nuestro servicio, podés consultar a nuestro equipo enviando un mail a <a href="mailto:info@malditozapato.com." target="_blank">info@malditozapato.com.</a> En Maldito Zapato comprás fácil, y rápido, con productos de calidad, cómodamente desde tu casa.</p>
												
											</div>
										</div>	
										<div class="row">

										
										</div>
									</div>
			
									
								</div>	
							</div>
							<div class="row">
								<div class="span5">
								
									
						
								</div>
							</div>
						</div>
						<div class="row"></div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="contact_info" style="background-color:#db0080;">
			<div class="container main">
				<ul class="row">
					<li class="follow-us span4">
						<div class="follow-social" style="color:#FFF;">Seguinos en:</div>
						<div class="social-icon">
							<ul>
								<li class="fb">
									<a href="#"><img alt="" src="images/social/facebook.png"></a>
								</li>
								<li class="tw">
									<a href="#"><img alt="" src="images/social/twitter.png"></a>
								</li>
								<li class="rss">
									<a href="#"><img alt="" src="images/social/rss.png"></a>
								</li>
								<li class="yt">
									<a href="#"><img alt="" src="images/social/youtube.png"></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="span4">
					<div class="free-shipping">
					  <div class="free-shipping-wrap" >
							<div class="free-shipping-image">
								<img src="images/icon_envio_blanco.png" alt="" width="58" height="46">
							</div>
							<div class="free-shipping-info">
								<div id="free-shipping-info-title" style="color:#FFF;">
									Envíos a todo
el País
								</div>
								<div id="free-shipping-info" style="color:#FFF;">
Consulte costos!
							  </div>
							</div>
						</div>	
					</div>	
					</li>
					<li class="contact-no span4">
						<div class="contact-no-wrap">
							<div class="contact-no-image">
								<img src="images/icon_tarjetas_blancas_pie.png" alt="">
							</div>
							<div class="contact-no-info">
						<div id="free-shipping-info-title" style="color:#FFF;">
Todas las Tarjetas
							  </div>
						
		<div id="free-shipping-info" style="color:#FFF;">
Sin Interes
							  </div>						</div>
					  </div>
					</li>
				</ul>	
			</div>

		</div>
		
		<div class="footer" >
			<div class="footer-top">
				<div class="container main" id="footer-top">
					<br/>
					<div class="row">
						<div class="span3 footer-col">
							<div class="widget-info">
								<div class="widget-title">Información</div>
								<div class="line"></div>
								<div class="widget-content">
									<ul>
										<li><a href="sobre_nosotros.php">Sobre Nosotros</a></li>
										<li><a href="formas_de_pago.php">Forma de Pago</a></li>
										<li><a href="entrega.php">Formas de Envio</a></li>
										
										<li><a href="contact.html">Contacto</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="span3 footer-col">
							<div class="widget-info">
								<div class="widget-title">Sobre La Compra</div>
								<div class="line"></div>
								<div class="widget-content">
									<ul>
										<li><a href="como_comprar.php">Como Comprar</a></li>							<li><a href="disponibilidad_producto.php">Disponivilidad de Producto</a></li>
<li><a href="cambios.php">Sobre los Cambios</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="span3 footer-col">
							<div class="widget-info">
								<div class="widget-title">Mi cuenta</div>
								<div class="line"></div>
								<div class="widget-content">
									<ul>
										<li><a href="login.php">Loguearme</a></li>
										<li><a href="registro.php">Registro</a></li>
										<li><a href="cambiar_contrasena.php">Olvide mi contraseña</a></li>
										
									</ul>
								</div>
							</div>
						</div>
						<div class="span3 footer-col">
							<div class="widget-info">
								<div class="widget-title">Quiere recibir Promociones</div>
								<div class="line"></div>
								<div class="widget-content">
									<input type="text" name="mail" placeholder="Su email Aquí!">
									<button class="go_btn">Enviar</button>
									<br/>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom" style="background:#db0080;">
				<div class="container main" id="footer-bottom">
					<div class="row">
						<div class="span8 footer-col" style="color:#FFF;">
						Copyright &#169; 2013 <a href="#">MALADITO ZAPATO</a> All rights reserved. | realizado por <a href="http://demabranding.com/" target="_blank" style="color:#ffb4e0">DEMABRANDING</a> </div>
						<div class="span4 footer-col">
							<ul>
								<li><a href="#"><img alt="" src="images/payment-getway/1.png"></a></li>
								<li><a href="#"><img alt="" src="images/payment-getway/2.png"></a></li>
								<li><a href="#"><img alt="" src="images/payment-getway/3.png"></a></li>
								<li><a href="#"><img alt="" src="images/payment-getway/4.png"></a></li>
								<li></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Start JS Link -->
		<script src="js/js-engine.js"></script>
		<script type="text/javascript" src="js/menu/jquery.min.js"></script>
		<script type="text/javascript" src="js/menu/superfish.js"></script>
		<script type="text/javascript" src="js/bounceslider/modernizr.js"></script>
		<script type="text/javascript" src="js/bounceslider/jquery.bounceslider.js"></script>
		<script type="text/javascript" src="js/new-product-js/jquery.jcarousel.min.js"> </script>
		<script type="text/javascript" src="js/new-product-js/responsiveslides.min.js"></script>
		<script type="text/javascript" src="js/bxslider/jquery.bxslider.min.js"></script>
		<script type="text/javascript" src="js/bxslider/jquery.bxslider.js"></script>
		<script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
		<script type="text/javascript" src="js/mixitup/jquery-ui.sortable.min.js"></script>
		<script type="text/javascript" src="js/mixitup/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript" src="js/mixitup/jquery.mixitup.min.js"></script>
		<script type="text/javascript" src="js/mixitup/mixitop-inline.js"></script>
		<script type="text/javascript" src="js/mixitup/ga.js"></script>
		<script type="text/javascript" src="js/mixitup/cloudflare.min.js"></script>
		<script type="text/javascript" src="js/contact_form/jquery.form.js"></script>
		<script type="text/javascript" src="js/contact_form/init_form.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/zoom/jquery.jqzoom-core.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
	<!-- End JS Link -->	
	</body>
</html>