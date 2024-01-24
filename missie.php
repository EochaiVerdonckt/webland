<?php
$path = getcwd();
$path = $path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/fotoPaginaController.php"); 
$ctrl=new IndexController();
$company_data=$ctrl->getCompanyData();





function getSideButtons()
{
    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $rij = array();

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

function getSeo(){
    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $rij = array();


        $sql = "SELECT * FROM Gegevens";
        $item=array();
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                 array_push($item,$row);
            }

        } 
        $conn->close();
        return $item;
    }

function getMissie(){
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM `missie`";
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
    return $item['waarde'];
}

function getServices()
{
     $ctrl=new IndexController();
    $conn=$ctrl->getConnection();

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

function print_artikels()
{

    $ctrl=new IndexController();
   $conn=$ctrl->getConnection();

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


            echo '
                       
                       </p>
                    </div>
                 </div></div></div>';
        }
    } else {
        
    }
    mysqli_close($conn);
}
function getPromo()
{
    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $rij = array();


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

$slide_buttons=getSideButtons();
$services=getMissie();
$seo=getSeo();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo $seo['0']['waarde']?>  > <?php echo  $services[0]['naam'] ?></title>
  <meta name="description" content="DO-IN YOGA">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>
  <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.12/release/featherlight.min.css" type="text/css" rel="stylesheet" />
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')
</script>
<![endif]-->

<style>

/* ===== Begin roatet boxes ===== */
/* Begin rotate box-1 */
.rotate-box-1, .rotate-box-2 {
	display: inline-block;
	margin: 30px 0;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
}
a.rotate-box-1, a.rotate-box-2 {
	text-decoration: none;
	color: #363940;
}
a.rotate-box-1:hover, a.rotate-box-2:hover {
	color: #676D75;
}
.rotate-box-1 .rotate-box-icon {
	display: inline-block;
	text-align: center;
	margin-bottom: 15px;
	margin-right: 25px;
	margin-top: 10px;
	float:left;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
}
.rotate-box-1.square-icon .rotate-box-icon, .rotate-box-2.square-icon .rotate-box-icon {
	width: 45px;
	height: 45px;
	line-height: 45px;
	color: #FFF !important;
	font-size: 18px;
	-webkit-transform: rotate(45deg);
	-moz-transform: rotate(45deg);
	-o-transform: rotate(45deg);
	transform: rotate(45deg);
}
.rotate-box-1.square-icon .rotate-box-icon:after, .rotate-box-2.square-icon .rotate-box-icon:after {
	content: "";
	position: absolute;
	top: 3px;
	right: 3px;
	bottom: 3px;
	left: 3px;
	border: 2px solid #FFF;
}
.rotate-box-1:hover.square-icon .rotate-box-icon , .rotate-box-2:hover.square-icon .rotate-box-icon{
	-webkit-transform: rotate(0deg);
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	transform: rotate(0deg);
}
.rotate-box-1.square-icon .rotate-box-icon .fa, .rotate-box-2.square-icon .rotate-box-icon .fa{
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
	-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	transform: rotate(-45deg);
}
.rotate-box-1:hover.square-icon .rotate-box-icon .fa, .rotate-box-2:hover.square-icon .rotate-box-icon .fa{
	-webkit-transform: rotate(0deg);
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	transform: rotate(0deg);
}

.rotate-box-1 .rotate-box-info a, .rotate-box-2 .rotate-box-info a {
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
}
.rotate-box-1 h4, .rotate-box-2 h4 {
	font-weight: 400;
}
.rotate-box-1 p {
	padding: 0 10px;
}
.rotate-box-1 .rotate-box-info {
	padding-left: 60px;
}

/* End rotate box-1 */


/* Begin rotate box-2 */
.rotate-box-2 .rotate-box-icon {
	display: inline-block;
	text-align: center;
	margin-bottom: 15px;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
}

.rotate-box-2.square-icon .rotate-box-icon {
	width: 75px;
	height: 75px;
	line-height: 75px;
	font-size: 36px;
}

.rotate-box-2.square-icon .rotate-box-info {
	margin-top: 30px;
}
    .team-item {
        height: 120px;
        vertical-align: baseline;
    }
    .team-item .team-triangle {
    width: 120px;
    height: 120px;
    background: transparent;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    margin: 0 auto;
    position: relative;
    top: 25px;
    box-shadow: 0 0 0 6px #FFFFFF, 0 0 0 7px #dadbdb;
    overflow: hidden;
}
.team-triangle img
{
    width: 100%;
}

#krijtbord p
{
    font-size: 1.2em;
    color: black;
}

.caption p {
    color: white !important;
}

.content
{
    padding: 0 !important;
}

.team-triangle-small
{
    width:80px !important;
    height: 80px !important;
}

.draaibeeld {
    -webkit-animation-name: rotate;
    -webkit-animation-duration: 12s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    width: 20%;
}

/* === Navbar === */
.navbar-default .navbar-brand, .navbar-default .navbar-brand:focus {
	color: #fff;
}
.navbar-default .navbar-brand:hover {
	color: #fff;
}
.navbar-default, .navbar-default.navbar-fixed-top.navbar-shrink {
  background-color: #363940;
}
.navbar-default .navbar-nav > li > a {
	color: #a9a9a9;
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li.active > a, .navbar-default .navbar-nav>.active>a {
	color: #87c13c !important;
}
.navbar-default.navbar-fixed-top.navbar-shrink .navbar-nav > li > a {
	color: #a9a9a9;
}
.navbar-default.navbar-shrink .navbar-nav > li > a:hover, .navbar-default.navbar-shrink .navbar-nav > li > a:focus, .navbar-default.navbar-shrink .navbar-nav > li.active > a {
	color: #fff;
}
.navbar-default.navbar-shrink .navbar-nav > li.active > a {
	-webkit-box-shadow: inset 0 3px #fff !important;
	-moz-box-shadow: inset 0 3px #fff !important;
	box-shadow: inset 0 3px #fff !important;
}
.navbar-default .dropdown-menu {
	border: 1px solid #fff;
	border-top: 2px solid #fff;
	-webkit-box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08);
	box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08);
}
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-menu > li > a.active, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {
	color: #ffff;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
	color: #fff;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
	background-color: transparent;
	
}
.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li.active > a {
	
}

