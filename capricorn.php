<?php session_start();
$path = getcwd();
$path = $path.'/';
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/blogController.php");
$ctrl=new indexController();
$blgCtrl=new BlogController();



function toonLijstEten()
{
    $ctrl=new indexController();
    $conn=$ctrl->getConnection();
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
<div class="fb-page" data-href="https://www.facebook.com/TK-GROUP-1927345580609960" data-tabs="messages" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
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
    $ctrl=new indexController();
    $conn=$ctrl->getConnection();

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
        $ctrl=new indexController();
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

function getSterk()
{
      $ctrl=new indexController();
    $conn=$ctrl->getConnection();
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

function print_artikels()
{

      $ctrl=new indexController();
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
            echo '</p></div>
                 </div></div></div>';
        }
    }
    mysqli_close($conn);
}
function getPromo()
{
      $ctrl=new indexController();
    $conn=$ctrl->getConnection();

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
      $ctrl=new indexController();
    $conn=$ctrl->getConnection();

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
       $ctrl=new indexController();
    $conn=$ctrl->getConnection();
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

function getServicesPublished(){
    $ctrl=new indexController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM services where `publish`=1 ORDER BY id";
    $result = mysqli_query($conn, $sql);
    $rij=array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($rij,$row);
          }
    } else {
        
    }
    mysqli_close($conn);
    return $rij;
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
                    <h5 style="float:right;color: white!important;margin-top:8px;">-'.$review['naam'].'-</h5>
                    
                    </div>';
            echo '</div></div>';
}

$slide_buttons=getSideButtons();
$seo=$ctrl->getSeo();

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $seo[0]["waarde"] ?> | <?php echo $seo[1]['waarde'] ?></title>
  
      <link rel="stylesheet" href="cap-css/bootstrap.min.css">
      <link rel="stylesheet" href="cap-css/style.css">
       <!-- Font awesome -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
      <style>
          .verkocht{
              background: orange !important;
          }
          .dropdown-item:focus, .dropdown-item:hover {
                background-color: #00008b;
        }
        .nav-link2 {
            display: block;
            padding: .5rem 1rem;
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
		.snow-flake{ 	
width:100%;
padding-bottom:60%;
}

#mening .item{ 	
 background: #1a2428;
 padding:8px;
}
   

      </style>
   </head>
   <body>
      <div id="header" class="header">
          <?php   $services= getServicesPublished(); ?>
          <?php $ctrl->print_nav_capricorn();?>
       
      </div>
      <div id="home" class="slider">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="d-block w-100" src="/slides/service-1.jpg" alt="slider_img">
                  <div class="ovarlay_slide_cont">
                     <h2><?php echo $seo[0]["waarde"] ?> </h2>
                     <h4><?php echo $seo[2]["waarde"] ?> </h4>
                     <p><?php echo $seo[1]["waarde"] ?> </p>
                     <a class="blue_bt" href="tel:0485865970"><i class="fa fa-mobile"></i> BEL NU</a>
                  </div>
               </div>
              <!--<div class="carousel-item">
                  <img class="d-block w-100" src="cap-imgs/slide1.png" alt="slider_img">
                  <div class="ovarlay_slide_cont">
                     <h2>We love working</h2>
                     <h4>Maintenance service</h4>
                     <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years</p>
                     <a class="blue_bt" href="#">See Our Service</a>
                  </div>
               </div>-->
            </div>
         </div>
      </div>
     
      <div id="about" class="about_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h4>Welkom</h4>
                  <h3 style="text-transform: none !important">Over ons</h3>
                  <?php echo getPromo(); ?>
               </div>
          
            </div>
         </div>
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
	  <?php } ?>
      <?php $sterktes=getSterk();?>
      <div id="hiw" class="hiw_section layout_padding" style="background: #1a2428;">
         <div class="container">
            <div class="row">
               <div class="col-md-7">
                  <h3 class="white_font">Onze sterktes</h3>
                 
               </div>
               <div class="col-md-5">
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <img class="margin_top_30 img-responsive" src="cap-imgs/tijd.jpg" alt="#" />
                  <div class="text-center">
                       <h5 class="blog_head" style="color: white;"><?php echo $sterktes[0]['naam'] ?></h5>
                  </div>
                 
               </div>
               <div class="col-md-4">
                  <img class="margin_top_30 img-responsive" src="cap-imgs/hard.png" alt="#" />
                    <div class="text-center">
                      <h5 class="blog_head" style="color: white;"><?php echo $sterktes[1]['naam'] ?></h5>
                  </div>
                  
               </div>
               <div class="col-md-4">
                  <img class="margin_top_30 img-responsive" src="cap-imgs/happy.png" alt="#" />
                    <div class="text-center">
                       <h5 class="blog_head" style="color: white;"><?php echo $sterktes[2]['naam'] ?></h5>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
        <div class="row" style="margin-top: 12px;margin-left:12px;margin-right:12px;" id="carnaval">
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
        <div id="service" class="hiw_section layout_padding">
         <div class="container">
            <div class="row" >
                <div class="col-md-6" id="milkyWay">
                      <?php 
                foreach ($services as &$value) {
                    echo '<div class="col-md-4 service_blog">
                   <a href="/'.$value['naam'].'.php">
                 
                  <div class="margin_top_30 img-responsive" style="background: url(\'/services/'.$value['foto'].'\');padding-top: 250px;background-size: cover;">
                  </div>
                  <div class="text-center">
                  <h6 class="blog_head" style="color: black">'.$value['naam'].'</h6>
                  </div>
                  
                  </a>
               </div>';
                }
                ?>
                </div>
               <div class="col-md-6">
                   <h1>GRATIS ONTWERPEN.</h1>
