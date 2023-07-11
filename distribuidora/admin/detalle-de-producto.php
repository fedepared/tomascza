<?
require_once("admin/include/includes.php");

$id_prod = 10;


$sql = "SELECT P.id_prod, P.nombre, P.precio, P.dcorta, P.dlarga, P.publicado, RCP.id_cate as idcate ";
$sql.= "FROM tbl_productos as P, tbl_relcateprod as RCP ";
$sql.= "WHERE P.id_prod = ".intval($id_prod) ." AND P.id_prod = RCP.id_prod";
$result = $db->Query($sql,$connection);
$db->FetchArray($result,&$myrow);
$nombre = $myrow["nombre"];
$idcate = $myrow["idcate"];
$cantprod = "cantprod" . $myrow['id_prod'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
    <title>Cali Cleo</title>
        <meta name="description" content="Responsive modern ecommerce Html5 Template">
        <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300' rel='stylesheet' id="googlefont">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/prettyPhoto.css">
        <link rel="stylesheet" href="css/colpick.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        
        <!-- Favicon and Apple Icons -->
        <link rel="icon" type="image/png" href="images/icons/icon.html">
        <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.html">
        <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.html">
        
              <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
        
        <!--- jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>

        <!--- Modernizr -->
        <script src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        
        <style id="custom-style">
        
        </style>
    </head>
    <body>

    <!-- End #option panel -->

    <div id="wrapper">
        <header id="header">
            <div id="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
        					<div class="header-top-left">
        						<ul id="top-links" class="clearfix" style="padding-left:-5px">
        							<li><a href="como-comprar-calicleo.html" title="Como comprar">Como comprar </a></li>
        							<li><a href="formas-de-pago-calicloe.html" title="Formas de pago">Forma de pago </a></li>
        							<li><a href="envios-calicleo.html" title="Formas de Envío">Envios </a></li>
        							<li><a href="contacto.html" title="contacto cali cleo">Contacto</a></li>
        						</ul>
        					</div><!-- End .header-top-left --><div class="header-top-right">
        						<ul id="top-links" class="clearfix">
        							<li><a href="#" title="Ingresar"><span class="top-icon top-icon-pencil"></span><span class="hide-for-xs">Ingresar</span></a></li>
        							<li><a href="#" title="Mi cuenta"><span class="top-icon top-icon-user"></span><span class="hide-for-xs">Mi Cuenta</span></a></li>
        							
        						</ul>
        					</div>
        					<div class="header-top-right">
                                <div class="dropdown-cart-menu-container pull-right">
                                    <div class="btn-group dropdown-cart">
                                    <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">
                                        <span class="cart-menu-icon"></span>
                                        Mis Compras 
                                    </button>
                                    
                                        <div class="dropdown-menu dropdown-cart-menu pull-right clearfix" role="menu">
                                            
                                            <ul class="dropdown-cart-product-list">
                                                <li class="item clearfix">
                                                <a href="#" title="Eliminar producto" class="delete-item"><i class="fa fa-times"></i></a>
                                                <a href="#" title="Editar producto" class="edit-item"><i class="fa fa-pencil"></i></a>
                                                    <figure>
                                                        <a href="#"><img src="images/productos/zapato-1.jpg" alt="jacket 4"></a>
                                                    </figure>
                                                    <div class="dropdown-cart-details">
                                                        <p class="item-name">
                                                        <a href="#">Bota </a>
                                                        </p>
                                                        <p>
                                                            1x
                                                            <span class="item-price">$500</span>
                                                        </p>
                                                    </div><!-- End .dropdown-cart-details -->
                                                </li>
                                                <li class="item clearfix">
                                                <a href="#" title="Eliminar producto" class="delete-item"><i class="fa fa-times"></i></a>
                                                <a href="#" title="Editar producto" class="edit-item"><i class="fa fa-pencil"></i></a>
                                                    <figure>
                                                        <a href="#"><img src="images/productos/zapato-1.jpg" alt="jacket 3"></a>
                                                    </figure>
                                                    <div class="dropdown-cart-details">
                                                        <p class="item-name">
                                                            <a href="#">Zapato</a>
                                                        </p>
                                                        <p>
                                                            1x
                                                            <span class="item-price">$500</span>
                                                        </p>
                                                    </div><!-- End .dropdown-cart-details -->
                                                </li>
                                            </ul>
                                            
                                            <ul class="dropdown-cart-total">
                                               
                                                <li><span class="dropdown-cart-total-title">Total:</span>$1000</li>
                                            </ul><!-- .dropdown-cart-total -->
                                           <div class="dropdown-cart-action">
                                                <p><a href="#" class="btn btn-custom-2 btn-block">Carrito</a></p>
                                                <p><a href="#" class="btn btn-custom btn-block">Comprar</a></p>
                                            </div><!-- End .dropdown-cart-action -->
                                            
                                        </div><!-- End .dropdown-cart -->
                                        </div><!-- End .btn-group -->
                                    </div><!-- End .dropdown-cart-menu-container -->    
                 
    							<!-- End .pull-right -->
    						</div><!-- End .header-top-right -->
    					</div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End #header-top -->
            
            <div id="inner-header">
                
                <div id="main-nav-container">
                    <div class="container">
                        <div class="row">
                            <div id="menu-wrapper" class="clearfix">
                                    <div class="logo-container">
                                    <h1 class="logo clearfix">
                                        <span>Responsive eCommerce Template</span>
                                        <a href="index-2.html" title="Venedor eCommerce Template"><img src="images/logo-cali-cleo-zapatos.png" alt="Venedor Commerce Template" width="202" height="92"></a>
                                    </h1>
                                </div><!-- End .logo-container -->
                                <div id="menu-right-side" class="clerfix">
                                <div id="quick-access">
                                <form class="form-inline quick-search-form" role="form" action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Buscar">
                                    </div><!-- End .form-inline -->
                                    <button type="submit" id="quick-search" class="btn btn-custom"></button>
                                </form>
                                </div><!-- End #quick-access -->
                                    <nav id="main-nav">
                                        <div id="responsive-nav">
                                            <div id="responsive-nav-button">
                                                Menu <span id="responsive-nav-button-icon"></span>
                                            </div><!-- responsive-nav-button -->
                                        </div>
                                        <ul class="menu clearfix">
                                            <li>
                                                <a class="active" href="index.html">HOME</a>
                                               
                                            </li>
                                       
                                            
                                            <li>
                                                <a href="#">TIENDA MINORISTA</a>
                                                <ul>
                                                    <li><a href="#">Zapatos</a></li>
                                                    <li><a href="#">Botas</a></li>
                                                
                                                    <li><a href="#">Zapatillas</a></li>
                                              
                                          
                                                </ul>
                                            </li>
                                            <li><a href="#">TIENDA MAYORISTA</a>
                                                <ul>
                                                           <li><a href="#">Zapatos</a></li>
                                                    <li><a href="#">Botas</a></li>
                                                
                                                    <li><a href="#">Zapatillas</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">LIQUIDACIÓN</a>
                                                <ul>
                                        <li><a href="#">Zapatos</a></li>
                                                    <li><a href="#">Botas</a></li>
                                                
                                                    <li><a href="#">Zapatillas</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contacto.html">Contaco</a></li>
                                        </ul>
                                        
                                    </nav>
                                </div><!-- End #menu-right-side -->
                                </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
                    
                </div><!-- End #nav -->
            </div><!-- End #inner-header -->
        </header><!-- End #header -->

        <section id="content">
        	<div id="breadcrumb-container">
        		<div class="container">
					<ul class="breadcrumb">
						<li><a href="index.html">Home</a></li>
				<li class="active">Tienda Minorista</li>		<li class="active">Zapatos</li>
					</ul>
        		</div>
        	</div>
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				
        				<div class="row">
        				
        				<div class="col-md-7 col-sm-12 col-xs-12 product-viewer clearfix">
<?
		$nombre = $myrow["nombre"];
		$id_subcate = $myrow["id_subcate"];
		$cantprod = "cantprod" . $myrow['id_prod'];
		?>
        					<div id="product-image-carousel-container">
        						<ul id="product-carousel" class="celastislide-list">
	        						<li class="active-slide"><a data-rel='prettyPhoto' href="images/productos/zapato-1-grande.jpg" ><img src="images/productos/zapato-1-chico.jpg" alt="jacket photo 1"></a></li>
	        						<li><a data-rel='prettyPhoto' href="images/productos/zapato-2-grande.jpg"><img src="images/productos/zapato-2-chico.jpg" alt="jacket photo 2"></a></li>
	        						<li><a data-rel='prettyPhoto' href="images/productos/zapato-1-grande.jpg"><img src="images/productos/zapato-1-chico.jpg" alt="jacket photo 3"></a></li>
	        						<li><a data-rel='prettyPhoto' href="images/productos/zapato-2-grande.jpg"><img src="images/productos/zapato-2-chico.jpg" alt="jacket photo 4"></a></li>
	        		

        					</ul><!-- End product-carousel -->
        					</div>

        					<div id="product-image-container"  style="float:right; margin-right:50px;">
        						<figure><img src="images/productos/zapato-1-grande.jpg" alt="Product Big image" id="product-image" data-big="images/productos/zapato-1-grande.jpg">
        							
       						  </figure>
        					</div><!-- product-image-container -->        				 
        				</div><!-- End .col-md-6 -->

        				<div class="col-md-5 col-sm-12 col-xs-12 product">
                        <div class="lg-margin visible-sm visible-xs"></div><!-- Space -->
        					<h1 class="product-name"><? echo $myrow["nombre"] ?></h1>
        					<div class="ratings-container">
				
        				<ul class="product-list">
        					<li><span>Descripción:</span><? echo $myrow["dcorta"] ?></li><br>

        					<li><span>Código:</span><? echo $myrow["codigo"] ?></li><br>


                            <li>
										<span class="old-price" style=" font-size:24px"> <? 
			  if($myrow['precio'] == 0) {
				$precio = "Consulte";
			  } else {
				$precio = formatoprecio($myrow['precio']);
			  }
			  echo $precio;
			  ?></span>
							
									</li>
        				</ul>
        				<hr>
                        <div class="product-size-filter-container">
                            <span>Seleccioná tu Talle:</span>
                            <div class="xs-margin"></div>
                            <ul class="filter-size-list clearfix">
                                <li><a href="#">35</a></li>
                                <li><a href="#">36</a></li>
                                <li><a href="#">37</a></li>
                                <li><a href="#">38</a></li>
                                
                            </ul>
                        </div><!-- End .product-color-filter-container-->
                        <hr>
                        
                        <div class="product-color-filter-container">
                            <span>Selecciona el color:</span>
                            <div class="xs-margin"></div>
                            <ul class="filter-color-list clearfix">
                                <li><a href="#" data-bgcolor="#fff" class="filter-color-box"></a></li>
                                <li><a href="#" data-bgcolor="#d1d2d4" class="filter-color-box"></a></li>
                                <li><a href="#" data-bgcolor="#666467" class="filter-color-box"></a></li>
                                <li><a href="#" data-bgcolor="#515151" class="filter-color-box"></a></li>
                                <li><a href="#" data-bgcolor="#bcdae6" class="filter-color-box"></a></li>
                                <li><a href="#" data-bgcolor="#5272b3" class="filter-color-box"></a></li>
                                <li><a href="#" data-bgcolor="#acbf0b" class="filter-color-box"></a></li>
                            </ul>
                        </div>
                        <hr>
							<div class="product-add clearfix">
								<div class="custom-quantity-input">
									<input type="text" name="quantity" value="1">
									<a href="#" onclick="return false;" class="quantity-btn quantity-input-up"><i class="fa fa-angle-up"></i></a>
									<a href="#" onclick="return false;" class="quantity-btn quantity-input-down"><i class="fa fa-angle-down"></i></a>
								</div>
								
                                <?	
				if($idusuario != "") {
					echo "<a class='btn btn-custom-2' href='#' onclick='addCarrito(".$myrow["id_prod"].",document.getElementById(\"cantidad\").value,".$myrow['precio'].",200); return false'>COMPRAR</a>";
				} else {
					echo "<a class='btn btn-custom-2' href='login.php'>COMPRAR</a>";
				}
				?>
                               
							</div><!-- .product-add -->
        					<div class="md-margin"></div><!-- Space -->
        					<div class="product-extra clearfix">
								
								<div class="md-margin visible-xs"></div>
								<div class="share-button-group">
									<!-- AddThis Button BEGIN -->
									<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
									<a class="addthis_button_facebook"></a>
									<a class="addthis_button_twitter"></a>
									<a class="addthis_button_email"></a>
									<a class="addthis_button_print"></a>
									<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
									</div>
									<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
									<script type="text/javascript" src="../../../../s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b2197865ea0183"></script>
									<!-- AddThis Button END -->
								</div><!-- End .share-button-group -->
        					</div>
        				</div><!-- End .col-md-6 -->
        					
        					
        				</div><!-- End .row -->
        				
        				<div class="lg-margin2x"></div><!-- End .space -->
        				
        				<div class="row">
        					<div class="col-md-9 col-sm-12 col-xs-12">
        						
        				
        						<div class="lg-margin visible-xs"></div>
        					</div><!-- End .col-md-9 -->
        					<div class="lg-margin2x visible-sm visible-xs"></div><!-- Space -->
        					<!-- End .col-md-4 -->
        				</div><!-- End .row -->
        				<!-- Space -->
        				<!-- End .purchased-items-container -->

        			</div><!-- End .col-md-12 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->
        
        </section><!-- End #content -->
        
        <footer id="footer">
            <div id="newsletter-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
                        <h3>REGÍSTRATE PARA RECIBIR LAS ÚLTIMAS NOTICIAS DE MODA</h3>
                            <form id="register-newsletter">
                            <input type="text" name="newsletter" required placeholder="Escriba su Email">
                            <input type="submit" class="btn btn-custom-3" value="ENVIAR">
                            </form>
                        </div><!--End  .col-md-6 -->
                        
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End #newsletter-container -->
            <div id="inner-footer">
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12 widget">
                            <h3>MENÚ</h3>
                            <ul class="links">
                             <li><a href="index.html">Home</a></li>
                                <li><a href="#">Tienda Minorista </a></li>
                                <li><a href="#">Tienda Mayorista</a></li>
                                <li><a href="#">Liquidación</a></li>
                                <li><a href="contacto.html">Contacto</a></li>
                          
                            </ul>
                        </div><!-- End .widget -->
                        
                        <div class="col-md-3 col-sm-4 col-xs-12 widget">
                            <h3>AYUDA</h3>
                            <ul class="links">
                                <li><a href="como-comprar-calicleo.html">Como Comprar</a></li>
                                <li><a href="formas-de-pago-calicloe.html">Forma de Pago</a></li>
                                <li><a href="envios-calicleo.html">Envío</a></li>
                                   <li><a href="cambios-calicleo.html">Cambios</a></li>
                                <li><a href="condiciones-calicleo.html">Condiciones</a></li>
                               
                            </ul>
                        </div><!-- End .widget -->
                        
                        <div class="col-md-3 col-sm-4 col-xs-12 widget">
        					<h3>DATOS DE CONTACTO</h3>
        						<ul class="contact-details-list">
        							<li>
										<span class="contact-icon contact-icon-phone"></span>
										<ul>
											<li>(011) 54 4444.4444</li>
						
										</ul>
        							</li>
        							<li>
										<span class="contact-icon contact-icon-mobile"></span>
										<ul>
											<li>(011) 15.4444.4444</li>
						
										</ul>
        							</li>
        							<li>
										<span class="contact-icon contact-icon-email"></span>
										<ul>
											<li>info@calicleo.com.ar</li>
								
										</ul>
        							</li>
                                    
                                    	<li>
										<span class="contact-icon contact-icon-addres"></span>
										<ul>
											<li>Buenos Aires - Argentina</li>
							
										</ul>
        							</li>
        						
        						</ul>
        					</div><!-- End .widget -->
                        
                        <div class="clearfix visible-sm"></div>
                        
                        <div class="col-md-3 col-sm-12 col-xs-12 widget">
                            <h3>NO TE PIERDAS LAS NOVEDADES</h3>
                            
                            <div class="facebook-likebox">
                                <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpaginasdemabranding&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false"></iframe>
                            </div>
                            
                            
                        </div><!-- End .widget -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            
            </div><!-- End #inner-footer -->
            
            <div id="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12 footer-social-links-container">
                            <ul class="social-links clearfix">
                                <li><a href="https://www.facebook.com/calicleo" class="social-icon icon-facebook"></a></li>
                                 <li><a href="#" class="social-icon icon-twitter"></a></li>
                                 <li><a href="#" class="social-icon icon-linkedin"></a></li>
                            
                                <li><a href="#" class="social-icon icon-email"></a></li>
                            </ul>
                        </div><!-- End .col-md-7 -->
                        
                        <div class="col-md-5 col-sm-5 col-xs-12 footer-text-container">
                            <p>© 2015 Cali Cleo. All Rights Reserved. <a href="www.demabranding.com" target="_blank"><span style="color:#d4195a">Demabranding</span> </a></p>
                        </div><!-- End .col-md-5 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End #footer-bottom -->
            
        </footer><!-- End #footer -->
    </div><!-- End #wrapper -->
        <a href="#" id="scroll-top" title="Scroll to Top"><i class="fa fa-angle-up"></i></a><!-- End #scroll-top -->
    <!-- END -->
	<script src="js/bootstrap.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/retina-1.1.0.min.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/jquery.hoverIntent.min.js"></script>
	<script src="js/twitter/jquery.tweet.min.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
	<script src="js/jflickrfeed.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/jquery.fitvids.js"></script>
	<script src="js/colpick.js"></script>
    <script src="js/jquery.elastislide.js"></script>
	<script src="js/jquery.mlens-1.3.min.js"></script>
	<script src="js/main.js"></script>
	
	<script>
		$(function() {

			var carouselContainer = $('#product-carousel'),
                productImg =  $('#product-image');

			carouselContainer.elastislide({
				orientation : 'vertical',
				minItems : 4
					
			});

            productImg.mlens({
                imgSrc: $("#product-image").attr("data-big"),         
                lensShape: "square",
                lensSize: 300,
                borderSize: 0,
                borderColor: "#999",
                borderRadius: 0
            });
			
			
			var oldImg = productImg.attr('src');
			carouselContainer.find('li').on('mouseover', function() {
				
				var newImg = $(this).find('a').attr('href');
				
                productImg.attr({'src': newImg, 'data-big': newImg}).trigger('imagechanged');
                
			});

            // triggered with custom event
            productImg.on('imagechanged', function() {
                productImg.mlens("update", 0 ,{
                    imgSrc: productImg.attr("data-big"),
                    lensShape: "square",
                    lensSize: 300,
                    borderSize: 0,
                    borderColor: "#999"
                });
            });

		});
		
		
	</script>
    </body>
</html>