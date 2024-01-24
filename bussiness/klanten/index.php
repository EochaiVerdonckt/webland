<?php
session_start();

$path = getcwd();
$path = str_replace("bussiness/klanten", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if($_POST)
{
   if($_POST['remove']){
    $conn=$ctrl->getConnection();  
    $sql = "DELETE FROM `clients` WHERE id=".$_POST['id'];
    $conn->query($sql);
    $conn->close();
   }
}

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

function getClients($ctrl){
    if(empty($_GET['sort'])){
        $clients=$ctrl->selectStatement("clients",1);
    } else{
    if($_GET['sort']==1){ $clients=$ctrl->selectStatement("clients",1,"voornaam");}
    if($_GET['sort']==2){$clients=$ctrl->selectStatement("clients",1,"city");}
    if($_GET['sort']==3){$clients=$ctrl->selectStatement("clients",1,"kleur");}
    }
    
    if(!empty($_GET['filter'])){$clients=$ctrl->selectStatement("clients","city=".$_GET['filter']);}
    return $clients;
}

function city2Strcture($zipcode){
    $ctrl=new AdminController();
    $ctrl->verify();
    $conn=$ctrl->getConnection();
    $rij = array();
    $sql = "SELECT * FROM cities where zipcode=".$zipcode;
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["structure"];
            }
        } 
    $conn->close();
}

function printCity($ctrl){
    
    $conn=$ctrl->getConnection();
    $rij = array();
    $sql = "SELECT city FROM `clients`group by city";
    
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $row['zip']=$row['city'];
                $row['city']=city2Strcture($row['city']);
                echo '<a id="'.$row['zip'].'" zip="'.$row['zip'].'" class="dropdown-item zip-item"  href="index.php?filter='.$row['zip'].'">'.$row['city'].'</a>';
            }
        } 
    $conn->close();
    return $rij;
}

function printColor($ctrl){
    
    $conn=$ctrl->getConnection();
    $rij = array();
    $sql = "SELECT kleur FROM `clients`group by kleur";
    
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $row['kleur2'] = str_replace("#","",$row['kleur']);
                echo '<a  kleur="'.$row['kleur2'].'" class="dropdown-item kleur-item"  href="index.php?kleur='.$row['kleur'].'"><i class="fas fa-square" style="color: '.$row['kleur'].';"></i> '.$row['kleur2'].'</a>';
            }
        } 
    $conn->close();
    return $rij;
}

function printClient($client){
    $client['zip']=$client['city'];
    $client['city']=city2Strcture($client['city']);
    $client['kleur2'] = str_replace("#","",$client['kleur']);
    echo '<div class="col-md-4 clientThumb '.$client['zip'].' 
'.$client['kleur2'].'" >';
    echo '<div style="margin: 5px; border: 1px solid black;background:'.$client['kleur'].' ">';
    echo '<img src="customer.png" style="width:100%;" />';
    echo '<div class="text-center" style="width: fit-content;
    margin-left: auto;
    margin-right: auto;
    margin-top: 8px;">
     <a  style="float:left;" class="btn btn-dark "href="/agenda/create.php?klant='.$client['id'].'"><i class="fa fa-calendar" style="color:white;"></i></a>
                    <form method="get" style="float:left;" action="/billing/create.php">
                     <input type="hidden" value="bill" name="action" />
                        <input type="hidden" value="'.$client['id'].'" name="client"/>
                         <button  class="btn btn-dark" data-toggle="tooltip" title="Maak een factuur voor deze klant."><i style="color: white;" class="fa fa-university"></i></button>
                    </form>
                    <a style="float:left;color:white;" class="btn btn-dark "href="update.php?id='.$client['id'].'"><i style="color:white;" class="fa fa-pen-fancy"></i></a>
                    <form method="post" style="float:left;">
                     <input type="hidden" value="remove" name="remove" />
                        <input type="hidden" value="'.$client['id'].'" name="id"/>
                         <button class="btn btn-dark"><i style="color: white;" class="fa fa-close"></i></button>
                    </form></div>';
    echo '<div style="text-align: left;width: 100%;margin-top: 55px;margin-left:10px;">';
    echo '<p style="margin-bottom:0;">'.$client['naam'].' '.$client['voornaam'].'</p>';
    echo '<p style="margin-bottom:0;">Email: '.$client['email'].'</p>';
    echo '<p style="margin-bottom:0;">Tel: '.$client['gsm'].'</p>';
    echo '<p style="margin-bottom:0;">Adres: '.$client['straat'].' '.$client['city'].'</p>';
    echo '</div>';
    echo '</div>';
     echo '</div>';
}

