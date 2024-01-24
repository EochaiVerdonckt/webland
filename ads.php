<?php
session_start();

function getItem($id)
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

function getVerlofState()
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

    $sql = "SELECT * FROM `order_params` where id=1";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
        }

    } else {
        echo "item niet gevonden.";
        die();
    }
    $conn->close();
    return $item;
 }
 
 
 
function getWachttijd()
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

    $sql = "SELECT * FROM `order_params` where id=2";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['vlag'];
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
    

    $gisteren=new DateTime('now');
    $gisteren->setTime(00, 00);
    $gisteren= $gisteren->format('Y-m-d H:i:s');
    $sql = "SELECT * FROM `bestelling` where id=".$_GET['id'];
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
        echo '<h3>Bestelling: Email: '.$value['email'].' Tel: '.$value['tel'].'</h3>';
        echo '<h5> '.$value['tijd'].'</h5>';
         if('Take away'==$value['leveringsaddres']){
             echo '<h3>'.$value['leveringsaddres'].'</h3>';
        }
        else{
            echo '<h3>'.$value['leveringsaddres'].' '.$value['huisnr'].' Bus:'.$value['bus'].'</h3>';
            echo '<h3>'.$value['postal'].'</h3>';
        }
        if(!empty($value['levertijd']))
        {
            echo '<h3 style="border-top: 1px solid white;"> Lever: '.$value['levertijd'].'</h3>';
        }
        
        echo "<textarea class='form-control' disabled>".$value['comment']."</textarea>";
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
            // output data of each row
            echo '<table style="width: 100%; padding: 2%;">';
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $o=getItem($row['item']);
                
                if($o['cat']=="79" || $o['cat']=="83" )
                {
                    if($item['id']<727 && $item['id']>721 )
                    {
                                            echo '<tr>';
                    echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$o['naam'].'</td>';
                    echo '<td style="border-top: 1px solid white;">'.$o['bedrag'].' EUR</td>';
                    echo '<td style="border-top: 1px solid white;">Aantal'.$row['aantal'].'</td>';
                    if(!empty($row['saus']))
                    {
                        echo '<td style="border-top: 1px solid white;">Saus: '.$row['saus'].'</td>';
                    }
                    echo '</tr>';
                    $tot=$tot+$o['bedrag']*$row['aantal']; 
                    }
                    else
                    {
                                         $aantal=0;
                    
                    $formaat=explode(";", $row['formaat']);
                    while($aantal<$row['aantal'])
                    {
                        if($formaat[$aantal]=="Klein")
                        {
                            echo '<tr>';
                            echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$o['naam'].' Klein</td>';
                            echo '<td style="border-top: 1px solid white;">'.$o['bedrag'].' EUR</td>';
                            echo '</tr>';
                            $tot=$tot+$o['bedrag'];
                        }
                        else
                        {
                            echo '<tr>';
                            echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$o['naam'].' Groot</td>';
                            echo '<td style="border-top: 1px solid white;">'.$o['bedrag2'].' EUR</td>';
                            echo '</tr>';
                            $tot=$tot+$o['bedrag2'];
                        }
                        $aantal++;
                    }   
                    }
                }
                else
                {
                    echo '<tr>';
                    echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$o['naam'].'</td>';
                    echo '<td style="border-top: 1px solid white;">'.$o['bedrag'].' EUR</td>';
                    echo '<td style="border-top: 1px solid white;">Aantal'.$row['aantal'].'</td>';
                    if(!empty($row['saus']))
                    {
                        echo '<td style="border-top: 1px solid white;">Saus: '.$row['saus'].'</td>';
                    }
                    echo '</tr>';
                    $tot=$tot+$o['bedrag']*$row['aantal'];    
                }
            }
            echo '</table>';
            echo "<h5>Totaal: ".$tot." EUR</h5>";
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    
      echo '<div>
            <a href="print.php?id='.$_GET['id'].'" class="btn btn-block btn-success">BEVESTIG</a>
             <a href="index.php" class="btn btn-block btn-danger">WEIGER</a>
   
        </div>';
    echo '</div>';
    
 
}


