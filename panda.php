<?php session_start();
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
$ctrl=new IndexController();
$seo=$ctrl->getSeo();
$cats = $ctrl->getCatogs();
$blogs= $ctrl->getBlogs();
$services= $ctrl->getServicesPublished();


function getKrijt(){

    $rij = array();
$ctrl=new IndexController();
$conn = $ctrl->getConnection();

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

function getSterk(){

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
    
    echo '
       <div class="row">
          <div class="col-md-9">
            <div class="quote">
              <b><img src="ophiuchus/assets/img/quote_sign_left.png" alt=""></b>   '.$review['info'].' <small><img src="ophiuchus//assets/img/quote_sign_right.png" alt=""></small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="profile">
              <div class="pic"><img src="ophiuchus/assets/img/client-2.jpg" alt=""></div>
              <h4>'.$review['naam'].'</h4>
              <span>'.printStars($review['rating']).'</span>
            </div>
          </div>
        </div>
    
    ';
  
}
function getSlides($ctrl){
   return $ctrl->selectStatement('slides');
}
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



$slides = getSlides($ctrl);
?>




<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Panda - Bij ons betaalt u niet teveel. </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="<?php echo $seo['1']['waarde']?>" name="description">

    <!-- Favicon -->
    <link href="/panda/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/panda/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/panda/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/panda/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/panda/css/style.css" rel="stylesheet">
     <style>
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


.small-title
{
    color: white;
    font-size: 50px;
    font-family: "Josefin Sans", sans-serif;
    padding: 8px;
    background: rgba(0,0,0,0.7);
}

.smaller-title
{
    color: white;
    font-size: 35px;
    font-family: "Josefin Sans", sans-serif;
    padding: 8px;
    background: rgba(0,0,0,0.7);
}

.navbar {
    border-radius: 0;
    margin-bottom: 0;
    background: white;
    padding: 15px 0;
    padding-bottom: 0;
    color: black;
    border-bottom:1px solid black;
}

.more-area h2 {
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: 400;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 25px;
    padding-top: 8px;
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

.item{
    background: rgba(0,0,0,0.5);
    padding:25px;
}

.double-border{ 	
background-color: black;
    border: 2px solid black;
    padding: 0.5em;
    position: relative;
    margin: 0 auto;
}

.snow-flake {
    width: 100%;
    padding-bottom: 60%;
}


    </style>
    
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row g-0 d-none d-lg-flex">
            <div class="col-lg-6 ps-5 text-start">
                <div class="h-100 d-inline-flex align-items-center text-white">
                    <span>Follow Us:</span>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                <div class="h-100 topbar-right d-inline-flex align-items-center text-white py-2 px-5">
                    <span class="fs-5 fw-bold me-2"><i class="fa fa-phone-alt me-2"></i></span>
                    <span class="fs-5 fw-bold">0485/86.59.70</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
        <a href="index.html" class="navbar-brand ps-5 me-0">
            <h1 class="text-white m-0">Webland.be</h1>
        </a>
        <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="project.html" class="dropdown-item">Projects</a>
                        <a href="feature.html" class="dropdown-item">Features</a>
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary px-3 d-none d-lg-block">Get A Quote</a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="/slides/<?php echo $slides[0]['foto']?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 text-start">
                                    <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Digitale tools</p>
                                    <h1 class="display-1 text-white mb-5 animated slideInRight"><?php echo  $slide1['titel']; ?></h1>
                                    <a href="tel:0485865970" class="btn btn-primary py-3 px-5 animated slideInRight">0485/86.59.70</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="/slides/<?php echo $slides[1]['foto']?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 text-start">
                                    <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Digitale tools</p>
                                    <h1 class="display-1 text-white mb-5 animated slideInRight">The <?php echo  $slide2['titel']; ?></h1>
                                    <a href="tel:0485865970" class="btn btn-primary py-3 px-5 animated slideInRight">0485/86.59.70</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row gx-3 h-100">
                        <div class="col-6 align-self-start wow fadeInUp" data-wow-delay="0.1s">
                            <img class="img-fluid" src="/panda/img/about.png">
                        </div>
                        <div class="col-6 align-self-end wow fadeInDown" data-wow-delay="0.1s">
                            <img class="img-fluid" src="/panda/img/about-2.png">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="fw-medium text-uppercase text-primary mb-2">About Us</p>
                    <h1 class="display-5 mb-4">Over ons</h1>
                   <?php echo $seo['1']['waarde']?>
                    <?php echo  getPromo(); ?> 
                     <?php $services= getSterk();?>
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 bg-primary p-4">
                            <h1 class="display-2">25</h1>
                            <h5 class="text-white">Oplossingen op maat</h5>
                            <h5 class="text-white">Van uw bedrijf</h5>
                        </div>
                        <div class="ms-4">
                            <p><i class="fa fa-check text-primary me-2"></i><?php echo $services[1]['naam'] ?></p>
                            <p><i class="fa fa-check text-primary me-2"></i><?php echo $services[2]['naam'] ?></p>
                            <p><i class="fa fa-check text-primary me-2"></i><?php echo $services[3]['naam'] ?></p>
                        
                          
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-envelope-open text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-2">Email</p>
                                    <h5 class="mb-0">info@webland.be</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-phone-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-2">Gsm</p>
                                    <h5 class="mb-0">+32485/865.970</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-fluid facts my-5 p-5">
        <div class="row g-5">
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="text-center border p-5">
                    <i class="fa fa-certificate fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">25</h1>
                    <span class="fs-5 fw-semi-bold text-white">Oplossing voor uw bedrijf</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="text-center border p-5">
                    <i class="fa fa-users-cog fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">10</h1>
                    <span class="fs-5 fw-semi-bold text-white">Makkelijk aanpasbaar</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="text-center border p-5">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">425</h1>
                    <span class="fs-5 fw-semi-bold text-white">Online Bestellingen elke dag</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.7s">
                <div class="text-center border p-5">
                    <i class="fa fa-check-double fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">100</h1>
                    <span class="fs-5 fw-semi-bold text-white">Projects Done</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative me-lg-4">
                        <img class="img-fluid w-100" src="/panda/img/feature.png" alt="">
                        <span
                            class="position-absolute top-50 start-100 translate-middle bg-white rounded-circle d-none d-lg-block"
                            style="width: 120px; height: 120px;"></span>
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <p class="fw-medium text-uppercase text-primary mb-2">Waarom u absoluut voor ons!</p>
                    <h1 class="display-5 mb-4">ontvangt u dagelijks meteen alle opbrengsten van uw website meteen op uw rekening.</h1>
                    <p class="mb-4">Wij, bieden u de keuze uit een 15-tal ontwerpen. Hierdoor bespaart u niet alleen enorm veel geld en tijd. Maar bent u zeker dat al uw pagina's meteen op elk apparaat prachtig en professioneel zijn.
                    </p>
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <div class="ms-4">
                                    <h4><?php echo $services[0]['naam'] ?></h4>
                                    <span><?php echo $services[0]['omschrijving'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <div class="ms-4">
                                    <h4><?php echo $services[1]['naam'] ?></h4>
                                    <span><?php echo $services[1]['omschrijving'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                    <i class="fa fa-check text-white"></i>
                                </div>
                                <div class="ms-4">
                                    <h4><?php echo $services[2]['naam'] ?></h4>
                                    <span><?php echo $services[2]['omschrijving'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Video Modal Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="fw-medium text-uppercase text-primary mb-2">Digitale tools</p>
                <h1 class="display-5 mb-4">Uw bedrijf in uw broekzak</h1>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item">
                        <img class="img-fluid" src="/categ/27.jpg" alt="">
                        <div class="service-img">
                            <img class="img-fluid" src="/categ/27.jpg" alt="">
                        </div>
                        <div class="service-detail">
                            <div class="service-title">
                                <hr class="w-25">
                                <h3 class="mb-0">Technologie</h3>
                                <hr class="w-25">
                            </div>
                            <div class="service-text">
                                <p class="text-white mb-0">De meest recente technologie steeds binnen handbereik.</p>
                            </div>
                        </div>
                        <a class="btn btn-light" href="https://webland.be/shop/index.php?cat=26">ontdeke</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item">
                        <img class="img-fluid" src="/panda/img/service-2.jpg" alt="">
                        <div class="service-img">
                            <img class="img-fluid" src="/categ/26.jpg" alt="">
                        </div>
                        <div class="service-detail">
                            <div class="service-title">
                                <hr class="w-25">
                                <h3 class="mb-0">ERP</h3>
                                <hr class="w-25">
                            </div>
                            <div class="service-text">
                                <p class="text-white mb-0">Een diverse waaier tools die uw bussiness tools.</p>
                            </div>
                        </div>
                        <a class="btn btn-light" href="https://webland.be/shop/index.php?cat=26">Ontdek</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item">
                        <img class="img-fluid" src="/panda/img/service-3.jpg" alt="">
                        <div class="service-img">
                            <img class="img-fluid" src="/panda/img/service-3.jpg" alt="">
                        </div>
                        <div class="service-detail">
                            <div class="service-title">
                                <hr class="w-25">
                                <h3 class="mb-0">CMS</h3>
                                <hr class="w-25">
                            </div>
                            <div class="service-text">
                                <p class="text-white mb-0">Een website bouwen of beheren was nog nooit zo eenvoudig</p>
                            </div>
                        </div>
                        <a class="btn btn-light" href="https://webland.be/shop/index.php?cat=26">Ontdek</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Project Start -->
    <div class="container-fluid bg-dark pt-5 my-5 px-0">
        <div class="text-center mx-auto mt-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">ONTWERPEN</p>
            <h1 class="display-5 text-white mb-5">Bespaart enorm veel geld en tijd.</h1>
        </div>
        <div class="owl-carousel project-carousel wow fadeIn" data-wow-delay="0.1s">
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-1.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Virgo</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-2.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Sagittarius</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-3.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Aquarius</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-4.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Pices</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-5.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Libra</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-6.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Capricorn</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-7.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Scorpio</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-8.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Ariers</h5>
                </div>
            </a>
             <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-9.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Cancer</h5>
                </div>
            </a>
             <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-10.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">lion</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-11.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Taurus</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-12.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Gemini</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82223.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Ophiuchus</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/rabbit.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Rabbit</h5>
                </div>
            </a>
             <a class="project-item" href="">
                <img class="img-fluid" src="/rooster.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">Rooster</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/oxx.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">OXX</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82227.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">RAT</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82228.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">HORSE</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82229.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">PANDA</h5>
                </div>
            </a>
            <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82230.png" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">TIGER</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82231.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">BOAR</h5>
                </div>
            </a>
              <a class="project-item" href="">
                <img class="img-fluid" src="/services/service-82232.jpg" alt="">
                <div class="project-title">
                    <h5 class="text-primary mb-0">DOG</h5>
                </div>
            </a>
        </div>
    </div>
    <!-- Project End  -->


    <!-- Team Start 
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="fw-medium text-uppercase text-primary mb-2">Our Team</p>
                <h1 class="display-5 mb-5">Dedicated Team Members</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <img class="img-fluid" src="/panda/img/team-1.jpg" alt="">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                                <i class="fa fa-2x fa-share text-white"></i>
                            </div>
                            <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                                style="height: 90px;">
                                <h5>Rob Miller</h5>
                                <span class="text-primary">CEO & Founder</span>
                                <div class="team-social">
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <img class="img-fluid" src="/panda/img/team-2.jpg" alt="">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                                <i class="fa fa-2x fa-share text-white"></i>
                            </div>
                            <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                                style="height: 90px;">
                                <h5>Adam Crew</h5>
                                <span class="text-primary">Project Manager</span>
                                <div class="team-social">
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <img class="img-fluid" src="/panda/img/team-3.jpg" alt="">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                                <i class="fa fa-2x fa-share text-white"></i>
                            </div>
                            <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                                style="height: 90px;">
                                <h5>Peter Farel</h5>
                                <span class="text-primary">Engineer</span>
                                <div class="team-social">
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-dark rounded-circle mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start 
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="fw-medium text-uppercase text-primary mb-2">Testimonial</p>
                <h1 class="display-5 mb-5">What Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                    <div class="testimonial-img position-relative">
                        <img class="img-fluid rounded-circle mx-auto mb-5" src="/panda/img/testimonial-1.jpg">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                            ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                            clita.</p>
                        <h5 class="mb-1">Client Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-img position-relative">
                        <img class="img-fluid rounded-circle mx-auto mb-5" src="/panda/img/testimonial-2.jpg">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                            ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                            clita.</p>
                        <h5 class="mb-1">Client Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-img position-relative">
                        <img class="img-fluid rounded-circle mx-auto mb-5" src="/panda/img/testimonial-3.jpg">
                        <div class="btn-square bg-primary rounded-circle">
                            <i class="fa fa-quote-left text-white"></i>
                        </div>
                    </div>
                    <div class="testimonial-text text-center rounded p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                            ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                            clita.</p>
                        <h5 class="mb-1">Client Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Onze Gegevens</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Waversebaan 57, 3001 Leuven</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0485865970</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@webland.be</p>
                    <div class="d-flex pt-3">
                        
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="https://www.facebook.com/webland.belgie/"><i
                                class="fab fa-facebook-f"></i></a>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                   <!-- <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>-->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!--<h5 class="text-white mb-4">Business Hours</h5>
                    <p class="mb-1">Monday - Friday</p>
                    <h6 class="text-light">09:00 am - 07:00 pm</h6>
                    <p class="mb-1">Saturday</p>
                    <h6 class="text-light">09:00 am - 12:00 pm</h6>
                    <p class="mb-1">Sunday</p>
                    <h6 class="text-light">Closed</h6>-->
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Nieuws</h5>
                    <?php echo  getKrijt(); ?> 
                   <!-- <div class="position-relative w-100">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container text-center">
            <p class="mb-2">Copyright &copy; <a class="fw-semi-bold" href="https://Webland.be">Webland.be</a>, All Right Reserved.
            </p>
       
            <p class="mb-0">Designed By <a class="fw-semi-bold" href="https://webland.be">WEBLAND</a> Distributed
                </p>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/panda/lib/wow/wow.min.js"></script>
    <script src="/panda/lib/easing/easing.min.js"></script>
    <script src="/panda/lib/waypoints/waypoints.min.js"></script>
    <script src="/panda/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/panda/lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="/panda/js/main.js"></script>
</body>

</html>