<?php session_start();
    if($_POST)
     {
        //naam
	    if(isset($_POST['naam']))
	    {
	        $naam=clean($_POST['naam']);   
	    }
	    
	    //slogan
	    if(isset($_POST['slogan']))
	    {
	        $slogan=clean($_POST['slogan']);   
	    }
	    
	    //sector
	    if(isset($_POST['sector']))
	    {
	        $sector=clean($_POST['sector']);   
	    }
	    
	    //idee
	    if(isset($_POST['idee']))
	    {
	        $idee=clean($_POST['idee']);   
	    }
	    
	    //klanten
	    if(isset($_POST['klanten']))
	    {
	        $klanten=clean($_POST['klanten']);   
	    }
	    
	    //profit
	    if(isset($_POST['profit']))
	    {
	        $profit=clean($_POST['profit']);   
	    }
	    
	    //costs
	    if(isset($_POST['costs']))
	    {
	        $costs=clean($_POST['costs']);   
	    }
	    
	    //vijand
	    if(isset($_POST['vijand']))
	    {
	        $vijand=clean($_POST['vijand']);   
	    }
	    
	    //strong
	    if(isset($_POST['strong']))
	    {
	        $strong=clean($_POST['strong']);   
	    }
	    
	    //challenge
	    if(isset($_POST['challenge']))
	    {
	        $challenge=clean($_POST['challenge']);   
	    }
	    
	    //status
	    if(isset($_POST['status']))
	    {
	        $status=clean($_POST['status']);   
	    }
	    
	    //netwerk
	    if(isset($_POST['netwerk']))
	    {
	        $netwerk=clean($_POST['netwerk']);   
	    }
	    
	    //motieven
	    if(isset($_POST['motieven']))
	    {
	        $motieven=clean($_POST['motieven']);   
	    }
	    
	    //ambitie
	    if(isset($_POST['ambitie']))
	    {
	        $ambitie=clean($_POST['ambitie']);   
	    }
	    
	    //markt
	    if(isset($_POST['markt']))
	    {
	        $markt=clean($_POST['markt']);   
	    }
	    
	    //product
	    if(isset($_POST['product']))
	    {
	        $product=clean($_POST['product']);   
	    }
	    
	     //place
	    if(isset($_POST['place']))
	    {
	        $place=clean($_POST['place']);   
	    }
	    
	    //price
	    if(isset($_POST['price']))
	    {
	        $price=clean($_POST['price']);   
	    }
	    
	    //promotie
	    if(isset($_POST['promotie']))
	    {
	        $promotie=clean($_POST['promotie']);   
	    }
	    updateWizard($promotie,$price,$place,$product,$markt,$ambitie,$motieven,$netwerk,$status,$challenge,$vijand,$strong,$costs,$profit,$klanten,$idee,$sector,$slogan,$naam);
	    header("Location: stap3.php");
        die();
     }
 
function updateWizard($promotie,$price,$place,$product,$markt,$ambitie,$motieven,$netwerk,$status,$challenge,$vijand,$strong,$costs,$profit,$klanten,$idee,$sector,$slogan,$naam)
{
    //DB STUFF
	    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
        $usernameDb = $xml->usernameDb;
        $passwordDb = $xml->passwordDb;
        $hostname = $xml->hostname;
        $dbname = $xml->dbname;

        // Create connection
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE `wizard` SET `naam`='".$naam."',`slogan`='".$slogan."',`sector`='".$sector."',`idee`='".$idee."',`klanten`='".$klanten."',`profit`='".$profit."',`costs`='".$costs."',`vijand`='".$vijand."',`strong`='".$strong."',`challenge`='".$challenge."',`status`='".$status."',`netwerk`='".$netwerk."',`motieven`='".$motieven."',`ambitie`='".$ambitie."',`markt`='".$markt."',`product`='".$product."',`place`='".$place."',`price`='".$place."',`promotie`='".$promotie."' WHERE id=".$_SESSION['wizard'];
       
        if ($conn->query($sql) === TRUE) {
            $last = $conn->insert_id;
        } 
        $conn->close();
}     
function clean($var)
{
    $var=trim($var);
    $var=strip_tags($var);
    $var=filter_var ($var, FILTER_SANITIZE_STRING);
    $var = strtolower($var);
    return $var;
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
    <!-- Preloader
	============================================= -->
    <div class="preloader"><i class="fa fa-circle-o-notch fa-spin fa-2x"></i></div>
    <!-- Header
	============================================= -->
    <section class="main-header">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#"><img src="img/logo/logo.png" class="img-responsive" alt="logo"></a>-->
                </div>
                <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
                    <div class="col-md-8 col-xs-12 nav-wrap">
                        <ul class="nav navbar-nav">
                            <li><a href="/" class="page-scroll">Home</a></li>
                        </ul>
                    </div>
                    <div class="social-media hidden-sm hidden-xs">
			
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <!-- Welcome
	============================================= -->
    <section id="welcome">
        <div class="container">
            <div style="padding-top: 8px;"></div>
            <i class="fa fa-key fa-5x" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i>
            <h2>Uw account is geactiveerd.</h2>

        
            <div style="margin-top: 25px;">
                <a class="btn btn-success btn-block" href="account.php">Naar het business board</a>
            </div>
            
            <div style="margin-top: 25px;">
                <label style="    text-align: left;
    width: 100%;">Je kan je business plan hier bekijken.</label>    
                <a class="btn btn-success btn-block" href="plan.php" target="_blank">Toon business plan.</a>
            </div>
            <!--
            <div style="margin-top: 25px;">
                 <label style="    text-align: left;
    width: 100%;">Uw account kan je bereiken door op het slotje te tikken op de home pagina.</label>
                <a class="btn btn-success btn-block" href="account.php">Naar mijn account.</a>
            </div>
            <div style="margin-top: 25px;">
                <label style="    text-align: left;
    width: 100%;"v>Ga gerust naar de volgende stap.</label>
             <a class="btn btn-success btn-block" href="stap5.php">Naar de Webland Website Builder.</a>
            </div>
            -->
        </div>
    </section>
    
 
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