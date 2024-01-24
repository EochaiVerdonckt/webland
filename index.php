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
$ctrl=new IndexController();
$seo=$ctrl->getSeo();

switch (getTemplate()) {
    case 2:
        header("Location: scorpio.php");
        die();
        break;
    case 3:
        header("Location: sagittarius.php");
        die();
        break;
    case 4:
        header("Location: aquarius.php");
        die();
        break;
    case 5:
        header("Location: pieces.php");
        die();
        break;
    case 6:
        header("Location: libra.php");
        die();
        break;
    case 7:
        header("Location: capricorn.php");
        die();
        break;
    case 8:
        header("Location: cancer.php");
        die();
        break;
    case 9:
        header("Location: ariers.php");
        die();
        break;
    case 10:
        header("Location: taurus.php");
        die();
        
        break;
    case 11:
        header("Location: leo.php");
        die();
        break;
    case 12:
        header("Location: gemini.php");
        die();
    case 13:
        header("Location: ophiuchus.php");
        die(); 
    case 14:
        header("Location: rabbit.php");
        die(); 
     case 15:
        header("Location: rooster.php");
        die();     
        break;  
    case 16:
        header("Location: oxx.php");
        die();     
        break;      
    case 17:
        header("Location: rat.php");
        die();     
        break;  
    case 18:
        header("Location: panda.php");
        die();     
        break;      
}

function getTemplate(){
      $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM `promo_balance` where id=8";
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
    return $item['promo'];
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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
	  <title><?php echo $seo['0']['waarde']?></title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image"              content="logo.png" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>
  <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.css" type="text/css" rel="stylesheet" />
  <!-- Revolution css -->
  <link rel="stylesheet" type="text/css" href="/vendor/rs-plugin/css/settings.css" media="screen"/>
  <link rel="stylesheet" href="/vendor/rs-plugin/css/extralayer.css">
  
  <!-- Flat icon css -->
  <link rel="stylesheet" href="/vendor/flat-icon/flaticon.css">
  
  <!-- Font awesome -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/font5/css/fontawesome.min.css">
  <!-- Owl Carosel css -->
  <link rel="stylesheet" href="/vendor/owl/css/owl.carousel.min.css">
  <link rel="stylesheet" href="/vendor/owl/css/owl.theme.default.css">
  <link rel="stylesheet" href="/vendor/owl/css/owl.theme.css">
  
  <!-- mmenu -->
  <link type="text/css" rel="stylesheet" href="/vendor/mmenu/css/jquery.mmenu.css" />
  
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">

  <!-- Animate css -->
  <link rel="stylesheet" href="/css/animate.css">

  <!-- Custom Style css -->
  <link rel="stylesheet" href="/css/hover.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
  
<style>
.snow-flake {
    width: 100%;
    padding-bottom: 60%;
}
.small-title {
    background: <?php echo $ctrl->getWpBg() ?>;
    color: <?php echo $ctrl->getWpColor() ?>;
}
.small-title:after {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    width               : 30px;
    height              : 38px;
    margin-right        : -20px;
    border-left         : 20px solid transparent;
    border-right        : 20px solid transparent;
    border-bottom       : 40px solid <?php echo $ctrl->getWpBg() ?>;
}
.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -28px;
    width               : 10px;
    height              : 39px;
     background         :<?php echo $ctrl->getWpBorder()?> !important;
    -webkit-transform   : skew(27deg);
    -moz-transform      : skew(27deg);
    -o-transform        : skew(27deg);   
    -ms-transform       : skew(27deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}
@media (min-width : 768px) and (max-width : 991px) {
    
/*RS-SLIDER*/
.small-title{
	height     : 28px;
	font-size  : 12px !important;
	padding    : 10px 50px 10px 150px !important;
}
.small-title:after {
    position        : absolute;
    content         : " ";
    top             : 0;
    right           : 0;
    width           : 30px;
	height          : 28px;
	margin-right    : -20px;
	border-left     : 0px solid transparent;
	border-right    : 15px solid transparent;
	border-bottom   : 28px solid #000000;
}

.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -25px;
    width               : 7px;
    height              : 28px;
     background         : <?php echo $ctrl->getWpBorder()?> !important;
    -webkit-transform   : skew(27deg);
    -moz-transform      : skew(27deg);
    -o-transform        : skew(27deg);   
    -ms-transform       : skew(27deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}

}
@media only screen and (min-width : 480px) and (max-width : 767px) {

    .small-title:after {
    position     : absolute;
    content      : " ";
    top          : 0;
    right        : 0;
    width        : 30px;
	height       : 18px;
	margin-right : -20px;
	border-left  : 0px solid transparent;
	border-right : 15px solid transparent;
	border-bottom: 18px solid #000000;;
}

.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -25px;
    width               : 7px;
    height              : 18px;
     background         : <?php echo $ctrl->getWpBorder()?> !important;
    -webkit-transform   : skew(40deg);
    -moz-transform      : skew(40deg);
    -o-transform        : skew(40deg);   
    -ms-transform       : skew(40deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}


}
@media only screen and (min-width : 320px) and (max-width : 479px) {
    .small-title{
	height     : 13px;
	font-size  : 10px !important;
	padding    : 5px 20px 3px 40px !important; 
}


     
.small-title:after {
    position        : absolute;
    content         : " ";
    top             : 0;
    right           : 0;
    width           : 20px;
	height          : 13px;
	margin-right    :  -20px;
	border-left     : 0px solid transparent;
	border-right    : 11px solid transparent;
	border-bottom   : 13px solid #000000;
}

.small-title:before {
    position            : absolute;
    content             : " ";
    top                 : 0;
    right               : 0;
    margin-right        : -25px;
    width               : 7px;
    height              : 13px;
     background         : <?php echo $ctrl->getWpBorder()?> !important;
    -webkit-transform   : skew(40deg);
    -moz-transform      : skew(40deg);
    -o-transform        : skew(40deg);   
    -ms-transform       : skew(40deg);   
    -ms-filter          : "progid:DXImageTransform.Microsoft.Matrix(M11=0.7071067811865483, M12=0, M21=-0.7071067811865467, M22=1.4142135623730934, SizingMethod='auto expand')";
}

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
#spaceNeed{
    
}
@media only screen and (max-width : 1000px){
    #spaceNeed{
        margin-top:-475px;
        visibility:hidden;
    }
}

