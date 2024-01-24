<?php session_start();
$path = getcwd();
$path = $path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/blogController.php");
$ctrl=new indexController();


function get_blog(){
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM news where id=306";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $item=$row;
        }
    } else {
        echo "BLOG NOT FOUND";
    }
    mysqli_close($conn); 
    return $item;
}
function print_blog()
{
    $ctrl=new indexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM news where id=306";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-12">';
            echo '<div class="thumbnail">
                    <img src="/homer.jpg" width="100%;" alt="">
                    <h1 style="text-decoration: underline;">Voor vele is 21 het mooiste jaar, voor mij was dat iets anders</h1>
                    <div class="caption">              
                     <p>Je hebt zo van die jaren...</p>
                      ';
                      
            echo '<hr />';          
                      
            echo '<p>Je hebt zo van die mensen en dagen in je leven waar je niet liever aan terug denkt. Net zoals stap 37, een eenvoudige stap die tot mijn 26ste verjaardag telkens in een cycli op 20 maanden kon, of vanaf toen meteen op 10 maanden kon. Om telkens opnieuw en opnieuw geholpen te worden, leest niet helpen maar manipulatief gedrag waardoor toch maar weer opnieuw je opnieuw en opnieuw dezelfde steen terug omhoog kan beginnen duwen. Of het nu shell attacks, een gestolen wagen, gestolen spullen, huur van een ander, cola op laptop is of misterieuze mindfuck spelletjes zijn. Door mensen met issues met een kappot kop die de betekenis van immoreel letterlijk, letterlijk letter per letter volgen. Hoe durf ik zeg het geld dat ik verdien bijhouden en sparen.</p>
            
                <p>Maar even terug naar de laatste dag van een leuke periode van mijn leven. Mijn 21ste verjaardag na mijn jaar op de hogeschool te voltooit hebben met een prachtig resultaat van de 2de beste van het jaar in een richting waar meer dan 60% van zij die zich inschrijven falen. Sinds Softwareontwikkling wel degelijk iets pittiger is dan gewoon HTML. Zou 
            ondanks de reeds meer dan 30.000€ achterstallige allimentatie (wat een gouden wieg, wat een investeringen). Er beslist worden om meteen mijn inkomsten te verlagen tot een onrealistisch niveau en 80€ minder als elk ander kind. De komende 2 jaren waren zoals altijd natuurlijk mentaal super zwaar en in feite onmogelijk om mijn studies verder te zetten. IK had toen beter een inkomen gezocht, wel geen verwijt aan het music café, die mijn een kans zouden geven die ik door mijn ik zal zeggen gebrek aan wijshied beter vol had gehouden. Maar niet te min is het mogelijk om gewoon het studiegeld en het kindergeld in ontvangst te nemen? Alsook de allimentatie dat was ruim voldoende geweest om deze onrealistische periode nooit te hoeven mee te maken. Een periode die gekenmerkt wordt door saffen op je arm uit te duwen, pijnstillers, flessen sterke drank en de zoveelste muur voor mij.</p>
            
            <p>Een periode die zou eindigen dankzij jawel Euphony en in combinatie met mijn grootmoeder die over de brug zou komen met een minimale storting zodat ik toch mij weer op mijn studies kon richten. En hierna vanalles uit spite verweten zou worden als of het over een dame zou gaan. Ach narcisten hebben geem emphatie dus ze zullen mij altijd raar vinden. Dus GTFO ik omring me liever met mensen die begrip kennen en niet zagen over hun problemen, of het die helpt mij nooit, want ik doe ook nooit een hol voor hem en zou graag ook is een reisje doen van het geld van het harde werk zoals bv het geld van nog geen 2 weken te gebruiken voor een wasmachine in plaats van franchise, huur of waarborg van een ander. </p>
            
            <p>Tot slot nog de absoluut vraag van Socrates is het een probleem als ik met mijn eigen geld op reis wil? Is het een probleem als ik geld dat mensen mij moeten ook terug wil? En vooral is het zoveel gevraagd om naar de VDAB te gaan in plaats van mijn wijn te stelen? En een product van meer dan €2000 als vrienden dienst cadeau te doen voor mensen die gewoon negeren tenzij ze zelf iets nodig hebben, is dat niet net iets teveel gevraagd?</p> 
            
            <p>Op naar de volgende periode eentje die vanaf die dag, toen ik op de oo zo leuke PEDA aankwam toen er net voor 2300€ spullen verdwenen waren en ik natuurlijk zo narcistisch was dat ik een ander zijn ticket voor Tommorwland niet wou betalen, ze hadden al o.a een blender geript... Een periode die weer zou eindigen met de volgende klasse in het achterhoofd stap 38. Die vandaag binnenhand bereik is. Last but not least de conclusie? Kaarsje aansteken dat ze op een ander bemoeiziek komen doen, en mijn ding doen zodat ik ten minste vandaag dan stap 38 haal. Hou je broodje maar bij, en het restaurant binnen wandelen voor het geld te innen voor mijn werk als zelfstandige webdev. Of webdev is geen echt werk zeker??? 
            
            </p>';        

          
            echo '<!-- Your share button code -->
  <div class="fb-share-button" 
    data-href="'.$_SERVER['REQUEST_URI'].'" 
    data-layout="button_count">
  </div>';

            echo '
                    </div>
                 </div></div></div>';
        }
    } else {
        echo "<h1>We hebben momenteel geen nieuws</h1>";
    }
    mysqli_close($conn);
}

$blog=get_blog();

?>

<!DOCTYPE html>
<html lang="nl">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>WEBLAND NEWS | Voor vele is 21 het mooiste jaar, voor mij was dat iets anders</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Je hebt zo van die jaren.">
    <meta name="keywords" content="">
    <meta name="author" content="Eoghain Verdonckt">

    <!-- Bootstrap Css -->
   
     <link href="css/bootstrap.min.css" rel="stylesheet">
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
    <div style="margin-top: 25px;">
        
    </div>
    <section>
 <?php print_blog(); ?> 
    </section>
    <!-- Footer
	============================================= -->
    <footer>
        <div class="container-fluid">
            <div class="row" style="padding: 0; margin:0;background-color:white;">
                <h5 style="margin-bottom: 0; padding: 2%;    width: 100%;" class="text-center font-2">  © 2019 Comet Web OS - Libra edition All rights reserved by <a href="http://webland.be">webland</a> <a href="/GDPR.pdf"  style="color: black" class="nav-link"> GDPR</a> <a href="/portaal/"  style="color: black" class="nav-link"> <i class="fa fa-lock "></i></a> </h5>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row" style="background-color: black;">
            </div>
            
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <!-- JS PLUGINS -->
    
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>
    <script>
        $("#toolBox").css({'margin-top':'8px'});
    $("#newsBox").css({'margin-top':'14px'});
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3598185186227907"
     crossorigin="anonymous"></script>
</body>

</html>
