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
?>

	<!-- Single Price Starts -->
			
				<!-- Single Price Ends -->
				
				

<!DOCTYPE HTML>
<html lang="nl">
<head>
	  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/pieces-css/bootstrap.css" />
	<link rel="stylesheet" href="/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/pieces-css/linea-icon.css" />
	<link rel="stylesheet" href="/pieces-css/fancy-buttons.css" />
	<meta property="og:image" content="/og-logo.png" />
	<!--=== Google Fonts ===-->
	<link href='https://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:300,700,400' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway:600,400,300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<!--=== Other CSS files ===-->
	<link rel="stylesheet" href="/pieces-css/animate.css" />
	<link rel="stylesheet" href="/pieces-css/jquery.vegas.css" />
	<link rel="stylesheet" href="/pieces-css/baraja.css" />
	<link rel="stylesheet" href="/pieces-css/jquery.bxslider.css" />
	
	<!--=== Main Stylesheets ===-->
	<link rel="stylesheet" href="/pieces-css/style.css" />
	<link rel="stylesheet" href="/pieces-css/responsive.css" />
	
	<!--=== Color Scheme, three colors are available red.css, orange.css and gray.css ===-->
	<link rel="stylesheet" id="scheme-source" href="/pieces-css/schemes/gray.css" />
	    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
	<!--=== Internet explorer fix ===-->
	<!-- [if lt IE 9]>
		<script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif] -->
	
	<style>
		/*------------------BLACKBOARD--------------------*/
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
		
		.odd {
            background-color: #d3d3d3;
        }
        
        @media screen and (max-width: 992px) {
            #social-media {
                display:none;
            }
        }
        
    #welkom h3{
       border:0;
       color:black;
    }
    
    .snow-flake{
       width:100%;
       padding-bottom:60%;
    }
    
    .single-pricing-wrap{
        
        margin-bottom:25px;
    }
    .single-pricing-info {
        min-height:150px;
    }

	</style>
