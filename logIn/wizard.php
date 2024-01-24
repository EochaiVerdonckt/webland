<?php
session_start();
include_once "../functions.php";


function print_header_flugzeug(){
    echo '
    <!--HEADER-->
    <div class="row" style="border-bottom: 1px solid black;    margin-right: 0;margin-left: 0;" id="header">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="index.php">
                <img src="logo.png" alt="logo" id="logo" width="100%;"/>
            </a>
        </div>   
        <div class="col-lg-1 col-md-1 col-sm-1 ol-lg-offset-1 col-md-offset-1 col-sm-offset-1">
             <a href="https://www.facebook.com/ERAFlugzeug">
                <img src="facebookIcon.png"  style="width: 100%; max-width: 50px;"/>
             </a>   
        </div>   

    ';
}

function toonlijst()
{
    $usernameDb = "mobile_express_";
    $passwordDb = "E9EGWx3M";
    $hostname = "mobile-express.be.mysql";
    $dbname = "mobile_express_";
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM cat_balance";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();

    foreach ($rij as &$value) {
        echo '<h3>'.$value['naam'].'</h3>';


        // Create connection
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM price_balance where cat=".$value['id']." ORDER BY bedrag";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table style="width: 100%; padding: 2%;">';
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$row['naam'].'</td>';
                echo '<td style="border-top: 1px solid white;">'.$row['bedrag'].' EUR</td>';
                echo '</tr>';

            }
            echo '</table>';

        } else {
            echo "0 results";
        }

        $conn->close();
    }


}
function printFormEmail_flugzeug()
{
    echo '
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    
            <form class="formulierContact" method="post">
                <div class="ruimte-top">
                    <label for="email">E-mail*:</label>
                    <i id="goed" class="fa fa-check" style="color:green;" ></i>
                    <i id="fout" class="fa fa-times" style="color:red;"></i>
                    <input id="email" type="text" name="email" class="form-control" placeholder="Jouw e-mail: " onkeyup="IsEmail();" onkeypress="IsEmail();" onchange="IsEmail();">
                </div>

                <div class="ruimte-top">
                    <label for="naam">Voornaam*: </label>
                    <input id="naam" type="text" name="naam" class="form-control" placeholder="Jouw voornaam ">
                </div>

                <div class="ruimte-top">
                    <label for="fnaam">Familienaam*: </label>
                    <input id="fnaam" type="text"  name="fnaam" class="form-control" placeholder="Jouw familienaam" >
                </div>

                <div class="ruimte-top">
                    <label for="telefoon">Telefoonnummer*: </label>
                    <input id="tel" type="text" name="tel" class="form-control" placeholder="Jouw telefoon">
                </div>

                <div class="ruimte-top">
                    <label for="bericht">Bericht*: </label>
                <textarea placeholder="Jouw bericht*" name="bericht" id="bericht" class="form-control">
                </textarea>
                </div>
                <div style="margin-top: 2%;">
                    <input type="submit" class="btn btn-block ruimte-top" id="verstuur" value="verstuur"/>
                </div>
               
            </form>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                            <p style="margin-top: 10%;">Diestsestraat xx</p>
                            <p>3000 Leuven</p>
                            <p>0499/358.323</p>
                            <p><a id="mailNaar" style="color: white;" href="mailto:leuvenexpress@gmail.com">leuvenexpress@gmail.com</a></p>
                            <a  id="route" href="https://www.google.com/maps/place/Diestsesteenweg+93,+3010+Leuven,+Belgi%C3%AB/@50.883747,4.719543,18z/data=!4m2!3m1!1s0x47c1672d0705d825:0x881dc6e39348b696?hl=nl-NL"><img  src="/mapke.png" width="10%"/></a></p>
                    </div>
                </div>
        </div>

    ';
}


function verify()
{

    if(!$_SESSION['user'])
    {
        if($_POST)
        {
            if($_POST['user']=="l-admin" && $_POST['pass']=="balance2016")
            {
                $_SESSION['user']="ok";
            }
            else
            {
                echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                    <span>Foute login gegevens</span>
                                </form>
        ';
            }

        }
        else
        {
            echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                </form>
        ';
        }
    }
}


function showOptions()
{
    echo '<div class="row text-center">
    <div class="col-lg-8 col-lg-offset-4">
        <h2>Hoe werkt dit?</h2>
    </div></div>';



    echo '<div class="row">';
        echo '<div class="col-lg-4">';
            echo '
                    <script type="text/javascript">
                            google_ad_client = "ca-pub-3598185186227907";
                            google_ad_slot = "4603323478";
                            google_ad_width = 300;
                            google_ad_height = 250;
                    </script>
                    <!-- Extra -->
                    <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>';
        echo '</div>';


    echo '<div class="col-lg-2 col-lg-offset-3 text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-arrow-left"></i></h1>
                  
                     <p> <a href="http://mobile-express.be/balance/tegels/" class="btn btn-default" role="button">VORIG</a></p>
                </div>';

    echo '</div>';
    echo '</div>';

    echo '<div class="col-lg-8  text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-bullhorn"></i></h1>
                    <h3>Laat een vriend of iemand in je familie een website bestelen</h3>
                    <h3>En u krijgt 5% levenskang, ja een gratis website kan!</h3>
                     <p> Jouw link : <a href="http://mobile-express.be/wizard/balance/" class="btn btn-default" role="button">http://mobile-express.be/wizard/balance/</a></p>
                </div>';

    echo '</div>';
    echo '</div>';




    echo '</div>';
    //END OF ROW 1

    echo '<div class="row">';
        echo '<div class="col-lg-4">';
        echo '<script type="text/javascript">
                google_ad_client = "ca-pub-3598185186227907";
                google_ad_slot = "4603323478";
                google_ad_width = 300;
                google_ad_height = 250;
               </script>
                <!-- Extra -->
                <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js">
         </script>';
        echo '</div>';



    echo "</div>";
    //END ROW 2

    echo '<div class="row">';

    echo '<div class="col-lg-4">';
    echo '
<script type="text/javascript">
    google_ad_client = "ca-pub-3598185186227907";
    google_ad_slot = "4603323478";
    google_ad_width = 300;
    google_ad_height = 250;
</script>
<!-- Extra -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>';
    echo '</div>';



    echo '</div>';// END ROW 3
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

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>

    <?php verify();?>

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions();
    }
?>



    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Mobile Express, design by <a href="http://mobile-express.be">Mobile Express</a> All rights reserved</p>
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
    $( "#verstuur" ).prop( "disabled", true );
    $("#goed").hide();
    function IsEmail()
    {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(regex.test(document.getElementById('email').value))
            {
                $( "#verstuur" ).prop( "disabled", false );
                $("#goed").show();
                $("#fout").hide();
            }
            else
            {
                $("#goed").hide();
                $("#fout").show();
            }
    }
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->