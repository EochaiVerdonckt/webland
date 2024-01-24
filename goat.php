<?php session_start();


$path = getcwd();
$path = $path.'/';

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
function getProducts(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and publish=1 and removed=0 and star=1";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij, $row);
        }
    }
    $conn->close();
    return $rij;
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
function getCatogs(){
     $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `catog`";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    $extra1="";
    $extra="";
    if($_GET['sort'])
        {
            $extra1="&sort=".$_GET['sort'];
        }
    if($_GET['merk'])
    {
        $extra="&merk=".$_GET['merk'];
    }    
    $extra1=$extra1.$extra;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              
            $blauw="";  
            if($row['id']==$_GET['cat'])
            {
                $blauw= "blauw";
            }
            echo '
            <li class="menu-item"><a class="menu-link" href="/shop/index.php?cat='.$row['id'].$extra1.'"><div>'.$row['naam'].'</div></a></li>
            
            ';
            
            
        }
    } else {
       
    }
    $conn->close();
    return $rij;
}
function getProds(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$_GET['id'];
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}
function getItem($id){
     $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$id;
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}
function getPic($id){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `product_afbeelding` where item=".$id." ORDER BY created DESC";
    $picture=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($picture,$row['foto']);
        }
    }
    $conn->close();

    return $picture;
}

