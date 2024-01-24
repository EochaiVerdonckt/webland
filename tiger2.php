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
    
  
            echo '
              <div class="col-sm-3 col-md-3" style="min-height:650px;">
                    <div class="menu-images "><img src="/categ/'.$cat['foto'].'" alt="Hot Drinks"></div>
                    <div class="menu-titles"><h1 class="">'.$cat['naam'].'</h1></div>
                    <div class="menu-items ">
                        <p>'.$cat['omschrijving'].'</p>
                        <ul>
                            <li>Espresso</li>
                            <li>Americano</li>
                            <li>Capuccino</li>
                            <li>Latte</li>
                            <li>Mocha</li>
                            <li>Hot Chocolate</li>
                            <li>Yummie Cafee</li>
                            <li>Fruit Tea</li>
                        </ul>
                        <a style="margin-top:50px;background: transparent; border: 1px solid black;" class="btn btn-default" href="/shop/index.php?cat='.$cat['id'].'"> ONTDEK </a>
                    </div>
                </div>
            ';
}

function getReviews($ctrl){
    return $ctrl->selectStatement('reviews',1);
}

function getDoelgroep($ctrl){
    return $ctrl->selectStatement('doelgroep',1);
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
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <title><?php echo $seo['0']['waarde']?></title>

    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta property="og:description"  content="<?php echo $seo['1']['waarde']?>" />
    <meta name="description" content="<?php echo $seo['1']['waarde']?>">
  
    <!-- css -->
    <link rel="stylesheet" href="/rat/css/bootstrap.min.css">
    <link rel="stylesheet" href="/rat/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/rat/css/font-awesome.min.css">
    <link rel="stylesheet" href="/rat/css/main.css">

    <!-- google font -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Kreon:300,400,700'>
    
    <!-- js -->
    <script src="/rat/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <style>
    #header {
     background-image: url('/slides/<?php echo $slide1['foto']?>');
     -webkit-background-size: /*@@prefixmycss->No equivalent*/;
     -moz-background-size: cover;
     -o-background-size: /*@@prefixmycss->No equivalent*/;
     background-size: cover;
     background-position: center center;
     background-attachment: fixed;
     background-repeat: no-repeat;
     position: relative;
     }
    </style>
