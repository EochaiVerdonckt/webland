<?php session_start();
    if($_POST)
     {
        //naam
	    if(isset($_POST['pass']))
	    {
	        $pass=clean($_POST['pass']);   
	    }
	    
	    //slogan
	    if(isset($_POST['passConform']))
	    {
	        $passConform=clean($_POST['passConform']);   
	    }
	    
	    if($pass==$passConform)
	    {
	        updateWizard($pass);
	        header("Location: stap4.php");
            die();    
	    }
	    $out="Sorry je wachtwoord en wachtwoord bevestiging zijn niet gelijk.";
     }
 
function updateWizard($pass)
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

        $sql = "UPDATE `wizard` SET `pass`='".$pass."' WHERE id=".$_SESSION['wizard'];
       
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
            <h2>Stap 3 uw account</h2>
             <p>Proficiat uw business plan is klaar. Kies nu een wachtwoord zodat u steeds uw plan kan herbekijken. Met een account kan u tegelijk bestellingen plaatsen. Een website bouwen en beheren. Een account is volledig gratis. Kies een wachtwoord dat uniek is, niet één dat u al gebruikt. Dit wachtwoord wordt versleuteld. Zelf onze medewerkers kunnen deze niet achterhalen.</p>
             
            <form method="post" class="wizard">
                <label>Wachtwoord*</label>
                <input id="pass" name="pass" type="password" class="form-control" placeholder="***" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['pass']?>">
                <label>Tip uw wachtwoord nogmaals*</label>
                <input id="passConform" name="passConform" type="password" class="form-control" placeholder="***" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['passConform']?>">
                
                <input type="submit" class="btn btn-success btn-block" value="VOLGENDE" style="margin-bottom: 1%; margin-top: 1%;">
                <span>Je gegevens worden niet doorverkocht en zijn versleuteld.</span>
                <span><?php echo $out;?></span>
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