function getBlogs(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `news` where publish=1 ";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               array_push($rij,$row);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}

function getMerken(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `merk` ";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               array_push($rij,$row);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="nl">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Webland.be" />
	<title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description"  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/goat/css-goat/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="/goat/css-goat/style-goat.css" type="text/css" />
	<link rel="stylesheet" href="/goat/css-goat/dark.css" type="text/css" />
	<link rel="stylesheet" href="/goat/css-goat/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="/goat/css-goat/animate.css" type="text/css" />
	<link rel="stylesheet" href="/goat/css-goat/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="/goat/css-goat/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="/goat/include/rs-plugin/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/goat/include/rs-plugin/css/layers.css">
	<link rel="stylesheet" type="text/css" href="/goat/include/rs-plugin/css/navigation.css">

	<!-- Document Title
	============================================= -->
	<title>Home - Shop | Canvas</title>

	<style>

		.revo-slider-emphasis-text {
			font-size: 58px;
			font-weight: 700;
			letter-spacing: 1px;
			font-family: 'Poppins', sans-serif;
			padding: 15px 20px;
			border-top: 2px solid #FFF;
			border-bottom: 2px solid #FFF;
		}

		.revo-slider-desc-text {
			font-size: 20px;
			font-family: 'Lato', sans-serif;
			width: 650px;
			text-align: center;
			line-height: 1.5;
		}

		.revo-slider-caps-text {
			font-size: 16px;
			font-weight: 400;
			letter-spacing: 3px;
			font-family: 'Poppins', sans-serif;
		}

		.tp-video-play-button { display: none !important; }

		.tp-caption { white-space: nowrap; }
.blackboard {
			width: 640px;
			max-width:100%;
			margin: 7% auto;
			border: silver solid 12px;
			border-top: silver solid 12px;
			border-left: silver solid 12px;
			border-bottom: silver solid 12px;
			box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
			background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
			background-color: #333;

		}
.krijt{
			vertical-align: middle;
			font-family: 'Permanent Marker', cursive;
			font-size: 1.6em;
			color: rgba(238, 238, 238, 0.7);
			padding: 10px;
			min-height: 250px;
		}

.foto-title{
    background: rgba(0,0,0,0.8);
    color:white;
    text-align: center;
}
	</style>


</head>

<body class="stretched">
<script>


if (window.location.protocol == 'http:') {
     
    console.log("you are accessing us via "
        +  "an insecure protocol (HTTP). "
        + "Redirecting you to HTTPS.");
         
    window.location.href =
        window.location.href.replace(
                   'http:', 'https:');
}


</script>
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar">
			<div class="container">

				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-auto">
						<p class="mb-0 py-2 text-center text-md-start"><strong>Call:</strong> <?php echo $seo['3']['waarde'] ?> | <strong>Email:</strong> <?php echo $seo['4']['waarde'] ?></p>
					</div>

					<div class="col-12 col-md-auto">

						<!-- Top Links
						============================================= -->
						<div class="top-links on-click">
							<ul class="top-links-container">
                                <!--
								<li class="top-links-item"><a href="#">USD</a>
									<ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#">EUR</a></li>
										<li class="top-links-item"><a href="#">AUD</a></li>
										<li class="top-links-item"><a href="#">GBP</a></li>
									</ul>
								</li>

                                		<li class="top-links-item"><a href="#">EN</a>
									<ul class="top-links-sub-menu">
										<li class="top-links-item"><a href="#"><img src="images-goat/icons/flags/french.png" alt="French"> FR</a></li>
										<li class="top-links-item"><a href="#"><img src="images-goat/icons/flags/italian.png" alt="Italian"> IT</a></li>
										<li class="top-links-item"><a href="#"><img src="images-goat/icons/flags/german.png" alt="German"> DE</a></li>
									</ul>
								</li>
                                !-->
						
						
								</li>
							</ul>
						</div><!-- .top-links end -->
						<a href="#" class="social-icon si-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>
					</div>
				</div>

			</div>
		</div><!-- #top-bar end -->

		<?php //$ctrl->print_nav_goat(); ?>

	
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
				
					<div class="tabs topmargin-lg clearfix" id="tab-3">


						<div class="tab-container">

							<div class="tab-content" id="tabs-9">

								<div class="shop row gutter-30">
                                  
                                    <?php
                                    $products = getProducts();
                                  
                                    foreach($products as &$value){ ?>
                                         
                                           
                                           
                                        <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="grid-inner">
                                           
											<div class="product-image">
                                               <?php 
                                               $pics = getPic($value['id']);
   
												echo '<a href="#"><img src="producten/uploads/'.$pics[0].'" alt="'.$value['omschrijving'].'"></a>';
                                                if($pics[1]){
                                                    echo '<a href="#"><img src="producten/uploads/'.$pics[1].'" alt="'.$value['omschrijving'].'"></a>';
                                                }
												
                                                ?>
                                                <!--
												<div class="sale-flash badge bg-success p-2">50% Off*</div>
                                                -->
												<div class="bg-overlay">
													<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
														<a href="/shop/item.php?id=<?php echo $value['id'] ?>" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
														<a href="include/ajax/shop-item.php?id=<?php echo $value['id'] ?>" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
													</div>
													<div class="bg-overlay-bg bg-transparent"></div>
												</div>
              
											</div>
											<div class="product-desc">
												<div class="product-title"><h3><a href="#"><?php echo $value['naam']?></a></h3></div>
                                                <?php
                                                if($value['promo_prijs']>0){echo '<div class="product-price"><del>&#8364;'.$value['prijs'].'</del> <ins>&#8364;'.$value['promo_prijs'].'</ins></div>';}
												else{ 

                                                    echo '<div class="product-price"><del style="text-decoration: none;color: #1ABC9C;">&#8364;'.$value['prijs'].'</del></div>';
                                                }

                                                ?>
												<!--
                                                <div class="product-rating">
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star3"></i>
													<i class="icon-star-half-full"></i>
												</div>
                                                -->
											</div>
                              
										</div></div> 
                                    <?php } ?>
                            
								</div>

							</div>


						</div>

					</div>

					<div class="clear bottommargin-sm"></div>

					

					<div class="clear"></div>
					<div class="fancy-title title-border title-center topmargin-sm">
						<h4>Onze merken</h4>
					</div>

				

					<ul class="clients-grid grid-2 grid-sm-3 grid-md-6 mb-0">
						<?php foreach(getMerken() as $merk){
							echo '<li class="grid-item"><a>'.$merk['naam'].'</a> </li>';
						}?>
						
					</ul>
	
				</div>

				<div class="section mb-0">
					<div class="container">
						<?php 
						
							 $ctrl=new IndexController();
							 $sterktes=$ctrl->getSterk();
						  ?>
				
					</div>
				</div>

				
							</div>
						</div>

					</div>
				</div>
			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">
								<div class="row ">
								<div class="col-md-4">

									<div class="widget clearfix">

										
										<div style="background: url('/goat/images-goat/world-map.png') no-repeat center center; background-size: 100%;">
											<address>
												<strong>Adres:</strong><br>
												<?php echo $seo['5']['waarde']?><br>
												<br>
											</address>
											<abbr title="Phone Number"><strong>Phone:</strong></abbr> <?php echo $seo['3']['waarde']?><br>
											<br>
											<abbr title="Email Address"><strong>Email:</strong></abbr><?php echo $seo['4']['waarde']?>
                                            </div>
									</div>

								</div>
								<div class="col-md-4">

									<div class="widget clearfix">
										<h4>Over ons</h4>
                                        <?php echo $seo['1']['waarde']?>
									</div>

								</div>
								<div class="col-md-4">
									<div class="widget clearfix">
										<h4>Promoties</h4>
										<div style="color:white;">
                                        <?php $krijt=$ctrl->getKrijt();
                            		echo $krijt; ?>
									</div>
									</div>
							
								</div>
							</div>
						
					</div>
				</div><!-- .footer-widgets-wrap end -->
			</div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2501.896890243841!2d4.1457235!3d51.165690299999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c38e99b785664b%3A0x67efd5043d17fe2!2sAnkerstraat%2061%2C%209100%20Sint-Niklaas!5e0!3m2!1snl!2sbe!4v1703059079561!5m2!1snl!2sbe" width="1024" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container-fluid">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-start">
							Copyrights &copy; 2020 All Rights Reserved by <a href="https://webland.be">Webland</a>.<br>
							<div class="copyright-links"><a href="/terms.pdf">Terms of Use</a> / <a href="/privacy.pdf">Privacy Policy</a></div>
						</div>

						<div class="col-md-6 text-center text-md-end">
							<div class="d-flex justify-content-center justify-content-md-end">
								
							</div>

							<div class="clear"></div>

							
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="/goat/js-goat/jquery.js"></script>
	<script src="/goat/js-goat/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="/goat/js-goat/functions.js"></script>

	<!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
	<script src="/goat/include/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="/goat/include/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
	<script src="/goat/include/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>

	<script>

		var tpj=jQuery;
		tpj.noConflict();
		var $ = jQuery.noConflict();

		tpj(document).ready(function() {

			var apiRevoSlider = tpj('#rev_slider_ishop').show().revolution(
			{
				sliderType:"standard",
				jsFileLocation:"include/rs-plugin/js/",
				sliderLayout:"fullwidth",
				dottedOverlay:"none",
				delay:9000,
				navigation: {},
				responsiveLevels:[1200,992,768,480,320],
				gridwidth:1140,
				gridheight:500,
				lazyType:"none",
				shadow:0,
				spinner:"off",
				autoHeight:"off",
				disableProgressBar:"on",
				hideThumbsOnMobile:"off",
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				debugMode:false,
				fallbacks: {
					simplifyAll:"off",
					disableFocusListener:false,
				},
				navigation: {
					keyboardNavigation:"off",
					keyboard_direction: "horizontal",
					mouseScrollNavigation:"off",
					onHoverStop:"off",
					touch:{
						touchenabled:"on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					},
					arrows: {
						style: "ares",
						enable: true,
						hide_onmobile: false,
						hide_onleave: false,
						tmp: '<div class="tp-title-wrap">	<span class="tp-arr-titleholder">{{title}}</span> </div>',
						left: {
							h_align: "left",
							v_align: "center",
							h_offset: 10,
							v_offset: 0
						},
						right: {
							h_align: "right",
							v_align: "center",
							h_offset: 10,
							v_offset: 0
						}
					}
				}
			});

			apiRevoSlider.on("revolution.slide.onloaded",function (e) {
				SEMICOLON.slider.sliderDimensions();
			});

		}); //ready

	</script>

</body>
</html>