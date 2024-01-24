<?php
session_start();

$path = getcwd();
$path = str_replace("portaal", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();


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
function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
        $ctrl->side_nav();   
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
         echo '<div class="row">';
                  echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Logo</h4>
                      <a href="/gold/logo/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></A>
                </div>'; 
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Color</h4>
                      <a href="/gold/color/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></A>
                </div>'; 
         
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Gegevens</h4>
                      <a href="/gold/seo/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></A>
                </div>'; 
                
                
                  echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Kernwoorden</h4>
                      <a href="/gold/keywords/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></A>
                </div>';
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Uurrooster';
                 if(getFlag(15)=='#000'){
                    echo '<a  href="installer.php?id=15"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=15"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                echo       '<a href="/gold/blog/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a>
                </div>';
                
                
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Diensten';
                if(getFlag(14)=='#000'){
                    echo '<a  href="installer.php?id=14"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=14"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                    echo   '<a href="/gold/services/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;color:white"><i class="fa fa-eye"></i></a>
                </div>';
         
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Krijtbord';
                if(getFlag(9)=='#000'){
                    echo '<a  href="installer.php?id=9"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=9"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                
                echo '<a href="/gold/krijtbod/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                
                   echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>About</h4>
                      <a href="/gold/about/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a>
                </div>';
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Blog';
                 if(getFlag(10)=='#000'){
                    echo '<a  href="installer.php?id=10"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=10"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                echo       '<a href="/gold/blog/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a>
                </div>';
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Vlog';
                  if(getFlag(11)=='#000'){
                    echo '<a  href="installer.php?id=11"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=11"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                    echo  '<a href="/gold/vlog/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a>
                </div>';
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Events';
                 if(getFlag(12)=='#000'){
                    echo '<a  href="installer.php?id=12"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=12"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                
                echo       '<a href="/gold/events/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></A>
                </div>';
                
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                echo '<h4>Fotopagina';
                 if(getFlag(13)=='#000'){
                    echo '<a  href="installer.php?id=13"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                }else{ echo '<a  href="installer.php?id=13"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                echo       '<a href="/gold/afbeeldingen/" class="btn btn-primary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></A>
                </div>';
                if(getFlag(18)=='#FFF'){
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Missie';
                 if(getFlag(16)=='#000'){
                    echo '<a  href="installer.php?id=16"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=16"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                   echo '<a href="/business/mission/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>'; 
                
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Sterktes';
                 if(getFlag(17)=='#000'){
                    echo '<a  href="installer.php?id=17"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=17"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 
                 echo '<a href="/business/strenght/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 
                
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Zakenplan';
                 if(getFlag(19)=='#000'){
                    echo '<a  href="installer.php?id=19"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=19"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                echo '<a href="/bussiness/zakenplan/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a>';
                 echo  '</div>';
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Presentatie';
                  if(getFlag(20)=='#000'){
                    echo '<a  href="installer.php?id=20"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=20"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/slides/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Doelgroep';
                  if(getFlag(29)=='#000'){
                    echo '<a  href="installer.php?id=29"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=29"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/slides/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Departermenten';
                  if(getFlag(30)=='#000'){
                    echo '<a  href="installer.php?id=30"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=30"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/departments/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                   echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Functies';
                  if(getFlag(31)=='#000'){
                    echo '<a  href="installer.php?id=31"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=31"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/functis/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                  echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Vacatures';
                  if(getFlag(32)=='#000'){
                    echo '<a  href="installer.php?id=32"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=32"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/functis/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Bordspel';
                  if(getFlag(21)=='#000'){
                    echo '<a  href="installer.php?id=21"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=21"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/ganzenbord/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                  echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Reviews';
                  if(getFlag(22)=='#000'){
                    echo '<a  href="installer.php?id=22"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=22"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/reviews/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Klanten';
                  if(getFlag(23)=='#000'){
                    echo '<a  href="installer.php?id=23"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=23"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/klanten/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
               
               
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Leden';
                  if(getFlag(28)=='#000'){
                    echo '<a  href="installer.php?id=28"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=28"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/members/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
               
               
               
                 
                  echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Agenda';
                  if(getFlag(24)=='#000'){
                    echo '<a  href="installer.php?id=24"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=24"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/agenda/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                
                echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Facturatie';
                  if(getFlag(26)=='#000'){
                    echo '<a  href="installer.php?id=26"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=26"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/vragen/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                
                
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Q&A';
                  if(getFlag(25)=='#000'){
                    echo '<a  href="installer.php?id=25"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }else{ echo '<a  href="installer.php?id=25"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/vragen/" class="btn btn-secondary" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                }
                
                if(getFlag(33)=='#FFF'){
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>MENU';
                  if(getFlag(34)=='#000'){
                    echo '<a  href="installer.php?id=34"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }
                 else{ echo '<a  href="installer.php?id=34"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/horeca/prices/" class="btn btn-success" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>BESTELLINGEN';
                  if(getFlag(35)=='#000'){
                    echo '<a  href="installer.php?id=35"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }
                 else{ echo '<a  href="installer.php?id=35"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/horeca/orders/" class="btn btn-success" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                  echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h6>PERIODIEKE BESTELLINGEN';
                  if(getFlag(36)=='#000'){
                    echo '<a  href="installer.php?id=36"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h6>';
                 }
                 else{ echo '<a  href="installer.php?id=36"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h6>'; }
                 echo '<a href="/bussiness/vragen/" class="btn btn-success" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                
                   echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>RESERVATIES';
                  if(getFlag(38)=='#000'){
                    echo '<a  href="installer.php?id=38"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }
                 else{ echo '<a  href="installer.php?id=38"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/vragen/" class="btn btn-success" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>Z RAPPORTEN';
                  if(getFlag(39)=='#000'){
                    echo '<a  href="installer.php?id=39"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }
                 else{ echo '<a  href="installer.php?id=39"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/bussiness/vragen/" class="btn btn-success" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>GANGEN';
                  if(getFlag(34)=='#000'){
                    echo '<a  href="installer.php?id=34"> <i style="font-size:0.8em;color:green;" class="fa fa-download"></i><a></h4>';
                 }
                 else{ echo '<a  href="installer.php?id=34"> <i style="font-size:0.8em;color:red;" class="fa fa-power-off"></i><a></h4>'; }
                 echo '<a href="/horeca/prices/" class="btn btn-success" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 
                }
                if(getFlag(42)=='#FFF'){
                    //ADD WEBSHOP LINKS
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>CATEGORIËEN';
                 echo '<a href="/webshop/categ/" class="btn btn-warning" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>MERKEN</h4>';
                 echo '<a href="/webshop/merk/" class="btn btn-warning" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>PRODUCTEN';
                 echo '<a href="/webshop/producten/" class="btn btn-warning" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                 
                 echo '<div class="col-md-2 text-center" style="border:black; background:white;">';
                 echo '<h4>KASSA</h4>';
                 echo '<a href="/webshop/kassa/" class="btn btn-warning" style="padding-bottom:8px;margin-bottom: 10px;"><i class="fa fa-eye"></i></a></div>';
                }
              
                
                
                
                
                echo '<div class="well text-center" style="width: 80%;margin-left:10%;background: rgba(255,255,255,0.8);border:2px solid black;margin-top:50px; padding:20px;">
                <h1>Welkom bij Webland.</h1>
                <hr />
                
                <p>Allereerst, bedankt voor uw vertrouwen. Dit hier is de start van uw nieuwe leven digitaal. Webland is een nieuw uniek concept. Met deze software kan u zeer eenvoudig uw eigen bedrijf beheren en verbeteren. Dit pakket heeft alles wat u nodig heeft om te groeien en uw competiviteit te verbeteren. Indien u iets vind dat beter kan, of nodig heeft mag u mij hoogst persoonlijk contacteren. Ik heb niet liever dan dat u dit doet.</p>
                <p>Webland is ontstaan als een idee op een feestje in 2015. Eén van mijn wildste jaren. Maar uit wilde jaren ontstaan nu eenmaal de stoutste dromen. Ik hoop dat u geniet van mijn werk, voor meer werk voor iedereen.</p>
                <p>Van Harte Eoghain Verdonckt, CEO & Founder van Webland.</p>
                </div>';
            
        echo '</div>';
    
    echo "</div>";
}
?>




<!DOCTYPE html>
<html>
<head lang="nl">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />



    <!-- Bootstrap css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/font5/css/fontawesome.min.css">
    <link href="/font5/css/brands.css" rel="stylesheet">
    <link href="/font5/css/solid.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style>
       .fa-eye{ color:white;}
   </style>
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>
<?php $ctrl->print_supernav(); ?> 
<?php
    if(isset($_SESSION['user'])=="ok")
    {
    showOptions($ctrl);
    }
?>



    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Webland, design by <a href="http://webland.be">Webland</a> All rights reserved</p>
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
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 <script src="https://kit.fontawesome.com/ec86fc2ae0.js" crossorigin="anonymous"></script>
    <script>
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
    </script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->