<?php session_start();
$path = getcwd();
$path=$path.'/';
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
    
    echo '<div class="col-md-4" style="">
                <div class="caption" style="background: #E0E0E0;">
                <div class="text-center" style="padding: 15px;">
                 <h3>'.$cat['naam'].'</h3>
                 </div>
                    <div class="snow-flake" style="background: url(/categ/'.$cat['foto'].');background-size: cover;"></div>
                   
                     <p style="color:black !important;padding: 15px;">';
                echo     $cat['omschrijving'];
                    
            echo    '</p>';
            echo '<div class="text-center" style="padding-bottom:10px;">';
            echo '<a style="background: transparent; border: 1px solid black;" class="btn btn-default" href="/shop/index.php?cat='.$cat['id'].'"> ONTDEK </a> </div>';

            
            echo '</div></div>';
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
    
    echo '
     <!-- =========================
                           Single Testimonial item
                        ============================== -->
                        <div class="item margin-bottom-small"> <!-- ITEM START -->
                        <h2>'.printStars($review['rating']).'</h2>
                            <p> '.$review['info'].'</p>
                            <div class="client margin-top-medium clearfix">
                                
                                <ul class="client-info main-color">
                                    <li><strong>'.$review['naam'].'</strong></li>
                                  
                                </ul>
                            </div>
                        </div> <!-- ITEM END -->

                        <!-- =========================
                           Single Testimonial item
                        ============================== -->
    
    ';

}

?>

<!doctype html>
<html class="no-js" lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta charset="utf-8">
	  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
 
    <meta name="author" content="Eoghain Verdonckt - Webland.be">

    <!-- =========================
       favicon and app touch icon
    ============================== -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- =========================
       Bootstrap and animation
    ============================== -->
    <link rel="stylesheet" href="/cancer/css/bootstrap.css">
    <link rel="stylesheet" href="/cancer/css/animate.min.css">

    <!-- =========================
       Fonts, typography and icons
    ============================== -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/cancer/css/font-awesome.css">
    <link rel="stylesheet" href="/cancer/css/typography.css">

    <!-- =========================
       Carousel, lightbox and circle generator
    ============================== -->
    <link rel="stylesheet" href="/cancer/css/owl.carousel.css">
    <link rel="stylesheet" href="/cancer/css/owl.theme.css">
    <link rel="stylesheet" href="/cancer/css/nivo-lightbox.css">
    <link rel="stylesheet" href="/cancer/css/nivo-lightbox-default.css">
    <link rel="stylesheet" href="/cancer/css/jquery.circliful.css">

    <!-- ***** Custom Stylesheet ***** -->
    <link rel="stylesheet" href="/cancer/css/main.css">

    <!-- ***** Responsive fixes ***** -->
    <link rel="stylesheet" href="/cancer/css/responsive.css">

    <!-- Header scripts -->
    <script src="/cancer/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="/cancer/js/queryloader2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
    <!-- =========================
       Preloader
    ============================== -->
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            "use strict";
            new QueryLoader2(document.querySelector("body"), {
                barColor: "#e74c3c",
                backgroundColor: "#111",
                percentage: true,
                barHeight: 1,
                minimumTime: 200,
                fadeOutTime: 1000
            });
        });
        var alert_color_success_background = '#e74c3c';
        var alert_color_error_background = '#CF000F';

    </script>
    <style>
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

		.krijt
		{
			vertical-align: middle;
			font-family: 'Permanent Marker', cursive;
			font-size: 1.6em;
			color: rgba(238, 238, 238, 0.7) !important;
			padding: 10px;
			min-height: 250px;
		}
		.krijt span{
		    color: white !important;
		}
		.snow-flake{
		  width:100%;
		  padding-bottom:60%;
		}
		.double-border{ 	
background-color: black;
    border: 2px solid black;
    padding: 0.5em;
    position: relative;
    margin: 0 auto;
}

