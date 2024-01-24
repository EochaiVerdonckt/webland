<?php session_start();
$path = getcwd();
$path = $path.'/';

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/blogController.php");
$ctrl=new indexController();
function getSideButtons(){
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
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
function getServices(){
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
    $rij = array();

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
function print_artikels(){
$ctrl=new indexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where publish=1";
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
function getPromo(){
   $ctrl=new indexController();
    $conn = $ctrl->getConnection();
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
function print_blogs(){
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
      $sql = "SELECT * FROM news where publish=1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-md-6">';
            echo '<div class="thumbnail">
                    <img src="/blog/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption"> 
                      <h1 style="text-decoration: underline;">'.$row['titel'].'</h1>
                       '.$row['inleiding'].'
                       <a href="detail.php?id='.$row['id'].'" class="btn btn-default btn-block">LEES MEER</a>
                    </div>
                 </div></div>';
        }
    } else {
        echo "<h1>We hebben momenteel geen nieuws</h1>";
    }
    mysqli_close($conn);
}
$slide_buttons=getSideButtons();
?>

<!DOCTYPE html>
<html lang="nl">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>WEBLAND | Ons laatste weetjes en nieuws.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Uw online project in 7 dagen | Nieuws en weetjes.">
    <meta name="keywords" content="">
    <meta name="author" content="Eoghain Verdonckt">

    <!-- Bootstrap Css -->
   
     <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Cinzel+Decorative|Megrim" rel="stylesheet">

    
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

.snow-flake
{
    padding-bottom: 150px;
}

@media only screen and (max-width: 500px) {
  .blackboard {
   width: 640px;
    max-width: 100%;
  }
}

    </style>
</head>

<body style="background-color: white;">
    <?php $ctrl->print_nav();?>
<section id="logo-section" style="padding-bottom: 25px;padding-top:100px;">
   
    <div class="container-fluid">
        <div class="row">
            <?php print_blogs(); ?>      
        </div>
    </div>
      

</section>

    <section style="background: url('/img/bannerBlog.jpg');background-size:cover;padding-top:50px;padding-bottom:25px;">
   <div class="container-fluid">
        <div class="row" style="background: rgba(0,0,0,0.5);padding-top:25px;padding-bottom:25px;">
            <div class="text-center">
                 <h2 style="color:white;">Op zoek naar een blog?</h2>
            <p style="color:white;">Met Webland kan u meteen van start met uw eigen blog. Zonder programmeerwerk. Nieuws delen was nog nooit zo eenvoudig.</p>
                <a href="tel:0485865970" style="color:white; border:1px solid white;padding:8px;">BEL NU</a>
            </div>
        </div>
    </div>   
</section>   
    <!-- Footer
	============================================= -->
    <footer>
        <div class="container-fluid">
            <div class="row" style="padding:0;margin:0; background-color:white;">
                <h5 style="margin-bottom: 0; padding-top:2%; padding-bottom:2%;    width: 100%;" class="text-center font-2">  © 2019 Comet Web OS - Libra edition All rights reserved by <a href="http://webland.be">webland</a> <a href="/GDPR.pdf"  style="color: black" class="nav-link"> GDPR</a> <a href="/portaal/"  style="color: black" class="nav-link"> <i class="fa fa-lock "></i></a> </h5>
            </div>

        </div>
     
      
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <!-- JS PLUGINS -->
    <script src="plugins/owl-carousel/owl.carousel.min.js"></script>
    <script>
    $("#toolBox").css({'margin-top':'8px'});
    $("#newsBox").css({'margin-top':'14px'});
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3598185186227907"
     crossorigin="anonymous"></script>
</body>

</html>