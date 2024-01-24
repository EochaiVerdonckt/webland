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
       <div class="row">
          <div class="col-md-9">
            <div class="quote">
              <b><img src="ophiuchus/assets/img/quote_sign_left.png" alt=""></b>   '.$review['info'].' <small><img src="ophiuchus//assets/img/quote_sign_right.png" alt=""></small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="profile">
              <div class="pic"><img src="ophiuchus/assets/img/client-2.jpg" alt=""></div>
              <h4>'.$review['naam'].'</h4>
              <span>'.printStars($review['rating']).'</span>
            </div>
          </div>
        </div>
    
    ';
  
}
function getSlides($ctrl){
   return $ctrl->selectStatement('slides');
}
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



$slides = getSlides($ctrl);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/ophiuchus/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/ophiuchus/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/ophiuchus/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/ophiuchus/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/ophiuchus/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/ophiuchus/assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" style="background-image: url('/slides/<?php echo $slides[0]['foto']?>')">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <img class="" style="width:15%;" src="/logo-trans.png" alt="Het Webland logo. ">
        </div>

        <h1>Welkom</h1>
        <h2><span class="typed" data-typed-items="<?php echo $slides[0]['titel']?>, <?php echo $slides[1]['titel']?>, <?php echo $slides[2]['titel']?>"></span></h2>
        <div class="actions">
          <a href="#about" class="btn-get-started">Info</a>
          <a href="#services" class="btn-services">Our Services</a>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>
      <!-- Uncomment below if you prefer to use a text logo -->
      <!-- <h1 class="logo mr-auto"><a href="index.html">Imperial</a></h1> -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/" >HOME</a></li>
          <li><a class="nav-link scrollto" href="/missie.php" >MISSIE</a></li>
          <li><a class="nav-link scrollto"  href=" /fotopagina/">FOTOPAGINA</a></li>
          <li class="dropdown"><a href="#"><span>Tools</span> <i class="bi bi-chevron-down"></i></a>
            <ul> <?php 
                      $cats = $ctrl->getCatogs();
                    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid black;"> <a class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                   } ?>
            </ul>
          </li>
           <li class="dropdown"><a href="#"><span>Blogs</span> <i class="bi bi-chevron-down"></i></a>
           <ul>
          <?php
           $blogs= $ctrl->getBlogs();
             foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="detail.php?id='.$value['id'].'"style="color:black;padding:8px;">'.$value['titel'].'</a></div>';
            } ?>
              </ul>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">About Us</h3>
            <div class="section-title-divider"></div>
            <p class="section-description"><?php echo $seo['1']['waarde']?></p>
          </div>
        </div>
      </div>
      <div class="container about-container wow fadeInUp">
        <div class="row">

          <div class="col-lg-6 about-img">
            <img src="/slides/<?php echo $slides[1]['foto']?>" alt="">
          </div>

          <div class="col-md-6 about-content">
             <?php echo  getPromo(); ?> 
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">TOOLS</h3>
            <div class="section-title-divider"></div>
            <p class="section-description">Alles wat u nodig heeft.</p>
          </div>
        </div>
        <?php   $cats=getCatogs(); ?>
        <div class="row">
          <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[0]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[0]['omschrijving'] ?></p>
          </div>
          <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-card-checklist"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[1]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[1]['omschrijving'] ?></p>
          </div>
          <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-bar-chart"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[2]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[2]['omschrijving'] ?></p>
          </div>
          <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-binoculars"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[3]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[3]['omschrijving'] ?></p>
          </div>
          <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-brightness-high"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[4]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[4]['omschrijving'] ?></p>
          </div>
          <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[5]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[5]['omschrijving'] ?></p>
          </div>
            <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[6]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[6]['omschrijving'] ?></p>
          </div>
            <div class="col-lg-4 col-md-6 service-item">
            <div class="service-icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="service-title"><a href=""><?php echo $cats[7]['naam'] ?></a></h4>
            <p class="service-description"><?php echo $cats[7]['omschrijving'] ?></p>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Subscrbe Section ======= -->
    <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-8">
            <h3 class="subscribe-title">Ontdek Hoe Wij Het Verschil Kunnen Maken.</h3>
            <p class="subscribe-text">Alle tools die u nodig heeft. </p>
          </div>
          <div class="col-md-4 subscribe-btn-container">
            <a class="subscribe-btn" href="/shop">Bekijk</a>
          </div>
        </div>
      </div>
    </section><!-- End Subscrbe Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Ontwerpen</h3>
            <div class="section-title-divider"></div>
            <p class="section-description">Wij, bieden u de keuze uit een 9-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
          </div>
        </div>

        <div class="row">
            <!--
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>-->
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              
            <img src="/gemini.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Gemini</h4>
             
              <a href="/gemini.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bi bi-plus"></i></a>
              <a href="/gemini.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

           <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              
            <img src="/leo.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Leo</h4>
             
              <a href="/leo.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bi bi-plus"></i></a>
              <a href="/leo.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="/virgo.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Virgo</h4>
              
              <a href="/virgo.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bi bi-plus"></i></a>
              <a href="/virgo.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="/scorpio.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Scorpio</h4>
             
              <a href="/scorpio.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bi bi-plus"></i></a>
              <a href="/scorpio.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/sagittarius.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>sagittarius</h4>
           
              <a href="/sagittarius.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bi bi-plus"></i></a>
              <a href="/sagittarius.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="/services/service-3.jpg" class="img-fluid" alt="" style="width: 100%;">
            <div class="portfolio-info">
              <h4>aquarius</h4>
            
              <a href="/aquarius.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bi bi-plus"></i></a>
              <a href="/aquarius.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="/services/service-4.png" style="width:100%;" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Pieces</h4>
              <a href="/pieces.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bi bi-plus"></i></a>
              <a href="/pieces.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="/services/service-5.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Libra</h4>
            
              <a href="/libra.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bi bi-plus"></i></a>
              <a href="/libra.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/service-6.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Capricorn</h4>
            
              <a href="/capricorn.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bi bi-plus"></i></a>
              <a href="/capricorn.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>
          
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/service-9.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Cancer</h4>
            
              <a href="/cancer.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bi bi-plus"></i></a>
              <a href="/cancer.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>
          
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/service-8.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Ariers</h4>
            
              <a href="/ariers.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bi bi-plus"></i></a>
              <a href="/ariers.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>
          
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/taurus.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Taurus</h4>
            
              <a href="/taurus.php" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bi bi-plus"></i></a>
              <a href="/taurus.php" class="details-link" title="More Details"><i class="bi bi-link"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10003703.93002628!2d-4.89514483266907!3d52.255905864975766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1613b61426d85%3A0x52bed37ce3e8c65d!2sWebland%20Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1604050229893!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Testimonials</h3>
            <div class="section-title-divider"></div>
            <p class="section-description">Wat onze klanten u al kunnen vertellen.</p>
          </div>
        </div>

    
  -
            
                 <?php $reviews=getReviews($ctrl);
            foreach ($reviews as &$value) {
            if($value['publish']==1){
                printReview($value);
            }
          
      } ?>
         

     

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= 
    <section id="team">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Our Team</h3>
            <div class="section-title-divider"></div>
            <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-1.jpg" alt=""></div>
              <h4>Walter White</h4>
              <span>Chief Executive Officer</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-2.jpg" alt=""></div>
              <h4>Sarah Jhinson</h4>
              <span>Product Manager</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-3.jpg" alt=""></div>
              <h4>William Anderson</h4>
              <span>CTO</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-4.jpg" alt=""></div>
              <h4>Amanda Jepson</h4>
              <span>Accountant</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact">
      <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Contact Us</h3>
            <div class="section-title-divider"></div>
            <p class="section-description">Stuur gerust een bericht.</p>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-3 col-md-4">
            <div class="info">
              <div>
                <i class="bi bi-geo-alt"></i>
                <p>Waversebaan 3000 <br>Leuven</p>
              </div>

              <div>
                <i class="bi bi-envelope"></i>
                <p>info@webland.com</p>
              </div>

              <div>
                <i class="bi bi-phone"></i>
                <p>+32485/865.970</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-8">
            <div class="form">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="form-group mt-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            &copy; Copyright <strong>Ophiuchus version</strong>. All Rights Reserved
          </div>
          <div class="credits">
         
            Designed by <a href="https://webland.be/">Webland</a>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/ophiuchus/assets/vendor/aos/aos.js"></script>
  <script src="/ophiuchus/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/ophiuchus/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/ophiuchus/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/ophiuchus/assets/vendor/php-email-form/validate.js"></script>
  <script src="/ophiuchus/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/ophiuchus/assets/vendor/typed.js/typed.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/ophiuchus/assets/js/main.js"></script>

</body>

</html>