.page-scroll
{
    padding-top: 5px;
    padding-bottom: 5px;
}

.thumbnail
{
    background-color: black;
    border:0;
}
/* === Rotate Box === */
.rotate-box-1.square-icon .rotate-box-icon, .rotate-box-2.square-icon .rotate-box-icon {
	background-color: #363940;
}

p,h3,h4,li
{
    color: black !important;
}

</style>
</head>
<body data-spy="scroll" data-target="#main-navbar">
  <div class="main" id="home">
          <?php $ctrl->print_nav(); ?>
<section id="services-section" class="page" style="background:url('/missie.jpg'); background-size: cover;height:80vh;">
  
     <div class="container">
       
        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0" style="visibility: visible; animation-name: zoomIn;">
                              
                     
                                    </div>
                                </a>
                            </div>
                        </div> <!-- /.row -->
    </div>
</section>    


  <!-- GET IN TOUCH -->
  <section style="padding-bottom:100px;">
        <div class="more-area" style="background: url(/img/more.png);
    background-size: cover;">
  <div class="container">
    <div class="row">
        <h2 class="" style="width:fit-content;background: rgba(0,0,0,0.6); padding: 8px;">Missie</h2>
    </div><!-- row -->
  </div><!-- container -->
</div>    
    <div class="container" style="padding-top:100px;">
      <div class="row">
          <div style="font-size: 2em;" >
                <?php echo $services ?>      
          </div>
      
 
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- get in touch -->
<section id="services-section" class="page" style="background-color:white;">
     <div class="container">
         <?php 
            $ctrl=new IndexController();
            $services=$ctrl->getSterk();
         ?>
        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0" style="visibility: visible; animation-name: zoomIn;">
                                    <div>
                                             <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    </div>
                                  
                               
                                    <div class="rotate-box-info">
                                        <h2><?php echo $services[0]['naam'] ?></h2>
                                          <hr />
                                        <p><?php echo $services[0]['omschrijving'] ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">
                                    <div>
                                          <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    </div>
                                  
                                    <div class="rotate-box-info">
                                        <h2><?php echo $services[1]['naam'] ?></h2>
                                         <hr />
                                       <p><?php echo $services[1]['omschrijving'] ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="rotate-box-1 square-icon wow zoomIn animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: zoomIn;">
                                    <div>
                                          <span class="rotate-box-icon"><i class="fa fa-star"></i></span>
                                    </div>
                                   
                                    <div class="rotate-box-info">
                                       <h2><?php echo $services[2]['naam'] ?></h2>
                                        <hr />
                                       <p><?php echo $services[2]['omschrijving'] ?></p>
                                    </div>
                                </a>
                            </div>
                        </div> <!-- /.row -->
                        
                        			
    </div>
</section> 

  <!-- footer -->
  <footer >
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="wow zoomIn col-xs-12">
            <p>© 2017 All rights reserved. <span>Webland</span> by <a href="http://webland.be">webland</a></p>
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
<script src="/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
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
</body>
</html>
