<?php
session_start();
include_once "../functions.php";

function getItem($id)
{
    $usernameDb = "pizzafac_user";
    $passwordDb = "Luckies8DB";
    $hostname = "localhost";
    $dbname = "pizzafac_DB";
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
    $usernameDb = "pizzafac_user";
    $passwordDb = "Luckies8DB";
    $hostname = "localhost";
    $dbname = "pizzafac_DB";
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `bestelling` WHERE ID=".$_GET['id']." ORDER BY tijd desc";

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
        echo '<p>'.$value['email'].'</p>';
        echo '<p>'.$value['tijd'].'</p>';
        echo '<h3>'.$value['leveringsadres'].'</h3>';
        echo '<h3>'.$value['leveringsaddres'].'</h3>';
        echo '<h4>'.$value['tel'].'</h4>';
        if(!empty($value['levertijd']))
        {
            echo '<p style="border-top: 1px solid white;"> Lever: '.$value['levertijd'].'</p>';
        }
        echo "<p style='text-align: center;'>--------------</p>";
        echo "<p>".$value['comment']."</p>";
        echo "<p style='text-align: center;'>--------------</p>";
        $tot=0;

        // Create connection
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `orderline` WHERE `bestelling`=".$value['id'];
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $o=getItem($row['item']);
                if($o['cat']==79 || $o['cat']==83)
                {
                    $aantal=0;
                    $formaat=explode(";", $row['formaat']);
                    $amount_small=0;
                    $amount_big=0;
                    while($aantal<$row['aantal'])
                    {
                         if($formaat[$aantal]=="Klein")
                        {
                            $amount_small++;
                            $tot=$tot+$o['bedrag'];
                        }
                        else
                        {
                            $amount_big++;
                            $tot=$tot+$o['bedrag2'];
                        }
                        $aantal++;
                    }
                    
                    if($amount_small>0)
                    {
                        echo '<p>'.$amount_small.' x  '.$o['naam'].' Klein '.$o['bedrag'].'€</p>';
                        echo "<p>Tot: ".$o['bedrag']*$amount_small." EUR</p>";
                    }
                    
                    if(!empty($row['saus']))
                    {
                         $saus=explode(";", $row['saus']);
                         $formaat=explode(";", $row['formaat']);
                         for ($i = 0; $i <= count($saus); $i++) {
                             if(!empty($saus[$i]))
                             {
                                 if($formaat[$i]=='Klein')
                                 {
                                     echo '<p>  -- '.$saus[$i].'</p>';
                                 }
                                 
                             }
                         }
                    }
                    
                     if($amount_big>0)
                    {
                        echo '<p>'.$amount_big.' x  '.$o['naam'].' Groot ' .$o['bedrag2'].'€</p>';
                        echo "<p>Tot: ".$o['bedrag2']*$amount_big." EUR</p>";
                    }
                    
                    if(!empty($row['saus']))
                    {
                         $saus=explode(";", $row['saus']);
                         $formaat=explode(";", $row['formaat']);
                         for ($i = 0; $i <= count($saus); $i++) {
                             if(!empty($saus[$i]))
                             {
                                if($formaat[$i]=='Groot')
                                 {
                                     echo '<p>  -- '.$saus[$i].'</p>';
                                 }
                             }
                         }
                    }
                    
                }
                else
                {
                    echo '<p>'.$row['aantal'].' x  '.$o['naam'].' '.$o['bedrag'].'€</p>';
                    echo "<p>Tot: ".$o['bedrag']*$row['aantal']." EUR</p>";
                    if(!empty($row['saus']))
                    {
                         $saus=explode(";", $row['saus']);
                         foreach ($saus as &$value) {
                             if(!empty($value))
                             {
                                 echo '<p>  -- '.$value.'</p>';
                             }
                            
                        }
                    }
                    $tot=$tot+$o['bedrag']*$row['aantal'];
                }
            }
            echo "<h5>Totaal: ".$tot." EUR</h5>";
            echo "<h5>______________</h5>";
            echo "<h5>______________</h5>";
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    echo '</div>';
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
    toonlijst();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container-fluid ruimte-top">
    <?php verify();?>
    <?php
    if($_SESSION['user']=="ok")
    {
        showOptions();
    }
    ?>
</div>

<!-- JS SCRIPTS -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="/js/modernizr.js"></script>
<script src="/js/bootstrap.js"></script> 
<script src="/js/wow.js"></script>
<script src="/angular.min.js"></script>
<script src="/stellar.js"></script>
<script src="behaviour.js"></script>
<script src="app.js"></script>
<script src="contactController.js"></script>

<!-- JS SCRIPTS -->
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
    
    setTimeout(function(){
   window.location.reload(1);
}, 60*1000);
</script>
<script type="text/javascript">
<!--
window.print();
setTimeout(function () {
    var link="/orders/";
    window.location =link;
    }, 500);
            
//-->
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->