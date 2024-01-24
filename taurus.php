<?php 
 session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
require (FSPATH."Controllers/slidesController.php"); 
$ctrl=new IndexController();
$services=$ctrl->getServicesPublished();
$seo=$ctrl->getSeo();
$ctrl=new SlidesController();

$slide1=$ctrl->getSlide(1);
$slide2=$ctrl->getSlide(2);
$slide3=$ctrl->getSlide(3);


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
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title><?php echo $seo['0']['waarde']?></title>
    <meta property="og:description" 
    content="<?php echo $seo['1']['waarde']?>" />
    <meta name="description" content="<?php echo $seo['1']['waarde']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/taurus/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/taurus/css/style.css" type="text/css">
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
			color: rgba(238, 238, 238, 0.7);
			padding: 10px;
			min-height: 250px;
		}
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="canvas-search search-switch">
            <i class="fa fa-search"></i>
        </div>
        <nav class="canvas-menu mobile-menu">
            <ul>
                <li><a href="./index.html">Home</a></li>
                <li><a href="./about-us.html">About Us</a></li>
                <li><a href="./classes.html">Classes</a></li>
                <li><a href="./services.html">Services</a></li>
                <li><a href="./team.html">Our Team</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="./about-us.html">About us</a></li>
                        <li><a href="./class-timetable.html">Classes timetable</a></li>
                        <li><a href="./bmi-calculator.html">Bmi calculate</a></li>
                        <li><a href="./team.html">Our team</a></li>
                        <li><a href="./gallery.html">Gallery</a></li>
                        <li><a href="./blog.html">Our blog</a></li>
                        <li><a href="./404.html">404</a></li>
                    </ul>
                </li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="canvas-social">
            <a href="https://www.facebook.com/webland.belgie"><i class="fa fa-facebook"></i></a>
          
            <a href="https://www.instagram.com/webland_belgie/"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="/logo.png" alt="" style="width:20%;border-radius:50%;border:1px solid orange;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="nav-menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a class="page-scroll" href="/" >HOME</a></li>
                            <li><a class="page-scroll" href="/missie.php" >MISSIE</a></li>
                            <li><a class="page-scroll"  href=" /fotopagina/">FOTOPAGINA</a></li>
                          
