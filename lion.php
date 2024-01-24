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
  <link href="/lion/assets/img/favicon.png" rel="icon">
  <link href="/lion/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/lion/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/lion/assets/vendor/aos/aos.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/font5/css/fontawesome.min.css">

  <!-- Template Main CSS File -->
  <link href="/lion/assets/css/style.css" rel="stylesheet">
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
		

/*--------------------------------------------------------------
# Book A Table
--------------------------------------------------------------*/
.book-a-table .php-email-form2 {
  width: 100%;
}

.book-a-table .php-email-form2 .form-group {
  padding-bottom: 8px;
}

.book-a-table .php-email-form2 .validate {
  display: none;
  color: red;
  margin: 0 0 15px 0;
  font-weight: 400;
  font-size: 13px;
}

.book-a-table .php-email-form2 .error-message {
  display: none;
  color: #fff;
  background: #ed3c0d;
  text-align: left;
  padding: 15px;
  font-weight: 600;
}

.book-a-table .php-email-form2 .error-message br + br {
  margin-top: 25px;
}

.book-a-table .php-email-form2 .sent-message {
  display: none;
  color: #fff;
  background: #18d26e;
  text-align: center;
  padding: 15px;
  font-weight: 600;
}

.book-a-table .php-email-form2 .loading {
  display: none;
  text-align: center;
  padding: 15px;
}

.book-a-table .php-email-form2 .loading:before {
  content: "";
  display: inline-block;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  margin: 0 10px -6px 0;
  border: 3px solid #cda45e;
  border-top-color: #1a1814;
  -webkit-animation: animate-loading 1s linear infinite;
  animation: animate-loading 1s linear infinite;
}

.book-a-table .php-email-form2 input, .book-a-table .php-email-form2 textarea {
  border-radius: 0;
  box-shadow: none;
  font-size: 14px;
  background: #0c0b09;
  border-color: #625b4b;
  color: white;
}

.book-a-table .php-email-form2 input::-webkit-input-placeholder, .book-a-table .php-email-form2 textarea::-webkit-input-placeholder {
  color: #a49b89;
}

.book-a-table .php-email-form2 input::-moz-placeholder, .book-a-table .php-email-form2 textarea::-moz-placeholder {
  color: #a49b89;
}

.book-a-table .php-email-form2 input:-ms-input-placeholder, .book-a-table .php-email-form2 textarea:-ms-input-placeholder {
  color: #a49b89;
}

.book-a-table .php-email-form2 input::-ms-input-placeholder, .book-a-table .php-email-form2 textarea::-ms-input-placeholder {
  color: #a49b89;
}

.book-a-table .php-email-form2 input::placeholder, .book-a-table .php-email-form2 textarea::placeholder {
  color: #a49b89;
}

.book-a-table .php-email-form2 input:focus, .book-a-table .php-email-form2 textarea:focus {
  border-color: #cda45e;
}

.book-a-table .php-email-form2 input {
  height: 44px;
}

.book-a-table .php-email-form2 textarea {
  padding: 10px 12px;
}

.book-a-table .php-email-form2 button[type="submit"] {
  background: #cda45e;
  border: 0;
  padding: 10px 35px;
  color: #fff;
  transition: 0.4s;
  border-radius: 50px;
}

