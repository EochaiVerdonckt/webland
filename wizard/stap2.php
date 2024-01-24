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
	    
	    //Maandag
	    if(isset($_POST['Maandag']))
	    {
	        $Maandag=clean($_POST['Maandag']);   
	    }
	    
	    //$Dinsdag
	    if(isset($_POST['Dinsdag']))
	    {
	        $Dinsdag=clean($_POST['Dinsdag']);   
	    }
	    
	    //Woensdag
	    if(isset($_POST['Woensdag']))
	    {
	        $Woensdag=clean($_POST['Woensdag']);   
	    }
	    
	    //Donderdag
	    if(isset($_POST['Donderdag']))
	    {
	        $Donderdag=clean($_POST['Donderdag']);   
	    }
	    //Vrijdag
	    if(isset($_POST['Vrijdag']))
	    {
	        $Vrijdag=clean($_POST['Vrijdag']);   
	    }
	    
	    //Zaterdag
	    if(isset($_POST['Zaterdag']))
	    {
	        $Zaterdag=clean($_POST['Zaterdag']);   
	    }
	    
	    //Zondag
	    if(isset($_POST['Zondag']))
	    {
	        $Zondag=clean($_POST['Zondag']);   
	    }
	    
	    updateWizard($promotie,$price,$place,$product,$markt,$ambitie,$motieven,$netwerk,$status,$challenge,$vijand,$strong,$costs,$profit,$klanten,$idee,$sector,$slogan,$naam,$Maandag,$Dinsdag,$Woensdag,$Donderdag,$Vrijdag,$Zaterdag,$Zondag);
	    header("Location: stap3.php");
        die();
     }
 
