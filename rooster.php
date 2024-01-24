<?php session_start();
$path = getcwd();
$path = $path."/";
define ("FSPATH",$path);
require (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 
require (FSPATH."Controllers/indexController.php"); 
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
function printCat($cat){
    echo '
    
      <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-calendar4-week"></i></div>
              <h4 class="title"><a href="/shop/index.php?cat='.$cat['id'].'"">'.$cat['naam'].'</a></h4>
              <p class="description">';
                echo     $cat['omschrijving'];
              echo '</p>
            </div>
          </div>
    
    ';
}

function print_chat()
	{
	    echo '

	    <div style=" position:fixed;right:5px; bottom: 0;z-index:999999;">
<div onclick="showChat()" id="chatbox" class="btn-info btn" style="border-color: black; background-color: black;">  <p style="color:white;"><i class="fa fa-commenting-o fa-2x"></i><span style="padding-left:8px;">Chat</span></p></div>
</div>
<div  id="chatBox" style="float:right;display:none; position:fixed;right:1%; bottom: 0;    z-index: 999999;">
	<div class"btn btn-block btn-info" style="border-color: black; background-color:black;color:white;"><i class="fa fa-times" style="    padding-left: 90%;" onclick="hideChat()"></i></div>
<div class="fb-page" data-href="https://www.facebook.com/webland.belgie/" data-tabs="messages" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
</div>
<script>
    function showChat() {
        document.getElementById("chatBox").style.display="initial" ;
    }
    function hideChat() {
        document.getElementById("chatBox").style.display="none" ;
    }
</script>
';
}


function getPromo()
{

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

function getKrijt()
{

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

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

function getService1()
{

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

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

function getService2()
{

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();
    $sql = "SELECT promo FROM promo_balance where id=3";
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

function getServices()
{

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

    $sql = "SELECT * FROM services";
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

function getSterk()
{

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

    $sql = "SELECT * FROM sterk order by id";
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


function getHours()
{
$ctrl=new IndexController();
$conn = $ctrl->getConnection();
    $sql = "SELECT * FROM hours";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    }
    else{
        echo "Uurrooster niet gevonden";
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
                    <div style="color: white!important;font-size:1.5em;">
                      '.$review['info'].'
                    <h3 style="float:right;color: white!important;margin-top:8px;">-'.$review['naam'].'-</h3>
                    
                    </div>';
            echo '</div></div>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>WEBLAND | Bij ons betaalt u niet teveel!</title>
  <meta content="Websites die u zelf kan aanpassen online in 7dagen." name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/rooster/assets/img/favicon.png" rel="icon">
  <link href="/rooster/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/rooster/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/rooster/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/rooster/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/rooster/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/rooster/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/rooster/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/rooster/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/rooster/assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:baas@webland.be">baas@webland.be</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>0485/865.970</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <!--<a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
       
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>-->
         <a href="https://www.facebook.com/webland.belgie/" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/webland_belgie/" class="instagram"><i class="bi bi-instagram"></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="/">Webland.be</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="testimonials.html">Testimonials</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(/slides/service-1.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2><?php echo  $slide1['titel']; ?></h2>
              <p><?php echo  $slide1['Conclusie']; ?></p>
              <div class="text-center"><a href="tel:0485865970" class="btn-get-started">0485/865.970</a></div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(/slides/service-2.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2><?php echo  $slide2['titel']; ?></h2>
              <p><?php echo  $slide2['Conclusie']; ?></p>
              <div class="text-center"><a href="tel:0485865970" class="btn-get-started">0485/865.970</a></div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(/slides/service-3.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2><?php echo  $slide3['titel']; ?></h2>
              <p><?php echo  $slide3['Conclusie']; ?></p>
              <div class="text-center"><a href="tel:0485865970" class="btn-get-started">0485/865.970</a></div>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3>Welkom bij uw IT <span>oplossing</span></h3>
            <p>Wij, bieden u de keuze uit een 15-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="/rooster/about.html">Informatie</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="row">
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
            <!--
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><a href="">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bi bi-binoculars"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bi bi-brightness-high"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-calendar4-week"></i></div>
              <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
              <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
          </div>
          -->
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
              <!--
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>-->
          </div>
        </div>
  <?php $services=$ctrl->getServicesPublished(); ?>
        <div class="row portfolio-container" data-aos="fade-up">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="/services/<?php echo $services[0]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[0]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
             
              <a href="https://webland.be/virgo.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[1]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[1]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
            
              <a href="https://webland.be/sagittarius.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="/services/<?php echo $services[2]['foto'];?>" class="img-fluid" alt="" style="width:100%;">
            <div class="portfolio-info">
              <h4><?php echo $services[2]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
           
              <a href="https://webland.be/aquarius.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="/services/<?php echo $services[3]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[3]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
          
              <a href="https://webland.be/pieces.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[4]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[4]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
         
              <a href="https://webland.be/libra.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="/services/<?php echo $services[5]['foto'];?>"  class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[5]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
      
              <a href="https://webland.be/capricorn.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="/services/<?php echo $services[6]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[6]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
             
              <a href="https://webland.be/scorpio.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="/services/<?php echo $services[7]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[7]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
       
              <a href="https://webland.be/ariers.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[8]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[8]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
         
              <a href="https://webland.be/cancer.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[9]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[9]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
          
              <a href="https://webland.be/lion.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[10]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[10]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
            
              <a href="https://webland.be/taurus.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
           <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[11]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[11]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
      
              <a href="https://webland.be/gemini.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[12]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[12]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
              <a href="/rooster/assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="https://webland.be/ophiuchus.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
         
         
         
          
          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="/services/<?php echo $services[13]['foto'];?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $services[13]['naam'];?></h4>
              <p>Eenvoudig in gebruik en aanpasbaar.</p>
            
              <a href="https://webland.be/rabbit.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Online betalen. Nog nooit zo <strong>eenvoudig</strong>.</h2>
          <p>Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.

Zo ontvangt u dagelijks meteen alle opbrengsten van uw website meteen op uw rekening.</p>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

        </div>

      </div>
    </section><!-- End Our Clients Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Webland</h3>
            <p>
              Waversebaan <br>
              3000 Leuven<br>
              Belgie <br><br>
              <strong>Phone:</strong>0485/865.970<br>
              <strong>Email:</strong> baas@webland.be<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Laatste nieuws</h4>
            <?php echo getKrijt(); ?>
            <!--
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>-->
          </div>
<!--
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>
-->
          <div class="col-lg-4 col-md-6 footer-newsletter">
      
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Webland.be</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
       
         
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
  
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/rooster/assets/vendor/aos/aos.js"></script>
  <script src="/rooster/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/rooster/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/rooster/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/rooster/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/rooster/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/rooster/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/rooster/assets/js/main.js"></script>

</body>

</html>