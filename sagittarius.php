<?php session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();
$services=$ctrl->getServicesPublished();
$seo=$ctrl->getSeo();


function splitMyArray(array $input_array, int $size, $preserve_keys = null): array
{
    $nr = (int)ceil(count($input_array) / $size);

    if ($nr > 0) {
        return array_chunk($input_array, $nr, $preserve_keys);
    }

    return $input_array;
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

function getSlides($ctrl){
   return $ctrl->selectStatement('slides');
}

function getSterktes($ctrl){
   return $ctrl->selectStatement('sterk');
}

function getReviews($ctrl){
    return $ctrl->selectStatement('reviews',1);
}

function getBlogs($ctrl){
   return $ctrl->selectStatement('news',1);
}


function printBlog($blog){
    echo '
    <div class="col-sm-4">
		<div class="single-blog">
			<img src="/blog/'.$blog['foto'].'" alt="" />
			<h2>'.$blog['titel'].'</h2>
			<ul class="post-meta">
				<li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
			</ul>
			<div class="blog-content">
				<p>'.$blog['inleiding'].'</p>
			</div>
			<a href="/detail.php?id='.$blog['id'].'" class="btn btn-primary" >Read More</a>
		</div>
	</div>';
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
    
    echo '
    			<div class="col-sm-6 col-md-3">
								<div class="single-member">
								    <div style="background:url(/categ/'.$cat['foto'].');background-size:cover;width:100%;padding-bottom:100px;">
								    </div>
								    <div style="min-height:200px;">
								    	<h4>'.$cat['naam'].'</h4>
									<p>'.$cat['omschrijving'].'</p>
								    </div>
								
								    <a class="btn btn-default slider-btn animated bounceInUp" href="/shop/index.php?cat='.$cat['id'].'">ONTDEK</a> 
								</div>
							</div>
    ';

}

$slides = getSlides($ctrl);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image" content="logo.jpg" />
 
	<link href="/Sagittarius/files/css/bootstrap.min.css" rel="stylesheet">
	<link href="/Sagittarius/files/css/prettyPhoto.css" rel="stylesheet"> 
	<link href="/Sagittarius/files/css/font-awesome.min.css" rel="stylesheet"> 
	<link href="/Sagittarius/files/css/animate.css" rel="stylesheet"> 
	<link href="/Sagittarius/files/css/main.css" rel="stylesheet">
	<link href="/Sagittarius/files/css/responsive.css" rel="stylesheet"> 
	    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
	<!--[if lt IE 9]> <script src="js/html5shiv.js"></script> 
	<script src="js/respond.min.js"></script> <![endif]--> 
	<link rel="shortcut icon" href="images/ico/favicon.png"> 
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/templates/Sagittarius/files/images/ico/apple-touch-icon-144-precomposed.png"> 
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/templates/Sagittarius/files/images/ico/apple-touch-icon-114-precomposed.png"> 
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/templates/Sagittarius/files/images/ico/apple-touch-icon-72-precomposed.png"> 
	<link rel="apple-touch-icon-precomposed" href="/templates/Sagittarius/files/images/ico/apple-touch-icon-57-precomposed.png">
	<style>
	       .krijt {
    vertical-align: middle;
    font-family: 'Permanent Marker', cursive;
    font-size: 1.6em;
    color: rgba(238, 238, 238, 0.7);
    padding: 10px;
    min-height: 250px;
}

.blackboard {
    width: 640px;
    max-width: 100%;
    margin: 7% auto;
    border: silver solid 12px;
    border-top: silver solid 12px;
    border-left: silver solid 12px;
    border-bottom: silver solid 12px;
    box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
    background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
    background-color: #333;
}

	</style>
</head><!--/head-->
<body>
	
	<header id="navigation"> 
		<div class="navbar navbar-inverse navbar-fixed-top" role="banner"> 
			<div class="container"> 
				<div class="navbar-header"> 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
						<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
					</button> 
					<a style="padding: 0;" class="navbar-brand" href="index.html"></a> 
				</div> 
				<div class="collapse navbar-collapse"> 
					<ul class="nav navbar-nav navbar-right"> 
						<li class="scroll active"><a href="#navigation">Home</a></li> 
						<li class="scroll"><a href="#about-us">Info</a></li> 
						<li class="scroll"><a href="#services">Ontwerpen</a></li> 
						<li class="scroll"><a href="#our-team">Tools</a></li> 
						<li class="scroll"><a href="/missie.php">Mission</a></li> 
						<li class="scroll"><a href="#clients">Reviews</a></li> 
						<li class="scroll"><a href="#blog">Blog</a></li>
							<li class="scroll"><a href="/vragen.php">q&A</a></li>
						<li class="scroll"><a href="#contact">Contact</a></li> 
						<li class="scroll"><a href="/portaal">Admin</a></li> 
						<li class="scroll"><a href="/GDPR.pdf">GDPR</a></li> 
					</ul> 
				</div> 
			</div> 
		</div><!--/navbar--> 
	</header> <!--/#navigation--> 

	<section id="home">
		<div class="home-pattern"></div>
		<div id="main-carousel" class="carousel slide" data-ride="carousel"> 
			<ol class="carousel-indicators">
				<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#main-carousel" data-slide-to="1"></li>
				<li data-target="#main-carousel" data-slide-to="2"></li>
			</ol><!--/.carousel-indicators--> 
			<div class="carousel-inner">
				<div class="item active" style="background-image: url('/slides/<?php echo $slides[0]['foto']?>')"> 
					<div class="carousel-caption"> 
						<div> 
							<h2 class="heading animated bounceInDown" style="width:fit-content;padding: 8px; background: rgba(0,0,0,0.8);"><?php echo $slides[0]['titel']?></h2> 
							<div class="text-center">
							    	<p class="animated bounceInUp" style="margin-left:auto;margin-right:auto;width:fit-content;padding: 8px; background: rgba(0,0,0,0.8);"><?php echo $slides[0]['Conclusie']?></p> 
							</div>
						
							<a class="btn btn-default slider-btn animated fadeIn" href="#">Get Started</a> 
						</div> 
					</div> 
				</div>
				<div class="item" style="background-image: url('/slides/<?php echo $slides[1]['foto']?>')"> 
					<div class="carousel-caption"> <div> 
						<h2 class="heading animated bounceInDown" style="width:fit-content;padding: 8px; background: rgba(0,0,0,0.8);"><?php echo $slides[1]['titel']?></h2> 
						<div class="text-center">
						    	<p class="animated bounceInUp" style="margin-left:auto;margin-right:auto;width:fit-content;padding: 8px; background: rgba(0,0,0,0.8);"><?php echo $slides[1]['Conclusie']?></p> 
						</div>
					<a class="btn btn-default slider-btn animated fadeIn" href="#">Get Started</a> 
					</div> 
				</div> 
			</div> 
			<div class="item" style="background-image: url('/slides/<?php echo $slides[2]['foto']?>')"> 
				<div class="carousel-caption"> 
					<div> 
						<h2 class="heading animated bounceInRight" style="width:fit-content;padding: 8px; background: rgba(0,0,0,0.8);"><?php echo $slides[2]['titel']?></h2> 
						<div class="text-center">
						    	<p class="animated bounceInLeft" style="margin-left:auto;margin-right:auto;width:fit-content;padding: 8px; background: rgba(0,0,0,0.8);"><?php echo $slides[2]['Conclusie']?></p> 
						</div>
					
						<a class="btn btn-default slider-btn animated bounceInUp" href="#">Get Started</a> 
					</div> 
				</div> 
			</div>
		</div><!--/.carousel-inner-->

		<a class="carousel-left member-carousel-control hidden-xs" href="#main-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
		<a class="carousel-right member-carousel-control hidden-xs" href="#main-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
	</div> 

</section><!--/#home-->

<section id="about-us">
    <div class="text-center">
        <img src="/logo.png" alt="logo" style="width:20%;margin-left:auto;margin-right:auto;">
    </div>
	<div class="container">
		<div class="text-center">
			<div class="col-sm-8 col-sm-offset-2">
				<h2 class="title-one">WELKOM</h2>
			    <?php echo  getPromo(); ?> 
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
                <div class="blackboard">
					<div class="krijt"> 
					    <?php echo  getKrijt(); ?> 
                    </div>
				</div>
        </div>
    </div>
    <?php $sterktes= getSterktes($ctrl);?>
    <div class="container">
		<div class="about-us">
			<div class="row">
				<div class="col-sm-6">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#about" data-toggle="tab"><i class="fa fa-star"></i> <?php echo $sterktes[0]['naam'] ?></a></li>
						<li><a href="#mission" data-toggle="tab"><i class="fa fa-trophy"></i> <?php echo $sterktes[1]['naam'] ?></a></li>
						<li><a href="#community" data-toggle="tab"><i class="fa fa-star"></i> <?php echo $sterktes[2]['naam'] ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="about">
							<div class="media">
								<img style="width: 200px;" class="pull-left media-object" src="/Sagittarius/files/images/about-us/about.jpg" alt="about us"> 
								<div class="media-body">
								 <?php echo $sterktes[0]['omschrijving'] ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="mission">
							<div class="media">
								<img style="width: 200px;"  class="pull-left media-object" src="/Sagittarius/files/images/about-us/mission.jpg" alt="Mission"> 
								<div class="media-body">
								 <?php echo $sterktes[1]['omschrijving'] ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="community">
							<div class="media">
								<img style="width: 200px;"  class="pull-left media-object" src="/Sagittarius/files/images/about-us/community.jpg" alt="Community"> 
								<div class="media-body">
								 <?php echo $sterktes[2]['omschrijving'] ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
				    <img src="luck.png" alt="bonne chanche" style="width:80%;margin-left:10%"/>
			   	</div>
			</div>
		</div>
	</section><!--/#about-us-->
		<section id="our-team">
			<div class="container">
				<div class="row text-center">
					<div class="col-sm-8 col-sm-offset-2">
						<h2 class="title-one">Tools</h2>
						<p>Ontdek hoe wij het verschil maken.</p>
					</div>
				</div>
				<div id="team-carousel" class="carousel slide" data-interval="false">
					<a class="member-left" href="#team-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
					<a class="member-right" href="#team-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					<div class="carousel-inner team-members">
					<?php  
                        $cats=getCatogs();
                        $cats=splitMyArray($cats, 2);      ?>
						<div class="row item active">
						  <?php         
                            foreach ($cats[0] as &$cat) {
                                printCat($cat);
                            } ?>
						</div>
							<div class="row item">
						  <?php         
                            foreach ($cats[1] as &$cat) {
                                printCat($cat);
                            } ?>
						</div>
					</div>
				</div>
			</div>
		</section>

	<section id="services" class="parallax-section">
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-8 col-sm-offset-2">
					<h2 class="title-one">Gratis ontwerpen</h2>
					<p>Wij, bieden u de keuze uit een 9-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="our-service" class="our-service">
						<div class="services row">
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[0]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[0]['naam'];?></h2>
										<?php echo $services[0]['omschrijving'];?>
									<a href="/" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								   <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[1]['foto'];?>');background-size:cover;background-position: center;" >
								        
								    </div>
								<h2><?php echo $services[1]['naam'];?></h2>
									<?php echo $services[1]['omschrijving'];?>
										<a  class="btn btn-default" style="background:transparent;color:orange;">ACTIVE</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[2]['foto'];?>');background-size:cover;background-position: center;" >
								    </div>
								    <h2><?php echo $services[2]['naam'];?></h2>
									<?php echo $services[2]['omschrijving'];?>
									<a href="/aquarius.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
						</div>
						<div class="services row">
						    <div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[3]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[3]['naam'];?></h2>
										<?php echo $services[3]['omschrijving'];?>
											<a href="/pieces.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[4]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[4]['naam'];?></h2>
										<?php echo $services[4]['omschrijving'];?>
											<a href="/libra.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[5]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[5]['naam'];?></h2>
										<?php echo $services[5]['omschrijving'];?>
											<a href="/capricorn.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
					    </div>
					    <div class="services row">
						    <div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[6]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[6]['naam'];?></h2>
										<?php echo $services[6]['omschrijving'];?>
											<a href="/scorpio.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[7]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[7]['naam'];?></h2>
										<?php echo $services[7]['omschrijving'];?>
											<a href="/ariers.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[8]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[8]['naam'];?></h2>
										<?php echo $services[8]['omschrijving'];?>
											<a href="/cancer.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
						
					    </div>
					    <div class="services row">
					        	<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[9]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[9]['naam'];?></h2>
										<?php echo $services[9]['omschrijving'];?>
											<a href="/<?php echo $services[9]['naam'];?>.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[10]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[10]['naam'];?></h2>
										<?php echo $services[10]['omschrijving'];?>
											<a href="/<?php echo $services[10]['naam'];?>.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
							<div class="col-sm-4">
								<div class="single-service">
								    <div style="margin-left:auto;margin-right:auto;border: 1px solid white;border-radius: 50%;width:300px;padding-bottom:300px;background: url('/services/<?php echo $services[11]['foto'];?>');background-size:cover; background-position: center;" >
								        
								    </div>
								
									<h2><?php echo $services[11]['naam'];?></h2>
										<?php echo $services[11]['omschrijving'];?>
											<a href="/<?php echo $services[11]['naam'];?>.php" class="btn btn-default" style="background:transparent;color:orange;">BEKIJK</a>	
								</div>
							</div>
					    </div>
					</div>
				</div>
			</div>
		</section><!--/#service-->



				

					<section id="blog"> 
						<div class="container">
							<div class="row text-center clearfix">
								<div class="col-sm-8 col-sm-offset-2">
									<h2 class="title-one">Blog</h2>
									<p class="blog-heading">Opzoek naar een blog? Wij bieden u de meest eenvoudige manier om uw nieuws te delen met de wereld.</p>
								</div>
							</div> 
							<div class="row">
							    <?php 
							    $services=getBlogs($ctrl);
							    if($ctrl->count('news')<2){
                                    printBlog($services);
                                }else{
                                    foreach ($services as &$value) {
                                        printBlog($value);
                                    }     
                                } 
							    
							    ?>
								
							</div> 
						</section> <!--/#blog-->
							<section id="clients" class="parallax-section">
						<div class="container">
							<div class="clients-wrapper">
								<div class="row text-center">
									<div class="col-sm-8 col-sm-offset-2">
										<h2 class="title-one">Reviews</h2>
										<p>Ontdek wat klanten ervan vinden.</p>
									</div>
								</div>
								<div id="clients-carousel" class="carousel slide" data-ride="carousel"> <!-- Indicators -->
									<ol class="carousel-indicators">
										<li data-target="#clients-carousel" data-slide-to="0" class="active"></li>
										<li data-target="#clients-carousel" data-slide-to="1"></li>
										<li data-target="#clients-carousel" data-slide-to="2"></li>
									</ol> <!-- Wrapper for slides -->
									<div class="carousel-inner">
										 <?php $reviews=getReviews($ctrl); 
										        $klasse="active";
									             foreach ($reviews as &$value) {
                                                    if($value['publish']){
                                                         echo '<div class="item '.$klasse.'">
											<div class="single-client">
												<div class="media">
														<img class="pull-left" src="images/clients/client1.jpg" alt="">
													<div class="media-body">
														<blockquote style="color:white!important;">'.$value['info'].'<small>'.$value['naam'].'</small></blockquote>
													</div>
												</div>
											</div>
										</div>';
										$klasse='';
                                            }
									    }
									    ?>
										
									</div>
								</div>
							</div>
						</div>
					</section><!--/#clients-->
					 <section  class="text-center" style="margin-top:100px;padding-bottom:0;" >
      <div style="padding-top:100px;padding-left:25px;padding-right:25px;">
           <h1>Online betalingen was nog nooit zo eenvoudig.</h1>
      <p style="color:black;">Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
      </div>
     
      <img src="mollie.png" style="width:100%;" alt="online betalen was nog nooit zo eenvoudig." />
  </section>
<div class="more-area" id="" style="    background: url(../img/more2.png) no-repeat center center;
    background-size: cover;padding:32px 0;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="pull-left" id="gratis" style="color:white;background: rgba(0,0,0,0.6);padding:5px;">Ontdek hoe wij het verschil kunnen maken.</h2>
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: white; background: transparent;margin-top:20px;font-size:2em;color:white;">Bekijk.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
						<section id="contact">
							<div class="container">
								<div class="row text-center clearfix">
									<div class="col-sm-8 col-sm-offset-2">
										<div class="contact-heading">
											<h2 class="title-one">Contact</h2>
											<p>Stuur ons gerust een bericht.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="container">
								<div class="contact-details" >
									<div class="pattern"></div>
									<div class="row text-center clearfix">
										<div class="col-sm-6">
											<div style="padding-top:8px;" class="contact-address"><address><p><span>Web</span>Land</p><strong> Waversebaan 57, 3001 Leuven<br><?php echo $seo[3]['waarde'];?><br> TVA: <?php echo $seo[13]['waarde'];?></strong><br><small></small></address>
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
            <div class="col-md-12">
                <table style="width:100%;">
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
          
        </div>
												<div class="social-icons" style="padding-top:8px;">
													<a href="https://www.facebook.com/webland.belgie"><i class="fa fa-facebook"></i></a>
													<a href="https://www.instagram.com/webland_belgie/"><i class="fa fa-instagram"></i></a>
												
												</div>
												
											</div>
											 
										</div>
										<div class="col-sm-6"> 
											<div id="contact-form-section">
												<div class="status alert alert-success" style="display: none"></div>
												<form id="contact-form" class="contact" name="contact-form" method="post" action="send-mail.php">
													<div class="form-group">
														<input type="text" name="name" class="form-control name-field" required="required" placeholder="Your Name"></div>
														<div class="form-group">
															<input type="email" name="email" class="form-control mail-field" required="required" placeholder="Your Email">
														</div> 
														<div class="form-group">
															<textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
														</div> 
														<div class="form-group">
															<button type="submit" class="btn btn-primary">Send</button>
														</div>
													</form> 
												</div>
											</div>
										</div>
									</div>
								</div> 
							</section> <!--/#contact--> 
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10003703.93002628!2d-4.89514483266907!3d52.255905864975766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1613b61426d85%3A0x52bed37ce3e8c65d!2sWebland%20Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1604050229893!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
							<?php $ctrl->print_chat(); ?>

	<footer id="footer"> 
		<div class="container"> 
			<div class="text-center"> 
				<p>Copyright &copy; 2019 - Webland.be | All Rights Reserved </p> 
			</div> 
		</div> 
	</footer> <!--/#footer--> 

	<script type="text/javascript" src="/Sagittarius/files/js/jquery.js"></script> 
	<script type="text/javascript" src="/Sagittarius/files/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Sagittarius/files/js/smoothscroll.js"></script> 
	<script type="text/javascript" src="/Sagittarius/files/js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="/Sagittarius/files/js/jquery.prettyPhoto.js"></script> 
	<script type="text/javascript" src="/Sagittarius/files/js/jquery.parallax.js"></script> 
	<script type="text/javascript" src="/Sagittarius/files/js/main.js"></script> 
	<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
	<script>
	    $("#our-service").slick({
  dots: true,
  infinite: true,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
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