<p>Wij, bieden u de keuze uit een 7-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
              </div>
               
               
            </div>
         </div>
      </div>
     
      <div id="contact" class="hiw_section layout_padding" style="background: #eeefef;">
         <div class="container">
            <div class="row">
               <div class="col-md-7">
                  <h3>Stuur een bericht</h3>
               </div>
               <div class="col-md-5">
               </div>
            </div>
            <div class="row">
               <div class="col-md-7">
                  <div class="contact-form">
                     <form method="post" action="mail.php">
                        <input type="text" placeholder="Name" name="naam" />
                        <input type="email" placeholder="Email" name="email"/>
                        <input type="text" placeholder="Telefoon" name="phone" />
                        <input type="text" placeholder="Onderwerp" name="subject">
                        <textarea placeholder="Message" name="bericht"></textarea>
                        <?php 
                        if($_SESSION['mail']){
                            echo "<h3>Uw bericht is verzonden.</h3>";
                        }else{
                        ?>
                        <input type="submit" value="SEND">
                        <?php }?>
                     </form>
                  </div>
               </div>
               <div class="col-md-5 text_align_center">
                  <img class="img-responsive" src="cap-imgs/house.png" alt="#" />
               </div>
            </div>
         </div>
      </div>
    <?php print_chat(); ?>

      <footer style="bxacxkground: color; background-color: black;">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-6 col-12">
                  <div class="footer_blog_section">
                     <img src="css/spinner.gif" alt="#" style="width:30%;" />
                     <p style="margin-top: 5px;">Prullen beu? Contacteer ons vandaag nog voor een proffesionele website die u zelf kan aanpassen.</p>
                  </div>
               </div>
               <div class="col-lg-2 col-md-6 col-12">
                  <div class="item">
                     <h4 class="text-uppercase">Navigation</h4>
                     <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Location</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Features</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-12">
                  <div class="item">
                     <h4 class="text-uppercase">Contact Info</h4>
                    
                     <p><img src="cap-imgs/phone_icon.png" alt="#" /> Waversebaan 57, 3001 Leuven</p>
              
                     <p><img src="cap-imgs/location.png" alt="#" /> 0485/865.970</p>
                  </div>
               </div>
               
            </div>
         </div>
         <div class="copyright text-center">
            <p>Copyright 2019  Design by <a href="https://webland.be">Webland</a></p>
         </div>
      </footer>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="cap-js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>
      <script>
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
         $(function () {
             
             'use strict';
             
             var winH = $(window).height();
             
             $('header').height(winH);  
             
             $('header .container > div').css('top', (winH / 2) - ( $('header .container > div').height() / 2));
             
             $('.navbar ul li a.search').on('click', function (e) {
                 e.preventDefault();
             });
             $('.navbar a.search').on('click', function () {
                 $('.navbar form').fadeToggle();
             });
             
             $('.navbar ul.navbar-nav li .nav-link').on('click', function (e) {
                 
                 var getAttr = $(this).attr('href');
                 
                 e.preventDefault();
                 $('html').animate({scrollTop: $(getAttr).offset().top}, 1000);
             });
         })
      </script>
   </body>
</html>