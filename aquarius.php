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
            echo '<a style="background: transparent; border: 1px solid black;" class="btn btn-default" href="/shop/index.php?cat='.$cat['id'].'"> ONTDEK </a> </div>';

            
            echo '</div></div>';
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


function getPromo(){

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
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image"              content="/logo.png" />
  <title>WEBLAND | Bij ons betaalt u niet teveel!</title>
  <meta name="description" content="">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="/font5/css/fontawesome.min.css">
	<link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">      
	<link href="css/a-main.css" rel="stylesheet">
	 <link href="css/responsive.css" rel="stylesheet">
	 <link href="css/rs-style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
	 <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
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


.small-title
{
    color: white;
    font-size: 50px;
    font-family: "Josefin Sans", sans-serif;
    padding: 8px;
    background: rgba(0,0,0,0.7);
}

.smaller-title
{
    color: white;
    font-size: 35px;
    font-family: "Josefin Sans", sans-serif;
    padding: 8px;
    background: rgba(0,0,0,0.7);
}

.navbar {
    border-radius: 0;
    margin-bottom: 0;
    background: white;
    padding: 15px 0;
    padding-bottom: 0;
    color: black;
    border-bottom:1px solid black;
}

.more-area h2 {
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: 400;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 25px;
    padding-top: 8px;
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

.item{
    background: rgba(0,0,0,0.5);
    padding:25px;
}

.double-border{ 	
background-color: black;
    border: 2px solid black;
    padding: 0.5em;
    position: relative;
    margin: 0 auto;
}

.snow-flake {
    width: 100%;
    padding-bottom: 60%;
}


    </style>
  </head>
  <body class="homepage"> 
   <div class="loader" id="loader"></div>
	<header id="header">
        <?php $ctrl->print_nav_aquarius()?>
    </header><!--/header-->
    
    	<div class="tp-banner-container">
		<div class="tp-banner" >
			<ul>
			
				<!-- SLIDE  -->
				<li data-transition="boxslide" data-slotamount="7" data-masterspeed="1500" >
					<!-- MAIN IMAGE -->
					<img src="/slides/service-1.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
				<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="center" 
data-y="center"
data-speed="1000"
data-start="2500"
data-easing="Power3.easeIn"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title second-title"><?php echo  $slide1['titel']; ?></h2>
</div>

<div class="tp-caption  lfl tp-resizeme"
data-x="center" 
data-y="center" data-voffset="70" 
data-speed="1000"
data-start="2800"
data-easing="Power3.easeIn"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">

<h4 class="smaller-title second-title"><?php echo  $slide1['Conclusie']; ?></h4>
</div>


				</li>
				<!-- SLIDE  -->
				<li data-transition="boxslide" data-slotamount="7" data-masterspeed="1000" >
					<!-- MAIN IMAGE -->
					<img src="/slides/service-2.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
			<div class="tp-caption  lfl tp-resizeme"
data-x="center" 
data-y="center"
data-speed="1000"
data-start="2500"
data-easing="Power3.easeIn"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title second-title"><?php echo  $slide2['titel']; ?></h2>
</div>

<div class="tp-caption  lfl tp-resizeme"
data-x="center" 
data-y="center" data-voffset="70" 
data-speed="1000"
data-start="2800"
data-easing="Power3.easeIn"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">

<h4 class="smaller-title second-title"><?php echo  $slide2['Conclusie']; ?></h4>
</div>
				</li>
				
				
					<!-- SLIDE  -->
				<li data-transition="boxslide" data-slotamount="7" data-masterspeed="1000" >
					<!-- MAIN IMAGE -->
					<img src="/slides/service-3.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
			<div class="tp-caption  lfl tp-resizeme"
data-x="center" 
data-y="center"
data-speed="1000"
data-start="2500"
data-easing="Power3.easeIn"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title second-title"><?php echo  $slide3['titel']; ?></h2>
</div>

<div class="tp-caption  lfl tp-resizeme"
data-x="center" 
data-y="center" data-voffset="70" 
data-speed="1000"
data-start="2800"
data-easing="Power3.easeIn"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">

<h4 class="smaller-title second-title"><?php echo  $slide3['Conclusie']; ?></h4>
</div>
				</li>
			</ul>
		</div>
	</div>
    
	
	<div class="slider">
		<div class="container">
			<div id="about-slider">
                <img style="width: 20%; margin-left:  40%;" id="logo" src="/logo.png"/>
			</div><!--/#about-slider-->
		</div>
	</div>

	 <section id="feature" style="padding-top: 25px;">
        <div class="container">
           <div class="center wow fadeInDown">
               <h1 style="color:black;">Welkom</h1>
               <?php echo  getPromo(); ?> 
            </div>
                 <?php $services= getSterk();?>
            <div class="row" style="margin-bottom: 25px;">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-star" style="color: 	#696969;"></i>
                            <h2><?php echo $services[0]['naam'] ?></h2>
                          <?php echo $services[0]['omschrijving'] ?>
                           
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-star" style="color: 	#696969;"></i>
                            <h2><?php echo $services[1]['naam'] ?></h2>
                         <?php echo $services[1]['omschrijving'] ?>
                          
                        </div>
                    </div><!--/.col-md-4-->
                     <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-star" style="color: 	#696969;"></i>
                            <h2><?php echo $services[2]['naam'] ?></h2>
                         <?php echo $services[2]['omschrijving'] ?>
                           
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.services-->
            </div><!--/.row-->  
            <div class="row">
                <div class="blackboard">
					<div class="krijt"> 
					    <?php echo  getKrijt(); ?> 
                    </div>
				</div>
            </div>
            <div style="margin-top: 10px;"></div>
        </div><!--/.container-->
    </section><!--/#feature-->
	
	<section style="margin-bottom:350px;">
	    <div id="carnaval">
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
	             
	</section>
	 <section>
    <div class="diagonal-box">
	    <div class="content" style="padding-top:150px !important;padding-bottom:150px !important;">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-6" style="background: rgba(0,0,0,0.8);padding:35px;">
	                    <h1 style="color:white;text-decoration: underline;margin-bottom:8px;">Gratis ontwerpen.</h1>
	                    <p style="color:white;font-size:1.2em;">Wij, bieden u de keuze uit een 7-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
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
                
        $hours= getHours();        
                
        ?>
        <div class="row">
            <div class="col-md-6">
                <h3>Ma: <?php echo $hours[0]['waarde']?></h3>
                <h3>Di: <?php echo $hours[1]['waarde']?></h3>
                <h3>Wo: <?php echo $hours[2]['waarde']?></h3>
                <h3>Do: <?php echo $hours[3]['waarde']?></h3>
                <h3>Vr: <?php echo $hours[4]['waarde']?></h3>
                <h3>Za: <?php echo $hours[5]['waarde']?></h3>
                <h3>Zo: <?php echo $hours[6]['waarde']?></h3>
            </div>
            <div class="col-md-6">
                   <img src="/img/clock.jpg" style="width:60%;margin-left:20%;"/>
            </div>
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
  
	
	   <section  class="text-center" style="margin-top:100px;padding-bottom:0;" >
      <div style="padding-top:100px;padding-left:25px;padding-right:25px;">
           <h1 style="color:black;">Online betalingen was nog nooit zo eenvoudig.</h1>
      <p style="color:black;">Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
      </div>
     
      <img src="mollie.png" style="width:100%;" alt="online betalen was nog nooit zo eenvoudig." />
  </section>
   <div class="more-area" id="" style=" padding:32px 0;   background: url(../img/more.png) no-repeat center center;
    background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="pull-left" id="gratis" style="color:white;background: rgba(0,0,0,0.6);padding:5px;">Ontdek hoe wij het verschil kunnen maken.</h2>
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: white; background: transparent;    font-family: 'Open Sans', sans-serif;margin-top:20px;
    text-transform: uppercase;
    font-size: 20px;
    border: 1px solid #fff;">Bekijk.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10072.82079286013!2d4.694184!3d50.8644008!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x52bed37ce3e8c65d!2sWebland+Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1557409760050!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>   
	<?php  print_chat(); ?>
	<footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                   © 2019 Comet Web OS - Aquarius edition All rights reserved by <a href="http://webland.be">webland</a>
                </div>
                <!-- 
                    All links in the footer should remain intact. 
                    Licenseing information is available at: http://bootstraptaste.com/license/
                    You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Gp
                -->
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <a href="/tegels">Admin</a>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>   
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
    <script src="js/wow.min.js"></script>
	<script src="js/main.js"></script>
		 <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
		<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
	 	<script type="text/javascript">
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
				jQuery(document).ready(function() {
					   jQuery('.tp-banner').revolution(
						{
						    dottedOverlay:"none",
                        delay:16000,
                        startwidth:1170,
                        startheight:670,
                        hideThumbs:200,
                        
                        thumbWidth:100,
                        thumbHeight:50,
                        thumbAmount:5,
                        
                        navigationType:"none",
                        navigationArrows:"solo",
                        navigationStyle:"preview4",
                        
                        touchenabled:"on",
                        onHoverStop:"off",
                        
                        swipe_velocity: 0.7,
                        swipe_min_touches: 1,
                        swipe_max_touches: 1,
                        drag_block_vertical: false,
                                                
                                                parallax:"mouse",
                        parallaxBgFreeze:"on",
                        parallaxLevels:[7,4,3,2,5,4,3,2,1,0],
                                                
                        keyboardNavigation:"off",
                        
                        navigationHAlign:"center",
                        navigationVAlign:"bottom",
                        navigationHOffset:0,
                        navigationVOffset:20,

                        soloArrowLeftHalign:"left",
                        soloArrowLeftValign:"center",
                        soloArrowLeftHOffset:20,
                        soloArrowLeftVOffset:0,

                        soloArrowRightHalign:"right",
                        soloArrowRightValign:"center",
                        soloArrowRightHOffset:20,
                        soloArrowRightVOffset:0,
                                
                        shadow:0,
                        fullWidth:"on",
                        fullScreen:"off",

                        spinner:"spinner4",
                        
                        stopLoop:"off",
                        stopAfterLoops:-1,
                        stopAtSlide:-1,

                        shuffle:"off",
                        
                        autoHeight:"off",                       
                        forceFullWidth:"off",                       
                                                
                                                
                                                
                        hideThumbsOnMobile:"off",
                        hideNavDelayOnMobile:1500,                      
                        hideBulletsOnMobile:"off",
                        hideArrowsOnMobile:"off",
                        hideThumbsUnderResolution:0,
                        
                        hideSliderAtLimit:0,
                        hideCaptionAtLimit:0,
                        hideAllCaptionAtLilmit:0,
                        startWithSlide:0,
                        videoJsPath:"rs-plugin/videojs/",
                        fullScreenOffsetContainer: ""   
						});
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
			</script>
			<script>
			    $( document ).ready(function() {
                        $('#loader').hide();
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