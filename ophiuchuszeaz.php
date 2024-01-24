<?php session_start();
$path = getcwd();
$path = $path.'/';
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();

function toonLijstEten(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $rij = array();

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
function getPromo(){
    $rij = array();
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
function print_chat(){
	    echo '

	    <div style=" position:fixed;right:5px; bottom: 0;z-index:999999;">
<div onclick="showChat()" id="chatbox" class="btn-info btn" style="border-color: black; background-color: black;">  <p style="color:white;"><i class="fa fa-commenting-o fa-2x"></i><span style="padding-left:8px;">Chat</span></p></div>
</div>
<div  id="chatBox" style="float:right;display:none; position:fixed;right:1%; bottom: 0;    z-index: 999999;">
	<div class"btn btn-block btn-info" style="border-color: black; background-color: black;color:white;"><i class="fa fa-times" style="    padding-left: 90%;" onclick="hideChat()"></i></div>
<div class="fb-page" data-href="https://www.facebook.com/Yousushi.be" data-tabs="messages" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
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

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SAKI LEUVEN DE LEKKERSTE SUSHI | BESTEL GOEDKOPER">
    <meta name="author" content="webland.be">
    <title>SAKI SUSHI | BESTEL GOEDKOPER</title>
    <!-- Bootstrap core CSS -->
    <link href="/taxi/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="/taxi/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="/taxi/css/agency.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/slick-1/slick/slick-theme.css"/>
   
    <style>
        .blackboard {
    width: 640px;
    max-width: 100%;
    margin: 7% auto;
    border: silver solid 12px;
    border-top: silver solid 12px;
    border-left: silver solid 12px;
    border-bottom: silver solid 12px;
    box-shadow: 0px 0px 6px 5px rgb(58 18 13 / 0%), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgb(0 0 0 / 50%);
    background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 
215deg
, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
    background-color: #333;
}

.krijt {
    vertical-align: middle;
    font-family: 'Permanent Marker', cursive;
    font-size: 1.6em;
    color: rgba(238, 238, 238, 0.7) !important;
    padding: 10px;
    min-height: 250px;
}
.intro-lead-in{
     text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
}
.intro-heading {
    text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
}
tr{
   margin:18px;
   border-bottom: 1px solid black;
}


.pane {
  width: 1em;
  height: 1em;
  display: inline-block;
  margin: 0 auto;
  border-radius: .05em;
  border: .01em solid #444;
  position: relative;
  background: #222;
  text-align: center;
  line-height: 1;
  font-size: 35px;
  color: #fff;
  font-family: monospace;
  box-shadow: 
              0px .02em 0 #ccc,
              0px .05em 0 #000;
  text-shadow: -1px -2px 2px rgba(0,0,0,1);
  z-index: 50;
}

/*.pane:before {
  display: block;
  width: 100%;
  height: 0px;
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  margin: 0 auto;
  margin-left: -.05em;
  border: .05em solid black;
  z-index: -10;
  
}*/

.pane:after {
  position: absolute;
  top: 50%;
  left: 0;
  content: "";
  border-top: 2px solid #000;
  border-bottom: 2px solid rgba(255,255,255,.3);
  width: 100%;
  height: 0px;
  opacity: .8;
  z-index: 10;
  margin-top: -1px
}

.red{
    color: red !important;
}

    </style>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="tel:016 90 22 10" style="color:red;"> <i class="fa fa-mobile"></i>016 90 22 10</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Sterktes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/menu.php">Bestel</a>
            </li>
            <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="https://www.facebook.com/sakileuven/"><i class="fa fa-facebook" style="color:#4267B2"></i></a>
             </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container-fluid slides ">
        <div class="intro-text" style="background-image: url('/slides/service-1.jpg');
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-position: center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
            <img class="mx-auto rounded-circle" src="/logo/logo.png" alt="">
          <div class="intro-lead-in">Koken is een kunst, een passie voor ons</div>
          <div class="intro-heading text-uppercase">SAKI SUSHI</div>
          <a style="background-color:red;background:red;" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="/menu.php">BESTEL</a>
        </div>
        <div class="intro-text" style="background-image: url('/slides/service-2.jpg');
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-position: center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;    padding-top: 300px;
    padding-bottom: 200px;">
            <img class="mx-auto rounded-circle" src="/logo/logo.png" alt="">
          <div class="intro-lead-in">Koken is een kunst, een passie voor ons</div>
          <div class="intro-heading text-uppercase">SAKI SUSHI</div>
          <a style="background-color:red;background:red;" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="/menu.php">BESTEL</a>
        </div>
        <div class="intro-text" style="background-image: url('/slides/service-3.jpg');
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-position: center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;    padding-top: 300px;
    padding-bottom: 200px;">
            <img class="mx-auto rounded-circle" src="/logo/logo.png" alt="">
          <div class="intro-lead-in">Koken is een kunst, een passie voor ons</div>
          <div class="intro-heading text-uppercase">SAKI SUSHI</div>
          <a style="background-color:red;background:red;" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="/menu.php">BESTEL</a>
        </div>
      </div>
    </header>

    <!-- Services -->
    <section id="services">
       
      <div class="container">
            <div class="row">
                
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase"> ORGANISEERT U EEN FEESTJE?</h2>
            <h3 class="section-subheading text-muted">We hebben een zeer groot assortiment van hapjes, sushi boten en een compleet menu voor al uw feestjes of (bedrijfs) events.</h3>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">De beste chef-koks</h4>
            <p class="text-muted">We hebben de beste chef-koks die veel ervaring hebben in de Aziatische en Europese keuken.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-heart-o fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Gezonde voeding</h4>
            <p class="text-muted">Onze keuken is hoe dan ook gekend voor zijn hygiene, lekkere gezonde maaltijden geserveerd met de meest verse ingrediënten. </p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Correcte prijzen</h4>
            <p class="text-muted">Onze prijzen zijn van te smullen. Zeker als student.</p>
          </div>
        </div>
      </div>
       
    </section>
<img src="/man.jpg" style="width:100%" alt="pattren"/>
   

    <!-- Team -->
    <section class="bg-light" id="team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
              <img style="width:25%; border-radius:50%; border:1px solid black;margin-bottom:25px;" src='/image.jpg' alt='Welkom bij Saki Sushi bestel online.'/>
            <h2 class="section-heading text-uppercase">Welkom</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            
          </div>
          <div class="col-sm-4">
            <div class="team-member">
             
            </div>
          </div>
          <div class="col-sm-4">
            
          </div>
        </div>
        <div class="blackboard" style="">
					<div class="krijt"><p>U ontvangt meteen 10% korting per bestelling.</p></div>
				</div>

        <div class="row">
              <p>saki is a new creation of sushi ,thai & asian fusion kichen art. we create our dishes with art and passion. with us you will have fresh & healthy food!</p>
              	</div>
              
              		   <div class="row">
              <div class="col-lg-6" >
                  <div class="text-center">
                      <h1 class="red">-<i class="fa fa-clock-o"></i>PENINGSUREN- </h1>
                     
                  </div>
                  
                  <div>
                      <div class="pane">M</div>
                  <div class="pane">A</div>
                  <div class="pane">1</div>
                  <div class="pane">0</div>
                  <div class="pane">:</div>
                  <div class="pane">2</div>
                  <div class="pane">1</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">2</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">6</div>
                  </div>
                     <div class="pane">D</div>
                  <div class="pane">I</div>
                  <div class="pane">1</div>
                  <div class="pane">1</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">2</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div> 
                   <div>
                      <div class="pane">W</div>
                  <div class="pane">O</div>
                  <div class="pane">1</div>
                  <div class="pane">0</div>
                  <div class="pane">:</div>
                  <div class="pane">2</div>
                  <div class="pane">1</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">1</div>
                  <div class="pane">:</div>
                  <div class="pane">5</div>
                  <div class="pane">1</div>
                  </div>
                  <div>
                   <div class="pane">D</div>
                  <div class="pane">O</div>
                  <div class="pane">1</div>
                  <div class="pane">1</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">2</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  </div>
                   <div>
                   <div class="pane">V</div>
                  <div class="pane">R</div>
                  <div class="pane">1</div>
                  <div class="pane">1</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">2</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  </div>
                   <div>
                   <div class="pane">Z</div>
                  <div class="pane">A</div>
                  <div class="pane">1</div>
                  <div class="pane">5</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">2</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  </div>
                     <div>
                   <div class="pane">Z</div>
                  <div class="pane">O</div>
                  <div class="pane">1</div>
                  <div class="pane">5</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  <div class="pane">-</div>
                  <div class="pane">2</div>
                  <div class="pane">2</div>
                  <div class="pane">:</div>
                  <div class="pane">0</div>
                  <div class="pane">0</div>
                  </div>
          
               </div>
              <div class="col-lg-6" style='width:50%;float:right;'>
                  <img src='/bord.png' style='width:100%' />
              </div>
              
             
             
        </div>
        
      </div>
    </section>
    <img src="/man.jpg" style="width:100%" alt="pattren"/>
 <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            
              
            <h2 class="section-heading text-uppercase">Contact</h2>
            <h3 class="section-subheading text-muted" style="color:red!important;">sakileuven@gmail.com</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
          
                  <input type="submit" id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
<img src="/man.jpg" style="width:100%" alt="pattren"/>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d80471.8172528656!2d4.767008751973006!3d50.9284471022065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c141c5830e6ed9%3A0x9eda8ef2a293a6d6!2sSaki%20sushi!5e0!3m2!1snl!2sbe!4v1627141630723!5m2!1snl!2sbe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

   
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; <a href="webland.be">Webland.be</a> 2018</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                
              </li>
              <li class="list-inline-item">
               
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    

    <!-- Bootstrap core JavaScript -->
    <script src="/taxi/vendor/jquery/jquery.min.js"></script>
    <script src="/taxi/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript slick-1/slick/slick.js -->
    <script src="/taxi/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/taxi/js/jqBootstrapValidation.js"></script>
    <script src="/taxi/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/taxi/js/agency.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
        $('.slides').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 3000,
        });
    });
    </script>
  </body>

</html>
