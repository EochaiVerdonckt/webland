<?php session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
require (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 
require (FSPATH."Controllers/indexController.php"); 
$ctrl=new SlidesController();

$slide1=$ctrl->getSlide(1);
$slide2=$ctrl->getSlide(2);
$slide3=$ctrl->getSlide(3);
$ctrl=new IndexController();
$seo=$ctrl->getSeo();
$seo=$ctrl->getSeoById();
$cats = $ctrl->getCatogs();
$blogs= $ctrl->getBlogs();
$services= $ctrl->getServicesPublished();


function getPromo(){

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();
    $sql = "SELECT promo FROM promo_balance where id=1";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['promo'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function getCatogs(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `catog`";
    $result = mysqli_query($conn, $sql);
    $rij=array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($rij,$row);
        }
    } else {
       
    }
    $conn->close();
    return $rij;
}
function printCat($cat){
    
    echo '
    	<div class="col-md-3 col-xs-12 col-sm-6" >
    	 <div style="margin:8px;">
			<div class="service-item">
				<div class="service-thumb">
				    <div style="/categ/'.$cat['foto'].';width:270px;height:275px;background-image:url(/categ/'.$cat['foto'].')"></div>
					
				</div>
				<div class="service-description">
					<a href="/shop/index.php?cat='.$cat['id'].'"><h3>'.$cat['naam'].'</h3></a>
					<p>'. $cat['omschrijving'].'</p>
				</div>
			</div>
			</div>
		</div>';
   
}
function getReviews($ctrl){
    return $ctrl->selectStatement('reviews',1);
}
function printStars($rating){
    $output = "";
    if($rating==5){
      
        $output=$output. '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        
    }
     if($rating==4){
        
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==3){
    
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==2){
        
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==1){
        
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==0){
        
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    return $output;
}
function printReview($review){
    echo '<div class="item-rev">
                <div class="text-center"><h2>'.printStars($review['rating']).'</h2></div>
                <div class="caption" >
                    <div style="color: white!important;font-size:1.5em;">
                      '.$review['info'].'
                    <h3 style="float:right;color: white!important;margin-top:8px;">-'.$review['naam'].'-</h3>
                    
                    </div>';
            echo '</div></div>';
}
function getKrijt(){
  $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $rij = array();


    $sql = "SELECT promo FROM promo_balance where id=2";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['promo'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
function getNews(){
  $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $rij = array();


    $sql = "SELECT * from news where publish=1 LIMIT 5";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}
?>

	<!DOCTYPE html>
	<!--[if IE 7 ]>
	<html lang="en" class="no-js ie7"> <![endif]-->
	<!--[if IE 8 ]>
	<html lang="en" class="no-js ie8"> <![endif]-->
	<!--[if IE 9 ]>
	<html lang="en" class="no-js ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!-->
	<html lang="nl" class="no-js"> <!--<![endif]-->
	<!-- =========================================
	head
	========================================== -->

	<head>
	    <!-- =========================================
	    Basic
	    ========================================== -->
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	     <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description"  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
	    <meta name="keywords" content="Uw Website online in zeven dagen."/>
	    <meta name="author" content="Webland.be"/>
	    
	    <!-- =========================================
	    Mobile Configurations
	    ========================================== -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no"/>
	    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	    <meta name="apple-mobile-web-app-capable" content="yes"/>


	    <!-- Fonts -->
	    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
	    <link href='//fonts.googleapis.com/css?family=Raleway:600,400' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
	    <!-- //Fonts -->

	    <!-- Owl Carousel CSS -->
	    <link href="/oxx/HTML/css/owl.carousel.css" rel="stylesheet" media="screen">
	    <link href="/oxx/HTML/css/owl.theme.css" rel="stylesheet" media="screen">

	    <!-- =========================================
	    CSS
	    ========================================== -->
	    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
	    <link rel="stylesheet" href="/oxx/HTML/css/offcanvas.css"/>
	    <link rel="stylesheet" href="/oxx/HTML/css/style.css"/>

	</head>
	<!-- /head -->


	<body>

		<div class="wrapper" id="wrapper">
      		<div class="offcanvas-pusher">
	      		<div class="content-wrapper">
					<div class="container">
						<div class="row">
							<section class="header">
								<header class="header-wrapper">
									<div class="header-top">
									        <div class="col-md-6 col-xs-12 col-sm-6">
									            <div class="logo">
									                <a title="fontanero" href="index.html">
									                    <img src="/gold/logo/logo.png" alt="Ons logo" style="width:200px;">
									                </a>
									            </div>
								            </div>
								            <div class="col-md-6 hidden-xs col-sm-6">
												<div class="header-connection">
													<ul class="header-social social">
														<li><a href="<?php echo $seo['14']['waarde']?>"><i class="fa fa-facebook"></i></a>
														</li>
														
													</ul>
													<p>Bel ons: <a href="tel:<?php echo $seo['3']['waarde']?>"><strong><?php echo $seo['3']['waarde']?></strong></a></p>
												</div>										
								            </div>
									</div>
									<!-- .header-top-->
							    	<div class="main-nav-bar">
					    				<div class="col-md-12">
								                <div class="navbar-header navbar-right pull-left">
								                    <!-- offcanvas-trigger-effects -->
								                    <div id="offcanvas-trigger-effects" class="offcanvas">
								                        <button type="button" class="navbar-toggle visible-xs" data-toggle="offcanvas"
								                                data-target=".navbar-collapse" data-placement="left" data-effect="offcanvas-effect">
								                            <i class="fa fa-bars"></i>
								                        </button>
								                    </div>
								                    <!-- offcanvas-trigger-effects -->
								                </div>

								                <!-- navbar-collapse -->
								                <nav role="navigation" class="collapse navbar-collapse navbar main-nav">
												   <ul class="nav navbar-nav navbar-left">
												      <li><a href="/">Home</a></li>
												      <li><a href="/oxx/about.php">About Us</a></li>
												      <li class="dropdown"><a href="service.html">Services</a>
												      		<ul class="dropdown-menu">
																<li><a href="article-page.html">Water Heater</a></li>
																<li><a href="article-page.html">Bathroom</a></li>
																<li><a href="article-page.html">Toilet</a></li>
																<li><a href="article-page.html">Tube and Shower</a></li>
																<li><a href="article-page.html">Pipes and sweres</a></li>
																<li><a href="article-page.html">Drainage</a></li>
															</ul>
														</li>
												      
												      <li><a href="/oxx/contact.php">Contact Us</a></li>
												   
												    </ul>
								                    <!-- /navbar-nav -->

										            <div class="nav navbar-nav navbar-right" id="header-right">
														<div class="header-right">
														    <a href="/portaal"><i class="fa fa-lock"></i></a>

														</div>					            
											        </div>
								                </nav>
								                <!-- /navbar-collapse -->
						                </div>
								    </div>
								    <!-- .main-nav-bar -->
								</header>
								<!-- .header-wrapper-->
							</section>
							<!--End .header -->
						</div>
						<!-- .row-->
					</div>
					<!-- .container-->
					<div class="container-fluid">
						<section class="banner-section hidden-xs">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

							  <!-- Indicators -->
							  	<ol class="carousel-indicators">
							    	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							    	<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							    	<li data-target="#carousel-example-generic" data-slide-to="2"></li>
							  	</ol>

							  	<!-- Wrapper for slides -->
							  	<div class="carousel-inner" role="listbox">
								    <div class="item active">
								        <div style="width:100%;height:544px;background-image: url(/slides/<?php echo $slide1['foto'] ?>);background-size:cover;" ></div>
								      	
										<div class="carousel-caption">
											<h1><?php echo $slide1['titel'] ?></h1>
											<p><?php echo $slide1['Conclusie'] ?></p>
											<a class="btn" href="tel:<?php echo $seo['3']['waarde']?>">Bel nu</a>
										</div>
								    </div>
								    <div class="item">
								      	   <div style="width:100%;height:544px;background-image: url(/slides/<?php echo $slide2['foto'] ?>);background-size:cover;" ></div>
								      	<div class="carousel-caption">
											<h1><?php echo $slide2['titel'] ?></h1>
											<p><?php echo $slide2['Conclusie'] ?></p>
											<a class="btn" href="<?php echo $seo['3']['waarde']?>">Bel nu</a>
										</div>
								    </div>
								    <div class="item">
								      	   <div style="width:100%;height:544px;background-image: url(/slides/<?php echo $slide3['foto'] ?>);background-size:cover;" ></div>
								      	<div class="carousel-caption">
											<h1><?php echo $slide3['titel'] ?></h1>
											<p><?php echo $slide3['Conclusie'] ?></p>
											<a class="btn" href="<?php echo $seo['3']['waarde']?>">Bel nu</a>
										</div>
								    </div>
							  	</div>
							</div>
						</section>
						<!-- .banner-section-->
					</div>
					<!-- .container-fluid-->
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="welcome-section">
								  	<div class="welcome-thumb">
							      		<img src="/oxx/HTML/img/promo.jpg" alt="welkom foto" style="max-width:350px;">
								  	</div>
								  	<div class="welcome-content">
								    	<h3>Welkom</h3>
								    	   <?php echo  getPromo(); ?> 
								    	<a class="btn" href="/ox-missie.php">Verder lezen</a>
								  	</div>
								</div>
								<!-- .welcome-section-->
							</div>
							<!-- .col-md-12-->
						</div>
						<!-- .row-->
					</div>
					<!-- .container-->
					<div class="container">
						<div class="row">
								<div class="service-section">
										<div class="col-md-12">
										  	<!-- Nav tabs -->
										  	<ul class="tablist" role="tablist">
										  		<li>Onze Tools | Ontdek hoe wij het verschil maken.</li>
											  <!--  <li role="presentation" class="active"><a href="#residential" aria-controls="residential" role="tab" data-toggle="tab">Residential</a></li>
											    <li role="presentation"><a href="#commercial" aria-controls="commercial" role="tab" data-toggle="tab">Commercial</a></li>-->
										  	</ul>
										</div>
										
									  	<div class="tab-content">
										    <div role="tabpanel" class="tab-pane active" id="residential">
					
						<div class="row item active">
							<?php  
                        $cats=getCatogs();
                        foreach ($cats as &$cat) {
                                printCat($cat);
                        }  ?>
										    
									    	</div>
										    
									  	</div>
								</div>
								<!-- .service-section-->						
						</div>
						<!-- .row-->
					</div>
					<!-- .container-->
					<div class="container">
						<div class="service-activity">
							<div class="row">
								<div class="col-md-12">
									<div class="activity-head">
									    <h1>Sterktes</h1> 
										<h2>Waarom <span>u</span> ons wilt leren kennen</h2>
									</div>
								</div>
							</div>
							  <?php 
            $ctrl=new IndexController();
            $services=$ctrl->getSterk();
         ?>
							<div class="row">
								<div class="activity-list-items">
									<div class="col-md-4 col-xs-12 col-sm-4">
										<div class="activity-list">
											<div class="activity-icon">
												<i class="fa fa-star"></i>
											</div>
											<div class="activity-details">
												<h4><?php echo $services[0]['naam']?></h4>
												<p><?php echo $services[0]['omschrijving']?></p>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-4">
										<div class="activity-list">
											<div class="activity-icon">
												<i class="fa fa-star"></i>
											</div>
											<div class="activity-details">
												<h4><?php echo $services[1]['naam']?></h4>
												<p><?php echo $services[1]['omschrijving']?></p>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-xs-12 col-sm-4">
										<div class="activity-list">
											<div class="activity-icon">
												<i class="fa fa-trophy"></i>
											</div>
											<div class="activity-details">
												<h4><?php echo $services[2]['naam']?></h4>
												<p><?php echo $services[2]['omschrijving']?></p>
											</div>
										</div>
									</div>
								</div>
								<!-- .activity-list-items-->
							</div>
						</div>
						<!-- .service-activity-->
					</div>
					<!-- .container-->
					<div class="quote-section">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="quote">
										<h2 style="text-shadow: 1px 1px 0 #000">Stuur gerust een bericht.</h2>
										<p style="text-shadow: 1px 1px 0 #000">Aarzel niet we staan u graag te woord.</p>
										<a class="btn" href="/ox-contact.php">Contact</a>
									</div>
									<!--quote-->
								</div>
							</div>
							<!-- .row-->
						</div>
						<!-- .container-->
					</div>
					<!-- .quote-section-->
	<?php  
	                    $ctrl=new IndexController();
                       
    ?>                    
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="our-clients-carousel">
									<h2>GRATIS ONTWERPEN</h2>
<h3 style="margin-bottom:25px">Wij, bieden u de keuze uit een 9-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</h3 >
									<div id="our-client-thumb">
									    <?php
									  foreach( $services=$ctrl->getServicesPublished() as $service){
									     echo '
									        <div class="item">
									       
											<div class="client-logo">
											 <img src="/services/'.$service['foto'].'" style="max-width:75px;"/>   
											</div>
											<h4>'.$service['naam'].'</h4>
											 <a href="'.strtolower($service['naam']).'.php'.'" alt="Bezoek" class="btn">
									        Ontdek
									        </a>
										</div>
									     ';
									  }?>
									
									
								</div>								
								<!-- .our-clients-carousel-->
							</div>
						</div>
						<!-- .row -->						
					</div>
					<!-- .container-->
					<div class="container">
						<div class="row">
							<div class="footer-top">
								<div class="col-md-3 col-sm-6">
						            <div class="logo footer-logo">
						                <a title="fontanero" href="index.html">
						                    <img src="/gold/logo/logo.png" alt="Ons logo" style="width:25%">
						                </a>
						                <p><?php echo getKrijt(); ?></p>
						            </div>									
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="news list-group">
										<h4>Blog</h4>
										<ul>
											<li>
												<div class="news-list">
												    <?php 
												    $blogs=getNews();
												   
												    foreach($blogs as $blog){
												        echo ' <a href="">
													<span class="date">'.$blog['created'].'</span>
													<p>'.$blog['titel'].'</p>
													</a>';
												    }
												
													?>
												</div>
											</li>
										</ul>
									</div>									
								</div>
								<div class="col-md-3 col-sm-6">
															
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="contact-us">
										<h4>Contact us</h4>
										<address>
											<?php echo $seo['5']['waarde'].' '.$seo['6']['waarde'].' '.$seo['7']['waarde'].' '.$seo['8']['waarde'].' '.$seo['9']['waarde'] ?>
										</address>
										<address>
										 	<span>Email :</span> 
											<a href="<?php echo $seo['5']['waarde']?>"><?php echo $seo['5']['waarde']?></a> 
										</address>
										<address>
										 	<span>Phones :</span> 
											 <?php echo $seo['3']['waarde']?> <br>
											<br>
										</address>
									</div>									
								</div>
							</div>
							<!-- .footer-top-->
						</div>
						<!-- .row-->
						<div class="row">
							<div class="footer">
								<div class="col-md-6 col-xs-12 col-sm-6">
									<div class="copyright">
										<p>Copyright 2016. Webland.be inc. | Developed by <a href="https://webland.be">Webland</a></p>
									</div>
								</div>
								<div class="col-md-6 col-xs-12 col-sm-6">
									<div class="footer-social social">
										<ul>
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- .footer-->
						</div>
						<!-- .row-->
					</div>
					<!-- .container-->


				</div>
				<!--content-wrapper-->
			</div>
        	<!-- offcanvas-pusher -->

	        <div class="offcanvas-menu offcanvas-effect visible-xs">
	          <button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="off-canvas-close-btn">&times;</button>
	          <h1>fontanero sidebar Menu</h1>
	          <div>
	            <div>
		            <ul id="menu">
		              <li><a href="index.html">Home</a></li>
				      <li><a href="about.html">About us</a></li>
				      <li><a href="service.html">Services</a></li>
				      <li><a href="#">Products</a></li>
				      <li><a href="contact.html">Contact us</a></li>
				      <li><a href="contact.html">Quote</a></li>
		            </ul>
	            </div>
	          </div>
	        </div>
	        <!-- offcanvas-menu end -->			
		</div>
		<!-- #wrapper -->


		<!-- =========================================
		JAVASCRIPT
		========================================== -->

		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="/oxx/HTML/js/owl.carousel.min.js"></script>
		<script src="/oxx/HTML/js/hippo-off-canvas.js"></script>
		<script src="/oxx/HTML/js/script.js"></script>
		<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>


		
	</body>
	</html>