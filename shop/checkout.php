<?php 
session_start();

$path = getcwd();
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 


$ctrl=new IndexController();
function getProds()
{
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$_GET['id'];
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}

function getItem($id)
{
     $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$id;
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}
function getPic($id){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `product_afbeelding` where item=".$id." ORDER BY created DESC";
    $picture=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($picture,$row['foto']);
        }
    }
    $conn->close();

    return $picture;
}
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>WEBSHOP </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image"              content="/logo.jog" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>

  <!-- Revolution css -->
  <link rel="stylesheet" type="text/css" href="/vendor/rs-plugin/css/settings.css" media="screen"/>
  <link rel="stylesheet" href="/vendor/rs-plugin/css/extralayer.css">
  
  <!-- Flat icon css -->
  <link rel="stylesheet" href="/vendor/flat-icon/flaticon.css">
  
  <!-- Font awesome -->
  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
  
  <!-- Owl Carosel css -->
  <link rel="stylesheet" href="/vendor/owl/css/owl.carousel.css">
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
  <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->


<style>
     .custom-button {
    padding: 8px 20px;
    border-color: #d7d7d7;
    border-style: solid;
    border-width: 1px;
    color: #929292;
    font-size: 14px;
    font-family: 'Roboto Condensed', sans-serif;
    font-style: italic;
    text-transform: uppercase;
    font-weight: 300;
    letter-spacing: 1.3px;
}

.blog-wrapper .blog-container, .blog-wrapper .blog-date-wrapper {
    padding: 15px;
    border-color: #d7d7d7;
    border-style: solid;
    border-width: 0px 1px 1px 1px;
    padding-bottom: 21px;
}

.frame img {
  border:solid 2px;
  border-bottom-color:#ffe;
  border-left-color:#eed;
  border-right-color:#eed;
  border-top-color:#ccb;
  max-height:100%;
  max-width:100%;
}

.frame {
  background-color:#ddc;
  border:solid 5vmin #eee;
  border-bottom-color:#fff;
  border-left-color:#eee;
  border-radius:2px;
  border-right-color:#eee;
  border-top-color:#ddd;
  box-shadow:0 0 5px 0 rgba(0,0,0,.25) inset, 0 5px 10px 5px rgba(0,0,0,.25);
  box-sizing:border-box;
  display:inline-block;
  margin:10vh 10vw;
  height:80vh;
  padding:8vmin;
  position:relative;
  text-align:center;
  &:before {
    border-radius:2px;
    bottom:-2vmin;
    box-shadow:0 2px 5px 0 rgba(0,0,0,.25) inset;
    content:"";
    left:-2vmin;
    position:absolute;
    right:-2vmin;
    top:-2vmin;
  }
  &:after {
    border-radius:2px;
    bottom:-2.5vmin;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.25);
    content:"";
    left:-2.5vmin;
    position:absolute;
    right:-2.5vmin;
    top:-2.5vmin;
  }
}

.module {
  background: #f06d06;
  position: relative;
  border: 5px solid black;  
  margin: 20px;
}
.module:after {
  content: '';
  position: absolute;
  top: -15px;
  left: -15px;
  right: -15px;
  bottom: -15px;
  background: white;
  z-index: -1;
}
#el-zwaan
{
    font-family: 'Roboto Slab', serif;
    color: #117CCA;
}
.shop-item-pic{
    width:125px;
    padding-bottom:125px;
}
</style>
</head>
<body>
  <div class="main" id="home">
<header  class="header-part">
  <div id="home" class="wrapper">
    <?php $ctrl->print_nav();?>
</div>
</header>

    <div class="container-fluid" style="min-height: 90vh;margin-top:100px;">
         <div class="more-area" style="background: #1C79BE;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
           <h1 style="color:white;">Winkelwagentje</h1> 
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
        
        <div class="row" style="margin-top:2%;">
            <div class="col-md-12">
              <?php
                    $tot=0;
                    $teller= $_SESSION['basket']['teller'];
                    $totBTW=0;
                    for ($i = 1; $i <= $teller; $i++) {
                        $order= array();
                        $order =getItem($_SESSION['basket'][$i]['id']);
                        $btw=($order['prijs']*$_SESSION['basket'][$i]['amount'])*0.21;
                        $btw=round($btw,2);
                        $totaal= ($order['prijs']*$_SESSION['basket'][$i]['amount']);
                        
                        $pics=getPic($order['id']);
                        echo '<div class="col-md-12">';
                        echo '<div class="" style="margin: 5px;border-bottom: 1px solid black;padding-bottom:75px;">';
                        echo '        
                     <div class="shop-item-pic" style="background:url(\'/producten/uploads/'.$pics[0].'\');float:left;margin-right: 50px;    background-size: cover;margin-left:8px;"></div>';
                        echo "<h2 style='font-weight: 800;'>".$order['naam']."</h2>";
                        echo "<hr />";
                        echo "<h3 style='color:black;'><b style='font-weight: bolder;'> Aantal: ".$_SESSION['basket'][$i]['amount']."</b></h3>";
                         echo "<h3 style='color:black;'><b style='font-weight: bolder;'> Bedrag: ".$order['prijs']*$_SESSION['basket'][$i]['amount']." EURO</b></h3>";
                        $tot=$tot+$totaal;
                        echo "<a class='btn btn-default' href='remove-item.php?item=".$order['id']."' style='margin-top:8px;'>VERWIJDER</a>";
                        echo '</div></div>';
                    }
                    echo "<div style='margin-top: 15px;'></div>";
                     echo '<div class="col-md-12">';
                    echo "<h1 style='margin-top: 15px;color:black;'>Totaal ".$tot." EURO</h1>";
                    echo "</div>";
                    echo "<div style='margin-top: 15px;'></div>";
                ?>    
            </div>
        </div>
        <div classs="row" style="margin-top:15px;">
            <div style="margin-left: 15%; margin-right: 15%;margin-bottom: 2%">
                <?php if($tot>0){?>
                <a href="keuze.php" class="btn btn-block btn-warning" style="background: #1C79BE;">VOLGENDE</a>
                <?php }?>
                <a href="index.php" class="btn btn-block btn-warning" style="background: #1C79BE;">IETS VERGETEN?</a>
            </div>
        </div>
    </div>




  <!-- footer -->
  <footer >
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12">
            <p>© 2019 All rights reserved. <span>Webland</span> by <a href="http://webland.be">webland</a> | <a href="http://cogitatio.be/"> Met de steun van Cogitatio</a></p>
            <div class="backtop  pull-right">
              <i class="fa fa-angle-up back-to-top"></i>
            </div><!-- /.backtop -->
          </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.creditwrapper -->
  </footer><!-- /Footer -->
</div><!-- /.main -->



<!-- jQuery JS -->
<script src="/js/jquery-1.11.1.js"></script>

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
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

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

<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