</head>
<body data-spy="scroll" data-target="#navbar" data-offset="120" >
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div id="menu" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header visible-xs">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><h2>Meat King</h2></a>
            </div><!-- navbar-header -->
        <div id="navbar" class="navbar-collapse collapse">
            <div class="hidden-xs" id="logo"><a href="#header">
                <img src="logo/logo.png" alt="">
            </a></div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#story">Story</a></li>
                <li><a href="#reservation">Reservation</a></li>
                <li><a href="#chefs">Our Chefs</a></li>

                
                <li><a href="#facts">Facts</a></li>
                <li><a href="#food-menu">Food Menu</a></li>
                <li><a href="#special-offser">Special Offers</a></li>
                
                <!--fix for scroll spy active menu element-->
                <li style="display:none;"><a href="#header"></a></li>

            </ul>
        </div><!--/.navbar-collapse -->
        </div><!-- container -->
    </div><!-- menu -->

    <div id="header" style="background-image: url('/slides/<?php echo $slides[0]['foto']?>')">
        <div class="bg-overlay"></div>
        <div class="center text-center">
            <div class="banner">
                <h1 class=""><?php echo $slide1['titel']?></h1>
            </div>
            <div class="subtitle"><h4><?php echo $slide1['Conclusie']?></h4></div>
        </div>
        <div class="bottom text-center">
            <a id="scrollDownArrow" href="#"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
    <!-- /#header -->

    <div id="story" class="light-wrapper">
        <section class="ss-style-top"></section>
        <div class="container inner">
            <div class="row text-center">
                  <?php 
                            $ctrl=new IndexController();
                            echo $ctrl->getPromo();
                    ?> 
            </div>
            <h2 class="section-title text-center">Onze sterktes</h2>
            <p class="lead main text-center">Waarom u ons zeker wilt leren kennen.</p>
            <div class="row text-center story">
                <?php
            $ctrl=new IndexController();
            $sterktes=$ctrl->getSterk();
                ?>
                <div class="col-sm-4">
                    <div class="col-wrapper">
                        <div class="icon-wrapper"> <i class="fa fa-star"></i> </div>
                        <h3><?php echo $sterktes[0]['naam'] ?></h3>
                        <p><?php echo $sterktes[0]['omschrijving'] ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-wrapper">
                        <div class="icon-wrapper"> <i class="fa  fa-star"></i> </div>
                        <h3><?php echo $sterktes[1]['naam'] ?></h3>
                        <p><?php echo $sterktes[1]['omschrijving'] ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-wrapper">
                        <div class="icon-wrapper"> <i class="fa fa-star"></i> </div>
                       <h3><?php echo $sterktes[2]['naam'] ?></h3>
                        <p><?php echo $sterktes[2]['omschrijving'] ?></p>
                    </div>
                </div>
            </div>
            <!-- /.services --> 
         
        </div>
        <!-- /.container -->
        <section class="ss-style-bottom"></section>
    </div><!-- #story -->


    <div id="facts" class="parallax parallax2 facts">
        <div class="container inner">
            <div class="row text-center services-3">
             
                <div class="col-sm-3">
                 
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-wrapper">
                    
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-wrapper">
                    
                   
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-wrapper">
                 
                </div>
            </div>
        </div>
        <!-- /.container --> 
    </div><!-- #facts -->




    <div id="food-menu" class="light-wrapper">
        <section class="ss-style-top"></section>
        <div class="container inner">
            <h2 class="section-title text-center">Onze modules</h2>
            <p class="lead main text-center">Ontdek hoe wij het verschil maken</p>

                        <div class="row">
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
              <!--
                <div class="col-sm-3 col-md-3">
                    <div class="menu-images "><img src="img/menu/deserts.png" alt="Deserts"></div>
                    <div class="menu-titles"><h1 class="">Deserts</h1></div>
                    <div class="menu-items ">
                        <ul>
                            <li>Cheesecake</li>
                            <li>Choco Pie</li>
                            <li>Pancakes</li>
                            <li>Muffins</li>
                            <li>Fruit Slices</li>
                            <li>Fruit Salad</li>
                            <li>Cream Cake</li>
                            <li>Ice Cream</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="menu-images "><img src="img/menu/cocktails.png" alt="Hot Drinks"></div>
                    <div class="menu-titles"><h1 class="">Cocktails</h1></div>
                    <div class="menu-items ">
                        <ul>
                            <li>Black Velvet</li>
                            <li>Gin Sour</li>
                            <li>Mojito</li>
                            <li>Long Island</li>
                            <li>Orgasm</li>
                            <li>Bloody Mary</li>
                            <li>Earthquake</li>
                            <li>Whisky Mac</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="menu-images "><img src="img/menu/beer.png" alt="Ice Drinks"></div>
                    <div class="menu-titles"><h1 class="">Beer</h1></div>
                    <div class="menu-items ">
                        <ul>
                            <li>Lager</li>
                            <li>Blonde Beer</li>
                            <li>Black Beer</li>
                            <li>Blonde Ale</li>
                            <li>Pilsner</li>
                            <li>Lemon Beer</li>
                            <li>Unfiltered Beer</li>
                            <li>Non-Alcoholic</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="menu-images "><img src="img/menu/wine.png" alt="Smoothies"></div>
                    <div class="menu-titles"><h1 class="">Wine</h1></div>
                    <div class="menu-items ">
                        <ul>
                            <li>Sweet Red</li>
                            <li>Dry Red</li>
                            <li>Sweet White</li>
                            <li>Dry White</li>
                            <li>Rose</li>
                            <li>Sparkling Wine</li>
                            <li>Fortified Wine</li>
                            <li>Frutty Red</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="menu-images "><img src="img/menu/sprites.png" alt="Deserts"></div>
                    <div class="menu-titles"><h1 class="">Sprites</h1></div>
                    <div class="menu-items ">
                        <ul>
                            <li>Whisky</li>
                            <li>Rum</li>
                            <li>Tequila</li>
                            <li>Gin</li>
                            <li>Champagne</li>
                            <li>Brandy</li>
                            <li>Absinthe</li>
                            <li>Liqueur</li>
                        </ul>
                    </div>
                </div>-->
            </div>
            
        </div>
        <!-- /.container -->
        <section class="ss-style-bottom"></section>
    </div><!--/#food-menu-->




    <div id="special-offser" class="parallax pricing">
        <div class="container inner">

            <h2 class="section-title text-center">Voor wie?</h2>
            <p class="lead main text-center">Webland is er natuurlijk voor iedereen</p>
            <?php $doelen=getDoelgroep($ctrl); ?>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    
                    <div class="pricing-item">
                        
                        <a href="#"><img class="img-responsive img-thumbnail" src="/rat/img/dish/dish3.jpg" alt=""></a>
                        
                        <div class="pricing-item-details">
                            
                            <h3><a href="#"> <?php echo  $doelen[0]['naam'] ?></a></h3>
                            
                            <p><?php echo  $doelen[0]['omschrijving'] ?></p>
                            
                            <a class="btn btn-danger" href="tel:0485865970">Bel nu </a>
                            <div class="clearfix"></div>
                        </div>
                        <!--price tag-->
                        <span class="hot-tag br-red"><i class="fa fa-heart"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    
                    <div class="pricing-item">
                        
                        <a href="#"><img class="img-responsive img-thumbnail" src="/rat/img/dish/dish2.jpg" alt=""></a>
                        
                        <div class="pricing-item-details">
                            
                            <h3><a href="#"><?php echo  $doelen[1]['naam'] ?></a></h3>
                            
                            <p><?php echo  $doelen[1]['omschrijving'] ?></p>
                            
                            <a class="btn btn-danger" href="tel:0485865970">Bel nu</a>
                            <div class="clearfix"></div>
                        </div>
                        <!--price tag-->
                        <span class="hot-tag br-lblue"><i class="fa fa-heart"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix visible-md"></div>
                <div class="col-md-6 col-sm-6">
                    
                    <div class="pricing-item">
                        
                        <a href="#"><img class="img-responsive img-thumbnail" src="/rat/img/dish/dish4.jpg" alt=""></a>
                        
                        <div class="pricing-item-details">
                            
                            <h3><a href="#"><?php echo  $doelen[2]['naam'] ?></a></h3>
                            
                            <p><?php echo  $doelen[2]['omschrijving'] ?></p>
                            
                            <a class="btn btn-danger" href="tel:0485865970">Bel nu</a>
                            <div class="clearfix"></div>
                        </div>
                        <!--price tag-->
                        <span class="hot-tag br-green"><i class="fa fa-heart"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    
                    <div class="pricing-item">
                        
                        <a href="#"><img class="img-responsive img-thumbnail" src="/rat/img/dish/dish1.jpg" alt=""></a>
                        
                        <div class="pricing-item-details">
                            
                            <h3><a href="#"><?php echo  $doelen[3]['naam'] ?></a></h3>
                            
                            <p><?php echo  $doelen[3]['omschrijving'] ?></p>
                            
                            <a class="btn btn-danger" href="tel:0485865970">Bel nu</a>
                            <div class="clearfix"></div>
                        </div>
                        <!--price tag-->
                        <span class="hot-tag br-red"><i class="fa fa-heart"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container --> 
    </div><!-- /#special-offser -->




    <div id="reservation" class="light-wrapper">
        <section class="ss-style-top"></section>
        <div class="container inner">
            <h2 class="section-title text-center">Stuur een bericht</h2>
            <p class="lead main text-center">Aarzel niet</p>
            <div class="row">
                <div class="col-md-6">
                    <form class="form form-table" method="post" name="">
                        <div class="form-group">
                            <h4>baas@webland.be (alle velden zijn verplicht required)</h4>
                        </div>
