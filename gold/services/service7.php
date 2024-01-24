<?php
session_start();

if($_POST['promo'])
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
    
    //$sql = "UPDATE `services` SET `omschrijving`='".$_POST['promo']."' SET naam=' WHERE id=1";
    $sql="UPDATE `services` SET `naam`='".$_POST['naam']."',`omschrijving`='".$_POST['promo']."' WHERE id=7";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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

function getPromo()
{
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM services where id=7";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item['omschrijving'] = $row['omschrijving'];
            $item['naam'] = $row['naam'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function toonForm(){
        $item=getPromo();
        echo "<div class='col-lg-6'>";
    echo "<h3><i class='fa fa-info'></i> Je kan hier een tekst schrijven, deze past zich aan.</h3>";
    echo '<form method="post">';
    echo '<label>Titel</label>';
    echo '<input type="text" name="naam" value="'.$item['naam'].'" class="form-control"/>';
    echo '<label>Pas hier uw tekst aan</label>';
    echo '<textarea class="form-control ckeditor" id="area1" name="promo">'.$item['omschrijving'].'</textarea>';
    echo "<h5><i class='fa fa-pencil'></i> Deze tool werkt met Word Live</h5>";
    
    
    echo '
    <script src="https://authedmine.com/lib/captcha.min.js" async></script>
	<div class="coinhive-captcha" 
		data-hashes="1024" 
		data-key="p2IHPreg6Dyg13lHAGagmu4OZRG1yDkN"
		data-autostart="false"
		data-disable-elements="input[type=submit]"
		data-callback="myCaptchaCallback"
	></div>
    
    ';
    
    echo '<input type="submit" class="btn btn-info btn-block" />';
    echo '</form>';
}
function showOptions()
{
    echo '<div class="row text-center">
    <div class="col-lg-8 col-lg-offset-4">
        <h2>Beheer uw promo vak</h2>
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


    echo '<div class="col-lg-2 col-lg-offset-2 text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-arrow-left"></i></h1>
                    <h3>GA TERUG</h3>
                     <p> <a href="/tegels/" class="btn btn-default" role="button">VORIG</a></p>
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

    toonForm();
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
    <title>Krijtbord | Pas uw website aan in één klik.</title>

    <meta name="description" content="Krijtbord | Pas uw website aan in één klik." />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />

    <link href="/bootstrap-assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/plugins/Lightbox/dist/css/lightbox.css" rel="stylesheet">
    <link href="/plugins/Icons/et-line-font/style.css" rel="stylesheet">
    <link href="/plugins/animate.css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="/css/main.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('http://mobile-express.be/balance/tegels/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style="    width: 100%; text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
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
<!-- JS SCRIPTS -->
<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="/js/modernizr.js"></script>
<script src="/js/bootstrap.js"></script> 
<script src="/js/wow.js"></script>
<script src="/angular.min.js"></script>
<script src="/stellar.js"></script>
<script src="behaviour.js"></script>
<script src="app.js"></script>
<script src="contactController.js"></script>
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