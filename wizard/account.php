<?php 	session_start();
    
    if(isset($_POST['WebOrder']))
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

        $sql = "UPDATE `wizard` SET `template`='".$_SESSION['temp']."', website='O' WHERE id=".$_SESSION['wizard'];
       
        if ($conn->query($sql) === TRUE) {
            $last = $conn->insert_id;
        } 
        $conn->close();
    }

    if (isset($_SESSION['wizard']))
        {
            
        }

	if($_POST['email'])
	{
	
	    //naam
	    if(isset($_POST['email']))
	    {
	        $email=clean($_POST['email']);   
	    }
	    else
	    {
	        $email="xxxx";
	    }
	    //achternaam
	    if(isset($_POST['password']))
	    {
	         $pass=clean($_POST['password']);   
	    }
	    else
	    {
	        $pass="xxxx";
	    }
	    
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
    
        $sql = "SELECT * FROM `wizard` WHERE email='".$email."' and pass='".$pass."'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['wizard']=$row['id'];
            }
        } 
        else
        {
            $extra="Foutieve gegevens.";
        }
        $conn->close();
}


function toonLogo()
{

    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    echo '<div class="col-lg-1">';
            
         
            
            
    echo '</div>';
    echo '<div class="col-lg-11">';


    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Logo FROM `wizard` WHERE id=".$_SESSION['wizard'];

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $logo= $row['Logo'];
        }
    } 
    $conn->close();
    return $logo;
}


function toonWeb()
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

    $sql = "SELECT website FROM `wizard` WHERE id=".$_SESSION['wizard'];

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $logo= $row['website'];
        }
    } 
    $conn->close();
    return $logo;
}

	
function clean($var)
{
    $var=trim($var);
    $var=strip_tags($var);
    $var=filter_var ($var, FILTER_SANITIZE_STRING);
    $var = strtolower($var);
    return $var;
}

function toonBoard($logo)
{
    $bestelLogo="<a class='btn-block' href='logo.php'>Voltooi</a>";
    $hasLogo="<i class='fa fa-check'></i>";
    $param2="";
    
    $website=toonWeb();
    $bestelwebsite="<a class='btn-block' href='webBuilder.php'>Voltooi</a>";
    $haswebsite="<i class='fa fa-check'></i>";
    
    if($logo=="B")
    {
        $param1=$bestelLogo;
        $param2="Wij weten nog niks over uw logo? Indien er u één heeft, kan u ons deze bezorgen. Indien niet kunnen wij er één maken voor u. U krijgt hier bovendien tijdelijk 75% korting op. Voeg het dus zeker vandaag nog toe aan uw business board.";
    }
    else
    {
        $param1=$hasLogo;
        if($website=="B")
        {
           $param2="Begin vandaag nog met te bouwen aan uw website.";
           $params3=$bestelwebsite;
        }
    }
    
    echo '<i class="fa fa-key fa-5x" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i>
            <h2>Business Booster Board</h2>';
            
    echo    '<div style="font-size: 4em;">';
        echo "<div class='row well'>";
                echo '<div class="col-lg-4 col-md-4">';
            echo ' <i class="fa fa fa-lightbulb-o fa-3x"></i></div>';
         echo '<div class="col-lg-8 col-md-8">';
            echo '<h4 style="margin-top: 25px;">'.$param2.'</h4>';
         echo '</div>';
echo "</div>";
    echo    '</div>';
      
    echo '
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-strategy" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>START</p>
                          <i class="fa fa-check"></i>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-documents" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>GEGEVENS</p>
                       <i class="fa fa-check"></i>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-presentation" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p><a href="plan.php" target="_blank">Business plan</a></p>
                       <i class="fa fa-check"></i>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <img src="http://mobile-express.be/cogitatio/logo.png" style="    margin: 0;"/>
                    <div class="caption">              
                       <p>Delen op <a href="http://mobile-express.be/cogitatio/" target="_blank">Cogitatio</a></p>
                    </div>
                 </div>
            </div>
        </div>';
        
    echo '
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>';        
        
        
     echo '
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-paintbrush" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>LOGO</p>
                       <p>'.$param1.'</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-chat" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Business cards</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-ribbon" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Flyers, Posters, Folders</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
                    <div class="thumbnail">
                    <span class="icon-megaphone" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Marketings campagne</p>
                    </div>
                 </div>
        </div></div>';    
        
        
        echo '
        
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
                            <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
            </div>
            <div class="col-lg-2 col-md-2">
            </div>
            
            <div class="col-lg-1 col-md-1">
                
            </div>
            
            <div class="col-lg-2 col-md-2">
                <p><i class="fa fa-arrow-up" style=""></i></p>
                <p><i class="fa fa-arrow-down" style=""></i></p>
            </div>
        </div>
        
        ';
        
         echo '
        <div class="row">
        
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-browser" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>WEBSITE</p>
                       <p>'.$params3.'</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-tools" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>backoffice & tools</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
    
            
            <div class="col-lg-2 col-md-2">
            <div class="thumbnail">
                    <span class="icon-gift" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Refearls, krijg korting</p>
                    </div>
                 </div>
            </div>
            
            <div class="col-lg-1 col-md-1">
                <i class="fa fa-arrow-right" style="margin-top:60%;"></i>
            </div>
            
            <div class="col-lg-2 col-md-2">
                    <div class="thumbnail">
                    <span class="icon-trophy" style="font-size: 3em;"></span>
                    <div class="caption">              
                       <p>Evaluatie & feedback</p>
                    </div>
                 </div>
        </div>';   
        
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
        
    <div id="vliegerContent" style=" border-bottom: 1px solid black;background: url('http://webland.be/img/sliders/Slide3.jpg'); background-size: cover;" class="text-center">
        <div style="background: rgba(0,0,0,0.4); padding-top: 4%; padding-bottom: 4%;">
            <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;" class="text-vertical-center" data-stellar-background-ratio="0.5">Uw droom wordt binnenkort realiteit.</h1>    
        </div>
        
    </div> 
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
            <?php 
           if (isset($_SESSION['wizard']))
           {
               $logo=toonLogo();
                toonBoard($logo);
           }
           else
           {
            echo '
             <i class="fa fa-key fa-5x" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i>
            <h2>Login pagina Webland wizard</h2>
            <form method="post" class="wizard">
                <label>Email*</label>
                <input id="username" name="email" type="email" class="form-control" placeholder="example@server.com" style="margin-bottom: 1%;" required="" value="'.$_POST['email'].'">
                <label>Wachtwoord*</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="***" style="margin-bottom: 1%;" required="" value="'.$_POST['password'].'">
                   <span>'.$extra.'</span>
                <input type="submit" class="btn btn-success btn-block" value="VOLGENDE" style="margin-bottom: 1%; margin-top: 1%;">
                <span>Je gegevens worden niet doorverkocht en zijn versleuteld.</span>
                <a href="stap1.php">Nog geen account?</a>
            </form>';
           }
             ?>

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