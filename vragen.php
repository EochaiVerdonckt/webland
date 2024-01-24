<?php session_start();
$path = getcwd();
$path = $path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();
$services=$ctrl->getServicesPublished();
$seo=$ctrl->getSeo();

function print_vragen(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
     $sql = "SELECT * FROM vragen";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
       
            $id= trim($row['id']);
            echo '<div class="col-lg-12">';
                    echo '<div class="votes-box" style="float:left;">';     
            echo '<a class="btn btn-success" href="upQ.php?id='.$row['id'].'" style="background: transparent;border:0;"><i style="color:#5cb85c;" class="fa fa-arrow-up"></i></a>';
            echo '<div>';
            echo '<a class="btn btn-danger" href="downQ.php?id='.$row['id'].'" style="background: transparent;border:0;"><i style="color: #d9534f;" class="fa fa-arrow-down"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '<div class="thumbnail" style="margin-left: 60px;">';
            
            
            if(isset($_SESSION['user'])){
                echo '<a href="editAnswer.php?id='.$row['id'].'" style="float:right;"><i class="far fa-edit" style="color: black;"></i></a>';
            }
            else{
                echo "";
            }
            
            echo '        <div class="caption">  ';
            echo '<span class="badge badge-success" style="margin: 5px;background: green;">'.$row['posi'].'</span>';
            echo '<span class="badge badge-danger" style="margin: 5px;background: red;">'.$row['nega'].'</span>';
            echo '        
                       <h2>'.$row['vraag'].'
                      </h2>';
                      echo '<h2 style="padding-left:8px; margin-top:10px;">A: '.$row['antw'].'</h2>';
            echo '
                    </div>
                 </div>';
                 
            
            echo '</div>';
        }
    }
    mysqli_close($conn);
}

?>


    <!-- Footer -->
  

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Webland | Uw bedrijf online in 7 dagen</title>
  <meta property="og:description" 
  content="Webland ondersteunt u, in uw online projecten en bouwt aan zeer aantrekkelijke prijzen waar u zelf alles kan aanpaassen. Wij leveren onze producten af volgens het slot op de deur principe." />
  <meta name="description" content="Webland ondersteunt u, in uw online projecten en bouwt aan zeer aantrekkelijke prijzen waar u zelf alles kan aanpaassen. Wij leveren onze producten af volgens het slot op de deur principe.">
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
.thumbnail {
    background: rgba(0,0,0,0.2);
    border: 0;
}
</style>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->
</head>
<body data-spy="scroll" data-target="#main-navbar">
  <div class="main" id="home">
    <!-- slider -->
    <?php $ctrl->print_nav(); ?>
 

  <div class="row" style="background:url('support.jpg'); background-size: cover;padding-bottom:250px;">
       <h1 style="font-size: 5em;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;color: white;padding-top:200px;width:100%; text-align:center;">Technical support Database.</h1>
   </div>
 
	    <div class="more-area">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="pull-left" style="background: rgba(0,0,0,0.6);padding: 12px;">Heeft u een vraag?</h2>
        <a href="ruben.php" id="load" class="btn btn-success pull-right" style="background: rgba(0,0,0,0.6);color: white;">Shoot</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
<section>
    <div class="container" style="margin-top: 25px;">
        <div class="row">
	        <?php
	        if(isset($_SESSION['input']))
	        {
	            echo '<div style="padding: margin-bottom: 15px; text-align: center; 25px; border: 1px solid black"><h1>'.$_SESSION['input'].'</h1></div>';
	            $_SESSION['input']=null;
	        }
	        
	        ?>
	    </div>

	    <div class="row" style="padding: 60px;">
	     
	        
	    </div>
        <div class="row">
			    <?php 
			        print_vragen();
			    ?>
	    </div>
	    
    </div>
</section>
    <?php   $ctrl->print_chat(); ?>
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



