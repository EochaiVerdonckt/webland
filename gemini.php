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
$cats = $ctrl->getCatogs();
$blogs= $ctrl->getBlogs();
$services= $ctrl->getServicesPublished();

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
      <div class="testimonial-item">
      <div class="text-center"><h2>'.printStars($review['rating']).'</h2></div>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
               '.$review['info'].'
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            
            <h3>'.$review['naam'].'</h3>
            <h4>Tevreden klant</h4>
      </div>';
}

?>


<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
  <!-- Favicons -->
  <link href="/gemini/img/favicon.png" rel="icon">
  <link href="/gemini/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/gemini/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/gemini/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/gemini/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/gemini/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/gemini/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/gemini/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
  <link href="/gemini/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/gemini/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/gemini/vendor/aos/aos.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
  <!-- Template Main CSS File -->
  <link href="/gemini/css/style.css" rel="stylesheet">
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
.krijt{
			vertical-align: middle;
			font-family: 'Permanent Marker', cursive;
			font-size: 1.6em;
			color: rgba(238, 238, 238, 0.7);
			padding: 10px;
			min-height: 250px;
		}
.snow-flake	{
		width:100%;
		padding-bottom:60%;
		}
		
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="/"><?php echo $seo['0']['waarde']?></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="/">Home</a></li>
         
						<li class="scroll"><a href="#about-us">Info</a></li> 
						<li class="scroll"><a href="#services">Ontwerpen</a></li> 
						<li class="scroll"><a href="/shop">Tools</a></li> 
						<li class="scroll"><a href="/missie.php">Mission</a></li> 
						<li class="scroll"><a href="#clients">Reviews</a></li> 
						<li class="scroll"><a href="/blog.php">Blog</a></li>
						<li class="scroll"><a href="/vragen.php">q&A</a></li>
						<li class="scroll"><a href="#contact">Contact</a></li> 
						<li class="scroll"><a href="/portaal">Admin</a></li> 
						<li class="scroll"><a href="/GDPR.pdf">GDPR</a></li> 
          

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"><?php echo $slide1['titel'] ?></h2>
          <p class="animate__animated fanimate__adeInUp"><?php echo $slide1['Conclusie'] ?></p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Ontdek</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"><?php echo $slide2['titel'] ?></h2>
          <p class="animate__animated animate__fadeInUp"><?php echo $slide2['Conclusie'] ?></p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Ontdek</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"><?php echo $slide3['titel'] ?></h2>
          <p class="animate__animated animate__fadeInUp"><?php echo $slide3['Conclusie'] ?></p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Ontdek</a>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>About</h2>
          <p>Over ons</p>
        </div>

        <div class="row content" data-aos="fade-up">
          <div class="col-lg-6">
           	  <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?>  
           
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
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

      </div>
    </section><!-- End About Section -->
 <?php 
            $ctrl=new IndexController();
            $sterktes=$ctrl->getSterk();
         ?>
    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-3" data-aos="zoom-in">
            <a class="nav-link active show" data-toggle="tab" href="#tab-1">
              <i class="ri-sun-line"></i>
              <h4 class="d-none d-lg-block"><?php echo $sterktes[0]['naam'] ?></h4>
            </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="100">
            <a class="nav-link" data-toggle="tab" href="#tab-2">
              <i class="ri-sun-line"></i>
              <h4 class="d-none d-lg-block"><?php echo $sterktes[1]['naam'] ?></h4>
            </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="200">
            <a class="nav-link" data-toggle="tab" href="#tab-3">
              <i class="ri-sun-line"></i>
              <h4 class="d-none d-lg-block"><?php echo $sterktes[2]['naam'] ?></h4>
            </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="300">
            <a class="nav-link" data-toggle="tab" href="#tab-4">
              <i class="ri-sun-line"></i>
              <h4 class="d-none d-lg-block"><?php echo $sterktes[3]['naam'] ?></h4>
            </a>
          </li>
        </ul>

        <div class="tab-content" data-aos="fade-up">
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                	<?php echo $sterktes[0]['omschrijving'] ?>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/gemini/img/features-1.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                	<?php echo $sterktes[1]['omschrijving'] ?>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/gemini/img/features-2.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                	<?php echo $sterktes[2]['omschrijving'] ?>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/gemini/img/features-3.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
               	<?php echo $sterktes[3]['omschrijving'] ?>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="/gemini/img/features-4.png" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="row" data-aos="zoom-out">
          <div class="col-lg-9 text-center text-lg-left">
            <h3>Digitale tools</h3>
            <p> Bij webland krijgt u niet enkel een website maar ook de kans om facturen te maken, uw stock te beheren. Kortom toegang tot alles wat u nodig heeft op digitaal vlak oml op een efficiГ«nte digitale manier van uw idee een groot succes te maken.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="/shop/">Ontdek</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Enkel een website?</h2>
          <p>Wij bieden u.</p>
        </div>
            <?php  
            $cats=getCatogs();
            ?>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="las la-basketball-ball" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="/shop/index.php?cat='<?php echo $cats[0]['id']; ?>'"><?php echo $cats[0]['naam']; ?></a></h4>
              <p class="description"><?php echo $cats[0]['omschrijving']; ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="100">
              <div class="icon"><i class="las la-book" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="/shop/index.php?cat='<?php echo $cats[1]['id']; ?>'"><?php echo $cats[1]['naam']; ?></a></h4>
              <p class="description"><?php echo $cats[1]['omschrijving']; ?></p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 ">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="200">
              <div class="icon"><i class="las la-file-alt" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="/shop/index.php?cat='<?php echo $cats[2]['id']; ?>'"><?php echo $cats[2]['naam']; ?></a></h4>
              <p class="description"><?php echo $cats[2]['omschrijving']; ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="300">
              <div class="icon"><i class="las la-tachometer-alt" style="color:#41cf2e;"></i></div>
              <h4 class="title"><a href=""><?php echo $cats[3]['naam']; ?></a></h4>
              <p class="description"><?php echo $cats[3]['omschrijving']; ?></p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="400">
              <div class="icon"><i class="las la-globe-americas" style="color: #d6ff22;"></i></div>
              <h4 class="title"><a href="/shop/index.php?cat='<?php echo $cats[4]['id']; ?>'"><?php echo $cats[4]['naam']; ?></a></h4>
              <p class="description"><?php echo $cats[4]['omschrijving']; ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="500">
              <div class="icon"><i class="las la-clock" style="color: #4680ff;"></i></div>
              <h4 class="title"><a href="/shop/index.php?cat='<?php echo $cats[5]['id']; ?>'"><?php echo $cats[5]['naam']; ?></a></h4>
              <p class="description"><?php echo $cats[5]['omschrijving']; ?></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
      
        </div>

   

        <div class="row portfolio-container" data-aos="fade-up">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="/gemini/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Webland</h4>
              <p>Werkt perfect op elk apparaat.</p>
              </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="/gemini/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Webland</h4>
              <p>Is zeer eenvoudig om mee te werken.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="/gemini/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Webland</h4>
              <p>Werkt in de cloud.</p>
              </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="/gemini/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Webland</h4>
              <p>Uw bedrijf in je broekzak.</p>
             
            </div>
          </div>

        

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="/taurus/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Webland</h4>
               <p>Maakt je idee realiteit</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="/gemini/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Webland</h4>
              <p>Maakt zelf als aanpassen mogelijk.</p>
             </div>
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Testimonials</h2>
          <p>Wat klanten zeggen over ons</p>
        </div>
 <?php $reviews=getReviews($ctrl);?>
        <div class="owl-carousel testimonials-carousel" data-aos="fade-up">
            <?php
