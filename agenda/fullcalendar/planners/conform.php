<?php
include_once "../functions.php";

if($_POST)
{
 
            $msg = "Bestelling: ".$_POST['vnaam'].' '.$_POST['naam']." ".$_POST['email']." adres: ".$_POST['adres'].' '.$_POST['postal'];
            if(!is_null($_POST['gsm']))
            {
                $msg=$msg." gsm: ".$_POST['gsm'];
            }

            $msg=$msg."\n";

            $dbname = "mobile_express_";
    $usernameDb = "mobile_express_";
    $passwordDb = "E9EGWx3M";
    $hostname = "mobile-express.be.mysql";

// Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
   
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM `afspraakSlot` WHERE id=".$id;

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rij = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push ( $rij ,$row['begin'] );
        }
    } else {

    }
    mysqli_close($conn);
    $conn->close();

    $msg = $msg.$rij[0];
            mail('e.verdonckt@live.com', 'Afspraak geboek balance',  $msg);  
            mail('dominique.vandermeulen3@telenet.be', 'Afspraak geboek balance',  $msg);   
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
    <script src="behaviour.js"></script>
    <script src="app.js"></script>
    <script src="contactController.js"></script>

    <!-- CSS STYLES -->
    <link rel="stylesheet" type="text/css" href="/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
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

    <div id="vliegerFlug2" style="border-top: 1px solid black; padding-bottom: 5px; background-image: url('bg2.jpg'); background-repeat: no-repeat; background-size: 100% 100%;" class=" text-center">
        <div class="row" style="margin-top: 2%; margin-right: 1%; margin-left: 1%;" data-stellar-background-ratio="0.5">
        <?php if($_POST){

            echo "<h1 style='color: white' class='text-center'>Voltooid</h1>";
        }
        else{?>
                <h1 style='color: white' class='text-center'>Uw reservatie is geboekt.</h1>
                <h1 style='color: white' class='text-center'>Laten we even kennis maken</h1>
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
   $('td').click(function(){
       window.location.href = "http://beautifulbalance.be/reserveer/store.php?meet="+$(this).attr('id');
   });
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->