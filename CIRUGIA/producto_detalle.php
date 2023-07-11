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
		<title>MALDITO ZAPATO</title>
	
	<!-- Font CSS Link -->
	    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<!-- Font CSS Link -->	
		<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script type="text/javascript" src="js/menu/jquery.min.js"></script>
		
		<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
		<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
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
										<button onclick="location.href='carrito.php';"  class="checkout" style="margin-right:5px;">Carrito</button>
										 <button onclick="location.href='index.php';"  class="cart">Comprar</button>
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
								<li ><a href="index.php">Home</a></li>
								<li style="background-color:#db0080;">
									<a onclick="location.href='productos.php'" class="dropdown-toggle" data-toggle="dropdown" style=" color:#FFF;" >
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
					<li><a href="#">Home</a></li><li>&#47;</li><li class="active"><a href="#">Detalle de Producto</a></li>
				</ul>
			</div>	
		</div>	
	
		<div class="main_content">
			<div class="container main">
				<div class="row">
					<div class="span3 widget-area">
					<div class="left-sidebar">
						<div class="widget-info">
							<div class="widget-title">Categorias</div>
							<div class="line"></div>
							<div class="widget-content">
								<ul>
								<?php 
				                        $link1=Conectarse();
									    $sql1= " select * from menu_categorias  where padre=48 ";
									    $consulta1= mysql_query($sql1,$link1);
									    if ($consulta1)
									     {
									    	while($row1= mysql_fetch_assoc($consulta1)) 
									    	{
				                        ?> <li><a href="productos.php?ic=<?php echo $row1["id"]?>"><?php echo  strtoupper($row1["categoria"])?></a></li>
										<?php }}?>
								</ul>
							</div>
						</div>
                        <div class="widget-info">
							<div class="widget-title">Nuestros Servicios</div>
							<div class="line"></div>
							<div class="widget-content">
								<ul>
									<li class="feature_pro sidebar_post_wrap" style="height:60px !important; " >
										<div class="feature_pro_image sidebar_feature_img" style="height:50px;">	
											<img alt="" src="images/icono_envion_sin_cargo.png" style="float:right; margin-right:10px;">
										</div>
										<div class="feature_pro_info sidebar_feature_pro_info">
											<p class="feature_pro_title sidebar_feature_pro_title">Envío sin cargo</p>
											<p class="feature_pro_content sidebar_feature_pro_content"> a partir de los 299 Pesos.</p>
										
										</div>	
									</li>
									<li class="feature_pro sidebar_post_wrap" style="height:60px !important; ">
										<div class="feature_pro_image sidebar_feature_img">	
											<img alt="" src="images/icon_cuotas_sin_interes.png" style="float:right; margin-right:10px;">
										</div>
										<div class="feature_pro_info sidebar_feature_pro_info">
											<p class="feature_pro_title sidebar_feature_pro_title">Todos las tarjetas</p>
											<p class="feature_pro_content sidebar_feature_pro_content">Cuotas sin Interes.</p>
										
										</div>	
									</li>
								  <li class="feature_pro sidebar_post_wrap" style="height:60px !important; ">
										<div class="feature_pro_image sidebar_feature_img">	
											<img alt="" src="images/icon_deja_consulta.png" style="float:right; margin-right:10px;">
									  </div>
										<div class="feature_pro_info sidebar_feature_pro_info">
											<p class="feature_pro_title sidebar_feature_pro_title">Dejanos tu consulta</p>
											<p class="feature_pro_content sidebar_feature_pro_content">info@malditozapato.com.</p>
										
									</div>	
									</li>
								</ul>
							</div>
						</div>
                        
						<div class="widget-info" style="margin-top:-5px;">
							<div class="widget-title">Liquidación</div>
							<div class="line"></div>
							<div class="widget-content">
							<ul>
							<?php 
		                        $link1=Conectarse();
							    $sql1= " select * from productos  where LIQUIDACION =1  ";
							    $consulta1= mysql_query($sql1,$link1);
							    if ($consulta1)
							     {
							    	while($row1= mysql_fetch_assoc($consulta1)) 
							    	{
		                        ?>
		                        <li class="feature_pro sidebar_post_wrap">
										<div class="feature_pro_image sidebar_feature_img">	
											<img style="float:right;"  width="80px" height="100px"  alt="" src="images/producto/liquidacion/<?php echo $row1["FOTO_CHICA"]?>">
										</div>
										<div class="feature_pro_info sidebar_feature_pro_info">
											<p class="feature_pro_title sidebar_feature_pro_title"><?php echo $row1["DESCRIPCION"]?></p>
											<p class="feature_pro_content sidebar_feature_pro_content"><?php echo substr($row1["DESCRIPCION_COMPLETA"], 0,50)?>.</p>
											<button class="feature_pro_price sidebar_pro_price">$<?php echo $row1["PRECIO_COSTO"]?></button>
										</div>	
									</li>
		                        <?php 
							    	}}
		                        ?>
								</ul>
							</div>
						</div>
					</div>
					
				</div>
					<div class="span9 product_details">					
						<div class="row">
						<?php 
		                        		$link1=Conectarse();
							    		$sql1= " select * from productos  where ID  =".$_GET["ipd"];
							    		$consulta1= mysql_query($sql1,$link1);
							    		if ($consulta1)
							     		{
							    		$row1= mysql_fetch_assoc($consulta1)
		                        	?>
							<div class="span4">
								<div class="porduct_info">
									
									<div class="clearfix portfilio_zooming_product span9">
									 
									<?php if (isset($_GET["fm"])==null || $_GET["fm"]=="" || $_GET["fm"]=="c")
									{?>
										<a href="images/producto/<?php echo 'original'.$row1["FOTO_CHICA"]?>" class="jqzoom" rel='gal1'  title="triumph" >
											<div class="span4">
											<img alt="" src="images/producto/<?php echo 'original'.$row1["FOTO_CHICA"]?>"  title="triumph"></div>
										</a>
										<?php 
									}
										?>
										<?php if ($_GET["fm"]=="m")
									{ ?>
										<a href="images/producto/<?php echo 'original'.$row1["FOTO_MEDIDAS"]?>" class="jqzoom" rel='gal1'  title="triumph" >
											<div class="span4">
											<img alt="" src="images/producto/<?php echo 'original'.$row1["FOTO_MEDIDAS"]?>"  title="triumph"></div>
										</a>
										<?php 
									}
										?>
										<?php if ( $_GET["fm"]=="g")
									{ ?>
										<a href="images/producto/<?php echo 'original'.$row1["FOTO_GRANDE"]?>" class="jqzoom" rel='gal1'  title="triumph" >
											<div class="span4">
											<img alt="" src="images/producto/<?php echo 'original'.$row1["FOTO_GRANDE"]?>"  title="triumph"></div>
										</a>
										<?php 
									}
										?>
									</div>
									
									
									<div class="clearfix span4" >
										<ul id="thumblist" class="clearfix" >
											<li>
											<a href="producto_detalle.php?ipd=<?php echo $row1["ID"]?>&fm=c" >												
												<img  width="90px" height="110px" alt="" src="images/producto/<?php echo 'original'.$row1["FOTO_CHICA"]?>">
												</a>
											</li>

											<li>
											<a href="producto_detalle.php?ipd=<?php echo $row1["ID"]?>&fm=m" >
												<img width="90px" height="110px" alt="" src="images/producto/<?php echo 'original'.$row1["FOTO_MEDIDAS"]?>">
												</a>
											</li>
											<li>
											<a href="producto_detalle.php?ipd=<?php echo $row1["ID"]?>&fm=g" >
												<img width="90px" height="110px" alt="" src="images/producto/<?php echo 'original'.$row1["FOTO_GRANDE"]?>">
												</a>
											</li>
										</ul>
									</div>
									
								</div>	
							</div>
							<div class="row">
								<div class="span5">
								
									<div class="porduct_info_details ">
										<div class="row">
											<div class="product_single_title span2">
												<?php echo $row1["DESCRIPCION"]?>
											</div>

											<div class="product_select span4">												
					<span style="font-size:14px; text-decoration:underline;">* TALLE:</span><br>	
                    
                    <span style="font-size:12px; ">* Seleccione talle y cantidad de zapatos que va a adquirir.</span>
                    						<div class="product_single_quantity_select">
								
                                					<select id="talles" class="validate[required]" name="talles">
													<option value="">Talle</option>
													<?php
													for ($i=1;$i<=6;$i++)
													{ 
													?>
													<option value="<?php echo $i+34 ?>"><?php echo $i+34 ?></option>
													<?php }?>
													</select>
												</div>
												<div class="product_single_quantity_select">
													<select id="Cantidad">
													<option value="1">Cantidad</option>
													<?php
													for ($i=1;$i<=10;$i++)
													{ 
													?>
													<option value="<?php echo $i ?>"><?php echo $i ?></option>
													<?php }?>
													</select>
												</div>
											</div>
									
											<div class="product_single_model_info span4">
											<p><span><?php echo $row1["DESCRIPCION_COMPLETA"]?></span></p>

											</div>
                                            
                                            <div class="clearfix span4" ><br>

                                            								<span style="font-size:14px; text-decoration:underline;">COLORES:</span>
										<ul id="thumblist" class="clearfix" >
											<?php			                        		
								    		$sql3= "select * from productos where CODIGO ='".$row1["CODIGO"]."'
								    		and ID not in (".$row1["ID"].")";								    		
								    		$consulta3= mysql_query($sql3,$link1);
								    		if ($consulta3)
								     		{
								     			while($row3= mysql_fetch_assoc($consulta3)) 
							    				{
							    					
			                        		?>
											<li>
												<a  href='producto_detalle.php?ipd=<?php echo $row3["ID"]?>'><img width="49px" height="70px" alt="" src='images/producto/<?php echo 'original'.$row3["FOTO_GRANDE"]?>'></a>
											</li>
											<?php
							    					}} 
											?>											
										</ul>
									</div>
											<div class="product_single_cart_info span3">
												<button class="price" >
													$<?php echo $row1["PRECIO_COSTO"]?>
												</button>
												<button  class="add_to_cart" onclick="var talle= document.getElementById('talles').value; 
																					var canti= document.getElementById('Cantidad').value; 
																					var url = 'addto.php?ip=<?php echo $row1["ID"]?>&talle='+talle+'&cant='+canti;
																					window.location.href=url ;">
													<img alt="" src="images/new-product/shoping-info/cart-image.png">
													<span>Agregar </span>
												</button>
												
											</div>
										</div>	
										<div class="row">
										<div class="span4"></div>
										<div class="rating_share_wrapper">
										
											<div class="share_it span3">
												<p>Compartir:</p>
												<ul>
													<li>
														<a href="#">
															<img alt="" src="images/share_it/fb.png"><p>share</p>
														</a>
													</li>
													
													<li>
														<a href="#">
															<img alt="" src="images/share_it/tw.png"><p>tweet</p>
														</a>
													</li>
												</ul>				
											</div>
										</div>
										</div>
										<div class="row">
									<div class="product_description span5">
										<script type="text/javascript">
											  jQuery(function() {
												$( "#tab").tabs();
											  });
										</script>
											<div id="tab">
																					  <div id="tabs-1">
												<p><strong><strong>Información de envío</strong></strong>:</p>
                                                
                                                
			<p> * El envío es gratuito a cualquier punto de la Argentina a partir de los 299 pesos.</p>
                
                <p> * Si la compra es inferior a este monto,  tendrá un costo adicional de envío de $90.</p>
                
                
             <p>   *El plazo de entrega comenzará a contar a partir del momento en el que se despacha tu pedido.</p>
             
                   <p>   *La entrega del producto se realiza a través de la empresa CORREO ARGENTINO.</p>
                   
                </div>
											 
											  <div id="tabs-2">
												<p><strong>Cambios:</strong></p>
                
             <p> Cambio sin cargo.(*).  <a href="cambios.php" target="_self"> Sobre el cambio</a>.</p>
											  </div>
											 
											</div>
											
										</div>
										</div>
									</div>
						
								</div>
							</div>
							<?php }?>
						</div>
						<div class="row">
							<div class="span9 related_product checkout_area list_work">
								<h2 class="title-wrap">
									<span>Productos Relacionados</span>
								</h2>
								<div class="line"></div><br>

								<div class="new-product-info">								
									<div class="related_products">
										<?php
									$sql3= "select * from productos where ID_MENU_CATEGORIA =(select ID_MENU_CATEGORIA from productos where ID=".$_GET["ipd"].")
								    		and ID not in (".$_GET["ipd"].")
									and CODIGO not in (select CODIGO from productos where ID=".$_GET["ipd"].")";		
															    		
								    		$consulta3= mysql_query($sql3,$link1);
								    		if ($consulta3)
								     		{
								     			while($row3= mysql_fetch_assoc($consulta3)) 
							    				{
									 ?>
										<div class="span3 new-product slide">
											<div class="new-product-image">	
												<a href="#"><img src="images/producto/tendencia/<?php echo $row3["FOTO_CHICA"] ?>" alt="" /></a>
											</div>	
											<div class="new-product-info">	
												<div>
													<div class="new-product-price">$<?php echo $row3["PRECIO_COSTO"]?></div>
													<div class="new-product-bg">
														<div class="newE-product-cart_like">
															<div class="new-product-cart_like">
																<div class="new-product-cart"><a href="producto_detalle.php?ipd=<?php echo $row3["ID"]?>"></a></div>
																
															</div>
														</div>
														<div class="new-product-details"><a href="producto_detalle.php?ipd=<?php echo $row3["ID"]?>">Detalles</a></div>
													</div>			
												</div>
											</div>
											<div class="new-product-content">
												<div class="new-product-title">
													<a href="#"><p><?php echo $row3["PRECIO_COSTO"]?></p></a>
												</div>
												<div class="new-product-content">
													<p><?php echo substr($row3["DESCRIPCION_COMPLETA"], 0,50) ?></p>
												</div>
											</div>
										</div>
										<?php }}?>						
									</div>
								</div>	
						<script type="text/javascript">
							$(document).ready(function(){
							  $('.related_products').bxSlider({
								slideWidth: 220,
								minSlides: 2,
								maxSlides: 3,
								slideMargin: 18
							  });
							});
						</script>
					</div>
						</div>
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
					  <div class="free-shipping-wrap" style="height:50p">
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
										
										<li><a href="contacto.php">Contacto</a></li>
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
						<div class="span8 footer-col" style="color:#FFF; margin-bottom:15px;">
						Copyright &#169; 2013 <a href="#">MALADITO ZAPATO</a> All rights reserved. | realizado por <a href="http://demabranding.com/" target="_blank" style="color:#ffb4e0">DEMABRANDING</a> </div>
						<div class="span4 footer-col" style="margin-top:-15px;">
				        <img src="images/icon_seguridad_de_compra.png" width="313" height="40"> </div>
					</div>
                    
                    <div class="row">
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
		<!-- <script src="js/js-engine.js"></script> -->
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