<?php
session_start();
$path = getcwd();
$path = str_replace("functies", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if($_POST)
{
   if($_POST['remove']){
    $conn=$ctrl->getConnection();  
    $sql = "DELETE FROM `functies` WHERE id=".$_POST['id'];
    $conn->query($sql);
    $conn->close();
   }
}

function getClients($ctrl){
    $clients=$ctrl->selectStatement("functies",1);
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
                array_push($rij,$row);
            }
        } 
    $conn->close();
    if(count($rij)==1)
    {
        $rij=$rij[0];
    }
    return $rij['structure'];
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
    
    echo '<div class="col-md-4 clientThumb " >';
    echo '<div style="margin: 5px; border: 1px solid black; ">';
    echo '<img src="customer.png" style="width:100%;" />';
    echo '<div class="text-center" style="width: fit-content;
    margin-left: auto;
    margin-right: auto;
    margin-top: 8px;">
     <a  style="float:left;" class="btn btn-dark "href="/agenda/create.php?functie='.$client['id'].'"><i class="fa fa-calendar" style="color:white;"></i></a>
                
                    <a style="float:left;color:white;" class="btn btn-dark "href="update.php?id='.$client['id'].'"><i style="color:white;" class="fa fa-pen-fancy"></i></a>
                    <form method="post" style="float:left;">
                     <input type="hidden" value="remove" name="remove" />
                        <input type="hidden" value="'.$client['id'].'" name="id"/>
                         <button class="btn btn-dark"><i style="color: white;" class="fa fa-close"></i></button>
                    </form></div>';
    echo '<div style="text-align: left;width: 100%;margin-top: 55px;margin-left:10px;">';
    echo '<p style="margin-bottom:0;">'.$client['naam'].'</p>';
    echo '</div>';
    echo '</div>';
     echo '</div>';
}

function showOptions($ctrl){
    echo "<div class='row' style='padding-right: 15px;'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;background: rgba(255,255,255,0.8);margin-top:50px; padding:20px;">';
           
              

echo '<h1>De functies in uw bedrijf <a href="create.php"><i class="fas fa-plus-square"></i></a> </h1>
              
                <hr />';
            echo '<div class="row" id="clientContainer">';   
            
            $clients=getClients($ctrl);
            if($ctrl->count('functies')==0)
            {
                echo '<h1>U heeft nog geen klanten toegevoegd.</h1>';
            }
            if($ctrl->count('functies')==1)
            {
               printClient($clients);
            }
            if($ctrl->count('functies')>1)
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

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/tegels/bg.jpg'); background-size: cover;" class="text-center">
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
   

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->