function updateWizard($promotie,$price,$place,$product,$markt,$ambitie,$motieven,$netwerk,$status,$challenge,$vijand,$strong,$costs,$profit,$klanten,$idee,$sector,$slogan,$naam,$Maandag,$Dinsdag,$Woensdag,$Donderdag,$Vrijdag,$Zaterdag,$Zondag)
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

        $sql = "UPDATE `wizard` SET `naam`='".$naam."',`slogan`='".$slogan."',`sector`='".$sector."',`idee`='".$idee."',`klanten`='".$klanten."',`profit`='".$profit."',`costs`='".$costs."',`vijand`='".$vijand."',`strong`='".$strong."',`challenge`='".$challenge."',`status`='".$status."',`netwerk`='".$netwerk."',`motieven`='".$motieven."',`ambitie`='".$ambitie."',`markt`='".$markt."',`product`='".$product."',`place`='".$place."',`price`='".$place."',`promotie`='".$promotie."',`maandag`='".$Maandag."',`dinsdag`='".$Dinsdag."',`woensdag`='".$Woensdag."',`donderdag`='".$Donderdag."',`vrijdag`='".$Vrijdag."',`zaterdag`='".$Zaterdag."',`zondag`='".$Zondag."' WHERE id=".$_SESSION['wizard'];
 
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
            <i class="fa fa-line-chart fa-5x" style="text-shadow: -3px 0 black, 0 3px black, 1px 0 black, 0 -3px black; color: #FEC;"></i>
            <h2>Stap 2 uw business plan</h2>
             <p>Deze tool is volledig vrijblijvend. Uw gegevens worden niet doorverkocht. Door uw gegevens in te vullen, kan uw werk worden opgeslagen. Zodat u later kan verder werken. Wij houden geen geslacht bij, aangezien dit seksistisch is. Uw geslacht wordt opgeslagen als Apache helikopter. Velden met een ster zijn verplicht. Door op verzenden te klikken geeft u Webland de toestemming, de gegevens die u invult, en enkel de gegevens die u invult op te slaan in een databank. Voor een termijn van maximum 180 dagen. Indien u klant wordt bij Webland kan deze termijn verlengd worden. Tevens begrijpt u dat de wiard een cookie aanmaakt, met een minimale info in, om te kunnen werken. En geeft u aan dat u hiermee akkoord bent.</p>
            <form method="post" class="wizard">
                <label>Geef uw project een naam*</label>
                <input id="naam" name="naam" type="text" class="form-control" placeholder="Webland" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['naam']?>">
                <label>Slogan*</label>
                <input id="slogan" name="slogan" type="text" class="form-control" placeholder="Een antwoord op mijn project is" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['slogan']?>">
                <label>Sector</label>
                <br>
                <div style="text-align:left;    margin-top: 5px;margin-bottom: 5px;">
                    <div ><input type="radio" name="sector" value=" Grondstoffen of voedsel leveren" checked>  Grondstoffen of voedsel leveren</div>
                    <div ><input type="radio" name="sector" value="Grondstoffen verwerken, produceren"> Grondstoffen verwerken, produceren</div>
                    <div ><input type="radio" name="sector" value="Diensten verlenen aan bedrijven"> Diensten verlenen aan bedrijven        </div>
                    <div ><input type="radio" name="sector" value="Diensten verlenen aan bedrijven"> Verkoop van goederen of diensten        </div>
                    <div ><input type="radio" name="sector" value="Diensten verlenen aan bedrijven"> Dienstverlening zonder winstoogmerk.       </div>
                </div>
                <label>Beschrijf uw idee*</label>
                <textarea id="idee" name="idee" class="form-control" placeholder="Ik maak juweeltjes en wil deze verkopen." style="margin-bottom: 1%;" required=""><?php echo $_POST['idee']?></textarea>
                <label>Doelgroep*</label>
                <textarea id="klanten" name="klanten" class="form-control" placeholder="Mijn juwelen kunnnen gedragen worden door alle leeftijdsgroepen, jonge en oud. Voor zowel mannen als vrouwen." style="margin-bottom: 1%;" required=""><?php echo $_POST['klanten']?></textarea>
                <label>Verdienmodel*</label>
                <textarea id="profit" name="profit" class="form-control" placeholder="Ik werk ongeveer ongeveer 3uur aan een juweel, en de grondstoffen kosten me 15€. Ik zou deze dus moeten verkopen aan €345 per stuk. Ik heb wel/geen BTW vrijstelling. Of ik weet niet of ik een vrijstelling heb. Ik zou het eerste jaar ongeveer 12.000€ willen verdienen. Ik besef dat een zaak runnen in dit land me minimul 500€ per jaar kost, inclusief boekhouder, administratie en de kosten die Webland me aanrekent." style="margin-bottom: 1%;" required=""><?php echo $_POST['profit']?></textarea>
                 <label>Kosten*</label>
                <textarea id="costs" name="costs" class="form-control" placeholder="Beschrijf hier zo nauwkeurig mogelijk welke kosten u heeft, welke investeringen u van plan bent." style="margin-bottom: 1%;" required=""><?php echo $_POST['costs']?></textarea>
                <label>Concurrentie*</label>
                <textarea id="vijand" name="vijand" class="form-control" placeholder="In ons dorp zijn er geen juweliers. De gene het dichtstebij noemt XXXX en hun website is xxxx.be. " style="margin-bottom: 1%;" required=""><?php echo $_POST['vijand']?></textarea>
                <label>Sterktes*</label>
                <textarea id="strong" name="strong" class="form-control" placeholder="Ik ben altijd zeer vriendelijk. Bovendien zijn mijn juwelen perfect als geschenk. Omdat elk juweel ook uniek is, en echt vakmanschap onderscheid ik me duidelijk van andere webshops." style="margin-bottom: 1%;" required=""><?php echo $_POST['strong']?></textarea>
                <label>Uitdagingen*</label>
                <textarea id="challenge" name="challenge" class="form-control" placeholder="Het belangrijkste is dat ik klanten heb. Bovendien kunnen de prijzen van mijn grondstoffen in de toekomste toenemen. Ik werk graag via webland omdat ik dankzij hun software niet teveel wordt afgeleid. En me zo kan richten op mijn kernactiviteiten." style="margin-bottom: 1%;" required=""><?php echo $_POST['challenge']?></textarea>
                <label>Stand van zaken*</label>
                <textarea id="status" name="status" class="form-control" placeholder="Ik heb momenteel ongeveer 178 klanten per jaar. Een btw nummer maar nog geen website." style="margin-bottom: 1%;" required=""><?php echo $_POST['status']?></textarea>
                <label>Hoe bouw je je netwerk op?*</label>
                <textarea id="netwerk" name="netwerk" class="form-control" placeholder="Ik wil vooral leven van mond aan mond reclame. Ik hoop ook klanten te scoren dankzij Cogitatio. En mijn Facebook pagina. Webland raad me ook een instagram aan." style="margin-bottom: 1%;" required=""><?php echo $_POST['netwerk']?></textarea>
                <label>Persoonlijke motieven?*</label>
                <textarea id="motieven" name="motieven" class="form-control" placeholder="Hier beschrijft u waarom u juist nú voor uzelf begint. Benoem daarbij niet alleen de kracht van het