<li><a class="page-scroll"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li style="padding-left: 0;"><a class="page-scroll"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/vragen.php" id="contactA">Q&A</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
                           
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="top-option">
                        <div class="to-search search-switch">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="to-social">
                            <a href=https://www.facebook.com/webland.belgie><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/webland_belgie/"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas-open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hs-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="/slides/<?php echo $slide1['foto'] ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="hi-text">
                                <span><?php echo $seo['0']['waarde']?></span>
                                <?php
                                
                                $slide1=$ctrl->getSlide(1);
                                ?>
                                <h1><?php
                                $words = explode(' ', $slide1['titel']);
                                $start=$words[0];
                                $second=$words[1];
                                unset($words[0]);
                                unset($words[1]);
                                $words = array_values($words);
                                $words=implode($words);
                                $titel=$start." <strong>".$second."</strong> ".$words;
                                echo  $titel; 
                                ?></h1>
                                <a href="tel:0485865970" class="primary-btn">BEL NU</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Banner Section Begin -->
    <section style="background:white;" class="banner-section set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text">
                        <h2 style="color:black;margin-top:150px;">Welkom</h2>
                        <div class="bt-tips">  <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?> </div>
                       
                    </div>
                </div>
            </div>
                    <?php 
        $ctrl=new IndexController();
        if($ctrl->getKrijtVlag()==1)
        {
        ?>
        
        <div class="row">
				<div class="blackboard" style="">
					<div class="krijt">
					    <?php
                            $krijt=$ctrl->getKrijt();
                            echo $krijt; 
					    ?>
					</div>
				</div>
			</div>
		</div>	
		<?php
        }
        $ctrl->print_chat();
		?>
        </div>
    </section>
    <!-- Banner Section End -->
    <!-- ChoseUs Section Begin -->
    <section class="choseus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <div class="text-center">
                               <img src="luck.png" />
                        </div>
                        <span>Waarom u moet kiezen voor ons?</span>
                        <h2>STERKTES</h2>
                    </div>
                </div>
            </div>
            	  <?php 
            $ctrl=new IndexController();
            $sterktes=$ctrl->getSterk();
         ?>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-045-boxing-gloves"></span>
                        <h4><?php echo $sterktes[0]['naam'];?></h4>
                        <?php echo $sterktes[0]['omschrijving'];?>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-045-boxing-gloves"></span>
                        <h4><?php echo $sterktes[1]['naam'];?></h4>
                        <?php echo $sterktes[0]['omschrijving'];?>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-002-dumbell"></span>
                        <h4><?php echo $sterktes[2]['naam'];?></h4>
                        <?php echo $sterktes[2]['omschrijving'];?>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-045-boxing-gloves"></span>
                        <h4><?php echo $sterktes[3]['naam'];?></h4>
                       <?php echo $sterktes[3]['omschrijving'];?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->

    <!-- Classes Section Begin -->
    <section class="classes-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Tools</span>
                        <h2>Ontdek hoe we het verschil maken.</h2>
                    </div>
                </div>
            </div>
              <?php  
                        $cats=getCatogs();
                 ?>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="/categ/<?php echo $cats[0]['foto']; ?>" alt="">
                        </div>
                        <div class="ci-text">
                            <span><?php echo $cats[0]['naam']; ?></span>
                            <h5><?php echo $cats[0]['omschrijving']; ?></h5>
                            <a href="/shop/index.php?cat=<?php echo $cats[0]['id']; ?>"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="/categ/<?php echo $cats[1]['foto']; ?>" alt="">
                        </div>
                        <div class="ci-text">
                            <span><?php echo $cats[1]['naam']; ?></span>
                            <h5><?php echo $cats[1]['omschrijving']; ?></h5>
                            <a href="/shop/index.php?cat=<?php echo $cats[1]['id']; ?>"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="/categ/<?php echo $cats[2]['foto']; ?>" alt="">
                        </div>
                        <div class="ci-text">
                            <span><?php echo $cats[2]['naam']; ?></span>
                            <h5><?php echo $cats[2]['omschrijving']; ?></h5>
                            <a href="/shop/index.php?cat=<?php echo $cats[2]['id']; ?>"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="/categ/<?php echo $cats[3]['foto']; ?>" alt="">
                        </div>
                        <div class="ci-text">
                            <span><?php echo $cats[3]['naam']; ?></span>
                            <h4><?php echo $cats[3]['omschrijving']; ?></h4>
                            <a href="/shop/index.php?cat=<?php echo $cats[3]['id']; ?>"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="class-item">
                        <div class="ci-pic">
                            <img src="/categ/<?php echo $cats[4]['foto']; ?>" alt="">
                        </div>
                        <div class="ci-text">
                            <span><?php echo $cats[4]['naam']; ?></span>
                            <h4><?php echo $cats[4]['omschrijving']; ?></h4>
                            <a href="/shop/index.php?cat=<?php echo $cats[4]['id']; ?>"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->


    <!-- Gallery Section Begin -->
    <div class="gallery-section">
        <div class="gallery">
            <div class="grid-sizer"></div>
            <div class="gs-item grid-wide set-bg" data-setbg="/taurus/img/gallery/gallery-1.jpg">
                <a href="/taurus/img/gallery/gallery-1.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/taurus/img/gallery/gallery-2.jpg">
                <a href="/taurus/img/gallery/gallery-2.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/taurus/img/gallery/gallery-3.jpg">
                <a href="/taurus/img/gallery/gallery-3.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/taurus/img/gallery/gallery-4.jpg">
                <a href="/taurus/img/gallery/gallery-4.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/taurus/img/gallery/gallery-5.jpg">
                <a href="/taurus/img/gallery/gallery-5.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item grid-wide set-bg" data-setbg="/taurus/img/gallery/gallery-6.jpg">
                <a href="/taurus/img/gallery/gallery-6.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
        </div>
    </div>
    <!-- Gallery Section End -->

    <!-- Team Section Begin -->
    <section class="team-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-title">
                        <div class="section-title">
                            <span>MODULES</span>
                            <h2>SOFTWARE DIE PAS ECHT HET VERSCHIL MAAKT</h2>
                        </div>
                        <a href="/shop/" class="primary-btn btn-normal appoinment-btn">BEKIJK</a>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="section-title">
                <h1 style="color:white;">GRATIS ONTWERPEN</h1>
                <span>Wij, bieden u de keuze uit een 7-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</span>
                </div>
            </div>
            <div class="row">
                <div class="ts-slider owl-carousel">
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/virgo.png">
                            <div class="ts_text">
                                <h4>VIRGO</h4>
                                <a href="/"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/scorpio.png">
                            <div class="ts_text">
                                <h4>SCORPIO</h4>
                                <a href="/scorpio.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/sagittarius.png">
                            <div class="ts_text">
                                <h4>sagittarius</h4>
                                <a href="/sagittarius.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/services/service-3.jpg">
                            <div class="ts_text">
                                <h4>aquarius</h4>
                                 <a href="/aquarius.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/services/service-4.png">
                            <div class="ts_text">
                                <h4>pices</h4>
                               <a href="/pices.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/services/service-5.png">
                            <div class="ts_text">
                                <h4>libra</h4>
                                 <a href="/libra.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/services/service-6.png">
                            <div class="ts_text">
                                <h4>capricorn</h4>
                                 <a href="/capricorn.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/services/service-8.png">
                            <div class="ts_text">
                                <h4>ariers</h4>
                                 <a href="/ariers.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/services/service-9.png">
                            <div class="ts_text">
                                <h4>cancer</h4>
                                 <a href="/cancer.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/gemini.png">
                            <div class="ts_text">
                                <h4>GEMINI</h4>
                                 <a href="/gemini.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/leo.png">
                            <div class="ts_text">
                                <h4>LION</h4>
                                 <a href="/lion.php"><span>BEKIJK</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Get In Touch Section Begin -->
    <div class="gettouch-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-map-marker"></i>
                        <p>Waversesteenweg<br/> 3000 Leuven</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-mobile"></i>
                        <ul>
                            <li>0485/865.970</li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text email">
                        <i class="fa fa-envelope"></i>
                        <p>info@webland.be</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Get In Touch Section End -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10003703.93002628!2d-4.89514483266907!3d52.255905864975766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1613b61426d85%3A0x52bed37ce3e8c65d!2sWebland%20Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1604050229893!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    <!-- Footer Section Begin -->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="fs-about">
                     
                        <p>Uw website online in 7 dagen.</p>
                        <div class="fa-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa  fa-envelope-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="copyright-text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |by <a href="https://webland.be" target="_blank">Webland</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="/taurus/js/jquery-3.3.1.min.js"></script>
    <script src="/taurus/js/bootstrap.min.js"></script>
    <script src="/taurus/js/jquery.magnific-popup.min.js"></script>
    <script src="/taurus/js/masonry.pkgd.min.js"></script>
    <script src="/taurus/js/jquery.barfiller.js"></script>
    <script src="/taurus/js/jquery.slicknav.js"></script>
    <script src="/taurus/js/owl.carousel.min.js"></script>
    <script src="/taurus/js/main.js"></script>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>

</body>

</html>