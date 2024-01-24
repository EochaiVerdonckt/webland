<?php session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
require (FSPATH."Controllers/slidesController.php"); 
$ctrl=new IndexController();
$services=$ctrl->getServicesPublished();
$seo=$ctrl->getSeo();
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
    
    echo '<div class="col-md-4" style="">
                <div class="caption" style="background: #E0E0E0;">
                <div class="text-center" style="padding: 15px;">
                 <h2>'.$cat['naam'].'</h2>
                 </div>
                    <div class="snow-flake" style="background: url(/categ/'.$cat['foto'].');background-size: cover;"></div>
                   
                     <p style="color:black !important;padding: 15px;">';
                echo     $cat['omschrijving'];
                    
            echo    '</p>';
            echo '<div class="text-center" style="padding-bottom:10px;">';
            echo '<a style="color:black;background: transparent; border: 1px solid black;" class="btn btn-default" href="/shop/index.php?cat='.$cat['id'].'"> ONTDEK </a> </div>';

            
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
    echo '<div class="item">
                <div class="text-center"><h2>'.printStars($review['rating']).'</h2></div>
                <div class="caption" >
                    <div style="color: white!important;font-size:1.5em;">
                      '.$review['info'].'
                    <h3 style="float:right;color: white!important;margin-top:8px;">-'.$review['naam'].'-</h3>
                    
                    </div>';
            echo '</div></div>';
}


