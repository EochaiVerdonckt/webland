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
$missie=getMissie();

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

function getMissie(){
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM `missie`";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $item=$row;
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item['waarde'];
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
  <section id="hero" class="d-flex align-items-center" style="background:url('/missie.jpg'); background-size: cover;">
    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
      
          <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Missie.</h3>
             	  <?php 
                            echo $missie;
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