function calcProfit()
{
    
    $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();
    $tot=0;
    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $gisteren=new DateTime('now');
    $gisteren->setTime(00, 00);
    $gisteren= $gisteren->format('Y-m-d H:i:s');
    $sql = "SELECT * FROM `bestelling` ORDER BY id desc";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
       
    }

    $conn->close();
    $last=null;
    foreach ($rij as &$value) {
        if(empty($last))
        {
            $last=$value['id'];
        }
        // Create connection
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `orderline` WHERE `bestelling`=".$value['id'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
           
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $o=getItem($row['item']);
                
                if($o['cat']=="79" || $o['cat']=="83" )
                {
                    if($item['id']<727 && $item['id']>721 )
                    {
                        $tot=$tot+$o['bedrag']*$row['aantal']; 
                    }
                    else
                    {
                        $aantal=0;
                        $formaat=explode(";", $row['formaat']);
                    while($aantal<$row['aantal'])
                    {
                        if($formaat[$aantal]=="Klein")
                        {
                            $tot=$tot+$o['bedrag'];
                        }
                        else
                        {
                            $tot=$tot+$o['bedrag2'];
                        }
                        $aantal++;
                    }   
                    }
                }
                else
                {
                    $tot=$tot+$o['bedrag']*$row['aantal'];    
                }
            }
            
            
        } else {

        }
        $conn->close();
    }
   // echo "<h5>Total profit: ".$tot." EUR</h5>";
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
    
     $verlof=getVerlofState();
     
    if($verlof==0)
    {
        echo '<div class="col-lg-2 col-lg-offset-2 text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-plane" style="color: black;"></i></h1>
                    <h3>VERLOF</h3>
                     <p> <a href="verlof.php" class="btn btn-warning" role="button">VAKANTIE</a></p>
                </div>';

    echo '</div>';
    echo '</div>';
        
    }
    else
    {
        echo '<div class="col-lg-2 col-lg-offset-2 text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-plane" style="color: black;"></i></h1>
                    <h3>VERLOF</h3>
                     <p> <a href="activate_verlof.php" class="btn btn-default" role="button">open</a></p>
                </div>';

    echo '</div>';
    echo '</div>';
    
    }
    
    $wacht=getWachttijd();
    
    echo '<div class="col-lg-2 col-lg-offset-2 text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-clock-o" style="color: black;"></i></h1>
                    <h3>WACHTTIJD</h3>
                     <p><div class="btn-group" role="group" aria-label="Basic example">';
                     
    if($wacht==0)
    {
        echo '<a href="15.php" type="button" class="btn btn-info" role="button">15</a>';
    }
    else
    {
        echo '<a href="15.php" type="button" class="btn btn-secondary" role="button">15</a>';      
    }
    
    
    if($wacht==1)
    {
        echo '<a href="30.php" type="button" class="btn btn-info" role="button">30</a>';      
    }
    else
    {
        echo '<a href="30.php" type="button" class="btn btn-secondary" role="button">30</a>';      
    }
    
    
    if($wacht==2)
    {
        echo ' <a href="45.php" type="button" class="btn btn-info" role="button">45</a>';
    }
    else
    {
        echo ' <a href="45.php" type="button" class="btn btn-secondary" role="button">45</a>';
    }
    
    if($wacht==3)
    {
        echo '<a href="60.php" type="button" class="btn btn-info" role="button">60</a>';
    }
    else
    {
        echo '<a href="60.php" type="button" class="btn btn-secondary" role="button">60</a>';
    }
    echo '                 
  
</div></p>
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid ruimte-top">



    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
    <script type="text/javascript">
    google_ad_client = "ca-pub-3598185186227907";
    google_ad_slot = "4603323478";
    google_ad_width = 300;
    google_ad_height = 250;
</script>
<!-- Extra -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script type="text/javascript">
    google_ad_client = "ca-pub-3598185186227907";
    google_ad_slot = "4603323478";
    google_ad_width = 300;
    google_ad_height = 250;
</script>
<!-- Extra -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script type="text/javascript">
    google_ad_client = "ca-pub-3598185186227907";
    google_ad_slot = "4603323478";
    google_ad_width = 300;
    google_ad_height = 250;
</script>
<!-- Extra -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
       
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
          
        </div>
    </div>
</div>

<script>

function yourFunction(){
    var x = document.getElementById("myAudio"); 
             x.play(); 
    setTimeout(yourFunction, 1500);
}

yourFunction();
     
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN.  130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->