function toonLijstEten()
{
    $rij = array();
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
   

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
function print_basket()
{
    if(empty($_SESSION['basket']))
    {
        return;
    }
    
    echo '
    <div style="width:10%; position: fixed; top:10%;z-index:99">
    <div class="thumbnail" style="background: white; border: 1px solid black; padding: 5px;">
      <span class="badge" style="float:right; background: black;color: white;">'.$_SESSION['basket']["teller"].'</span>
      <i class="fa fa-shopping-basket fa-5x" style="color: "></i>
      <div class="caption">
        <p><a href="checkout.php" class="btn btn-primary" role="button">Checkout</a></p>
      </div>
    </div></div>';

    
}

function print_chat()
	{
	    echo '

	    <div style=" position:fixed;right:8%; bottom: 0;z-index:999999;">
<div onclick="showChat()" id="chatbox" class="btn-info btn" style="border-color: black; background-color: black;">  <p style="color:white;"><i class="fa fa-commenting-o fa-2x"></i><span style="padding-left:8px;">Chat</span></p></div>
</div>
<div  id="chatBox" style="float:right;display:none; position:fixed;right:4%; bottom: 0;    z-index: 999999;">
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

function getSideButtons()
{
  
    $rij = array();
  $ctrl=new IndexController();
    $conn = $ctrl->getConnection();

    $sql = 'SELECT * FROM `slide_opt` WHERE naam="button"';
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


function print_artikels()
{
  $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail" style="border: 10px double gray;background:yellow;    padding: 0;"><div style="background: white;">
                    <img src="/news/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption" style="background: black;padding-top: 2%;margin-top: 2%;">              
                       '.$row['info'].'
                       <p> 
                      ';
            echo '</p></div>
                 </div></div></div>';
        }
    }
    mysqli_close($conn);
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
  $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $rij = array();


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


$slide_buttons=getSideButtons();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="og:image" content="logo.png"/>
    <title>WEBLAND | Bij ons betaalt u niet teveel!</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

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

		.krijt
		{
			vertical-align: middle;
			font-family: 'Permanent Marker', cursive;
			font-size: 1.6em;
			color: rgba(238, 238, 238, 0.7);
			padding: 10px;
			min-height: 250px;
		}
		.snow-flake {
    width: 100%;
    padding-bottom: 60%;
}
.item{
    background: #323232;
    padding: 10px;
}

.diagonal-box {
	background:url('zodiac.jpg');
	background-size:cover;
	transform: skewY(-11deg);
} 
.content { 	
    margin: 0 auto; 
    transform: skewY(11deg);
}

.double-border{ 	
background-color: black;
    border: 2px solid black;
    padding: 0.5em;
    position: relative;
    margin: 0 auto;
}


   
    </style>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <a class="menu-toggle rounded" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar-wrapper" style="    background: black;
    border-left: 1px solid #ecb807;">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a class="js-scroll-trigger" href="#page-top">Webland</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#about">Over ons</a>
        </li>
       <li class="sidebar-nav-item">
           <a class="nav-link2" href="/missie.php" >MISSIE</a>
       </li>
      <li class="sidebar-nav-item">
          <a class="nav-link2"  href=" /fotopagina/">FOTOPAGINA</a>
      </li>
     
 <li class="sidebar-nav-item" ><a class="nav-link2"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li class="sidebar-nav-item" ><a class="nav-link2" href="/vragen.php" id="contactA">Q&A</a></li>
  <li class="sidebar-nav-item" ><a class="nav-link2"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li class="sidebar-nav-item" ><a class="nav-link2"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
      </ul>
    </nav>

    <!-- Header -->
    <header class="masthead d-flex" style="    background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.1) 100%), url(/banner.gif);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;">
      <div class="container text-center my-auto">
      
       <div class="text-center" style="padding-top:100px;padding-bottom:100px;">
                <h1 id="brand" style="font-size:4em;text-shadow: 0px 0px 5px rgba(0, 0, 0, 1);"><?php echo $seo['0']['waarde']?></h1>
                <hr >
                <p style="color: white; background: rgba(0,0,0,0.8);width:60%;margin-left:20%;font-size:1.5em;padding:12px;">
                    <?php echo $seo['1']['waarde']?>
                </p>
                
		<hr style="width: 50%;margin-left:25%;color:#C0C0C0;text-shadow: 0px 0px 5px rgba(0, 0, 0, 1); margin-top:10px; margin-bottom:10px;">
		 <a class="btn btn-warning" href="tel:0485865970" style="margin-top:50px;"><i class="fa fa-mobile"></i> BEL NU </a>
      </div>
      <div class="overlay"></div>
    </header>

    <!-- About -->
    <section class="content-section bg-light" id="about">
      <div class="container text-center">
           <img src="/logo.png" alt="foto van ons logo." style="width:20%;border-radius:50%;border:1px solid black;"/>
        <div class="row">
          
          <div class="col-lg-10 mx-auto">
            <h2 style="color:black;">Welkom</h2>
            <?php echo getPromo();?>
        </div>
        </div>
         <div class="row">
				<div class="blackboard" style="">
					<div class="krijt"><?php echo getKrijt();?></div>
				</div>
			</div>
      </div>
      <div class="container">
          <div class="row" style="margin-top: 12px;" id="carnaval">
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
</div>
</section>
  
 
    <!-- Services -->
    <section class="content-section bg-primary text-white text-center" id="services" style="background-color: black !important;">
      <div class="container">
             <div class="row text-center">
             <img src="luck.png"style="margin-left:auto;margin-right:auto;" />
         </div>
         </div>
        <div class="content-section-heading">
          
          <h3 class="text-secondary mb-0">Waarom u voor ons zal kiezen.</h3>
          <h2 class="mb-5">Sterktes</h2>
        </div>
         <?php $services=getSterk();?>
        
        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                        <h4><?php echo $services[0]['naam'] ?></h4>
                                        <?php echo $services[0]['omschrijving'] ?>
                                    </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                        <h4><?php echo $services[1]['naam'] ?></h4>
                                       <?php echo $services[1]['omschrijving'] ?>
                                    </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                       <h4><?php echo $services[2]['naam'] ?></h4>
                                       <?php echo $services[2]['omschrijving'] ?>
                                    </div>
                            </div>
                        </div> <!-- /.row -->
    </section>


    
    <!-- Call to Action -->
    <section style="	background:url('zodiac.jpg');
	background-size:cover;">
    <div class="">
	    <div class="" style="padding-top:150px !important;padding-bottom:150px !important;">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-6" style="background: rgba(0,0,0,0.8);padding:35px;">
	                    <h1 style="color:white;text-decoration: underline;margin-bottom:8px;">Gratis ontwerpen.</h1>
	                    <p style="color:white;font-size:1.2em;">Wij, bieden u de keuze uit een 9-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
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
	    </div>
    </div>
  </section>
  
  <section  class="text-center" style="padding-top:150px;" >
      <div style="padding-left:25px;padding-right:25px;background:white;">
           <h1>Online betalingen was nog nooit zo eenvoudig.</h1>
      <p style="color:black;">Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
      </div>
     
      <img src="mollie.png" style="width:100%;" alt="online betalen was nog nooit zo eenvoudig." />
  </section>
    
    <section id="contact">
        <div class="container-fluid" style="padding: 0;">
      <div class="row">
        <div class="wow zoomIn col-xs-12 col-sm-12 col-md-12">
          <form name="contactForm" id='contact_form' method="post" action='php/email.php' style="">
            <div class="form-inline">
              <div style="background: rgba(0,0,0,0.8);    width: 100%;padding-left:15px;padding-right:15px;" >
                  <div class="text-center">
                       <h1 style="color: white;margin-top:8px;">Stuur een bericht.</h1>
                  </div>
                 
                  <div class="form-group">
                <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="name" style="margin-top: 1%;
    width: 100%;">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="exampleInputEmail" placeholder="email address" style="margin-top: 1%;
    width: 100%;">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="exampleInputSubject" placeholder="subject" style="margin-top: 1%;
    width: 100%;">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="company" id="exampleInputCompany" placeholder="company" style="margin-top: 1%;
    width: 100%;">
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="3" id="exampleInputMessage" placeholder="message" style="width:100%;margin-top:1%;"></textarea>
              </div>
                <input type="submit" id='send_message' class="btn btn-block  btn-lg costom-btn" value="send" style="background-color: white;color: black; border-color: white;margin-top:1%;margin-bottom:1%;">
            </div>
            <div style="background: rgba(0,0,0,0.8); width:100%;color: white;text-align:center; padding: 4%; font-size: 1.5em;"
                <?php if($_SESSION['mail']=="sent"){ ?>
              <div id='mail_success' class='success'>Your message has been sent successfully.
              </div><!-- success message -->
              <?php }?>
                <?php if($_SESSION['mail']=="failed"){?>
              <div id='mail_fail' class='error'> Sorry, error occured this time sending your message.
              </div><!-- error message -->
               <?php }?>
            </div>
              
          </form>
        </div> <!-- /.col-xs-12 .col-sm-offset-2 .col-sm-8 -->
            <div class="col-xs-12">
                
        </div><!-- /.col-xs-12 -->
          </form>
          </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
    </section>
    
    
  
    
    <?php $ctrl->print_chat(); ?>

    <!-- Map -->
    <section  class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10072.82079286013!2d4.694184!3d50.8644008!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x52bed37ce3e8c65d!2sWebland+Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1546880186935" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
         <img src="logo.png" style="width:10%;">   
      <div class="container">
        <ul class="list-inline mb-5">
        </ul>
        <p class="text-muted small mb-0">Copyright © 2019 Comet Web OS - Scorpio edition All rights reserved by <a href="http://webland.be">webland</a></p>
      </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    
    
    <!-- jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap core JavaScript -->

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/stylish-portfolio.min.js"></script>
    <script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>
<script>
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
$('#carnaval').slick({
  dots: true,
  infinite: true,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
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
</script>
  </body>
</html>


