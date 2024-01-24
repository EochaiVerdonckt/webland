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
   <div style="margin-top:120px;">
       
   </div>    
   <a href="https://partner.bol.com/click/click?p=2&t=url&s=1140076&f=TXL&url=https%3A%2F%2Fwww.bol.com%2Fbe%2Fp%2Fphilips-grind-brew-hd7768-80-koffiezetapparaat-zwart-grijs%2F9200000105388764%2F&name=Philips%20Grind%20%26%20Brew%20HD7768%2F80%20-%20Koffiezetappa...">koffiemachine</a>
        

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
