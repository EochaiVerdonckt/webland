<?php session_start();

$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
require (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 
require (FSPATH."Controllers/indexController.php"); 
$ctrl=new SlidesController();

function toonLijstEten()
{
$ctrl=new IndexController();
    $conn= $ctrl->getConnection();

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

function print_basket()
{
    if(empty($_SESSION['basket']))
    {
        return;
    }
    
    echo '
    <div style="width:10%; position: fixed; top:10%;z-index:99; right:2%;">
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

function getSideButtons()
{
   $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
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
   $ctrl=new IndexController();
    $conn= $ctrl->getConnection();

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
  $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM sterk";
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
    $conn= $ctrl->getConnection();
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


function getKrijt()
{
   $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
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

function getHours()
{
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
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

$slide_buttons=getSideButtons();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>WEBLAND</title>
  <meta property="og:description" 
  content="Professionele websites, die u zelf makkelijk kan aanpassen, met eigen hosting en domeinnaam vanaf €180/jaar" />
  <meta name="description" content="Professionele websites, die u zelf makkelijk kan aanpassen, met eigen hosting en domeinnaam vanaf €180/jaar">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image"              content="logo.png" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>
  <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.css" type="text/css" rel="stylesheet" />
  <!-- Revolution css -->
  <link rel="stylesheet" type="text/css" href="vendor/rs-plugin/css/settings.css" media="screen"/>
  <link rel="stylesheet" href="vendor/rs-plugin/css/extralayer.css">
  
  <!-- Flat icon css -->
  <link rel="stylesheet" href="vendor/flat-icon/flaticon.css">
  
  <!-- Font awesome -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Owl Carosel css -->
  <link rel="stylesheet" href="vendor/owl/css/owl.carousel.min.css">
  <link rel="stylesheet" href="vendor/owl/css/owl.theme.default.css">
  <link rel="stylesheet" href="vendor/owl/css/owl.theme.css">
  
  <!-- mmenu -->
  <link type="text/css" rel="stylesheet" href="vendor/mmenu/css/jquery.mmenu.css" />
  
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">

  <!-- Animate css -->
  <link rel="stylesheet" href="css/animate.css">

  <!-- Custom Style css -->
  <link rel="stylesheet" href="css/hover.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  
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

#smallScreen
{
    display:none;
}

@media only screen and (max-width: 800px) {
  #Bigscreen {
   display: none;
  }
  #smallScreen
{
    display:block !important;
}
}

        
</style>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->
</head>
<body data-spy="scroll" data-target="#main-navbar">
  <div class="loader"></div>
  <div class="main" id="home">
       <!-- Begin Navbar -->
                <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="    margin-bottom: 0;
    background-color: black;
    color: white;
    border: 0;
    border-radius: 0;"> <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->

                  <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="toggleClick();">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand page-scroll" href="index.php">WEBLAND</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a style="color: white;" class="page-scroll"  href="#services-section">Over ons</a></li>
                            <li style="padding-left: 0;"><a style="color: white;" class="page-scroll"  href="#contact-section">Contact</a></li>
                            <li style="padding-left: 0;"><a style="color: white;" class="page-scroll"  href="/agenda/fullcalendar/planners/60.php">Afspraak</a></li>
                       <li style="padding-left: 0;"><a style="color: white;" class="page-scroll"  href="/menu.php">Menu</a></li>
                              <li style="padding-left: 0;"><a style="color: white;" class="page-scroll"  href="/GDPR.pdf">GDPR</a></li>
                              <li style="padding-left: 0;"><a style="color: white;" class="page-scroll"  href="/tegels"><i class="fa fa-lock "></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container -->
                </nav>
                <!-- End Navbar --> 
    <!-- slider -->
      <div class="tp-banner-container">
      <div class="tp-banner">
        <ul>  <!-- SLIDE  -->
          <li data-transition="fade" data-slotamount="25" data-masterspeed="2500"  data-thumb="/mysite/slide-1.jpg"  data-saveperformance="off">
            <!-- MAIN IMAGE -->
            <img src="/mysite/slide-1.jpg"  alt="fullslide2" data-bgposition="center center" data-kenburns="on" data-duration="12000" data-ease="Power0.easeInOut" data-bgfit="115" data-bgfitend="100" data-bgpositionend="center center">
            
            
            <!-- LAYER NR. 5 -->
<div class="tp-caption tp-resizeme lfb randomrotate down-arrow BigScreen"
data-x="right" data-hoffset="0"
data-y="center" data-voffset="120"
data-speed="2200"
data-start="9500"
data-easing="Power4.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 3; max-width: 50px; max-height: 50px; white-space: nowrap;">
<a class="btn btn-warning" style="padding:20px;color: white" href="/menu.php">
    <i class="fa fa-map fa-3x"></i> <h1 style="color white !important; padding-top: 5px;"><span style="color: white;">Menu</span></h1></a>
</div>            
            
            <!-- LAYER NR. 5 -->
<div class="tp-caption tp-resizeme lfb randomrotate down-arrow BigScreen"
data-x="right" data-hoffset="-250"
data-y="center" data-voffset="120"
data-speed="2200"
data-start="9500"
data-easing="Power4.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 3; max-width: 50px; max-height: 50px; white-space: nowrap;">
<a class="btn btn-danger" style="padding:20px;color: white" href="/agenda/fullcalendar/planners/60.php">
    <i class="fa fa-calendar fa-3x"></i> <h1 style="color white !important; padding-top: 5px;"><span style="color: white;">Afspraak</span></h1></a>
</div>


<!-- LAYER NR. 5 -->
<div class="tp-caption tp-resizeme lfb randomrotate down-arrow BigScreen"
data-x="right" data-hoffset="-550"
data-y="center" data-voffset="120"
data-speed="2200"
data-start="9500"
data-easing="Power4.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 3; max-width: 50px; max-height: 50px; white-space: nowrap;">
<a class="btn btn-info" style="padding:20px;color: white" href="reserveer.php">
    <i class="fa fa-calendar fa-3x"></i> <h1 style="color white !important; padding-top: 5px;"><span style="color: white;">Reserveer</span></h1></a>
</div>




<li class="items" data-transition="slideleft" data-slotamount="1" data-masterspeed="1500" data-thumb="/mysite/slide-2.jpg" data-delay="13000"  data-saveperformance="on">
  <!-- MAIN IMAGE -->
  <img src="/mysite/slide-2.jpg"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
  <!-- LAYERS -->



<!-- LAYER NR. 2 -->
<div class=" tp-caption  lfl tp-resizeme"
data-x="left"
data-y="340"
data-speed="500"
data-start="1500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title">Keuze uit 4 layouts</h2>
</div>

<!-- LAYER NR. 3 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="left"
data-y="400"
data-speed="1000"
data-start="2000"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2  class="small-title">Makkelijk opzegbaar</h2>
</div>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="left"
data-y="460"
data-speed="2000"
data-start="2500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title" >Makkelijk aanpasbaar</h2>
</div>

<!-- LAYER NR. 5 -->
<div class="tp-caption lfr tp-resizeme BigScreen"
data-x="right" data-hoffset="100"
data-y="bottom" data-voffset="-90" 
data-speed="3000"
data-start="4000"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<button type="button" class="btn btn-default buy-btn">De top in Google</button>
</div>





</li>
<li class="items" data-transition="slidevertical" data-slotamount="2" data-masterspeed="1500" data-thumb="/mysite/slide-3.jpg" data-delay="13000"  data-saveperformance="off">
  <!-- MAIN IMAGE -->
  <img src="/mysite/slide-3.jpg"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
  <!-- LAYERS -->


<!-- LAYER NR. 2 -->
<div class=" tp-caption  lfl tp-resizeme"
data-x="-100"
data-y="340"
data-speed="500"
data-start="1500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title">Gereed op elk apparaat</h2>
</div>

<!-- LAYER NR. 3 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="-100"
data-y="400"
data-speed="1000"
data-start="2000"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2  class="small-title">Extenties voor elke onderneming</h2>
</div>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="-100"
data-y="460"
data-speed="2000"
data-start="2500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title" >Zeer hoge klantentevredenheid</h2>
</div>

<!-- LAYER NR. 5 -->
<div class="tp-caption tp-resizeme lfb randomrotate down-arrow BigScreen"
data-x="right" data-hoffset="-250"
data-y="center" data-voffset="120"
data-speed="2200"
data-start="9500"
data-easing="Power4.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 3; max-width: 50px; max-height: 50px; white-space: nowrap;">
<a class="btn btn-danger" style="padding:20px;color: white" href="/agenda/fullcalendar/planners/60.php">
    <i class="fa fa-calendar fa-3x"></i> <h1 style="color white !important; padding-top: 5px;"><span style="color: white;">Afspraak</span></h1></a>
</div>


<!-- LAYER NR. 5 -->
<div class="tp-caption tp-resizeme lfb randomrotate down-arrow BigScreen"
data-x="right" data-hoffset="-550"
data-y="center" data-voffset="120"
data-speed="2200"
data-start="9500"
data-easing="Power4.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 3; max-width: 50px; max-height: 50px; white-space: nowrap;">
<a class="btn btn-info" style="padding:20px;color: white" href="reserveer.php">
    <i class="fa fa-calendar fa-3x"></i> <h1 style="color white !important; padding-top: 5px;"><span style="color: white;">Reserveer</span></h1></a>
</div>


       <!-- LAYER NR. 5 -->
<div class="tp-caption tp-resizeme lfb randomrotate down-arrow BigScreen"
data-x="right" data-hoffset="0"
data-y="center" data-voffset="120"
data-speed="2200"
data-start="9500"
data-easing="Power4.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.1"
data-endspeed="500"
data-endeasing="Power4.easeIn"
style="z-index: 3; max-width: 50px; max-height: 50px; white-space: nowrap;">
<a class="btn btn-warning" style="padding:20px;color: white" href="/menu.php">
    <i class="fa fa-map fa-3x"></i> <h1 style="color white !important; padding-top: 5px;"><span style="color: white;">Menu</span></h1></a>
</div>  

</li>
</ul>
</div>
</div>
    <!-- slider -->
    <div class="container-fluid" id="smallScreen">
        <div class="row">
            <a href="/agenda/fullcalendar/planners/60.php" class="btn btn-block btn-danger"><i class="fa fa-calendar"></i>AFSPRAAK</a>
        </div>
         <div class="row">
            <a href="reserveer.php" class="btn btn-block btn-info"><i class="fa fa-calendar"></i>AFSPRAAK</a>
        </div>
    </div>   
    
 <section style="background-color: white;">
    <img src="logo.png" style="width:10%; margin-left: 45%;margin-top: 2%;"/> 
     
    <div class="container-fluid" style="">
        <div class="row">
             <div class="wow zoomIn col-md-6 col-md-offset-3 text-left">
                 <div id="krijtbord" style="padding-top: 1%; padding-bottom: 2%;color: black;font-size: 1em;">
                    <?php echo getPromo();?>     
                 </div>
                
            </div><!-- col-8 -->
        </div>
        <div class="row">
				<div class="blackboard" style="">
					<div class="krijt"><?php echo getKrijt();?></div>
				</div>
			</div>
    </div>
</section>  


<section id="services-section" class="page" style="background-color:white;">
     <div class="container">
         <?php $services=getSterk();?>
        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0" style="visibility: visible; animation-name: zoomIn;">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                        <h4><?php echo $services[0]['naam'] ?></h4>
                                        <?php echo $services[0]['omschrijving'] ?>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                        <h4><?php echo $services[1]['naam'] ?></h4>
                                       <?php echo $services[1]['omschrijving'] ?>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: zoomIn;">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                       <h4><?php echo $services[2]['naam'] ?></h4>
                                       <?php echo $services[2]['omschrijving'] ?>
                                    </div>
                                </a>
                            </div>
                        </div> <!-- /.row -->
                        
                        			
    </div>
</section>  

 <section>
     <div class="container-fluid">
         <div class="row text-center">
             <h1>4 Layouts </h1>
             <h3>-Eenvoudig aanpasbaar- </h3>
         </div>
     </div>
     
     
     
     
     <div class="row" style="margin-left: 150px; margin-right:150px;margin-top: 50px;">
         <div class="col-md-3">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="text-center">
                            <h3 style="color:white;padding-bottom: 8px">VIRGO </h3>    
                        </div>
                        <img src="virgo.png" style="width:100%;" />
                        <p class="text-center" style="margin-top: 5px;"><a href="" class="btn btn-default" role="button" style="background: black; color: white;"><i class="fa fa-eye"></i> ACTIVE</a></p>
                       
                    </div>  
                </div>
          </div>   
          <div class="col-md-3">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="text-center">
                            <h3 style="color:white;padding-bottom: 8px">SCORPIO </h3>    
                        </div>
                        <img src="scorpio.png" style="width:100%;" />
                        <p class="text-center" style="margin-top: 5px;"><a href="scorpio.php" class="btn btn-default" role="button" style="background: black; color: white;"><i class="fa fa-eye"></i> ONTDEK</a></p>
                       
                    </div>  
                </div>
          </div>   
          <div class="col-md-3">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="text-center">
                            <h3 style="color:white;padding-bottom: 8px">PIECES </h3>    
                        </div>
                        <img src="pieces.png" style="width:100%;" />
                        <p class="text-center" style="margin-top: 5px;"><a href="pieces.php" class="btn btn-default" role="button" style="background: black; color: white;"><i class="fa fa-eye"></i> ONTDEK</a></p>
                       
                    </div>  
                </div>
          </div>   
          <div class="col-md-3">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="text-center">
                        <h3 style="color:white;padding-bottom: 8px">AQUARIUS </h3>    
                        </div>
                        <img src="aquarius.png" style="width:100%;" />
                        <p class="text-center" style="margin-top: 5px;"><a href="aquarius.php" class="btn btn-default" role="button" style="background: black; color: white;"><i class="fa fa-eye"></i> ONTDEK</a></p>
                       
                    </div>  
                </div>
          </div>   
     </div>
 </section>
 
 
  
<!--
<section id="take-out">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class='thumbnail'>
                    <a href="menu.php">
                        <div style="background: url('mysite/slide-1.jpg'); padding-bottom: 350px;background-size: cover;">
                            
                        </div>
                        
                            <div class="text-center">
                                <h1 class="caption" style="color: white">BESTEL ONLINE</h1>    
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class='thumbnail'>
                    <a href="reserveer.php">
                         <div style="background: url('reserveer.jpg'); padding-bottom: 350px;background-size: cover;">
                            
                        </div>
                        <div class="text-center">
                                <h1 class="caption" style="color: white">RESERVEER</h1>    
                        </div>
                        
                    </a>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <h2>Wij leveren gratis aan huis of kantoor vanaf 50 euro</h2>
        </div>    
        <div class="row text-center">
            <p>Heverlee - Herent - Linden</p>
            <p>Holsbeek - Lubeek - Wilsele</p>
        </div>   
        <div class="row text-center">
            <h2>Wij leveren gratis aan huis of kantoor vanaf 30 euro</h2>
            <p>Leuven - Kessel-lo</p>
        </div>   
    </div>
</section>
-->

  <!-- GET IN TOUCH -->
  <section id="contact-section" class="contact-wrapper section-padding">
    <div class="container">
      <div class="row">
        <div class="wow zoomIn col-xs-12 col-sm-6 col-md-6 ">
            <div class="contact-info" style="font-size: 2em;">
                                    <ul class="contact-address">
			                            <!--<li style="color: white;"><a  href="https://goo.gl/maps/aXA8q21FGev"><i  class="fa fa-map-marker fa-lg" style="font-size: 2em;color: white;"></i></a> DIESTSESTEENWEG 87, 3010 Kessel-lo</li>-->
			                            <li style="color: white;"><i   class="fa fa-phone"></i>&nbsp; +32 (0)485 86 59 70 </li>
			                            <li style="color: white;"><i  class="fa fa-envelope"></i> info@webland.be</li>
			                             <li style="color: white;"><i  class="fa fa-clock-o"></i> Elke dag van 17:00 tot 20:00. Op alle feestdagen gesloten.</li>
			                        </ul>
            </div>
        </div>    
        <div class="wow zoomIn col-xs-12 col-sm-6 col-md-6 ">
          <h1 class="text-center" style="color:white;">Stuur ons gerust een bericht.</h1>    
          <form name="contactForm" id='contact_form' method="post" action='php/email.php'>
            <div class="form-inline">
              <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="name" >
              </div>
              <div class="form-group col-sm-6">
                <input type="email" class="form-control" name="email" id="exampleInputEmail" placeholder="email address">
              </div>
              <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="subject" id="exampleInputSubject" placeholder="subject" >
              </div>
              <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="company" id="exampleInputCompany" placeholder="company" >
              </div>
              <div class="form-group col-sm-12">
                <textarea class="form-control" name="message" rows="3" id="exampleInputMessage" placeholder="message" ></textarea>
              </div>
            </div>
            <div class="form-group col-xs-12">
              <div id='mail_success' class='success' style="display:none;">Your message has been sent successfully.
              </div><!-- success message -->
              <div id='mail_fail' class='error' style="display:none;"> Sorry, error occured this time sending your message.
              </div><!-- error message -->
            </div>
             <div class="form-group col-xs-12">
    
	
            <div class="form-group col-sm-12" id='submit'>
              <input type="submit" id='send_message' class="btn  btn-lg costom-btn" value="send" style="background-color: white;color: black; border-color: white;">
            </div>
          </form>
        </div> <!-- /.col-xs-12 .col-sm-offset-2 .col-sm-8 -->
        <div class="col-xs-12">
                
        </div><!-- /.col-xs-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- get in touch -->
  
  
 <section id="hours" style="padding-bottom: 15px;">
         <div class="container">
    <div class="text-center">
        <h1 style="color:black;">Openingshours</h1>
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
                <h2>Ma: <?php echo $hours[0]['waarde']?></h2>
        <h2>Di: <?php echo $hours[1]['waarde']?></h2>
        <h2>Wo: <?php echo $hours[2]['waarde']?></h2>
        <h2>Do: <?php echo $hours[3]['waarde']?></h2>
            </div>
            <div class="col-md-6">
                        <h2>Vr: <?php echo $hours[4]['waarde']?></h2>
        <h2>Za: <?php echo $hours[5]['waarde']?></h2>
        <h2>Zo: <?php echo $hours[6]['waarde']?></h2>
            </div>
        </div>
        

    </div>

</section>
        
	<section style="background: black;border-top:2px solid black; margin-top: 8px;">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10072.82079286013!2d4.694184!3d50.8644008!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x52bed37ce3e8c65d!2sWebland+Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1557409760050!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>   
</section>

<?php print_chat(); ?>
<?php print_basket(); ?>
  <!-- footer -->
  <footer >
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12">
            <p>© 2019 Comet Web OS - Virgo edition All rights reserved by <a href="http://webland.be">webland</a></p>
            <div class="backtop  pull-right">
              <i class="fa fa-angle-up back-to-top"></i>
            </div><!-- /.backtop -->
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.creditwrapper -->
  </footer><!-- /Footer -->


<!-- MMENU --> 
<nav id="menu">
  <ul>
    <li ><a class="page-scroll" href="#home">Home</a></li>
    <li> <a class="page-scroll" href="/tegels">Admin</a></li>
    <li><a class="page-scroll" href="#contact">Contact</a></li>
  </ul>
</nav><!-- /#menu -->

</div><!-- /.main -->

<!-- jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Modernizr JS --> 
<script src="js/modernizr-2.6.2.min.js"></script>

<!--Bootatrap JS-->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- REVOLUTION Slider  -->
<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.revolution.js"></script>

<!-- Shuffle JS -->
<script src="js/jquery.shuffle.min.js"></script>

<!-- mmenu -->
<script type="text/javascript" src="vendor/mmenu/js/jquery.mmenu.min.js"></script>

<!-- Owl Carosel -->
<script src="vendor/owl/js/owl.carousel.min.js"></script>
<script src="js/wow.min.js"></script>

<!-- waypoints JS-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<!-- Counterup JS -->
<script src="js/jquery.counterup.min.js"></script>

<!-- Easing JS -->
<script src="js/jquery.easing.min.js"></script>

<!-- Smooth Scroll JS -->
<script src="js/scrolling-nav.js"></script>
<script src="js/smoothscroll.min.js"></script>

<!-- Custom Script JS -->
<script src="js/script.js"></script>

<!-- Email JS -->
<script src="js/email.js"></script>
<script src="release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    var showNav=true;
    function toggleClick()
    {
        if(showNav)
        {
            showNav=false;
            $("#bs-example-navbar-collapse-1").show();
        }
        else
        {
             $("#bs-example-navbar-collapse-1").hide();
             showNav=true;
        }
       
    }
</script>
<script>
    if (location.protocol != 'https:')
{
 location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}
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
