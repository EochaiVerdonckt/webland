<?php

if(!is_numeric($_GET['id']))
{
    echo 'GO AWAY';
    die();
}



function checkArrowLeft()
{

//

    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT MIN(id)  as antw from artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['antw']);
            $id= trim($row['antw']);
            
        }
    }
    mysqli_close($conn);
    
    
    if($id==$_GET['id'])
    {
        return false; 
    }
    return true;
}
    





function checkArrowRight()
{

//

    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT MAX(id)  as antw from artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['antw']);
            $id= trim($row['antw']);
            
        }
    }
    mysqli_close($conn);
    
    
    if($id==$_GET['id'])
    {
        return false; 
    }
    return true;
}
    

function getHigher()
{
    
     $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT  id  from artikel_balance where state=1 and id>".$_GET['id'].' ORDER BY id';
    
 
 
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if(is_null($resultaat))
            {
                $resultaat= $row['id'];
            }
        }
    }
    mysqli_close($conn);
    return $resultaat;
}


function getLower()
{
    
     $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT  id  from artikel_balance where state=1 and id<".$_GET['id'].' ORDER BY id DESC';
    
 
 
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if(is_null($resultaat))
            {
                $resultaat= $row['id'];
            }
        }
    }
    mysqli_close($conn);
    return $resultaat;
}

function print_pic()
{

    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            
            echo '	<div>';
            echo '<img src="/picV2/'.$row['foto'].'"  style="width:100%;"/>';
              echo '<div class="text-center"><h3>'.$row['info'].'</h3></div> ';
            echo '</div>';
          

        }
    }
    mysqli_close($conn);
}


function print_navi()
{

    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            
            echo '	<div>';
            echo '<img src="/picV2/'.$row['foto'].'"  style="width:100%;"/>';
            echo '</div> ';
        }
    }
    mysqli_close($conn);
}

function getCompanyData()
{
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $rij = array();
    $sql = "SELECT * FROM `Gegevens`";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item, $row);
        }

    } 

    $conn->close();
    return $item;
}


function print_nav()
   {
       echo '    <!-- Begin Navbar -->
                <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="    margin-bottom: 0;
    background-color: '.$this->getColor().';
    border: 0;
    border-radius: 0;padding-bottom: 35px;"> <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->
 <a class="navbar-brand" href="#">  <img src="/logo.png" style="width: 20%;padding-bottom:8px;" id="logo"/></a>
                  <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="toggleClick();">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                     
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                             <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/index.php">Home</a></li> 
                               <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/sterktes.php">Kundalini Yoga</a></li>
                                  <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'"  class="page-scroll"  href="/member.php">Lesgevers</a></li>
                                    <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/events.php">Events</a></li>
                                    <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/fotopagina/">Fotopagina</a></li>
                                                           <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/shop/">Webshop</a></li>
                                                                        <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/subs.php">Inschrijven</a></li>
                            <li style="padding-left: 0;"><a  style="'.$this->getTekstColor().'" class="page-scroll"  href="/index.php#contact-section-2">Contact</a></li>
               
                           
                              
                           <!-- <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/blog.php">Blog</a></li> -->
                            
                       
 
                         <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="https://www.facebook.com/start2yoga"><i class="fa fa-facebook"></i></a></li>
                             <!-- <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/GDPR.pdf">GDPR</a></li> -->
                              <li style="padding-left: 0;"><a style="'.$this->getTekstColor().'" class="page-scroll"  href="/tegels"><i class="fa fa-lock "></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container -->
                </nav>
                <!-- End Navbar --> ';
       
   }
$company_data=getCompanyData();


?>
<!DOCTYPE html>
<html>
<head>
  <title>Slick Playground</title>
  <meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
<!-- s-->
  <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 50%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
  </style>
</head>
<body>
<nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="    margin-bottom: 0;
    background-color: #ffffff;
    border: 0;
    border-radius: 0;padding-bottom: 35px;"> <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->
 <a class="navbar-brand" href="#">  <img src="/logo.png" style="width: 20%;padding-bottom:8px;" id="logo"></a>
                  <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="toggleClick();">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                     
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                             <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/index.php">Home</a></li> 
                               <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/sterktes.php">Kundalini Yoga</a></li>
                                  <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/member.php">Lesgevers</a></li>
                                    <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/events.php">Events</a></li>
                                    <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/fotopagina/">Fotopagina</a></li>
                                                           <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/shop/">Webshop</a></li>
                                                                        <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/subs.php">Inschrijven</a></li>
                            <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/index.php#contact-section-2">Contact</a></li>
               
                           
                              
                           <!-- <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll"  href="/blog.php">Blog</a></li> -->
                            
                       
 
                         <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="https://www.facebook.com/start2yoga"><i class="fa fa-facebook"></i></a></li>
                             <!-- <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll"  href="/GDPR.pdf">GDPR</a></li> -->
                              <li style="padding-left: 0;"><a style="color: #000000" class="page-scroll" href="/tegels"><i class="fa fa-lock "></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container -->
                </nav>
  <div id="page">
     
	<div class="row">
		<div class="column small-11 small-centered">
			<div class="slider slider-single">
			    <?php print_pic(); ?>
			</div>
			<div class="slider slider-nav">
			    <?php print_navi(); ?>
			</div>
		</div>
	</div>
</div>



  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script type="text/javascript">
$('.slider-single').slick({
 	slidesToShow: 1,
 	slidesToScroll: 1,
 	arrows: true,
 	fade: false,
 	adaptiveHeight: true,
 	infinite: false,
	useTransform: true,
 	speed: 400,
 	cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
 });

 $('.slider-nav')
 	.on('init', function(event, slick) {
 		$('.slider-nav .slick-slide.slick-current').addClass('is-active');
 	})
 	.slick({
 		slidesToShow: 7,
 		slidesToScroll: 7,
 		dots: false,
 		focusOnSelect: false,
 		infinite: false,
 		responsive: [{
 			breakpoint: 1024,
 			settings: {
 				slidesToShow: 5,
 				slidesToScroll: 5,
 			}
 		}, {
 			breakpoint: 640,
 			settings: {
 				slidesToShow: 4,
 				slidesToScroll: 4,
			}
 		}, {
 			breakpoint: 420,
 			settings: {
 				slidesToShow: 3,
 				slidesToScroll: 3,
		}
 		}]
 	});

 $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
 	$('.slider-nav').slick('slickGoTo', currentSlide);
 	var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
 	$('.slider-nav .slick-slide.is-active').removeClass('is-active');
 	$(currrentNavSlideElem).addClass('is-active');
 });

 $('.slider-nav').on('click', '.slick-slide', function(event) {
 	event.preventDefault();
 	var goToSingleSlide = $(this).data('slick-index');

 	$('.slider-single').slick('slickGoTo', goToSingleSlide);
 });
</script>

</body>
</html>