@media only screen and (min-width : 1425px){
    #spaceNeed{
        margin-top:-75px;
    }
}

ul.nav.navbar-nav li a:hover, ul.nav.navbar-nav li a:focus {
    color: black;
    background: transparent;
    border: 1px solid white;
}

.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li.active > a, .navbar-default .navbar-nav>.active>a {
	color: black !important;
}
.fa-star{
      text-shadow:
   -1px -1px 0 #000,  
    1px -1px 0 #000,
    -1px 1px 0 #000,
     1px 1px 0 #000;
     margin:2px;
}
.item{
    background: rgba(0,0,0,0.5);
    padding:25px;
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
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->
</head>
<body data-spy="scroll" data-target="#main-navbar">
   
  <div class="loader"></div>
  <div class="main" id="home">
    <!-- slider -->
    <?php
        $ctrl->print_nav();
    ?>
      <div class="tp-banner-container" id="slides-box" style="height:100vh;">
      <div class="tp-banner" style="height:100vh;" id="box2">
        <ul>  <!-- SLIDE  -->
          <li data-transition="fade" data-slotamount="25" data-masterspeed="2500"  data-thumb="<?php echo $slide1['foto'] ?>"  data-saveperformance="off">
            <!-- MAIN IMAGE -->
            <img src="/slides/<?php echo $slide1['foto'] ?>"  alt="fullslide2" data-bgposition="center center" data-kenburns="on" data-duration="12000" data-ease="Power0.easeInOut" data-bgfit="115" data-bgfitend="100" data-bgpositionend="center center">
        
 <?php if($slide1['TitelVlag']){ ?>
 
  <!-- LAYER NR. 1 -->
  <div class="tp-caption very_large_text lfb ltt tp-resizeme head-tag"
  data-x="center" data-hoffset="20"
  data-y="center" data-voffset="-290" 
  data-speed="600"
  data-start="2000"
  data-easing="Power3.easeInOut"
  data-splitin="chars"
  data-splitout="chars"
  data-elementdelay="0.08"
  style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
  <h1><?php echo  $slide1['titel']; ?></h1>
</div>

 <?php } ?>
 
 
<?php  if($slide1['wp-1-flag']){
?>
<!-- LAYER NR. 2 -->
<div class=" tp-caption  lfl tp-resizeme"
data-x="0"
data-y="220"
data-speed="500"
data-start="1500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title"><?php echo $slide1['wp-1'] ?></h2>
</div>

<?php } ?>

<?php  if($slide1['wp-2-flag']){
?>

<!-- LAYER NR. 3 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="220"
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
<h2  class="small-title"><?php echo $slide1['wp-2']; ?></h2>
</div>

<?php } ?>

<?php  if($slide1['wp-3-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="220"
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
<h2 class="small-title" ><?php echo $slide1['wp-3']; ?></h2>
</div>

<?php } ?>

<?php  if($slide1['wp-4-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="0"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide1['wp-4']; ?></h2>
</div>

<?php } ?>

<?php  if($slide1['wp-5-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide1['wp-5']; ?></h2>
</div>

<?php }?>

<?php  if($slide1['wp-6-flag']){
?>


<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide1['wp-6']; ?></h2>
</div>

<?php }?>

<?php  if($slide1['wp-7-flag']){
?>



<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="0"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide1['wp-7']; ?></h2>
</div>

<?php } ?>

<?php  if($slide1['wp-8-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide1['wp-8']; ?></h2>
</div>

<?php } ?>

<?php  if($slide1['wp-9-flag']){
?>
<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide1['wp-9']; ?></h2>
</div>

<?php } ?>

<?php  if($slide1['conclusieVlag']){ ?>
<!-- LAYER NR. 5 -->
<div class="tp-caption lfr tp-resizeme"
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
<button type="button" class="btn btn-default buy-btn"><?php echo $slide1['Conclusie']; ?></button>
<?php } ?>

<li class="items" data-transition="slideleft" data-slotamount="1" data-masterspeed="1500" data-thumb="<?php echo $slide2['foto'] ?>" data-delay="13000"  data-saveperformance="on">
  <!-- MAIN IMAGE -->
  <img src="/slides/<?php echo $slide2['foto'] ?>"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
  <!-- LAYERS -->

 <?php if($slide2['TitelVlag']){ ?>
 
  <!-- LAYER NR. 1 -->
  <div class="tp-caption very_large_text lfb ltt tp-resizeme head-tag"
  data-x="center" data-hoffset="20"
  data-y="center" data-voffset="-290" 
  data-speed="600"
  data-start="2000"
  data-easing="Power3.easeInOut"
  data-splitin="chars"
  data-splitout="chars"
  data-elementdelay="0.08"
  style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
  <h1><?php echo $slide2['titel'];?></h1>
</div>

 <?php } ?>

 
<?php  if($slide2['wp-1-flag']){
?>
<!-- LAYER NR. 2 -->
<div class=" tp-caption  lfl tp-resizeme"
data-x="0"
data-y="220"
data-speed="500"
data-start="1500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title"><?php echo $slide2['wp-1'] ?></h2>
</div>

<?php } ?>

<?php  if($slide2['wp-2-flag']){
?>

<!-- LAYER NR. 3 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="220"
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
<h2  class="small-title"><?php echo $slide2['wp-2']; ?></h2>
</div>

<?php } ?>

<?php  if($slide2['wp-3-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="220"
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
<h2 class="small-title" ><?php echo $slide2['wp-3']; ?></h2>
</div>

<?php } ?>

<?php  if($slide2['wp-4-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="0"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide2['wp-4']; ?></h2>
</div>

<?php } ?>

<?php  if($slide2['wp-5-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide2['wp-5']; ?></h2>
</div>

<?php }?>

<?php  if($slide2['wp-6-flag']){
?>


<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide2['wp-6']; ?></h2>
</div>

<?php }?>

<?php  if($slide2['wp-7-flag']){
?>



<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="0"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide2['wp-7']; ?></h2>
</div>

<?php } ?>

<?php  if($slide2['wp-8-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide2['wp-8']; ?></h2>
</div>

<?php } ?>

<?php  if($slide2['wp-9-flag']){
?>
<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide2['wp-9']; ?></h2>
</div>

<?php } ?>

<?php  if($slide2['conclusieVlag']){ ?>
<!-- LAYER NR. 5 -->
<div class="tp-caption lfr tp-resizeme"
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
<button type="button" class="btn btn-default buy-btn"><?php echo $slide2['Conclusie']; ?></button>
<?php } ?>


</li>
<li class="items" data-transition="slidevertical" data-slotamount="2" data-masterspeed="1500" data-thumb="<?php echo $slide3['foto'] ?>" data-delay="13000"  data-saveperformance="off">
  <!-- MAIN IMAGE -->
  <img src="/slides/<?php echo $slide3['foto'] ?>"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
  <!-- LAYERS -->

 <?php if($slide3['TitelVlag']){ ?>
 
  <!-- LAYER NR. 1 -->
  <div class="tp-caption very_large_text lfb ltt tp-resizeme head-tag"
  data-x="center" data-hoffset="20"
  data-y="center" data-voffset="-290" 
  data-speed="600"
  data-start="2000"
  data-easing="Power3.easeInOut"
  data-splitin="chars"
  data-splitout="chars"
  data-elementdelay="0.08"
  style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
  <h1><?php echo $slide3['titel']; ?></h1>
</div>
 
 <?php } ?>
 
  
<?php  if($slide3['wp-1-flag']){
?>
<!-- LAYER NR. 2 -->
<div class=" tp-caption  lfl tp-resizeme"
data-x="0"
data-y="220"
data-speed="500"
data-start="1500"
data-easing="Power3.easeOut"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.05"
data-endelementdelay="0.1"
data-endspeed="500"
style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">
<h2 class="small-title"><?php echo $slide3['wp-1'] ?></h2>
</div>

<?php } ?>

<?php  if($slide3['wp-2-flag']){
?>

<!-- LAYER NR. 3 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="220"
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
<h2  class="small-title"><?php echo $slide3['wp-2']; ?></h2>
</div>

<?php } ?>

<?php  if($slide3['wp-3-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="220"
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
<h2 class="small-title" ><?php echo $slide3['wp-3']; ?></h2>
</div>

<?php } ?>

<?php  if($slide3['wp-4-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="0"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide3['wp-4']; ?></h2>
</div>

<?php } ?>

<?php  if($slide3['wp-5-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide3['wp-5']; ?></h2>
</div>

<?php }?>

<?php  if($slide3['wp-6-flag']){
?>


<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="350"
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
<h2 class="small-title" ><?php echo $slide3['wp-6']; ?></h2>
</div>

<?php }?>

<?php  if($slide3['wp-7-flag']){
?>



<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="0"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide3['wp-7']; ?></h2>
</div>

<?php } ?>

<?php  if($slide3['wp-8-flag']){
?>

<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="350"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide3['wp-8']; ?></h2>
</div>

<?php } ?>

<?php  if($slide3['wp-9-flag']){
?>
<!-- LAYER NR. 4 -->
<div class="tp-caption  lfl tp-resizeme"
data-x="720"
data-y="500"
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
<h2 class="small-title" ><?php echo $slide3['wp-9']; ?></h2>
</div>

<?php } ?>

<?php  if($slide3['conclusieVlag']){ ?>
<!-- LAYER NR. 5 -->
<div class="tp-caption lfr tp-resizeme"
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
<button type="button" class="btn btn-default buy-btn"><?php echo $slide3['Conclusie']; ?></button>
<?php } ?>
 



</div>


</li>
</ul>
</div>
</div>
    <!-- slider -->
     <div class="more-area" id="spaceNeed" style="    background: url(../img/banner02.jpg) no-repeat center center;
    background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="pull-left" id="gratis">Zeer gebruiksvriendelijke digitale tools.</h2>
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: white; background: transparent;">Ontdek.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
  <div class="container">
      <div class="row" style="" id="">
         
          <div class="text-center">
              <img src="/logo.png" alt="foto van ons logo." style="width:15%;"/>
              <h1 style="color:black;">Welkom</h1>
          </div>
             <div id="krijtbord" style="padding:2%;font-size: 1em;text-align:center;">
                    <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?>     
                 </div>
                
            </div><!-- col-8 -->
   
      
      		  <?php 
            $ctrl=new IndexController();
            $services=$ctrl->getSterk();
         ?>
        <div class="row">
                            <div class="col-md-4 col-sm-6" >
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0" style="visibility: visible; animation-name: zoomIn;">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info" >
                                       
                                        <h2><?php echo $services[0]['naam'] ?></h2>
                                         <hr />
                                        <?php echo $services[0]['omschrijving'] ?>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info" >
                                           
                                        <h2><?php echo $services[1]['naam'] ?></h2>
                                         <hr />
                                       <?php echo $services[1]['omschrijving'] ?>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: zoomIn;">
                                    <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    <div class="rotate-box-info">
                                          
                                       <h2><?php echo $services[2]['naam'] ?></h2>
                                         <hr />
                                       <?php echo $services[2]['omschrijving'] ?>
                                    </div>
                                </a>
                            </div>
                        </div> <!-- /.row -->
      
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
        <?php 
        $ctrl=new IndexController();
        if($ctrl->getKrijtVlag()==1)
        {
        ?>
        
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
		<?php
        }
        $ctrl->print_chat();
		?>
		<div class="row text-center">
		    <a href="tel:0485865970" class="btn btn-default" style="background: white; border:1px solid black;"><i class="fa fa-mobile"></i> 0485/86.59.70</a>
		</div>  
		</div>
		<div class="container">
        </div>
  </div>
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
  
  <section>
    <div class="diagonal-box">
	    <div class="content" style="padding-top:150px !important;padding-bottom:150px !important;">
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
  
  <section  class="text-center" style="margin-top:100px;" >
      <div style="padding-top:100px;padding-left:25px;padding-right:25px;">
           <h1>Online betalingen was nog nooit zo eenvoudig.</h1>
      <p style="color:black;">Bij ontvangst van uw pakket activeren wij een account voor u bij een payment service provider, die de laagste tarieven van de markt hanteert. Uw Klanten kunnen betalen met Paypal, kreditkaart, bankcontact, Ideal, QR-code, Applepay of de app van hun bank.</p>
      </div>
     
      <img src="mollie.png" style="width:100%;" alt="online betalen was nog nooit zo eenvoudig." />
  </section>
   <div class="more-area" id="" style="    background: url(../img/more.png) no-repeat center center;
    background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="pull-left" id="gratis" style="color:white;background: rgba(0,0,0,0.6);padding:5px;">Ontdek hoe wij het verschil kunnen maken.</h2>
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: white; background: transparent;">Bekijk.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
 <!-- GET IN TOUCH -->
  <section id="contact-section-2" class="contact-wrapper section-padding">
    <div class="container">
      <div class="row">
          <div class="text-center">
               <h1 style="color: black;background: rgba(255,255,255,0.5); padding: 2%;"> 
             
                    <?php 
                    $seo=$ctrl->getSeo();
                    echo $seo['3']['waarde'];
                    ?>
           
               
               </h1>
          </div>
          
        <div class="wow zoomIn col-xs-12 col-sm-12 col-md-12">
          <form name="contactForm" id='contact_form' method="post" action='php/email.php'>
            <div class="form-inline">
              <div style="background: rgba(0,0,0,0.8)">
                  <div class="form-group col-sm-12">
                <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="name" style="border:1px solid black;">
              </div>
              <div class="form-group col-sm-12">
                <input type="email" class="form-control" name="email" id="exampleInputEmail" placeholder="email address" style="border:1px solid black;">
              </div>
              <div class="form-group col-sm-6" style="display:none;">
                <input type="text" class="form-control" name="subject"  value="Vraag van contact" id="exampleInputSubject" placeholder="subject" style="border:1px solid black;">
              </div>
              <div class="form-group col-sm-6" style="display:none;">
                <input type="text" class="form-control" name="company" value="webland" id="exampleInputCompany" placeholder="company" style="border:1px solid black;">
              </div>
              <div class="form-group col-sm-12">
                <textarea  style="border:1px solid black;" class="form-control" name="message" rows="3" id="exampleInputMessage" placeholder="message" ></textarea>
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
        
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10003703.93002628!2d-4.89514483266907!3d52.255905864975766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1613b61426d85%3A0x52bed37ce3e8c65d!2sWebland%20Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1604050229893!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

</div><!-- /.main -->
<footer>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12 animated" style="visibility: visible; animation-name: zoomIn;">
            <p>© 2019 Comet Web OS - Virgo edition All rights reserved by <a href="http://webland.be">webland</a> </p>
            <div class="backtop  pull-right">
              <i class="fa fa-angle-up back-to-top"></i>
            </div><!-- /.backtop -->
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.creditwrapper -->
  </footer>

<!-- jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Modernizr JS --> 
<script src="/js/modernizr-2.6.2.min.js"></script>

<!--Bootatrap JS-->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- REVOLUTION Slider  -->
<script type="text/javascript" src="/vendor/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="/vendor/rs-plugin/js/jquery.themepunch.revolution.js"></script>

<!-- Shuffle JS -->
<script src="/js/jquery.shuffle.min.js"></script>

<!-- mmenu -->
<script type="text/javascript" src="/vendor/mmenu/js/jquery.mmenu.min.js"></script>

<!-- Owl Carosel -->
<script src="/vendor/owl/js/owl.carousel.min.js"></script>
<script src="/js/wow.min.js"></script>

<!-- waypoints JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<!-- Counterup JS -->
<script src="/js/jquery.counterup.min.js"></script>

<!-- Easing JS -->
<script src="/js/jquery.easing.min.js"></script>

<!-- Smooth Scroll JS -->
<script src="/js/scrolling-nav.js"></script>
<script src="/js/smoothscroll.min.js"></script>

<!-- Custom Script JS -->
<script src="/js/script.js"></script>

<!-- Email JS -->
<script src="/js/email.js"></script>
<script src="/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>

<script>


var elmnt = document.getElementById("main-navbar");
    var height = elmnt.offsetHeight+"px";
    var box= document.getElementById("slides-box");
    box.style.marginTop = height;
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
    var showNav=true;
     var elmnt = document.getElementById("main-navbar");
    var height = elmnt.offsetHeight+"px";
    var box= document.getElementById("slides-box");
    box.style.marginTop = height;
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
