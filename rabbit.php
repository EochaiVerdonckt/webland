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
    	<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
        			<a href="/shop/index.php?cat='.$cat['id'].'" class="img" style="background-image: url(/categ/'.$cat['foto'].');"></a>
        			<div class="text">
        				<p class="price"><span class="old-price">50€</span><span class="orig-price">25€<small>/mo</small></span></p>
        			
        				<h3><a href="/shop/index.php?cat='.$cat['id'].'">'.$cat['naam'].'</a></h3>
        				<span class="location">'.$cat['omschrijving'].'</span>
        				<a href="/shop/index.php?cat='.$cat['id'].'" class="d-flex align-items-center justify-content-center btn-custom">
        					<span class="ion-ios-link"></span>
        				</a>
        			</div>
        		</div>
        	</div>
    
    ';
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

function getBlogs($ctrl){
 $ctrl=new IndexController();
$conn = $ctrl->getConnection();
    $sql = "SELECT * FROM news where publish=1";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    }
    else{
        //echo "Uurrooster niet gevonden";
    }

    $conn->close();
    return $item;
}


function printBlog($blog){
    echo '
    
      <div class="col-md-3 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text">
                <h3 class="heading"><a href="/detail.php?id='.$blog['id'].'">'.$blog['titel'].'</a></h3>
                <div class="meta mb-3">
           
                </div>
                <a href="/detail.php?id='.$blog['id'].'" class="block-20 img" style="background-image: url(/blog/'.$blog['foto'].');">
	              <p style="display:none;">'.$blog['titel'].'</p></a>
                '.$blog['inleiding'].'
              </div>
            </div>
          </div>
    
   ';
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
    <div class="item">
                <div class="testimony-wrap py-4">
                  <div class="text">
                    '.$review['info'].'
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(ophiuchus/assets/img/client-2.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">'.$review['naam'].'</p>
		                    <span class="position">'.printStars($review['rating']).'</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
    ';
}

?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Rabbit Uw website online in 7 dagen.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $seo[1]['waarde']?>">
     <meta name="keywords" content="Websites, webbureau, zelf aanpasbaar.">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="/rabbit/source/css/icomoon.csscss/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/rabbit/source/css/animate.css">
    
    <link rel="stylesheet" href="/rabbit/source/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/rabbit/source/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/rabbit/source/css/magnific-popup.css">

    <link rel="stylesheet" href="/rabbit/source/css/aos.css">

    <link rel="stylesheet" href="/rabbit/source/css/ionicons.min.css">

    <link rel="stylesheet" href="/rabbit/source/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/rabbit/source/css/jquery.timepicker.css">
    <link rel="stylesheet" href="/rabbit/source/css/flaticon.css">
    <link rel="stylesheet" href="/rabbit/source/css/icomoon.css">
    <link rel="stylesheet" href="/rabbit/source/css/style.css">
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
  </head>
  <body>
    
	 <?php $ctrl->print_nav_rabbit(); ?>
    <!-- END nav -->
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('/slides/service-3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-center align-items-center">
          <div class="col-lg-8 col-md-6 ftco-animate d-flex align-items-end">
          	<div class="text text-center" style="background: rgba(255,255,255,0.5); padding: 12px;">
	            <h2 class="mb-4">Bij ons betaalt u niet teveel</h2>
	            <p style="font-size: 18px;">Wij leveren u een oplossing op maat van uw bedrijf. In een design om van te smullen. </p>
	            <!-- <form action="#" class="search-location mt-md-5">
		        		<div class="row justify-content-center">
		        			<div class="col-lg-10 align-items-end">
		        				<div class="form-group">
		          				<div class="form-field">
				                <input type="text" class="form-control" placeholder="Search location">
				                <button><span class="ion-ios-search"></span></button>
				              </div>
			              </div>
		        			</div>
		        		</div>
		        	</form>-->
            </div>
          </div>
        </div>
      </div>
      <div class="mouse">
				<a href="#" class="mouse-icon">
					<div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
				</a>
			</div>
    </div>

    <section class="ftco-section ftco-no-pb">
      <div class="container">
            <div class="center wow fadeInDown">
               <h1 style="color:black;">Welkom bij uw nieuwe IT oplossing.</h1>
               <?php echo  getPromo(); ?> 
            </div>  
             <div class="row text-center">
                 <div style="text-align:center;width:100%">
                   <a href="tel:0485865970" class="btn btn" style="border:1px solid black;">BEL NU </a>          
                 </div>
               
			</div>
                  <div class="row">
                <div class="blackboard">
					<div class="krijt"> 
					    <?php echo  getKrijt(); ?> 
                    </div>
				</div>
            </div>
              <?php $services= getSterk();?>
      	<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">Onze sterktes</span>
            <h2 class="mb-2">Waarom u zeker voor ons moet kiezen.</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
            	<div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-piggy-bank"></span></div>
              <div class="media-body py-md-4">
                <h3><?php echo $services[0]['naam'] ?></h3>
                 <?php echo $services[0]['omschrijving'] ?>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
            	<div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-wallet"></span></div>
              <div class="media-body py-md-4">
                <h3><?php echo $services[1]['naam'] ?></h3>
                <?php echo $services[1]['omschrijving'] ?>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
            	<div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-file"></span></div>
              <div class="media-body py-md-4">
                <h3><?php echo $services[2]['naam'] ?></h3>
                 <?php echo $services[2]['omschrijving'] ?>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
            	<div class="icon d-flex justify-content-center align-items-center"><span class="flaticon-locked"></span></div>
              <div class="media-body py-md-4">
                <h3><?php echo $services[3]['naam'] ?></h3>
                 <?php echo $services[3]['omschrijving'] ?>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section goto-here">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">Digitale Tools</span>
            <h2 class="mb-2">Uw bedrijf in uw broekzak</h2>
          </div>
        </div>
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
    
        </div>
    	</div>
    </section>

    <section class="ftco-section ftco-degree-bg services-section img mx-md-5" style="background-image: url(/rabbit/source/images/bg_2.jpg);">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-start mb-5">
          <div class="col-md-6 text-center heading-section heading-section-white ftco-animate">
          	<span class="subheading">Openingsuren</span>
            <h2 class="mb-3">0485/865.970</h2>
          </div>
          <?php   $hours= getHours();  ?>
        </div>
    		<div class="row">
    			<div class="col-md-6">
    				<div class="row">
		    			<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>MA</span></div>
		                <h3><?php echo $hours[0]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		          <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>DI</span></div>
		                <h3><?php echo $hours[1]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		          <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>WOE</span></div>
		                <h3><?php echo $hours[2]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		          <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>DO</span></div>
		                <h3><?php echo $hours[3]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		          
		          <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>VR</span></div>
		                <h3><?php echo $hours[4]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		          
		          <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>ZA</span></div>
		                <h3><?php echo $hours[5]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		          
		          
		          <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services services-2">
		              <div class="media-body py-md-4 text-center">
		              	<div class="icon mb-3 d-flex align-items-center justify-content-center"><span>ZON</span></div>
		                <h3><?php echo $hours[6]['waarde']?></h3>
		                
		              </div>
		            </div>      
		          </div>
		        </div>
		      </div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section ftco-no-pb">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(/rabbit/source/images/about.jpg);">
					</div>
					<div class="col-md-6 wrap-about py-md-5 ftco-animate">
	          <div class="heading-section p-md-5">
	            <h2 class="mb-4">Online betalen. Nog nooit zo eenvoudig.</h2>

	            <p>Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
	            <p>Zo ontvangt u dagelijks meteen alle opbrengsten van uw website meteen op uw rekening.</p>
	          </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-counter img" id="section-counter">
    	<div class="container">
    		<div class="row">
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="70">0</strong>
                <span>Resto <br>Klanten</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="403">0</strong>
                <span>Online Bestellingen<br> elke dag</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="25">0</strong>
                <span>Gem <br>Bestelling</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text d-flex align-items-center">
                <strong class="number" data-number="5425">0</strong>
                <span>Totaal <br>commissievrij</span>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          <!--	<span class="subheading">Reviews</span>
            <h2 class="mb-3">Wat klanten u al kunnen vertellen.</h2>-->
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
               <?php $reviews=getReviews($ctrl);?>
                              <?php 
      foreach ($reviews as &$value) {
            if($value['publish']==1){
                printReview($value);
            }
          
      }
      
      ?> 
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-agent ftco-no-pt">
    	<div class="container">
    		<div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">ONTWERPEN</span>
            <h5 class="mb-4">Wij, bieden u de keuze uit een 15-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</h5>
          </div>
        </div>
        <?php $services=$ctrl->getServicesPublished(); ?>
        <div class="row">
        	<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[0]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/virgo.php"><?php echo $services[0]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[1]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/sagittarius.php"><?php echo $services[1]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[2]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/aquarius.php"><?php echo $services[2]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[3]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/pieces.php"><?php echo $services[3]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[4]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/libra.php"><?php echo $services[4]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[5]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/capricorn.php"><?php echo $services[5]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[6]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/scorpio.php"><?php echo $services[6]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
           <div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[7]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/ariers.php"><?php echo $services[7]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[8]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/cancer.php"><?php echo $services[8]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[9]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/lion.php"><?php echo $services[9]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[10]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/taurus.php"><?php echo $services[10]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[11]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/gemini.php"><?php echo $services[11]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        	
        		<div class="col-md-3 ftco-animate">
        		<div class="agent">
    					<div class="img">
		    				<img src="/services/<?php echo $services[12]['foto'];?>" class="img-fluid" alt="Webland | <?php echo $services[7]['naam'];?>">
	    				</div>
	    				<div class="desc">
	    					<h3><a href="/ophiuchus.php"><?php echo $services[12]['naam'];?></a></h3>
								<p class="h-info">Eenvoudig in gebruik en aanpasbaar.</p>
	    				</div>
    				</div>
        	</div>
        	
        </div>
    	</div>
    </section>


    <section class="ftco-section ftco-no-pt">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Blog</span>
            <h2>Nieuws</h2>
            <h3>Er is momenteel geen nieuws.</h3>
          </div>
        </div>
        <div class="row d-flex">
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
      </div>
    </section>	


    <footer class="ftco-footer ftco-section">
      <div class="container">
          <!--)
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Uptown</h2>
              <p>Far far away, behind the word mountains, far from the countries.</p>
              <ul class="ftco-footer-social list-unstyled mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Community</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Search Properties</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>For Agents</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Reviews</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>FAQs</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">About Us</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Our Story</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Meet the team</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Company</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About Us</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Press</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope pr-4"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        
        -->
        <div class="row">
          <div class="col-md-12 text-center">
	
            <p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by <a href="https://webland.be" target="_blank">Webland</a></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/rabbit/source/js/jquery.min.js"></script>
  <script src="/rabbit/source/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/rabbit/source/js/popper.min.js"></script>
  <script src="/rabbit/source/js/bootstrap.min.js"></script>
  <script src="/rabbit/source/js/jquery.easing.1.3.js"></script>
  <script src="/rabbit/source/js/jquery.waypoints.min.js"></script>
  <script src="/rabbit/source/js/jquery.stellar.min.js"></script>
  <script src="/rabbit/source/js/owl.carousel.min.js"></script>
  <script src="/rabbit/source/js/jquery.magnific-popup.min.js"></script>
  <script src="/rabbit/source/js/aos.js"></script>
  <script src="/rabbit/source/js/jquery.animateNumber.min.js"></script>
  <script src="/rabbit/source/js/bootstrap-datepicker.js"></script>
  <script src="/rabbit/source/js/jquery.timepicker.min.js"></script>
  <script src="/rabbit/source/js/scrollax.min.js"></script>
  <script src="/rabbit/source/js/main.js"></script>
    
  </body>
</html>