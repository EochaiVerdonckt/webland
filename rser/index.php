<?php
session_start();
include_once "../functions.php";

if($_POST['action']=='remove')
{

    $usernameDb = "koharusu_user";
    $passwordDb = "Luckies8DB";
    $hostname = "localhost";
    $dbname = "koharusu_DB";
    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql = "INSERT INTO `product`( `naam`, `info`,`price`) VALUES (,,".."')";
    $sql = "DELETE FROM `price_balance` WHERE id=".$_POST['id'];
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function getItem($id)
{
    $usernameDb = "koharusu_user";
    $passwordDb = "Luckies8DB";
    $hostname = "localhost";
    $dbname = "koharusu_DB";
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `price_balance` where id=".$id;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row;
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
}

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
    echo '<div class="col-lg-8">';
    $usernameDb = "koharusu_user";
    $passwordDb = "Luckies8DB";
    $hostname = "localhost";
    $dbname = "koharusu_DB";
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $gisteren=new DateTime('now');
    $gisteren->setTime(00, 00);
    $gisteren= $gisteren->format('Y-m-d H:i:s');
    $sql = "SELECT * FROM `reservaties` where datum>curdate()";
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
    $last=null;
    foreach ($rij as &$value) {
        if(empty($last))
        {
            $last=$value['id'];
        }
        echo '<h3>Reservatie: '.$value['id'].' Email: '.$value['email'].' Tel: '.$value['tel'].'</h3>';
        echo '<h5> '.$value['tijd'].' Datum: '.$value['datum'].' Aantal: '.$value['aantal'].' </h5>';
        echo "<textarea class='form-control' disabled>".$value['extra']."</textarea>";
        $tot=0;
    }
    echo '</div>';
    
    echo "<h1 id='laatste'>".$last."</h1>";
}


function verify()
{

    if(!$_SESSION['user'])
    {
        if($_POST)
        {
            if($_POST['user']=="l-admin" && $_POST['pass']=="pizza2018")
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
        <h2>Beheer uw prijzen</h2>
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
                    <h1><i class="fa fa-arrow-left" style="color: black;"></i></h1>
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

    toonlijst();
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
    <title>MyMenu | voeg je menu toe.</title>

    <meta name="description" content="Beautiful Balance Bunsbeek | Massages, schoonheid en persoonlijke verzorging" />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
 <!-- Bootstrap Css -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/plugins/Lightbox/dist/css/lightbox.css" rel="stylesheet">
    <link href="/plugins/Icons/et-line-font/style.css" rel="stylesheet">
    <link href="/plugins/animate.css/animate.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <!-- Icons Font -->
    <link rel="stylesheet" href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('http://mobile-express.be/balance/tegels/bg.jpg'); background-size: cover;" class="text-center">
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

<audio id="myAudio">
  <source src="piano.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

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

<!-- JS SCRIPTS -->
<script language="VBScript">
// THIS VB SCRIP REMOVES THE PRINT DIALOG BOX AND PRINTS TO YOUR DEFAULT PRINTER
Sub window_onunload()
On Error Resume Next
Set WB = nothing
On Error Goto 0
End Sub

Sub Print()
OLECMDID_PRINT = 6
OLECMDEXECOPT_DONTPROMPTUSER = 2
OLECMDEXECOPT_PROMPTUSER = 1


On Error Resume Next

If DA Then
call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)

Else
call WB.IOleCommandTarget.Exec(OLECMDID_PRINT ,OLECMDEXECOPT_DONTPROMPTUSER,"","","")

End If

If Err.Number <> 0 Then
If DA Then 
Alert("Nothing Printed :" & err.number & " : " & err.description)
Else
HandleError()
End if
End If
On Error Goto 0
End Sub

If DA Then
wbvers="8856F961-340A-11D0-A96B-00C04FD705A2"
Else
wbvers="EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
End If

document.write "<object ID=""WB"" WIDTH=0 HEIGHT=0 CLASSID=""CLSID:"
document.write wbvers & """> </object>"
</script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script>
    setTimeout(function(){
   window.location.reload(1);
}, 60*1000);
</script>
<script>

    function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

    var lastB= $("#laatste").text();
    var lastC= getCookie("last");
    console.log("cookie: "+lastC);
    if(lastC==null)
    {
        document.cookie = "last="+lastB;    
    }
    else
    {
        if(lastB>lastC)
        {
             var x = document.getElementById("myAudio"); 
             x.play();     
            document.cookie = "last="+lastB;  
        }
    }
   

function playAudio() { 
    x.play(); 
} 

function pauseAudio() { 
    x.pause(); 
} 
    
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->