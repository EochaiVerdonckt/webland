<?php session_start();
$path = getcwd();
$path = str_replace("slides", "", $path);

define ("FSPATH",$path);
require (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 

$ctrl=new SlidesController();
$slide1=$ctrl->getSlide(1);
$slide2=$ctrl->getSlide(2);
$slide3=$ctrl->getSlide(3);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Webland uw bedrijfspresentatie</title>
  <meta property="og:description" 
  content="Webland uw bedrijfspresentatie" />
  <meta name="description" content="Webland uw bedrijfspresentatie">
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
  
<style>
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

#box2{
    
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
      <div class="tp-banner-container" id="slides-box" style="height:100vh;">
      <div class="tp-banner" style="height:100vh;" id="box2">
        <ul>  <!-- SLIDE  -->
          <li data-transition="fade" data-slotamount="25" data-masterspeed="2500"  data-thumb="<?php echo $slide1['foto'] ?>"  data-saveperformance="off">
            <!-- MAIN IMAGE -->
            <img src=" <?php echo $slide1['foto'] ?>"  alt="fullslide2" data-bgposition="center center" data-kenburns="on" data-duration="12000" data-ease="Power0.easeInOut" data-bgfit="115" data-bgfitend="100" data-bgpositionend="center center">
        
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
  <img src="<?php echo $slide2['foto'] ?>"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
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
  <img src="<?php echo $slide3['foto'] ?>"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
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
  
</div><!-- /.main -->

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
<script>
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
