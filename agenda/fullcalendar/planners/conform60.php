<?php
include_once "../functions.php";


function print_header_flugzeug(){
    echo '
    <!--HEADER-->
    <div class="row" style="border-bottom: 1px solid black;    margin-right: 0;margin-left: 0;" id="header">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="index.php">
                <img src="http://mobile-express.be/balance/logo.png" alt="logo" id="logo" width="100%;"/>
            </a>
        </div>   
        <div class="col-lg-1 col-md-1 col-sm-1 ol-lg-offset-1 col-md-offset-1 col-sm-offset-1">
             <a href="https://www.facebook.com/ERAFlugzeug">
                <img src="http://mobile-express.be/balance/facebookIcon.png"  style="width: 100%; max-width: 50px;"/>
             </a>   
        </div>   

    ';
}

if($_POST)
{






            $msg = "Bestelling: ".$_POST['vnaam'].' '.$_POST['naam']." ".$_POST['email']." adres: ".$_POST['adres'].' '.$_POST['postal']."booking: ".$_POST['booking'];
            if(!is_null($_POST['gsm']))
            {
                $msg=$msg." gsm: ".$_POST['gsm'];
            }
// use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

// send email
    mail("e.verdonckt@live.com","Afspraak geboekt Balance",$msg);
    //mail('dominique.vandermeulen3@telenet.be', 'Afspraak geboek balance',  $msg);


    $usernameDb = "mobile_express_";
    $passwordDb = "E9EGWx3M";
    $hostname = "mobile-express.be.mysql";
    $dbname = "mobile_express_";

    // Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Binnenkort beschikbaar, Connection failed: " . mysqli_connect_error());
    }

    if($vzw=='ja')
    {
        $vzw=1;
    }
    else
    {
        $vzw=0;
    }

    $tijd=  explode(" ", $_POST['booking']);
    $datum=$tijd[1];
    $tijd=$tijd[0];


    $regel=explode("/", $datum);
    $dag=$regel[0];
    $maand=$regel[1];
    $jaar= $regel[2];

    $begin = $jaar."-".$maand."-".$dag." ".$tijd.":00";

    $regel = explode(" ",$tijd);
    $uur=$regel[0];
    $uur=$uur+2;
    $tijd= $uur.':00:00';
    $eind=$jaar."-".$maand."-".$dag." ".$tijd;
    $sql = "INSERT INTO `afspraakSlot`(`begin`, `eind`, `behandeling`) VALUES ('". $begin."','".$eind."','".$msg."')";

    if ($conn->query($sql) === TRUE) {
        $klant_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Beautiful Balance | Massages, schoonheid en persoonlijke verzorging</title>

    <meta name="description" content="Beautiful Balance Bunsbeek | Massages, schoonheid en persoonlijke verzorging" />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
    <!-- JS SCRIPTS -->
    <script src="/jquery.min.js"></script>
    <script src="/bootstrap.min.js"></script>
    <script src="/angular.min.js"></script>
    <script src="/stellar.js"></script>



    <!-- CSS STYLES -->
    <link rel="stylesheet" type="text/css" href="/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://mobile-express.be/balance/style.css">
</head>
<body>
<div class="container-fluid ruimte-top">
    <?php print_header_flugzeug();?>
    </div>
    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black; background-image: url('http://mobile-express.be/balance/background.jpg');" class=" text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Schoonheidssalon, persoonlijke verzorging massages, aromatherapie</h1>
    </div>

    <div style=" margin-top: 2%;" class="text-center" data-stellar-background-ratio="0.5">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <a href="http://beautifulbalance.be/" class="green">
                    <span><i class="fa fa-home fa-3x"></i></span>
                    <p>Home</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-4">
                <a href="http://beautifulbalance.be/prijs.php" class="green">
                    <span><i class="fa fa-map fa-3x"></i></span>
                    <p>Prijzen</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-4">
                <a href="http://beautifulbalance.be/contact.php" class="green">
                    <span><i class="fa fa-paper-plane fa-3x"></i></span>
                    <p>Contact pagina</p>
                </a>
            </div>
        </div>
    </div>

    <div id="vliegerFlug2" style="border-top: 1px solid black; padding-bottom: 5px; background-image: url('http://mobile-express.be/balance/reserveer/bg2.jpg'); background-repeat: no-repeat; background-size: 100% 100%;" class=" text-center">
        <div class="row" style="margin-top: 2%; margin-right: 1%; margin-left: 1%;" data-stellar-background-ratio="0.5">
        <?php if($_POST){

            echo "<h1 style='color: white' class='text-center'>Voltooid</h1>";
        }
        else{?>
                <h1 style='color: white' class='text-center'>Uw reservatie is geboekt, laten we even kennis maken</h1>
                <h1 style='color: white' class='text-center'></h1>
                <h3 style='color: white;   text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;' class='text-center' id="time"></h3>
                 <form class="text-left" method="POST" action="" style="margin-left: 2%; margin-right:2%; color: white;">
                 <div>
                      <label>Naam</label>
                <input type="text" class="form-control" name="naam" required>
                 </div>
                 <div>
                      <label>Voornaam</label>
                <input type="text" class="form-control" name="vnaam" required>
                 </div>
                 <div>
                                 <label>E-mail</label>
                <input type="email" class="form-control" name="email" required>
                 </div>
                 <div>
                          <label>Gsm (optioneel, maar liefst wel)</label>
                <input type="text" class="form-control" name="gsm"  >
                 </div>
                 <div>
                  <label>Straat + nummer</label>
                <input type="text" class="form-control" name="adres" required>
                 </div>
                 <div>
                <label>Postcode + gemeente</label>
                <input type="text" class="form-control" name="postal" required>
                 </div>
                <input type="hidden" name="booking" id="booking" value=""/>
                <div style='margin:2%;'>
                    <button class="btn btn-success btn-block">Verzenden</button>
                </div>
            </form>
            <?php } ?>

        </div>
    </div>

    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Beautiful Balance 2016, design by <a href="http://mobile-express.be">Mobile Express</a> All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://cogitatio.be" id="support">Met de steun van Cogitatio.be</a>
        </div>
    </div>
</div>

<script>
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    var dateFromDay=function dateFromDay(year, day){
        var date = new Date(year, 0); // initialize a date in `year-01-01`
        return new Date(date.setDate(day)); // add the number of days
    };

    var convertDate=function convertDate(inputFormat) {
        function pad(s) { return (s < 10) ? '0' + s : s; }
        var d = new Date(inputFormat);
        return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
    };

    var datum = getUrlParameter('datum');
    var uur = getUrlParameter('uur');


    $('#time').html("<i class='fa fa-calendar'></i> "+uur+":00 "+datum);
    document.getElementById('booking').value  = uur+":00 "+datum
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->