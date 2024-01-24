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

function print_vragen(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
     $sql = "SELECT * FROM vragen";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
       
            $id= trim($row['id']);
            echo '<div class="col-lg-12">';
                    echo '<div class="votes-box" style="float:left;">';     
            echo '<a class="btn btn-success" href="upQ.php?id='.$row['id'].'" style="background: transparent;border:0;"><i style="color:#5cb85c;" class="fa fa-arrow-up"></i></a>';
            echo '<div>';
            echo '<a class="btn btn-danger" href="downQ.php?id='.$row['id'].'" style="background: transparent;border:0;"><i style="color: #d9534f;" class="fa fa-arrow-down"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="thumbnail" style="margin-left: 60px;">';
            
            
            if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$row['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
            else{
                echo "";
            }
            
            echo '        <div class="caption">  ';
            echo '<span class="badge badge-success" style="margin: 5px;background: green;">'.$row['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$row['nega'].'</span>';
            echo '        
                       <h2>'.$row['vraag'].'
                      </h2>';
                      echo '<h2 style="padding-left:8px; margin-top:10px;">A: '.$row['antw'].'</h2>';
            echo '
                    </div>
                 </div>';
                 
            
            echo '</div>';
        }
    }
    mysqli_close($conn);
}


function print_blogs(){
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
      $sql = "SELECT * FROM news where publish=1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-md-6">';
            echo '<div class="thumbnail">
                    <img src="/blog/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption"> 
                      <h1 style="text-decoration: underline;">'.$row['titel'].'</h1>
                       '.$row['inleiding'].'
                       <a href="lion-detail.php?id='.$row['id'].'" class="btn btn-default btn-block">LEES MEER</a>
                    </div>
                 </div></div>';
        }
    } else {
        echo "<h1>We hebben momenteel geen nieuws</h1>";
    }
    mysqli_close($conn);
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
	  <title><?php echo $seo['0']['waarde']?> | Uw mening is goud waard. | Q&A Stel hier al uw vragen.</title>
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
 
 .form-control{
     border: 1px solid #cda45e;
     background: black;
     color: #cda45e;
 }
         
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
	.btn{
	        background: #cda45e;
    margin-top: 12px;
	}
	#dropdownMenuLink{
	    margin-top:0;
	}
	.dot {
    height: 25px;
    width: 25px;
    background-color: white;
    border: 1px solid #ff7b00;
    border-radius: 50%;
    display: inline-block;
    color: #ff7b00;
    padding-top: 5px;
    text-align: center;
    
}
.dot h4 {
    color: #ff7b00;
}

.strong-item{
    margin-top: 12px;
    margin-right:8px;
}

.white{
    background-color: white !important;
    background: white !important;`
    margin:20px;
}
.sub-sq{
    margin-top:8px;
}
.reviews p{
    color: black !important ;
    font-size:2em;
}
.hide {
      display: none;
    }

    .clear {
      float: none;
      clear: both;
    }

    .rating {
        width: 90px;
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
        position: relative;
    }

    .rating > label {
        float: right;
        display: inline;
        padding: 0;
        margin: 0;
        position: relative;
        width: 1.1em;
        cursor: pointer;
        color: #fff;
    }

    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input.radio-btn:checked ~ label {
        color: transparent;
    }

    .rating > label:hover:before,
    .rating > label:hover ~ label:before,
    .rating > input.radio-btn:checked ~ label:before,
    .rating > input.radio-btn:checked ~ label:before {
        content: "\2605";
        position: absolute;
        left: 0;
        color: #FFD700;
    }
    .checked {
  color: orange;
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
  <div class="row" style="background:url('support.jpg'); background-size: cover;padding-bottom:250px;">
       <h1 style="font-size: 5em;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;color: white;padding-top:200px;width:100%; text-align:center;">Technical support Database.</h1>
   </div>
   
  <div class="row" style="background:#cda45e;padding-top:25px;padding-bottom:25px;">
      <a href="lion-ruben.php" class="btn btn-default" style="width:fit-content;margin-left:auto;margin-right:25px;background:transparent; border:1px solid black; color: black;">HEEFT U EEN VRAAG? </a>
  </div> 
  <main id="main">
          

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

 
 <div class="row text-center" style="margin-top:25px">
            <div class="col-md-6">
                    <h1>Stel uw vraag.</h1>
			    <form method="POST" action="saveQuestion.php">
			        <textarea style="border:1px solid #cda45e;" name="question" class="form-control" palceholder="Stel uw vraag"></textarea>
			        <input type="submit"  class="btn btn-warning btn-block" value="shoot"style="margin-top: 25px;"/>
			    </form>
            </div>

        
	    </div>
	    <div class="row">
	        <?php
	        if(isset($_SESSION['input']))
	        {
	            echo '<div style="padding: margin-top: 15px; text-align: center; 25px; border: 1px solid black"><h1>'.$_SESSION['input'].'</h1></div>';
	            $_SESSION['input']=null;
	        }
	        
	        ?>
	    </div>
      </div>
    </section><!-- End About Section -->
    
  </main><!-- End #main -->
   <div class="row text-center" style="margin-top:25px">
            <div class="col-md-6">
           
            </div>
            <div class="col-md-6">
                <img src="zaken.png" style="width:60%;margin-left:20%;"/>
            </div>
        
	    </div>
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