<!--
                        <div class="row">
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="first_name1">first name</label>
                            <input class="form-control hint" type="text" id="first_name1" name="first_name" placeholder="First name" required="">
                          </div>
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="last_name1">last name</label>
                            <input class="form-control hint" type="text" id="last_name1" name="last_name" placeholder="Last name" required="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="email1">email</label>
                            <input class="form-control hint" type="email" id="email1" name="email" placeholder="Email@domain.com" required="">
                          </div>
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="phone1">phone</label>
                            <input class="form-control hint" type="text" id="phone1" name="phone" placeholder="Phone" required="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="reserv_date1">reservation date</label>
                            <input class="form-control datepicker hasDatepicker hint" type="text" id="reserv_date1" name="reserv_date" placeholder="Reservation date" required="">
                          </div>
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="numb_guests1">number of guests</label>
                            <input class="form-control hint" type="text" id="numb_guests1" name="numb_guests" placeholder="Number of guests" required="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="alt_reserv_date1">time from</label>
                            <input class="form-control datepicker hasDatepicker hint" type="text" id="alt_reserv_date1" name="alt_reserv_date" placeholder="Time from" required="">
                          </div>
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="time1">time</label>
                            <input class="form-control timepicker ui-timepicker-input hint" type="text" id="time1" name="time" placeholder="Time to" required="" autocomplete="off">
                          </div>
                        </div>-->
                            <div class="row">
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="first_name1">Naam</label>
                            <input class="form-control hint" type="text" id="first_name1" name="name" placeholder="Naam" required="">
                          </div>
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="last_name1">Telefoon</label>
                            <input class="form-control hint" type="text" id="last_name1" name="telefoon" placeholder="Telefoon" required="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="email1">email</label>
                            <input class="form-control hint" type="email" id="email1" name="email" placeholder="Email@domain.com" required="">
                          </div>
                          <div class="col-lg-6 col-md-6 form-group">
                            <label class="sr-only" for="phone1">Onderwerp</label>
                            <input class="form-control hint" type="text" id="phone1" name="phone" placeholder="Onderwerp" required="">
                          </div>
                        </div>
                       
                        <div class="row">
                        
                          <div class="col-lg-12 col-md-12 form-group">
                            <label class="sr-only" for="time1">Tekst</label>
                            <textarea class="form-control  hint" type="text" id="time1" name="msg" placeholder="Bericht" required="" autocomplete="off"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12 col-md-12">
                        
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12 col-md-12">
                            <button type="submit" class="btn btn-danger btn-lg">Verstuur!</button>
                          </div>
                        </div>
                      </form>
                </div><!-- col-md-6 -->
                <div class="col-md-5 col-md-offset-1">
                    
                    <h3><i class="fa fa-clock-o fa-fw"></i>Openingsuren</h3>
                    
                    <p>Mon to Fri: 9:00 AM - 06:30 PM<br></p>
                    
                    <h3><i class="fa fa-map-marker fa-fw"></i>Adres</h3>
                    <p>Waversebaan 57, 3001 Leuven</p>

                    <h3><i class="fa fa-mobile fa-fw"></i>Contacts</h3>
                    <p>Email: <a href="mailto:baas@webland.be">baas@webland.be</a></p>
                    <p>Phone: +32 (0)485 86 59 70</p>

                </div><!-- col-md-6 -->
            </div>
            <!-- /.services --> 
        </div>
        <!-- /.container -->
        <section class="ss-style-bottom"></section>
    </div><!-- #reservation -->



    <div id="chefs" class="parallax pricing">
        <div class="container inner">

            <h2 class="section-title text-center">Onze ontwerpen</h2>
            <p class="lead main text-center">Wij, bieden u de keuze uit een 25-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.</p>
            
            <div class="row text-center chefs">
                <div class="col-sm-4">
                    <div class="col-wrapper">
                        <div class="icon-wrapper">
                            <img src="/rat/img/chefs/1.jpg">
                        </div>
                        <h3>Saransh Goila</h3>
                        <p>Vivamus sagittis lacuson augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum ultricies vehicula.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-wrapper">
                        <div class="icon-wrapper">
                            <img src="img/chefs/3.jpg">
                        </div>
                        <h3>Jane Doe</h3>
                        <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cum sociis natoque penatibus et magnis dis parturient monte nascetur ultricies vehicula. </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-wrapper">
                        <div class="icon-wrapper">
                            <img src="img/chefs/2.jpg">
                        </div>
                        <h3>Anton Mosimann</h3>
                        <p>Curabitur blandit matti tempus porttitor. Donec id elit non mi porta ut gravida at eget metus. Consectetur adipiscing elit ultricies vehicula.</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container --> 
    </div><!-- /#chefs -->


    <footer id="footer" class="dark-wrapper">
        <section class="ss-style-top"></section>
        <div class="container inner">
            <div class="row">
                <div class="col-sm-6">
                    &copy; Copyright MeatKing 2014
                    <br/>Theme By <a class="themeBy" href="http://www.Themewagon.com">ThemeWagon</a>
                </div>
                <div class="col-sm-6">
                    <div class="social-bar">
                        <a href="#" class="fa fa-instagram tooltipped" title=""></a>
                        <a href="#" class="fa fa-youtube-square tooltipped" title=""></a>
                        <a href="#" class="fa fa-facebook-square tooltipped" title=""></a>
                        <a href="#" class="fa fa-pinterest-square tooltipped" title=""></a>
                        <a href="#" class="fa fa-google-plus-square tooltipped" title=""></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </footer>

    <script src="/rat/js/jquery-2.1.3.min.js"></script>
    <script src="/rat/js/jquery.actual.min.js"></script>
    <script src="/rat/js/jquery.scrollTo.min.js"></script>
    <script src="/rat/js/bootstrap.min.js"></script>
    <script src="/rat/js/main.js"></script>
</body>
</html>