<?php session_start();
	if($_POST['kleur1'])
	{
	    //naam
	    if(isset($_POST['kleur1']))
	    {
	        $kleur1=clean($_POST['kleur1']);   
	    }
	    else
	    {
	        $kleur1="xxxx";
	    }
	    
	    if(isset($_POST['kleur2']))
	    {
	        $kleur2=clean($_POST['kleur2']);   
	    }
	    else
	    {
	        $kleur2="xxxx";
	    }
	    
	    if(isset($_POST['kleur3']))
	    {
	        $kleur3=clean($_POST['kleur3']);   
	    }
	    else
	    {
	        $kleur3="xxxx";
	    }
	    
	    if(isset($_POST['kleur4']))
	    {
	        $kleur4=clean($_POST['kleur4']);   
	    }
	    else
	    {
	        $kleur4="xxxx";
	    }
	    
	    
	    if(isset($_POST['kleur5']))
	    {
	        $kleur5=clean($_POST['kleur5']);   
	    }
	    else
	    {
	        $kleur5="xxxx";
	    }
	    
	    if(isset($_POST['kleur6']))
	    {
	        $kleur6=clean($_POST['kleur6']);   
	    }
	    else
	    {
	        $kleur6="xxxx";
	    }
	    
	    ///
	    if(isset($_POST['omschrijving']))
	    {
	        $omschrijving=clean($_POST['omschrijving']);   
	    }
	    else
	    {
	        $omschrijving="xxxx";
	    }

	   saveWizard($kleur1,$kleur2,$kleur3,$kleur4,$kleur5,$kleur6,$omschrijving);
	   //GA NAAR STAP 2.
	   header("Location: account.php");
       die();
	}
function saveWizard($kleur1,$kleur2,$kleur3,$kleur4,$kleur5,$kleur6,$omschrijving)
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

        $sql = "UPDATE `wizard` SET `kleur1`='".$kleur1."',`kleur2`='".$kleur2."',`kleur3`='".$kleur3."',`kleur4`='".$kleur4."',`kleur5`='".$kleur5."',`kleur6`='".$kleur6."',`logo_desc`='".$omschrijving."' ,`logo`='O' WHERE id=".$_SESSION['wizard'];
        if ($conn->query($sql) === TRUE) {
            
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

function checkEmail($var)
{
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
    $sql = "SELECT email FROM `wizard` WHERE email='".$var."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $result=0;

    } else {
        $result=1;
    }
    $conn->close();
    return $result;
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
                            <li><a href="/wizard/account.php" class="page-scroll">Home</a></li>
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
    <div id="vliegerContent" style=" border-bottom: 1px solid black;background: url('http://webland.be/img/sliders/Slide3.jpg'); background-size: cover;" class="text-center">
        <div style="background: rgba(0,0,0,0.4); padding-top: 4%; padding-bottom: 4%;">
            <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;" class="text-vertical-center" data-stellar-background-ratio="0.5">Uw droom wordt realiteit.</h1>    
        </div>
        
    </div>
    <!-- Welcome
	============================================= -->
    <section id="welcome">
        
        <div class="container">
            
            <div style="padding-top: 8px;"></div>
            <i class="fa fa-paint-brush fa-5x" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i>
            <h2>Stap 5 uw logo</h2>
    <div class="row text-center">
        <div class="col-lg-2 col-md-2 col-sm-2 ">
                <h1><i class="fa fa-star fa-2x" style="color: red;"></i></h1>
                <h2>Rood</h2>
                <h6>Aggressie,</h6><h6>belangrijk,</h6> <h6>passie</h6>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 ">
            <h1><i class="fa fa-star fa-2x" style="color: orange;"></i></h1>
            <h2>Oranje</h2>
            <h6>Energie,</h6><h6>speels,</h6> <h6> betaalbaar</h6>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 ">
            <h1><i class="fa fa-star fa-2x" style="color: yellow;"></i></h1>
            <h2>Geel</h2>
            <h6>Vrolijk,</h6><h6>Geluk,</h6> <h6> Humor</h6>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 ">
            <h1><i class="fa fa-star fa-2x" style="color: green;"></i></h1>
            <h2>Groen</h2>
            <h6>Natuur,</h6> <h6>success,</h6> <h6>Groei</h6>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 ">
            <h1><i class="fa fa-star fa-2x" style="color: darkblue;"></i></h1>
            <h2>Blauw</h2>
            <h6>Relaxatie,</h6> <h6>vertrouwen,</h6> <h6>comfort</h6>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 ">
            <h1><i class="fa fa-star fa-2x" style="color: mediumpurple;"></i></h1>
            <h2>Paars</h2>
            <h6>Luxe,</h6> <h6>misterie,</h6> <h6>romantiek</h6>
        </div>

    </div>
       
    <form method="post">
         <label>Kies je eerste kleur</label>
        <input type="color" value="#ff0000" name="kleur1" required=""/>
        
        <label>Kies je 2de kleur</label>
        <input type="color" value="#ff0000" name="kleur2" required=""/>
        
        <label>Kies je 3de kleur</label>
        <input type="color" value="#ff0000" name="kleur3" required=""/>
        
        <label>Kies je 4de kleur</label>
        <input type="color" value="#ff0000" name="kleur4" required=""/>
        
        <label>Kies je 5de kleur</label>
        <input type="color" value="#ff0000" name="kleur5" required=""/>
        
        <label>Kies je 6de kleur</label>
        <input type="color" value="#ff0000" name="kleur6" required=""/>
        
        <div style="margin-bottom: 1%;"></div>
        <label>Extra info</label>
        <textarea placeholder="Beschrijf hier wat je verwacht, voorbeelden, wat je fijn vindt, wat voor stijl." class="form-control" required="" name="omschrijving"></textarea>
        <input type="submit" class="btn btn-success btn-block" value="VOLGENDE" style="margin-bottom: 1%; margin-top: 1%;">
    </form>    
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