</head>
<body>

	<!--=== Header section Starts ===-->
    <?php $ctrl->print_nav_pieces(); ?>
  <div id="section-home" class="home-section-wrap center">
			<div class="section-overlay"></div>
			<div class="container home">
				<div class="row">
					<h1 class="well-come" id="title1"><?php  echo $slide1['titel']?></h1>
					<h1 class="well-come" id="title2" style="display:none;"><?php  echo $slide2['titel']?></h1>
					<h1 class="well-come" id="title3" style="display:none;"><?php  echo $slide3['titel']?></h1>
					<div class="col-md-8 col-md-offset-2">
						<p id="conclusie1" class="intro-message"><?php  echo $slide1['Conclusie']?></p>
                        <p id="conclusie2" class="intro-message" style="display:none;"><?php  echo $slide2['Conclusie']?></p>
                        <p id="conclusie3" class="intro-message" style="display:none;"><?php  echo $slide3['Conclusie']?></p>
                        <p id="steps" style="display:none;">0</p>
					</div>
				</div>
			</div>
		</div>
		<!--=== Home Section Ends ===-->
	</div>
	
	<!--=== Services section Starts ===-->
	<section id="section-services" class="services-wrap" style="background:white;">
		<div class="container services">
		    <img src="/logo.png" style="width:20%;margin-left:40%;border-radius:50%;"/>>
		 </div>
		

			<div class="row">
				<div id="welkom" style="color:black !important;" class="col-md-10 col-md-offset-1 center section-title">
				    <h1 style="color:black;">WELKOM</h1>
				 <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?>  
				</div>
			</div>
			<div class="row">
				<div class="blackboard" style="">
					<div class="krijt"><?php echo $ctrl->getkrijt();?></div>
				</div>
			</div>
	  <?php 
            $ctrl=new IndexController();
            $sterktes=$ctrl->getSterk();
         ?>
			<div class="row">
				<!-- Single Service Starts -->
				<div class="col-md-4 col-sm-6 service animated" data-animation="fadeInLeft" data-animation-delay="700">
					<span class="service-icon center"><i class="fa fa-star fa-3x"></i></span>
					<div class="service-desc" style="color: black!important">
						<h4 class="service-title color-scheme"><?php echo $sterktes[0]['naam'] ?></h4>
						<p class="service-description justify" style="color:black;">
						<?php echo $sterktes[0]['omschrijving'] ?>
						</p>
					</div>
				</div>
				<!-- Single Service Ends -->
				
				<!-- Single Service Starts -->
				<div class="col-md-4 col-sm-6 service animated" data-animation="fadeInUp" data-animation-delay="700">
					<span class="service-icon center"><i class="fa fa-star  fa-3x"></i></span>
					<div class="service-desc" style="color: black!important">
						<h4 class="service-title color-scheme"><?php echo $sterktes[1]['naam'] ?></h4>
						<p class="service-description justify" style="color:black;">
						<?php echo $sterktes[1]['omschrijving'] ?>
						</p>
					</div>
				</div>
				<!-- Single Service ends -->
				
				<!-- Single Service Starts -->
				<div class="col-md-4 col-sm-6 service animated" data-animation="fadeInRight" data-animation-delay="700">
					<span class="service-icon center"><i class="fa fa-star  fa-3x"></i></span>
					<div class="service-desc" style="color: black!important">
						<h4 class="service-title color-scheme"><?php echo $sterktes[2]['naam'] ?></h4>
						<p class="service-description justify" style="color:black;">
						<?php echo $sterktes[2]['omschrijving'] ?>
						</p>
					</div>
				</div>
				<!-- Single Service Ends -->
				
		
			</div>
		</div>
	</section>
	<!--=== Services section Ends ===-->



 <?php $reviews=getReviews($ctrl);?>
  <section style="padding-top:125px;padding-bottom: 125px;background:white;">
      <div class="text-center" style="margin-bottom:25px;">
          <h1>Wat klanten over ons vertellen.</h1>
      </div>
      <div class="container">
          <div class="row">
              <div class="col-md-6" id="mening">
                       <?php 
      foreach ($reviews as &$value) {
            if($value['publish']==1){
                printReview($value);
            }
          
      }
      
      ?> 
              </div>
              <div class="col-md-6">
                  <img src="/img/desk.png" style="width:60%;margin-left:20%;"/>
              </div>
          </div>
      </div>
      
      	<!--=== Pricing section Starts ===-->
	<section id="section-pricing" class="pricing-wrap">
		<div class="container pricing">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 center section-title">
					<h3>TOOLS</h3>
				</div>
				<div class="col-md-10 col-md-offset-1 center">
				        <h5>Ontdek hoe wij het verschil maken..</h5>
				</div>
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
		</div>
	</section>
	<!--=== Pricing section Ends ===-->
		<!--=== Features section Starts ===-->
	<section id="section-feature" class="feature-wrap" style="background:white;">
		<div class="container features center">
			<div class="row">
				<div class="col-lg-12">
				        <h1>Ontwerpen</h1>
				        	<p>Wij, bieden u de keuze uit een 9-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
						<!--Features container Starts -->
						<ul id="card-ul" class="features-hold baraja-container">
						
							<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[0]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[0]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[0]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[1]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[1]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[1]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[2]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[2]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[2]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
							
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[3]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[3]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[3]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[2]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[4]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[4]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[5]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[5]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[5]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[6]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[6]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[6]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[7]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[7]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[7]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[8]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[8]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[8]['omschrijving'];?>
								</div>
								
									<a href="/index.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
							
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[9]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[9]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[9]['omschrijving'];?>
								</div>
								
									<a href="/<?php echo $services[9]['naam'];?>.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
									<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[10]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[10]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[10]['omschrijving'];?>
								</div>
								
									<a href="/<?php echo $services[10]['naam'];?>.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
							
								<!-- Single Feature Starts -->
							<li class="single-feature" title="Hosting">
							    	    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:125px;padding-bottom:125px;background: url('/services/<?php echo $services[11]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
							
										
							<!-- Feature Icon -->
								<h4 class="feature-title color-scheme"><?php echo $services[11]['naam'];?></h4>
								<div class="feature-text">
									<?php echo $services[11]['omschrijving'];?>
								</div>
								
									<a href="/<?php echo $services[11]['naam'];?>.php" class="fancy-button button-line btn-col small vertical">
										Bekijk
										<span class="icon">
											<i class="fa fa-eye"></i>
										</span>
									</a>
								
							</li>
							<!-- Single Feature Ends -->
							
							
							
						</ul>
						<!--Features container Ends -->
						
						<!-- Features Controls Starts -->
						<div class="features-control relative">
							<button class="control-icon fancy-button button-line no-text btn-col bell" id="feature-prev" title="Previous" >
								<span class="icon">
									<i class="fa fa-arrow-left"></i>
								</span>
							</button>
							<button class="control-icon fancy-button button-line no-text btn-col zoom" id="feature-expand" title="Expand" >
								<span class="icon">
									<i class="fa fa-expand"></i>
								</span>
							</button>
							<button class="control-icon fancy-button button-line no-text btn-col zoom" id="feature-close" title="Collapse" >
								<span class="icon">
									<i class="fa fa-compress"></i>
								</span>
							</button>
							<button class="control-icon fancy-button button-line no-text btn-col bell" id="feature-next" title="Next" >
								<span class="icon">
									<i class="fa fa-arrow-right"></i>
								</span>
							</button>
						</div>
						<!-- Features Controls Ends -->
				</div>
			</div>
		</div>
	</section>
	<!--=== Features section Ends ===-->
	
<section id="hours" style="padding-bottom: 15px;background:white;">
         <div class="container">
    <div class="text-center">
        <h1 style="color:black;">Openingsuren</h1>
    </div>         
    
    <div id="schema" style="text-align: center;">
         <?php if($_SESSION['user']){
                        echo '<a href="/mysite/hours.php" class="wl-config-2"><span class="fa-stack fa-lg">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-magic fa-stack-1x fa-inverse"></i>
</span></a>';
                }
            $ctrl=new IndexController();
            $hours=$ctrl->getHours();         
        ?>
        <div class="row">
            <div class="col-md-6">
                <table style="margin-top:50px;width:100%;">
                         <tbody><tr>
                             <td>Maandag</td>
                             <td><?php echo $hours[0]['waarde']?></td>
                         </tr>
                         <tr>
                             <td>Dinsdag</td>
                             <td><?php echo $hours[1]['waarde']?></td>
                         </tr>
                         <tr>
                             <td>Woensdag</td>
                             <td><?php echo $hours[2]['waarde']?></td>
                         </tr>
                         <tr>
                             <td>Donderdag</td>
                             <td><?php echo $hours[3]['waarde']?></td>
                         </tr>
                         <tr>
                             <td>Vrijdag</td>
                             <td><?php echo $hours[4]['waarde']?></td>
                         </tr>
                         <tr>
                             <td>Zaterdag</td>
                             <td><?php echo $hours[5]['waarde']?></td>
                         </tr>
                         <tr>
                             <td>Zondag</td>
                             <td><?php echo $hours[6]['waarde']?></td>
                         </tr>
                     </tbody></table>
            </div>
            <div class="col-md-6">
                    <img src="/img/clock.jpg" alt="Foto van een ipad." style="width:40%;margin-left:30%;"/>   
            </div>
        </div>
</div>
</div>
</section>

  </section>
	 <section  class="text-center" style="margin-top:0px;background:white;" >
      <div style="padding-top:100px;padding-left:25px;padding-right:25px;">
           <h1>Online betalingen was nog nooit zo eenvoudig.</h1>
      <p style="color:black;">Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
      </div>
     
      <img src="mollie.png" style="width:100%;" alt="online betalen was nog nooit zo eenvoudig." />
  </section>
   <div class="more-area" id="" style="    background: url(../img/more3.png) no-repeat center center;
    background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="pull-left" id="gratis" style="color:black;padding:5px;">Ontdek hoe wij het verschil kunnen maken.</h2>
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: black; background: transparent;font-size:1.5em; margin-top:25px;">Bekijk.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
	
	<!--=== Contact section Starts ===-->
	<section id="section-contact" class="contact-wrap">
	<div class="section-overlay"></div>
		<div class="container contact center " >
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="col-md-10 col-md-offset-1 center section-title">
						<h3>Geef een seintje.</h3>
						<h5>info@webland.be</h5>
					</div>
					
					<div class="confirmation">
						<p><span class="fa fa-check"></span></p>
					</div>
					
					<form class="contact-form support-form">
						
						<div class="col-lg-12">
							<input id="name" class="input-field form-item field-name" type="text" required="required" name="contact-name" placeholder="Naam" />

							<input id="email" class="input-field form-item field-email" type="email" required="required" name="contact-email" placeholder="Email" />

							<input id="subject" class="input-field form-item field-subject" type="text" required="required" name="contact-subject" placeholder="Telefoon" />
							<textarea id="message" class="textarea-field form-item field-message" rows="10" name="contact-message" placeholder="Uw bericht"></textarea>
						</div>
						<button type="submit" class="fancy-button button-line button-white large zoom subform">Verzenden 
							<span class="icon">
								<i class="fa fa-paper-plane-o"></i>
							</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--=== Contact section Ends ===-->
	
	
	<section style="background: black;">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10069.828348169862!2d4.7022505!3d50.87825!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xeaec8dfdd2b4c2db!2sYou%20Sushi!5e0!3m2!1snl!2sbe!4v1603876035845!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	</section>
	
	<!--=== Footer section Starts ===-->
	<div id="section-footer" class="footer-wrap">
		<div class="container footer center">
			<div class="row">
				<div class="col-lg-12">
			
					
					<!-- Social Links -->
					<div class="social-icons">
						<ul>
						<li><a href="https://www.facebook.com/webland.belgie"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="https://www.instagram.com/webland_belgie/"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<p class="copyright">All rights reserved &copy; 2018. Created and hosting by <a href="http://webland.be">webland</a></p>
				</div>
			</div>
		</div>
	</div>

	<?php $ctrl->print_chat()?>
	<!--=== Footer section Ends ===-->
	
<!--==== Js files ====-->
<!--==== Essential files ====-->
<script type="text/javascript" src="/pieces-js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/pieces-js/bootstrap.min.js"></script>
<script type="text/javascript" src="/pieces-js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="/pieces-js/modernizr.js"></script>
<script type="text/javascript" src="/pieces-js/jquery.easing.1.3.js"></script>

<!--==== Slider and Card style plugin ====-->
<script type="text/javascript" src="/pieces-js/jquery.baraja.js"></script>
<script type="text/javascript" src="/pieces-js/jquery.vegas.min.js"></script>
<script type="text/javascript" src="/pieces-js/jquery.bxslider.min.js"></script>

<!--==== MailChimp Widget plugin ====-->
<script type="text/javascript" src="/pieces-js/jquery.ajaxchimp.min.js"></script>

<!--==== Scroll and navigation plugins ====-->
<script type="text/javascript" src="/pieces-js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="/pieces-js/jquery.nav.js"></script>
<script type="text/javascript" src="/pieces-js/jquery.appear.js"></script>
<script type="text/javascript" src="/pieces-js/jquery.fitvids.js"></script>
<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
<!--==== Custom Script files ====-->
<script type="text/javascript" src="/pieces-js/custom.js"></script>
<script>
   window.setInterval(function(){
        var steps = $("#steps").text();
        steps = parseInt(steps);
        steps = steps+1;
      
        if(steps==1){
         $("#title1").fadeIn(2000);
         $("#conclusie1").fadeIn(2000);
         $("#title3").hide();
         $("#conclusie3").hide();
        }
        if(steps==2){
          $("#title1").hide();
          $("#conclusie1").hide();
          $("#conclusie2").fadeIn(2000);
          $("#title2").fadeIn(2000);
        }
        if(steps==4){
          $("#title2").hide();
          $("#conclusie2").hide();
          $("#conclusie3").fadeIn(2000);
          $("#title3").fadeIn(2000);
        }
        if(steps>5){
            steps=0;
        }
        $("#steps").text(steps);
    }, 3000);
    
    $('#mening').slick({
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