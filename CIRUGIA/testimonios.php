<?php
session_start();
include_once 'admin/class/conexion.php';
include_once("cabecera.php");
?>  
    
    
    <!--  ==========  -->
    <!--  = Breadcrumbs =  -->
    <!--  ==========  -->
    <div class="darker-stripe">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><span class="icon-chevron-right"></span></li>
              
                        <li><span class="icon-chevron-right"></span></li>
                        <li>
                            <a href="blog.html">Testimonios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="push-up top-equal blocks-spacer">
            <div class="row">
                
                <!--  ==========  -->
                <!--  = Main Title =  -->
                <!--  ==========  -->
                
                <div class="span12">
                    <div class="title-area">
                        <h1 class="inline"><span class="light"></span> Testimonios</h1>
                        
                    </div>
                </div>
                
                <!--  ==========  -->
                <!--  = Main content =  -->
                <!--  ==========  -->
                <section class="span8 blog">
                    
                    <!--  ==========  -->
                    <!--  = Sticky Post =  -->
                    <!--  ==========  -->
                    
                    
                    <!--  ==========  -->
                    <!--  = Post with Video =  -->
                    <!--  ==========  --><!--  ==========  -->
                    <!--  = Post with Image =  -->
                    <!--  ==========  -->
                    <?php
                    $limit = 1;		
					$pag = 0;
					if (isset($_GET["pag"]))
						$pag = (int) ($_GET["pag"]);
	
	
					if ($pag < 1)
					{
					   	$pag = 1;
					}		
					$offset = ($pag-1) * $limit;
					$finalqry = 	"order by 1 LIMIT  $offset, $limit";
				    $link1=Conectarse();
				    $sql1= " select * from testimonios ".$finalqry;
				    $consulta1= mysql_query($sql1,$link1);
				    $sqlTotal = "SELECT count(*) as total from testimonios ";
				    
    				$rs = mysql_query($sql1);
					$rsTotal = mysql_query($sqlTotal);
					 
					$rowTotal = mysql_fetch_assoc($rsTotal);
 
					$total = $rowTotal["total"];
				    
				    if ($consulta1)
				     {
				    	while($row1= mysql_fetch_assoc($consulta1)) 
				    	{
				    		
	                      ?>
                    <article class="post format-image">                        
                        <div class="post-inner">
                            <a href="blog-single.html"><img src="images/producto/testimonios/<?php echo $row1["IMAGEN"]?>" alt="featured image" width="1540" height="746" /></a>
                            <div class="post-title">
                            	<h2><span class="light"><?php echo $row1["TITULO"]?></span> </h2>
                            	<div class="metadata">
                            	    <?php echo $row1["fecha"]?>
                            	  
                           	  </div>
                            </div>
                            
                            <p class="push-down-25">
                                <?php echo $row1["DESCRIPCION"]?>
                            </p>
                            

                      </div>
                     
                    </article>
                     <?php }}?>
                    <!--  ==========  -->
                    <!--  = Simple Post =  -->
                    <!--  ==========  -->

                    <hr />
                    
                    <!--  ==========  -->
                    <!--  = Pagination =  -->
                    <!--  ==========  -->
                    <div class="pagination">
                    <?php
      				   $totalPag = ceil($total/$limit);
         			$links = array();
         			for( $i=1; $i<=$totalPag ; $i++)
         			{
            			$links[] = "<a href=\"?pag=$i\">Pag $i</a>"; 
         			}
         			echo implode(" - ", $links);
      				?>
      
                    </div> <!-- /pagination -->
                    
                </section> <!-- /main content -->

                <!--  ==========  -->
                <!--  = Sidebar =  -->
                <!--  ==========  -->
                <aside class="span3">
                    <div class="sidebar-item">
                        
                        <!--  ==========  -->
                        <!--  = Sidebar Title =  -->
                        <!--  ==========  -->
                     
                        
                        <!--  ==========  -->
                        <!--  = Menu (affix) =  -->
                        <!--  ==========  -->
                        <div class="row">
                        	<div class="span3" id="spyMenu">              <p>     <img src="images/reserva_comunicate.jpg" style="margin-bottom:10px;"> </p>

	                       <p>   <img src="images/publicidad_1_paquetes.png">
        </p>                       <p> <img src="images/publicidad_2_paquetes.png"> </p> 
                            
                         <p>     <img src="images/publicidad_3_paquetes.png"> </p> </div>
                        </div>
                        
                    </div>
                </aside> <!-- /sidebar --> 
                
            </div>
        </div>
    </div> <!-- /container -->
    
     
   <?php
include_once("pie.php");
?>  