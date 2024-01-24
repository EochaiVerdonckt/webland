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
function printCat($cat){
    
    echo '<div class="col-md-3" style="margin-bottom:25px;">
                <div class="caption" style="background: #E0E0E0;">
                <div class="text-center" style="padding: 15px;">
                 <h2>'.$cat['naam'].'</h2>
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
    echo '<div class="item-rev">
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
<html lang="nl">
<head>
	<meta charset="UTF-8">
	  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description"  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
	<!-- Main CSS file -->
	<link rel="stylesheet" href="/ariers/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/ariers/css/owl.carousel.css" />
	<link rel="stylesheet" href="/ariers/css/magnific-popup.css" />
	<link rel="stylesheet" href="/ariers/css/font-awesome.css" />
	<link rel="stylesheet" href="/ariers/css/style.css" />
	<link rel="stylesheet" href="/ariers/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="/ariers/images/icon/favicon.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ariers/images/icon/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ariers/images/icon/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ariers/images/icon/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ariers/images/icon/apple-touch-icon-57-precomposed.png">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
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
		
		
.double-border{ 	
background-color: black;
    border: 2px solid black;
    padding: 0.5em;
    position: relative;
    margin: 0 auto;
}

#carnaval p { 	
min-height:125px;
}


.item-rev{ 	
background:#333;
padding: 10px;
}
   

	</style>
</head>
<body>

	<!-- PRELOADER -->
	<div id="st-preloader">
		<div id="pre-status">
			<div class="preload-placeholder"></div>
		</div>
	</div>
	<!-- /PRELOADER -->

	
	<!-- HEADER -->
	<header id="header">
		<nav class="navbar st-navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#st-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
					</button>
					<a class="logo" href="/"><img src='/logo.png' style="width: 5%;position: absolute;top: 0;"/></a>
				</div>

				<div class="collapse navbar-collapse" id="st-navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
				    	     <li><a class="page-scroll" href="/" >HOME</a></li>
                            <li><a class="page-scroll" href="/missie.php" >MISSIE</a></li>
                            <li><a class="page-scroll"  href=" /fotopagina/">FOTOPAGINA</a></li>
                             <li><div class="dropdown" id="toolBox" style="margin-top:8px;">
  <button style="background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cogs"></i> TOOLS
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
<?php
    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid black;"> <a class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                        } 
?>                        
</div>
</div></li>
  <li><div class="dropdown show" id="newsBox">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;padding-top: 0px;margin-top:14px;">
    BLOG
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;">';
      <?php
      foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="detail.php?id='.$value['id'].'"style="color:black;padding:8px;">'.$value['titel'].'</a></div>';
        }
        ?>
       <div><a class="dropdown-item" href="/blog.php"style="color:black;padding:8px;">Alle artikels</a></div>
    </div></li>
       
<li><a class="page-scroll"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li style="padding-left: 0;"><a class="page-scroll"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/vragen.php" id="contactA">Q&A</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
	</header>
	<!-- /HEADER -->


	<!-- SLIDER -->
	<section id="slider">
		<div id="home-carousel" class="carousel slide" data-ride="carousel">			
			<div class="carousel-inner">
				<div class="item active" style="background-image: url(/slides/<?php echo $slide1['foto'] ?>)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
								<h1><?php echo $slide1['titel'] ?></h1>
								<p><?php echo $slide1['Conclusie'] ?></p>
							</div>
						</div>
					</div>					
				</div>
				<div class="item" style="background-image: url(/slides/<?php echo $slide2['foto'] ?>)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
								<h1><?php echo $slide2['titel'] ?></h1>
								<p><?php echo $slide2['Conclusie'] ?> </p>
							</div>
						</div>
					</div>					
				</div>
				
				<div class="item" style="background-image: url(/slides/<?php echo $slide3['foto'] ?>)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
							    <h1><?php echo $slide3['titel'] ?></h1>
								<p><?php echo $slide3['Conclusie'] ?></p>
							</div>
						</div>
					</div>					
				</div>
				<a class="home-carousel-left" href="#home-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
				<a class="home-carousel-right" href="#home-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
			</div>		
		</div> <!--/#home-carousel--> 
    </section>
	<!-- /SLIDER -->

	
	<!-- SERVICES -->
	<section id="services">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Welkom</h1>
						<span class="st-border"></span>
					</div>
				</div>
					<div class="col-md-12">
					<div class="">
						  <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?>  
					</div>
				</div>
	  <?php 
            $ctrl=new IndexController();
            $services=$ctrl->getSterk();
         ?>
				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-bank"></i> <?php echo $services[0]['naam'] ?></h2>
					<?php echo $services[0]['omschrijving'] ?>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-star"></i><?php echo $services[1]['naam'] ?></h2>
					<?php echo $services[1]['omschrijving'] ?>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-heart"></i> <?php echo $services[2]['naam'] ?></h2>
					<?php echo $services[2]['omschrijving'] ?>
				</div>
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
		</div>
	</section>
	<!-- /SERVICES -->


	<!-- OUR WORKS -->
	<section id="our-works">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Onze digitale tools.</h1>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="portfolio-wrapper" id="carnaval" >
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
		</div>
	</section>
	<!-- /OUR WORKS -->
 <?php $reviews=getReviews($ctrl);?>
  <section style="margin-top:125px;margin-bottom: 125px;">
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

  </section>
  
 
	
	<!-- PRICING -->
	<section id="pricing">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Ontwerpen</h1>
						<span class="st-border"></span>
						<p>Wij, bieden u de keuze uit een 7-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
					</div>
				</div>
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
	</section>
	<!-- /PRICING -->








 <section id="hours" style="padding-bottom: 15px;">
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

