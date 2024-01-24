<?php session_start();
 
if(!isset($_SESSION['temp']))
{
    $_SESSION['temp']=0;
}

if($_POST['next'])
{
    $_SESSION['temp']=$_SESSION['temp']+1;
}
if($_POST['prev'])
{
    if($_SESSION['temp']>0)
    {
        $_SESSION['temp']=$_SESSION['temp']-1;
    }
    
}

switch ($_SESSION['temp']) {
    case 0:
       $url="http://webland.be/templates/2am-coming-free-html-bootstrap-template/aam-coming-soon/";
        break;
    case 1:
       $url="http://webland.be/templates/acme-free-responsive-corporate-template/acme-free/index.html";
        break;
    case 2:
        $url="http://webland.be/templates/acme-free-responsive-corporate-template/acme-free/index1.html";
        break;
    case 3:
        $url="http://webland.be/templates/acme-free-responsive-corporate-template/acme-free/index2.html";
        break; 
    case 4:
        $url="http://webland.be/templates/afterwork-responsive-coming-soon-template/afterwork/center/index.html";
        break;     
    case 5:
        $url="http://webland.be/templates/afterwork-responsive-coming-soon-template/afterwork/parallax/index.html ";
        break;    
    case 6:
        $url="http://webland.be/templates/app-plus-app-landing-page/App-Plus-Onepage-HTML5-App-landing-page-Template-master/index.html";
        break;    
    case 7:
        $url="http://webland.be/templates/appponsive-portfolio-landing-page/AppPonsive/index.html";
        break;
    case 8:
        $url="http://webland.be/templates/arcadia-portfolio-template/tf-free-no.2/index.html";
        break;
    case 9:
        $url="http://webland.be/templates/backyard-high-converting-landing-page-template/backyardLanding/backyard/index.html";
        break;
    case 10:
        $url="http://webland.be/templates/blue-app-free-one-page-responsive-html5-parallax-business-app-landing-page/blue-app/index.html#";
        break;
    case 11:
        $url="http://goudleuven.be";
        break;
    case 12:
        $url="http://webland.be/templates/brandy-free-portfolio-template/brandy/index.html";
        break;
    case 13:
        $url="http://webland.be/templates/cluster-free-creative-portfolio-bootstrap-template/cluster/index.html";
        break;
    case 14:
        $url="http://webland.be/templates/comingwa-free-responsive-coming-soon-page/Comingwa-template/Comingwa-background-image/index.html";
        break;
    case 15:
        $url="http://webland.be/templates/corlate-free-responsive-business-html-template/";
        break;
    case 16:
        $url="http://webland.be/templates/cyrus-studio-free-bootstrap-portfolio-theme/thebootstrapthemes-portfolio/index.html";
        break;
    case 17:
        $url="http://webland.be/templates/doctor-responsive-html-template/doctor/index.html";
        break;
    case 18:
        $url="http://webland.be/templates/drifolio-free-responsive-dribbble-portfolio-template/evenfly-drifolio-free-bootstrap-html-template-1.0.2/index.html";
        break;
    case 19:
        $url="http://webland.be/templates/eelectronics-ecommerce-html-template/eElectronics%20-%20Ecommerce%20HTML%20Template/index.html";
        break; 
    case 20:
        $url="http://webland.be/templates/egret-html5-landing-page/Egret-HTML5%20landing%20page/index.html";
        break;
    case 21:
        $url="http://webland.be/templates/elegance-responsive-one-page-html-template/elegance/index.html";
        break;    
    case 22:
        $url="http://webland.be/templates/ethanol-free-portfolio-template/ethanol/html/index.html";
        break;        
    case 23:
        $url="http://webland.be/templates/fimply-free-one-page-html-website-template/FIMPLY%20one%20page%20html%20responsive%20temp/index.html";
        break;  
    case 24:
        $url="http://webland.be/templates/flat-asphalt-one-pager-prallax-html-5-template/falt-asphalt/index.html";
        break;     
    case 25:
        $url="http://webland.be/templates/geek-free-onepage-personal-portfolio-template/index.html";
        break;
    case 26:
        $url="http://webland.be/templates/himu-free-responsive-bootstrap-template/himu/index.html";
        break;    
    case 27:
        $url="http://webland.be/templates/grape-responsive-app-landing-page-template/GRAPE_ShapeBootstrap_Bundle_v1.0/GRAPE%20Main%20Template/index-transparent.html";
        break; 
    case 28:
        $url="http://webland.be/templates/heera-responsive-html5-multipurpose-template/heera/index.html";
        break;  
    case 29:
        $url="http://webland.be/templates/ino-soon-responsive-coming-soon-template/Ino%20Soon/image/index.html";
        break;
    case 30:
        $url="http://webland.be/templates/jonaki-job-board-template/index.html";
        break; 
    case 31:
        $url="http://webland.be/templates/kite-free-responsive-coming-soon-html5-template/kite/parallax/";
        break; 
    case 32:
        $url="http://webland.be/templates/krefolio-startup-agency-landing-page-template/krefolio/index.html";
        break; 
    case 33:
        $url="http://webland.be/templates/latrant/index.html";
        break; 
    case 34:
        $url="http://webland.be/templates/leroy-restaurant-catering-html-template/HTML-Leroy1.0/index.html";
        break;  
    case 35:
        $url="http://webland.be/templates/launchz-one-page-coming-soon-multi-purpose-html-theme/index.html";
        break;  
    case 36:
        $url="http://webland.be/templates/level-up-responsive-coming-soon-template/level-up/parallax/index.html";
        break; 
    case 37:
        $url="http://webland.be/templates/lifetrackr-app-landing-page/lifetrackr-html5-app-landing-template-master/index.html";
        break;
    case 38:
        $url="http://webland.be/templates/Loris/index.php";
        break; 
    case 39:
        $url="http://webland.be/templates/lucid-html5-and-bootstrap-responsive-app-landing-page/lucid/index.html";
        break; 
    case 40:
        $url="http://webland.be/templates/maxima-free-bootstrap-business-html-template/Maxima%20-%20Free%20Bootstrap%20Business%20HTML%20Template/index.html";
        break; 
    case 41:
        $url="http://webland.be/templates/multi-free-responsive-onepage-html-template/index.html";
        break;  
    case 42:
        $url="http://webland.be/templates/myfolio-responsive-html5-personal-portfolio-template/portfolio/index.html#";
        break;
    case 43:
        $url="http://webland.be/templates/nebula-creative-html-template/nebula/index.html#";
        break;
        case 42:
        $url="http://webland.be/templates/new-year-responsive-melody-html-template/new_year/index.html";
        break;
        case 43:
        $url="http://webland.be/templates/oxygen-free-bootstrap-one-page-theme/template/index.html";
        break;
        case 44:
        $url="http://webland.be/templates/perfect-design-onepage-portfolio-html-template/Perfect%20Design%20-%20One%20Page%20Portfolio%20HTML%20Template/index.html";
        break;
        case 45:
        $url="http://webland.be/templates/santago-free-christmas-sales-amp-affiliate-landing-page-template/evenfly-santago-free-christmas-sales-affiliate%20-landing-page-template/index.html";
        break;
        case 46:
        $url="http://webland.be/templates/sept-free-bootstrap-3-theme/index.html#";
        break;
        case 47:
        $url="http://webland.be/templates/singlepro-bootstrap-onepage-business-portfolio-template/SinglePro/index.html";
        break;
        case 48:
        $url="http://webland.be/templates/small-app-responsive-bootstrap-3-app-landing-page/Small-apps-onepage-html5-app-landing-page-master/index.html";
        break;
        case 49:
        $url="http://webland.be/templates/spirit8-free-bootstrap-html-template/tf-free-no.3/index.html";
        break;
        case 50:
        $url="http://webland.be/templates/sunrise-responsive-html5-coming-soon-template/Sunrise_ShapeBootstrap_bundle_v1.1/Sunrise/index.html";
        break;
        case 51:
        $url="http://webland.be/templates/techgut-responsive-corporate-one-page-theme/techgut_theme_preview/index.html";
        break;
        case 52:
        $url="http://webland.be/templates/timer-multipage-agency-template/timer/index.html";
        break;
        case 53:
        $url="http://webland.be/templates/triangle-free-responsive-multipurpose-template/template/multicolor/index.html";
        break;
        case 54:
        $url="http://webland.be/templates/unika-responsive-one-page-html5-template/unika-html/unika-html/index.html";
        break;
        case 55:
        $url="http://webland.be/templates/vigor/index.php";
        break;
          case 56:
        $url="http://webland.be/templates/walam-multi-purpose-coming-soon-free-html-template/walam-html/index.html";
        break;
        case 57:
        $url="http://webland.be/templates/walam-multi-purpose-coming-soon-free-html-template/walam-html/index.html";
        break;
        
       ///
    default:
       $url="http://webland.be/templates/acme-free-responsive-corporate-template/acme-free/index2.html";
}


