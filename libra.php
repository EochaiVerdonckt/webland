<?php
session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
require (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 
require (FSPATH."Controllers/indexController.php"); 
$ctrl=new SlidesController();
$slide1=$ctrl->getSlide(1);
$slide2=$ctrl->getSlide(2);
$slide3=$ctrl->getSlide(3);

function getPromo(){

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

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
$conn = $ctrl->getConnection();
    $rij = array();


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

function getServices()
{

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

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


function getHours()
{
    $ctrl=new IndexController();
$conn = $ctrl->getConnection();
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

function getSterk()
{
  
    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

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
<html lang="nl">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

     <title>WEBLAND | Bij ons betaalt u niet teveel!</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="WIj bieden u zeer proffesionele websites aan die u zelf makkelijk kan aanpassen, met eigen hosting en domeinnaam vanaf €180/jaar">
    <meta name="keywords" content="">
    <meta name="author" content="Eoghain Verdonckt">

    <!-- Bootstrap Css -->
   
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Cinzel+Decorative|Megrim" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    
    
    .font-1
    {
        font-family: 'Berkshire Swash', cursive;
    }
    
    .font-2
    {
        font-family: 'Cinzel Decorative', cursive;
        padding-bottom: 2%;
    margin-bottom: 0%;
    padding-top: 2%;
    text-align: center;
    color: #B29600;
    }
    
    .font-3
    {
        font-family: 'Megrim', cursive;
    }
    
    a:hover, a:visited, a:link, a:active
    {
          text-decoration: none  !important;
    }
    
    
    .special-input
    {
        border: 2px solid black;
        border-radius: 0;
    }
    
    @media only screen and (max-width: 500px) {
        #artwork,  #artwork3, #bigScreen, #bigScreen2, #bigScreen3, #bigScreen4 {
            display:none;
        }
        .hideSmall
        {
            display:none;
        }
    }
    @media only screen and (min-width: 501px) {
        #artwork2, #smallScreen, #smallScreen2 {
            display:none;
        }
    }
    
    

    .link h1
    {
        margin-bottom: 0; padding: 4%;text-align: center;
    }
    
      .link a
    {
        border:0; color: black; padding: 5px;    text-shadow: 2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }
     
    .nav-link
    {
        text-shadow: none !important;
        
    }
     
     .krijt {
    vertical-align: middle;
    font-family: 'Permanent Marker', cursive;
    font-size: 1.6em;
    color: rgba(238, 238, 238, 0.7);
    padding: 10px;
    min-height: 250px;
}

.blackboard {
    width: 640px;
    max-width: 100%;
    margin: 7% auto;
    border: silver solid 12px;
    border-top: silver solid 12px;
    border-left: silver solid 12px;
    border-bottom: silver solid 12px;
    box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
    background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
    background-color: #333;
}

.fa-star
{
     color: white;
    text-shadow: -1px 0 #B29600, 0 1px #B29600, 1px 0 #B29600, 0 -1px #B29600;
}
.dropdown-item{
     color: black;
    
}
.snow-flake{
   width:100%;
   padding-bottom:60%;
}

.item{
  background: rgba(0,0,0,0.6);
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
</head>

<body style="background-color: white;">

     <?php $ctrl->print_nav_libra(); ?>
   <section style="padding-bottom:10%;   background-image: url('/slides/service-1.jpg'); background-repeat: no-repeat;background-position: cover;  background-size: cover; " data-stellar-background-ratio="0.5" style="background-position: 50% 0px;">
        <div data-stellar-ratio="-1" class="ratio--1">
              <div class="row" style="padding-top:250px;margin-left:10%;margin-right:10%;">
                   <div class="col-md-1">
                      
                  </div>
                  <div class="col-md-3" style="background:white;border:3px solid #0EBFE9;color:black;">
                      <h1 style="color:#0EBFE9;">1.</h1>
                      <h3><?php echo $slide1['titel'];?></h3>
                      <h5><?php echo $slide1['Conclusie'];?></h5>
                  </div>
                  <div class="col-md-1">
                      
                  </div>
                  <div class="col-md-3" style="background:white;border:3px solid #0EBFE9	;color:black;">
                       <h1 style="color:#0EBFE9;">2.</h1>
                      <h3><?php echo $slide2['titel'];?></h3>
                      <h5><?php echo $slide2['Conclusie'];?></h5>
                  </div>
                   <div class="col-md-1">
                      
                  </div>
                  <div class="col-md-3" style="background:white;border:3px solid #0EBFE9	;color:black;">
                       <h1 style="color:#0EBFE9;">3.</h1>
                      <h3><?php echo $slide3['titel'];?></h3>
                      <h5><?php echo $slide3['Conclusie'];?></h5>
                  </div>
                  
              </div>
       </div>
   </section>
    <section style="background-color: white;">
        <div class='text-center'>
            <img src="logo.png" style="width: 10%;" />  
            <h1>Welkom</h1>
        </div>
    </section>   
<section>
      <div style="width:80%;margin-left: 10%;">
            <div style="font-size: 1.5em;color: black;">
                          <?php echo  getPromo(); ?>  
            </div>  
            
              <?php $services=getSterk();?>
            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="text-center">
                                 <i class="fa fa-star fa-4x" ></i>
                                  <h2 style="color:black;"><?php echo $services[0]['naam'] ?></h2>
                                  
                            </div>
                           <div style="color: black!important;">
                                  <?php echo $services[0]['omschrijving'] ?>     
                            </div>
                           
                         
                           
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                              <div class="text-center">
                                 <i class="fa fa-star fa-4x" ></i>
                                  <h2 style="color:black;"><?php echo $services[1]['naam'] ?></h2>
                            </div>
                            <div style="color: black!important;">
                                <?php echo $services[1]['omschrijving'] ?>
                            </div>
                         
                          
                        </div>
                    </div><!--/.col-md-4-->
                     <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                             <div class="text-center">
                                 <i class="fa fa-star fa-4x"></i>
                                  <h2 style="color:black;"><?php echo $services[2]['naam'] ?></h2>
                            </div>
                            <div style="color: black!important;">
                                 <?php echo $services[2]['omschrijving'] ?>
                            </div>
                        
                           
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.services-->
            </div><!--/.row--> 
       </div>
            
            <div class="row">
                <div class="blackboard">
					<div class="krijt"> 
					    <?php echo  getKrijt(); ?> 
                    </div>
				</div>
            </div>
            <div class="row" id="carnaval" style="margin-left:150px;margin-right:150px;">
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
    
</section>
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
	                    <p style="color:white;font-size:1.2em;">Wij, bieden u de keuze uit een 7-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
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
  
   <section id="hours" style="margin-top:125px;padding-bottom: 15px;background: white;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <div class="text-center">
        <h3 style="color:black;" class="font-2">Openingsuren</h3>
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
      
                <h4>Ma: <?php echo $hours[0]['waarde']?></h4>
        <h4>Di: <?php echo $hours[1]['waarde']?></h4>
        <h4>Wo: <?php echo $hours[2]['waarde']?></h4>
        <h4>Do: <?php echo $hours[3]['waarde']?></h4>
          <h4>Vr: <?php echo $hours[4]['waarde']?></h4>
        <h4>Za: <?php echo $hours[5]['waarde']?></h4>
        <h4>Zo: <?php echo $hours[6]['waarde']?></h4>
        
        

    </div>
            </div>
            <div class="col-md-6">
               <h1 style="color: black;text-transform: uppercase;text-align: center; padding-bottom:0" class="font-2">info@webland.be</h1>
       <h3 style="color: black;text-transform: uppercase;text-align: center; padding-top:0" class="font-2">+32 (0)485 86 59 70</h3>
                       <form method="POST"  action="send.php" style="width: 80%;margin-left: 10%;">
                    <label style="color: black;">Naam</label>
                    <input type="text" name="naam" class="form-control special-input"/>
                    <label style="color: black;">Email</label>
                    <input type="text" name="email" class="form-control special-input"/>
                    <label style="color: black;">Tel/gsm</label>
                    <input type="text" name="tel" class="form-control special-input"/>
                    <label style="color: black;">Onderwerp</label>
                    <input type="text" name="onderwerp" class="form-control special-input"/>
                    <label style="color: black;">Bericht</label>
                    <textarea name="msg" class="form-control special-input" rows="10">
                        
                    </textarea>
                    <input type="submit" class="btn btn-success btn-block font-2" style="margin-top: 2%;
    background-color: white;
    color: black;
    border: 2px solid black;
    border-radius: 0;
    padding: 2%;" />
                </div>
	            
                    
                    
                                        <?php
                    if(!empty($_SESSION['out']))
                    {
                        echo '<p>'.$_SESSION['out'].'</p>';
                        $_SESSION['out']=null;
                    }
                      $ctrl->print_chat();
                    ?>
                </form> 
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
   <div class="more-area" id="" style="    background: url(../img/more3.png) no-repeat center center;
    background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="pull-left" id="gratis" style="color:white;background: rgba(0,0,0,0.6);padding:5px;">Ontdek hoe wij het verschil kunnen maken.</h2>
       
        <a  href="/shop" id="load" class="btn btn-success pull-right" style="color: black;
    background: transparent;
    font-size: 1.5em;
    margin-top: 18px;">Bekijk.</a>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div>
	 
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10072.82079286013!2d4.694184!3d50.8644008!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x52bed37ce3e8c65d!2sWebland+Belgi%C3%AB!5e0!3m2!1snl!2sbe!4v1557409760050!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>   
    
    <!-- Footer
	============================================= -->
    <footer>
        <div class="container-fluid">
            <div class="row" style="padding-top:2%; padding-bottom:2%; background-color:white;">
                <h3 style="margin-bottom: 0; padding: 4%;    width: 100%;" class="text-center">  © 2019 Comet Web OS - Libra edition All rights reserved by <a href="http://webland.be">webland</a></h3>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row" style="background-color: black;">
            </div>
            
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="jquery.stellar.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/slick/slick/slick/slick.min.js"></script>
    <!-- JS PLUGINS -->
    <script src="plugins/owl-carousel/owl.carousel.min.js"></script>
    <script>
        $(window).stellar();

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
        $(".fa-star").hover(
  function () {
    $(this).addClass('fa-spin');
  }, 
  function () {
    $(this).removeClass('fa-spin');
  }
  );
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