</section>
         <section  class="text-center" style="margin-top:100px;" >
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
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: black; background: transparent;font-size:1.5em;margin-top:20px;">Bekijk.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10003703.93002628!2d-4.89514483266907!3d52.255905864975766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1613b61426d85%3A0x52bed37ce3e8c65d!2sWebland%20Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1604050229893!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

	<!-- CONTACT -->
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Verstuur een bericht</h1>
						<span class="st-border"></span>
					</div>
				</div>
				<div class="col-sm-4 contact-info">
					<p class="contact-content">Vragen? U kan ons volledig vrijblijvend contacteren</p>
					<p class="st-email"><i class="fa fa-envelope-o"></i> <strong>sales@webland.be</strong></p>
					<p class="st-website"><i class="fa fa-globe"></i> <strong>www.webland.be</strong></p>
				    <p class="st-email"><i class="fa fa-mobile"></i> <strong>0485/86 59 70</strong></p>
				</div>
				<div class="col-sm-7 col-sm-offset-1">
					<form action="php/send-contact.php" class="contact-form" name="contact-form" method="post">
						<div class="row">
							<div class="col-sm-6">
								<input type="text" name="name" required="required" placeholder="Naam*">
							</div>
							<div class="col-sm-6">
								<input type="email" name="email" required="required" placeholder="Email*">
							</div>
							<div class="col-sm-12">
								<input type="text" name="subject" placeholder="Onderwerp">
							</div>
							<div class="col-sm-12">
								<textarea name="message" required="required" cols="30" rows="7" placeholder="Bericht*"></textarea>
							</div>
							<div class="col-sm-12">
								<input type="submit" name="submit" value="Verstuur" class="btn btn-send">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- /CONTACT -->

	<!-- FOOTER -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<!-- SOCIAL ICONS -->
				<div class="col-sm-6 col-sm-push-6 footer-social-icons">
					<span>Follow us:</span>
					<a href="https://www.facebook.com/webland.belgie/"><i class="fa fa-facebook"></i></a>
				</div>
				<!-- /SOCIAL ICONS -->
				<div class="col-sm-6 col-sm-pull-6 copyright">
					<p>&copy; 2017 <a href="http://webland.be">Webland</a>. All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- /FOOTER -->


	<!-- Scroll-up -->
	<div class="scroll-up">
		<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
	</div>

	
	<!-- JS -->
	<script type="text/javascript" src="/ariers/js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="/ariers/js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="/ariers/js/jquery.parallax.js"></script><!-- Parallax -->
	<script type="text/javascript" src="/ariers/js/smoothscroll.js"></script><!-- Smooth Scroll -->
	<script type="text/javascript" src="/ariers/js/masonry.pkgd.min.js"></script><!-- masonry -->
	<script type="text/javascript" src="/ariers/js/jquery.fitvids.js"></script><!-- fitvids -->
	<script type="text/javascript" src="/ariers/js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
	<script type="text/javascript" src="/ariers/js/jquery.counterup.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="/ariers/js/waypoints.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="/ariers/js/jquery.isotope.min.js"></script><!-- isotope -->
	<script type="text/javascript" src="/ariers/js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
	<script type="text/javascript" src="/ariers/js/scripts.js"></script><!-- Scripts -->
	<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
    <script>
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

</body>
</html>