.item{ 	
 background: #1a2428;
}
    </style>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- =========================
       Fullscreen menu
    ============================== -->
    <div class="mobilenav">
        <ul>
            <li data-rel="#header">
                <span class="nav-label">Home</span>
            </li>
            <li data-rel="#about-us">
                <span class="nav-label">About Us</span>
            </li>
            <li data-rel="#why-choose-us">
                <span class="nav-label">Why Choose Us</span>
            </li>
            <li data-rel="#our-team">
                <span class="nav-label">Our Team</span>
            </li>
            <li data-rel="#testimonial">
                <span class="nav-label">Testimonial</span>
            </li>
            <li data-rel="#portfolio">
                <span class="nav-label">Portfolio</span>
            </li>
            <li data-rel="#map">
                <span class="nav-label">Contact Us</span>
            </li>
        </ul>
    </div>  <!-- *** end Full Screen Menu *** -->

    <!-- *****  hamburger icon ***** -->
    <a href="javascript:void(0)" class="menu-trigger">
       <div class="hamburger">
         <div class="menui top-menu"></div>
         <div class="menui mid-menu"></div>
         <div class="menui bottom-menu"></div>
       </div>
    </a>


    <!-- =========================
       Header
    ============================== -->
    <header id="header">
        <div id="myCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              
            </ol>

            <!-- Wrapper for Slides -->
            <div class="carousel-inner">

                <!-- *****  Logo ***** -->
                <div class="logo-container">
                    <a href="#">
                        <img src="/logo.png" alt="foto van ons logo." style="width:50px;border-radius:50%;border:1px solid red;"  >
                    </a>
                </div>

                <!-- =========================
                   Header item 1
                ============================== -->
                <div class="item active">

                    <!-- Set the first background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('bussiness/slides/<?php echo $slide1['foto'] ?>');">
                    </div>
                    <div class="carousel-caption">
                        <h1 class="light mab-none"><?php echo $slide1['titel']; ?></h1>
                        
                        <p class="light margin-bottom-medium"><?php echo $slide1['Conclusie']; ?></p>
                        <div class="call-button">
                            <div class="row">
                               
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>

                <!-- =========================
                   Header item 2
                ============================== -->
                <div class="item">

                    <!-- Set the second background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('/slides/<?php echo $slide2['foto'] ?>');"></div>
                    <div class="carousel-caption">
                        <h1 class="light mab-none"><?php echo $slide2['titel']; ?></h1>
                        
                        <p class="light margin-bottom-medium"><?php echo $slide2['Conclusie']; ?></p>
                        <div class="call-button">
                            <div class="row">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>

                <!-- =========================
                   Header item 3
                ============================== -->
                <div class="item">

                    <!-- Set the third background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('/slides/<?php echo $slide3['foto'] ?>');"></div>
                    <div class="carousel-caption">
                        <h1 class="light mab-none"><?php echo $slide3['titel']; ?></h1>
                        
                        <p class="light margin-bottom-medium"><?php echo $slide3['Conclusie']; ?></p>
                        <div class="call-button">
                            <div class="row">
                              
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>
            </div> <!-- *** end wrapper *** -->

            <!-- Carousel Controls -->
            <a class="left carousel-control hidden-xs" href="#myCarousel" data-slide="prev">
                <span class="icon-prev icon-arrow-left"></span>
            </a>
            <a class="right carousel-control hidden-xs" href="#myCarousel" data-slide="next">
                <span class="icon-next icon-arrow-right"></span>
            </a>
        </div>
    </header> <!-- *** end Header *** -->


    <!-- =========================
       Call to action
    ============================== -->
    <section id="call-to-action" class="call-to-action main-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12 wow slideInLeft animated">
                    <p class="light-text">Ontdek hoe wij het verschil maken.</p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 button-container wow slideInRight animated">
                    <a href="/shop/" class="button light internal-link pull-left hvr-grow" data-rel="#portfolio">Bekijk</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section> <!-- *** end call-to-action *** -->


    <!-- =========================
       About Us
    ============================== -->
    <section id="about-us" class="about-us">
        <div class="overlay">
            <div class="container padding-top-large">
                <h2>
                    <strong class="bold-text">Over</strong>
                    <span class="light-text main-color">ons</span>
                </h2>
                <div class="line main-bg"></div>
                <div class="row margin-bottom-medium">
                    <div class="col-md-7">
                        <!--
                        <div class="jumbo-text light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
                            Schrijf hier een korte tekst.
                        </div>
                        -->
                    </div>
                    <div class="col-md-5">
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                <img src="img/about-side-side.png" alt="About Us Big Image" class="center-block img-responsive" style="float:right;width:50%;">
                <p class="margin-bottom-medium wow slideInUp">  
                    <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?> </p>
                <div class="row margin-top-large">
                    <div class="col-md-8">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            	  <?php 
                                    $ctrl=new IndexController();
                                    $services=$ctrl->getSterk();
                                    ?>
                            <!-- =========================
                               Collapsible Panel 1
                            ============================== -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <div class="panel-title">
                                        <a href="#collapseOne" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
                                            <span class="state"><strong>-</strong></span>
                                            <strong><?php echo $services[0]['naam']; ?></strong>
                                        </a>
                                    </div>
                                </div> <!-- *** end panel-heading *** -->
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <?php echo $services[0]['omschrijving']; ?>
                                    </div>
                                </div> <!-- *** end collapsed item *** -->
                            </div> <!-- *** end panel *** -->

                            <!-- =========================
                              Collapsible Panel 2
                            ============================== -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <div class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="state"><strong>+</strong></span>
                                            <strong><?php echo $services[1]['naam']; ?></strong>
                                        </a>
                                    </div>
                                </div> <!-- *** end panel-heading *** -->
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                       <?php echo $services[1]['omschrijving']; ?>
                                    </div>
                                </div> <!-- *** end collapsed item *** -->
                            </div> <!-- *** end panel *** -->
                            
                             <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <div class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="state"><strong>+</strong></span>
                                            <strong><?php echo $services[2]['naam']; ?></strong>
                                        </a>
                                    </div>
                                </div> <!-- *** end panel-heading *** -->
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                       <?php echo $services[2]['omschrijving']; ?>
                                    </div>
                                </div> <!-- *** end collapsed item *** -->
                            </div> <!-- *** end panel *** -->

                           
                        </div> <!-- *** end panel-group *** -->
                    </div> <!-- *** end col-md-8 *** -->
                    <div class="col-md-4">
                        <img src="luck.png" class="center-block img-responsive" alt="Case Study">
                    </div>
                </div>
                	<div class="row">
				<div class="blackboard" style="">
					<div class="krijt"><?php echo $ctrl->getkrijt();?></div>
				</div>
			</div>
            </div>
        </div>
    </section> <!-- *** end About Us *** -->




    <!-- =========================
       Our Skills
    ============================== -->
    <section id="our-skills" class="our-skills">
        <div class="container padding-top-large">
            <h2>
                Ontdek onze 
                <strong class="bold-text"></strong>
                <span class="light-text main-color">tools</span>
            </h2>
            <div class="line main-bg margin-bottom-medium"></div>
            <div class="row">
                <div class="col-md-7" id="carnaval">
                             <?php  
            $cats=getCatogs();
              if(is_array($cats)){
                    if(count($cats)>0){
                        foreach ($cats as &$cat) {
                            printCat($cat);
                        } 
                    }
                       
                    }
          ?>
                </div>
                <div class="col-md-5">
                    <img src="/cancer/img/skill-bg.jpg" class="center-block img-responsive" alt="Our Skills are excellent">
                </div>
                <div class="clearfix"></div>
            </div> <!-- *** end row *** -->
        </div> <!-- *** end container *** -->
    </section> <!-- *** end Our Skills *** -->




    <!-- =========================
       Testimonial
    ============================== -->
    <section id="testimonial" class="testimonial padding-large white-color text-center">
        <div class="container">
            <div class="row">
                <h2 class="margin-bottom-medium">Wat onze <strong class="bold-text">klanten</strong> zeggen over ons.</h2>
                <div class="col-md-10 col-md-offset-1">

                    <!-- *****  Carousel start ***** -->
                    <div id="testimonial-carousel" class="owl-carousel owl-theme testimonial-carousel">
                          <?php $reviews=getReviews($ctrl);?>
                  <?php 
      foreach ($reviews as &$value) {
            if($value['publish']==1){
                printReview($value);
            }
          
      }
      
      ?> 
                       

                       
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- *** end Testimonial *** -->


    <!-- =========================
       Promote
    ============================== -->
    <section id="promote" class="promote main-bg white-color">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-1 col-md-5 col-sm-4 text-center">
                    <p class="light-text">Models waar andere enkel van kunnen dromen.</p>
                </div>
                <div class="col-lg-6 col-lg-offset-1 col-md-7 col-sm-8 button-container">
                    <a href="/shop" class="button light hvr-grow">Ontdek</a>
                </div>
            </div>
        </div>
    </section> <!-- *** end promote *** -->


    <!-- =========================
       We are  hiring
    ============================== -->
    <section id="we-are-hiring" class="we-are-hiring">
        <div class="container padding-large">
            <div class="row">
                <div class="col-md-7 col-sm-6 wow fadeInLeft">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Gratis <span class="main-color bold-text">ontwerpen</span> </h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p class="margin-top-medium">Wij, bieden u de keuze uit een 7-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
                </div>
                <div class="col-md-5 col-sm-6 wow fadeInUp">
                      <div class="col-md-6" id="milkyWay">
	                    <div class="item">
	                        <a>
	                        <img src="virgo.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                    <div class="item">
	                        <a href="scorpio.php">
	                        <img src="scorpio.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                     <div class="item">
	                        <a href="/sagittarius.php">
	                        <img src="/services/service-2.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                       <div class="item">
	                        <a href="/aquarius.php">
	                        <img src="/services/service-3.jpg" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                        <div class="item">
	                        <a href="/pieces.php">
	                        <img src="/services/service-4.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                      <div class="item">
	                        <a href="/libra.php">
	                        <img src="/services/service-5.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                      <div class="item">
	                        <a href="/capricorn.php">
	                        <img src="/services/service-6.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                       <div class="item">
	                        <a href="/cancer.php">
	                        <img src="/services/service-9.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                     <div class="item">
	                        <a href="/ariers.php">
	                        <img src="/services/service-8.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                     <div class="item">
	                        <a href="/taurus.php">
	                        <img src="taurus.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                     <div class="item">
	                        <a href="/lion.php">
	                        <img src="leo.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                     <div class="item">
	                        <a href="/gemini.php">
	                        <img src="gemini.png" style="width:100%;"/>
	                        <div class="double-border text-center" style="width:25%; color:white;margin-top:-25px;">BEKIJK</div>
	                        </a>
	                    </div>
	                    
	                </div>
                </div>
            </div>
        </div>
         <div style="padding-top:100px;padding-left:25px;padding-right:25px;" class="text-center">
           <h2><span class="main-color bold-text">Online betalingen</span>  was nog nooit zo eenvoudig.</h2>
      <p style="color:black;">Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
      </div>
     
      <img src="mollie.png" style="width:100%;" alt="online betalen was nog nooit zo eenvoudig." />
    </section> <!-- *** end We Are Hiring *** -->




    <!-- =========================
       Map
    ============================== -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10003703.93002628!2d-4.89514483266907!3d52.255905864975766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1613b61426d85%3A0x52bed37ce3e8c65d!2sWebland%20Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1604050229893!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    <!-- =========================
       Send Message
    ============================== -->
    <section id="send-message" class="send-message main-bg white-color text-center">
        <div class="send-icon" data-toggle="modal" data-target="#contact-form">
            <i class="fa fa-paper-plane"></i>
        </div>
        <p class="light-text" data-toggle="modal" data-target="#contact-form">Heeft<span class="bold-text">u vragen</span>? Verstuur een <span class="bold-text">bericht</span ></p>

        <!-- Contact Form Modal -->
        <div class="modal fade contact-form" id="contact-form" tabindex="-1" role="dialog" aria-labelledby="contact-form" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-body">

                        <!-- *****  Contact form ***** -->
                        <form class="form" id="contact-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="first-name" placeholder="First name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="last-name" placeholder="Last name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" id="email" placeholder="Email address">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="project-name" placeholder="Project name">
                                </div>
                                <div class="form-group col-md-12 mab-none">
                                    <textarea rows="6" class="form-control" id="description" placeholder="Your project details and description ..."></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <button class="button bold-text main-bg"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- *** end modal-body *** -->
                </div> <!-- *** end modal-content *** -->
            </div> <!-- *** end modal-dialog *** -->
        </div> <!-- *** end Contact Form modal *** -->
    </section> <!-- *** end Send Message *** -->


    <!-- =========================
       Footer
    ============================== -->
    <footer id="footer" class="footer">
        <div class="container padding-large text-center">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <figure class="margin-bottom-medium">
                      <!--  <img src="" class="footer-logo" alt="">-->
                    </figure>
                    <p class="margin-bottom-medium"></p>
                     <p class="copyright">
                        &copy; Copyright 2017 Webland - All Rights reserved <a href="wevland.be">by webland</a>
                    </p>
                    <!-- =========================
                       Social icons
                    ============================== -->
                    <ul class="social margin-bottom-medium">
                        <li class="facebook hvr-pulse"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <!--
                        <li class="twitter hvr-pulse"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="g-plus hvr-pulse"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="linkedin hvr-pulse"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="youtube hvr-pulse"><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li class="instagram hvr-pulse"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="behance hvr-pulse"><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li class="dribbble hvr-pulse"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        -->
                    </ul>
                   
                </div>
            </div>
        </div>
    </footer> <!-- *** end Footer *** -->

    <!-- =========================
       Back to top button
    ============================== -->
    <div class="back-to-top" data-rel="header">
        <i class="icon-up"></i>
    </div>

    <!-- =========================
     JavaScripts
    ============================== -->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLx1ztXolcJQQbzir4Mrn709CdsNfpwdk&callback=initMap"
  type="text/javascript"></script>
    <script src="/cancer/js/vendor/jquery-1.11.1.js"></script>
    <script src="/cancer/js/vendor/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOsiOjjoOiFBmXLU0adNjsnCKLpcDfRyI"></script>
    <script src="/cancer/js/twitterFetcher_min.js"></script>
    <script src="/cancer/js/vendor/bootstrap.js"></script>
    <script src="/cancer/js/wow.min.js"></script>
    <script src="/cancer/js/imagesloaded.pkgd.min.js"></script>
    <script src="/cancer/js/jquery.easing.min.js"></script>
    <script src="/cancer/js/appear.js"></script>
    <script src="/cancer/js/jquery.circliful.min.js"></script>
    <script src="/cancer/js/owl.carousel.min.js"></script>
    <script src="/cancer/js/nivo-lightbox.min.js"></script>
    <script src="/cancer/js/isotope.pkgd.min.js"></script>
    <script src="/cancer/js/notie.js"></script>
    <script src="/cancer/js/main.js"></script>
    <script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
    <script>
    $('#carnaval').slick({
  dots: true,
  infinite: true,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 2,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
    $('#milkyWay').slick({
  dots: true,
  infinite: true,
  speed: 900,
  slidesToShow: 1,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
</body>
</html>