?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>WEBLAND - uw website oline in 7 dagen.</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Webland is een Leuvense web ontwikkelaar.">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Bootstrap Css -->
    <link href="/bootstrap-assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/plugins/Lightbox/dist/css/lightbox.css" rel="stylesheet">
    <link href="/plugins/Icons/et-line-font/style.css" rel="stylesheet">
    <link href="/plugins/animate.css/animate.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div style="background-color:rgba(0,0,0,0.4);position:fixed; top:0px; left:0px; right:0px; width:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:10; ">
        <h1 style="    font-size: 35px;margin-left:8px;">Kies dit Webland thema. N° <?php echo $_SESSION['temp'];?> <a class="btn btn-success" href="builder4.php">Bestel</a><form method="POST"><input type="hidden" name="next" value="next"/><button class="btn btn-success"  style="float:right;"><i class="fa fa-arrow-right"></i></button></form><form method="POST"><input type="hidden" name="prev" value="prev"/><button class="btn btn-success" style="float:right;"><i class="fa fa-arrow-left"></i></button></form></h1>
    </div>
    <iframe  style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:9;" src="<?php echo $url;?>"></iframe>
 
    <!-- Footer
	============================================= -->
    <footer>
        <div class="container">
            <h1>Webland</h1>
            <div class="social">
            </div>
            <h6>&copy; 2017 Webland all rights reserved.</h6>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <script src="/js/custom.js"></script>
    <!-- JS PLUGINS -->
    <script src="/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="/js/jquery.easing.min.js"></script>
    <script src="/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="/plugins/countTo/jquery.countTo.js"></script>
    <script src="/plugins/inview/jquery.inview.min.js"></script>
    <script src="/plugins/Lightbox/dist/js/lightbox.min.js"></script>
    <script src="/plugins/WOW/dist/wow.min.js"></script>
    <!-- GOOGLE MAP -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
</body>

</html>