foreach ($reviews as &$value) {
            if($value['publish']==1){
                printReview($value);
            }
          
      }
      
      ?> 
         

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Gratis</h2>
          <p>Ontwerpen</p>
        </div>

        <div class="row">
         <p style="color:white;font-size:1.2em;">Wij, bieden u de keuze uit een 10-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
           <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[0]['naam'];?></h3>
               <img src="/services/<?php echo $services[0]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
           <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[1]['naam'];?></h3>
               <img src="/services/<?php echo $services[1]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[1]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[2]['naam'];?></h3>
               <img src="/services/<?php echo $services[2]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[2]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
      <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[3]['naam'];?></h3>
               <img src="/services/<?php echo $services[3]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[3]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div> 
        
                 <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[4]['naam'];?></h3>
               <img src="/services/<?php echo $services[4]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[4]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[5]['naam'];?></h3>
               <img src="/services/<?php echo $services[5]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[5]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[6]['naam'];?></h3>
               <img src="/services/<?php echo $services[6]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[6]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[7]['naam'];?></h3>
               <img src="/services/<?php echo $services[7]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[7]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
             
          <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[8]['naam'];?></h3>
               <img src="/services/<?php echo $services[8]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[8]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
        <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[9]['naam'];?></h3>
               <img src="/services/<?php echo $services[9]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[9]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
        <div class="col-lg-3 col-md-3">
            <div class="box" data-aos="zoom-in">
              <h3><?php echo $services[10]['naam'];?></h3>
               <img src="/services/<?php echo $services[10]['foto'];?>" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="/<?php echo $services[10]['naam'];?>.php" class="btn-buy">Bekijk</a>
              </div>
            </div>
          </div>
           <div class="col-lg-3 col-md-3 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="300">
              <span class="advanced">ACTIVE</span>
              <h3>Gemini</h3>
              <img src="gemini.png" style="width: 100%;"/>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">BEKIJK</a>
              </div>
            </div>
          </div>
</div>
        </div>
      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>ONLINE BETALEN</h2>
          <p>Eenvoudiger als ooit.</p>
        </div>
        <p>Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
        

      </div>
    </section><!-- End F.A.Q Section -->
    <img src="/mollie.png" style="width:100%;" />
    <!-- ======= Team Section ======= -->
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Contact</h2>
          <p>Stuur een bericht.</p>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4" data-aos="fade-right">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Adres:</h4>
                <p>Waversesteenweg 3000 Leuven</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>info@webland.be</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Gsm:</h4>
                <p>0485 86 59 70</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Webland</h3>
      <p>Prullen beu? Uw website online in 7 dagen.</p>
      <div class="social-links">
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Webland</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
  <script src="/gemini/vendor/jquery/jquery.min.js"></script>
  <script src="/gemini/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/gemini/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/gemini/vendor/php-email-form/validate.js"></script>
  <script src="/gemini/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/gemini/vendor/venobox/venobox.min.js"></script>
  <script src="/gemini/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/gemini/vendor/aos/aos.js"></script>
  	<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/gemini/js/main.js"></script>
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