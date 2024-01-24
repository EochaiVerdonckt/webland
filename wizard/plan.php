<?php session_start();
	

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
    $extra="";
    if($_POST['action']=='newOnly')
    {
        $extra=" and status=1";
    }
    $sql = "SELECT * FROM `wizard` WHERE id=".$_SESSION['wizard'];

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
       
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $plan=$row;
        }

    } 
    $conn->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>WEBLAND - Businessplan</title>

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
    
    <div id="vliegerContent" style=" border-bottom: 1px solid black;background: url('http://webland.be/img/sliders/Slide3.jpg'); background-size: cover;" class="text-center">
        <div style="background: rgba(0,0,0,0.4); padding-top: 4%; padding-bottom: 4%;">
            
            <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;" class="text-vertical-center" data-stellar-background-ratio="0.5">Webland Businessplan.</h1>    
        </div>
        
    </div>    


    <!-- Welcome
	============================================= -->
    <section id="welcome">
        <div class="container">
            <div style="padding-top: 8px;"></div>
            <i class="fa fa-bank fa-5x" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #778899 ;"></i>
            <h1 style="color: black;"></h1>
            <h3><?php echo $plan['naam'];?> : <?php echo $plan['slogan'];?></h3>
            <hr class="sep">
            
            <div style="text-align:left;">
                <h3 style="text-align: left; ">Gegevens</h3>
                <p><?php echo $plan['voornaam']." ".$plan['achternaam'];?></p>    
                <p><?php echo $plan['adres']." ".$plan['gemeente'];?></p>    
                <p><?php echo $plan['telefoon']." ";?></p>    
                <p><?php echo $plan['email'];?></p>
                <?php if(isset($plan['btw']))
                {
                   echo "<p>".$plan['btw']."</p>";
                }
                ?>
                <?php if($plan['vzw']=="Y")
                {
                   echo "<p>Dit plan gaat over een vzw of NGO</p>";
                }
                ?>
                <h3 style="text-align: left; ">Korte omschrijving.</h3>
                <p><?php echo $plan['idee'];?></p>
                <h3 style="text-align: left; ">Doelgroep</h3>
                <p><?php echo $plan['klanten'];?></p>
                <h3 style="text-align: left; ">Sector</h3>
                <p><?php echo $plan['sector'];?></p>
                <h3 style="text-align: left; ">Verdienmodel</h3>
                <p><?php echo $plan['profit'];?></p>
                <h3 style="text-align: left; ">Kostenraming</h3>
                <p><?php echo $plan['costs'];?></p>
                <h3 style="text-align: left; ">Concurrentie</h3>
                <p><?php echo $plan['vijand'];?></p>
                <h3 style="text-align: left; ">De markt in beeld</h3>
                <p><?php echo $plan['markt'];?></p>
                <h3 style="text-align: left; ">Netwerk</h3>
                <p><?php echo $plan['netwerk'];?></p>
                <h3 style="text-align: left; ">Motieven</h3>
                <p><?php echo $plan['motieven'];?></p>
                <h3 style="text-align: left; ">Ambitie</h3>
                <p><?php echo $plan['ambitie'];?></p>
                <h3 style="text-align: left; ">Sterktes</h3>
                <p><?php echo $plan['strong'];?></p>
                <h3 style="text-align: left; ">uitdagingen</h3>
                <p><?php echo $plan['challenge'];?></p>
            </div>
            <h3>Mijn 4 P's</h3>
            <div style="text-align:left;">
                <h3 style="text-align: left; ">Producten of diensten</h3>
                <p><?php echo $plan['product'];?></p>
                <h3 style="text-align: left; ">Plaats</h3>
                <p><?php echo $plan['place'];?></p>
                <h3 style="text-align: left; ">Prijzen</h3>
                <p><?php echo $plan['price'];?></p>
                <h3 style="text-align: left; ">Promotie</h3>
                <p><?php echo $plan['promotie'];?></p> 
            </div>
    </section>
    
 
    <!-- Footer
	============================================= -->
    <footer>
        <div class="container">
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