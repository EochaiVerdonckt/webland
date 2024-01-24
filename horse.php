<?php session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 
require (FSPATH."Controllers/indexController.php"); 
$ctrl=new SlidesController();
$slide1=$ctrl->getSlide(1);
$slide2=$ctrl->getSlide(2);
$slide3=$ctrl->getSlide(3);
$ctrl=new IndexController();
$seo=$ctrl->getSeo();
$services=$ctrl->getServicesPublished();

function toonLijstEten(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $rij = array();

    $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1  AND id!=112 ORDER by sort";

    $result = mysqli_query($conn, $sql);

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
function getPromo(){
    $rij = array();
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();

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
    echo '<div class="item">
                <div class="text-center"><h2>'.printStars($review['rating']).'</h2></div>
                <div class="caption" >
                    <div style="color: black!important;font-size:1.5em;">
                      '.$review['info'].'
                    <h3 style="float:right;color: black!important;margin-top:8px;">-'.$review['naam'].'-</h3>
                    
                    </div>';
            echo '</div></div>';
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
    echo '	<div class="col-md-3 col-sm-6 single-pricing-wrap center animated" data-animation="bounceInLeft" data-animation-delay="500">
					<div class="single-pricing">
					<div class="snow-flake" style="background: url(/categ/'.$cat['foto'].');background-size: cover;"></div>
						<div class="pricing-head">
							<h4 class="pricing-heading color-scheme">'.$cat['naam'].'</h4>
						
						</div>
					<div class="single-pricing-info">	
					 '.$cat['omschrijving'].'
					 </div>
						<div class="sign-up">
							<a  href="/shop/index.php?cat='.$cat['id'].'" id="basis"  class="fancy-button button-line btn-col zoom" >
								Ontdek
								<span class="icon">
									<i class="fa fa-arrow-right"></i>
								</span>
							</a>
						</div>
					</div>
				</div>';
 
}
function getVragen(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM vragen";
    $result = mysqli_query($conn, $sql);
    $items=array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           array_push($items,$row);
           
        }
    }
    mysqli_close($conn);
    return $items;
}
function getBlogs($ctrl){
   return $ctrl->selectStatement('news',1);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Webland - Uw website online in 7 dagen.</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Construction Company Website Template" name="keywords">
        <meta content="Construction Company Website Template" name="description">

        <!-- Favicon -->
        <link href="/horse/img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="/horse/lib/flaticon/font/flaticon.css" rel="stylesheet"> 
        <link href="/horse/lib/animate/animate.min.css" rel="stylesheet">
        <link href="/horse/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="/horse/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="/horse/lib/slick/slick.css" rel="stylesheet">
        <link href="/horse/lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/horse/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <!-- Top Bar Start -->
            <div class="top-bar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12">
                            <div class="logo">
                                <a href="index.php">
                                    <h1>Webland</h1>
                                    <!-- <img src="img/logo.jpg" alt="Logo"> -->
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 d-none d-lg-block">
                            <div class="row">
                                <div class="col-4">
                                    <div class="top-bar-item">
                                        <div class="top-bar-icon">
                                            <i class="flaticon-calendar"></i>
                                        </div>
                                        <div class="top-bar-text">
                                            <h3>Openingsuren</h3>
                                            <p>Mon - Fri, enkel op afspraak</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="top-bar-item">
                                        <div class="top-bar-icon">
                                            <i class="flaticon-call"></i>
                                        </div>
                                        <div class="top-bar-text">
                                            <h3>Call Us</h3>
                                            <p>+32485.865.970</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="top-bar-item">
                                        <div class="top-bar-icon">
                                            <i class="flaticon-send-mail"></i>
                                        </div>
                                        <div class="top-bar-text">
                                            <h3>Email Us</h3>
                                            <p>info@webland.be</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->

            <!-- Nav Bar Start -->
            <div class="nav-bar">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                        <a href="#" class="navbar-brand">MENU</a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto">
                                <a href="index.html" class="nav-item nav-link active">Home</a>
                                <a href="about.html" class="nav-item nav-link">About</a>
                                <a href="service.html" class="nav-item nav-link">Service</a>
                                <a href="team.html" class="nav-item nav-link">Team</a>
                                <a href="portfolio.html" class="nav-item nav-link">Project</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu">
                                        <a href="blog.html" class="dropdown-item">Blog Page</a>
                                        <a href="single.html" class="dropdown-item">Single Page</a>
                                    </div>
                                </div>
                                <a href="contact.html" class="nav-item nav-link">Contact</a>
                            </div>
                            <div class="ml-auto">
                                <a class="btn" href="#">Offerte</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Nav Bar End -->


            <!-- Carousel Start -->
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/horse/img/carousel-1.jpg" alt="Carousel Image">
                        <div class="carousel-caption">
                            <p class="animated fadeInRight">Webland Horse editie</p>
                            <h1 class="animated fadeInLeft">Voor de bouwers</h1>
                            <a class="btn animated fadeInUp" href="/offerte.php">Vrijblijvende offerte</a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="/horse/img/carousel-2.jpg" alt="Carousel Image">
                        <div class="carousel-caption">
                            <p class="animated fadeInRight">Webland Horse editie</p>
                            <h1 class="animated fadeInLeft">Voor de werkmannen</h1>
                            <a class="btn animated fadeInUp" href="/offerte.php">Vrijblijvende offerte</a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="/horse/img/carousel-3.jpg" alt="Carousel Image">
                        <div class="carousel-caption">
                            <p class="animated fadeInRight">Webland Horse editie</p>
                            <h1 class="animated fadeInLeft">Voor de vakmannen</h1>
                            <a class="btn animated fadeInUp" href="/offerte.php">Vrijblijvende offerte</a>
                        </div>
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Carousel End -->


            <!-- Feature Start-->
            <div class="feature wow fadeInUp" data-wow-delay="0.1s">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="flaticon-worker"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Makkelijk aanpasbaar</h3>
                                    <p>ERP, CMS, CMR zegt u niks maar u heeft meteen alle knopkes die u nodig heeft.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="flaticon-building"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Alles wat u nodig heeft</h3>
                                    <p>Uw klanten beheren, facturen maken, online agenda het zit in ons pakket.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="flaticon-call"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>24/7 gerust</h3>
                                    <p>Altijd online en een volle agenda, wij doen de rest.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feature End-->


            <!-- About Start -->
            <div class="about wow fadeInUp" data-wow-delay="0.1s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-6">
                            <div class="about-img">
                                <img src="/horse/img/about.jpg" alt="Image">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="section-header text-left">
                                <p>Welkom bij Webland</p>
                                <h2>Horse editie</h2>
                            </div>
                            <div class="about-text">
                              <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?>  
                                <a class="btn" href="tel:0485865970">Bel nu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About End -->


            <!-- Fact Start -->
            <div class="fact">
                <div class="container-fluid">
                    <div class="row counters">
                        <div class="col-md-6 fact-left wow slideInLeft">
                            <div class="row">
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-worker"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">365</h2>
                                        <p>Dagen online</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-building"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">52</h2>
                                        <p>Weken per jaar online</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 fact-right wow slideInRight">
                            <div class="row">
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-address"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">12</h2>
                                        <p>Maanden per jaar</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-crane"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">86400</h2>
                                        <p>Seconde per jaar online</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fact End -->


            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Our Services</p>
                        <h2>Uw bedrijf in uw broekzak</h2>
                        <?php $cats=getCatogs(); ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="/horse/img/service-1.jpg" alt="Image">
                                    <div class="service-overlay">
                                      <?php echo $cats[0]['omschrijving']; ?>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3><?php echo $cats[0]['naam']; ?></h3>
                                    <a class="btn" href="/horse/img/service-1.jpg" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="/horse/img/service-2.jpg" alt="Image">
                                    <div class="service-overlay">
                                        <?php echo $cats[1]['omschrijving']; ?>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3><?php echo $cats[1]['naam']; ?></h3>
                                    <a class="btn" href="/horse/img/service-2.jpg" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="/horse/img/service-3.jpg" alt="Image">
                                    <div class="service-overlay">
                                         <?php echo $cats[2]['omschrijving']; ?>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3> <?php echo $cats[2]['naam']; ?></h3>
                                    <a class="btn" href="/horse/img/service-3.jpg" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="/horse/img/service-4.jpg" alt="Image">
                                    <div class="service-overlay">
                                       <?php echo $cats[3]['omschrijving']; ?>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3> <?php echo $cats[3]['naam']; ?></h3>
                                    <a class="btn" href="/horse/img/service-4.jpg" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="/horse/img/service-5.jpg" alt="Image">
                                    <div class="service-overlay">
                                         <?php echo $cats[4]['omschrijving']; ?>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3><?php echo $cats[4]['naam']; ?></h3>
                                    <a class="btn" href="/horse/img/service-5.jpg" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="/horse/img/service-6.jpg" alt="Image">
                                    <div class="service-overlay">
                                      <?php echo $cats[5]['omschrijving']; ?>
                                    </div>
                                </div>
                                <div class="service-text">
                                    <h3><?php echo $cats[5]['naam']; ?></h3>
                                    <a class="btn" href="/horse/img/service-6.jpg" data-lightbox="service">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Service End -->


            <!-- Video Start -->
            <div class="video wow fadeIn" data-wow-delay="0.1s">
                <div class="container">
                    <button type="button" class="btn-play" data-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>        
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video End -->


            <!-- Team Start -->
            <div class="team">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Onze ontwerpen</p>
                        <h2>eenvoudig aanpasbaar</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="/virgo.png" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Virgo</h2>
                                    <p>Voor zij die het commercieel zien.</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href="/virgo.php"><i class="fab fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="/scorpio.png" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Scorpio</h2>
                                    <p>Simpel maar sterk</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href=""><i class="fab fa-plus"></i></a>
                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="/sagittarius.png" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Sagittarius</h2>
                                    <p>Mooi en makkelijk in gebruik</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href="/sagittarius.php"><i class="fab fa-plus"></i></a>
  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="/services/service-3.jpg" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2>Aquarius</h2>
                                    <p>Een eye catcher</p>
                                </div>
                                <div class="team-social">
                                    <a class="social-tw" href="aquarius.php"><i class="fab fa-plus"></i></a>
                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team End -->
            

            <!-- FAQs Start -->
            <div class="faqs">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Frequently Asked Question</p>
                        <h2>Vraag gerust.</h2>
                    </div>
                    <div class="row">
                        <?php $vragen= getVragen(); ?>
                         <div class="col-md-6">
                            <div id="accordion-1">
                                <div class="card wow fadeInLeft" data-wow-delay="0.1s">
                                    <div class="card-header">
                                        <?php 
                                                 echo '<div class="votes-box" style="float:left;">';     
            echo '<a class="btn btn-success" href="upQ.php?id='.$vragen[0]['id'].'" style="background: transparent;border:0;"><i style="color:#5cb85c;float:left;" class="fa fa-arrow-up"></i></a>';
            echo '<div>';
            echo '<a class="btn btn-danger" href="downQ.php?id='.$vragen[0]['id'].'" style="background: transparent;border:0;"><i style="color: #d9534f;" class="fa fa-arrow-down"></i></a>';
            echo '</div></div>'; ?>
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne">
                                            
                                            <?php
                                      
                                            
                                            echo $vragen[0]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                              <?php
                                           
                                         echo '  <span class="badge badge-success" style="margin: 5px;background: green;">'.$vragen[0]['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$vragen[0]['nega'].'</span>';
                                              if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$vragen[0]['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
         ?>
                                          <?php echo $vragen[0]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.2s">
                                    <div class="card-header">
                                             <?php 
                                                 echo '<div class="votes-box" style="float:left;">';     
            echo '<a class="btn btn-success" href="upQ.php?id='.$vragen[1]['id'].'" style="background: transparent;border:0;"><i style="color:#5cb85c;float:left;" class="fa fa-arrow-up"></i></a>';
            echo '<div>';
            echo '<a class="btn btn-danger" href="downQ.php?id='.$vragen[1]['id'].'" style="background: transparent;border:0;"><i style="color: #d9534f;" class="fa fa-arrow-down"></i></a>';
            echo '</div></div>'; ?>
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseTwo">
                                            <?php echo $vragen[1]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                           <?php
                                        
                                           
                                         echo '  <span class="badge badge-success" style="margin: 5px;background: green;">'.$vragen[1]['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$vragen[1]['nega'].'</span>';
                                              if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$vragen[1]['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
   
                                           
                                           echo $vragen[1]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.3s">
                                    <div class="card-header">
                                             <?php 
                                                 echo '<div class="votes-box" style="float:left;">';     
            echo '<a class="btn btn-success" href="upQ.php?id='.$vragen[2]['id'].'" style="background: transparent;border:0;"><i style="color:#5cb85c;float:left;" class="fa fa-arrow-up"></i></a>';
            echo '<div>';
            echo '<a class="btn btn-danger" href="downQ.php?id='.$vragen[2]['id'].'" style="background: transparent;border:0;"><i style="color: #d9534f;" class="fa fa-arrow-down"></i></a>';
            echo '</div></div>'; ?>
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseThree">
                                           <?php echo $vragen[2]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                         <?php
                                      
                                         echo '  <span class="badge badge-success" style="margin: 5px;background: green;">'.$vragen[2]['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$vragen[2]['nega'].'</span>';
                                              if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$vragen[2]['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
                                         
                                         echo $vragen[2]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="width:100%; text-align:center;">
                                <a class="btn btn-success" style="background: transparent;color:black;" href="/ruben.php">STEL UW VRAAG</a>
                                </div>
                                <!--
                                <div class="card wow fadeInLeft" data-wow-delay="0.4s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFour">
                                            <?php echo $vragen[3]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            <?php
                                            
                                              echo '  <span class="badge badge-success" style="margin: 5px;background: green;">'.$vragen[3]['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$vragen[3]['nega'].'</span>';
                                              if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$vragen[3]['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
                          
                                            
                                            echo $vragen[3]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.5s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFive">
                                           <?php echo $vragen[4]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                        <?php
                                            
                                              echo '  <span class="badge badge-success" style="margin: 5px;background: green;">'.$vragen[4]['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$vragen[4]['nega'].'</span>';
                                              if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$vragen[4]['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
                                        
                                        echo $vragen[4]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div id="accordion-2">
                                <img src="/zaken.png" style="width:100%;    margin-bottom: -95px;" />
                            </div>
                            <!--
                            <div id="accordion-2">
                                <div class="card wow fadeInRight" data-wow-delay="0.1s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseSix">
                                          <?php echo $vragen[5]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseSix" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                           <?php
                                       
                                              echo '  <span class="badge badge-success" style="margin: 5px;background: green;">'.$vragen[4]['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$vragen[4]['nega'].'</span>';
                                              if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$vragen[4]['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
                         
                                           
                                           echo $vragen[5]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.2s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseSeven">
                                           <?php echo $vragen[6]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseSeven" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                           <?php echo $vragen[6]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseEight">
                                            <?php echo $vragen[7]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseEight" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                            <?php echo $vragen[7]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.4s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseNine">
                                           <?php echo $vragen[8]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseNine" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                           <?php echo $vragen[8]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInRight" data-wow-delay="0.5s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseTen">
                                            <?php echo $vragen[9]['vraag'] ?>
                                        </a>
                                    </div>
                                    <div id="collapseTen" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                           <?php echo $vragen[9]['antw'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQs End -->


            <!-- Testimonial Start -->
            <div class="testimonial wow fadeIn" data-wow-delay="0.1s">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="testimonial-slider-nav">
                                <div class="slider-nav"><img src="/horse/img/testimonial-1.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-2.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-3.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-4.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-1.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-2.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-3.jpg" alt="Testimonial"></div>
                                <div class="slider-nav"><img src="/horse/img/testimonial-4.jpg" alt="Testimonial"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php $reviews = getReviews($ctrl); ?>
                            <div class="testimonial-slider">
                                <div class="slider-item">
                                    <h3><?php echo $reviews[0]['naam']?></h3>
                                    <h4>Tevreden klant</h4>
                                    <p><?php echo $reviews[0]['info']?></p>
                                </div>
                                <div class="slider-item">
                                    <h3><?php echo $reviews[1]['naam']?></h3>
                                    <h4>Tevreden klant</h4>
                                    <p><?php echo $reviews[1]['info']?></p>
                                </div>
                                <div class="slider-item">
                                    <h3><?php echo $reviews[2]['naam']?></h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3><?php echo $reviews[3]['naam']?></h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3><?php echo $reviews[4]['naam']?></h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3><?php echo $reviews[5]['naam']?></h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3><?php echo $reviews[6]['naam']?></h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                                <div class="slider-item">
                                    <h3>Customer Name</h3>
                                    <h4>profession</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial End -->


            <!-- Blog Start -->
            <div class="blog">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Latest Blog</p>
                        <h2>Latest From Our Blog</h2>
                    </div>
                    <?php $blogs = getBlogs($ctrl); ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="/horse/img/blog-1.jpg" alt="Image">
                                </div>
                                <div class="blog-title">
                                    <h3><?php echo $blogs[0]['titel'] ?></h3>
                                    <a class="btn" href="">+</a>
                                </div>
                                <div class="blog-meta">
                                    <p>By<a href="">Admin</a></p>
                                    <p>In<a href="">Construction</a></p>
                                </div>
                                <div class="blog-text">
                                    <p>
                                      <?php echo $blogs[0]['inleiding'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="/horse/img/blog-2.jpg" alt="Image">
                                </div>
                                <div class="blog-title">
                                    <h3><?php echo $blogs[1]['titel'] ?></h3>
                                    <a class="btn" href="">+</a>
                                </div>
                                <div class="blog-meta">
                                    <p>By<a href="">Admin</a></p>
                                    <p>In<a href="">Construction</a></p>
                                </div>
                                <div class="blog-text">
                                    <p>
                                         <?php echo $blogs[1]['inleiding'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="/horse/img/blog-3.jpg" alt="Image">
                                </div>
                                <div class="blog-title">
                                   <h3><?php echo $blogs[2]['titel'] ?></h3>
                                    <a class="btn" href="">+</a>
                                </div>
                                <div class="blog-meta">
                                    <p>By<a href="">Admin</a></p>
                                    <p>In<a href="">Construction</a></p>
                                </div>
                                <div class="blog-text">
                                    <p>
                                         <?php echo $blogs[2]['inleiding'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog End -->


            <!-- Footer Start -->
            <div class="footer wow fadeIn" data-wow-delay="0.3s">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-contact">
                                <h2>Office Contact</h2>
                                <p><i class="fa fa-map-marker-alt"></i>Waversebaan, 3000 Leuven</p>
                                <p><i class="fa fa-phone-alt"></i>+32485/865.970</p>
                                <p><i class="fa fa-envelope"></i>info@webland.be</p>
                                <div class="footer-social">
                                  
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <!--
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                      <a href=""><i class="fab fa-twitter"></i></a>
                                      -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Services Areas</h2>
                                <a href="">Building Construction</a>
                                <a href="">House Renovation</a>
                                <a href="">Architecture Design</a>
                                <a href="">Interior Design</a>
                                <a href="">Painting</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2>Useful Pages</h2>
                                <a href="">About Us</a>
                                <a href="">Contact Us</a>
                                <a href="">Our Team</a>
                                <a href="">Projects</a>
                                <a href="">Testimonial</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <!--
                            <div class="newsletter">
                                <h2>Newsletter</h2>
                                <p>
                                    Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulpu
                                </p>
                                <div class="form">
                                    <input class="form-control" placeholder="Email here">
                                    <button class="btn">Submit</button>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
                <div class="container footer-menu">
                    <div class="f-menu">
                        <a href="">Terms of use</a>
                        <a href="">Privacy policy</a>
                        <a href="">Cookies</a>
                        <a href="">Help</a>
                        <a href="">FQAs</a>
                    </div>
                </div>
                <div class="container copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; <a href="#">WOS HORSE EDITION</a>, All Right Reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p>Developed By <a href="https://webland.be">Webland.be</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="/horse/lib/easing/easing.min.js"></script>
        <script src="/horse/lib/wow/wow.min.js"></script>
        <script src="/horse/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="/horse/lib/isotope/isotope.pkgd.min.js"></script>
        <script src="/horse/lib/lightbox/js/lightbox.min.js"></script>
        <script src="/horse/lib/waypoints/waypoints.min.js"></script>
        <script src="/horse/lib/counterup/counterup.min.js"></script>
        <script src="/horse/lib/slick/slick.min.js"></script>

        <!-- Template Javascript -->
        <script src="/horse/js/main.js"></script>
    </body>
</html>
