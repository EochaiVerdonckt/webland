<?php
session_start();
$path = getcwd();
$path = str_replace("horeca/orders", "", $path);


define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Orders Module";


function getFlag($id){
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM `promo_balance` where id=".$id;
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $item=$row;
        }

    } 

    $conn->close();
    return $item['promo'];
}

function getItem($id)
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $rij = array();

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
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $rij = array();

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
    $rij = array();
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

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


function showOptions($ctrl,$title){
    echo "<div class='row'>";
       
         $ctrl->side_nav();   
      
        
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
         $verlof=getVerlofState();
    echo '<div class="row">'; 
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
  
</div></div></p>
                </div></div></div>';
            toonlijst();
        echo '</div>';
    
    echo "</div>";
}

function toonlijst(){
    $rij = array();
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    

    $gisteren=new DateTime('now');
    $gisteren->setTime(00, 00);
    $gisteren= $gisteren->format('Y-m-d H:i:s');
    $sql = "SELECT * FROM `bestelling` where tijd>CURDATE() ORDER BY id desc";
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
       echo '<h3>Email: '.$value['email'].' Tel: '.$value['tel'].' <a href="print.php?id='.$value['id'].'"><i class="fa fa-print"></i></a></h3>';
        echo '<h5> '.$value['tijd'].'</h5>';
        if('Take away'==$value['leveringsaddres']){
             echo '<h3>'.$value['leveringsaddres'].'</h3>';
        }
        echo '<h3>'.$value['leveringsaddres'].' '.$value['huisnr'].' Bus:'.$value['bus'].'</h3>';
        echo '<h3>'.$value['postal'].'</h3>';
        if(!empty($value['levertijd']))
        {
            echo '<h3 style="border-top: 1px solid white;"> Lever: '.$value['levertijd'].'</h3>';
        }
        echo '<h3>'.$value['betaling'].'</h3>';
        
        echo "<textarea class='form-control' disabled>".$value['comment']."</textarea>";
        $tot=0;
        
         $ctrl=new AdminController();
        $conn=$ctrl->getConnection();

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
                    echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;"><span style="font-size: 2em; font-eight: 900; color: red;">'.$row['aantal'].'x </span>'.$o['naam'].'</td>';
                    echo '<td style="border-top: 1px solid white;">'.$row['aantal']*$o['bedrag'].' EUR</td>';
                 
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
                            echo '<td style="border-top: 1px solid white;">'.$row['aantal']*$o['bedrag'].' EUR</td>';
                            echo '</tr>';
                            $tot=$tot+$o['bedrag'];
                        }
                        else
                        {
                            echo '<tr>';
                            echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$o['naam'].' Groot</td>';
                            echo '<td style="border-top: 1px solid white;">'.$row['aantal']*$o['bedrag2'].' EUR</td>';
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
                    echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;"><span style="font-size: 2em; font-eight: 900; color: red;">'.$row['aantal'].'x </span>'.$o['naam'].'</td>';
                    echo '<td style="border-top: 1px solid white;">'.$row['aantal']*$o['bedrag'].' EUR</td>';
                    
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
        } 
       
        $conn->close();
        
    }
    echo "<h1 id='laatste' style='visibility:hidden;'>".$last."</h1>";
   
}

?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
    <?php $ctrl->printStyles(); ?>
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/portaal/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>
<?php $ctrl->print_supernav(); ?> 

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions($ctrl,$title);
    }
?>

<audio id="myAudio">
  <source src="piano.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Webland, design by <a href="http://mobile-express.be">Webland</a> All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
    </div>
</div>
    <!-- JS SCRIPTS -->
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <script>
        setTimeout(function(){
   window.location.reload(1);
}, 60*1000);

        $("#businessList").hide();
        $("#mySiteList").hide();
        $("#horecaList").hide();
        $("#webshopList").hide();
        $("#futureList").hide();
        $("#whrList").hide();
        //
        $("#futurePanel").click(function() {
            $("#futureList").toggle();
        });
        $("#businessPanel").click(function() {
            $("#businessList").toggle();
        });
         $("#mySitePanel").click(function() {
             $("#mySiteList").toggle();
        });
        $("#horecaPanel").click(function() {
             $("#horecaList").toggle();
        });
         $("#webshopPanel").click(function() {
             $("#webshopList").toggle();
        });
         $("#whrPanel").click(function() {
             $("#whrList").toggle();
        });

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
    console.log("cookie2: "+lastB);
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
            setTimeout(function () {
                var link="print.php?id="+lastB;
                window.location.href = link;
            }, 10000);
            
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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->