.book-a-table .php-email-form2 button[type="submit"]:hover {
  background: #d3af71;
}		
 </style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <a href="tel:<?php echo $seo['3']['waarde'] ?>"><i class="icofont-phone"></i><?php echo $seo['3']['waarde'] ?></a>
       <!-- <span class="d-none d-lg-inline-block"><i class="icofont-clock-time icofont-rotate-180"></i> Mon-Sat: 11:00 AM - 23:00 PM</span>-->
      </div>
      <!--
      <div class="languages">
        <ul>
          <li>En</li>
          <li><a href="#">De</a></li>
        </ul>
      </div>
      -->
    </div>
  </div>
    <?php $ctrl->print_nav_lion();?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Welkom bij <span><?php echo $seo['0']['waarde']?></span></h1>
          <h2><?php echo $seo['1']['waarde']?></h2>
          <div class="btns">
            <a href="#menu" class="btn-menu animated fadeInUp scrollto">Bestel</a>
            <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Reseerveer</a>
          </div>
        </div>
        

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="/lion/assets/img/about.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Informatie.</h3>
             	  <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?> 
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
     <?php 
            $ctrl=new IndexController();
            $sterktes=$ctrl->getSterk();
         ?>

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Sterktes</h2>
          <p>Waarom kiezen voor <span style="color:white;">ons?</span></p>
        </div>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="zoom-in" data-aos-delay="100" style="min-height: 300px;">
              <span>01</span>
              <h4><?php echo $sterktes[0]['naam'] ?></h4>
              <?php echo $sterktes[0]['omschrijving'] ?>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="200" style="min-height: 300px;">
              <span>02</span>
              <h4><?php echo $sterktes[1]['naam'] ?></h4>
             <?php echo $sterktes[1]['omschrijving'] ?>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="300" style="min-height: 300px;">
              <span>03</span>
              <h4><?php echo $sterktes[2]['naam'] ?></h4>
              <?php echo $sterktes[2]['omschrijving'] ?>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Menu Section ======= 
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Menu</h2>
          <p>Check Our Tasty Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-starters">Starters</li>
              <li data-filter=".filter-salads">Salads</li>
              <li data-filter=".filter-specialty">Specialty</li>
            </ul>
          </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-6 menu-item filter-starters">
            <img src="/lion/assets/img/menu/lobster-bisque.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Lobster Bisque</a><span>$5.95</span>
            </div>
            <div class="menu-ingredients">
              Lorem, deren, trataro, filede, nerada
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-specialty">
            <img src="/lion/assets/img/menu/bread-barrel.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Bread Barrel</a><span>$6.95</span>
            </div>
            <div class="menu-ingredients">
              Lorem, deren, trataro, filede, nerada
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-starters">
            <img src="/lion/assets/img/menu/cake.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Crab Cake</a><span>$7.95</span>
            </div>
            <div class="menu-ingredients">
              A delicate crab cake served on a toasted roll with lettuce and tartar sauce
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salads">
            <img src="/lion/assets/img/menu/caesar.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Caesar Selections</a><span>$8.95</span>
            </div>
            <div class="menu-ingredients">
              Lorem, deren, trataro, filede, nerada
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-specialty">
            <img src="/lion/assets/img/menu/tuscan-grilled.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Tuscan Grilled</a><span>$9.95</span>
            </div>
            <div class="menu-ingredients">
              Grilled chicken with provolone, artichoke hearts, and roasted red pesto
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-starters">
            <img src="/lion/assets/img/menu/mozzarella.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Mozzarella Stick</a><span>$4.95</span>
            </div>
            <div class="menu-ingredients">
              Lorem, deren, trataro, filede, nerada
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salads">
            <img src="/lion/assets/img/menu/greek-salad.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Greek Salad</a><span>$9.95</span>
            </div>
            <div class="menu-ingredients">
              Fresh spinach, crisp romaine, tomatoes, and Greek olives
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salads">
            <img src="/lion/assets/img/menu/spinach-salad.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Spinach Salad</a><span>$9.95</span>
            </div>
            <div class="menu-ingredients">
              Fresh spinach with mushrooms, hard boiled egg, and warm bacon vinaigrette
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-specialty">
            <img src="/lion/assets/img/menu/lobster-roll.jpg" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Lobster Roll</a><span>$12.95</span>
            </div>
            <div class="menu-ingredients">
              Plump lobster meat, mayo and crisp lettuce on a toasted bulky roll
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Menu Section -->
  
    <!-- ======= Specials Section ======= -->
    <section id="specials" class="specials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Technologie</h2>
          <p>Hoe wij het verschil maken.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#tab-1"><?php echo $cats[0]['naam']; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-2"><?php echo $cats[1]['naam']; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-3"><?php echo $cats[2]['naam']; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-4"><?php echo $cats[3]['naam']; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-5"><?php echo $cats[4]['naam']; ?></a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3><?php echo $cats[0]['naam']; ?></h3>
                   <?php echo $cats[0]['omschrijving']; ?>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="/lion/assets/img/specials-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3><?php echo $cats[1]['naam']; ?></h3>
                    <?php echo $cats[1]['omschrijving']; ?>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="/lion/assets/img/specials-2.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3><?php echo $cats[2]['naam']; ?></h3>
                    <?php echo $cats[2]['omschrijving']; ?>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="/lion/assets/img/specials-3.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3><?php echo $cats[3]['naam']; ?></h3>
                    <?php echo $cats[3]['omschrijving']; ?>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="/lion/assets/img/specials-4.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3><?php echo $cats[4]['naam']; ?></h3>
                    <?php echo $cats[4]['omschrijving']; ?>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="/lion/assets/img/specials-5.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Specials Section -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Events</h2>
          <p>Organisatie van feestjes.</p>
        </div>

        <div class="owl-carousel events-carousel" data-aos="fade-up" data-aos-delay="100">

          <div class="row event-item">
            <div class="col-lg-6">
              <img src="/lion/assets/img/event-birthday.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content">
              <h3>Catering</h3>
              <div class="price">
                <!--<p><span>$189</span></p>-->
              </div>
              <p class="font-italic">
                Op vraag van klanten kan u eenvoudig een cateringservice opstarten.
              </p>
              <ul>
                <li><i class="icofont-check-circled"></i> Prijzen en gerechten zelf aanpassen.</li>
                <li><i class="icofont-check-circled"></i> Makkelijk te delen en te beheren via online agenda.</li>
                <li><i class="icofont-check-circled"></i> Laat klanten via uw website bestellen.</li>
              </ul>
              <p>
                Zo ziet u maar via ons is alles geregeld, u hoeft enkel te doen waar u het beste in bent. En niet langer voor saaie computeruren uit uw keuken komen.
              </p>
            </div>
          </div>

          <div class="row event-item">
            <div class="col-lg-6">
              <img src="/lion/assets/img/event-private.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content">
              <h3>Zaal verhuur</h3>
              <div class="price">
                <!--<p><span>$290</span></p>-->
              </div>
              <p class="font-italic">
                Via ons pakket kan u eenvoudig beginnen met zaalverhuur voor trouwfeesten, conferenties, businessmeetings en meer.
              </p>
              <ul>
                <li><i class="icofont-check-circled"></i> Zelf prijzen aanpassen en beheren.</li>
                <li><i class="icofont-check-circled"></i> Klanten kiezen wanneer via online agenda.</li>
                <li><i class="icofont-check-circled"></i> Betaling gebeurt online.</li>
              </ul>
              <p>
                Mis geen enkele opportuniteit dankzij Webland, uw zaalverhuren was nog nooit zo eenvoudig.
              </p>
            </div>
          </div>

          <div class="row event-item">
            <div class="col-lg-6">
              <img src="/lion/assets/img/event-custom.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content">
              <h3>Vacatures</h3>
              <div class="price">
                <!--<p><span>$99</span></p>-->
              </div>
              <p class="font-italic">
               Plaats uw vacatures online en ontvang meteen solicitanten.
              </p>
              <ul>
                <li><i class="icofont-check-circled"></i> Zeer eenvoudig om vacatures te plaatsen.</li>
                <li><i class="icofont-check-circled"></i> Ontvang kandidaturen meteen in uw inbox.</li>
                <li><i class="icofont-check-circled"></i> Plaats momenten om te soliciteren meteen in uw agenda.</li>
              </ul>
              <p>
                Dankzij Webland Lion vind u meteen iedereen die u zaak nodig heeft in een mum van tijd.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Events Section -->

    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Reservaties</h2>
          <p>Voorbeeld.</p>
              <?php 
                if($_SESSION['book']){
                    $_SESSION['book']=null;
                    echo "<h1>Wij hebben uw afspraak goed ontvangen.</h1>";
                }
          ?>
        </div>

        <form action="/lion-stap2.php" method="post" role="form" class="php-email-form2" data-aos="fade-up" data-aos-delay="100">
          <div class="form-row">
            <div class="col-lg-4 col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Naam" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email">
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Telefoon" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
           
            <div class="col-lg-12 col-md-12 form-group">
              <input type="time" class="form-control" name="time" id="time" placeholder="Tijdstip" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            <div class="col-lg-6 col-md-6 form-group" style="display:none;">
              <input type="number" class="form-control" value="1" name="people" id="people" placeholder="Aantal personen" data-rule="minlen:1" data-msg="Please enter at least 1 chars">
              <div class="validate"></div>
            </div>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" placeholder="Bericht"></textarea>
            <div class="validate"></div>
          </div>
          <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Uw reservatie is ontvangen</div>
          </div>
                    <p style="color:white;">Disclaimer: Deze gegevens worden 9maanden bewaart in de onze DB, niet gebruikt voor commerciële doeleinden, noch doorverkocht, en zjn beveiligd met een (andere) geheime sleutel. Voor uw afspraak gebruiken we een cookie. Waarin we enkel een openbare unieke sleutel bewaren. Enkel de gegevens van dit formulier worden opgeslagen. Onze databank is bovendien beschermt tegen aanvallers. Veiligheid, privacy en transparantie draagt BadMenGroup hoog in het vaandel.</p>
      
          <div class="text-center"><button type="submit">Reserveer</button></div>

        </form>

      </div>
    </section><!-- End Book A Table Section -->

   <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Reviews</h2>
          <p>Wat klanten zeggen over ons.</p>
        </div>

        <div class="owl-carousel testimonials-carousel" data-aos="zoom-in" data-aos-delay="100">
            
            
                       <?php
                  $reviews=     getReviews($ctrl);
            foreach ($reviews as &$value) {
                    if($value['publish']==1){
                        echo '<div class="testimonial-item">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    '.$value['info'].'
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <h3>'.$value['naam'].'</h3>
                                <h4>'.printStars($review['rating']).'</h4>
                            </div>';
            }
      }
      ?>



        </div>

      </div>
    </section><!-- End Testimonials Section -->

   

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">

      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Gallerij</h2>
          <p>Enkele sfeerbeelden</p>
        </div>
      </div>

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/taurus/img/gallery/gallery-1.jpg" class="venobox" data-gall="gallery-item">
                  <div style="background: url('/taurus/img/gallery/gallery-1.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div>
               
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/lion/assets/img/gallery/gallery-2.jpg" class="venobox" data-gall="gallery-item">
              
                <div style="background: url('/lion/assets/img/gallery/gallery-2.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/taurus/img/gallery/gallery-2.jpg" class="venobox" data-gall="gallery-item">
                  <div style="background: url('/taurus/img/gallery/gallery-2.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div> 
                
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/taurus/img/gallery/gallery-3.jpg" class="venobox" data-gall="gallery-item">
                    <div style="background: url('/taurus/img/gallery/gallery-3.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div> 
               
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/lion/assets/img/gallery/gallery-5.jpg" class="venobox" data-gall="gallery-item">
        
                  <div style="background: url('/lion/assets/img/gallery/gallery-5.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div>
             
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/taurus/img/gallery/gallery-5.jpg" class="venobox" data-gall="gallery-item">
                  <div style="background: url('/taurus/img/gallery/gallery-5.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div>
             
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/taurus/img/gallery/gallery-4.jpg" class="venobox" data-gall="gallery-item">
                   <div style="background: url('/taurus/img/gallery/gallery-4.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div>
               
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="/taurus/img/gallery/gallery-6.jpg" class="venobox" data-gall="gallery-item">
                   <div style="background: url('/taurus/img/gallery/gallery-6.jpg');background-size:cover;background-position: center;width:100%;padding-bottom:250px;">
                      
                  </div>
              
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Chefs Section ======= -->
    <section id="chefs" class="chefs">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Promoties</h2>
          <p>Makkelijk aanpasbaar</p>
        </div>

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
    </section><!-- End Chefs Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Stuur een bericht.</p>
        </div>
      </div>

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Adres:</h4>
                <p><?php echo $seo['5']['waarde']?> <?php echo $seo['8']['waarde']?> <?php echo $seo['9']['waarde']?></p>
              </div>

 

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo $seo['4']['waarde']?></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Gsm:</h4>
                <p><?php echo $seo['3']['waarde']?></p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

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
                <textarea class="form-control" name="message" rows="8" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
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
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2497.1082196414395!2d4.492848015760644!3d51.253916779594306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3f80c5c14b541%3A0x1e9d18d753bf6c9b!2sWilgendaalstraat%2C%202900%20Schoten!5e0!3m2!1snl!2sbe!4v1606993338245!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>  
    <?php $ctrl->print_chat();?>
  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container">
      <div class="text-center">
        <a href="https://www.facebook.com/webland.belgie" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/webland_belgie/" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>    
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $seo['0']['waarde']?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Developed by <a href="https://webland.be/">Webland</a>
      </div>
    </div>
  </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

  <!-- Vendor JS Files -->
  <script src="/lion/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/lion/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/lion/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/lion/assets/vendor/php-email-form/validate.js"></script>
  <script src="/lion/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/lion/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/lion/assets/vendor/venobox/venobox.min.js"></script>
  <script src="/lion/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="/lion/assets/js/main.js"></script>
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