function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;background: rgba(255,255,255,0.8);margin-top:50px; padding:20px;">';
                
                echo '
                <form id="searchForm" method="post" class="form-inline my-2 my-lg-0 pull-right">
      <input style="border:1px solid black; "class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="zoek" id="searchBar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
    </form>
                
                ';
                
                echo '<div><div class="btn-group btn-group-toggle" data-toggle="buttons">';
                echo '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sorteer op
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item sort" href="?sort=1">Naam</a>
    <a class="dropdown-item sort" href="?sort=2">Postcode</a>
    <a class="dropdown-item sort" href="?sort=3">Kleur</a>
  </div>
</div>';

        echo '<div class="dropdown" style="margin-left:10px;">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Gemeente
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
     printCity($ctrl);
  echo '</div></div>';
  
  
          echo '<div class="dropdown" style="margin-left:10px;">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Kleur
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
     printColor($ctrl);
  echo '</div></div>';

echo '</div></div>';


echo '<h1>Uw online klantenportefeuille <a href="create.php"><i class="fas fa-plus-square"></i></a> </h1>
                <h3>Opgelet: uw klantenkluis is persoonlijk, Webland zal en kan deze gegevens nooit gebruiken.</h3>
                 <h3>U kan de kleuren gebruiken om uw klanten in groepen op te delen.</h3>
                <hr />';
            echo '<div class="row" id="clientContainer">';   
            
            $clients=getClients($ctrl);
            if(!empty($_GET['order'])){
             if($_GET['order']==1){
               $clients= sort($clients);
             }
            }
            
            if($ctrl->count('clients')==0)
            {
                echo '<h1>U heeft nog geen klanten toegevoegd.</h1>';
            }
            if($ctrl->count('clients')==1)
            {
               printClient($clients);
            }
            if($ctrl->count('clients')>1)
            {
                foreach ($clients as &$client) {
                    printClient($client);
                }
            }
            echo    '</div><</div>';
        echo '</div>';
    
    echo "</div>";
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
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions($ctrl);
    }
?>



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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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
    <script>
      
        $(".zip-item").click(function() {
            $(".clientThumb").hide();
            var zip="."+$(this).attr('zip');
            $(zip).show();
        });
        $(".kleur-item").click(function() {
            $(".clientThumb").hide();
           
            var kleur="."+$(this).attr('kleur');
            console.log(kleur);
            $(kleur).show();
        });
        $(".sort").click(function() {
            var link="."+$(this).attr('href');
            window.location.replace(link);
        });
        $("#searchBar").keyup(function() {
           $.post( "search.php", { zoek: $('#searchBar').val() })
                .done(function( data ) {
                    console.log(data);
                    $("#clientContainer").empty();
                    $.each(data, function( index, value ) {
                            value.kleur2 = value.kleur.replace('#','')
                            console.log(value);
                            var box = '<div class="col-md-4 clientThumb '+value.zipcode+' '+value.kleur2+'" >';
                            box = box + '<div style="margin: 5px; border: 1px solid black;background:'+value.kleur+' ">';
                            box = box + '<img src="customer.png" style="width:100%;" />';
                            box = box + '<div class="text-center" style="width: fit-content; margin-left: auto; margin-right: auto; margin-top: 8px;">';
                            box = box + '<a  style="float:left;" class="btn btn-dark "href="/agenda/create.php?klant='+value.id+'">';
                            box = box + ' <i class="fa fa-calendar"></i></a>';
                            box = box + '<form method="get" style="float:left;" action="/billing/stap2.php">';
                            box = box + '<input type="hidden" value="bill" name="action" />';
                            box = box + '<input type="hidden" value="'+value.id+'" name="id"/>'
                            box = box + '<button  class="btn btn-dark" data-toggle="tooltip" title="Maak een factuur voor deze klant."><i style="color: white;" class="fa fa-university"></i></button>';
                            box = box + '</form>';
                            box = box + '<a style="float:left;" class="btn btn-dark "href="update.php?id='+value.id+'"><i class="fa fa-pen-fancy"></i></a>';
                            box = box + '<form method="post" style="float:left;"><input type="hidden" value="remove" name="remove" />';
                            box = box + ' <input type="hidden" value="'+value.id+'" name="id"/>';
                            box = box + '<button class="btn btn-dark"><i style="color: white;" class="fa fa-close"></i></button>';
                            box = box + '</form></div>';
                            box = box + '<div style="text-align: left;width: 100%;margin-top: 55px;margin-left:10px;">';
                            box = box + '<p style="margin-bottom:0;">'+value.naam+' ';
                            box = box +value.voornaam+'</p>';
                            box = box + '<p style="margin-bottom:0;">Email: '+value.email+'</p>';
                            box = box + '<p style="margin-bottom:0;">Tel: '+value.gsm+'</p>';
                            box = box + '<p style="margin-bottom:0;">Adres: ';
                            box = box + value.structure;
                            box = box + '</p>';
                            box = box + '</div></div></div>';
                            $("#clientContainer").append(box);
                    });
                 });
        });



        
    </script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->