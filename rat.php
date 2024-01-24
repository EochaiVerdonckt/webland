<?php session_start();
$path = getcwd();
$path=$path.'/';
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

function getHours(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `hours` order by id";
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
function getBlogs(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `news` where publish = 1";
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
    
    echo '<div class="col-md-4" style="">
                <div class="caption" style="background: #E0E0E0;">
                <div class="text-center" style="padding: 15px;">
                 <h3>'.$cat['naam'].'</h3>
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
function getServices($ctrl){
    return $ctrl->selectStatement('services',1);
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
     <!-- =========================
                           Single Testimonial item
                        ============================== -->
                        <div class="item margin-bottom-small"> <!-- ITEM START -->
                        <h2>'.printStars($review['rating']).'</h2>
                            <p> '.$review['info'].'</p>
                            <div class="client margin-top-medium clearfix">
                                
                                <ul class="client-info main-color">
                                    <li><strong>'.$review['naam'].'</strong></li>
                                  
                                </ul>
                            </div>
                        </div> <!-- ITEM END -->

                        <!-- =========================
                           Single Testimonial item
                        ============================== -->
    
    ';

}
function lijstEten(){
  $ctrl=new IndexController();
  $conn= $ctrl->getConnection();
  $rij = array();
  $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1 AND id!=112 ORDER by sort";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
        // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($rij,$row);
    }

    } else {
        echo "0 results";
    }

    $conn->close();
   
    foreach ($rij as &$value) {
        echo '<div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>'.$value['naam'].'</h3>
						</div>';
	
        $conn= $ctrl->getConnection();
        $sql = "SELECT * FROM price_balance where cat=".$value['id']." ORDER BY sort";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $teller=0;
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(/rat/images/breakfast-1.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>'.$row['naam'].'</h3>
									</div>
									<div class="one-forth">
										<span class="price">'.$row['bedrag'].'</span>
									</div>
								</div>
								<p>'.$row['comment'].'</p>
							</div>
						</div>';
            }
        } 
        $conn->close();
        	echo '</div>';				
		echo '</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
	  <title><?php echo $seo['0']['waarde'].'-'.$seo['1']['waarde'];?></title>
	<meta charset="utf-8">
	 <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta property="og:description"  content="<?php echo $seo['1']['waarde']?>" />
    <meta name="description" content="<?php echo $seo['1']['waarde']?>">
    <meta name="author" content="Eoghain Verdonckt - Webland.be">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="/rat/css/animate.css">
	
	<link rel="stylesheet" href="/rat/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/rat/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="/rat/css/magnific-popup.css">

	<link rel="stylesheet" href="/rat/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="/rat/css/jquery.timepicker.css">

	
	<link rel="stylesheet" href="/rat/css/flaticon.css">
	<link rel="stylesheet" href="/rat/css/style.css">
</head>
<body>

	<div class="wrap">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-12 col-md d-flex align-items-center">
					<p class="mb-0 phone"><span class="mailus">Telefoon:</span> <a href="tel:<?php echo $seo['3']['waarde']?>"><?php echo $seo['3']['waarde']?></a> <span class="mailus">email:</span> <a href="mailto:<?php echo $seo['4']['waarde']?>"><?php echo $seo['4']['waarde']?></a></p>
				</div>
				<div class="col-12 col-md d-flex justify-content-md-end">
					<p class="mb-0">ONTDEK HOE WIJ HET VERSCHIL KUNNEN MAKEN.</p>
					<div class="social-media">
						<p class="mb-0 d-flex">
							<a href="<?php echo $seo['15']['waarde']?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
						
							<a href="<?php echo $seo['16']['waarde']?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html"><?php echo $seo['0']['waarde'] ?></span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
				    <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
				    <li class="nav-item"><a href="/rat/contact.php" class="nav-link">Contact</a></li>
				    <li class="nav-item active"><a href="/portaal" class="nav-link">Admin</a></li>
				    <?php /*
					
					<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
					<li class="nav-item"><a href="chef.html" class="nav-link">Chef</a></li>
					<li class="nav-item"><a href="menu.html" class="nav-link">Menu</a></li>
					<li class="nav-item"><a href="reservation.html" class="nav-link">Reservation</a></li>
					<li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
					
					
					*/ ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->
	
	<section class="hero-wrap">
		<div class="home-slider owl-carousel js-fullheight">
			<div class="slider-item js-fullheight" style="background-image:url('/bussiness/slides/<?php echo $slide1['foto'] ?>');">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 mt-5 text-center">
								<span class="subheading"><?php echo $slide1['titel'] ?></h2></span>
								<h1>Coding Since</h1>
								<span class="subheading-2">1998</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight" style="background-image:url(/bussiness/slides/<?php echo $slide2['foto'] ?>);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 mt-5 text-center">
								<span class="subheading"><?php echo $slide2['titel'] ?></h2></span>
								<h1><?php echo $slide1["Conclusie"] ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	

	<section class="ftco-section ftco-wrap-about ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-sm-4 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary">
					<form action="#" class="appointment-form">
						<h3 class="mb-3">Reservatie</h3>
						<p style="color:white;">Voorbeeld voor onze horeca klanten</p>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="name" class="form-control" placeholder="Name">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Email">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Phone">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="input-wrap">
										<div class="icon"><span class="fa fa-calendar"></span></div>
										<input type="text" class="form-control book_date" placeholder="Check-In">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="input-wrap">
										<div class="icon"><span class="fa fa-clock-o"></span></div>
										<input type="text" class="form-control book_time" placeholder="Time">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="form-field">
										<div class="select-wrap">
											<div class="icon"><span class="fa fa-chevron-down"></span></div>
											<select name="" id="" class="form-control">
												<option value="">Guest</option>
												<option value="">1</option>
												<option value="">2</option>
												<option value="">3</option>
												<option value="">4</option>
												<option value="">5</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Book Your Table Now" class="btn btn-white py-3 px-4">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-8 wrap-about py-5 ftco-animate img" style="background-image: url(/rat/images/about.jpg);">
					<div class="row pb-5 pb-md-0">
						<div class="col-md-12 col-lg-7">
							<div class="heading-section mt-5 mb-4">
								<div class="pl-lg-3 ml-md-5">
									<span class="subheading">Over ons</span>
									<h2 class="mb-4">Welkom</h2>
								</div>
							</div>
							<div class="pl-lg-3 ml-md-5">
									  <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getKrijt();
                    ?> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-intro" style="background-image: url(/rat/images/bg_3.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<span><?php echo $slide3['titel'] ?></span>
					<h2><?php echo $slide3['Conclusie'] ?></h2>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Onze specialiteiten</span>
					<h2 class="mb-4">Voorbeeld Menu</h2>
				</div>
			</div>
			<div class="row">
			
			<?php lijstEten();?>
			</div>
		</div>

	</section>

	<section class="ftco-section testimony-section" style="background-image: url(/rat/images/bg_5.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center mb-3 pb-2">
				<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
					<span class="subheading">Tevreden en persoonlijk</span>
					<h2 class="mb-4">Gelukkige klanten</h2>
				</div>
			</div>
			<div class="row ftco-animate justify-content-center">
				<div class="col-md-7">
					<div class="carousel-testimony owl-carousel ftco-owl">
					    <?php 
					      $reviews=getReviews($ctrl); 
					      foreach($reviews as $review){
					          echo '<div class="item">
							<div class="testimony-wrap text-center">
								<div class="text p-3">
									<p class="mb-4">'.$review['info'].'</p>
									<div class="user-img mb-4" style="background-image: url(/rat/images/person_1.jpg)">
										<span class="quote d-flex align-items-center justify-content-center">
											<i class="fa fa-quote-left"></i>
										</span>
									</div>
									<p class="name">'.$review['naam'].'</p>
									<span class="position">Klant</span>
								</div>
							</div>
						</div>';
					      }
					    ?>
						
					
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">25 tal</span>
					<h2 class="mb-4">Ontwerpen</h2>
				</div>
			</div>	
			<div class="row">
			    <?php
			      $services=getServices($ctrl);
			      foreach($services as $service){
			          echo '<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img" style="background-image: url(/gold/services/'.$service['foto'].');"></div>
						<div class="text px-4 pt-2">
							<h3>'.$service['naam'].'</h3>
							<span class="position mb-2">CEO, Co Founder</span>
							<div class="faded">
								<p>'.$service['omschrijving'].'</p>
								
							</div>
						</div>
					</div>
				</div>';
			      }
			    ?>
				
				
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-6 d-flex">
					<div class="img img-2 w-100 mr-md-2" style="background-image: url(/rat/images/bg_6.jpg);"></div>
					<div class="img img-2 w-100 ml-md-2" style="background-image: url(/rat/images/bg_4.jpg);"></div>
				</div>
				<div class="col-md-6 ftco-animate makereservation p-4 p-md-5">
					<div class="heading-section ftco-animate mb-5">
						<span class="subheading">Digitale tools</span>
						<h2 class="mb-4">Efficiënt en sneller</h2>
						<p>Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.

Zo ontvangt u dagelijks meteen alle opbrengsten van uw website meteen op uw rekening.
						</p>
						<p><a href="/rat/tools.php" class="btn btn-primary">ontdek</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Niuews</span>
					<h2 class="mb-4">Onze Blog</h2>
				</div>
			</div>
			<div class="row">
			    <?php
			    $blogs=getBlogs();
			    foreach($blogs as $blog){
			        echo '	<div class="col-md-4 ftco-animate">
					<div class="blog-entry">
						<a href="blog-single.html" class="block-20" style="background-image: url(/gold/blog/'.$blog['foto'].');">
						</a>
						<div class="text px-4 pt-3 pb-4">
							<div class="meta">
								<div><a href="#">'.$blog['created'].'</a></div>
								<div><a href="#">Eoghain Verdonckt</a></div>
							</div>
							<h3 class="heading"><a href="#">'.$blog['titel'].'</a></h3>
							<p class="clearfix">
								<a href="#" class="float-left read btn btn-primary">Read more</a>
							
							</p>
						</div>
					</div>
				</div>';
			    }
			    ?>
			
			
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb ftco-intro bg-primary">
		<div class="container py-5">
			<div class="row py-2">
				<div class="col-md-12 text-center">
					<h2>Contacteer ons vandaag nog</h2>
					<a href="tel:0485865970" class="btn btn-white btn-outline-white">Bel nu</a>
				</div>
			</div>
		</div>
	</section>

	<footer class="ftco-footer ftco-no-pb ftco-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-6 col-lg-3">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2"> <?php echo $seo[0]['waarde'];  ?></h2>
						<p><?php echo $seo[1]['waarde'];  ?></p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
							
							<li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-8 col-lg-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Openingsuren</h2>
						<ul class="list-unstyled open-hours">
						    <?php $hours=getHours(); ?>
							<li class="d-flex"><span>Monday</span><span><?php echo $hours[0]['waarde'] ?></span></li>
							<li class="d-flex"><span>Tuesday</span><span><?php echo $hours[1]['waarde'] ?></span></li>
							<li class="d-flex"><span>Wednesday</span><span><?php echo $hours[2]['waarde'] ?></span></li>
							<li class="d-flex"><span>Thursday</span><span><?php echo $hours[3]['waarde'] ?></span></li>
							<li class="d-flex"><span>Friday</span><span><?php echo $hours[4]['waarde'] ?></span></li>
							<li class="d-flex"><span>Saturday</span><span><?php echo $hours[5]['waarde'] ?></span></li>
							<li class="d-flex"><span>Sunday</span><span> <?php echo $hours[6]['waarde'] ?></span></li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
		<div class="container-fluid px-0 bg-primary py-3">
			<div class="row no-gutters">
				<div class="col-md-12 text-center">

					<p class="mb-0">
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by <a href="https://Webland.be" target="_blank">Webland</a>
						</p>
					</div>
				</div>
			</div>
		</footer>
		

		


		<script src="/rat/js/jquery.min.js"></script>
		<script src="/rat/js/jquery-migrate-3.0.1.min.js"></script>
		<script src="/rat/js/popper.min.js"></script>
		<script src="/rat/js/bootstrap.min.js"></script>
		<script src="/rat/js/jquery.easing.1.3.js"></script>
		<script src="/rat/js/jquery.waypoints.min.js"></script>
		<script src="/rat/js/jquery.stellar.min.js"></script>
		<script src="/rat/js/owl.carousel.min.js"></script>
		<script src="/rat/js/jquery.magnific-popup.min.js"></script>
		<script src="/rat/js/jquery.animateNumber.min.js"></script>
		<script src="/rat/js/bootstrap-datepicker.js"></script>
		<script src="/rat/js/jquery.timepicker.min.js"></script>
		<script src="/rat/js/scrollax.min.js"></script>
	
		<script src="/rat/js/main.js"></script>
		
	</body>
	</html>