product of de dienst, maar geef een persoonlijke motivatie. Waarom gelooft u hierin?
Wellicht ten overvloede, maar wees altijd open en eerlijk over uw beweegredenen. " style="margin-bottom: 1%;" required=""><?php echo $_POST['motieven']?></textarea>
                <label>Ambities?*</label>
                <textarea id="ambitie" name="ambitie" class="form-control" placeholder="Hier vertelt u wat u met uw onderneming wilt bereiken. Wat zijn precies uw ambities op zakelijk of privégebied? " style="margin-bottom: 1%;" required=""><?php echo $_POST['ambitie']?></textarea>
                <label> De markt in beeld?*</label>
                <textarea id="markt" name="markt" class="form-control" placeholder="Vertel iets over de marktomvang
(lokaal, landelijk en/of internationaal), gesignaleerde trends en vermeld eventuele plannen van
de overheid. Breng deze informatie zo concreet mogelijk in kaart. Staaf het met cijfers en noem
betrouwbare bronnen " style="margin-bottom: 1%;" required=""><?php echo $_POST['markt']?></textarea>
                
                <h3>De 4 p's</h3>
                <label>Product of dienst*</label>
                <textarea id="product" name="product" class="form-control" placeholder=" Naar wie richt je je? Begin bij mensen en organisaties die je goed kent. Mond-tot-mondreclame gaat in ons klein land tenslotte vrij snel. Druk visitekaartjes, flyers, raamstickers. En laad deze door ons verspreiden." style="margin-bottom: 1%;" required=""><?php echo $_POST['product']?></textarea>
                <label>Plaats*</label>
                <textarea id="place" name="place" class="form-control" placeholder="Ik verkoop van mijn thuis, en soms op standjes, maar in de toekomst ook op de website." style="margin-bottom: 1%;" required=""><?php echo $_POST['place']?></textarea>
                <label>Prijs*</label>
                <textarea id="price" name="price" class="form-control" placeholder="Neem alle tijd om je concurrenten aandachtig te bestuderen en breng je kosten in kaart. Wat heb je nodig om kosten en omzet in evenwicht te houden? En waar maak je winst op? Dit vormt de aanloop naar je financieel plan." style="margin-bottom: 1%;" required=""><?php echo $_POST['price']?></textarea>
                <label>Promotie*</label>
                <textarea id="promotie" name="promotie" class="form-control" placeholder=" Naar wie richt je je? Begin bij mensen en organisaties die je goed kent. Mond-tot-mondreclame gaat in ons klein land tenslotte vrij snel. Druk visitekaartjes, flyers, raamstickers. En laad deze door ons verspreiden." style="margin-bottom: 1%;" required=""><?php echo $_POST['promotie']?></textarea>
                
                 <h3>Openingstijden</h3>
                 <p>Indien niet van toepassing, zet `NVT`. Indien gesloten zet `GESLOTEN`</p>
                <label>Maandag*</label>
                <input id="Maandag" name="Maandag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Maandag']?>">
                
                <label>Dinsdag*</label>
                <input id="Dinsdag" name="Dinsdag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Dinsdag']?>">
                
                <label>Woensdag*</label>
                <input id="Woensdag" name="Woensdag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Woensdag']?>">
                
                <label>Donderdag*</label>
                <input id="Donderdag" name="Donderdag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Donderdag']?>">
                
                <label>Vrijdag*</label>
                <input id="Vrijdag" name="Vrijdag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Vrijdag']?>">
                
                <label>Zaterdag*</label>
                <input id="Zaterdag" name="Zaterdag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Zaterdag']?>">
                
                <label>Zondag*</label>
                <input id="Zondag" name="Zondag" type="text" class="form-control" placeholder="07:00-22:00" style="margin-bottom: 1%;" required="" value="<?php echo $_POST['Zondag']?>">
                
                <input type="submit" class="btn btn-success btn-block" value="VOLGENDE" style="margin-bottom: 1%; margin-top: 1%;">
               
                   <span>Je gegevens worden niet doorverkocht en zijn versleuteld.</span>
                
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